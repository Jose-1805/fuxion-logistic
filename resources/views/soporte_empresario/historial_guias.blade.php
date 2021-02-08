<div class="row">
    <table class="table-hover no-footer dataTable">
        <thead>
            <th>Fecha</th>
            <th>No. Guia</th>
            <th>Factura</th>
            <th>Estado final</th>
        </thead>
        <tbody>
            @forelse($guias as $guia)
                <tr>
                    <td>{{$guia->created_at}}</td>
                    <td>{{$guia->numero}}</td>
                    <td>{{$guia->serie.' '.$guia->correlativo}}</td>
                    <td>{{$guia->estado}}</td>
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