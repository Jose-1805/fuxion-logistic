<?php

//namespace App\Http\Controllers\v1;
namespace FuxionLogistic\Http\Controllers\v1;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
//use Mockery\CountValidator\Exception;


class UploadController extends Controller
{

   // public function  __construct(){
    //    $this->middleware('auth.basic');
//}

    public function index(){
        //Metodo GET sin nada mas en la URL, traer todos los registros
        
        return response(["data" => "En el index"]);
    }
    public function  show($id){
        //Metodo get y con el id en la url luego de modulos/[$id]
        
            return response(["No existe"=>false],500);
        
    }

    public function store(Request $r){

        if($r->file('picture')){

            $r->file('picture')->storeAs($r->input("tipo").'/'.$r->input("id"), $r->input("nombre").".jpg");
        }
        return response(["data" => $r->all()]);
    }

   
}
