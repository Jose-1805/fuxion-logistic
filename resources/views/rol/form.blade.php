<?php
        if(!isset($rol))$rol = new \FuxionLogistic\Models\Rol();
?>
<div class="row">
        <div class="form-group col-xs-12 col-md-6">
            {!! Form::label('nombre','Nombre') !!}
            {!! Form::text('nombre',$rol->nombre,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre del rol']) !!}
            {!! Form::hidden('rol',$rol->id,['id'=>'rol']) !!}
        </div>

        <?php
            $check = false;
            $disabled = false;
            if($rol->empresarios == 'si'){
                $check = true;
                $disabled = true;
            }
        ?>
        @if($rol->empresarios == 'si' || \FuxionLogistic\Models\Rol::where('empresarios','si')->count()==0)
                <div class="form-group col-xs-12">
                    {!! Form::checkbox('empresarios','si',$check,['id'=>'empresarios','disabled'=>$disabled]) !!}
                    {!! Form::label('empresarios','Rol asignable a empresarios creados en la importación de ordenes') !!}
                </div>
        @endif

        <div class="col-xs-12">
                <p>Selecciones los privilegios permitidos para el rol</p>
                <a class="btn btn-default btn-seleccionar">Seleccionar todo</a>
                <a class="btn btn-default btn-deseleccionar">Deseleccionar todo</a>
                <table class="table">
                        <thead>
                                <th >Módulos</th>
                                @foreach(\FuxionLogistic\Models\Funcion::get() as $f)
                                        <th data-class="{{$f->id}}" class="text-center cursor_pointer column-selector" title="Todas las casillas">{{$f->nombre}}</th>
                                @endforeach
                        </thead>
                        <tbody>
                                @foreach(\FuxionLogistic\Models\Modulo::orderBy('nombre')->get() as $m)
                                        @if($m->funciones()->get()->count() && $m->estado == 'Activo')
                                        <tr>
                                                <td>{{$m->etiqueta}}</td>
                                                @foreach(\FuxionLogistic\Models\Funcion::get() as $f)
                                                        <th class="text-center">
                                                                @if($m->tieneFuncion($f->id))
                                                                <label>
                                                                        <input type="checkbox" name="privilegios[]" class="column-{{$f->id}}" value="{{$m->identificador.','.$f->identificador}}" @if($rol->exists && $rol->tieneFuncion($m->identificador,$f->identificador)) checked="checked" @endif>
                                                                </label>
                                                                @endif
                                                        </th>
                                                @endforeach

                                        </tr>
                                        @endif
                                @endforeach
                        </tbody>
                </table>
        </div>
</div>