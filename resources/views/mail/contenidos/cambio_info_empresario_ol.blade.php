<p>Señores {{$operador_logistico->nombre}}</p>
<p>Por favor su ayuda con el cambio de los datos del destinatario, de la guía No. {{$guia->numero}}</p>
@foreach($datos_cambiados as $key => $value)
<div>
<p><strong>{{$key}}:</strong> {{$value}}</p>
</div>
@endforeach
<p>Saludes cordiales</p>
<p>Soporte Fuxion</p>