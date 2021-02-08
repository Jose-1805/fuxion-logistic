<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fuxion Logistics</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="{{asset('css/full_background.css')}}" rel="stylesheet">
    <link href="{{asset('css/helpers.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/welcome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/redesign.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="col-xs-12 padding-top-20">
        <a class="btn btn-default btn-radius-sm right" href="{{ url('/login') }}"><i class="fa fa-sign-in margin-right-10"></i>Ingresar</a>
    </div>

    <div class="row" style="margin-top: 15%;">
        <div class="col-md-4 col-md-offset-2 hidden-sm hidden-xs" style="">
            <img class="col-xs-12" src="{{url('/imagenes/sistema/logo_express.png')}}">
            <div style="width: 2px; height: 400px;background-color: #FFFFFF;float: right;margin-top: -300px;"></div>
        </div>
        <div class="col-md-4">
            <p class="font-x-large text-center">Reestablecer de contraseña</p>
            <form class="" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email" class="control-label">CORREO ELECTRÓNICO</label>

                    <div class="">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong class="red-text text-lighten-2">{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-radius">
                            <i class="fa fa-send-o margin-right-10"></i>Reestablecer contraseña
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://use.fontawesome.com/a8d29b5cc4.js"></script>
</body>
</html>
