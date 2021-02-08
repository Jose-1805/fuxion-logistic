<table id="tabla-reporte-incidencias" class="dataTable table-hover">
    <thead>
    <th>Fecha</th>
    <th>orden</th>
    <th>Acción</th>
    <th>No. Factura</th>
    <th>Usuario</th>
    </thead>
    <tbody>
    <tr>
        <td>Fecha</td>
        <td>orden</td>
        <td>Acción</td>
        <td>No. Factura</td>
        <td>Usuario</td>
    </tr>
    @forelse($reporte as $r)
        <tr>
            <td>{{$r->fecha}}</td>
            <td>{{$r->orden}}</td>
            <td>{{$r->accion}}</td>
            <td>{{$r->no_factura}}</td>
            <td>{{$r->usuario}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No existe información para mostrar</td>
        </tr>
    @endforelse
    </tbody>
</table>