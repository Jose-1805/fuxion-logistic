<?php
    if(!isset($estado_pedido))$estado_pedido = new \FuxionLogistic\Models\EstadoPedido();
    $plantillas_correo = ['Seleccione una plantilla de correo']+\FuxionLogistic\Models\PlantillaCorreo::select('id','nombre')->orderBy('nombre')->pluck('nombre','id')->toArray();
    $select_disabled = false;
    if(!$estado_pedido->exists || ($estado_pedido->exists && $estado_pedido->notificacion_correo == 'no'))
        $select_disabled = true;

    //determina si existe un estado que se utilicen cuando no se asigne un corte a un pedido
    $no_asignacion_corte = \FuxionLogistic\Models\EstadoPedido::where('no_asignacion_corte','si')->count();

    //determina si existe un estado que se utilicen cuando se asigne un corte a un pedido
    $asignacion_corte = \FuxionLogistic\Models\EstadoPedido::where('asignacion_corte','si')->count();

    //determina si existe un pedido se encuentra en estado entregado
    $entregado = \FuxionLogistic\Models\EstadoPedido::where('pedido_entregado','si')->count();
?>

@if(!$no_asignacion_corte && !$estado_pedido->exists)
    <p class="alert alert-warning">
        <strong>Importante!!</strong><br>
        El estado que se registre en este momento será establecido como el estado que se asigne a los pedidos que no se relacionan con un corte por no tener
        kit de afiliación o por no tener flete.
    </p>
@endif

@if($no_asignacion_corte && (!$asignacion_corte && !$estado_pedido->exists))
    <p class="alert alert-warning">
        <strong>Importante!!</strong><br>
        El estado que se registre en este momento será establecido como el estado que se asigne a los pedidos que se relacionan con un corte en la importación.
    </p>
@endif

@if($no_asignacion_corte && $asignacion_corte && (!$entregado && !$estado_pedido->exists))
    <p class="alert alert-warning">
        <strong>Importante!!</strong><br>
        El estado que se registre en este momento será establecido como el estado que se asigne a los pedidos que sean entregados satisfactoriamente.
    </p>
@endif
<div class="col-md-6 col-lg-4 form-group">
    {!! Form::label('nombre','Nombre (*)') !!}
    {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','maxlength'=>100]) !!}
</div>
<div class="col-md-6 col-lg-4 form-group">
    {!! Form::label('descripcion','Descripción(*)') !!}
    {!! Form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','maxlength'=>250]) !!}
</div>
<div class="col-md-6 col-lg-4">
    <label class="col-xs-12 margin-bottom-20">Notificaciones</label>
    <div class="col-md-12 col-lg-6 form-group">
        {!! Form::checkbox('notificacion_push','si',$estado_pedido->notificacion_push == 'si'?true:false,['id'=>'notificacion_push','class'=>'']) !!}
        {!! Form::label('notificacion_push','Notificación push') !!}
    </div>
    <div class="col-md-12 col-lg-6 form-group">
        {!! Form::checkbox('notificacion_correo','si',$estado_pedido->notificacion_correo == 'si'?true:false,['id'=>'notificacion_correo','class'=>'']) !!}
        {!! Form::label('notificacion_correo','Notificación correo') !!}
    </div>
</div>
<div class="col-md-3 col-lg-4">
    {!! Form::label('plantilla_correo','Plantilla de correo') !!}
    {!! Form::select('plantilla_correo',$plantillas_correo,null,['id'=>'plantilla_correo','class'=>'form-control','disabled'=>$select_disabled]) !!}
</div>
<div class="col-md-3 col-lg-4">
    {!! Form::label('correos_destinatarios','Correos destinatarios (separar con ;)') !!}
    {!! Form::text('correos_destinatarios',null,['id'=>'correos_destinatarios','class'=>'form-control','disabled'=>$select_disabled,'placeholder'=>'Ej: prueba@prueba.com;ejemplo@ejm.com']) !!}
</div>