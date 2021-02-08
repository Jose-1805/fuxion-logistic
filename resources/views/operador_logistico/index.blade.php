@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Operadores logísticos</p>

            <div class="contenedor-opciones-vista">

            </div>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-operador-logistico'])
            </div>

            <table id="tabla-operadores-logisticos" class="table-hover">
                <thead>
                <th>Nombre</th>
                <th>Prefijo</th>
                <th>Contacto</th>
                <th>Web service</th>
                <th>Ciudad</th>
                @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(7,[2,3],false,$privilegio_superadministrador))
                    <th class="text-center">Opciones</th>
                @endif
                </thead>
            </table>

            <div class="col-xs-12 text-center margin-top-20">
                @if(Auth::user()->tieneFuncion(7, 2, $privilegio_superadministrador))
                    <a href="{{url('/operador-logistico/nombres-regiones')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-tags margin-right-10"></i>Nombres Regiones</a>
                @endif

                @if(Auth::user()->tieneFuncion(7, 1, $privilegio_superadministrador))
                    <a href="{{url('/operador-logistico/crear')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-plus margin-right-10"></i>Nuevo</a>
                @endif
            </div>
        </div>
    </div>

    <div id="modal-eliminar-operador-logistico" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar este operador logístico?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-action-eliminar-operador-logistico">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/operador_logistico/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(7,[2,3],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {
            if(tiene_opciones){
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'prefijo', name: 'prefijo'},
                    {data: 'contacto', name: 'contacto'},
                    {data: 'ws', name: 'ws'},
                    {data: 'ciudad', name: 'ciudad'},
                    {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
                ];
            }else{
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'prefijo', name: 'prefijo'},
                    {data: 'contacto', name: 'contacto'},
                    {data: 'ws', name: 'ws'},
                    {data: 'ciudad', name: 'ciudad'},
                ]
            }
            setCols(cols);
            cargarTablaOperadoresLogisticos();
        })
    </script>
@stop


