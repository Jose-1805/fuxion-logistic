@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Regiones</p>

           <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-regiones'])
            </div>

            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#departamentos" aria-controls="departamentos" role="tab" data-toggle="tab">Departamentos</a></li>
                    <li role="presentation" class=""><a href="#ciudades" aria-controls="ciudades" role="tab" data-toggle="tab">Ciudades</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane padding-top-30 active" id="departamentos">
                        @include('region.regiones.departamentos')
                    </div>

                    <div role="tabpanel" class="tab-pane padding-top-30" id="ciudades">
                        @include('region.regiones.ciudades')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-departamento" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Departamento</h4>
                </div>
                <div class="modal-body row">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-sm btn-primary" id="btn-guardar-departamento">Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-eliminar-departamento" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar departamento</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-xs-12">
                        <p>Se eliminará también toda la información relacionada con el departamento (ej. ciudades)</p>
                        <p>¿Desea eliminar el departamento?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">No</a>
                    <a class="btn btn-sm btn-danger" id="btn-eliminar-departamento">Si</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-ciudad" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Ciudad</h4>
                </div>
                <div class="modal-body row">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-sm btn-primary" id="btn-guardar-ciudad">Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-eliminar-ciudad" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Eliminar ciudad</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-xs-12">
                        <p>Se eliminará también toda la información relacionada con la ciudad (ej. empresarios)</p>
                        <p>¿Desea eliminar el ciudad?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">No</a>
                    <a class="btn btn-sm btn-danger" id="btn-eliminar-ciudad">Si</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/region/index.js')}}"></script>
    <script>
        $(function () {
            cargarTablaDepartamentos();
            cargarTablaCiudades();
        })
    </script>
@stop


