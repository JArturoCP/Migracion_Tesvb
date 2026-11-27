@extends('layouts.panel')
@section('title', 'Resultados de reinscripción')
@include('partials.panel.recursos_app', ['graficas' => true])

@section('content')
    @include('encuestas_satisfacion_cliente.partials.resultados_escolares', [
        'titulo' => 'Resultados de reinscripción',
        'urlPeriodos' => url('/encuestas_satisfaccion/encuesta_reincripcion_periodo'),
    ])
@endsection
