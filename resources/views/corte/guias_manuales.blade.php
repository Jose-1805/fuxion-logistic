<?php
    $operadores_logisticos = \FuxionLogistic\Models\OperadorLogistico::all();
?>
@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Guías manuales</p>
            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-guias-manuales'])
            </div>
            <div class="alert alert-info" role="alert">
                <p>Guías masivar generadas por los operadores logísticos para el corte <strong>#{{$corte->numero}}</strong></p>
            </div>

            <table class="dataTable table-hover" style="border: 1px solid #ddd !important;">
                <thead>
                    <th width="50%">Operador logístico</th>
                    <th class="text-center">Archivo</th>
                    <th class="text-center">Opciones</th>
                </thead>
                <tbody>
                    @forelse($operadores_logisticos as $ol)
                        <tr>
                            <td>{{$ol->nombre}}</td>
                            <td class="text-center">
                                {!! Form::open(['id'=>'form-guias-'.$ol->id,'enctype'=>'multipart/form-data']) !!}
                                    <input type="file" name="archivo">
                                    {!! Form::hidden('corte',$corte->id) !!}
                                    {!! Form::hidden('operador_logistico',$ol->id) !!}
                                {!! Form::close() !!}
                            </td>
                            <td class="text-center">
                                <a href="#!" class="btn btn-primary btn-sm btn-radius-sm btn-subir-guias" data-ol="{{$ol->id}}">Aplicar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">No existen operadores logísticos para seleccionar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/corte/guias_manuales.js')}}"></script>
@endsection