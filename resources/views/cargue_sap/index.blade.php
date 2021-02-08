@extends('layouts.app')
@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Cargue a SAP</p>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-cargue-sap'])
            </div>
            <table id="tabla-pedidos" class="table-hover">
                <thead>
                    <th>Fecha de orden</th>
                    <th>Fecha de impresión</th>
                    <th>Serie</th>
                    <th>Correlativo</th>
                    <th>No. orden</th>
                    <th>Impreso por</th>
                    <th>Tipo de empresario</th>
                    <th>Empresario id</th>
                    <th>Opciones</th>
                </thead>
            </table>
        </div>
    </div>

    <div id="modal-confirmar-cargue" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de cargar este pedido a SAP?</p>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <a class="btn btn-sm btn-primary" data-dismiss="modal">No</a>
                            <a class="btn btn-sm btn-danger" id="btn-action-cargue">Si</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/cargue_sap/index.js')}}"></script>
    <script>
        $(function () {

            var cols = [
                {data: 'fecha_orden', name: 'fecha_orden'},
                {data: 'fecha_impresion', name: 'fecha_impresion'},
                {data: 'serie', name: 'serie'},
                {data: 'correlativo', name: 'correlativo'},
                {data: 'orden_id', name: 'orden_id'},
                {data: 'impreso_por', name: 'impreso_por'},
                {data: 'tipo_empresario', name: 'tipo_empresario'},
                {data: 'empresario_id', name: 'empresario_id'},
                {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
            ];

            setCols(cols);
            cargarTablaPedidos();
        })
    </script>
@stop


