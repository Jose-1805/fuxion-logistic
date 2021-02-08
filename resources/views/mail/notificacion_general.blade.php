@component('mail::message')
# Estimad@ {{$user->nombres.' '.$user->apellidos}}

{!! $notificacion !!}

@if($boton)
    @component('mail::button', ['url' => $url_boton])
    {{$texto_boton}}
    @endcomponent
@endif

@endcomponent
