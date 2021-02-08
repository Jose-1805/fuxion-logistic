@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Plantillas de correo</p>

            <div class="contenedor-opciones-vista">
            </div>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-plantillas-correos'])
            </div>

            <table id="tabla-plantillas-correos" class="table-hover">
                <thead>
                <th>Nombre</th>
                <th>Asunto</th>
                @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(9,[3,2],false,$privilegio_superadministrador))
                    <th class="text-center">Opciones</th>
                @endif
                </thead>
            </table>

            @if(Auth::user()->tieneFuncion(9, 1, $privilegio_superadministrador))
                <div class="col-xs-12 text-center margin-top-20">
                    <a href="{{url('/plantilla-correo/crear')}}" type="button" class="btn btn-success btn-radius"><i class="fa fa-plus margin-right-10"></i>Nuevo</a>
                </div>
            @endif
        </div>
    </div>

    <div id="modal-eliminar-plantilla-correo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar esta plantilla de correo?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-action-eliminar-plantilla-correo">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/plantilla_correo/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones(9,[3,2],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {

            if(tiene_opciones){
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'asunto', name: 'asunto'},
                    {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
                ];
            }else{
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'asunto', name: 'asunto'},
                ]
            }

            setCols(cols);
            cargarTablaPlantillasCorreos();
        })
    </script>
@stop


