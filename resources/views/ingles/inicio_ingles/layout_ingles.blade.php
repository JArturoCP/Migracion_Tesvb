{{--
    Layout de Inglés (profesor de inglés, alumno y coordinación de inglés / unidad 19).
    - Con sesión iniciada, las partes se muestran dentro del sidebar y el header del panel (layouts/marco.blade.php),
      con el mismo <head> (Bootstrap 3, jQuery, Vue 1, DataTables, Highcharts…) y el mismo contenido.
    - Sin sesión (invitados) se muestra el diseño original.
    Partes: ingles/inicio_ingles/partials/cabeza (contenido de <head>), encabezado (franja superior) y cuerpo
    (menú de inglés, @yield('content'), pie y @yield('scripts')).
--}}
@if(Auth::check())
@include('layouts.marco', ['cabeza' => 'ingles.inicio_ingles.partials.cabeza', 'cuerpo' => 'ingles.inicio_ingles.partials.cuerpo', 'moduloIngles' => true])
@else
<!DOCTYPE html>
<html lang="en">
<head>
@include('ingles.inicio_ingles.partials.cabeza')
    @include('layouts.tipografia')
@include('partials.panel.fechas')
</head>

<body>


@include('ingles.inicio_ingles.partials.encabezado')



@include('ingles.inicio_ingles.partials.cuerpo')

</body>
</html>
@endif
