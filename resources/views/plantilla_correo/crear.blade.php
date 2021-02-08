@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Crear plantilla de correo</p>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-nueva-plantilla-correo'])
            </div>
            {!! Form::open(['id'=>'form-crear-plantilla-correo']) !!}
                @include('plantilla_correo.form')

                <div class="col-xs-12 text-center margin-top-20">
                    <a class="btn btn-success btn-radius btn-submit" id="btn-guardar-plantilla-correo"><i class="fa fa-save margin-right-10"></i>Guardar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/plantilla_correo/crear.js')}}"></script>
@stop


