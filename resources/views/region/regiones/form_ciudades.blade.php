<?php
$departamentos = \FuxionLogistic\Models\Departamento::select('nombre','id')->pluck('nombre','id');
?>
<div class="">
    @include('layouts.alertas',['id_contenedor'=>'alertas-form-ciudad'])
    {!! Form::model($ciudad,['id'=>'form-ciudad','class'=>'no_submit']) !!}
    {!! Form::hidden('ciudad',$ciudad->id) !!}
    <div class="form-group col-md-6">
        {!! Form::label('departamento','Departamento (*)') !!}
        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento_','class'=>'form-control']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('nombre','Nombre (*)') !!}
        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control']) !!}
    </div>
    {!! Form::close() !!}
</div>