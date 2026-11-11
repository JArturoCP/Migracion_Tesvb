@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Estadisticas Generales')

@section('content')
    <main>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading text-center">
                            <h3 class="panel-title">Estadísticas Generales</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Estadísticas por Género</h3>
                        </div>
                    </div>

                    <table class="table table-bordered text-center" style="table-layout:fixed;">
                        <thead>
                        <tr>
                            <th class="text-center">Género</th>
                            <th class="text-center">Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Masculino</td>
                            <td>{{ $contar_m }}</td>
                        </tr>
                        <tr>
                            <td>Femenino</td>
                            <td>{{ $contar_f }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div id="grafica_genero"></div>
                </div>


                <div class="col-sm-4">
                    @include('ingles.estadisticas.estadisticas_atencion_demanda')
                </div>

                <div class="col-sm-4">
                    @include('ingles.estadisticas.estadisticas_eficiencia_terminal')
                </div>

            </div>
        </div>



        <script>
            document.addEventListener("DOMContentLoaded", function () {

                var masculino = {{ $contar_m }};
                var femenino  = {{ $contar_f }};
                var total = masculino + femenino;

                var porcM = total > 0 ? (masculino / total) * 100 : 0;
                var porcF = total > 0 ? (femenino  / total) * 100 : 0;

                Highcharts.chart('grafica_genero', {
                    chart: {
                        type: 'column'
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



    </main>
    <br>
@endsection