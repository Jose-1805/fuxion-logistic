@extends('layouts.app')

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Roles</p>
            <div class="col-xs-12 margin-top-10"></div>
            <div class="col-md-5 no-padding" style="min-height: 100px;" id="contenedor-roles">
            </div>

            <div class="col-md-5" style="min-height: 100px;" id="contenedor-privilegios">
                @include('rol.lista_privilegios')
            </div>
            <div class="col-md-2">
                <?php $disabled = '';?>
                @if(!Auth::user()->tieneFuncion(2,1,$privilegio_superadministrador))
                    <?php $disabled = 'disabled'; ?>
                @endif
                <a class="btn btn-block btn-success btn-radius-sm" data-toggle="modal" @if($disabled == '') data-target="#modal-nuevo-rol" @endif {{$disabled}}><i class="fa fa-plus margin-right-10"></i>Nuevo Rol</a>
            </div>
        </div>
    </div>
    @include('rol.modales')
@endsection

@section('js')
    @parent
    <script src="{{asset('js/rol/roles.js')}}"></script>
@stop


