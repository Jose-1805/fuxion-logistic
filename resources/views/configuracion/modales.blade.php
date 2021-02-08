<div id="modal-contrasena" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Cambiar contraseña</h4>
            </div>
            <div class="modal-body row">
                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'alertas-cambiar-password'])
                </div>
                {!! Form::open(['id'=>'form-cambio-password']) !!}
                    <div class="col-xs-12 form-group">
                        {!! Form::label('password','Contraseña nueva') !!}
                        {!! Form::password('password',['id'=>'password','class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-12 form-group">
                        {!! Form::label('password_confirm','Confirme su Contraseña') !!}
                        {!! Form::password('password_confirm',['id'=>'password_confirm','class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-12 form-group">
                        {!! Form::label('password_old','Contraseña antigua') !!}
                        {!! Form::password('password_old',['id'=>'password_old','class'=>'form-control']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                <a class="btn btn-sm btn-primary" id="btn-cambiar-contrasena">Guardar</a>
            </div>
        </div>
    </div>
</div>

<div id="modal-desbloquear-dispositivo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Desbloquear dispositivo</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de desbloquear su dispositivo móvil?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-sm btn-primary" id="btn-desbloquear-dispositivo">Si</a>
            </div>
        </div>
    </div>
</div>

<div id="modal-app-ios" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Descarga</h4>
            </div>
            <div class="modal-body">
                <p>Para que su descarga funcione correctamente asegurese de ingresar desde el navegador Safari.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                <a class="btn btn-sm btn-primary" id="app-ios">Continuar</a>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->esSuperadministrador())
    <div id="modal-imagen-empresario" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Imagen app empresario</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-xs-12">
                        @include('layouts.alertas',['id_contenedor'=>'alertas-imagen-empresario'])
                    </div>
                    {!! Form::open(['id'=>'form-imagen-empresario','enctype'=>'multipart/form-data']) !!}
                        <div class="col-xs-12">
                            <p class="titulo_secundario">Imagen (foto)</p>
                            <input id="imagen" name="imagen" type="file" class="file-loading">
                        </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-sm btn-primary" id="btn-cambiar-imagen">Guardar</a>
                </div>
            </div>
        </div>
    </div>
@endif