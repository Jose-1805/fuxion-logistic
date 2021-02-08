<p class="text-center" style="">Este es el estado de tu pedido.</p>
<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>


<div class="panel">
    <div class="panel-content">
        <p class="text-center"><strong><span>{{$msj_estado}}</span></strong></p>
        <img style="max-width: 100%;" src="{{url('/archivo/app-public-mail-'.$timeline)}}"/>
        <div style="display: inline-block; width: 33%;vertical-align: middle;">
            <img style="max-width: 100%;" src="{{url('/archivo/app-public-mail-'.$icon)}}">
            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->
        </div>
        <div style="display: inline-block; width: 63%;vertical-align: middle;">
            @if($str_estado == 'en cola')
                @include('mail.contenidos.pedido.info_en_cola')
            @elseif($str_estado == 'enviado')
                @include('mail.contenidos.pedido.info_enviado')
            @endif
        </div>
    </div>
</div>

<div>
    <div style="display: inline-block; width: 33%;vertical-align: middle;">
        <img style="max-width: 100%;" src="{{url('/archivo/app-public-mail-sachets.png')}}">
    </div>

    <div style="display: inline-block; width: 63%;vertical-align: middle;">
        <table class="table" style="margin: 0 auto;">
            <tr>
                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>
            </tr>
            <tr>
                <th width="35%">Cant.</th>
                <th width="65%">Producto</th>
            </tr>
            <tbody>
                <?php
                    $productos = $pedido->productos()->select('productos.descripcion','pedidos_productos.cantidad')->get();
                ?>
                @foreach($productos as $p)
                    <tr>
                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">{{$p->cantidad}}</td>
                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">{{$p->descripcion}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>