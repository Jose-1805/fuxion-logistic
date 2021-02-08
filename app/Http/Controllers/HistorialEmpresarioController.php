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
use FuxionLogistic\Models\HistorialEmpresario;
use FuxionLogistic\Models\Pedido;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class HistorialEmpresarioController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 14;

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
        return view('historial_empresario/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(Request $request){
        $historial = HistorialEmpresario::select(
            'historial_empresarios.*',
            'historial_empresarios.created_at as fecha',
			'pedidos.orden_id as orden',
            DB::raw('CONCAT(users.nombres," ",users.apellidos) as usuario')
        )->join('users','historial_empresarios.user_id','=','users.id')
		->join('pedidos','historial_empresarios.pedido_id','=','pedidos.id');

        if($request->has('fecha_inicio')) {
            $historial = $historial->where('historial_empresarios.created_at','>=',$request->input('fecha_inicio'));
        }

        if($request->has('fecha_fin')) {
            $fecha_fin = date('Y-m-d',strtotime('+1day',strtotime($request->input('fecha_fin'))));
            $historial = $historial->where('historial_empresarios.created_at','<=',$fecha_fin);
        }

        $historial = $historial->get();

        $table = Datatables::of($historial);//->removeColumn('id');

        $table = $table->make(true);
        return $table;
    }

    public function exportar(Request $request){
        $historial = HistorialEmpresario::select(
            'historial_empresarios.*',
            'historial_empresarios.created_at as fecha',
			'pedidos.orden_id as orden',
            DB::raw('CONCAT(users.nombres," ",users.apellidos) as usuario')
        )->join('users','historial_empresarios.user_id','=','users.id')
		->join('pedidos','historial_empresarios.pedido_id','=','pedidos.id');

        if($request->has('fecha_inicio')) {
            $historial = $historial->where('historial_empresarios.created_at','>=',$request->input('fecha_inicio'));
        }

        if($request->has('fecha_fin')) {
            $fecha_fin = date('Y-m-d',strtotime('+1day',strtotime($request->input('fecha_fin'))));
            $historial = $historial->where('historial_empresarios.created_at','<=',$fecha_fin);
        }

        $historial = $historial->get();
        Excel::create('historial_empresario',function ($excel) use ($historial){
            $excel->sheet('Historial', function($sheet) use ($historial){
                $sheet->loadView('historial_empresario.lista_excel')->with('historial_empresarios',$historial);
            });
        })->download('xlsx');
    }
}