{{-- Cuerpo del layout de Inglés (antes layout_ingles L125-147): menú de inglés, contenido, pie y @yield('scripts'). --}}


@section('menu_ingles')
    @if (Auth::guest())
        @include('partials.menu_register')
    @else
        @include('ingles.inicio_ingles.menu_ingles')

    @endif
@show

<div class="tesvb-contenido">
@yield('content')
</div>

@section('footer')
    @include('partials.footer')
@show

<!-- Scripts -->

@yield('scripts')

