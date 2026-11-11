@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Estadistica Trimestral de Inglés')
@section('content')
    <main>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading text-center" style="padding: 15px;">
                        <h3 class="panel-title" style="font-weight: bold; margin: 0;">
                            Estadísticas Trimestre: {{ $periodo->periodo_ingles }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-10 text-right">
                <a href="{{ route('ingles.exportar_estadisticas_generales') }}" class="btn btn-success" style="margin-right: 10px;">
                    Exportar a Excel
                </a>
                <button class="btn btn-primary" onclick="mostrarGrafica()">
                    Ver gráfica
                </button>
            </div>
        </div>


        <div class="container mt-4">
            <!-- Nav tabs -->
            <!-- Tabs -->
            <ul class="nav nav-tabs custom-tabs">
                <li class="active"><a data-toggle="tab" href="#aprobados"><i class="fa fa-check-circle"></i> Aprobación</a></li>
                <li><a data-toggle="tab" href="#reprobados"><i class="fa fa-times-circle"></i> Reprobación</a></li>
                <li><a data-toggle="tab" href="#desertores"><i class="fa fa-user-times"></i> Deserción</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top:15px;">
                <!-- Aprobados -->
                <div class="tab-pane fade in active" id="aprobados">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr class="success">
                            <th class="text-center">#</th>
                            <th class="text-center">Programa Académico</th>
                            <th class="text-center">Básico 1</th>
                            <th class="text-center">Básico 2</th>
                            <th class="text-center">Básico 3</th>
                            <th class="text-center">Básico 4</th>
                            <th class="text-center">Básico 5</th>
                            <th class="text-center">Intermedio 1</th>
                            <th class="text-center">Intermedio 2</th>
                            <th class="text-center">Intermedio 3</th>
                            <th class="text-center">Intermedio 4</th>
                            <th class="text-center">Intermedio 5</th>
                            <th class="text-center">Total por Carrera</th>
                            <th class="text-center">Porcentaje por Carrera</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contador = 1; @endphp
                        @foreach($tabla as $carrera => $datos)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $carrera }}</td>
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
                        <tr style="font-weight: bold; background-color: #dff0d8;">
                            <td colspan="2" class="text-right">Total por Nivel</td>
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
                        <tr style="font-weight: bold; background-color: #dff0d8;">
                            <td colspan="2" class="text-right">Porcentaje por Nivel</td>
                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $porcentaje_por_nivel['aprobados'][$nivel] }} %</td>
                            @endforeach
                            <td class="text-center">100 %</td>
                            <td colspan="11" class="text-center">{{ $porcentaje_general['aprobados'] }} %</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Reprobados -->
                <div class="tab-pane fade" id="reprobados">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr class="warning">
                            <th class="text-center">#</th>
                            <th class="text-center">Programa Académico</th>
                            <th class="text-center">Básico 1</th>
                            <th class="text-center">Básico 2</th>
                            <th class="text-center">Básico 3</th>
                            <th class="text-center">Básico 4</th>
                            <th class="text-center">Básico 5</th>
                            <th class="text-center">Intermedio 1</th>
                            <th class="text-center">Intermedio 2</th>
                            <th class="text-center">Intermedio 3</th>
                            <th class="text-center">Intermedio 4</th>
                            <th class="text-center">Intermedio 5</th>
                            <th class="text-center">Total por Carrera</th>
                            <th class="text-center">Porcentaje por Carrera</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contador = 1; @endphp
                        @foreach($tabla as $carrera => $datos)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $carrera }}</td>
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
                        <tr style="font-weight: bold; background-color: #fcf8e3;">
                            <td colspan="2" class="text-right">Total por Nivel</td>
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
                        <tr style="font-weight: bold; background-color: #fcf8e3;">
                            <td colspan="2" class="text-right">Porcentaje por Nivel</td>
                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $porcentaje_por_nivel['reprobados'][$nivel] }} %</td>
                            @endforeach
                            <td class="text-center">100 %</td>
                            <td colspan="11" class="text-center">{{ $porcentaje_general['reprobados'] }} %</td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Desertores -->
                <div class="tab-pane fade" id="desertores">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr class="danger">
                            <th class="text-center">#</th>
                            <th class="text-center">Programa Académico</th>
                            <th class="text-center">Básico 1</th>
                            <th class="text-center">Básico 2</th>
                            <th class="text-center">Básico 3</th>
                            <th class="text-center">Básico 4</th>
                            <th class="text-center">Básico 5</th>
                            <th class="text-center">Intermedio 1</th>
                            <th class="text-center">Intermedio 2</th>
                            <th class="text-center">Intermedio 3</th>
                            <th class="text-center">Intermedio 4</th>
                            <th class="text-center">Intermedio 5</th>
                            <th class="text-center">Total por Carrera</th>
                            <th class="text-center">Porcentaje por Carrera</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $contador = 1; @endphp
                        @foreach($tabla as $carrera => $datos)
                            <tr class="text-center">
                                <td>{{ $contador++ }}</td>
                                <td>{{ $carrera }}</td>
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
                        <tr style="font-weight: bold; background-color: #f2dede;">
                            <td colspan="2" class="text-right">Total por Nivel</td>
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
                        <tr style="font-weight: bold; background-color: #f2dede;">
                            <td colspan="2" class="text-right">Porcentaje por Nivel</td>
                            @foreach($niveles as $nivel)
                                <td class="text-center">{{ $porcentaje_por_nivel['desertores'][$nivel] }} %</td>
                            @endforeach
                            <td class="text-center">100 %</td>
                            <td colspan="11" class="text-center">{{ $porcentaje_general['desertores'] }} %</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-top: 20px;">
            <div class="container">
                <div id="grafico_estadisticas" style="display: none; height: 400px;"></div>
            </div>
        </div>

    </main>

    <script>
        let graficaMostrada = false;

        function mostrarGrafica() {
            const container = document.getElementById('grafico_estadisticas');

            if (graficaMostrada) {
                container.style.display = 'none';
                graficaMostrada = false;
                return;
            }

            container.style.display = 'block';
            graficaMostrada = true;

            Highcharts.chart('grafico_estadisticas', {
                chart: {
                    type: 'bar'
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
                        dataLabels: {
                            enabled: true,
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