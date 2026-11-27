@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Estadisticas Generales')
@section('content')
    <style>
        .i5b-grafica {
            --i5b-grafica-texto: var(--tw-color-gray-800, #1d2939);
        }
        .dark .i5b-grafica {
            --i5b-grafica-texto: var(--tw-color-gray-200, #e4e7ec);
        }
        .i5b-grafica :is(.highcharts-title, .highcharts-axis-title, .highcharts-axis-labels text, .highcharts-legend-item text) {
            fill: var(--i5b-grafica-texto) !important;
        }
        .dark .i5b-grafica .highcharts-grid-line {
            stroke: var(--tw-color-gray-700, #344054);
        }
        .dark .i5b-grafica .highcharts-background {
            fill: var(--tw-color-gray-900, #101828);
        }
        .i5b-indicadores {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 19rem), 1fr));
            gap: 1rem;
        }
        .i5b-indicadores > * { min-width: 0; }
        .i5b-indicadores .tw-tabla-desplazable:focus-visible {
            outline: 2px solid var(--tw-color-brand-500, #465fff);
            outline-offset: -2px;
        }
        .i5b-indicador .panel-heading {
            background: transparent;
            border: 0;
            color: inherit;
        }
        .i5b-indicador .panel {
            background: transparent;
            border: 0;
            box-shadow: none;
        }
        .i5b-indicador .table > thead > tr > th {
            white-space: normal;
            overflow-wrap: anywhere;
        }
        .dark .i5b-indicador :is(.table, .table > thead > tr > th, .table > tbody > tr > td) {
            background: transparent;
            border-color: var(--tw-color-gray-700, #344054);
            color: var(--tw-color-gray-200, #e4e7ec);
        }
        #grafica_genero .highcharts-data-label text { fill: #fff !important; }
    </style>

    <main class="tw-modulo tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Estadísticas generales</h1>

        <div class="i5b-indicadores">
            <x-panel.tarjeta titulo="Estadísticas por género">
                <x-panel.tabla compacta desplazable="Conteo por género" class="tw-tabla-centrada tw-tabla-bordes">
                    <thead>
                        <tr><th scope="col">Género</th><th scope="col">Cantidad</th></tr>
                    </thead>
                    <tbody>
                        <tr><th scope="row">Masculino</th><td>{{ $contar_m }}</td></tr>
                        <tr><th scope="row">Femenino</th><td>{{ $contar_f }}</td></tr>
                    </tbody>
                </x-panel.tabla>
                <div id="grafica_genero" class="i5b-grafica tw:mt-4"></div>
            </x-panel.tarjeta>

            <x-panel.tarjeta class="i5b-indicador i5b-grafica">
                @include('ingles.estadisticas.estadisticas_atencion_demanda')
            </x-panel.tarjeta>

            <x-panel.tarjeta class="i5b-indicador i5b-grafica">
                @include('ingles.estadisticas.estadisticas_eficiencia_terminal')
            </x-panel.tarjeta>
        </div>
    </main>

    <script>
        // Funciona abierta sola o cargada por AJAX: dibuja cuando el documento está listo y carga Highcharts si falta.
        (function (dibujar) { function correr() { if (window.Highcharts) { dibujar(); return; } var s = document.createElement('script'); s.src = 'https://code.highcharts.com/highcharts.js'; s.onload = dibujar; document.head.appendChild(s); } if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', correr); } else { correr(); } })(function () {

            var masculino = {{ $contar_m }};
            var femenino  = {{ $contar_f }};
            var total = masculino + femenino;

            var porcM = total > 0 ? (masculino / total) * 100 : 0;
            var porcF = total > 0 ? (femenino  / total) * 100 : 0;

            Highcharts.chart('grafica_genero', {
                chart: {
                    type: 'column',
                    backgroundColor: 'transparent',
                    style: { fontFamily: 'inherit' }
                },
                title: {
                    text: 'Distribución de Género'
                },
                xAxis: {
                    categories: ['Masculino', 'Femenino'],
                    title: { text: 'Género' }
                },
                yAxis: {
                    title: { text: 'Porcentaje' },
                    max: 100
                },
                tooltip: {
                    pointFormat: '<b>{point.y:.1f}%</b> ({point.count} estudiantes)'
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            backgroundColor: '#111827',
                            borderRadius: 4,
                            style: { textOutline: 'none' },
                            format: '{y:.1f}%'
                        }
                    }
                },
                series: [{
                    name: 'Género',
                    data: [
                        {
                            y: porcM,
                            count: masculino,
                            color: '#007bff'        // 🔵 Color Masculino
                        },
                        {
                            y: porcF,
                            count: femenino,
                            color: '#ff1493'        // 🌸 Color Femenino
                        }
                    ]
                }]
            });

        });
    </script>
@endsection
