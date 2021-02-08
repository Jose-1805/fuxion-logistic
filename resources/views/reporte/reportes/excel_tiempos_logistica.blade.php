<table id="tabla-reporte-tiempos-logistica" class="dataTable table-hover">
    <thead>
        <th>Fecha orden</th>
        <th>Factura</th>
        <th>Orden Id</th>
        <th>Empresario Id</th>
		<th>Guia</th>
        <th>Tiempo de salida de bodega</th>
        <th>Tiempo de entrega</th>
        <th>Ciudad</th>
        <th>Departamento</th>
        <th>Operador logístico</th>
    </thead>
    <tbody>
        <tr>
            <td>Fecha orden</td>
            <td>Factura</td>
            <td>Orden Id</td>
            <td>Empresario Id</td>
			<td>Guia</td>
            <td>Tiempo de salida de bodega</td>
            <td>Tiempo de entrega</td>
            <td>Ciudad</td>
            <td>Departamento</td>
            <td>Operador logístico</td>
        </tr>
        @forelse($reporte as $r)
            <tr>
                <td>{{$r->fecha_orden}}</td>
                <td>{{$r->factura}}</td>
                <td>{{$r->orden_id}}</td>
                <td>{{$r->empresario_id}}</td>
				<td>{{$r->numero_guia}}</td>
                <td>{{$r->tiempo_salida_bodega/24}}</td>
                <td>{{$r->tiempo_entrega/24}}</td>
                <td>{{$r->ciudad}}</td>
                <td>{{$r->departamento}}</td>
                <td>{{$r->nombre}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No existe información para mostrar</td>
            </tr>
        @endforelse
    </tbody>
</table>