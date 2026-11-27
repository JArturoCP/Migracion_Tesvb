@extends('layouts.panel')
@section('title', 'Resultados de inscripción')
@include('partials.panel.recursos_app', ['graficas' => true])

@section('content')
    @include('encuestas_satisfacion_cliente.partials.resultados_escolares', [
        'titulo' => 'Resultados de inscripción',
        'urlPeriodos' => url('/encuestas_satisfaccion/encuesta_incripcion_periodo'),
    ])
@endsection
