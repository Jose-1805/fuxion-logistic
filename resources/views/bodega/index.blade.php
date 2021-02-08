@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Bodegas</p>

            <div class="contenedor-opciones-vista">

            </div>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-bodega'])
            </div>

            <table id="tabla-bodegas" class="table-hover">
                <thead>
                <th>Nombre</th>
                <th>alias</th>
                <th>Prefijo facturación</th>
                <th>ciudad</th>
                <th>Dirección</th>
                @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(5,[2],false,$privilegio_superadministrador))
                    <th class="text-center">Opciones</th>
                @endif
                </thead>
            </table>

            @if(Auth::user()->tieneFuncion(5, 1, $privilegio_superadministrador))
                <div class="col-xs-12 text-center">
                    <a href="{{url('/bodega/crear')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-plus margin-right-10"></i> Nuevo</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/bodega/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(5,[2],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {

            if(tiene_opciones){
                var cols = [
                    {data: 'nombre', name: 'identificacion'},
                    {data: 'alias', name: 'email'},
                    {data: 'prefijo_facturacion', name: 'nombre'},
                    {data: 'ciudad', name: 'telefono'},
                    {data: 'direccion', name: 'fecha_nacimiento'},
                    {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
                ];
            }else{
                var cols = [
                    {data: 'nombre', name: 'identificacion'},
                    {data: 'alias', name: 'email'},
                    {data: 'prefijo', name: 'nombre'},
                    {data: 'ciudad', name: 'telefono'},
                    {data: 'direccion', name: 'fecha_nacimiento'},
                ]
            }

            setCols(cols);
            cargarTablaCortes();
        })
    </script>
@stop


