@extends('layouts.panel')
@section('title', 'Datos personales de Titulación')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @include('titulacion.jefe_titulacion.autorizar_seg_parte.listado_datos_personales', ['seccion' => 'modificacion'])
@endsection
