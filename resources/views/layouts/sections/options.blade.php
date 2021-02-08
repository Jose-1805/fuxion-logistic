<?php
    use FuxionLogistic\Models\TareasSistema;
    $user = Auth::user();
    $privilegio_superadministrador = $user->esSuperadministrador();
?>

<div class="col-xs-12 contenedor-item {{TareasSistema::claseEnMenu(['home'])}}">
    <a href="{{url('/')}}" class="{{$color_items}}"><i class="fa fa-home margin-right-10"></i>INICIO</a>
</div>
@if(
    $user->tieneFuncion(4,4,$privilegio_superadministrador)
    || $user->tieneFuncion(13,4,$privilegio_superadministrador)
)
    <?php
        $rutas = ['corte','cargue-sap'];
    ?>
    <div class="col-xs-12 contenedor-item {{TareasSistema::claseEnMenu($rutas)}}">
        <a href="#!" class="{{$color_items}} no-color-focus toggle-items col-xs-12 no-padding">
            <i class="fa fa-truck margin-right-10"></i>PEDIDOS<i class="fa fa-angle-down right"></i>
        </a>

        <div class="col-xs-12 contenedor-items" style="{{TareasSistema::styleSubMenu($rutas)}}">
            @if($user->tieneFuncion(4,4,$privilegio_superadministrador))
                <div class="col-xs-12"><a href="{{url('/corte')}}" class="col-xs-12 no-padding">Cortes</a></div>
            @endif

            @if($user->tieneFuncion(13,4,$privilegio_superadministrador))
                <div class="col-xs-12"><a href="{{url('/cargue-sap')}}" class="col-xs-12 no-padding">Carga a SAP</a></div>
            @endif
        </div>
    </div>
@endif

@if(
    $user->tieneFuncion(12,4,$privilegio_superadministrador)
    || $user->tieneFuncion(14,4,$privilegio_superadministrador)
)
<?php
        $rutas = ['soporte-empresario','historial-empresario'];
?>
<div class="col-xs-12 contenedor-item {{TareasSistema::claseEnMenu($rutas)}}">
    <a href="#!" class="{{$color_items}} no-color-focus toggle-items col-xs-12 no-padding">
        <i class="fa fa-headphones margin-right-10"></i>ATENCIÓN AL CLIENTE<i class="fa fa-angle-down right"></i>
    </a>

    <div class="col-xs-12 contenedor-items" style="{{TareasSistema::styleSubMenu($rutas)}}">
        @if($user->tieneFuncion(12,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/soporte-empresario')}}" class="col-xs-12 no-padding">Soporte a empresario</a></div>
        @endif

        @if($user->tieneFuncion(14,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/historial-empresario')}}" class="col-xs-12 no-padding">Historial de cambios</a></div>
        @endif

        @if($user->tieneFuncion(12,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/reporte-soporte-empresario')}}" class="col-xs-12 no-padding">Reporte soporte a empresario</a></div>
        @endif
    </div>
</div>
@endif

@if($user->tieneFuncion(15,4,$privilegio_superadministrador))
    <div class="col-xs-12 contenedor-item {{TareasSistema::claseEnMenu(['reporte'])}}">
        <a href="{{url('/reporte')}}" class="{{$color_items}} col-xs-12 no-padding"><i class="fa fa-file-excel-o margin-right-10"></i>REPORTES</a>
    </div>
@endif


@if(
    $user->tieneFuncion(5,4,$privilegio_superadministrador)
    || $user->tieneFuncion(7,4,$privilegio_superadministrador)
    || $user->tieneFuncion(8,4,$privilegio_superadministrador)
    || $user->tieneFuncion(10,4,$privilegio_superadministrador)
    || $user->tieneFuncion(11,4,$privilegio_superadministrador)
    || $user->tieneFuncion(9,4,$privilegio_superadministrador)
    || $user->tieneFuncion(6,2,$privilegio_superadministrador)
    || $user->tieneFuncion(16,4,$privilegio_superadministrador)
)
    <?php
      $rutas = ['bodega','operador-logistico','malla-cobertura','estado-pedido'
          ,'estado-operador-logistico','empresario','plantilla-correo','region'];
    ?>
<div class="col-xs-12 contenedor-item {{TareasSistema::claseEnMenu($rutas)}}">

    <a href="#!" class="{{$color_items}} no-color-focus toggle-items col-xs-12 no-padding">
        <i class="fa fa-cog margin-right-10"></i>CONFIGURACIÓN<i class="fa fa-angle-down right"></i>
    </a>

    <div class="col-xs-12 contenedor-items" style="{{TareasSistema::styleSubMenu($rutas)}}">
        @if($user->tieneFuncion(5,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/bodega')}}" class="col-xs-12 no-padding">Bodegas</a></div>
        @endif

        @if($user->tieneFuncion(16,4,$privilegio_superadministrador))
                <div class="col-xs-12"><a href="{{url('/region')}}" class="">Regiones</a></div>
        @endif

        @if($user->tieneFuncion(7,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/operador-logistico')}}" class="col-xs-12 no-padding">Operadores logísticos</a></div>
        @endif

        @if($user->tieneFuncion(8,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/malla-cobertura')}}" class="col-xs-12 no-padding">Malla de cobertura</a></div>
        @endif

        @if($user->tieneFuncion(10,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/estado-pedido')}}" class="col-xs-12 no-padding">Estados de pedidos</a></div>
        @endif

        @if($user->tieneFuncion(11,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/estado-operador-logistico')}}" class="col-xs-12 no-padding">Estados de operadores logísticos</a></div>
        @endif

        @if($user->tieneFuncion(6,2,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/empresario/importacion-kits')}}" class="col-xs-12 no-padding">Importación de kits</a></div>
        @endif

        @if($user->tieneFuncion(9,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/plantilla-correo')}}" class="col-xs-12 no-padding">Plantillas de correo</a></div>
        @endif
    </div>
</div>
@endif

@if(
    $user->tieneFuncion(1,4,$privilegio_superadministrador)
    || $user->tieneFuncion(2,4,$privilegio_superadministrador)
    || $user->tieneFuncion(3,4,$privilegio_superadministrador)
)
<?php
    $rutas = ['modulos-funciones','rol','usuario'];
?>
<div class="col-xs-12 contenedor-item {{TareasSistema::claseEnMenu($rutas)}}">
    <a href="#!" class="{{$color_items}} no-color-focus toggle-items col-xs-12 no-padding">
        <i class="fa fa-tablet margin-right-10"></i>SISTEMA<i class="fa fa-angle-down right"></i>
    </a>

    <div class="col-xs-12 contenedor-items" style="{{TareasSistema::styleSubMenu($rutas)}}">

        @if($user->tieneFuncion(1,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/modulos-funciones')}}" class="col-xs-12 no-padding">Módulos & funciones</a></div>
        @endif

        @if($user->tieneFuncion(2,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/rol')}}" class="col-xs-12 no-padding">Roles</a></div>
        @endif

        @if($user->tieneFuncion(3,4,$privilegio_superadministrador))
            <div class="col-xs-12"><a href="{{url('/usuario')}}" class="col-xs-12 no-padding">Usuarios</a></div>
        @endif
    </div>
</div>
@endif