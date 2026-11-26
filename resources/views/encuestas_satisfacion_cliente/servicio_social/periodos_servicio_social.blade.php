@extends('layouts.panel')
@section('title', 'Periodos de encuestas de Servicio Social')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @php
        $historial = session('historial_enc_s') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url('/encuestas_satisfaccion/historial_periodo_year')]
            : [];
        $meses = [1 => 'Enero', 2 => 'Julio'];
    @endphp

    <x-panel.encabezado titulo="Periodos de encuestas de Servicio Social" :migas="$migas" />

    <x-panel.tarjeta titulo="Servicio Social" :subtitulo="'Periodos de '.$year">
        <x-slot:acciones>
            @if (! $historial)
                <x-panel.boton data-toggle="modal" data-target="#modal_agregar">Agregar periodo</x-panel.boton>
            @endif
        </x-slot:acciones>

        @if (count($periodos))
            <x-panel.tabla>
                <thead><tr><th scope="col">Periodo</th><th scope="col">Estado</th><th scope="col">Acciones</th></tr></thead>
                <tbody>
                    @foreach ($periodos as $periodo)
                        @continue(!isset($meses[$periodo->mes]))
                        <tr>
                            <td>{{ $meses[$periodo->mes] }}</td>
                            <td><x-panel.badge :tono="$periodo->id_estado == 0 ? 'exito' : 'gris'">{{ $periodo->id_estado == 0 ? 'Abierto' : 'Terminado' }}</x-panel.badge></td>
                            <td>
                                <div class="tw:flex tw:flex-wrap tw:gap-2">
                                    <x-panel.boton :href="url('/encuestas_satisfaccion/ver_carreras_encuesta_servicio/'.$periodo->mes.'/'.$year)" tamano="sm" variante="contorno-primario">Ver encuestas</x-panel.boton>
                                    @if ($periodo->id_estado == 0)
                                        <x-panel.boton tamano="sm" variante="contorno-peligro"
                                            :data-url="url('/encuestas_satisfaccion/termino_encuesta_servicio/'.$periodo->id_periodo_serv)"
                                            data-modal-remoto="#modal_termino" data-contenedor="#contenedor_termino">Terminar el periodo</x-panel.boton>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-panel.tabla>
        @else
            <x-panel.vacio titulo="Sin periodos registrados" />
        @endif
    </x-panel.tarjeta>

    @if (! $historial)
        <x-panel.modal id="modal_agregar" titulo="Agregar periodo" aria-label="Agregar periodo" sin-relleno>
            <form id="form_agregar" action="{{ url('/encuestas_satisfaccion/registrar_periodo_year/') }}" method="POST" data-panel-envio>
                @csrf
                <input type="hidden" name="year" value="{{ $year }}">
                <div class="tw-modal-cuerpo">
                    <x-panel.select id="mes" name="mes" etiqueta="Mes" required>
                        <option value="">Selecciona un mes</option>
                        @foreach ($meses as $valor => $nombre)
                            <option value="{{ $valor }}">{{ $nombre }}</option>
                        @endforeach
                    </x-panel.select>
                </div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton id="guardar_agregar" type="submit">Guardar</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    @endif

    <x-panel.modal id="modal_termino" titulo="Terminar periodo" aria-label="Terminar periodo" sin-relleno>
        <form id="form_terminar" action="{{ url('/encuestas_satisfaccion/guardar_termino_encuesta_servicio') }}" method="POST" data-panel-envio>
            @csrf
            <div class="tw-modal-cuerpo" id="contenedor_termino"></div>
            <x-panel.modal-pie>
                <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                <x-panel.boton id="guardar_termino" type="submit" variante="peligro">Confirmar cierre</x-panel.boton>
            </x-panel.modal-pie>
        </form>
    </x-panel.modal>
@endsection

@push('scripts')
    @include('encuestas_satisfacion_cliente.partials.cargar_modal')
@endpush
