@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Gráfica Estadística Género')
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
        .i5b-desplazable {
            overflow-x: auto;
            max-width: 100%;
        }
        #graficaGenero {
            min-width: max(100%, calc(5rem + 9rem * var(--i5b-carreras)));
            height: 500px;
        }
        .i5b-desplazable:focus-visible,
        #graficaGenero :is(.highcharts-contextbutton, .highcharts-menu-item):focus-visible {
            outline: 2px solid var(--tw-color-brand-500, #465fff);
            outline-offset: -2px;
        }
        #graficaGenero .highcharts-contextmenu { z-index: 10000 !important; }
        #graficaGenero .highcharts-container { overflow: visible !important; }
    </style>

    <main class="tw-modulo tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Estadísticas de género por carrera</h1>

        <x-panel.tarjeta>
            <dl class="tw:flex tw:flex-wrap tw:gap-4 tw:text-gray-800 tw:dark:text-gray-200">
                <div><dt>Total Masculino:</dt><dd>{{ $contar_m }}</dd></div>
                <div><dt>Total Femenino:</dt><dd>{{ $contar_f }}</dd></div>
            </dl>
            <div class="i5b-desplazable" tabindex="0" role="region" aria-label="Gráfica de género por carrera con desplazamiento horizontal">
                <div id="graficaGenero" class="i5b-grafica" style="--i5b-carreras: {{ count($datosAgrupados) }};"></div>
            </div>
        </x-panel.tarjeta>
    </main>

    <script>
        // Funciona abierta sola o cargada por AJAX: dibuja cuando el documento está listo y carga Highcharts si falta.
        (function (dibujar) { function correr() { if (window.Highcharts) { dibujar(); return; } var s = document.createElement('script'); s.src = 'https://code.highcharts.com/highcharts.js'; s.onload = dibujar; document.head.appendChild(s); } if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', correr); } else { correr(); } })(function () {
            const datos = @json($datosAgrupados);

            const categorias = [];
            const dataHombres = [];
            const dataMujeres = [];

            // Recorremos por carrera y sumamos por género
            for (const carrera in datos) {
                let totalHombres = 0;
                let totalMujeres = 0;

                for (const nivel in datos[carrera]) {
                    totalHombres += datos[carrera][nivel]['M'];
                    totalMujeres += datos[carrera][nivel]['F'];
                }

                categorias.push(carrera);
                dataHombres.push(totalHombres);
                dataMujeres.push(totalMujeres);
            }

            const grafico = Highcharts.chart('graficaGenero', {
                chart: {
                    type: 'column',
                    backgroundColor: 'transparent',
                    style: { fontFamily: 'inherit' }
                },
                title: {
                    text: 'Distribución de Género por Carrera'
                },
                xAxis: {
                    categories: categorias,
                    crosshair: true,
                    labels: {
                        step: 1,
                        style: {
                            fontSize: '12px',
                            whiteSpace: 'normal',
                            textOverflow: 'clip'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Número de Alumnos'
                    },
                    allowDecimals: false
                },
                tooltip: {
                    shared: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Hombres',
                    data: dataHombres,
                    color: '#3674f7' // azul
                }, {
                    name: 'Mujeres',
                    data: dataMujeres,
                    color: '#f7366e' // rosa
                }],
                exporting: {
                    enabled: true,
                    filename: 'grafico-genero-carreras',
                    buttons: {
                        contextButton: {
                            menuItems: ['downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadSVG']
                        }
                    }
                }

            });

            const contenedor = grafico.renderTo;
            const boton = contenedor.querySelector('.highcharts-contextbutton');

            // Cuando Highcharts ya gestiona el teclado, se conserva su control.
            if (boton && !grafico.accessibility?.keyboardNavigation && !boton.hasAttribute('tabindex')) {
                boton.setAttribute('role', 'button');
                boton.setAttribute('tabindex', '0');
                boton.setAttribute('aria-label', 'Exportar gráfica');

                contenedor.addEventListener('keydown', (evento) => {
                    const desdeBoton = evento.target === boton;
                    const desdeOpcion = evento.target.matches('.highcharts-menu-item');
                    if (!desdeBoton && !desdeOpcion) return;

                    const menu = contenedor.querySelector('.highcharts-contextmenu');
                    if (evento.key === 'Escape' && menu && grafico.openMenu) {
                        evento.preventDefault();
                        if (typeof menu.hideMenu === 'function') {
                            menu.hideMenu();
                        } else {
                            menu.style.display = 'none';
                            grafico.openMenu = false;
                            grafico.exportSVGElements?.find((elemento) => elemento.element === boton)?.setState(0);
                        }
                        boton.focus();
                        return;
                    }

                    if (evento.key !== 'Enter' && evento.key !== ' ') return;

                    evento.preventDefault();
                    if (desdeBoton) {
                        boton.dispatchEvent(new MouseEvent('click', { bubbles: true }));
                        const opciones = contenedor.querySelectorAll('.highcharts-menu-item');
                        opciones.forEach((opcion) => {
                            opcion.setAttribute('tabindex', '0');
                            opcion.setAttribute('role', 'button');
                        });
                        opciones[0]?.focus();
                    } else {
                        evento.target.click();
                        boton.focus();
                    }
                });
            }
        });
    </script>
@endsection
