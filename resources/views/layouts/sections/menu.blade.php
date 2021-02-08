<?php
    $color_items = 'white-text';
?>
<img src="{{url('/imagenes/sistema/logo_express_menu.png')}}" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 margin-top-30">
<strong class="col-xs-12 margin-top-40 margin-bottom-20">MENÚ PRINCIPAL</strong>

<div class="col-xs-12 no-padding">
    @if(Auth::check())
        @include('layouts.sections.options',['color'=>$color_items])
    @endif
</div>