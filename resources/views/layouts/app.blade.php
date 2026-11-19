<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{asset('datepicker/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('datepicker/css/bootstrap-datepicker.standalone.css')}}">

    <!-- 🟩 DataTables (VERSIÓN CORRECTA) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/tesvb-datatables.css') }}?v={{ filemtime(public_path('css/tesvb-datatables.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/tesvb-responsivo.css') }}?v={{ filemtime(public_path('css/tesvb-responsivo.css')) }}">

    <!-- Otros estilos -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}?v=11.26.25">
    <link href="{{ asset('open-iconic-master/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/bootstrap-toggle.css" rel="stylesheet">
    <link href="/css/timepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/themes/default.css">
    <link rel="stylesheet" href="/css/themes/default.time.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap-colorpicker.css" rel="stylesheet">
    <link href="/css/jquery.timepicker.css" rel="stylesheet">

    <!-- Tipografía accesible: Atkinson Hyperlegible Next -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/tesvb-typography.css') }}?v={{ filemtime(public_path('css/tesvb-typography.css')) }}"
    >

    @stack('styles')

    <script type="application/javascript" src="/js/jquery-ui.js"></script>
    <script type="application/javascript" src="/js/tooltip.js"></script>

    <script src="{{asset('datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

    <script src="/js/bootstrap-colorpicker.js"></script>
    <script src="/js/bootstrap-toggle.js"></script>

    <!-- VALIDACIONES -->
    <script src="/js/validate.min.js"></script>

    <!-- ❌ Se quitan las versiones rotas de DataTables:
        /js/jquery.dataTables.min.js
        /js/dataTables.bootstrap.min.js
        /css/dataTables.bootstrap.min.css
     -->

    <!-- 🟩 DataTables (JS correcto, versión 1.13.6 compatible con BS3) -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>

    <!-- Otros scripts -->
    <script src="/js/accent-neutralise.js"></script>
    <script src="/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('js/tesvb-datatables.js') }}?v={{ filemtime(public_path('js/tesvb-datatables.js')) }}"></script>
    <script src="/js/jquery.blockUI.js"></script>
    <script src="/js/highcharts.js"></script>
    <script src="/js/modules/exporting.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}?v=11.26.25"></script>

    <script src="/js/picker.js"></script>
    <script src="/js/picker.time.js"></script>
    <script src="/js/legacy.js"></script>

    <!-- Notificaciones TESVB (reemplazo de alert/confirm/prompt) -->
    <script src="{{ asset('js/tesvb-notify.js') }}?v={{ filemtime(public_path('js/tesvb-notify.js')) }}"></script>

</head>

<body class="@yield('body_class')">

@section('header')
    @include('partials.head')
@show

@section('menu')
    @if (Auth::guest())
        @include('partials.menu_register')
    @else
        @include('partials.menu_admin')
    @endif
@show

@section('part_modal_periodos')
    @if (!Auth::guest())
        @include('partials.periodos')
    @endif
@show

<div class="tesvb-contenido">
@yield('content')
</div>

@section('footer')
    @include('partials.footer')
@show

</body>
</html>
