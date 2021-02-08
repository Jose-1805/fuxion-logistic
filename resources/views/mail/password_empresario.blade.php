@component('mail::message')
# Estimad@ {{$user->nombres.' '.$user->apellidos}}

Hemos recibido una solicitud de cambio de contraseña con sus datos en <a href="{{url('/')}}">FuXion Logistic</a>.
Para realizar el cambio de contraseña haga click sobre el botón cambiar contraseña.

@component('mail::button', ['url' => url('/usuario/password-empresario/'.\Illuminate\Support\Facades\Crypt::encryptString($user->id).'/'.$user->token)])
Cambiar contraseña
@endcomponent

@endcomponent
