<?php
    if(!isset($estado_operador_logistico))$estado_operador_logistico = new \FuxionLogistic\Models\EstadoOperadorLogistico();
    $plantillas_correo = \FuxionLogistic\Models\PlantillaCorreo::select('id','nombre')->orderBy('nombre')->pluck('nombre','id')->toArray();
    $estados_pedidos = \FuxionLogistic\Models\EstadoPedido::select('id','nombre')->orderBy('nombre')->pluck('nombre','id')->toArray();
    $select_disabled = false;
    $operadores_logisticos = \FuxionLogistic\Models\OperadorLogistico::all();
    if(!$estado_operador_logistico->exists || ($estado_operador_logistico->exists && $estado_operador_logistico->notificacion_correo == 'no'))
        $select_disabled = true;

?>
<div class="col-md-6 col-lg-4 form-group">
    {!! Form::label('nombre','Nombre (*)') !!}
    {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','maxlength'=>100]) !!}
</div>
<div class="col-md-6 col-lg-4 form-group">
    {!! Form::label('alias','Alias (*)') !!}
    {!! Form::text('alias',null,['id'=>'alias','class'=>'form-control','maxlength'=>50]) !!}
</div>
<div class="col-md-6 col-lg-4 form-group">
    {!! Form::label('descripcion','Descripción(*)') !!}
    {!! Form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','maxlength'=>250]) !!}
</div>
<div class="col-md-3 col-lg-4">
    {!! Form::label('estado_pedido','Estado de pedido editable') !!}
    {!! Form::select('estado_pedido',$estados_pedidos,null,['id'=>'estado_pedido','class'=>'form-control','placeholder'=>'Seleccione un estado de pedido']) !!}
</div>
<div class="col-md-6 col-lg-4">
        <label class="col-xs-12 ">Notificaciones</label>
        <div class="col-md-12 col-lg-6 form-group margin-bottom-5">
            {!! Form::checkbox('notificacion_push','si',$estado_operador_logistico->notificacion_push == 'si'?true:false,['id'=>'notificacion_push','class'=>'']) !!}
            {!! Form::label('notificacion_push','Notificación push') !!}
        </div>
        <div class="col-md-12 col-lg-6 form-group margin-bottom-5">
            {!! Form::checkbox('notificacion_correo','si',$estado_operador_logistico->notificacion_correo == 'si'?true:false,['id'=>'notificacion_correo','class'=>'']) !!}
            {!! Form::label('notificacion_correo','Notificación correo') !!}
        </div>
</div>
<div class="col-md-3 col-lg-4">
    {!! Form::label('plantilla_correo','Plantilla de correo') !!}
    {!! Form::select('plantilla_correo',$plantillas_correo,null,['id'=>'plantilla_correo','class'=>'form-control','disabled'=>$select_disabled,'placeholder'=>'Seleccione una plantilla de correo']) !!}
</div>
<div class="col-md-3 col-lg-4 margin-top-20">
    {!! Form::label('correos_destinatarios','Correos destinatarios (separar con ;)') !!}
    {!! Form::text('correos_destinatarios',null,['id'=>'correos_destinatarios','class'=>'form-control','disabled'=>$select_disabled,'placeholder'=>'Ej: prueba@prueba.com;ejemplo@ejm.com']) !!}
</div>

<p class="col-xs-12 titulo_principal font-large margin-top-30 margin-bottom-20">Nombre asignado por operadores logísticos</p>
@forelse($operadores_logisticos as $ol)
    <div class="col-md-6 col-lg-4 form-group margin-top-10">
        {!! Form::label('nombre_'.$ol->id,'Nombre '.$ol->nombre) !!}
        {!! Form::text('nombre_'.$ol->id,$estado_operador_logistico->nombreEstadoPorOperadorLogistico($ol->id),['id'=>'nombre_'.$ol->id,'class'=>'form-control','maxlength'=>100]) !!}
    </div>
@empty
    <div class="alert col-xs-12 alert-warning margin-top-10" role="alert">
        <div class="mensaje">
            No se han registrado operadores logísticos con los cuales relacionar este estado.
        </div>
    </div>
@endforelse