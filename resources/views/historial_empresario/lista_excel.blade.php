<table>
    <thead>
    <th>Fecha</th>
	<th>Orden</th>
    <th>Nombre anterior</th>
    <th>Nombre nuevo</th>
    <th>Apellido anterior</th>
    <th>Apellido nuevo</th>
    <th>Teléfono anterior</th>
    <th>Teléfono nuevo</th>
    <th>Dirección anterior</th>
    <th>Dirección nueva</th>
    <th>Usuario</th>
    </thead>
    <tbody>
    <tr>
        <td>Fecha</td>
		<td>Orden</td>
        <td>Nombre anterior</td>
        <td>Nombre nuevo</td>
        <td>Apellido anterior</td>
        <td>Apellido nuevo</td>
        <td>Email anterior</td>
        <td>Email nuevo</td>
        <td>Teléfono anterior</td>
        <td>Teléfono nuevo</td>
        <td>Dirección anterior</td>
        <td>Dirección nueva</td>
        <td>Usuario</td>
    </tr>
    @forelse($historial_empresarios as $h_e)
        <tr>
            <td>{{$h_e->fecha}}</td>
			<td>{{$h_e->orden}}</td>
            <td>{{$h_e->nombres_anterior}}</td>
            <td>{{$h_e->nombres_nombre}}</td>
            <td>{{$h_e->apellidos_anterior}}</td>
            <td>{{$h_e->apellidos_nuevo}}</td>
            <td>{{$h_e->email_anterior}}</td>
            <td>{{$h_e->email_nuevo}}</td>
            <td>{{$h_e->telefono_anterior}}</td>
            <td>{{$h_e->telefono_nuevo}}</td>
            <td>{{$h_e->direccion_anterior}}</td>
            <td>{{$h_e->direccion_nueva}}</td>
            <td>{{$h_e->usuario}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No existe información para mostrar</td>
        </tr>
    @endforelse
    </tbody>
</table>