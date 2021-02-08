<?php
    $paises = \FuxionLogistic\Models\Pais::select('nombre','id')->pluck('nombre','id');
?>
<div class="">
    @include('layouts.alertas',['id_contenedor'=>'alertas-form-departamento'])
    {!! Form::model($departamento,['id'=>'form-departamento','class'=>'no_submit']) !!}
        {!! Form::hidden('departamento',$departamento->id) !!}
        <div class="form-group col-md-6">
            {!! Form::label('pais','País (*)') !!}
            {!! Form::select('pais',$paises,null,['id'=>'pais','class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('nombre','Nombre (*)') !!}
            {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control']) !!}
        </div>
    {!! Form::close() !!}
</div>