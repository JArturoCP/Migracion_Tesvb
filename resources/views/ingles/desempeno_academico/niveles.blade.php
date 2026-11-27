@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Indices de Aprovechamiento')
@section('content')
    <style>
        .i5a-tabs { display: flex; flex-wrap: wrap; gap: .25rem; padding: .5rem; border-bottom: 1px solid var(--tw-color-gray-200, #e4e7ec); }
        .i5a-tabs > li > a { border-radius: .5rem; padding: .625rem .875rem; color: var(--tw-color-gray-700, #344054); }
        .i5a-tabs > li > a:hover { background-color: var(--tw-color-gray-100, #f2f4f7); }
        .i5a-tabs > .active > a { background-color: var(--tw-color-brand-50, #ecf3ff); color: var(--tw-color-brand-700, #1c42dd); font-weight: 600; }
        .dark .i5a-tabs { border-color: var(--tw-color-gray-800, #1d2939); }
        .dark .i5a-tabs > li > a { color: var(--tw-color-gray-300, #d0d5dd); }
        .dark .i5a-tabs > li > a:hover, .dark .i5a-tabs > .active > a { background-color: var(--tw-color-gray-800, #1d2939); }
        .dark .i5a-tabs > .active > a { color: var(--tw-color-brand-200, #c2d6ff); }
        .tw-modulo .i5a-tabs a:focus-visible, .i5a-panel .tw-tabla-desplazable:focus-visible {
            outline: 2px solid var(--tw-color-brand-500, #465fff);
            outline-offset: -2px;
        }
        .i5a-panel .tw-tabla th[scope="row"] { min-width: 11rem; white-space: normal; overflow-wrap: anywhere; }
    </style>

    <main class="tw-modulo tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
            <div>
                <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Seguimiento de resultados académicos institucionales</h1>
                <p class="tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">Resultados por programa de estudio, nivel y grupo</p>
            </div>
        </header>

        <x-panel.tarjeta :sin-relleno="true">
            <ul class="nav i5a-tabs" role="tablist" aria-label="Resultados académicos">
                <li role="presentation" class="active">
                    <a id="tab-aprobados" href="#aprobados" data-toggle="tab" role="tab" aria-controls="aprobados"
                        aria-selected="true" tabindex="0">
                        <span class="fa fa-check-circle" aria-hidden="true"></span> Aprobación
                    </a>
                </li>
                <li role="presentation">
                    <a id="tab-reprobados" href="#reprobados" data-toggle="tab" role="tab" aria-controls="reprobados"
                        aria-selected="false" tabindex="-1">
                        <span class="fa fa-times-circle" aria-hidden="true"></span> Reprobación
                    </a>
                </li>
                <li role="presentation">
                    <a id="tab-desertores" href="#desertores" data-toggle="tab" role="tab" aria-controls="desertores"
                        aria-selected="false" tabindex="-1">
                        <span class="fa fa-user-times" aria-hidden="true"></span> Deserción
                    </a>
                </li>
            </ul>

            <div class="tab-content tw:p-4">
                <section id="aprobados" class="tab-pane fade in active i5a-panel" role="tabpanel" aria-labelledby="tab-aprobados">
                    @if (empty($tabla))
                        <p class="tw:mb-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">No hay registros para el periodo.</p>
                    @endif
                    <x-panel.tabla compacta desplazable="Tabla de aprobados" class="tw-tabla-centrada tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th scope="col">Programas de Estudio</th>
                            @foreach($niveles as $nivel)
                                <th scope="col" class="text-center">{{ $nivel }}</th>
                            @endforeach
                            <th scope="col">Total de Alumnos</th>
                            <th scope="col">Porcentaje</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($tabla as $carrera => $datos)
                            <tr>
                                <th scope="row"><strong>{{ $carrera }}</strong></th>

                                @foreach($niveles as $nivel)
                                    <td>

                                        @php
                                            $lista = $grupos_por_categoria['aprobados'][$carrera][$nivel] ?? [];
                                        @endphp

                                        @if(count($lista) > 0)

                                            @foreach($lista as $g)
                                                <div class="tw:mb-2">
                                            <span class="tw:font-semibold">
                                                Grupo: {{ $g['grupo'] }}
                                            </span>

                                                    <span class="tw:font-semibold">
                                                Estudiantes: {{ $g['total'] }}
                                            </span>

                                                    <br>

                                                    <small>
                                                        Porcentaje por Nivel: {{ $porcentaje_por_nivel['aprobados'][$nivel] ?? 0 }}%
                                                    </small>
                                                </div>
                                            @endforeach

                                        @else
                                            <span class="tw:font-semibold">SIN GRUPO</span>
                                        @endif

                                    </td>
                                @endforeach

                                <td class="text-center"><strong>{{ $datos['total_aprobados'] }}</strong></td>
                                <td><span class="tw:font-semibold">{{ $datos['porcentaje_aprobados'] }}%</span></td>
                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th scope="row"><strong>Total General</strong></th>

                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $totales_por_nivel['aprobados'][$nivel] }}</td>
                            @endforeach

                            <td class="text-center">{{ $total_general['aprobados'] }}</td>
                            <td class="text-center">{{ $porcentaje_general['aprobados'] }}%</td>
                        </tr>
                        </tfoot>
                    </x-panel.tabla>
                </section>

                <section id="reprobados" class="tab-pane fade i5a-panel" role="tabpanel" aria-labelledby="tab-reprobados">
                    @if (empty($tabla))
                        <p class="tw:mb-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">No hay registros para el periodo.</p>
                    @endif
                    <x-panel.tabla compacta desplazable="Tabla de reprobados" class="tw-tabla-centrada tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th scope="col">Programas de Estudio</th>
                            @foreach($niveles as $nivel)
                                <th scope="col">{{ $nivel }}</th>
                            @endforeach
                            <th scope="col">Total de Estudiantes</th>
                            <th scope="col">Porcentaje</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($tabla as $carrera => $datos)

                            <tr>
                                <th scope="row"><strong>{{ $carrera }}</strong></th>

                                @foreach($niveles as $nivel)
                                    <td>

                                        @php
                                            $lista = $grupos_por_categoria['reprobados'][$carrera][$nivel] ?? [];
                                        @endphp

                                        @if(count($lista) > 0)
                                            @foreach($lista as $g)
                                                <div class="tw:mb-2">
                                                    <span class="tw:font-semibold">Grupo: {{ $g['grupo'] }}</span>
                                                    <span class="tw:font-semibold">Estudiantes: {{ $g['total'] }}</span>
                                                    <br>
                                                    <small>
                                                        Porcentaje por Nivel: {{ $porcentaje_por_nivel['reprobados'][$nivel] ?? 0 }}%
                                                    </small>
                                                </div>
                                            @endforeach

                                        @else
                                            <span class="tw:font-semibold">SIN GRUPO</span>
                                        @endif

                                    </td>
                                @endforeach

                                <td class="text-center"><strong>{{ $datos['total_reprobados'] }}</strong></td>
                                <td class="text-center"><span class="tw:font-semibold">{{ $datos['porcentaje_reprobados'] }}%</span></td>
                            </tr>

                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th scope="row" class="text-center"><strong>Total General</strong></th>

                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $totales_por_nivel['reprobados'][$nivel] }}</td>
                            @endforeach

                            <td class="text-center">{{ $total_general['reprobados'] }}</td>
                            <td class="text-center">{{ $porcentaje_general['reprobados'] }}%</td>
                        </tr>
                        </tfoot>
                    </x-panel.tabla>
                </section>

                <section id="desertores" class="tab-pane fade i5a-panel" role="tabpanel" aria-labelledby="tab-desertores">
                    @if (empty($tabla))
                        <p class="tw:mb-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">No hay registros para el periodo.</p>
                    @endif
                    <x-panel.tabla compacta desplazable="Tabla de desertores" class="tw-tabla-centrada tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th scope="col">Programas de Estudio</th>
                            @foreach($niveles as $nivel)
                                <th scope="col">{{ $nivel }}</th>
                            @endforeach
                            <th scope="col">Total de Estudiantes</th>
                            <th scope="col">Porcentaje</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($tabla as $carrera => $datos)

                            <tr>
                                <th scope="row"><strong>{{ $carrera }}</strong></th>

                                @foreach($niveles as $nivel)
                                    <td>

                                        @php
                                            $lista = $grupos_por_categoria['desertores'][$carrera][$nivel] ?? [];
                                        @endphp

                                        @if(count($lista) > 0)
                                            @foreach($lista as $g)
                                                <div class="tw:mb-2">
                                                    <span class="tw:font-semibold">Grupo: {{ $g['grupo'] }}</span>
                                                    <span class="tw:font-semibold">Estudiantes: {{ $g['total'] }}</span>
                                                    <br>
                                                    <small>
                                                        Porcentaje por Nivel: {{ $porcentaje_por_nivel['desertores'][$nivel] ?? 0 }}%
                                                    </small>
                                                </div>
                                            @endforeach

                                        @else
                                            <span class="tw:font-semibold">SIN GRUPO</span>
                                        @endif

                                    </td>
                                @endforeach

                                <td class="text-center"><strong>{{ $datos['total_desertores'] }}</strong></td>
                                <td class="text-center"><span class="tw:font-semibold">{{ $datos['porcentaje_desertores'] }}%</span></td>
                            </tr>

                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th scope="row" class="text-center"><strong>Total General</strong></th>

                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $totales_por_nivel['desertores'][$nivel] }}</td>
                            @endforeach

                            <td class="text-center">{{ $total_general['desertores'] }}</td>
                            <td class="text-center">{{ $porcentaje_general['desertores'] }}%</td>
                        </tr>
                        </tfoot>
                    </x-panel.tabla>
                </section>
            </div>
        </x-panel.tarjeta>
    </main>

    <script>
        $(function () {
            const $lista = $('.i5a-tabs');
            const $pestanas = $lista.find('[role="tab"]');

            $lista.on('shown.bs.tab', '[role="tab"]', function () {
                $pestanas.attr({ 'aria-selected': 'false', tabindex: '-1' });
                $(this).attr({ 'aria-selected': 'true', tabindex: '0' });
            });

            $lista.on('keydown', '[role="tab"]', function (evento) {
                const indice = $pestanas.index(this);
                const cantidad = $pestanas.length;
                const destino = {
                    ArrowLeft: (indice + cantidad - 1) % cantidad,
                    ArrowRight: (indice + 1) % cantidad,
                    Home: 0,
                    End: cantidad - 1
                }[evento.key];

                if (destino === undefined) return;

                evento.preventDefault();
                $pestanas.eq(destino).focus().tab('show');
            });
        });

    </script>
@endsection
