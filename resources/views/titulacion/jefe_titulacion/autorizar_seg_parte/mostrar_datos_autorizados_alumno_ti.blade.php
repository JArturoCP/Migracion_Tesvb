@extends('layouts.panel')
@section('title', 'Datos personales autorizados')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])

@section('content')
    @include('titulacion.jefe_titulacion.autorizar_seg_parte.consulta_datos_autorizados', [
        'migas' => ['Entrega pendiente' => url('/titulacion/faltante_datos_alumno/'.$id_carrera)],
    ])
@endsection
