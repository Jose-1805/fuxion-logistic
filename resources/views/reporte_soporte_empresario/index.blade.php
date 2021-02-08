@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Reporte de soporte a empresario</p>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-reporte-soporte-empresario'])
            </div>

            <div class="row margin-bottom-10">
                <div class="col-md-4 col-md-offset-4 col-lg-3 col-lg-offset-6">
                    {!! Form::label('fecha_inicio','Fecha de inicio') !!}
                    {!! Form::date('fecha_inicio',date('Y-m-d'),['id'=>'fecha_inicio','class'=>'form-control campo-filtro']) !!}
                </div>

                <div class="col-md-4 col-lg-3">
                    {!! Form::label('fecha_fin','Fecha de fin') !!}
                    {!! Form::date('fecha_fin',date('Y-m-d'),['id'=>'fecha_fin','class'=>'form-control campo-filtro']) !!}
                </div>
            </div>


            <div class="col-xs-12 no-padding contenedor-tabla-reporte">
                <table id="tabla-reporte-soporte-emopresario" class="dataTable table-hover">
                    <thead>
                        <th>Fecha</th>
                        <th>Orden</th>
                        <th>Acción</th>
                        <th>No. Factura</th>
                        <th>Usuario</th>
                    </thead>
                </table>
            </div>
            <div class="col-xs-12 text-right no-padding margin-top-20">
                <a class="btn btn-primary" id="btn-exportar">Exportar <i class="fa fa-file-excel-o"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/reporte_soporte_empresario/index.js')}}"></script>
    <script>
        $(function () {
            cargarTablaReporteSoporteEmpresario();
        })
    </script>
@stop


