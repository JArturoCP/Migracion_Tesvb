@extends('layouts.panel')
@section('title', 'Encuestas de Servicio Social por programa')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_s') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_periodo_year/'), 'Periodos de las encuestas' => url($base.'menu_historial_servicio_s_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'agregar_periodo_year/')];
        $abierto = $periodo->id_estado == 0;
        $nombrePeriodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
    @endphp

    <x-panel.encabezado titulo="Programas de estudio" :migas="$migas" />
    <div class="tw:space-y-5">
        <x-panel.tarjeta titulo="Encuestas de Servicio Social" :subtitulo="$nombrePeriodo">
            <x-slot:acciones>
                <x-panel.badge :tono="$abierto ? 'exito' : 'gris'">{{ $abierto ? 'Periodo abierto' : 'Periodo terminado' }}</x-panel.badge>
                @unless ($abierto)
                    <x-panel.boton :href="url($base.'ver_enc_resultados/'.$mes.'/'.$year)" tamano="sm">Ver resultados</x-panel.boton>
                @endunless
            </x-slot:acciones>
            <dl class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                <div class="tw:rounded-xl tw:bg-gray-50 tw:p-4 tw:dark:bg-white/5">
                    <dt class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">Encuestas contestadas</dt>
                    <dd class="tw:mt-2 tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $encuestas_contestadas }}</dd>
                </div>
                <div class="tw:rounded-xl tw:bg-gray-50 tw:p-4 tw:dark:bg-white/5">
                    <dt class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">{{ $abierto ? 'Encuestas enviadas' : 'Encuestas no contestadas' }}</dt>
                    <dd class="tw:mt-2 tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $abierto ? $encuestas_enviadas : $encuestas_rechazadas }}</dd>
                </div>
            </dl>
        </x-panel.tarjeta>

        @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
            'mostrarEncabezado' => false,
            'titulo' => 'Selecciona un programa de estudio',
            'periodo_nom' => null,
            'urlAlumnos' => url($base.($abierto ? 'ver_encuesta_servicio_alumno' : 'ver_enc_serv_alum_terminado')),
            'sufijoRuta' => '/'.$mes.'/'.$year,
        ])
    </div>
@endsection
