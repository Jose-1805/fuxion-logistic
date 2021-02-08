@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Crear estado de operador logístico</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-nuevo-estado-operador-logistico'])
            </div>
            {!! Form::open(['id'=>'form-crear-estado-operador-logistico']) !!}
                @include('estado_operador_logistico.form')

                <div class="col-xs-12 text-center margin-top-20">
                    <a class="btn btn-success btn-radius" id="btn-guardar-estado-operador-logistico"><i class="fa fa-save margin-right-10"></i>Guardar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/estado_operador_logistico/crear.js')}}"></script>
@stop


