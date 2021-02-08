
{!! $spaces  !!}

<h2 style="text-align: center;" >MENSAJE IMPORTANTE</h2>
{!! $spaces  !!}

<p {{ $estilo  }} ><b>Estimad@</b></p>

<p {{ $estilo  }} ><b>Teniendo en cuenta la gran demanda de
    nuestros productos, en tu pedido número
    {{ $pedido->orden_id  }} no fué
    posible enviar el/los siguientes productos:</b></p>

@foreach ($productos as $producto)
    @if($producto->codigo!=='DSCT' && $producto->pedido_id==$pedido->pedido_id)
        <?php


            $contador = \Illuminate\Support\Facades\DB::select("select cantidad from productos_enviados pe where producto_id='".$producto->producto_id."' and guia_pedido_id='".$pedido->gp_id."' ");
            if(count($contador)>0){
                //echo "select cantidad from productos_enviados pe where producto_id='".$producto->producto_id."' and guia_pedido_id='".$pedido->gp_id."' ";
                ?>
                <p {{ $estilo  }} ><strong>PROD : {{ $producto->descripcion }}</strong></p>
                <p {{ $estilo  }} ><strong>CANT : {{ $producto->cantidad - $contador[0]->cantidad  }}</strong></p>
        <?php
            }

        ?>

    @endif

@endforeach

<p {{ $estilo  }} ><b>PROLIFE BIOTECH COLOMBIA S.A.S.,
    ofrece mil disculpas por los inconvenientes
    causados. Los productos relacionados serán
    enviados en los próximos días sin cargos
    adicionales, por lo cual recibirás un mensaje
    vía email a la dirección registrada indicándote
    los datos del nuevo envío.</b></p>
<p {{ $estilo  }} ><b>Gracias por tu comprensión.</b></p>
<p {{ $estilo  }} ><b>Prolife Biotech Colombias S.A.S
    FuXion</b></p>
<h3>{{ $centrado }} <strong> Mejoramos tu vida </strong> {{ $centrado  }}</h3>

