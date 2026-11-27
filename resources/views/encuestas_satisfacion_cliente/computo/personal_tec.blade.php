@extends('layouts.panel')
@section('title', 'Gestión de encuestas de Cómputo')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')

@section('content')
    @php
        $historial = session('historial_enc_c') == 1;
        $base = '/encuestas_satisfaccion/';
        $migas = $historial ? ['Historial de encuestas' => url($base.'menu_historial_mantenimiento')] : [];
        $migas['Periodos de las encuestas'] = $historial
            ? url($base.'menu_historial_mantenimiento_year/'.$year)
            : url($base.'periodo_mantenimiento');
        $periodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
    @endphp
    @php
        $abierto = $estado_periodo->contar == 0;
        $estados = [0 => ['Pendiente de envío', 'advertencia'], 1 => ['Enviada', 'info'], 2 => ['Contestada', 'exito'], 3 => ['Rechazada', 'gris']];
        $confirmaciones = [
            ['enviar', 'Enviar encuesta', 'form_enviar_encuesta', 'guardar_envio_enc_mante', 'Confirmar envío', 'primario'],
            ['eliminar', 'Eliminar encuesta', 'form_eliminar_encuesta', 'guardar_eliminacion_enc_mante', 'Confirmar eliminación', 'peligro'],
        ];
    @endphp

    <x-panel.encabezado titulo="Gestión de encuestas de Cómputo" :migas="$migas" />
    <x-panel.tarjeta titulo="Solicitudes de mantenimiento" :subtitulo="$periodo">
        <x-slot:acciones>
            @if ($abierto)
                <x-panel.boton data-toggle="modal" data-target="#modal_agregar">Agregar encuesta</x-panel.boton>
            @endif
        </x-slot:acciones>
        @if (count($mantenimientos))
            <x-panel.tabla id="table_enviado">
                <thead><tr><th scope="col">Fecha de la solicitud</th><th scope="col">Solicitante</th><th scope="col">Servicio solicitado</th><th scope="col">Estado</th><th scope="col">Acciones</th></tr></thead>
                <tbody>
                    @foreach ($mantenimientos as $servicio)
                        @php
                            [$estado, $tono] = $estados[$servicio->id_estado] ?? ['Sin estado', 'gris'];
                            $id = $servicio->id_servicio_mantenimiento;
                        @endphp
                        <tr>
                            <td data-order="{{ $servicio->fecha_solicita }}">{{ date('d-m-Y', strtotime($servicio->fecha_solicita)) }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->servicio_solicita }}</td>
                            <td><x-panel.badge :tono="$tono">{{ $estado }}</x-panel.badge></td>
                            <td>
                                <div class="tw:flex tw:flex-wrap tw:gap-2">
                                    @if ($servicio->id_estado == 0)
                                        <x-panel.boton tamano="sm" variante="contorno-primario" :data-url="url($base.'notificacion_enviar_enc_mantenimiento/'.$id)"
                                            data-modal-remoto="#modal_enviar" data-contenedor="#contenedor_enviar">Enviar encuesta</x-panel.boton>
                                        <x-panel.boton tamano="sm" variante="contorno-peligro" :data-url="url($base.'eliminar_enc_mantenimiento/'.$id)"
                                            data-modal-remoto="#modal_eliminar" data-contenedor="#contenedor_eliminar">Eliminar</x-panel.boton>
                                    @elseif ($servicio->id_estado == 2)
                                        <x-panel.boton tamano="sm" variante="contorno-primario" :data-url="url($base.'ver_enc_mantenimiento/'.$id)"
                                            data-modal-remoto="#modal_ver" data-contenedor="#contenedor_ver">Ver respuestas</x-panel.boton>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-panel.tabla>
        @else
            <x-panel.vacio titulo="Sin solicitudes de mantenimiento" />
        @endif
    </x-panel.tarjeta>

    @if ($abierto)
        <x-panel.modal id="modal_agregar" titulo="Agregar encuesta" aria-label="Agregar encuesta" sin-relleno>
            <form id="form_agregar" method="POST" action="{{ url($base.'guardar_registro_mantemiento_computo/'.$mes.'/'.$year) }}" data-panel-envio>
                @csrf
                <div class="tw-modal-cuerpo tw:space-y-4">
                    <x-panel.select id="selectPersonal" name="selectPersonal" etiqueta="Personal del Tecnológico" required>
                        <option value="">Selecciona una opción</option>
                        @foreach ($personales as $personal)
                            <option value="{{ $personal->id_personal }}">{{ $personal->nombre }}</option>
                        @endforeach
                    </x-panel.select>
                    <x-panel.textarea id="servicio" name="servicio" etiqueta="Servicio solicitado" rows="3" required />
                    <x-panel.input id="fecha_s" name="fecha_s" etiqueta="Fecha de la solicitud" data-flatpickr-date="Y/m/d" placeholder="aaaa/mm/dd" required />
                </div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton type="submit">Guardar</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    @endif

    @foreach ($confirmaciones as [$accion, $titulo, $formulario, $ruta, $boton, $variante])
        <x-panel.modal :id="'modal_'.$accion" :titulo="$titulo" :aria-label="$titulo" sin-relleno>
            <form id="{{ $formulario }}" method="POST" action="{{ url($base.$ruta.'/') }}" data-panel-envio>
                @csrf
                <div class="tw-modal-cuerpo" id="{{ 'contenedor_'.$accion }}"></div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton type="submit" :variante="$variante">{{ $boton }}</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    @endforeach

    <x-panel.modal id="modal_ver" titulo="Respuestas de la encuesta" aria-label="Respuestas de la encuesta" tamano="lg">
        <div id="contenedor_ver"></div>
        <x-slot:pie><x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton></x-slot:pie>
    </x-panel.modal>
@endsection

@push('scripts')
    @include('encuestas_satisfacion_cliente.partials.cargar_modal')
    <script>
        $(function () {
            $('#table_enviado').DataTable({columnDefs: [{targets: -1, orderable: false, searchable: false}]});
        });
    </script>
@endpush
