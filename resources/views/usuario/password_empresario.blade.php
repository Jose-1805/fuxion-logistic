@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Bienvenido a Fuxion Logistics!</p>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-password-empresario'])
            </div>
            <div>
                <p class="col-xs-12 margin-bottom-20">Señor(a) {{$user->nombres.' '.$user->apellidos}}, para reestablecer su contraseña de ingreso asigne una nueva contraseña y la verificación de la misma.</p>
                {!! Form::open(['id'=>'form-password-empresario']) !!}
                    <div class="col-md-6 col-lg-5 form-group">
                        {!! Form::label('password','Contraseña (*)') !!}
                        {!! Form::password('password',['id'=>'password','class'=>'form-control']) !!}
                    </div>

                    <div class="col-md-6 col-lg-5 form-group">
                        {!! Form::label('password_confirm','Confirmación de contraseña (*)') !!}
                        {!! Form::password('password_confirm',['id'=>'password_confirm','class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-12 col-lg-2 form-group margin-top-30">
                        <a href="#!" class="col-xs-12 cursor_pointer btn-submit btn btn-primary right" id="btn-password-empresario">Guardar</a>
                    </div>
                    {!! Form::hidden('id',$user->id) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/usuario/password_empresario.js')}}"></script>
@stop


