@extends('layouts.panel')
@section('title', 'Documentos de Titulación autorizados')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    <x-panel.encabezado titulo="Documentos de Titulación autorizados"
        :migas="['Programas de estudio' => url('/titulacion/documento_titulacion_autorizado')]" />

    <x-panel.tarjeta :titulo="$carrera->nombre">
        @if (count($reg_titulacion))
            <x-panel.tabla id="tabla_alumnos" compacta desplazable="Proyectos de titulación">
                <thead>
                    <tr>
                        <th scope="col">No. de cuenta</th>
                        <th scope="col">Nombre del estudiante</th>
                        <th scope="col">Opción de titulación</th>
                        <th scope="col">Nombre del proyecto</th>
                        <th scope="col">Documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reg_titulacion as $alumno)
                        <tr>
                            <td>{{ $alumno['no_cuenta'] }}</td>
                            <td>{{ $alumno['nombre'] }}</td>
                            <td>{{ $alumno['opcion_titulacion'] }}</td>
                            <td>{{ $alumno['nom_proyecto'] }}</td>
                            <td>
                                @if ($alumno['pdf_reporte_titulacion'])
                                    <x-panel.boton :href="url('/titulacion/'.$alumno['pdf_reporte_titulacion'])"
                                        tamano="sm" variante="contorno-primario" target="_blank" rel="noopener">
                                        Ver documento
                                    </x-panel.boton>
                                @else
                                    <span class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">Sin documento</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-panel.tabla>
        @else
            <x-panel.vacio titulo="Sin proyectos autorizados" />
        @endif
    </x-panel.tarjeta>
@endsection

@if (isset($reg_titulacion) && count($reg_titulacion))
    @push('scripts')
        <script>
            $(function () {
                $('#tabla_alumnos').DataTable({
                    columnDefs: [{targets: -1, orderable: false, searchable: false}],
                });
            });
        </script>
    @endpush
@endif
