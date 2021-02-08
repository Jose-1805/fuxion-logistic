<?php
if(!isset($malla_cobertura))$malla_cobertura = new \FuxionLogistic\Models\MallaCobertura();

$operadores_logisticos = [''=>'Seleccione un operador logístico']+\FuxionLogistic\Models\OperadorLogistico::pluck('nombre','id')->toArray();
?>
<div class="col-xs-12 no-padding">
    <div class="col-md-6 col-lg-3 form-group">
        {!! Form::label('origen','Origen (*)',['class'=>'control-label']) !!}
        {!! Form::text('origen',null,['id'=>'origen','class'=>'form-control','maxlength'=>150]) !!}
    </div>

    <div class="col-md-6 col-lg-3 form-group">
        {!! Form::label('destino','Destino (*)',['class'=>'control-label']) !!}
        {!! Form::text('destino',null,['id'=>'destino','class'=>'form-control','maxlength'=>150]) !!}
    </div>

    <div class="col-md-6 col-lg-3 form-group">
        {!! Form::label('tiempo_entrega','Tiempo de entrega (*)',['class'=>'control-label']) !!}
        {!! Form::text('tiempo_entrega',null,['id'=>'tiempo_entrega','class'=>'form-control num-int-positivo']) !!}
    </div>

    <div class="col-md-6 col-lg-3 form-group">
        {!! Form::label('operador_logistico','Operador logístico (*)',['class'=>'control-label']) !!}
        {!! Form::select('operador_logistico',$operadores_logisticos,null,['id'=>'tiempo_entrega','class'=>'form-control num-int-positivo']) !!}
    </div>
</div>