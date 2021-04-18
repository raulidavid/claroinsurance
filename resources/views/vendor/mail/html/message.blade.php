@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{-- config('app.name') --}}
            <a href="{{ url('/') }}"> <img class="logo-name " src="{{ asset('images/logos/logo.png') }}" alt="Market&Delivery Logo"></a>
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @if (isset($subcopy))
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endif

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            {{-- Outro Lines --}}
            Market&Delivery Servicio a Domicilio S.A.<br>
            Av. Galo Plaza Lasso N52-30 y Algarrobos (Sector La Luz)<br>
            &copy; MADSIS v1.0 - Market and Delivery ® {{ date('Y') }} Todos los Derechos Reservados.
        @endcomponent
    @endslot
@endcomponent
