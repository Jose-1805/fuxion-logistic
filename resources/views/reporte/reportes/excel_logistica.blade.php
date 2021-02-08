<table id="tabla-reporte-logistica" class="dataTable table-hover">
    <thead>
        <th>Fecha orden</th>
        <th>Factura</th>
        <th>Orden Id</th>
        <th>Empresario Id</th>
		<th>Guia</th>
        <th>Fecha de proceso</th>
        <th>Fecha de envio</th>
        <th>Fecha de entrega</th>
        <th>Fecha de devolución</th>
        <th>Operador logístico</th>
        <th>Ciudad</th>
        <th>Departamento</th>
        <th>Estado</th>
        <th>Descripción</th>
    </thead>
    <tbody>
        <tr>
            <td>Fecha orden</td>
            <td>Factura</td>
            <td>Orden Id</td>
            <td>Empresario Id</td>
			<td>Guia</td>
            <td>Fecha de proceso</td>
            <td>Fecha de envio</td>
            <td>Fecha de entrega</td>
            <td>Fecha de devolución</td>
            <td>Operador logístico</td>
            <td>Ciudad</td>
            <td>Departamento</td>
            <td>Estado</td>
            <td>Descripción</td>
        </tr>
        @forelse($reporte as $r)
            <tr>
                <td>{{$r->fecha_orden}}</td>
                <td>{{$r->factura}}</td>
                <td>{{$r->orden_id}}</td>
                <td>{{$r->empresario_id}}</td>
				<td>{{$r->numero_guia}}</td>
                <td>{{$r->fecha_proceso}}</td>
                <td>{{$r->fecha_envio}}</td>
                <td>{{$r->fecha_entregado}}</td>
                <td>{{$r->fecha_devolucion}}</td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->ciudad}}</td>
                <td>{{$r->departamento}}</td>
                <td>{{$r->estado}}</td>
                <td>{{$r->descripcion}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="13">No existe información para mostrar</td>
            </tr>
        @endforelse
    </tbody>
</table>