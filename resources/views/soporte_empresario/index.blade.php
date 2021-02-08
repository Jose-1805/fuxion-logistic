@extends('layouts.app')
<?php
    $estados = \FuxionLogistic\Models\EstadoPedido::pluck('nombre','id')->toArray();
    $razones_de_estado = [
        ''=>'Seleccione una razón de estado de pedido',
        'Pendiente por productos'=>'Pendiente por productos',
        'Pendiente por devolucion'=>'Pendiente por devolucion',
        'Pendiente por kit'=>'Pendiente por kit',
        'Pendiente por flete'=>'Pendiente por flete',
        'Pendiente por pedido'=>'Pendiente por pedido',
        'Pendiente por numero de guía'=>'Pendiente por numero de guía',
        'Ingresado a bodega'=>'Ingresado a bodega',
        'Carga a SAP'=>'Carga a SAP',
        'sin razón de estado'=>'Sin razón de estado'
    ];
?>
@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Soporte a empresario</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-soporte-empresario'])
            </div>

            <div class="row margin-bottom-10">
                <div class="col-md-4 col-md-offset-4 col-lg-3 col-lg-offset-6">
                    {!! Form::label('estado','Estado') !!}
                    {!! Form::select('estado',[''=>'Seleccione un estado de pedido']+$estados,null,['id'=>'estado','class'=>'form-control campo-filtro']) !!}
                </div>
                <div class="col-md-4 col-lg-3">
                    {!! Form::label('razon_estado','Razón de estado') !!}
                    {!! Form::select('razon_estado',$razones_de_estado,null,['id'=>'razon_estado','class'=>'form-control campo-filtro']) !!}
                </div>
            </div>
            <table id="tabla-pedidos" class="table-hover">
                <thead>
                    <th width="100">Fecha</th>
                    <th>Empresario</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>No. orden</th>
                    <th>Factura</th>
                    <th>No. Guia</th>
                    <th>Estado pedido</th>
                    <th>Estado guia</th>
                    <th>Opciones</th>
                </thead>
            </table>
        </div>
    </div>

    <div id="modal-soporte-empresario" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Modificar orden <span id="numero_orden"></span></h4>
                </div>
                <div class="modal-body" id="contenido-soporte-empresario">

                </div>
            </div>
        </div>
    </div>

    <div id="modal-historial-guias" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Historial de guías para orden <span id="historial_numero_orden"></span></h4>
                </div>
                <div class="modal-body" id="contenido-historial-guias">

                </div>
            </div>
        </div>
    </div>

    <div id="modal-imagenes-guias" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Imagenes de la guía</h4>
                </div>
                <div class="modal-body" id="contenido-imagenes-guias">

                </div>
            </div>
        </div>
    </div>
    
     <div id="modal-tracking" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Tracking de la guía</h4>
                </div>
                <div class="modal-body" id="contenido-tracking">

                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('js')
    @parent
    <script src="{{asset('js/soporte_empresario/index.js')}}"></script>
    <script>
        $(function () {

            var cols = [
                {data: 'fecha_orden', name: 'fecha_orden'},
                {data: 'empresario', name: 'empresario'},
                {data: 'direccion', name: 'direccion'},
                {data: 'ciudad', name: 'ciudad'},
                {data: 'orden_id', name: 'orden_id'},
                {data: 'factura', name: 'factura'},
                {data: 'numero_guia', name: 'numero_guia'},
                {data: 'estado_pedido', name: 'estado_pedido'},
                {data: 'estado_guia', name: 'estado_guia'},
                {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
            ];

            setCols(cols);
            cargarTablaPedidos();
        })
    </script>
@stop


