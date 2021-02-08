<?php
    $departamentos = \FuxionLogistic\Models\Departamento::orderBy('nombre')->pluck('nombre','id');
?>

<div class="form-group col-md-4 col-md-offset-8 col-lg-3 col-lg-offset-9">
    {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control']) !!}
</div>
<table id="tabla-nombres-ciudades" class="table-hover dataTable">
    <thead>
        <th>Ciudad</th>
        @foreach($operadores_logisticos as $ol)
            <th>{{$ol->nombre}}</th>
        @endforeach
        <th>Opciones</th>
    </thead>
</table>