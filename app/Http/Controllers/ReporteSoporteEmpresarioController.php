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
use FuxionLogistic\Models\ReporteSoporteEmpresario;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
class ReporteSoporteEmpresarioController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 12;
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
        return view('reporte_soporte_empresario/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }
    public function lista(Request $request){
        $reporte = ReporteSoporteEmpresario::whereBetween(DB::raw('date(fecha)'),[$request->fecha_inicio,$request->fecha_fin])->get();
        $table = Datatables::of($reporte);;
        $table = $table->make(true);
        return $table;
    }
    public function exportar(Request $request){
        $reporte = ReporteSoporteEmpresario::whereBetween(DB::raw('date(fecha)'),[$request->fecha_inicio,$request->fecha_fin])->get();
        Excel::create('reporte_soporte_empresario',function ($excel) use ($reporte){
            $excel->sheet('Reporte', function($sheet) use ($reporte){
                $sheet->loadView('reporte_soporte_empresario.lista_excel')
                    ->with('reporte',$reporte);
            });
        })->download('xlsx');
    }
}