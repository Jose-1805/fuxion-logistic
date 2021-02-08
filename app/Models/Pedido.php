<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
        'fecha_orden',
        'fecha_impresion',
        'serie',
        'correlativo',
        'orden_id',
        'impreso_por',
        'subtotal',
        'total_tax',
        'costo_envio',
        'descuento',
        'total',
        'tipo_pago',
        'volumen_comisionable',
        'first_name',
        'last_name',
        'email',
        'direccion',
        'ciudad_id',
        'departamento_id',
        'empresario_id',
        'bodega_id',
        'corte_id',
    ];

    protected $codigos_postales = [
        'ACACIAS'=>'507001',
        'AGUADAS'=>'172020',
        'AGUA DE DIOS'=>'252850',
        'AGUACHICA'=>'205010',
        'ALGECIRAS'=>'413040',
        'ALTAMIRA'=>'416020',
        'AMAGA'=>'055840',
        'AMBALEMA'=>'731001',
        'AMAIME'=>'763520',
        'ANDALUCIA'=>'763010',
        'ANSERMA NUEVO'=>'762010',
        'APARTADO'=>'057840',
        'ARAUCA'=>'810001',
        'ARAUQUITA'=>'816010',
        'ARBOLETES'=>'057828',
        'ARJONA'=>'131020',
        'ARMENIA'=>'630004',
        'BAHIA SOLANO'=>'276030',
        'BARANOA'=>'082020',
        'BARBOSA SANTANDER'=>'684511',
        'BARBOSA'=>'051020',
        'BARCELONA'=>'632027',
        'BARRAGAN'=>'632007',
        'BARRANCABERMEJA'=>'687033',
        'BARRANCAS'=>'443040',
        'BARRANQUILLA'=>'080002',
        'BAYUNCA'=>'130007',
        'BECERRIL'=>'203001',
        'BELEN DE UNGRIA'=>'664040',
        'BELENCITO'=>'152288',
        'BELLO'=>'051050',
        'BOGOTA'=>'110911',
        'BOJACA'=>'253001',
        'BOLIVAR'=>'761001',
        'BONDA'=>'470003',
        'BRICEÑO'=>'251001',
        'BUCARAMANGA'=>'680001',
        'BUENAVENTURA'=>'764501',
        'BUENAVISTA'=>'632040',
        'BUGA'=>'763042',
        'BUGALAGRANDE'=>'763001',
        'CAICEDONIA'=>'762540',
        'CAJAMARCA'=>'732501',
        'CAJICA'=>'250240',
        'CALARCA'=>'632001',
        'CALDAS'=>'055440',
        'CALI'=>'760002',
        'CALOTO'=>'191070',
        'CAMPOALEGRE'=>'413020',
        'CANDELARIA VALLE'=>'763570',
        'CAREPA'=>'057850',
        'CARMEN DE APICALA'=>'733590',
        'CARTAGENA'=>'130002',
        'CARTAGO'=>'762021',
        'CASTILLA LA NUEVA META'=>'507041',
        'CAUCASIA'=>'052410',
        'CERETE'=>'230550',
        'CORINTO'=>'191560',
        'CHACHAGUI'=>'522001',
        'CHAPARRAL'=>'735560',
        'CHAMBIMBAL'=>'763042',
        'CHIA'=>'250001',
        'CHICORAL'=>'733529',
        'CHIGORODO'=>'057410',
        'CHINACOTA'=>'541070',
        'CHINAUTA'=>'252219',
        'CHINCHINA'=>'176020',
        'CHINU'=>'232050',
        'CHIQUINQUIRA'=>'154640',
        'CHOCONTA'=>'250801',
        'CIENAGA'=>'478001',
        'CIENAGA '=>'478001',
        'CIRCASIA'=>'631001',
        'CLEMENCIA'=>'130510',
        'CODAZZI'=>'202050',
        'COGUA'=>'250401',
        'CONCEPCION'=>'500017',
        'COPACABANA'=>'051040',
        'COROZAL'=>'705030',
        'COTA'=>'250017',
        'COVEÑAS'=>'706050',
        'CRISTALES'=>'761018',
        'CUCUTA'=>'540006',
        'DON MATIAS'=>'051850',
        'CUMARAL'=>'501021',
        'DAGUA'=>'760529',
        'DOSQUEBRADAS'=>'661001',
        'DUITAMA'=>'150461',
        'EL BOLO'=>'763550',
        'EL CAIMO'=>'630008',
        'EL CARMEN DE BOLIVAR'=>'132050',
        'EL CARMEN DE VIBORAL'=>'054030',
        'EL CERRITO'=>'763527',
        'EL PEÑOL'=>'522080',
        'EL PLACER'=>'763048',
        'EL RETIRO'=>'055430',
        'EL ROSAL'=>'250210',
        'EL SALADO'=>'730001',
        'EL SANTUARIO'=>'054450',
        'ENGATIVA'=>'111031',
        'ENVIGADO'=>'055420',
        'ESPINAL'=>'733520',
        'FACATATIVA'=>'253051',
        'FRESNO'=>'731560',
        'FILANDIA'=>'634001',
        'FLANDES'=>'733510',
        'FLORENCIA'=>'180001',
        'FLORIDA'=>'763560',
        'FLORIDABLANCA'=>'681001',
        'FONSECA'=>'444010',
        'FORTUL'=>'814050',
        'FUNZA'=>'250020',
        'FUSAGASUGA'=>'252211',
        'GACHANCIPA'=>'251020',
        'GAIRA'=>'470006',
        'GALAPA'=>'082001',
        'GARZON'=>'414020',
        'GIRARDOT'=>'252431',
        'GIRARDOTA'=>'051030',
        'GIRON'=>'687541',
        'GRANADA'=>'504001',
        'GUACARI'=>'763501',
        'GUADUAS'=>'253440',
        'GUAMAL'=>'507051',
        'GUAMO'=>'733540',
        'GUARNE'=>'054050',
        'GUAYMARAL'=>'111176',
        'HONDA'=>'732048',
        'HUMADEA'=>'507057',
        'IBAGUE'=>'730001',
        'IPIALES'=>'524060',
        'ITAGUI'=>'055410',
        'JAMUNDI'=>'764001',
        'LA BOQUILLA'=>'130002',
        'LA CALERA'=>'251201',
        'LA CEJA'=>'055010',
        'LA CUNCIA'=>'507001',
        'LA DORADA'=>'175031',
        'LA ESTRELLA'=>'055460',
        'LA JAGUA DE IBIRICO'=>'203020',
        'LA JAGUA DEL PILAR'=>'445040',
        'LA PAILA'=>'762520',
        'LA PAZ'=>'202010',
        'LA PLATA'=>'415060',
        'LA PLAYA'=>'080001',
        'LA PUNTA'=>'250201',
        'LA TEBAIDA'=>'633020',
        'LA VIRGINIA'=>'662001',
        'LARANDIA'=>'180001',
        'LA UNION ANTIOQUIA'=>'055020',
        'LA UNION VALLE'=>'761540',
        'LA URIBE'=>'763022',
        'LA VEGA'=>'253610',
        'LETICIA'=>'910001',
        'LERIDA'=>'731020',
        'LA VICTORIA'=>'762510',
        'LIBANO'=>'731040',
        'LORICA'=>'231020',
        'LOS PATIOS'=>'541010',
        'MADRID'=>'250030',
        'MAICAO'=>'442001',
        'MALAMBO'=>'083020',
        'MANIZALES'=>'170001',
        'MANZANILLO DEL MAR'=>'130008',
        'MARINILLA'=>'054020',
        'MARIQUITA'=>'732020',
        'MEDELLIN'=>'050024',
        'MEDIACANOA'=>'761048',
        'MELGAR'=>'734001',
        'MONTELIBANO'=>'234001',
        'MONTENEGRO'=>'633001',
        'MONTERIA'=>'230001',
        'MONIQUIRA'=>'154260',
        'MOSQUERA'=>'250040',
        'NATAGAIMA'=>'735001',
        'NEIVA'=>'410001',
        'NEMOCON'=>'251030',
        'NOBSA'=>'152280',
        'OBANDO'=>'762501',
        'OCAÑA'=>'546551',
        'ORTEGA'=>'735501',
        'PAIPA'=>'150440',
        'PACHO'=>'254001',
        'PALMIRA'=>'763533',
        'PAMPLONA'=>'543050',
        'PASACABALLOS'=>'130009',
        'PASTO'=>'520002',
        'PAZ DE ARIPORO CASANARE'=>'852030',
        'PENSILVANIA'=>'173060',
        'PEREIRA'=>'660001',
        'PICALEÑA'=>'730008',
        'PIEDECUESTA'=>'681011',
        'PLANADAS'=>'735078',
        'PITALITO'=>'417030',
        'PLANETA RICA'=>'233040',
        'PONTEZUELA'=>'130008',
        'POPAYAN'=>'190001',
        'PUERTO BERRIO'=>'053420',
        'PRADERA'=>'763550',
        'PRADO'=>'734520',
        'PUERTO GAITAN'=>'502041',
        'PRESIDENTE'=>'763038',
        'PUEBLO TAPAO'=>'633008',
        'PUEBLO VIEJO'=>'478001',
        'PUERTO BOYACA'=>'155201',
        'PUERTO COLOMBIA'=>'081001',
        'PUERTO LOPEZ'=>'502001',
        'PUERTO SALGAR'=>'253480',
        'PUERTO TEJADA'=>'191501',
        'QUIBDO'=>'270001',
        'QUIMBAYA'=>'634020',
        'RESTREPO'=>'501031',
        'REMEDIOS'=>'052820',
        'RICAURTE'=>'252410',
        'RIOFRIO'=>'761030',
        'RIOHACHA'=>'440001',
        'RIOSUCIO'=>'178040',
        'RIONEGRO'=>'054040',
        'RIVERA'=>'413001',
        'RODADERO'=>'470003',
        'ROLDANILLO'=>'761550',
        'SABANAGRANDE'=>'083040',
        'SABANETA'=>'055450',
        'SAHAGUN'=>'232540',
        'SALDAÑA'=>'733570',
        'SALENTO'=>'631020',
        'SALGAR'=>'081007',
        'SAMACA'=>'153660',
        'SAMPUES'=>'705070',
        'SAN ANTERO CORDOBA'=>'231520',
        'SAN ANDRES'=>'880001',
        'SAN ANTONIO DEL PRADO'=>'050029',
        'SAN CRISTOBAL'=>'051468',
        'SAN DIEGO'=>'202030',
        'SAN JOSE DEL GUAVIARE'=>'950001',
        'SAN JUAN DEL CESAR'=>'444030',
        'SAN MARCOS'=>'704030',
        'SAN MARTIN'=>'507021',
        'SAN PEDRO'=>'763030',
        'SANTA CATALINA'=>'130501',
        'SANTA MARTA'=>'470004',
        'SANTA ROSA DE CABAL'=>'661020',
        'SANTA ROSA DE LIMA'=>'130520',
        'SANTANDER DE QUILICHAO'=>'191030',
        'SARAVENA'=>'815010',
        'SESQUILE'=>'251050',
        'SEVILLA'=>'762530',
        'SIBERIA'=>'250010',
        'SILVANIA'=>'252240',
        'SINCELEJO'=>'700003',
        'SOACHA'=>'250051',
        'SOCORRO'=>'683551',
        'SOGAMOSO'=>'152210',
        'SOLEDAD'=>'083001',
        'SONSO'=>'763047',
        'SOPO'=>'251007',
        'SUBACHOQUE'=>'250220',
        'SUESCA'=>'251040',
        'TABIO'=>'250230',
        'TAGANGA'=>'470001',
        'TAME'=>'814010',
        'TENJO'=>'250207',
        'TIBASOSA'=>'152260',
        'TIBU'=>'548010',
        'TIERRA BAJA'=>'130008',
        'TIMBIO'=>'193520',
        'TOCANCIPA'=>'251010',
        'TODO SANTOS'=>'763022',
        'TOLEMAIDA'=>'252408',
        'TOLU'=>'706010',
        'TUCHIN'=>'232020',
        'TULUA'=>'763027',
        'TUMACO'=>'528501',
        'TUNJA'=>'150001',
        'TUQUERRES'=>'525520',
        'TURBACO'=>'131001',
        'TURBANA'=>'131010',
        'TURBO'=>'057860',
        'UBATE'=>'250430',
        'URUMITA'=>'445020',
        'USME'=>'110541',
        'VALLEDUPAR'=>'200001',
        'VENADILLO'=>'730580',
        'VILLA DEL ROSARIO'=>'541030',
        'VILLA DE LEIVA'=>'415069',
        'VILLA RICA'=>'191060',
        'VILLAMARIA'=>'176001',
        'VILLANUEVA'=>'445001',
        'VILLAPINZON'=>'250810',
        'VILLAVICENCIO'=>'500001',
        'VILLETA'=>'253410',
        'EL YOPAL'=>'850001',
        'YOTOCO'=>'761040',
        'YUMBO'=>'760001',
        'ZARAGOZA'=>'052448',
        'ZARZAL'=>'762520',
        'ZIPAQUIRA'=>'250251',
        'ZULIA'=>'545510',
    ];

    public function empresario(){
        return $this->belongsTo(Empresario::class,'empresario_id');
    }

    public function corte(){
        return $this->belongsTo(Corte::class,'corte_id');
    }

    public function productos(){
        return $this->belongsToMany(Producto::class,'pedidos_productos','pedido_id','producto_id');
    }

    public function bodega(){
        return $this->belongsTo(Bodega::class,'bodega_id');
    }

    public function estadosPedidos(){
        return $this->belongsToMany(EstadoPedido::class,'historial_estados_pedidos','pedido_id','estado_pedido_id');
    }

    public function guias(){
        return $this->belongsToMany(Guia::class,'guias_pedidos','pedido_id','guia_id');
    }

    /**
     * Determina si el pedido tiene una guia en estado registrada
     */
    public function guiaRegistrada(){
        $guia = $this->guias()->where('guias.estado','registrada')->first();
        if($guia)return true;
        return false;
    }

    /**
     * Retorna eloquesnt con consulta de pedidos en relacion con su ultimo estado
     * si recibe parametros retornará los pedidos en los cuales su ultimo estado y razon de estado sea el recibido en los parametros
     * si no recibe parametros retornará todos los pedidos con la relaciona con el ultimo historial de estado
     *
     * @param null $id_estado
     * @param null $razon_estado
     * @return $this
     */
    public static function segunEstadoActual($id_estado = null,$razon_estado = null){
        $pedidos = Pedido::select('pedidos.*')
            ->join('historial_estados_pedidos','pedidos.id','=','historial_estados_pedidos.pedido_id')
            ->whereRaw("historial_estados_pedidos.id IN (select max(historial_estados_pedidos.id) as h_id from historial_estados_pedidos where pedido_id = pedidos.id group by historial_estados_pedidos.pedido_id)");

        if($id_estado)
            $pedidos = $pedidos->where('historial_estados_pedidos.estado_pedido_id',$id_estado);
        if($razon_estado){
            if($razon_estado == 'null'){
                $pedidos = $pedidos->whereNull('historial_estados_pedidos.razon_estado');
            }else {
                $pedidos = $pedidos->where('historial_estados_pedidos.razon_estado', $razon_estado);
            }
        }
        return $pedidos;

    }

    public function ultimoEstado(){
        return $this->estadosPedidos()
            ->join('pedidos','historial_estados_pedidos.pedido_id','pedidos.id')
            ->whereRaw("historial_estados_pedidos.id IN (select max(historial_estados_pedidos.id) as h_id from historial_estados_pedidos where pedido_id = pedidos.id group by historial_estados_pedidos.pedido_id)")
            ->select('estados_pedidos.*','razon_estado')
            ->first();
    }

    /**
     * Determina si el pedido relacionado tiene un kit de afiliación en su lista de productos
     */
    public function tieneKit(){
        $productos = $this->productos;
        foreach ($productos as $producto) {
            if($producto->descripcion == 'KIT DE AFILIACION COLOMBIA'){
                return true;
            }
        }
        return false;
    }

    public function codigoPostal(){
        $ciudad = str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú'],['a','e','i','o','u','A','E','I','O','U'],$this->ciudad->nombre);

        if(isset($this->codigos_postales[$ciudad])){
            return $this->codigos_postales[$this->ciudad->nombre];
        }
        return null;
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class,'ciudad_id');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class,'departamento_id');
    }

    public function nombreCiudadOL($ol){
        $data = $this->ciudad()->select('operadores_logisticos_ciudades.nombre')
            ->join('operadores_logisticos_ciudades','ciudades.id','=','operadores_logisticos_ciudades.ciudad_id')
            ->where('operadores_logisticos_ciudades.operador_logistico_id',$ol)
            ->first();
        if($data){
            return $data->nombre;
        }else{
            return $this->ciudad->nombre;
        }
    }

    public function nombreDepartamentoOL($ol){
        $data = $this->departamento()->select('operadores_logisticos_departamentos.nombre')
            ->join('operadores_logisticos_departamentos','departamentos.id','=','operadores_logisticos_departamentos.departamento_id')
            ->where('operadores_logisticos_departamentos.operador_logistico_id',$ol)
            ->first();
        if($data){
            return $data->nombre;
        }else{
            return $this->departamento->nombre;
        }
    }
}
