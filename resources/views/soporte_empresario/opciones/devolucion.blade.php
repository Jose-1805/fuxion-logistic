<?php
$facturas_fletes = \FuxionLogistic\Models\FacturaFlete::where('pedido_id',$pedido->id)->get();
?>
{!! Form::hidden('pedido',$pedido->id,['id'=>'pedido']) !!}
<div class="row">
    <p class="col-xs-12">
        Ingrese el número de la factura del flete adquirido por el usuario, una vez se registre, el pedido quedará
        habilitado para ser asignado al siguiente corte.
    </p>
    <div class="col-md-5">
        {!! Form::label('factura_flete','No. Factura flete',['class'=>'control-label']) !!}
        {!! Form::text('factura_flete',null,['id'=>'factura_flete','class'=>'form-control','maxLength'=>'150']) !!}
    </div>
    <div class="col-md-7">
        <p>Lista de facturas de flete anteriores</p>
        <table class="table-hover no-footer dataTable">
            <thead>
            <th>Fecha</th>
            <th>No. Factura</th>
            </thead>
            <tbody>
            @forelse($facturas_fletes as $fact)
                <tr>
                    <td>{{$fact->created_at}}</td>
                    <td>{{$fact->numero}}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="2">No se han encontrado resultados</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="col-xs-12 text-right margin-top-20">
        <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
        <a class="btn btn-primary" id="btn-devolucion">Guardar</a>
    </div>
</div>

<div id="modal-aprobacion-devolucion" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Confirmación</h4>
            </div>
            <div class="modal-body row" id="">
                <p class="col-xs-12">¿Está seguro de registrar esta factura de flete?</p>
                <div class="col-xs-12 text-right">
                    <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-primary" id="btn-devolucion-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>