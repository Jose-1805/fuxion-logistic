<?php
namespace FuxionLogistic\Models;
use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
class Corte extends Model
{
    protected $table = 'cortes';
    protected $fillable = [
        'user_id',
        'numero',
        'estado'
    ];
    public function pedidos(){
        return $this->hasMany(Pedido::class,'corte_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public static function ultimoNumeroCorte(){
        $ultimo_corte = Corte::orderBy('numero','DESC')->first();
        if($ultimo_corte)return $ultimo_corte->numero;
        return 0;
    }
    /**
     * Cambia el estado del corte a 'procesado' siempre y cuando el estado actual sea 'transmitido' y no existan guías
     * en estado 'registrada' (todas deben estar en estado 'enviada')
     *
     * @return bool // si se peude cambiar el estado o si el estado ya esta en 'procesado'
     */
    public function procesarCorte(){
        if($this->estado == 'transmitido') {
            $count_guias = $this->pedidos()
                ->join('guias_pedidos', 'pedidos.id', '=', 'guias_pedidos.pedido_id')
                ->join('guias', 'guias_pedidos.guia_id', '=', 'guias.id')
                ->where('guias.estado','registrada')
                ->count();
            if($count_guias){
                return false;
            }else{
                $this->estado = 'procesado';
                $this->fecha_procesamiento = date('Y-m-d H:i:s');
                $this->save();
                return true;
            }
        }else if($this->estado == 'procesado'){
            return true;
        }
        return false;
    }
    public static function enProceso(){
        return Corte::where(function($q){
                $q->where('estado','transmitido')
                    ->orWhere('estado','procesado');
            })
            ->where('guias_asignadas','si')->first();
    }
    public static function permitirProcesar($corte){
        $corte_proceso = Corte::enProceso();
        if($corte->estado == 'transmitido'
            && (
                !$corte_proceso//no existe un corte en proceso
                || (
                    $corte_proceso //si existe un corte en proceso y es el mismo recibido como parametro y el estado es != de procesado
                    && ($corte_proceso->id == $corte->id && $corte->estado != 'procesado')
                )
            )
        )
            return true;
        return false;
    }
    /**
     * Consulta cortes que tengan el estado en proceso por más de 24 horas y envia
     * notificación por email para usuarios de perfil logistica
     */
    public static function alertaCortePermanenteProcesado(){
        //SELECT cortes.* FROM `cortes` where date_add(fecha_procesamiento, INTERVAL 1 DAY) < now()
        $cortes = Corte::select('cortes.*')
            ->whereRaw('date_add(fecha_procesamiento, INTERVAL 1 DAY) < now()')
            ->where('cortes.correo_procesamiento_enviado','no')->get();
        if(count($cortes)){
            $correo = new Correo();
            $correo->titulo = 'Corte(s) en estado permanente';
            $correo->mensaje = view('mail.contenidos.corte_estado_permanente')
                ->with('cortes',$cortes)
                ->render();
            $correo->asunto = 'Corte en estado abierto permanente';
            $users = User::select('users.email')
                ->join('roles','users.rol_id','=','roles.id')
                ->where('roles.nombre','Logística')->get();
            if(count($users)) {
                Mail::to($users)->send(new \FuxionLogistic\Mail\PlantillaCorreo($correo));
                foreach ($cortes as $corte) {
                    $corte->correo_procesamiento_enviado = 'si';
                    $corte->save();
                }
            }
        }
    }
	
	public function productosPorCorte($corte)
    {
       
         return	DB::select("SELECT P.fecha_orden,P.serie,P.correlativo, 
				pr.codigo as codigo_producto, pr.descripcion as descripcion_producto, pp.cantidad as cantidad, SC.nombre as estado_pedido
				FROM guias inner join guias_pedidos on guias.id=guias_pedidos.guia_id
				inner join pedidos P on P.id=guias_pedidos.pedido_id
				inner join pedidos_productos pp on pp.pedido_id=P.id
				inner join productos pr on pr.id=pp.producto_id
				inner join cortes c on c.id=P.corte_id
				left join (select SC1.pedido_id,ep.nombre,ep.descripcion,SC1.razon_estado from
				(select * from historial_estados_pedidos hep where hep.id in (
				select max(hep1.id) from historial_estados_pedidos hep1 group by hep1.pedido_id)) SC1 inner join
				estados_pedidos ep on ep.id=SC1.estado_pedido_id) SC on SC.pedido_id=P.id
				where SC.nombre='En Cola' and c.id = '".$corte."' 
				and pp.cantidad >0 order by orden_id, c.numero");
			//dd($productos);
			
        
    }
	
	public function excelProductosPorCorte($corte)
    {
        $productos = $this->productosPorCorte($corte);
        //dd($productos);
        return $this->excelProductos($productos);
        
    }
	
	public function excelProductos($productos)
    {
		//dd($productos);
        $archivo = storage_path('/app/plantillas/operador_logistico/informe_productos.xlsx');
        $data = [];
        foreach ($productos as $producto) {
			//dd($producto);
			$data[] = [
				$producto->fecha_orden,
				$producto->serie,
				$producto->correlativo,
				$producto->codigo_producto,
				$producto->descripcion_producto,
				$producto->cantidad
			];
            
			
        }
		
        return Excel::load($archivo, function ($file) use ($data) {
            $file->sheet('Hoja1', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->download('xls');
    }
    public function enviarInfoRepremundo(){
        $productos = $this->productosPorCorte($this->id);
        set_time_limit(0);
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $client = new Client(
            [
                'base_uri' => 'http://desarrollobus.repremundo.com.co:8080/api/v1/pedido',
                'http_errors' => true,
                //'timeout'  => 5.0,
            ]);
        //d($client);
        $response = $client->request('post', 'pedido',[
            'headers'=>$headers,
            'body'=>\GuzzleHttp\json_encode(['productos'=>$productos,'corte'=>$this])
        ]);
        if ($response->getStatusCode() == '200'){
            echo $response->getBody();
            return true;
        }else{
            return false;
        }
        /*
         EJEMPLO DE INFORMACIÓN ENVIADA
        {
            "productos":[
                {"fecha_orden":"2017-11-07","serie":723,"correlativo":172153,"codigo_producto":"DSCT","descripcion_producto":"Discount","cantidad":-1,"estado_pedido":"En cola"},
                {"fecha_orden":"2017-11-07","serie":723,"correlativo":172153,"codigo_producto":"142847","descripcion_producto":"CAFE & CAFE FIT CAPUCCINO X 28 FUXION CO","cantidad":3,"estado_pedido":"En cola"}
            ],
            "corte":{
                "id":38,
                "numero":1,
                "estado":"transmitido",
                "guias_asignadas":"si",
                "fecha_procesamiento":null,
                "correo_procesamiento_enviado":"no",
                "user_id":81,
                "created_at":"2017-12-28 09:33:31",
                "updated_at":"2017-12-28 09:33:42"
            }
        }
         */
    }
}