<div class="row">
    <table class="table-hover no-footer dataTable">
        <thead>
            <th>Fecha</th>
			<th>Operador</th>
            <th>Recibido por</th>
			<th>Estado</th>
            <th>Descripción</th>
        </thead>
        <tbody>
            @forelse($trackings as $tracking)
                <tr>
                    <td>{{$tracking->fecha}}</td>
					<td>{{$tracking->nombre}}</td>
                    <td>{{$tracking->quien_recibe}}</td>
                    <td>{{$tracking->estado}}</td>
					<td>{{$tracking->descripcion}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No se han encontrado resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="col-xs-12 text-right margin-top-20">
        <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
    </div>
</div>