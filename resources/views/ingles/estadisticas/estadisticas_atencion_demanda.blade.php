<div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Estadísticas de Atención de Demanda</h3>
        </div>
    </div>

    <table class="table table-bordered text-center" style="table-layout:fixed;">
        <thead>
        <tr>
            <th style="text-align: center">Atención de la Demanda</th>
            <th style="text-align: center">Porcentaje</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="text-align: center">Índice</td>
            <td style="text-align: center">{{ $atencion_demanda }} %</td>
        </tr>
        </tbody>
    </table>

    <div id="grafica_demanda"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Highcharts.chart('grafica_demanda', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Indice de Atención de la Demanda'
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
                    name: 'Atención de la Demanda',
                    data: [{{ $atencion_demanda }}]
                }]
            });
        });
    </script>

</div>