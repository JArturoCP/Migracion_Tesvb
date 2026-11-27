@once('ingles-i5c-estilos')
    <style data-i5c-estilos>
        html:has(> body > .i5c-indicador) { color-scheme: light dark; }

        .i5c-indicador {
            --i5c-texto: light-dark(#344054, #e4e7ec);
            --i5c-borde: light-dark(#e4e7ec, #344054);
            --i5c-superficie: light-dark(#fff, #101828);
            color: var(--i5c-texto);
        }
        .i5b-indicador .i5c-indicador { color-scheme: light; }
        .dark .i5b-indicador .i5c-indicador { color-scheme: dark; }
        .i5c-indicador:not(.i5b-indicador *) {
            box-sizing: border-box;
            max-width: 48rem;
            margin: 1rem auto;
            padding: 1rem;
            border: 1px solid var(--i5c-borde);
            border-radius: .75rem;
            background: var(--i5c-superficie);
            font-family: "Atkinson Hyperlegible Next", system-ui, sans-serif;
        }

        .i5c-indicador .i5c-titulo {
            margin: 0 0 1rem;
            color: var(--i5c-texto);
            font-size: max(1.125rem, 16px);
            font-weight: 600;
            line-height: 1.35;
        }
        .i5c-indicador .tw-tabla-desplazable { overflow-x: auto; }
        .i5c-indicador .tw-tabla-desplazable:focus-visible {
            outline: 2px solid var(--tw-color-brand-500, #465fff);
            outline-offset: -2px;
        }
        .i5c-indicador .i5c-tabla th { white-space: normal; overflow-wrap: anywhere; }
        .i5c-indicador:not(.i5b-indicador *) .i5c-tabla {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .i5c-indicador:not(.i5b-indicador *) .i5c-tabla :is(th, td) {
            padding: .5rem;
            border: 1px solid var(--i5c-borde);
        }

        .i5c-indicador :is(.highcharts-title, .highcharts-axis-title, .highcharts-axis-labels text, .highcharts-legend-item text) {
            fill: var(--i5c-texto) !important;
        }
        .i5c-indicador .highcharts-grid-line { stroke: var(--i5c-borde); }
    </style>
@endonce

<section class="i5c-indicador" aria-labelledby="grafica_eficiencia-titulo">
    <h3 id="grafica_eficiencia-titulo" class="i5c-titulo">Estadísticas de Eficiencia Terminal</h3>

    <x-panel.tabla compacta desplazable="Eficiencia Terminal" class="i5c-tabla tw-tabla-centrada tw-tabla-bordes">
        <thead>
            <tr>
                <th scope="col">Eficiencia Terminal</th>
                <th scope="col">Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Índice</th>
                <td>{{ $eficiencia_terminal }} %</td>
            </tr>
        </tbody>
    </x-panel.tabla>

    <div id="grafica_eficiencia" class="tw:mt-4"></div>

    <script>
        // Funciona abierta sola o cargada por AJAX: dibuja cuando el documento está listo y carga Highcharts si falta.
        (function (dibujar) { function correr() { if (window.Highcharts) { dibujar(); return; } var s = document.createElement('script'); s.src = 'https://code.highcharts.com/highcharts.js'; s.onload = dibujar; document.head.appendChild(s); } if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', correr); } else { correr(); } })(function () {
            Highcharts.chart('grafica_eficiencia', {
                chart: {
                    type: 'column',
                    backgroundColor: 'transparent',
                    style: { fontFamily: 'inherit' }
                },
                title: {
                    text: 'Índice de Eficiencia Terminal'
                },
                tooltip: {
                    pointFormat: '<b>{point.y}%</b>'
                },
                xAxis: {
                    categories: ['Índice']
                },
                yAxis: {
                    max: 100,
                    title: { text: 'Porcentaje' }
                },
                series: [{
                    name: 'Eficiencia Terminal',
                    data: [{{ $eficiencia_terminal }}]
                }]
            });
        });
    </script>
</section>
