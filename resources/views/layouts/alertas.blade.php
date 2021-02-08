<?php
    if(!isset($id_contenedor))$id_contenedor="alertas";
?>
<div class="row" id="{{$id_contenedor}}">
    <div class="alert {{session()->has('msj_success')?'':'hide'}} col-xs-12 alert-success" role="alert">
        <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
        <div class="mensaje">
            @if(session()->has('msj_success'))
                {!!  session()->get('msj_success')[0] !!}
                <?php
                    session()->forget('msj_success');
                ?>
            @endif
        </div>
    </div>

    <div class="alert {{session()->has('msj_info')?'':'hide'}} col-xs-12 alert-info" role="alert">
        <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
        <div class="mensaje">
            @if(session()->has('msj_info'))
                {!! session()->get('msj_info') !!}
                <?php
                    session()->forget('msj_info');
                ?>
            @endif
        </div>
    </div>

    <div class="alert {{session()->has('msj_warning')?'':'hide'}} col-xs-12 alert-warning" role="alert">
        <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
        <div class="mensaje">
            @if(session()->has('msj_warning'))
                {!! session()->get('msj_warning') !!}
                <?php
                    session()->forget('msj_warning');
                ?>
            @endif
        </div>
    </div>

    <div class="alert {{session()->has('msj_danger')?'':'hide'}} col-xs-12 alert-danger" role="alert">
        <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
        <div class="mensaje">
            @if(session()->has('msj_danger'))
                {!! session()->get('msj_danger') !!}
                <?php
                    session()->forget('msj_danger');
                ?>
            @endif
        </div>
    </div>
</div>