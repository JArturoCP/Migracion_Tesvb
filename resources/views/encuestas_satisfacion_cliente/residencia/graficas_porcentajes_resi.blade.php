@extends('layouts.panel')
@section('title', 'Resultados de encuestas de Residencia Profesional')
@include('partials.panel.recursos_app', ['graficas' => true])

@section('content')
    @include('encuestas_satisfacion_cliente.partials.resultados_servicio_residencia', [
        'titulo' => 'Resultados de encuestas de Residencia Profesional',
        'nombrePeriodo' => $periodo->periodo,
        'migas' => ['Periodos de las encuestas' => url('/encuestas_satisfaccion/agregar_periodo_year_residencia/')],
    ])
@endsection
