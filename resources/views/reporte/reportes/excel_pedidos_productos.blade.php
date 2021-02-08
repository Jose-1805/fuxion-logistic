<table id="tabla-reporte-pedidos-productos" class="dataTable table-hover">
    <thead>
    <th>Fecha orden</th>
    <th>Factura</th>
    <th>Orden Id</th>
    <th>Empresario Id</th>
    <th>Número de corte</th>
    <th>Código de producto</th>
    <th>Descripción de producto</th>
    <th>Cantidad</th>
    <th>Precio unitario</th>
    <th>Precio total</th>
    <th>Estado</th>
    <th>Razón de estado</th>
    </thead>
    <tbody>
        <tr>
            <td>Fecha orden</td>
            <td>Factura</td>
            <td>Orden Id</td>
            <td>Empresario Id</td>
            <td>Número de corte</td>
            <td>Código de producto</td>
            <td>Descripción de producto</td>
            <td>Cantidad</td>
            <td>Precio unitario</td>
            <td>Precio total</td>
            <td>Estado</td>
            <td>Razón de estado</td>
        </tr>
        @forelse($reporte as $r)
            <tr>
                <td>{{$r->fecha_orden}}</td>
                <td>{{$r->factura}}</td>
                <td>{{$r->orden_id}}</td>
                <td>{{$r->empresario_id}}</td>
                <td>{{$r->numero_corte}}</td>
                <td>{{$r->codigo_producto}}</td>
                <td>{{$r->descripcion_producto}}</td>
                <td>{{$r->cantidad}}</td>
                <td>{{$r->precio_unitario}}</td>
                <td>{{$r->precio_total}}</td>
                <td>{{$r->estado}}</td>
                <td>{{$r->razon_estado}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12">No existe información para mostrar</td>
            </tr>
        @endforelse
    </tbody>
</table>