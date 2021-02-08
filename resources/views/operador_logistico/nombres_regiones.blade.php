@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Nombres de regiones para operadores logísticos</p>

           <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-nombres-regiones'])
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
                        @include('operador_logistico.nombres_regiones.departamentos')
                    </div>

                    <div role="tabpanel" class="tab-pane padding-top-30" id="ciudades">
                        @include('operador_logistico.nombres_regiones.ciudades')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-nombres-departamentos" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Nombres establecidos</h4>
                </div>
                <div class="modal-body row">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-sm btn-primary" id="btn-guardar-nombres-departamentos">Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-nombres-ciudades" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Nombres establecidos</h4>
                </div>
                <div class="modal-body row">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-sm btn-primary" id="btn-guardar-nombres-ciudades">Guardar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/operador_logistico/nombres_regiones.js')}}"></script>
    <script>
        $(function () {
            var cols_departamentos = [
                {data: 'departamento', name: 'departamento'}
            ];

            @foreach($operadores_logisticos as $ol)
                cols_departamentos.push({data: '{{$ol->nombre}}', name: '{{$ol->nombre}}'});
            @endforeach
            cols_departamentos.push({data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"});

            setColsDepartamentos(cols_departamentos);
            cargarTablaDepartamentos();
        })
    </script>
    <script>
        $(function () {
            var cols_ciudades = [
                {data: 'ciudad', name: 'ciudad'}
            ];

            @foreach($operadores_logisticos as $ol)
                cols_ciudades.push({data: '{{$ol->nombre}}', name: '{{$ol->nombre}}'});
            @endforeach
            cols_ciudades.push({data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"});

            setColsCiudades(cols_ciudades);
            cargarTablaCiudades();
        })
    </script>
@stop


