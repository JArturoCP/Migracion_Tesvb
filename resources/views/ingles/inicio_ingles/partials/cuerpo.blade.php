{{-- Cuerpo del layout de Inglés (antes layout_ingles L125-147): menú de inglés, contenido, pie y @yield('scripts').
     Dentro del marco del panel ($moduloIngles) el menú de inglés no se repite: todas sus opciones están en el
     submenú "Inglés" del sidebar (partials/panel/menu_ingles), "Salir" y el periodo de inglés en el header, y
     su modal "Modificar periodo" al final del sidebar. Sin sesión se muestra igual que antes. --}}


@section('menu_ingles')
    @if (Auth::guest())
        @include('partials.menu_register')
    @elseif(empty($moduloIngles))
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

