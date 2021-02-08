{!! Form::hidden('pedido',$pedido->id,['id'=>'pedido']) !!}
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('nombres','Nombres (*)',['class'=>'control-label']) !!}
        {!! Form::text('nombres',$pedido->first_name,['id'=>'nombres','class'=>'form-control','maxLength'=>'150']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('apellidos','Apellidos (*)',['class'=>'control-label']) !!}
        {!! Form::text('apellidos',$pedido->last_name,['id'=>'apellidos','class'=>'form-control','maxLength'=>'150']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('email','Email (*)',['class'=>'control-label']) !!}
        {!! Form::text('email',$pedido->email,['id'=>'email','class'=>'form-control','maxLength'=>'150']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('direccion','Dirección (*)',['class'=>'control-label']) !!}
        {!! Form::text('direccion',$pedido->direccion,['id'=>'direccion','class'=>'form-control','maxLength'=>'250']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('telefono','Teléfono (*)',['class'=>'control-label']) !!}
        {!! Form::text('telefono',$pedido->empresario->user->telefono,['id'=>'apellidos','class'=>'form-control num-int-positivo','maxLength'=>'15']) !!}
    </div>
    <p class="col-xs-12">(*) Campos obligatorios</p>
    <div class="col-xs-12 text-right">
        <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
        <a class="btn btn-primary" id="btn-empresario">Guardar</a>
    </div>
</div>
<div id="modal-aprobacion-empresario" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Confirmación</h4>
            </div>
            <div class="modal-body row" id="">
                <p class="col-xs-12">¿Está seguro de editar la información del empresario?</p>
                <div class="col-xs-12 text-right">
                    <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-primary" id="btn-empresario-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>