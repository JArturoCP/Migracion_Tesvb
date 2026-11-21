@extends('layouts.panel')
@section('title', 'Calificaciones')

@section('content')
    <x-panel.encabezado titulo="Calificaciones" />

    @if ($estado_validacion_carga->estado == 0)
        <x-panel.alerta tipo="advertencia" titulo="Carga académica pendiente">
            Podrás consultar tus calificaciones cuando tu carga académica esté validada.
        </x-panel.alerta>
    @else
        <div class="tw:space-y-6">
            @if ($estado_residencia == 1)
                <x-panel.tarjeta titulo="Residencia profesional">
                    @switch($proceso)
                        @case(1)
                            <x-panel.badge tono="info">Registro de autorización del anteproyecto</x-panel.badge>
                            @break
                        @case(2)
                            <x-panel.badge tono="info">Seguimiento de residencia</x-panel.badge>
                            @break
                        @case(3)
                            <dl class="tw:flex tw:items-center tw:gap-3">
                                <dt>Promedio de residencia</dt>
                                <dd><x-panel.badge tono="gris">{{ $cal_residencia }}</x-panel.badge></dd>
                            </dl>
                            @break
                    @endswitch
                </x-panel.tarjeta>
            @endif

            @if (empty($array_materias))
                <x-panel.alerta titulo="Sin materias para mostrar">
                    En el periodo actual no hay materias para consultar en esta sección.
                </x-panel.alerta>
            @else
                @php
                    $promedio = array_sum(array_column($array_materias, 'promedio')) / count($array_materias);
                    $unidadesRomanas = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'XIV', 'XV'];
                @endphp

                <x-panel.tarjeta titulo="Calificaciones por materia" subtitulo="Evaluaciones por unidad del periodo actual">
                    <x-slot:acciones>
                        <span class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">Promedio general</span>
                        <x-panel.badge>{{ number_format($promedio, 2, '.', '') }}</x-panel.badge>
                    </x-slot:acciones>

                    <x-panel.tabla compacta aria-label="Calificaciones por materia y unidad">
                        <thead>
                            <tr>
                                <th scope="col">Materia</th>
                                @for ($unidad = 0; $unidad < $mayor_unidades; $unidad++)
                                    <th scope="col" class="tw:text-center" aria-label="Unidad {{ $unidad + 1 }}">
                                        {{ $unidadesRomanas[$unidad] ?? ($unidad + 1) }}
                                    </th>
                                @endfor
                                <th scope="col" class="tw:text-center">Promedio</th>
                                <th scope="col" class="tw:text-center">Evaluación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($array_materias as $materia)
                                @php
                                    $calificaciones = array_values(array_filter($materia['calificaciones']));
                                    $tipoEvaluacion = match ($materia['curso']) {
                                        'NORMAL' => $materia['esc_alumno'] ? 'ESC' : 'O',
                                        'REPETICION' => $materia['esc_alumno'] ? 'ESC2' : 'O2',
                                        'ESPECIAL' => 'CE',
                                        'GLOBAL' => 'EG',
                                        default => '',
                                    };
                                @endphp
                                <tr>
                                    <th scope="row" class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $materia['materia'] }}</th>
                                    @for ($unidad = 0; $unidad < $mayor_unidades; $unidad++)
                                        <td class="tw:text-center tw:tabular-nums">
                                            @if (isset($calificaciones[$unidad]))
                                                @if ($calificaciones[$unidad]['calificacion'] >= 70)
                                                    {{ $calificaciones[$unidad]['calificacion'] }}
                                                @else
                                                    <x-panel.badge tono="advertencia"><abbr title="No acreditada">N.A.</abbr></x-panel.badge>
                                                @endif
                                            @elseif ($unidad < $materia['unidades'])
                                                0
                                            @else
                                                <span title="No aplica" aria-label="No aplica">—</span>
                                            @endif
                                        </td>
                                    @endfor
                                    <td class="tw:text-center tw:tabular-nums">
                                        @if ($materia['promedio'] >= 70)
                                            <x-panel.badge tono="exito">{{ $materia['promedio'] }}</x-panel.badge>
                                        @else
                                            <x-panel.badge tono="error"><abbr title="No acreditado">N.A.</abbr></x-panel.badge>
                                        @endif
                                    </td>
                                    <td class="tw:text-center">{{ $tipoEvaluacion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-panel.tabla>
                    <p class="tw:mt-3 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                        N.A. indica una calificación no acreditada. El guion señala que la unidad no aplica a la materia.
                    </p>
                </x-panel.tarjeta>

                <x-panel.tarjeta titulo="Docentes por materia">
                    @if (empty($profesores))
                        <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">No hay docentes para mostrar en este periodo.</p>
                    @else
                        <x-panel.tabla compacta aria-label="Docentes por materia y grupo">
                            <thead>
                                <tr>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Materia</th>
                                    <th scope="col">Grupo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profesores as $profesor)
                                    <tr>
                                        <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $profesor->nombre }}</td>
                                        <td>{{ $profesor->materias }}</td>
                                        <td>{{ $profesor->id_semestre }}0{{ $profesor->grupo }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-panel.tabla>
                    @endif
                </x-panel.tarjeta>
            @endif
        </div>
    @endif
@endsection
