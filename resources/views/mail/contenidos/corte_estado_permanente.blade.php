<p>Los siguientes cortes se encuentran en estado abierto desde hace más de 24 horas.</p>
<table class="table" style="margin: 0 auto;">
<thead>
<th>No. de corte</th>
<th>Fecha de creacion</th>
</thead>
<tbody>
@foreach($cortes as $corte)
<tr>
<td class="text-center">{{$corte->numero}}</td>
<td class="text-center">{{$corte->created_at}}</td>
</tr>
@endforeach
</tbody>
</table>