@extends('layouts.panel')
@section('title', 'Programas de estudio · Encuestas de Titulación')

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
        <x-panel.tarjeta titulo="Encuestas de Titulación" :subtitulo="$nombrePeriodo">
            <dl class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                @foreach (['Encuestas enviadas' => $encuestas_enviadas->contar, 'Encuestas contestadas' => $encuestas_autorizadas->contar] as $etiqueta => $total)
                    <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-4 tw:dark:border-gray-700 tw:dark:bg-white/5">
                        <dt class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">{{ $etiqueta }}</dt>
                        <dd class="tw:mt-2 tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $total }}</dd>
                    </div>
                @endforeach
            </dl>
        </x-panel.tarjeta>

        @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
            'mostrarEncabezado' => false,
            'titulo' => 'Selecciona un programa de estudio',
            'periodo_nom' => null,
            'urlAlumnos' => url($base.'encuesta_estudiante_titulacion_carrera'),
            'sufijoRuta' => '/'.$year.'/'.$mes,
        ])
    </div>
@endsection
