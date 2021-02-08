@extends('layouts.app')

@section('css')
    @parent

    <link href="{{asset('css/configuracion.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Configuraciones</p>

            <div class="col-xs-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-configuraciones'])
            </div>

            <a class="opcion-configuracion col-xs-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-contrasena">
                <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                    <i class="fa fa-unlock-alt fa-3x" style="padding-bottom: 4px;"></i>
                </div>
                <p class="text-center col-xs-12 truncate no-padding">Contraseña</p>
            </a>
            <a class="opcion-configuracion col-xs-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-desbloquear-dispositivo">
                <div class="col-xs-12 text-center padding-bottom-10">
                    <i class="fa fa-mobile fa-4x"></i>
                </div>
                <p class="text-center col-xs-12 truncate no-padding">Desbloquear dispositivo</p>
            </a>

            @if(Auth::user()->esSuperadministrador())
                <a class="opcion-configuracion col-xs-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-imagen-empresario">
                    <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                        <i class="fa fa-file-picture-o fa-3x" style="padding-bottom: 4px;"></i>
                    </div>
                    <p class="text-center col-xs-12 truncate no-padding">Imagen app empresario</p>
                </a>
            @endif

            <a class="opcion-configuracion col-xs-6 col-sm-4 col-md-3 col-lg-2 app-ios" href="#!" data-toggle="modal" data-target="#modal-app-ios">
                <div class="col-xs-12 text-center padding-bottom-10">
                    <i class="fa fa-apple fa-4x"></i>
                </div>
                <p class="text-center col-xs-12 truncate no-padding">Fuxion track IOS</p>
            </a>

            <a class="opcion-configuracion col-xs-6 col-sm-4 col-md-3 col-lg-2" href="{{url('archivo/app-movil-fuxion_track.apk')}}">
                <div class="col-xs-12 text-center padding-bottom-10">
                    <i class="fa fa-android fa-4x"></i>
                </div>
                <p class="text-center col-xs-12 truncate no-padding">Fuxion track Android</p>
            </a>
        </div>
    </div>

    @include('configuracion.modales')
@endsection

@section('js')
    @parent
    <script src="{{asset('js/configuracion/index.js')}}"></script>
    <script>
        $(function () {
            $("#imagen").fileinput(
                {
                    previewSettings: {
                        image:{width:"auto", height:"160px"},
                    },
                    allowedFileTypes:['image'],
                    AllowedFileExtensions:['jpg'],
                    removeFromPreviewOnError:true,
                    showCaption: false,
                    showUpload: false,
                    showClose:false,
                    maxFileSize : 500,
                    initialPreview: [
                        @if(file_exists(storage_path('app/default/0/usuario.jpg')))
                            "<img src='{{url('/archivo/app-default-0-usuario.jpg')}}' class='col-xs-12'>",
                        @endif
                    ]
                }
            );
        })
    </script>
@stop


