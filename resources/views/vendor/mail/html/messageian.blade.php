@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <a href="https://ianshop.ec"> <img class="logo-name img-fluid" style="max-width: 280px;" src="{{ asset('images/logos/IanShopSlogan.png') }}"></a>
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
            IanShop&Delivery Compra Segura<br>
            Calle Carapungo y Murgueitio Salvador Oe5-135 Sector Calderón Norte de Quito.<br>
            &copy; IANSHOP v1.0 - Compuvid ® {{ date('Y') }} Todos los Derechos Reservados.
        @endcomponent
    @endslot
@endcomponent
