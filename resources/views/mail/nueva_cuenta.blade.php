@component('mail::message')
# Estimad@ {{$user->nombres.' '.$user->apellidos}}

Ha sido creada una nueva cuenta de usuario con sus datos en <a href="{{url('/')}}">FuXion Logistic</a>.
Para validar su cuenta haga click sobre el botón validar.

@component('mail::button', ['url' => url('/usuario/validar-cuenta/'.\Illuminate\Support\Facades\Crypt::encryptString($user->id).'/'.$user->token)])
Validar
@endcomponent

@endcomponent
