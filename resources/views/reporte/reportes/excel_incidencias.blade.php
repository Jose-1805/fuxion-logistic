<table id="tabla-reporte-incidencias" class="dataTable table-hover">
    <thead>
        <th>Fecha orden</th>
        <th>Factura</th>
        <th>Orden Id</th>
        <th>Empresario Id</th>
		<th>Guia</th>
        <th>Fecha novedad</th>
        <th>Descripción</th>
    </thead>
    <tbody>
        <tr>
            <td>Fecha orden</td>
            <td>Factura</td>
            <td>Orden Id</td>
            <td>Empresario Id</td>
			<td>Guia</td>
            <td>Fecha novedad</td>
            <td>Descripción</td>
        </tr>
        @forelse($reporte as $r)
            <tr>
                <td>{{$r->fecha_orden}}</td>
                <td>{{$r->factura}}</td>
                <td>{{$r->orden_id}}</td>
                <td>{{$r->empresario_id}}</td>
				<td>{{$r->numero_guia}}</td>
                <td>{{$r->fecha_novedad}}</td>
                <td>{{$r->descripcion}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No existe información para mostrar</td>
            </tr>
        @endforelse
    </tbody>
</table>