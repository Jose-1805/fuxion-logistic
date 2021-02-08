@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Editar bodega</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-editar-bodega'])
            </div>
            {!! Form::model($bodega,['id'=>'form-editar-bodega']) !!}
                {!! Form::hidden('bodega',$bodega->id) !!}
                @include('bodega.form')

                <div class="col-xs-12 text-center">
                    <a class="btn btn-success btn-radius btn-submit" id="btn-editar"><i class="fa fa-save margin-right-10"></i>Guardar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js//bodega/editar.js')}}"></script>
@stop


