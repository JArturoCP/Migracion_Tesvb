@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Estadistica Trimestral de Inglés')
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
        #grafico_estadisticas { height: 400px; --i5a-chart-text: var(--tw-color-gray-800, #1d2939); }
        .dark #grafico_estadisticas { --i5a-chart-text: var(--tw-color-gray-200, #e4e7ec); }
        #grafico_estadisticas :is(.highcharts-title, .highcharts-axis-title, .highcharts-axis-labels text, .highcharts-legend-item text) {
            fill: var(--i5a-chart-text) !important;
        }
        #grafico_estadisticas .highcharts-data-label text { fill: #fff !important; }
        .dark #grafico_estadisticas .highcharts-grid-line { stroke: var(--tw-color-gray-700, #344054); }
    </style>

    <main class="tw-modulo tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
            <div>
                <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Estadísticas del trimestre</h1>
                <p class="tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">{{ $periodo->periodo_ingles }}</p>
            </div>
            <div class="tw:flex tw:flex-wrap tw:gap-2">
                <x-panel.boton variante="secundario" href="{{ route('ingles.exportar_estadisticas_generales') }}">
                    <span class="fa fa-file-excel-o" aria-hidden="true"></span> Exportar a Excel
                </x-panel.boton>
                <x-panel.boton id="boton_grafico_estadisticas" aria-controls="grafico_estadisticas" aria-expanded="false" onclick="mostrarGrafica()">
                    <span class="fa fa-bar-chart" aria-hidden="true"></span> Ver gráfica
                </x-panel.boton>
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
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Programa Académico</th>
                            <th scope="col" class="text-center">Básico 1</th>
                            <th scope="col" class="text-center">Básico 2</th>
                            <th scope="col" class="text-center">Básico 3</th>
                            <th scope="col" class="text-center">Básico 4</th>
                            <th scope="col" class="text-center">Básico 5</th>
                            <th scope="col" class="text-center">Intermedio 1</th>
                            <th scope="col" class="text-center">Intermedio 2</th>
                            <th scope="col" class="text-center">Intermedio 3</th>
                            <th scope="col" class="text-center">Intermedio 4</th>
                            <th scope="col" class="text-center">Intermedio 5</th>
                            <th scope="col" class="text-center">Total por Carrera</th>
                            <th scope="col" class="text-center">Porcentaje por Carrera</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contador = 1; @endphp
                        @foreach($tabla as $carrera => $datos)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <th scope="row">{{ $carrera }}</th>
                                <td>{{ $datos['aprobados']['Básico 1'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Básico 2'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Básico 3'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Básico 4'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Básico 5'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Intermedio 1'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Intermedio 2'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Intermedio 3'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Intermedio 4'] ?? 0 }}</td>
                                <td>{{ $datos['aprobados']['Intermedio 5'] ?? 0 }}</td>
                                <td>{{ $datos['total_aprobados'] ?? 0 }}</td>
                                <td>{{ $datos['porcentaje_aprobados'] }} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="row" colspan="2" class="text-right">Total por Nivel</th>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Básico 1'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Básico 2'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Básico 3'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Básico 4'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Básico 5'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Intermedio 1'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Intermedio 2'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Intermedio 3'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Intermedio 4'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['aprobados']['Intermedio 5'] ?? 0 }}</td>
                            <td class="text-center">{{ $total_general['aprobados'] ?? 0 }}</td>
                            <td class="text-center">Porcentaje General</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2" class="text-right">Porcentaje por Nivel</th>
                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $porcentaje_por_nivel['aprobados'][$nivel] }} %</td>
                            @endforeach
                            <td class="text-center">100 %</td>
                            <td class="text-center">{{ $porcentaje_general['aprobados'] }} %</td>
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
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Programa Académico</th>
                            <th scope="col" class="text-center">Básico 1</th>
                            <th scope="col" class="text-center">Básico 2</th>
                            <th scope="col" class="text-center">Básico 3</th>
                            <th scope="col" class="text-center">Básico 4</th>
                            <th scope="col" class="text-center">Básico 5</th>
                            <th scope="col" class="text-center">Intermedio 1</th>
                            <th scope="col" class="text-center">Intermedio 2</th>
                            <th scope="col" class="text-center">Intermedio 3</th>
                            <th scope="col" class="text-center">Intermedio 4</th>
                            <th scope="col" class="text-center">Intermedio 5</th>
                            <th scope="col" class="text-center">Total por Carrera</th>
                            <th scope="col" class="text-center">Porcentaje por Carrera</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contador = 1; @endphp
                        @foreach($tabla as $carrera => $datos)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <th scope="row">{{ $carrera }}</th>
                                <td>{{ $datos['reprobados']['Básico 1'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Básico 2'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Básico 3'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Básico 4'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Básico 5'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Intermedio 1'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Intermedio 2'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Intermedio 3'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Intermedio 4'] ?? 0 }}</td>
                                <td>{{ $datos['reprobados']['Intermedio 5'] ?? 0 }}</td>
                                <td>{{ $datos['total_reprobados'] ?? 0 }}</td>
                                <td>{{ $datos['porcentaje_reprobados'] }} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="row" colspan="2" class="text-right">Total por Nivel</th>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Básico 1'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Básico 2'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Básico 3'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Básico 4'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Básico 5'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Intermedio 1'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Intermedio 2'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Intermedio 3'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Intermedio 4'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['reprobados']['Intermedio 5'] ?? 0 }}</td>
                            <td class="text-center">{{ $total_general['reprobados'] ?? 0 }}</td>
                            <td class="text-center">Porcentaje General</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2" class="text-right">Porcentaje por Nivel</th>
                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $porcentaje_por_nivel['reprobados'][$nivel] }} %</td>
                            @endforeach
                            <td class="text-center">100 %</td>
                            <td class="text-center">{{ $porcentaje_general['reprobados'] }} %</td>
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
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Programa Académico</th>
                            <th scope="col" class="text-center">Básico 1</th>
                            <th scope="col" class="text-center">Básico 2</th>
                            <th scope="col" class="text-center">Básico 3</th>
                            <th scope="col" class="text-center">Básico 4</th>
                            <th scope="col" class="text-center">Básico 5</th>
                            <th scope="col" class="text-center">Intermedio 1</th>
                            <th scope="col" class="text-center">Intermedio 2</th>
                            <th scope="col" class="text-center">Intermedio 3</th>
                            <th scope="col" class="text-center">Intermedio 4</th>
                            <th scope="col" class="text-center">Intermedio 5</th>
                            <th scope="col" class="text-center">Total por Carrera</th>
                            <th scope="col" class="text-center">Porcentaje por Carrera</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contador = 1; @endphp
                        @foreach($tabla as $carrera => $datos)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <th scope="row">{{ $carrera }}</th>
                                <td>{{ $datos['desertores']['Básico 1'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Básico 2'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Básico 3'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Básico 4'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Básico 5'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Intermedio 1'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Intermedio 2'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Intermedio 3'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Intermedio 4'] ?? 0 }}</td>
                                <td>{{ $datos['desertores']['Intermedio 5'] ?? 0 }}</td>
                                <td>{{ $datos['total_desertores'] ?? 0 }}</td>
                                <td>{{ $datos['porcentaje_desertores'] }} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="row" colspan="2" class="text-right">Total por Nivel</th>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Básico 1'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Básico 2'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Básico 3'] ?? 0 }}</td>
                            <td class="text-center"> {{ $totales_por_nivel['desertores']['Básico 4'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Básico 5'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Intermedio 1'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Intermedio 2'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Intermedio 3'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Intermedio 4'] ?? 0 }}</td>
                            <td class="text-center">{{ $totales_por_nivel['desertores']['Intermedio 5'] ?? 0 }}</td>
                            <td class="text-center">{{ $total_general['desertores'] ?? 0 }}</td>
                            <td class="text-center">Porcentaje General</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2" class="text-right">Porcentaje por Nivel</th>
                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $porcentaje_por_nivel['desertores'][$nivel] }} %</td>
                            @endforeach
                            <td class="text-center">100 %</td>
                            <td class="text-center">{{ $porcentaje_general['desertores'] }} %</td>
                        </tr>
                        </tfoot>
                    </x-panel.tabla>
                </section>
            </div>
        </x-panel.tarjeta>

        <div id="grafico_estadisticas" class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-gray-900" style="display: none;" role="region" aria-label="Distribución General de Desempeño"></div>
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

        let graficaMostrada = false;

        function mostrarGrafica() {
            const container = document.getElementById('grafico_estadisticas');
            const boton = document.getElementById('boton_grafico_estadisticas');

            if (graficaMostrada) {
                container.style.display = 'none';
                boton.setAttribute('aria-expanded', 'false');
                graficaMostrada = false;
                return;
            }

            container.style.display = 'block';
            boton.setAttribute('aria-expanded', 'true');
            graficaMostrada = true;

            Highcharts.chart('grafico_estadisticas', {
                chart: {
                    type: 'bar',
                    backgroundColor: 'transparent',
                    style: { fontFamily: 'inherit' }
                },
                title: {
                    text: 'Distribución General de Desempeño'
                },

                tooltip: {
                    formatter: function () {
                        const total = this.series.data.reduce((sum, p) => sum + p.y, 0);
                        const porcentaje = (this.point.y / total) * 100;

                        return `<b>${this.point.name}</b><br>
                    ${this.point.y} estudiantes (${porcentaje.toFixed(1)}%)`;
                    }
                },

                plotOptions: {
                    bar: {
                        animation: false,
                        dataLabels: {
                            enabled: true,
                            backgroundColor: '#111827',
                            borderRadius: 4,
                            padding: 4,
                            style: { textOutline: 'none' },
                            formatter: function () {
                                const total = this.series.data.reduce((sum, p) => sum + p.y, 0);
                                const porcentaje = (this.point.y / total) * 100;

                                return `<b>${this.point.name}</b>: ${this.point.y} (${porcentaje.toFixed(1)}%)`;
                            }
                        }
                    }
                },

                series: [{
                    name: 'Estudiantes',
                    colorByPoint: true,
                    data: [{
                        name: 'Aprobados',
                        y: {{ $total_general['aprobados'] ?? 0 }},
                        color: '#cc06d5'
                    }, {
                        name: 'Reprobados',
                        y: {{ $total_general['reprobados'] ?? 0 }},
                        color: '#36f4d7'
                    }, {
                        name: 'Desertores',
                        y: {{ $total_general['desertores'] ?? 0 }},
                        color: '#ff0707'
                    }]
                }],

                credits: {
                    enabled: false
                }
            });

        }
    </script>
@endsection
