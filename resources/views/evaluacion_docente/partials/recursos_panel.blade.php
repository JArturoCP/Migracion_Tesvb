{{--
    Librerías de las pantallas de Evaluación docente migradas al panel (layouts/panel), tomadas de
    layouts/app.blade.php y en el mismo orden, SIN Bootstrap (ni su CSS ni su JS):
      - jQuery (/js/jquery.min.js), Font Awesome 4.7 (sustituye a los glyphicons de Bootstrap 3),
        SweetAlert2 y tesvb-notify (TNotify y alert/confirm del sistema);
      - con $datatables: DataTables 1.13.6 local (npm, public/vendor/datatables), FixedHeader,
        accent-neutralise y tesvb-datatables (textos en español y formato común);
      - con $graficas: Highcharts y su módulo de exportación (mismos archivos de /js).
--}}
@push('cabeza')
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}?v=11.26.25">
    @if ($datatables ?? false)
        <script src="{{ asset('vendor/datatables/1.13.6/jquery.dataTables.min.js') }}"></script>
        <script src="/js/accent-neutralise.js"></script>
        <script src="/js/dataTables.fixedHeader.min.js"></script>
        <script src="{{ asset('js/tesvb-datatables.js') }}?v={{ filemtime(public_path('js/tesvb-datatables.js')) }}"></script>
    @endif
    @if ($graficas ?? false)
        <script src="/js/highcharts.js"></script>
        <script src="/js/modules/exporting.js"></script>
    @endif
    <script src="{{ asset('js/sweetalert2.min.js') }}?v=11.26.25"></script>
    <script src="{{ asset('js/tesvb-notify.js') }}?v={{ filemtime(public_path('js/tesvb-notify.js')) }}"></script>
@endpush
