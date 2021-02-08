@component('mail::message')
<h1 class="text-center">{{$titulo}}</h1>

{!! $mensaje !!}

@if($boton)
@component('mail::button', ['url' => $url_boton])
    {!! $texto_boton !!}
@endcomponent
@endif

@endcomponent
