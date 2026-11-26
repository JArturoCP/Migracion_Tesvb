{{--
    Marco del panel nuevo alrededor de las pantallas de los módulos.

    Lo incluye un layout de origen (p. ej. tutorias/app_tutorias.blade.php) cuando hay sesión iniciada,
    con dos parámetros:
      $cabeza  vista con el contenido de <head> del layout de origen (mismos CSS y JS de siempre:
               Bootstrap, jQuery, DataTables, Vue, FullCalendar…), para que los módulos funcionen igual.
      $cuerpo  vista con el contenido del layout de origen que rodea a @yield('content'): menú interno,
               avisos, modales, contenido y pie. Se muestra sin cambios.

    Solo cambian el sidebar y el header, que son los del panel (/inicio). El contenido va dentro de
    x-ignore para que Alpine no interprete los atributos de las plantillas Vue (@click, :class…).
    Modo oscuro: el botón del header está también aquí (misma preferencia localStorage.darkMode), pero solo
    cambia el sidebar y el header; el contenido del módulo (Bootstrap) se queda claro.
--}}
<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.panel.modo_oscuro')
    @include($cabeza)

    @include('layouts.tipografia')
    @vite(['resources/css/marco.css', 'resources/js/panel.js'])
@include('partials.panel.fechas')
    @include('partials.panel.tema_estudiantil')
</head>
<body x-data="{ page: 'modulo', darkMode: false, sidebarToggle: false }"
    x-init="(() => {
        try { darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? false; } catch (e) { darkMode = false; }
        $watch('darkMode', value => { try { localStorage.setItem('darkMode', JSON.stringify(value)); } catch (e) {} });
    })()">
    <div class="tw:flex tw:min-h-screen" data-panel-marco>
        @include('partials.panel.sidebar')

        <div class="tw:relative tw:flex tw:min-w-0 tw:flex-1 tw:flex-col tw:overflow-x-clip" data-panel-area>
            @include('partials.panel.header')

            <div id="main-content" x-ignore data-panel-contenido-modulo data-tema-estudiantil="bootstrap"
                @if (!empty($moduloIngles)) data-modulo-ingles @endif>
                @include($cuerpo)
            </div>
        </div>
    </div>

    {{-- Modal de cambio de periodo del header (mismos enlaces /periodo/{id}). --}}
    @if (!Auth::guest())
        @include('partials.panel.periodos')
    @endif
</body>
</html>
