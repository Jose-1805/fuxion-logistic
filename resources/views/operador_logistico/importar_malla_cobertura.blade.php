@extends('layouts.app')

<?php
    $rol = \FuxionLogistic\Models\Rol::where('empresarios','si')->first();
?>

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Importación manual de cortes</p>
            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'corte'])
            </div>
            @if(!$rol)
                <div class="alert alert-danger" role="alert">
                    <p>Para realizar la importación de un corte de forma manual es necesario que exista un rol asignable a empresarios.</p>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <p>El archivo de Excel a importar proviene de la plataforma Exigo, 
                        debe contener todos los campos requeridos en el <a href="#!"><strong>formato</strong>.</a> </p>
                </div>
                {!! Form::open(['id'=>'form-corte-pedidos']) !!}
                <div class="form-group col-xs-12 col-sm-8 col-md-9">
                    <label for="archivo">Archivo (.xls, .xlsx)</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                </div>

                <div class="col-xs-12 col-sm-4 col-md-3 margin-top-20">
                    <a href="#!" id="btn-guardar-corte" class="col-xs-12 btn btn-primary margin-top-5">Importar</a>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('importar.js')}}"></script>
@endsection