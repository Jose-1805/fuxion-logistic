<?php
    $operadores_logisticos = \FuxionLogistic\Models\OperadorLogistico::all();
?>
@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Pedidos en corte #{{$corte->numero}}</p>
            <div class="col-xs-12 margin-top-30">
                @include('layouts.alertas',['id_contenedor'=>'alertas-guias'])
            </div>
            <div class="col-xs-12 text-center margin-bottom-20">
                <strong class="text-center">SEGÚN LA MALLA DE COBERTURA, SE ASIGNARON:</strong>
            </div>

            @forelse($operadores_logisticos as $ol)
                <div class="col-sm-4 text-center">
                    <div class="col-xs-12 item-ol">
                        <div class="col-xs-12">
                            @if(strtolower($ol->nombre) == 'servientrega')
                                <img height="20" src="{{asset('imagenes/sistema/logo_servientrega.png')}}">
                            @elseif(strtolower($ol->nombre) == 'deprisa')
                                <img height="20" src="{{asset('imagenes/sistema/logo_deprisa.png')}}">
                            @elseif(strtolower($ol->nombre) == 'domina')
                                <img height="20" src="{{asset('imagenes/sistema/logo_domina.png')}}">
                            @endif
                        </div>


                        <strong class="col-xs-12 blue-text text-lighten-2 font-xx-large margin-top-20">{{$ol->guiasAsignadasPorCorte($corte->id,true)}}</strong>
                        <p>Guías con {{$ol->nombre}}</p>
                        {!! $ol->guiasAsignadasPorCorte($corte->id,true) ? '<a href="'.url('/corte/guias-operador-logistico/'.$corte->id.'/'.$ol->id).'" class="btn btn-radius-sm btn-primary"><i class="fa fa-pencil margin-right-10"></i>Modificar asignación</a>' : '<a href="#!" class="btn btn-radius-sm btn-primary" disabled="disabled"><i class="fa fa-pencil margin-right-10"></i>Modificar asignación</a>'!!}
                    </div>
                </div>
            @empty
                <div class="alert alert-danger" role="alert">
                    <p>No existen operadores logísticos para asignar guías</p>
                </div>
            @endforelse

            <div class="col-xs-12 margin-top-40">
                <div class="col-sm-4 text-right padding-top-5">
                    <label class="">Guías operador Logístico</label>
                </div>
                <div class="col-sm-4">
                    <select id="select-ol" class="form-control">
                        @foreach($operadores_logisticos as $ol)
                            <option value="{{$ol->id}}">{{$ol->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4 padding-top-5">
                    <a href="#!" class="btn btn-primary btn-radius-sm btn-descargar-guias-manuales"><i class="fa fa-download margin-right-10"></i>Descargar Archivo OL</a>
                </div>
            </div>

            <div class="col-xs-12 margin-top-40 padding-top-10 text-center">
                {!! Form::hidden('corte',$corte->id,['id'=>'corte']) !!}
                <div class="col-sm-10 col-sm-offset-1" style="border-top: 1px solid #bdbdbd;">
                    <a href="#!" class="btn btn-success btn-radius margin-top-20" id="btn-guias-automaticas"><i class="fa fa-undo margin-right-10"></i>Guías automáticas</a>
                    <a href="{{url('/corte/guias-manuales/'.$corte->id)}}" class="btn btn-success btn-radius margin-top-20"><i class="fa fa-upload margin-right-10"></i>Guias manuales</a>
                    <a href="#!" class="btn btn-success btn-radius btn-informe-productos margin-top-20"><i class="fa fa-file-excel-o margin-right-10"></i>Informe Productos</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-confirm-guias-automaticas" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está segur@ de procesar las guías automáticas del corte seleccionado?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-confirm-guas-automaticas">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/corte/guias.js')}}"></script>
@endsection