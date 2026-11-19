{{--
    Librerías de las pantallas de Tutorías migradas al panel (layouts/panel), tomadas de
    tutorias/partials/cabeza.blade.php y en el mismo orden, SIN el CSS de Bootstrap 4:
      - js_tutorias/app.js: jQuery, Vue 2 y axios que usan los scripts de cada pantalla (trae también
        Bootstrap JS; el puente del panel quita sus manejadores data-api y atiende modales y pestañas);
      - Font Awesome 5.8.1 (íconos fas), SweetAlert2 y tesvb-notify (alert/confirm del sistema);
      - con $calendario: moment, FullCalendar 3 y su idioma, igual que antes (defer).
--}}
@push('cabeza')
    <script src="{{ asset('js/js_tutorias/app.js') }}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}?v=11.26.25">
    <script src="{{ asset('js/sweetalert2.min.js') }}?v=11.26.25"></script>
    <script src="{{ asset('js/tesvb-notify.js') }}?v={{ filemtime(public_path('js/tesvb-notify.js')) }}"></script>
    @if ($calendario ?? false)
        <link rel="stylesheet" href="{{ asset('css/css_tutorias/fullcalendar.css') }}">
        <script src="{{ asset('js/js_tutorias/moment.min.js') }}" defer></script>
        <script src="{{ asset('js/js_tutorias/fullcalendar.min.js') }}" defer></script>
        <script src="{{ asset('js/js_tutorias/locale/es.js') }}" defer></script>
    @endif
@endpush
