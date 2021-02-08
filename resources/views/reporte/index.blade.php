@extends('layouts.app')
<?php
    $reportes = [
        'logistica'=>'Logística',
        'incidencias'=>'Incidencias',
        'pedidos_productos'=>'Pedidos y productos',
        'tiempos_logistica'=>'Tiempos de logística',
    ];
?>
@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Reportes</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-reportes'])
            </div>

            <div class="row margin-bottom-10">
                <div class="col-md-4 col-lg-3 col-lg-offset-3">
                    {!! Form::label('reporte','Reporte') !!}
                    {!! Form::select('reporte',$reportes,null,['id'=>'reporte','class'=>'form-control campo-filtro']) !!}
                </div>
                <div class="col-md-4 col-lg-3">
                    {!! Form::label('fecha_inicio','Fecha de inicio') !!}
                    {!! Form::date('fecha_inicio',date('Y-m-d'),['id'=>'fecha_inicio','class'=>'form-control campo-filtro']) !!}
                </div>
                <div class="col-md-4 col-lg-3">
                    {!! Form::label('fecha_fin','Fecha de fin') !!}
                    {!! Form::date('fecha_fin',date('Y-m-d'),['id'=>'fecha_fin','class'=>'form-control campo-filtro']) !!}
                </div>
            </div>


            <div class="col-xs-12 no-padding hide contenedor-tabla-reporte" id="logistica">
                @include('reporte.reportes.logistica')
            </div>
            <div class="col-xs-12 no-padding hide contenedor-tabla-reporte" id="incidencias">
                @include('reporte.reportes.incidencias')
            </div>
            <div class="col-xs-12 no-padding hide contenedor-tabla-reporte" id="pedidos_productos">
                @include('reporte.reportes.pedidos_productos')
            </div>
            <div class="col-xs-12 no-padding hide contenedor-tabla-reporte" id="tiempos_logistica">
                @include('reporte.reportes.tiempos_logistica')
            </div>
            <div class="col-xs-12 text-center no-padding margin-top-20">
                <a class="btn btn-success btn-radius" id="btn-exportar"><i class="fa fa-file-excel-o margin-right-10"></i>Exportar</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/reporte/index.js')}}"></script>
    <script>
        $(function () {
            cargarTablaReportes();
        })
    </script>
@stop


