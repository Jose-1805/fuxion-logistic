<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

@section('css')
    <!-- Styles -->
    <link href="{{asset('css/helpers.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('DataTables-1.10.15/media/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/global.css')}}" rel="stylesheet" type="text/css">

    <link href="{{url('kartik_v_bootstrap_fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/redesign.css')}}" rel="stylesheet" type="text/css">
@show
</head>
<body id="body">
<?php
        //dd(trim($_SERVER['REQUEST_URI'],'/'));
        //dd(explode('/',trim('/',$_SERVER['REQUEST_URI'])));
?>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top header hide">
            @include('layouts.sections.nav_bar')
        </nav>

        <div class="container-fluid" style="">
            <div class="row">
                @if(Auth::check())
                    <div class="col-xs-8 col-sm-4 col-md-3 col-lg-2 hidden-sm hidden-xs no-padding" id="contenedor-menu">
                        <div class="right contenedor-btn-menu visible-xs visible-sm"><a href="#!"><i class="fa fa-times-circle-o font-large margin-10"></i></a></div>
                        @include('layouts.sections.menu')
                    </div>
                @endif
                    <div class="col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 no-padding">


                        @if(Auth::check())
                            <div class="col-xs-12 no-padding no-margin">
                                <ol class="breadcrumb hide" style="" id="breadcrump">
                                </ol>
                                <div id="data-user">
                                    @if(Auth::check())
                                        <p class="right padding-top-5">
                                            <strong><i class="fa fa-user"></i> Bienvenido(a): </strong>{{ Auth::user()->nombres.' '.Auth::user()->apellidos }}
                                            | <a href="{{url('/configuracion')}}" class=""><i class="fa fa-cogs font-large"></i></a> | <a href="#!" class="btn-sm btn-primary" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                                        </p>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    @endif
                                </div>

                                <div class="col-xs-12 contenedor-btn-menu visible-sm visible-xs"><a href="#!"><i class="fa fa-bars fa-2x left"></i></a></div>
                            </div>
                        @endif

                        <div class="col-xs-12" id="contenedor-principal">
                            @yield('content')
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="general_url" value="{{url('/')}}">
    <input type="hidden" id="general_token" value="{{csrf_token()}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function () {
            var home = "<li><a href='"+window.location.origin+"/home' class=''>Inicio</a></li>";

            var path = window.location.pathname;
            path = path.substr(1,path.length);
            var links = "";
            var lastUrl = window.location.origin;

            var excepciones = {login:'login',password:'password',public:'public',home:'home'};
            var mostrar_breadcrump = true;
            if(path.length > 0) {
                for (var i = 0; i < path.split("/").length; i++) {
                    if(excepciones[path.split("/")[i]] != undefined && i == 0){
                        mostrar_breadcrump = false;
                    }
                    if(path.split('/')[(i+1)] && $.isNumeric(path.split('/')[(i+1)])){
                        links += "<li><a href='"+lastUrl+"/"+path.split('/')[i]+"/"+path.split('/')[(i+1)]+"' class=''>"+path.split('/')[i].replace(/-/g," ")+"</a></li>";
                        break;
                    }else {
                        if(path.split('/')[i] != "home") {
                            var get="";
                            if((i+1) == path.split("/").length)
                                get = window.location.search;
                            links += "<li><a href='" + lastUrl + "/" + path.split('/')[i] +  get +  "' class=''>" + path.split('/')[i].replace(/-/g," ") + "</a></li>";
                            lastUrl = lastUrl + "/" + path.split('/')[i];
                        }
                    }
                }
            }

            if(links.length && mostrar_breadcrump) {
                $("#breadcrump").html(home + links + $('#data-user').html());
                $('#data-user').html('');
                $("#breadcrump").removeClass("hide");
            }
        })
    </script>
    @section('js')
        <script src="https://use.fontawesome.com/a8d29b5cc4.js"></script>
        <script src="{{asset('js/blockUi.js')}}"></script>
        <script src="{{asset('js/numeric.js')}}"></script>
        <script src="{{asset('js/global.js')}}"></script>
        <script src="{{asset('js/params.js')}}"></script>
        <script src="{{asset('DataTables-1.10.15/media/js/jquery.dataTables.js')}}"></script>
        <script src="{{url('kartik_v_bootstrap_fileinput/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
        <script src="{{url('kartik_v_bootstrap_fileinput/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
        <script src="{{url('kartik_v_bootstrap_fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
        <script src="{{url('kartik_v_bootstrap_fileinput/js/fileinput.min.js')}}"></script>
        <script src="{{url('kartik_v_bootstrap_fileinput/js/locales/es.js')}}"></script>
    @show
</body>
</html>
