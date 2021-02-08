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
    <div class="row" style="margin-top: 15%;">
        <div class="col-md-4 col-md-offset-2 hidden-sm hidden-xs" style="">
            <img class="col-xs-12" src="{{url('/imagenes/sistema/logo_express.png')}}">
            <div style="width: 2px; height: 400px;background-color: #FFFFFF;float: right;margin-top: -300px;"></div>
        </div>
        <div class="col-md-4">
            <form class="" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? '' : '' }}">
                    <label for="email" class="control-label">NOMBRE DE USUARIO</label>

                    <div class="">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong class="red-text text-lighten-2">{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">CONTRASEÑA</label>

                    <div class="">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <a class="btn btn-link white-text" href="{{ route('password.request') }}">
                        ¿Olvidó su contraseña?
                    </a>
                </div>

                <div class="form-group padding-left-10">
                    <div class="">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-success btn-radius">
                            <i class="fa fa-arrow-right margin-right-10"></i> INGRESAR
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://use.fontawesome.com/a8d29b5cc4.js"></script>
</body>
</html>
