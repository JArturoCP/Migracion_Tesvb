@extends('layouts.panel')
@section('title', 'Documentación de requisitos de titulación')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.listado_expedientes', ['seccion' => 'autorizado'])
@endsection
