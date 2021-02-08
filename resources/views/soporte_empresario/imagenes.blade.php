<?php
    $imagenes = 0;
?>
<div class="row">
    <div class="col-xs-12">
        @if($guia->numero)
            @if(file_exists(storage_path('app/guias/'.$guia->numero.'/picture_1.jpg')))
                <div class="col-md-6 no-padding margin-top-20">
                    <p class="titulo_secundario col-xs-12">Imagen #1</p>
                    <img class="col-xs-12" src="{{url('images/guias/'.$guia->numero.'/picture_1.jpg')}}">
                </div>
                <?php
                    $imagenes++;
                ?>
            @endif
            @if(file_exists(storage_path('app/guias/'.$guia->numero.'/picture_2.jpg')))
                <div class="col-md-6 no-padding margin-top-20">
                    <p class="titulo_secundario col-xs-12">Imagen #2</p>
                    <img class="col-xs-12" src="{{url('images/guias/'.$guia->numero.'/picture_2.jpg')}}">
                </div>
                <?php
                    $imagenes++;
                ?>
            @endif
            @if(file_exists(storage_path('app/guias/'.$guia->numero.'/picture_3.jpg')))
                <div class="col-md-6 no-padding margin-top-20">
                    <p class="titulo_secundario col-xs-12">Imagen #3</p>
                    <img class="col-xs-12" src="{{url('images/guias/'.$guia->numero.'/picture_3.jpg')}}">
                </div>
                <?php
                    $imagenes++;
                ?>
            @endif
            @if(file_exists(storage_path('app/guias/'.$guia->numero.'/picture_4.jpg')))
                <div class="col-md-6 no-padding margin-top-20">
                    <p class="titulo_secundario col-xs-12">Imagen #4</p>
                    <img class="col-xs-12" src="{{url('images/guias/'.$guia->numero.'/picture_4.jpg')}}">
                </div>
                <?php
                    $imagenes++;
                ?>
            @endif
            @if(file_exists(storage_path('app/guias/'.$guia->numero.'/picture_5.jpg')))
                <div class="col-md-6 no-padding margin-top-20">
                    <p class="titulo_secundario col-xs-12">Imagen #5</p>
                    <img class="col-xs-12" src="{{url('images/guias/'.$guia->numero.'/picture_5.jpg')}}">
                </div>
                <?php
                    $imagenes++;
                ?>
            @endif

            @if($imagenes == 0)
                    <p class="text-center">No se han subido imagenes para la guía del pedido seleccionado.</p>
                </div>
            @endif
        @else
            <p class="text-center">La guía del pedido seleccionado no ha sido procesada.</p>
        @endif

        <div class="col-xs-12 text-right margin-top-20">
            <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
        </div>
    </div>
</div>