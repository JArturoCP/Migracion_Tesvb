@extends('layouts.panel')
@section('title', 'Calificaciones')

@push('cabeza')
<style>
    .tw-tabla-desplazable:focus-visible { outline: 3px solid #465fff; outline-offset: -3px; }
    .dark .tw-tabla-desplazable:focus-visible { outline-color: #a4bcfd; }
    .calificaciones-tabla th:first-child {
        position: sticky;
        left: 0;
        z-index: 1;
        min-width: 8rem;
        max-width: 13rem;
        white-space: normal;
        overflow-wrap: anywhere;
        background: #fff;
        box-shadow: 1px 0 #d0d5dd;
    }
    .dark .calificaciones-tabla th:first-child { background: #1d2939; box-shadow: 1px 0 #475467; }
    .calificaciones-estado { font-weight: 600; color: #344054; }
    .calificaciones-badge { display: inline-block; border-radius: 1rem; padding: 0.1rem 0.5rem; background: #eef2ff; }
    .calificaciones-error { color: #9b1c1c; background: #fff1f0; }
    .calificaciones-exito { color: #05603a; background: #ecfdf3; }
    .dark .calificaciones-estado { color: #e4e7ec; }
    .dark .calificaciones-badge { background: #344054; }
    .dark .calificaciones-error { color: #fda29b; background: #491d24; }
    .dark .calificaciones-exito { color: #a6f4c5; background: #144234; }
</style>
@endpush

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
                    No hay materias registradas para consultar en este periodo.
                </x-panel.alerta>
            @else
                @php
                    $promedio = array_sum(array_column($array_materias, 'promedio')) / count($array_materias);
                    $unidadesRomanas = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'XIV', 'XV'];
                @endphp

                <x-panel.tarjeta titulo="Calificaciones por materia" subtitulo="Evaluaciones por unidad del periodo actual">
                    <x-slot:acciones>
                        <span class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">Promedio general</span>
                        <strong class="calificaciones-estado calificaciones-badge">{{ $materiasConInconsistencias ? 'Por verificar' : number_format($promedio, 2, '.', '') }}</strong>
                    </x-slot:acciones>

                    @if ($materiasConInconsistencias)
                        <x-panel.alerta tipo="advertencia" titulo="Información académica por verificar">
                            Hay registros de evaluación que requieren revisión. Consulta a Control Escolar.
                        </x-panel.alerta>
                    @endif
                    <x-panel.tabla compacta desplazable="Calificaciones por materia y unidad" class="calificaciones-tabla" aria-label="Calificaciones por materia y unidad">
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
                                    $completa = $materia['registradas'] > 0 && count($materia['calificaciones']) === (int) $materia['unidades'];
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
                                    @for ($unidad = 1; $unidad <= $mayor_unidades; $unidad++)
                                        @php($notas = $materia['calificaciones'][$unidad] ?? [])
                                        <td class="tw:text-center tw:tabular-nums" data-unidad="{{ $unidad }}">
                                            @if ($unidad > $materia['unidades'])
                                                <span aria-label="No aplica">—</span>
                                            @elseif ($notas === [])
                                                <abbr title="Evaluación pendiente">Pend.</abbr>
                                            @elseif (count($notas) > 1 || $notas[0] === null)
                                                <span class="calificaciones-estado">Por verificar</span>
                                            @elseif ($notas[0] >= 70)
                                                {{ $notas[0] }}
                                            @else
                                                <abbr class="calificaciones-estado calificaciones-badge calificaciones-error" title="No acreditada">N.A.</abbr>
                                            @endif
                                        </td>
                                    @endfor
                                    <td class="tw:text-center tw:tabular-nums">
                                        @if ($materia['inconsistente'])
                                            <span class="calificaciones-estado">Por verificar</span>
                                        @elseif ($materia['servicio_social'] && !$materia['servicio_registrado'])
                                            Pendiente de registro
                                        @elseif (!$materia['servicio_social'] && $materia['registradas'] === 0)
                                            Sin evaluaciones
                                        @else
                                            @if ($materia['promedio'] >= 70)
                                                <strong class="calificaciones-estado calificaciones-badge calificaciones-exito">{{ $materia['promedio'] }}</strong>
                                            @else
                                                <abbr class="calificaciones-estado calificaciones-badge calificaciones-error" title="No acreditado">N.A.</abbr>
                                            @endif
                                            @if (!$materia['servicio_social'] && !$completa)
                                                <br><small>Evaluaciones pendientes</small>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="tw:text-center">{{ $tipoEvaluacion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-panel.tabla>
                    <p class="tw:mt-3 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                        Pend. indica que falta una evaluación. N.A. indica una nota registrada no acreditada.
                        El guion indica que la unidad no aplica. El promedio general incluye los ceros del cálculo
                        para materias sin evaluaciones o con notas no acreditadas.
                    </p>
                </x-panel.tarjeta>

            @endif

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
        </div>
    @endif
@endsection
