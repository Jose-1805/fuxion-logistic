@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Editar malla de cobertura</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-editar-malla-cobertura'])
            </div>
            {!! Form::model($malla_cobertura,['id'=>'form-editar-malla-cobertura']) !!}
                {!! Form::hidden('id',$malla_cobertura->id,['id'=>'id']) !!}
                @include('malla_cobertura.form')

                <div class="col-xs-12 text-center margin-top-20">
                    <a href="#!" class="cursor_pointer btn-submit btn btn-success btn-radius" id="btn-actualizar-malla-cobertura"><i class="fa fa-save margin-right-10"></i>Guardar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/malla_cobertura/editar.js')}}"></script>
@stop