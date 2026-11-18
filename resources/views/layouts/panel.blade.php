{{--
    Layout del nuevo diseño (TailAdmin + Tailwind v4).
    Ofrece las mismas secciones que layouts/app.blade.php (title y content), más @stack('scripts'),
    para que migrar una pantalla sea cambiar su @extends('layouts.app') por @extends('layouts.panel').
    No carga Bootstrap, jQuery, Vue 1 ni recursos externos: todo sale de @vite.
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

    @vite(['resources/css/panel.css', 'resources/js/panel.js'])
</head>
<body
    x-data="{ page: 'inicio', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
    x-init="
        try { darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? false; } catch (e) { darkMode = false; }
        $watch('darkMode', value => { try { localStorage.setItem('darkMode', JSON.stringify(value)); } catch (e) {} })"
    :class="{ 'dark bg-gray-900': darkMode === true }"
>
    <div class="flex h-screen overflow-hidden">
        @include('partials.panel.sidebar')

        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
            <main id="main-content">
                @include('partials.panel.header')

                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
