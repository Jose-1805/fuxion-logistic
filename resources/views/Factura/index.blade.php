
<?php


$spaces = "<strong>:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::</strong>";
$centrado = "::::::::::::::";
$estilo = " style='font-size:30px; '"; 
?>
        <body style="width:680px; overflow: hidden; font-family:'Times New Roman'; "  >

@foreach ($pedidos as $pedido)

@if($cambio)
    @include('factura.factura')



@elseif($cambio==false)
    @if($pedido->razon_estado=='Pendiente por productos')
        @include('factura.carta2')

    @elseif($cambio==false && is_null($pedido->razon_estado)  && $pedido->estado_pedido_id!='11' )
        @include('factura.factura')

    @endif
@endif


@endforeach

        </body>


<?php

        ?>


