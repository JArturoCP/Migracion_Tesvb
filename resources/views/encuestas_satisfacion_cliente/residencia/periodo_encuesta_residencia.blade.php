@extends('layouts.panel')
@section('title', 'Periodos de encuestas de Residencia Profesional')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $registrado = (int) $estado_periodo > 0;
        $cerrado = $registrado && $nom_periodo_resi->id_estado != 0;
    @endphp

    <div class="tw:mx-auto tw:max-w-4xl">
        <x-panel.encabezado titulo="Encuestas de Residencia Profesional" />
        <x-panel.tarjeta titulo="Periodo de encuestas" :subtitulo="$nombre_periodo->periodo">
            <x-slot:acciones>
                @if ($registrado)
                    <x-panel.badge :tono="$cerrado ? 'gris' : 'exito'">{{ $cerrado ? 'Terminado' : 'Abierto' }}</x-panel.badge>
                @endif
            </x-slot:acciones>
            @if ($registrado)
                <dl class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                    @foreach ([
                        'Encuestas contestadas' => $contar_enc_contestadas->contar,
                        ($cerrado ? 'Encuestas rechazadas' : 'Encuestas enviadas') => $cerrado ? $contar_enc_rechazadas->contar : $contar_enc_enviadas->contar,
                    ] as $etiqueta => $total)
                        <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-4 tw:dark:border-gray-700 tw:dark:bg-white/5">
                            <dt class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">{{ $etiqueta }}</dt>
                            <dd class="tw:mt-2 tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $total }}</dd>
                        </div>
                    @endforeach
                </dl>
                <div class="tw:mt-5 tw:grid tw:gap-3 tw:sm:flex tw:sm:flex-wrap tw:sm:justify-end">
                    @if ($cerrado)
                        <x-panel.boton :href="url($base.'ver_enc_contestadas_residencia/'.$nom_periodo_resi->id_periodo_residencia)" variante="secundario">Ver encuestas contestadas</x-panel.boton>
                        <x-panel.boton :href="url($base.'ver_enc_carreras_res_residencia/'.$nom_periodo_resi->id_periodo_residencia)">Ver resultados</x-panel.boton>
                    @else
                        <x-panel.boton :href="url($base.'ver_carreras_encuesta_residencia/'.$nom_periodo_resi->id_periodo)">Enviar encuestas</x-panel.boton>
                        <x-panel.boton variante="contorno-peligro" :data-url="url($base.'termino_encuesta_residencia/'.$nom_periodo_resi->id_periodo_residencia)"
                            data-modal-remoto="#modal_termino" data-contenedor="#contenedor_termino">Terminar el periodo</x-panel.boton>
                    @endif
                </div>
            @else
                <x-panel.vacio titulo="Periodo sin registrar">
                    <x-panel.boton data-toggle="modal" data-target="#modal_agregar">Agregar periodo</x-panel.boton>
                </x-panel.vacio>
            @endif
        </x-panel.tarjeta>
    </div>

    @if (! $registrado)
        <x-panel.modal id="modal_agregar" titulo="Agregar periodo" aria-label="Agregar periodo" sin-relleno>
            <form id="form_agregar" method="POST" action="{{ url($base.'guardar_periodo_year_residencia/') }}" data-panel-envio>
                @csrf
                <input type="hidden" name="id_periodo" value="{{ $nombre_periodo->id_periodo }}">
                <div class="tw-modal-cuerpo">¿Deseas agregar el periodo {{ $nombre_periodo->periodo }} para las encuestas de Residencia?</div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton id="guardar_agregar" type="submit">Agregar periodo</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    @elseif (! $cerrado)
        <x-panel.modal id="modal_termino" titulo="Terminar el periodo" aria-label="Terminar el periodo" sin-relleno>
            <form id="form_terminar" method="POST" action="{{ url($base.'guardar_termino_encuesta_residencia') }}" data-panel-envio>
                @csrf
                <div class="tw-modal-cuerpo" id="contenedor_termino"></div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton id="guardar_termino" type="submit" variante="peligro">Confirmar cierre</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    @endif
@endsection

@push('scripts')
    @include('encuestas_satisfacion_cliente.partials.cargar_modal')
@endpush
