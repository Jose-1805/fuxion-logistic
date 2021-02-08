@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Historial de empresarios</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-historial-empresario'])
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
            <table id="tabla-historial-empresario" class="table-hover">
                <thead>
                    <th width="100">Fecha</th>
                    <th>Orden</th>
					<th>Nombre anterior</th>
                    <th>Nombre nuevo</th>
                    <th>Apellido anterior</th>
                    <th>Apellido nuevo</th>
                    <th>Email anterior</th>
                    <th>Email nuevo</th>
                    <th>Teléfono anterior</th>
                    <th>Teléfono nuevo</th>
                    <th>Dirección anterior</th>
                    <th>Dirección nueva</th>
                    <th>Usuario</th>
                </thead>
            </table>

            <div class="col-xs-12 text-center no-padding margin-top-20">
                <a class="btn btn-success btn-radius" id="btn-exportar"><i class="fa fa-file-excel-o margin-right-10"></i> Exportar</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/historial_empresario/index.js')}}"></script>
    <script>
        $(function () {

            var cols = [
                {data: 'fecha', name:'fecha'},
				{data: 'orden', name:'orden'},
                {data: 'nombres_anterior', name:'nombres_anterior'},
                {data: 'nombres_nuevo', name:'nombres_nuevo'},
                {data: 'apellidos_anterior', name:'apellidos_anterior'},
                {data: 'apellidos_nuevo', name:'apellidos_nuevo'},
                {data: 'email_anterior', name:'email_anterior'},
                {data: 'email_nuevo', name:'email_nuevo'},
                {data: 'telefono_anterior', name:'telefono_anterior'},
                {data: 'telefono_nuevo', name:'telefono_nuevo'},
                {data: 'direccion_anterior', name:'direccion_anterior'},
                {data: 'direccion_nueva', name:'direccion_nueva'},
                {data: 'usuario', name:'usuario'},
            ];

            setCols(cols);
            cargarTablaHistorialEmpresario();
        })
    </script>
@stop


