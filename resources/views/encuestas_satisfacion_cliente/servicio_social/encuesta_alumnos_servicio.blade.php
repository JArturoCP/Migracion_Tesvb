@extends('layouts.panel')
@section('title', 'Enviar encuestas de Servicio Social')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_s') == 1;
        $sufijoPeriodo = '/'.$mes.'/'.$year;
        $nombrePeriodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
        $subtitulo = $carrera ? $carrera->nombre.' · '.$nombrePeriodo : $nombrePeriodo;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_periodo_year/'), 'Periodos de las encuestas' => url($base.'menu_historial_servicio_s_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'agregar_periodo_year/')];
        $migas['Programas de estudio'] = url($base.'ver_carreras_encuesta_servicio'.$sufijoPeriodo);
        $estados = [0 => ['Enviada', 'info'], 1 => ['Contestada', 'exito'], 3 => ['Rechazada', 'gris']];
    @endphp
    <x-panel.encabezado titulo="Enviar encuestas de Servicio Social" :migas="$migas" />

    <div class="tw:space-y-5">
        <x-panel.tarjeta titulo="Estudiantes pendientes de envío" :subtitulo="$subtitulo">
            @if (count($alumnos))
                <x-panel.tabla id="tabla_alumnos" compacta>
                    <thead><tr><th scope="col">No. de cuenta</th><th scope="col">Nombre del estudiante</th><th scope="col">Acción</th></tr></thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->cuenta }}</td>
                                <td>{{ trim($alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno) }}</td>
                                <td>
                                    <x-panel.boton tamano="sm" variante="contorno-primario"
                                        :data-url="url($base.'enc_servicio_datos_alumn/'.$alumno->id_alumno)"
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

        <x-panel.tarjeta titulo="Encuestas enviadas" :subtitulo="$subtitulo">
            @if (count($registros_encuestas))
                <x-panel.tabla id="tabla_registros" compacta>
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
        <form id="form_envio_encuesta" method="POST" action="{{ url($base.'envio_encuesta_estudiante_servicio'.$sufijoPeriodo) }}" data-panel-envio>
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
            $('#tabla_registros').DataTable();
        });
    </script>
@endpush
