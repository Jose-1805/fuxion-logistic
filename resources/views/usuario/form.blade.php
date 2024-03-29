<?php
    $rol = null;
    if(!isset($usuario))$usuario = new \FuxionLogistic\User();
    if(isset($usuario) && $usuario->exists)
        $rol = $usuario->rol->id;

    $bodegas = [''=>'Seleccione una bodega']+\FuxionLogistic\Models\Bodega::pluck('nombre','id')->toArray();
    $bodega = null;
    if($usuario->exists){
        $bodega = $usuario->bodega_id;
    }
?>
<div class="col-xs-12 no-padding">

    <div class="col-md-3">
        <p class="titulo_secundario">Imagen (foto)</p>
        <input id="imagen" name="imagen" type="file" class="file-loading">
    </div>

    <div class="col-md-9">
        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('tipo_identificacion','Tipo de identificación (*)') !!}
            {!! Form::select('tipo_identificacion',['C.C'=>'C.C','NIT'=>'NIT'],null,['id'=>'tipo_identificacion','class'=>'form-control']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('identificacion','No. de identificación (*)') !!}
            {!! Form::text('identificacion',null,['id'=>'identificacion','class'=>'form-control','maxlength'=>'15']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('nombres','Nombres (*)',['class'=>'control-label']) !!}
            {!! Form::text('nombres',null,['id'=>'nombres','class'=>'form-control','maxlength'=>150,'pattern'=>'^[A-z ñ]{1,}$','data-error'=>'Ingrese unicamente letras']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('apellidos','Apellidos (*)',['class'=>'control-label']) !!}
            {!! Form::text('apellidos',null,['id'=>'apellidos','class'=>'form-control','maxlength'=>150,'pattern'=>'^[A-z ñ]{1,}$','data-error'=>'Ingrese unicamente letras']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group datepicker">
            {!! Form::label('fecha_nacimiento','Fecha de nacimiento (*)') !!}
            @if(isset($usuario))
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"class="form-control" value="{{$usuario->fecha_nacimiento}}">
            @else
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"class="form-control" >
            @endif
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('genero','Genero (*)') !!}
            {!! Form::select('genero',['masculino'=>'Masculino','femenino'=>'Femenino'],null,['id'=>'genero','class'=>'form-control']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('telefono','Teléfono (*)') !!}
            {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('email','Correo electrónico (*)') !!}
            {!! Form::text('email',null,['id'=>'email','class'=>'form-control']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('rol','Rol (*)') !!}
            {!! Form::select('rol',\FuxionLogistic\Models\Rol::pluck('nombre','id'),$rol,['id'=>'rol','class'=>'form-control']) !!}
        </div>

        <div class="col-md-6 col-lg-4 form-group">
            {!! Form::label('bodega','Bodega (*)') !!}
            {!! Form::select('bodega',$bodegas,$bodega,['id'=>'bodega','class'=>'form-control']) !!}
        </div>

        <div class="col-sm-12 margin-top-20">
            <p class="titulo_secundario title">Inicios de sessión</p>
            <div class="form-group display-inline-block">
                {{Form::checkbox('web','web',$usuario->sesion_web=='si'?true:false,['id'=>'web'])}}
                {{Form::label('web','Web')}}
            </div>
            <div class="form-group display-inline-block margin-left-10">
                {{Form::checkbox('fuxion_track','fuxion_track',$usuario->sesion_fuxion_track=='si'?true:false,['id'=>'fuxion_track'])}}
                {{Form::label('fuxion_track','FuXion Track')}}
            </div>
            <div class="form-group display-inline-block margin-left-10">
                {{Form::checkbox('fuxion_trax','fuxion_trax',$usuario->sesion_fuxion_trax=='si'?true:false,['id'=>'fuxion_trax'])}}
                {{Form::label('fuxion_trax','FuXion Express')}}
            </div>
        </div>


    </div>
</div>                                                                                       


<div class="col-xs-12 margin-top-20 text-center">
    <a href="#!" class="cursor_pointer btn-submit btn btn-success btn-radius" id="btn-guardar-usuario"><i class="fa fa-save margin-right-10"></i>Guardar</a>
</div>