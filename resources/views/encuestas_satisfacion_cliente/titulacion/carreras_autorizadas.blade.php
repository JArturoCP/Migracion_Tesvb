@extends('layouts.panel')
@section('title', 'Programas de estudio · Encuestas contestadas de Titulación')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_t') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_encuesta_estudiante_titulacion'), 'Periodos de las encuestas' => url($base.'menu_historial_titulacion_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'enviar_encuesta_estudiante_titulacion')];
        $nombrePeriodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
    @endphp

    <x-panel.encabezado titulo="Programas de estudio" :migas="$migas" />
    <div class="tw:space-y-5">
        <x-panel.tarjeta titulo="Encuestas contestadas de Titulación" :subtitulo="$nombrePeriodo">
            <p class="tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $encuestas_autorizadas->contar }}</p>
        </x-panel.tarjeta>
        @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
            'mostrarEncabezado' => false,
            'titulo' => 'Selecciona un programa de estudio',
            'periodo_nom' => null,
            'urlAlumnos' => url($base.'enc_est_ti_carrera_termino'),
            'sufijoRuta' => '/'.$mes.'/'.$year,
        ])
    </div>
@endsection
