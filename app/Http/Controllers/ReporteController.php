<?php

namespace FuxionLogistic\Http\Controllers;

use function foo\func;
use FuxionLogistic\Http\Requests\RequestBodega;
use FuxionLogistic\Http\Requests\RequestSoporteEmpresario;
use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\FacturaFlete;
use FuxionLogistic\Models\FacturaKit;
use FuxionLogistic\Models\Guia;
use FuxionLogistic\Models\Pedido;
use FuxionLogistic\Models\Reporte;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ReporteController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 15;

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
        return view('reporte/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(Request $request){
        if($request->has('reporte')) {

            $reporte = [];
            switch ($request->input('reporte')) {
                case 'logistica':
                    $reporte = Reporte::logistica($request->input('fecha_inicio'),$request->input('fecha_fin'));
                    break;
                case 'incidencias':
                    $reporte = Reporte::incidencias($request->input('fecha_inicio'),$request->input('fecha_fin'));
                    break;
                case 'pedidos_productos':
                    $reporte = Reporte::pedidosProductos($request->input('fecha_inicio'),$request->input('fecha_fin'));
                    break;
                case 'tiempos_logistica':
                    $reporte = Reporte::tiemposLogistica($request->input('fecha_inicio'),$request->input('fecha_fin'));
                    break;
            }
            $table = Datatables::of($reporte);//->removeColumn('id');

            switch ($request->input('reporte')) {
                case 'logistica':

                    break;
                case 'incidencias':

                    break;
                case 'pedidos_productos':
                    $table = $table->editColumn('precio_unitario',function ($row){
                        return '$ '.number_format($row->precio_unitario,2,',','.');
                    })->editColumn('precio_total',function ($row){
                        return '$ '.number_format($row->precio_total,2,',','.');
                    });
                    break;
                case 'tiempos_logistica':
                    $table = $table->editColumn('tiempo_salida_bodega',function ($row){
                        return number_format($row->tiempo_salida_bodega/24,2,',','.');
                    })->editColumn('tiempo_entrega',function ($row){
                        return number_format($row->tiempo_entrega/24,2,',','.');
                    });
                    break;
            }

            $table = $table->make(true);
            return $table;
        }
    }

    public function exportar(Request $request){
        if($request->has('reporte')) {

            $reporte = [];
            switch ($request->input('reporte')) {
                case 'logistica':
                    $reporte = Reporte::logistica($request->input('fecha_inicio'), $request->input('fecha_fin'));
                    break;
                case 'incidencias':
                    $reporte = Reporte::incidencias($request->input('fecha_inicio'), $request->input('fecha_fin'));
                    break;
                case 'pedidos_productos':
                    $reporte = Reporte::pedidosProductos($request->input('fecha_inicio'), $request->input('fecha_fin'));
                    break;
                case 'tiempos_logistica':
                    $reporte = Reporte::tiemposLogistica($request->input('fecha_inicio'), $request->input('fecha_fin'));
                    break;
            }
            Excel::create('reporte_'.$request->input('reporte'),function ($excel) use ($reporte,$request){
                $excel->sheet('Reporte', function($sheet) use ($reporte,$request){
                    $sheet->loadView('reporte.lista_excel')
                        ->with('reporte',$reporte)
                        ->with('nombre_reporte',$request->input('reporte'));
                });
            })->download('xlsx');
        }

    }
}