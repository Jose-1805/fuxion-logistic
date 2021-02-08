<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CargueSapController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 13;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permisoModulo:'.$this->modulo_id.',' . $this->privilegio_superadministrador);
    }

    public function index()
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        return view('cargue_sap/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(Request $request){
        $estado_pendiante = EstadoPedido::where('no_asignacion_corte','si')->first();
        $pedidos = Pedido::segunEstadoActual($estado_pendiante->id,'Ingresado a bodega')
            ->join('estados_pedidos','historial_estados_pedidos.estado_pedido_id','=','estados_pedidos.id')
            ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
            ->join('users','empresarios.user_id','=','users.id')
            ->leftJoin('guias_pedidos','pedidos.id','=','guias_pedidos.pedido_id')
            ->leftJoin('guias','guias_pedidos.guia_id','=','guias.id')
            ->where(function($q){
                $q->whereRaw("guias_pedidos.id IN (select max(guias_pedidos.id) as gp_id from guias_pedidos where guias_pedidos.pedido_id = pedidos.id group by guias_pedidos.pedido_id)")
                    ->orWhereNull("guias_pedidos.id");
            });

        $pedidos = $pedidos->select('pedidos.*',
            'empresarios.tipo as tipo_empresario',
            'empresarios.empresario_id as empresario_id')->get();

        $table = Datatables::of($pedidos);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($row) {
            return  '<a href="#!" data-pedido="'.$row->id.'" class="btn btn-xs btn-primary margin-2 btn-cargar"><i class="white-text fa fa-paper-plane"></i></a>';
        })->rawColumns(['opciones']);

        $table = $table->make(true);
        return $table;
    }

    public function cargar(Request $request){
        if($request->has('pedido')){
            $estado_pendiante = EstadoPedido::where('no_asignacion_corte','si')->first();
            $pedido = Pedido::segunEstadoActual($estado_pendiante->id,'Ingresado a bodega')
                ->select('pedidos.*')
                ->where('pedidos.id',$request->input('pedido'))->first();
            if($pedido) {
                $pedido->estadosPedidos()->save($estado_pendiante, ['razon_estado' => 'Carga a SAP']);
                return ['success'=>true];
            }

        }
        return ['success'=>true];
    }
}
