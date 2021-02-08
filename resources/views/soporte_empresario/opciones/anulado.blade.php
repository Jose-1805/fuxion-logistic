{!! Form::hidden('pedido',$pedido->id,['id'=>'pedido']) !!}
<div class="row">
    <p class="col-xs-12">
        Al hacer click sobre el botón aceptar indicará al sistema que cambie el estado del pedido a anulado por logística.
    </p>
    <div class="col-xs-12 text-right margin-top-20">
        <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
        <a class="btn btn-primary" id="btn-anulado">Aceptar</a>
    </div>
</div>

<div id="modal-aprobacion-anulado" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Confirmación</h4>
            </div>
            <div class="modal-body row" id="">
                <p class="col-xs-12">¿Está seguro de cambiar el estado del pedido?</p>
                <div class="col-xs-12 text-right">
                    <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-primary" id="btn-anulado-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>