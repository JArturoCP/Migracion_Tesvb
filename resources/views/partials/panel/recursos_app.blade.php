{{--
    Librerías de las pantallas que venían de layouts/app.blade.php y ya están migradas al panel
    (layouts/panel), en el mismo orden que layouts.app y SIN Bootstrap (ni su CSS ni su JS):
      - siempre: jQuery (/js/jquery.min.js), Font Awesome 4.7 (sustituye a los glyphicons de Bootstrap 3),
        SweetAlert2 y tesvb-notify (TNotify, alert/confirm del sistema y swal() compatible con la API anterior);
      - con $colorpicker: bootstrap-colorpicker (plugin de jQuery; no necesita Bootstrap);
      - con $validacion: jQuery Validate (/js/validate.min.js);
      - con $datatables: DataTables 1.13.6 local (npm, public/vendor/datatables), FixedHeader,
        accent-neutralise y tesvb-datatables (textos en español y formato común);
      - con $blockui: jquery.blockUI; con $graficas: Highcharts y su módulo de exportación.
    Ojo: si el script de la pantalla llama a un plugin (aunque sea fuera de $(document).ready), hay que
    cargarlo; si no, el error detiene todo el script.
    Uso: @include('partials.panel.recursos_app', ['datatables' => true, 'validacion' => true])
--}}
@push('cabeza')
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}?v=11.26.25">
    @if ($colorpicker ?? false)
        <link rel="stylesheet" href="/css/bootstrap-colorpicker.css">
        <script src="/js/bootstrap-colorpicker.js"></script>
    @endif
    @if ($validacion ?? false)
        <script src="/js/validate.min.js"></script>
    @endif
    @if ($datatables ?? false)
        <script src="{{ asset('vendor/datatables/1.13.6/jquery.dataTables.min.js') }}"></script>
        <script src="/js/accent-neutralise.js"></script>
        <script src="/js/dataTables.fixedHeader.min.js"></script>
        <script src="{{ asset('js/tesvb-datatables.js') }}?v={{ filemtime(public_path('js/tesvb-datatables.js')) }}"></script>
    @endif
    @if ($blockui ?? false)
        <script src="/js/jquery.blockUI.js"></script>
    @endif
    @if ($graficas ?? false)
        <script src="/js/highcharts.js"></script>
        <script src="/js/modules/exporting.js"></script>
    @endif
    <script src="{{ asset('js/sweetalert2.min.js') }}?v=11.26.25"></script>
    <script src="{{ asset('js/tesvb-notify.js') }}?v={{ filemtime(public_path('js/tesvb-notify.js')) }}"></script>
@endpush
