<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Models\Empresario;
use FuxionLogistic\Models\KitEmpresario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmpresarioController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 6;

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
        return view('empresario/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function importacionKits()
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,5,$this->privilegio_superadministrador))
            return redirect('/');

        return view('empresario/importacion_kits')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function importarKits(Request $request){

        $rules = [
            'archivo'=>'required|file|mimes:xlsx,xls|max:1000'
        ];

        $mensajes = [
            'archivo.required'=>'Seleccione un archivo.',
            'archivo.file'=>'Seleccione un archivo',
            'archivo.mimes'=>'El archivo seleccionado debe ser de tipo .xls o .xlsx.',
            'archivo.max'=>'El tamaño maximo del archivo es de 1MB',
        ];

        $this->validate($request,$rules,$mensajes);
        $complete = true;
        $error = '';

        Excel::load($request->file('archivo'),function ($reader) use (&$error,&$complete){
            $results = $reader->all();
            DB::beginTransaction();
            //dd($results);
            $i = 2;
            foreach ($results as $row){
                $array = $row->toArray();
                $contenido = false;
                foreach ($array as $key => $value){
                    if($value){
                        $contenido = true;
                        break;
                    }
                }
                if($contenido) {
                    //los campos inicio y fin son obligatorios
                    if (!$row->inicio || !$row->fin) {
                        $error = 'El campo inicio y el campo fin son obligatorios. Error en linea #' . $i;
                        $complete = false;
                        return false;
                    }

                    //el inicio no debe ser mayor al final
                    if ($row->inicio > $row->fin) {
                        $error = 'El número de inicio no puede ser mayor al número de fin. Error en linea #' . $i;
                        $complete = false;
                        return false;
                    }

                    //si existen excepciones
                    if ($row->excepciones) {
                        $excepciones = explode('_', $row->excepciones);
                        if (count($excepciones)) {
                            foreach ($excepciones as $e) {
                                //debe ser numerico
                                if (!is_numeric($e)) {
                                    $error = 'Todos los valores de exepciones deben ser númericos y separados por guion bajo (1_5_6_15). Error en linea #' . $i;
                                    $complete = false;
                                    return false;
                                }

                                //las excepciones deben estar dentro del rango de inicio y fin
                                if ($e < $row->inicio || $e > $row->fin) {
                                    $error = 'Todas los números de las excepciones deben estar entre el rango especificado. Error en linea #' . $i;
                                    $complete = false;
                                    return false;
                                }
                            }

                        }
                    }

                    //se buscan registros que incluyan los datos que trae la fila
                    $respuesta = KitEmpresario::where(function ($q) use ($row) {
                        $q->where(function ($q1) use ($row) {
                            $q1->whereBetween('inicio', [$row->inicio, $row->fin]);
                        })
                            ->orWhere(function ($q1) use ($row) {
                                $q1->whereBetween('fin', [$row->inicio, $row->fin]);
                            })
                            ->orWhere(function ($q1) use ($row) {
                                $q1->where('inicio', '<=', $row->inicio)
                                    ->where('fin', '>=', $row->inicio);
                            })
                            ->orWhere(function ($q1) use ($row) {
                                $q1->where('inicio', '<=', $row->fin)
                                    ->where('fin', '>=', $row->fin);
                            });
                    })->count();

                    if ($respuesta) {
                        $error = 'Los datos enviados en el formato son incorrectos, asegurese de que los números no se combinen entre las filas. Error en linea #' . $i;
                        $complete = false;
                        return false;
                    }

                    $kit_empresario = new KitEmpresario();
                    $kit_empresario->inicio = $row->inicio;
                    $kit_empresario->fin = $row->fin;
                    $kit_empresario->excepciones = $row->excepciones;
                    $kit_empresario->save();
                }
                $i++;
            }
        });

        if(!$complete) {
            DB::rollBack();
            return response(['error' => [$error]], 422);
        }else {
            DB::commit();
            return ['success' => true];
        }
    }
}
