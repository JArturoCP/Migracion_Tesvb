{{--
    Layout de Tutorías.
    - Con sesión iniciada, las partes se muestran dentro del sidebar y el header del panel (layouts/marco.blade.php).
    - Sin sesión (invitados) se muestra el diseño original.
    Partes: tutorias/partials/cabeza (contenido de <head>), encabezado (franja superior) y cuerpo
    (menú interno, avisos, modal de periodos, @yield('content') y pie).
--}}
@if(Auth::check())
@include('layouts.marco', ['cabeza' => 'tutorias.partials.cabeza', 'cuerpo' => 'tutorias.partials.cuerpo'])
@else
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('tutorias.partials.cabeza')
    @include('layouts.tipografia')
</head>
<body>
@include('tutorias.partials.encabezado')
@include('tutorias.partials.cuerpo')
</body>
</html>
@endif
