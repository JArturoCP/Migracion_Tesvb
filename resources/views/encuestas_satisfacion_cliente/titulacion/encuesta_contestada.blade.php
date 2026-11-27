@extends('layouts.panel')
@section('title', 'Encuesta contestada de Titulación')
@use('App\View\EncuestaTitulacion')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_t') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_encuesta_estudiante_titulacion'), 'Periodos de las encuestas' => url($base.'menu_historial_titulacion_year/'.$registro->year)]
            : ['Periodos de las encuestas' => url($base.'enviar_encuesta_estudiante_titulacion')];
        $sufijoPeriodo = '/'.$registro->mes.'/'.$registro->year;
        $migas['Programas de estudio'] = url($base.'enc_contestadas_carreras_ti'.$sufijoPeriodo);
        $migas['Encuestas contestadas'] = url($base.'enc_est_ti_carrera_termino/'.$registro->id_carrera.$sufijoPeriodo);
        $nombre = trim($registro->nombre.' '.$registro->apaterno.' '.$registro->amaterno);
        $nombrePeriodo = ($registro->mes == 1 ? 'Enero' : 'Julio').' de '.$registro->year;
    @endphp

    <div class="tw:mx-auto tw:max-w-4xl">
        <x-panel.encabezado titulo="Encuesta contestada de Titulación" :migas="$migas" />
        <x-panel.tarjeta :titulo="$nombre" :subtitulo="$nombrePeriodo.' · No. de cuenta '.$registro->cuenta">
            <dl class="tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">
                @foreach (EncuestaTitulacion::PREGUNTAS as $campo => $pregunta)
                    @php($opciones = EncuestaTitulacion::ESCALAS[$campo] ?? EncuestaTitulacion::SI_NO)
                    <div class="tw:grid tw:gap-2 tw:py-4 tw:first:pt-0 tw:sm:grid-cols-[minmax(0,1fr)_auto] tw:sm:gap-x-4">
                        <dt class="tw:text-sm tw:leading-relaxed tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">{{ $loop->iteration }}. {{ $pregunta }}</dt>
                        <dd class="tw:sm:text-right"><x-panel.badge>{{ $opciones[$registro->{$campo}] ?? 'Sin respuesta' }}</x-panel.badge></dd>
                    </div>
                @endforeach
                <div class="tw:space-y-2 tw:pt-4">
                    <dt class="tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Comentario</dt>
                    <dd class="tw:whitespace-pre-wrap tw:break-words tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ filled($registro->comentario_adicional) ? $registro->comentario_adicional : 'Sin comentarios' }}</dd>
                </div>
            </dl>
        </x-panel.tarjeta>
    </div>
@endsection
