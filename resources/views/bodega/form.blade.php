<?php
    if(!isset($bodega))$bodega = new \FuxionLogistic\Models\Bodega();

    $paises = [''=>'Seleccione un país']+\FuxionLogistic\Models\Pais::pluck('nombre','id')->toArray();

    if(!isset($departamentos))$departamentos = [''=>'Seleccione un departamento'];
    if(!isset($ciudades))$ciudades = [''=>'Seleccione una ciudad'];
?>
<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('nombre','Nombre (*)') !!}
    {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','maxlength'=>45]) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('prefijo_facturacion','Prefijo de facturación(*)') !!}
    {!! Form::text('prefijo_facturacion',null,['id'=>'prefijo_facturacion','class'=>'form-control','maxlength'=>20]) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('alias','Alias (seudónimo)') !!}
    {!! Form::text('alias',null,['id'=>'alias','class'=>'form-control','maxlength'=>150]) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('pais','Pais') !!}
    {!! Form::select('pais',$paises,null,['id'=>'select-pais','class'=>'form-control']) !!}
</div>

<div class="col-md-6 col-lg-3 form-group" id="contenedor-select-departamentos">
    {!! Form::label('departamento','Departamento') !!}
    {!! Form::select('departamento',$departamentos,null,['id'=>'select-departamento','class'=>'form-control']) !!}
</div>

<div class="col-md-6 col-lg-3 form-group" id="contenedor-select-ciudades">
    {!! Form::label('ciudad','Ciudad (*)') !!}
    {!! Form::select('ciudad',$ciudades,null,['id'=>'ciudad','class'=>'form-control']) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('barrio','Barrio (*)') !!}
    {!! Form::text('barrio',null,['id'=>'barrio','class'=>'form-control','maxlength'=>250]) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('calle','Calle') !!}
    {!! Form::text('calle',null,['id'=>'calle','class'=>'form-control','maxlength'=>20]) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('carrera','Carrera') !!}
    {!! Form::text('carrera',null,['id'=>'carrera','class'=>'form-control','maxlength'=>20]) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('numero','Número (*)') !!}
    {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control']) !!}
</div>

<div class="col-md-6 col-lg-3 form-group">
    {!! Form::label('especificaciones','Especificaciones') !!}
    {!! Form::text('especificaciones',null,['id'=>'especificaciones','class'=>'form-control','maxlength'=>250]) !!}
</div>