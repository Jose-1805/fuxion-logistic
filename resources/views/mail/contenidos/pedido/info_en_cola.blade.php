<div style="width: 100%;">
    <ul>
        <li><p>Tu orden N° <strong>{{$pedido->orden_id}}</strong></p></li>
        <li><p>Fecha <strong>{{$pedido->fecha_orden}}</strong></p></li>
        <li><p>Factura <strong>{{$pedido->serie.'-'.$pedido->correlativo}}</strong></p></li>
        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>
    </ul>
</div>