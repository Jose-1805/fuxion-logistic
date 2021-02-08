@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Editar estado de operador logístico</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-editar-estado-operador-logistico'])
            </div>
            {!! Form::model($estado_operador_logistico,['id'=>'form-editar-estado-operador-logistico']) !!}
                {!! Form::hidden('id',$estado_operador_logistico->id) !!}
                @include('estado_operador_logistico.form')

                <div class="col-xs-12 margin-top-20 text-center">
                    <a class="btn btn-success btn-radius" id="btn-editar-estado-operador-logistico"><i class="fa fa-save margin-right-10"></i>Guardar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/estado_operador_logistico/editar.js')}}"></script>
@stop


