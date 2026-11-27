@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Historial de Calificaciones de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Historial de calificaciones</h1>
            <p class="tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">{{ $carrera->nombre }}</p>
        </header>

        <nav class="tw:flex tw:flex-wrap tw:items-center tw:gap-2" aria-label="Acciones del historial">
            <x-panel.boton variante="secundario" href="{{ url('/ingles/historial_academico_alumno') }}">
                Programa de estudio
            </x-panel.boton>
            <x-panel.boton variante="secundario" href="/ingles/historial_calificaciones_excel/{{$id_carrera}}">
                <span class="fa fa-file-excel-o" aria-hidden="true"></span> Exportar concentrado
            </x-panel.boton>
            <x-panel.boton href="/ingles/historial/generar_constancias_alumnos_carrera/{{$id_carrera}}">
                <span class="fa fa-folder-open" aria-hidden="true"></span> Generar constancias
            </x-panel.boton>
        </nav>

        <x-panel.tarjeta :sin-relleno="true">
            <x-panel.tabla id="mostrar_calificaciones" class="table tw:mb-0" aria-label="Historial de calificaciones por periodo">
                    <thead>
                    <tr class="text-center">
                        <th scope="col" class="text-center">NP.</th>
                        <th scope="col" class="text-center">No. CTA</th>
                        <th scope="col" class="text-center">ALUMNO</th>
                        @foreach($periodos as $periodo)
                            <th scope="col" class="text-center" title="Nivel y grupo de {{ $periodo->periodo_ingles }}">NIVEL Y GRUPO</th>
                            <th scope="col" class="text-center">{{ $periodo->periodo_ingles }}
                            </th>
                        @endforeach

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($array_alumnos as $alumno)

                        <tr class="text-center" >
                            <td class="text-center">{{$alumno['numero']}}</td>
                            <td class="text-center "> {{$alumno['cuenta']}}</td>
                            <td class="text-left">{{$alumno['nombre']}}</td>

                            @foreach($alumno['calificaciones'] as $calificacion)
                                @if($calificacion['estado_periodo'] == 0)
                                    <td class="text-left" data-estado-nota="sin-registro" >No registro </td>
                                    <td class="text-left" data-estado-nota="sin-registro">No registro </td>
                                @else
                                    <td class="text-left">{{$calificacion['descripcion']}}</td>
                                    @if($calificacion['id_periodo'] < 18)
                                        @if($calificacion['calificacion'] >= 80)
                                            <td class="text-left">{{$calificacion['calificacion']}}</td>
                                        @else
                                            <td class="text-left" data-estado-nota="reprobada" aria-label="{{ $calificacion['calificacion'] }}, reprobatoria">{{$calificacion['calificacion']}}</td>
                                        @endif
                                    @else
                                        @if($calificacion['calificacion'] >= 70)
                                            <td class="text-left">{{$calificacion['calificacion']}}</td>
                                        @else
                                            <td class="text-left" data-estado-nota="reprobada" aria-label="{{ $calificacion['calificacion'] }}, reprobatoria">{{$calificacion['calificacion']}}</td>
                                        @endif
                                    @endif
                                @endif
                            @endforeach

                        </tr>

                    @endforeach

                    </tbody>
                </x-panel.tabla>
        </x-panel.tarjeta>
    </main>

    <style>

        .dark #mostrar_calificaciones tbody tr {
            background-color: transparent;
        }

        .dark #mostrar_calificaciones_paginate a.paginate_button {
            background: transparent;
            color: var(--tw-color-gray-300) !important;
            border-color: var(--tw-color-gray-700);
        }

        .dark #mostrar_calificaciones_paginate a.paginate_button.current,
        .dark #mostrar_calificaciones_paginate a.paginate_button:not(.disabled):hover {
            background: var(--tw-color-brand-500);
            color: #fff !important;
        }

        .dark #mostrar_calificaciones_paginate a.paginate_button.disabled {
            color: var(--tw-color-gray-400) !important;
        }
        #mostrar_calificaciones_wrapper .tesvb-dt-scroll {
            max-height: 60vh;
        }

        #mostrar_calificaciones thead th {
            position: sticky;
            top: 0;
            z-index: 2;
        }

        #mostrar_calificaciones td[data-estado-nota="reprobada"] {
            background: #fee4e2;
            color: #912018;
        }

        #mostrar_calificaciones td[data-estado-nota="reprobada"]::after {
            content: " · Reprobatoria";
            font-size: 0.875em;
        }

        #mostrar_calificaciones td[data-estado-nota="sin-registro"] {
            background: #fef0c7;
            color: #7a2e0e;
        }

        .dark #mostrar_calificaciones td[data-estado-nota="reprobada"] {
            background: #411d27;
            color: #fecdca;
        }

        .dark #mostrar_calificaciones td[data-estado-nota="sin-registro"] {
            background: #3b2b18;
            color: #fedf89;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#mostrar_calificaciones').DataTable();
            $('#mostrar_calificaciones').closest('.tesvb-dt-scroll').attr({
                tabindex: 0,
                role: 'region',
                'aria-label': 'Tabla de calificaciones por periodo'
            });
        });
    </script>
@endsection
