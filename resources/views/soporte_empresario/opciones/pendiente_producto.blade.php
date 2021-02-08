{!! Form::hidden('pedido',$pedido->id,['id'=>'pedido']) !!}
<div class="row">
    <p class="col-xs-12">
        El pedido seleccionado presenta un estado de 'pendiente' con razón de estado 'pendiente por producto', al
        hacer click sobre el botón aceptar indicará al sistema que los productos pendientes en este pedido ya se encuentran
        disponibles y el pedido estará listo para ser agregado al siguiente corte.
    </p>
    <div class="col-xs-12 text-right margin-top-20">
        <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
        @if($estado->razon_estado == 'Pendiente por productos' || $demo)
            <a class="btn btn-primary" id="btn-entregado-tienda">Entregado en tienda</a>
        @endif
        <a class="btn btn-primary" id="btn-pendiente-producto">Aceptar</a>
    </div>
</div>

<div id="modal-aprobacion-pendiente-producto" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Confirmación</h4>
            </div>
            <div class="modal-body row" id="">
                <p class="col-xs-12">¿Está seguro de cambiar el estado del pedido?</p>
                <div class="col-xs-12 text-right">
                    <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-primary" id="btn-pendiente-producto-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>