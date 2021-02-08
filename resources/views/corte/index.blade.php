@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Cortes</p>

            <div class="contenedor-opciones-vista">

            </div>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'corte'])
            </div>

            <table id="tabla-cortes" class="table-hover">
                <thead>
                    <th>Número</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Pedidos</th>
                    @if(Auth::user()->tieneFunciones('4',[4],false,$privilegio_superadministrador))
                        <th>Opciones</th>
                    @endif
                </thead>
            </table>

            @if(Auth::user()->tieneFuncion(4,5, $privilegio_superadministrador))
                <div class="col-xs-12 text-center margin-top-20">
                    <a href="{{url('corte/importar')}}" type="button" class="btn btn-radius btn-success"><i class="fa fa-plus margin-right-5"></i> Nuevo</a>
                </div>
            @endif
        </div>
    </div>

    <div id="modal-eliimnar-corte" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar este corte?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-action-eliminar-corte">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    <script src="{{asset('js/corte/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(4,[4],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {
            if(tiene_opciones){
                var cols = [
                    {data: 'numero', name: 'orden_id', "className": "text-center"},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'estado', name: 'numero_corte', "className": "text-center"},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'pedidos', name: 'pedidos', "className": "text-center"},
                    {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
                ];
            }else{
                var cols = [
                    {data: 'numero', name: 'orden_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'estado', name: 'numero_corte'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'pedidos', name: 'pedidos'},
                ];
            }

            setCols(cols);
            cargarTablaCortes();
        })
    </script>
@stop


