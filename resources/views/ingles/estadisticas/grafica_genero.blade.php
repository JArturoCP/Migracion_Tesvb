@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Gráfica Estadística Género')
@section('content')


    <div class="container">
        <h3 class="text-center">Gráfica de Estadísticas de Género por Carrera</h3>

        <div class="row my-4">
            <div class="col-md-6">
                <div class="alert alert-info text-center">
                    Total Masculino: <strong>{{ $contar_m }}</strong>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-warning text-center">
                    Total Femenino: <strong>{{ $contar_f }}</strong>
                </div>
            </div>
        </div>

        <div id="graficaGenero" style="width: 100%; height: 500px;"></div>
    </div>
    <style>
        .highcharts-contextmenu {
            z-index: 10000 !important;
        }
        #graficaGenero .highcharts-container {
            overflow: visible !important;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            Highcharts.chart('graficaGenero', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Distribución de Género por Carrera'
                },
                xAxis: {
                    categories: categorias,
                    crosshair: true,
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '12px'
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
        });
    </script>

@endsection
