{{--
    Pantalla intermedia de /home. HomeController@index la devuelve después de poner en la sesión las
    banderas del rol (sin cambios) y el navegador pasa de inmediato a /inicio.
    Página mínima con el diseño del panel (marco.css): logo centrado e indicador de carga de la plantilla.
    Ya no usa layouts.app: el menú viejo no se muestra. Lo que ese menú escribía en la sesión
    (id_carrera del docente con actividad) lo hace igual el sidebar del panel en /inicio.
--}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cargando… · TESVB</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script>window.location.replace('/inicio');</script>

    @include('layouts.tipografia')
    @vite(['resources/css/marco.css'])
    @include('partials.panel.tema_estudiantil')
</head>
<body class="tw-modulo tw:bg-gray-50">
    <main class="tw:flex tw:min-h-screen tw:flex-col tw:items-center tw:justify-center tw:gap-8 tw:p-6" role="status" aria-live="polite" data-panel-cargando>
        <img src="{{ asset(config('tesvb.logo')) }}" alt="TESVB" class="tw:block tw:h-auto tw:w-56">
        <div class="tw:size-12 tw:animate-spin tw:rounded-full tw:border-4 tw:border-solid tw:border-brand-500 tw:border-t-transparent" aria-hidden="true"></div>
        <p class="tw:text-sm tw:text-gray-500">Cargando…</p>
        <noscript>
            <a href="/inicio" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600">Continuar al inicio</a>
        </noscript>
    </main>
</body>
</html>
