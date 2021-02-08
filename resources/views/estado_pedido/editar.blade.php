@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Editar estado de pedido</p>

            <div class="col-xs-12 margin-top-10">
                @include('layouts.alertas',['id_contenedor'=>'alertas-editar-estado-pedido'])
            </div>
            {!! Form::model($estado_pedido,['id'=>'form-editar-estado-pedido']) !!}
                {!! Form::hidden('id',$estado_pedido->id) !!}
                @include('estado_pedido.form')

                <div class="col-xs-12 text-center margin-top-20">
                    <a class="btn btn-success btn-radius btn-submit" id="btn-editar-estado-pedido"><i class="fa fa-save margin-right-10"></i>Guardar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{asset('js/estado_pedido/editar.js')}}"></script>
@stop


