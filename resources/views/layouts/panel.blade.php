{{--
    Layout del nuevo diseño (TailAdmin + Tailwind v4).
    Ofrece las mismas secciones que layouts/app.blade.php (title y content), más @stack('scripts'),
    para que migrar una pantalla sea cambiar su @extends('layouts.app') por @extends('layouts.panel').
    No carga Bootstrap, jQuery, Vue 1 ni recursos externos: todo sale de @vite.
    Estructura igual a la del marco de los módulos (layouts/marco.blade.php): scroll de la página completa,
    sidebar sticky y header sticky. Clases de Tailwind con prefijo tw: (resources/css/marco.css).
--}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') · TESVB</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Aplica el modo oscuro antes de pintar para evitar el parpadeo (misma clave que la plantilla). --}}
    <script>
        try {
            if (JSON.parse(localStorage.getItem('darkMode'))) document.documentElement.classList.add('dark');
        } catch (e) {}
    </script>

    @vite(['resources/css/marco.css', 'resources/js/panel.js'])
</head>
<body
    x-data="{ page: 'inicio', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
    x-init="
        try { darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? false; } catch (e) { darkMode = false; }
        $watch('darkMode', value => { try { localStorage.setItem('darkMode', JSON.stringify(value)); } catch (e) {} })"
    class="tw-marco tw:bg-gray-50"
    :class="{ 'dark tw:bg-gray-900': darkMode === true }"
>
    <div class="tw:flex tw:min-h-screen" data-panel-marco>
        @include('partials.panel.sidebar')

        <div class="tw:relative tw:flex tw:min-w-0 tw:flex-1 tw:flex-col tw:overflow-x-clip" data-panel-area>
            <main id="main-content">
                @include('partials.panel.header')

                <div class="tw:mx-auto tw:max-w-(--tw-breakpoint-2xl) tw:p-4 tw:pb-20 tw:md:p-6 tw:md:pb-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    {{-- Modal de cambio de periodo: misma condición que layouts/app.blade.php (@section part_modal_periodos). --}}
    @if (!Auth::guest())
        @include('partials.panel.periodos')
    @endif

    @stack('scripts')
</body>
</html>
