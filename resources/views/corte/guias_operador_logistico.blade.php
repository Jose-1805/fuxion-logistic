@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        {!! Form::open(['id'=>'form-reasignar-guias-operador-logistico']) !!}
            <div class="row">
                <p class="titulo_principal margin-bottom-20">Guías asignadas a operador logístico <strong>{{$operador_logistico->nombre}}</strong> en corte <strong>#{{$corte->numero}}</strong></p>

                <div class="col-xs-12">
                    @include('layouts.alertas',['id_contenedor'=>'guias-operador-logistico'])
                </div>

                <table id="tabla-guias-operador-logistico" class="table-hover">
                    <thead>
                        <th>Fecha guía</th>
                        <th>Destino</th>
                        <th>Serie</th>
                        <th>Correlativo</th>
                        <th>Tipo empresario</th>
                        <th>Empresario</th>
                        <th>Seleccione</th>
                    </thead>
                </table>
            </div>
            {!! Form::hidden('operador_logistico',$operador_logistico->id,['id'=>'operador_logistico']) !!}
            {!! Form::hidden('corte',$corte->id,['id'=>'corte']) !!}
            <div class="row margin-top-20">
                <div class="col-md-4 text-right padding-top-5">
                    {!! Form::label('operador','Reasignar operador logístico') !!}
                </div>

                <div class="col-sm-4">
                    {!! Form::select('operador',[''=>'Seleccione un operador logístico']+\FuxionLogistic\Models\OperadorLogistico::where('id','<>',$operador_logistico->id)->pluck('nombre','id')->toArray(),null,['id'=>'operador','class'=>'form-control']) !!}
                </div>

                <div class="col-sm-4">
                    <a class="btn btn-success btn-radius" id="btn-reasignar-operador-logistico">Guardar cambios</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('js')
    @parent
    <script src="{{asset('js/corte/guias_operador_logistico.js')}}"></script>
@stop


