@extends('layouts.panel')
@section('title', 'Enviar encuestas de Residencia Profesional')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $migas = [
            'Periodos de las encuestas' => url($base.'agregar_periodo_year_residencia/'),
            'Programas de estudio' => url($base.'ver_carreras_encuesta_residencia/'.session('periodo_actual')),
        ];
        $estados = [0 => ['Enviada', 'info'], 1 => ['Contestada', 'exito'], 3 => ['Rechazada', 'gris']];
    @endphp
    <x-panel.encabezado titulo="Enviar encuestas de Residencia Profesional" :migas="$migas" />

    <div class="tw:space-y-5">
        <x-panel.tarjeta titulo="Estudiantes pendientes de envío" :subtitulo="$carrera?->nombre">
            @if (count($array_dat))
                <x-panel.tabla id="tabla_alumnos" compacta>
                    <thead><tr><th scope="col">No. de cuenta</th><th scope="col">Nombre del estudiante</th><th scope="col">Acción</th></tr></thead>
                    <tbody>
                        @foreach ($array_dat as $alumno)
                            <tr>
                                <td>{{ $alumno['cuenta'] }}</td>
                                <td>{{ $alumno['nombre'] }}</td>
                                <td>
                                    <x-panel.boton tamano="sm" variante="contorno-primario"
                                        :data-url="url($base.'enc_residencia_datos_alumn/'.$alumno['id_alumno'])"
                                        data-modal-remoto="#modal_enviar" data-contenedor="#contenedor_enviar">Enviar encuesta</x-panel.boton>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>
            @else
                <x-panel.vacio titulo="Sin estudiantes pendientes de envío" />
            @endif
        </x-panel.tarjeta>

        <x-panel.tarjeta titulo="Encuestas enviadas" :subtitulo="$carrera?->nombre">
            @if (count($registros_encuestas))
                <x-panel.tabla id="tabla_enviadas" compacta>
                    <thead><tr><th scope="col">No. de cuenta</th><th scope="col">Nombre del estudiante</th><th scope="col">Estado</th></tr></thead>
                    <tbody>
                        @foreach ($registros_encuestas as $registro)
                            @php([$estado, $tono] = $estados[$registro->id_estado] ?? ['Sin estado', 'gris'])
                            <tr>
                                <td>{{ $registro->cuenta }}</td>
                                <td>{{ trim($registro->nombre.' '.$registro->apaterno.' '.$registro->amaterno) }}</td>
                                <td><x-panel.badge :tono="$tono">{{ $estado }}</x-panel.badge></td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>
            @else
                <x-panel.vacio titulo="Sin encuestas enviadas" />
            @endif
        </x-panel.tarjeta>
    </div>

    <x-panel.modal id="modal_enviar" titulo="Enviar encuesta" aria-label="Enviar encuesta" sin-relleno>
        <form id="form_envio_encuesta" method="POST" action="{{ url($base.'envio_encuesta_estudiante_residencia/') }}" data-panel-envio>
            @csrf
            <div class="tw-modal-cuerpo" id="contenedor_enviar"></div>
            <x-panel.modal-pie>
                <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                <x-panel.boton id="envio_encuesta" type="submit">Confirmar envío</x-panel.boton>
            </x-panel.modal-pie>
        </form>
    </x-panel.modal>
@endsection

@push('scripts')
    @include('encuestas_satisfacion_cliente.partials.cargar_modal')
    <script>
        $(function () {
            $('#tabla_alumnos').DataTable({columnDefs: [{targets: -1, orderable: false, searchable: false}]});
            $('#tabla_enviadas').DataTable();
        });
    </script>
@endpush
