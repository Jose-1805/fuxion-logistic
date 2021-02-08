@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Malla de cobertura</p>

            <div class="contenedor-opciones-vista">
            </div>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-malla-cobertura'])
            </div>

            <table id="tabla-mallas-cobertura" class="table-hover">
                <thead>
                <th>Origen</th>
                <th>Destino</th>
                <th>Tiempo de entrega</th>
                <th>Operador logístico</th>
                @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(8,[2,3],false,$privilegio_superadministrador))
                    <th class="text-center">Opciones</th>
                @endif
                </thead>
            </table>

            <div class="col-xs-12 text-center margin-top-20">
                @if(Auth::user()->tieneFuncion(8, 5, $privilegio_superadministrador))
                    <a href="{{url('/malla-cobertura/importar')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-upload margin-right-10"></i> Importar</a>
                @endif

                @if(Auth::user()->tieneFuncion(8, 1, $privilegio_superadministrador))
                    <a href="{{url('/malla-cobertura/crear')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-plus margin-right-10"></i>Nuevo</a>
                @endif
            </div>
        </div>
    </div>

    <div id="modal-eliminar-malla-cobertura" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar esta malla de cobertura?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-action-eliminar-malla-cobertura">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/malla_cobertura/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(8,[2,3],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {
            if(tiene_opciones){
                var cols = [
                    {data: 'origen', name: 'origen'},
                    {data: 'destino', name: 'destino'},
                    {data: 'tiempo_entrega', name: 'tiempo_entrega'},
                    {data: 'operador_logistico', name: 'operador_logistico'},
                    {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
                ];
            }else{
                var cols = [
                    {data: 'origen', name: 'origen'},
                    {data: 'destino', name: 'destino'},
                    {data: 'tiempo_entrega', name: 'tiempo_entrega'},
                    {data: 'operador_logistico', name: 'operador_logistico'},
                ]
            }
            setCols(cols);
            cargarTablaMallasCobertura();
        })
    </script>
@stop


