@extends('layouts.panel')
@section('title', 'Encuestas de satisfacción de Cómputo')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')

@section('content')
    <x-panel.encabezado titulo="Encuestas de satisfacción de Cómputo" />

    <x-panel.tarjeta titulo="Encuestas pendientes" subtitulo="Evalúa los servicios de mantenimiento preventivo y correctivo que solicitaste.">
        @if (count($encuestas_mantenimiento))
            <x-panel.tabla id="table_enviado">
                <thead><tr><th scope="col">Fecha de la solicitud</th><th scope="col">Servicio solicitado</th><th scope="col">Acción</th></tr></thead>
                <tbody>
                    @foreach ($encuestas_mantenimiento as $mantenimiento)
                        <tr>
                            <td data-order="{{ $mantenimiento->fecha_solicita }}">{{ date('d-m-Y', strtotime($mantenimiento->fecha_solicita)) }}</td>
                            <td>{{ $mantenimiento->servicio_solicita }}</td>
                            <td>
                                <x-panel.boton tamano="sm" variante="contorno-primario"
                                    :data-url="url('/encuestas_satisfaccion/contestar_encuesta_mantenimiento/'.$mantenimiento->id_servicio_mantenimiento)"
                                    data-modal-remoto="#modal_agregar" data-contenedor="#contenedor_agregar">Contestar encuesta</x-panel.boton>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-panel.tabla>
        @else
            <x-panel.vacio titulo="Sin encuestas pendientes" />
        @endif
    </x-panel.tarjeta>

    <x-panel.modal id="modal_agregar" titulo="Encuesta de mantenimiento" aria-label="Encuesta de mantenimiento" tamano="lg">
        <div id="contenedor_agregar"></div>
        <x-slot:pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="enviar_encuesta" type="submit" form="form_enviar_encuesta">Enviar encuesta</x-panel.boton>
        </x-slot:pie>
    </x-panel.modal>
@endsection

@push('scripts')
    @include('encuestas_satisfacion_cliente.partials.cargar_modal')
    <script>
        $(function () {
            $('#table_enviado').DataTable({columnDefs: [{targets: -1, orderable: false, searchable: false}]});

            $('#contenedor_agregar').on('submit', '#form_enviar_encuesta', function (evento) {
                if (this.getAttribute('aria-busy') === 'true' || !PanelFormularios.validar(this)) {
                    evento.preventDefault();
                    return;
                }
                this.setAttribute('aria-busy', 'true');
            }).on('change', 'input[type="radio"]', function () {
                const marcado = this.closest('.tw-campo').querySelector('[data-panel-error]');
                if (marcado) { PanelFormularios.limpiarCampo(marcado); }
            });

            window.addEventListener('pageshow', () => document.getElementById('form_enviar_encuesta')?.removeAttribute('aria-busy'));
        });
    </script>
@endpush
