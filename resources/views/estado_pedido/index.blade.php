@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Estados de pedidos</p>

            <div class="contenedor-opciones-vista">
            </div>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-estados-pedidos'])
            </div>

            <table id="tabla-estados-pedidos" class="table-hover">
                <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Notificación push</th>
                <th>Notificacion correo</th>
                <th>Plantilla de correo</th>
                @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(10,[3,2],false,$privilegio_superadministrador))
                    <th class="text-center">Opciones</th>
                @endif
                </thead>
            </table>

            @if(Auth::user()->tieneFuncion(10, 1, $privilegio_superadministrador))
                <div class="col-xs-12 margin-top-20 text-center">
                    <a href="{{url('/estado-pedido/crear')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-plus margin-right-10"></i>Nuevo</a>
                </div>
            @endif
        </div>
    </div>

    <div id="modal-eliminar-estado-pedido" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar este estado de pedido?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-action-eliminar-estado-pedido">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/estado_pedido/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(10,[3,2],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {

            if(tiene_opciones){
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'descripcion', name: 'descripcion'},
                    {data: 'notificacion_push', name: 'notificacion_push'},
                    {data: 'notificacion_correo', name: 'notificacion_correo'},
                    {data: 'plantilla_correo', name: 'plantilla_correo'},
                    {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
                ];
            }else{
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'descripcion', name: 'descripcion'},
                    {data: 'notificacion_push', name: 'notificacion_push'},
                    {data: 'notificacion_correo', name: 'notificacion_correo'},
                    {data: 'plantilla_correo', name: 'plantilla_correo'},
                ]
            }

            setCols(cols);
            cargarTablaEstadosPedidos();
        })
    </script>
@stop


