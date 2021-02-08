<h2 style="text-align: center; font-size:55px" >F U X I O N</h2>
<p style='font-size:32px; text-align: center' ><b>PROLIFE BIOTECH COLOMBIA SAS</b></p>
<p style='font-size:32px; text-align: center' ><b>NIT 900.413.155-0</b></p>
<p style='font-size:32px; text-align: center' ><b>{{ $pedido->direccion_factura  }}</b></p>
<p style='font-size:32px; text-align: center' ><b>COLOMBIA</b></p>

{!! $spaces  !!}
<?php
$inicial =$pedido->correlativo;
$ceros="00000000";//Variable que rellena los digitos faltantes para completar los ceros a la izquierda del número de factura
$ceros=substr($ceros,0,(strlen($ceros)-strlen($inicial)));
$date = new DateTime($pedido->fecha_orden);
$week = $date->format("W-Y");
$no_factura =$pedido->serie."-".$ceros.$inicial;

?>
<p {{ $estilo  }} ><b>FACTURA DE VENTA:{{ $no_factura }}</b></p>
<p {{ $estilo  }} ><b>FECHA:{{ $pedido->fecha_impresion  }}</b></p>
<p {{ $estilo  }} ><b>RESOLUCION DE FACTURACION</b></p>
<p {{ $estilo  }} ><b>Nº {{ $pedido->resolucion  }} de {{ $pedido->fecha_resolucion  }}</b></p>
<p {{ $estilo  }} ><b>REGIMEN COMUN Grandes Contribuyentes</b></p>
<p {{ $estilo  }} ><b>Según Res. 600076 de 01 de diciembre del 2016</b></p><!-- CONFIRMAR -->
<p {{ $estilo  }} ><b>FACTURADO POR: {{ $pedido->nombre_impreso  }}</b></p>
<p {{ $estilo  }} ><b>RANGO AUTORIZADO DE LA {{   $pedido->rango_desde  }} AL {{ $pedido->rango_hasta  }}</b></p>

{!! $spaces  !!}

<p {{ $estilo  }} ><b>TIPO EMPRESARIO: {{ $empresario[0]->tipo }}</b></p>
<p {{ $estilo  }} ><b>CLIENTE: {{ $empresario[0]->empresario_id." - ".$empresario[0]->nombres." ".$empresario[0]->apellidos  }}</b></p>
<p {{ $estilo  }} ><b>CC/RUNT/NIT: {{ $empresario[0]->identificacion  }}</b></p>
<p {{ $estilo  }} ><b>PAT: {{ $empresario[0]->enroler_id  }}</b></p>
<p {{ $estilo  }} ><b>SEMANA:{{ $week  }}</b></p><!-- CONFIRMAR A QUE FECHA SE CALCULA -->
<p {{ $estilo  }} ><b>N PEDIDO: {{ $pedido->orden_id  }}</b></p>
<p {{ $estilo  }} ><b>DESCUENTO: {{ $pedido->descuento }}% </b></p>

<!-- <h2>ESTADO:{{ $pedido->razon_estado  }}</h2> -->
{!! $spaces  !!}
<?php
$descuento='0';
$productos_enviados=[];
?>
<table style="width: 100%" >
    <tr style="font-size:26px;">
        <td><b>CANT</b></td>
        <td><b>PRODUCTO</b></td>
        <td><b>PU</b></td>
        <td><b>VALOR TOTAL</b></td>
    </tr>
    @foreach ($productos as $producto)
        @if($producto->codigo!=='DSCT' && $producto->pedido_id==$pedido->pedido_id)
            <?php
                //echo "select cantidad from productos_enviados pe where producto_id='".$producto->producto_id."' and guia_pedido_id='".$pedido->gp_id."' ";
                if($cambio){
                    $contador = \Illuminate\Support\Facades\DB::select("select cantidad from productos_enviados pe where producto_id='".$producto->producto_id."' and guia_pedido_id='".$pedido->gp_id."' ");
                    if(count($contador)>0){
                        $temp = [ "cantidad" => $producto->cantidad - $contador[0]->cantidad , "descripcion" => $producto->descripcion ];
                        array_push($productos_enviados,$temp);
                    }
                }
			?>
            <tr style="font-size:28px;">
                <td><b>{{ $producto->cantidad  }}</b></td>
                <td><b>{{ $producto->descripcion }}</b></td>
                <td align="right"><b>{{ strval($producto->precio_unitario) }}</b></td>
                <td align="right"><b>{{ strval($producto->total) }}</b></td>

            </tr>
        @else
			@if($producto->pedido_id==$pedido->pedido_id)
            <?php
            $descuento=$producto->total;
            ?>
			@endif
        @endif

    @endforeach
<tr><td colspan='4'>{!! $spaces  !!}</td></tr>
    <tr style="font-size:28px;">
		<td colspan='3'><b>SUBTOTAL:</b></td>
		<td align="right"><b>{{ $pedido->subtotal + $descuento  }}</b></td>
	</tr>
	<tr style="font-size:28px;">
		<td colspan='3'><b>DCTO:</b></td>
		<td align="right"><b>{{ $descuento*(-1) }} </b></td>
	</tr>
	<tr style="font-size:28px;">
		<td colspan='3'><b>IVA:</b></td>
		<td align="right"><b>{{  $pedido->total_tax }}</b></td>
	</tr>
	<tr style="font-size:28px;">
		<td colspan='3'><b>FLETE:</b></td>
		<td align="right"><b>{{ $pedido->costo_envio  }}</b></td>
	</tr>
	<tr style="font-size:28px;">
		<td colspan='3'><b>TOTAL:</b></td>
		<td align="right"><b>{{ $pedido->total  }}</b></td>
	</tr>
</table>
{!! $spaces  !!}

<p {{ $estilo  }} ><b>FORMAS DE PAGO:</b> </p>
<p {{ $estilo  }} ><b>{{ $pedido->tipo_pago   }}</b></p>

{!! $spaces  !!}

<p {{ $estilo  }} ><b>HAS OBTENIDO {{ $pedido->volumen_comisionable }} PUNTOS VOLUMEN</b></p>

{!! $spaces  !!}

<p {{ $estilo  }} ><b>CONTACTO: {{ $pedido->first_name.' '.$pedido->last_name   }}</b></p>
<p {{ $estilo  }} ><b>DIRECCION DE ENVIO: {{ $pedido->direccion  }}</b></p>
<p {{ $estilo  }} ><b>CIUDAD: {{ $pedido->nombreCiudadOL($empresario[0]->id)  }}</b></p>
<p {{ $estilo  }} ><b>DEPARTAMENTO: {{ $pedido->nombreDepartamentoOL($empresario[0]->id)  }}</b></p>
<p {{ $estilo  }} ><b>NUMERO DE TELEFONO: {{ $empresario[0]->telefono  }}</b></p>

{!! $spaces  !!}

<p {{ $estilo  }} ><b>¡GRACIAS POR SU COMPRA!</b></p>
<p {{ $estilo  }} ><b>¡CON FUXION MEJORAMOS TU VIDA!</b></p>

{!! $spaces  !!}

<br />
<br />
<br />

@if(count($productos_enviados)>0)

    @include('factura.carta1')
@endif

