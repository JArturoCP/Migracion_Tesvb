{{-- Contenido de <head> del layout de Tutorías (antes en tutorias/app_tutorias.blade.php L4-45). Lo usan el layout original y el marco. --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> * Tutorias *</title>
    <!-- Scripts -->
    <script src="{{ asset('js/js_tutorias/app.js') }}"></script>
    <script src="{{asset('js/js_tutorias/highcharts.js')}}"></script>
    {{-- Módulos de la misma versión que highcharts.js local (7.1.2); los de la última versión no son compatibles. --}}
    <script src="https://code.highcharts.com/7.1.2/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/7.1.2/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/7.1.2/modules/export-data.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/css_tutorias/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_tutorias/estilo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_tutorias/bootstrap-DataTable.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tesvb-datatables.css') }}?v={{ filemtime(public_path('css/tesvb-datatables.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/tesvb-responsivo.css') }}?v={{ filemtime(public_path('css/tesvb-responsivo.css')) }}">


    <link type="text/css" rel="stylesheet" href="{{asset('css/css_tutorias/all.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/css_tutorias/app.css")}}" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{ asset('assets/css/estilos.css') }}">
    <link rel='stylesheet' href='{{ asset('css/css_tutorias/fullcalendar.css') }}' />

    <script src="{{ asset('js/js_tutorias/moment.min.js') }}" defer></script>
    <script src="{{ asset('js/js_tutorias/fullcalendar.min.js') }}" defer></script>
    <script src="{{ asset('js/js_tutorias/locale/es.js') }}" defer></script>
    <link href="{{ asset('open-iconic-master/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet" >

    <!-- Notificaciones TESVB (reemplazo de alert/confirm/prompt) -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}?v=11.26.25">
    <script src="{{ asset('js/sweetalert2.min.js') }}?v=11.26.25"></script>
    <script src="{{ asset('js/tesvb-notify.js') }}?v={{ filemtime(public_path('js/tesvb-notify.js')) }}"></script>
    <script src="{{ asset('js/tesvb-datatables.js') }}?v={{ filemtime(public_path('js/tesvb-datatables.js')) }}"></script>
