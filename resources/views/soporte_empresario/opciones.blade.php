<?php
    $active = 'active';
    $contador_opciones = 0;
    $demo = false;
?>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @if($estado->nombre == 'Novedad' || $demo)
            <li role="presentation" class="active"><a href="#empresario" aria-controls="empresario" role="tab" data-toggle="tab">Empresario</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por devolicion' || $demo)
            <li role="presentation" class=""><a href="#devolucion" aria-controls="devolucion" role="tab" data-toggle="tab">Devolución</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por kit' || $demo)
            <li role="presentation" class=""><a href="#kit_afiliacion" aria-controls="kit_afiliacion" role="tab" data-toggle="tab">Kit de afiliación</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && ($estado->razon_estado == 'Pendiente por flete' || $estado->razon_estado == 'Carga a SAP') || $demo)
            <li role="presentation" class=""><a href="#flete" aria-controls="flete" role="tab" data-toggle="tab">Flete</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if(
            (Auth::user()->rol->nombre == 'Bodega' || Auth::user()->rol->nombre == 'Logistica')
            && $estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por productos'
            || $demo
        )
            <li role="presentation" class=""><a href="#pendiente_producto" aria-controls="pendiente_producto" role="tab" data-toggle="tab">Pendiente por producto</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if(Auth::user()->rol->nombre == 'Soporte' &&
            (
                $estado->asignacion_corte == 'si'
                || ($estado->no_asignacion_corte == 'si' &&
                        (
                            $estado->razon_estado == 'Pendiente por kit'
                            || $estado->razon_estado == 'Pendiente por flete'
                            || $estado->razon_estado == 'Pendiente por productos'
                            || $estado->razon_estado == 'Pendiente por numero de guía'
                        )
                    )
            ) || $demo
        )
            <li role="presentation" class=""><a href="#anulado_soporte" aria-controls="anulado_soporte" role="tab" data-toggle="tab">Anulado soporte</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if(Auth::user()->rol->nombre == 'Logistica' && $estado->nombre == 'Anulado soporte' || $demo)
            <li role="presentation" class=""><a href="#anulado" aria-controls="anulado" role="tab" data-toggle="tab">Anulado</a></li>
            <?php
                $contador_opciones++;
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por pedido' || $demo)
            <li role="presentation" class=""><a href="#pendiente_pedido" aria-controls="pendiente_pedido" role="tab" data-toggle="tab">Pendiente por pedido</a></li>
            <?php
            $contador_opciones++;
            ?>
        @endif
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @if($estado->nombre == 'Novedad' || $demo)
            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="empresario">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-empresario'])
                </div>
                {!! Form::open(['id'=>'form-empresario','class'=>'']) !!}
                    @include('soporte_empresario.opciones.empresario')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por devolucion' || $demo)
            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="devolucion">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-flete-devolucion'])
                </div>
                {!! Form::open(['id'=>'form-flete-devolucion','class'=>'form-horizontal']) !!}
                    @include('soporte_empresario.opciones.devolucion')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por kit' || $demo)
            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="kit_afiliacion">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-kit'])
                </div>
                {!! Form::open(['id'=>'form-kit','class'=>'']) !!}
                    @include('soporte_empresario.opciones.kit')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && ($estado->razon_estado == 'Pendiente por flete' || $estado->razon_estado == 'Carga a SAP') || $demo)
            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="flete">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-flete'])
                </div>
                {!! Form::open(['id'=>'form-flete','class'=>'form-horizontal']) !!}
                    @include('soporte_empresario.opciones.flete')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

            @if(
                (Auth::user()->rol->nombre == 'Bodega' || Auth::user()->rol->nombre == 'Logistica')
                && $estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por productos'
                || $demo
            )
            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="pendiente_producto">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-pendiente-producto'])
                </div>
                {!! Form::open(['id'=>'form-pendiente-producto','class'=>'']) !!}
                    @include('soporte_empresario.opciones.pendiente_producto')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

        @if(Auth::user()->rol->nombre == 'Soporte' &&
            (
                $estado->asignacion_corte == 'si'
                || ($estado->no_asignacion_corte == 'si' &&
                        (
                            $estado->razon_estado == 'Pendiente por kit'
                            || $estado->razon_estado == 'Pendiente por flete'
                            || $estado->razon_estado == 'Pendiente por productos'
                            || $estado->razon_estado == 'Pendiente por numero de guía'
                        )
                    )
            ) || $demo
        )
            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="anulado_soporte">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-anulado-soporte'])
                </div>
                {!! Form::open(['id'=>'form-anulado-soporte','class'=>'']) !!}
                    @include('soporte_empresario.opciones.anulado_soporte')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

        @if(Auth::user()->rol->nombre == 'Logistica' && $estado->nombre == 'Anulado soporte' || $demo)

            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="anulado">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-anulado'])
                </div>
                {!! Form::open(['id'=>'form-anulado','class'=>'']) !!}
                    @include('soporte_empresario.opciones.anulado')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif

        @if($estado->no_asignacion_corte == 'si' && $estado->razon_estado == 'Pendiente por pedido' || $demo)

            <div role="tabpanel" class="tab-pane padding-top-30 {{$active}}" id="pendiente_pedido">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-pendiente-pedido'])
                </div>
                {!! Form::open(['id'=>'form-pendiente-pedido','class'=>'']) !!}
                    @include('soporte_empresario.opciones.pendiente_pedido')
                {!! Form::close() !!}
            </div>
            <?php
                $active = '';
            ?>
        @endif
    </div>

    @if($contador_opciones <= 0)
        <div class="row">
            <p class="text-center">El estado del pedido seleccionado no permite realizar ningún cambio</p>
            <div class="col-xs-12 text-right margin-top-20">
                <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    @endif
</div>
@if($estado->razon_estado == 'Pendiente por flete' || $estado->razon_estado == 'Pendiente por pedido'
 || $estado->razon_estado == 'Pendiente por productos' || $estado->razon_estado == 'Pendiente por kit' || $demo)
    <div id="modal-aprobacion-entregado-tienda" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Confirmación</h4>
            </div>
            <div class="modal-body row" id="">
                <p class="col-xs-12">¿Está seguro de cambiar el estado del pedido e 'Entregado en Tienda'?</p>
                <div class="col-xs-12 text-right">
                    <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-primary" id="btn-entregado-tienda-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif