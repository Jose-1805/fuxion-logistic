<?php
    $departamentos = \FuxionLogistic\Models\Departamento::orderBy('nombre')->pluck('nombre','id');
?>

<div class="form-group col-md-4 col-md-offset-8 col-lg-3 col-lg-offset-9">
    {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control']) !!}
</div>
<div class="contenedor-opciones-vista">
</div>
<table id="tabla-ciudad" class="table-hover dataTable">
    <thead>
        <th>Departamento</th>
        <th>Ciudad</th>
        <th>Opciones</th>
    </thead>
</table>

@if(Auth::user()->tieneFuncion(16, 1, $privilegio_superadministrador))
    <div class="col-xs-12 text-center margin-top-20">
        <a href="#!" type="button" class="btn btn-success btn-radius" id="btn-agregar-ciudad"><i class="fa fa-plus margin-right-10"></i>Nuevo</a>
    </div>
@endif