@extends('tutorias.app_tutorias')
@section('content')
    <script>
        $(document).ready(function()
        {
            Highcharts.chart('ver_grafica', {
                chart: {
                    type: 'column',
                    width: 1000,
                    x:1000,
                },
                title: {
                    text: 'Resultado Grafico:'
                },

                xAxis: {
                    type: 'category',
                    title: {
                        text: 'Aspectos evaluados'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Porcentaje'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:3px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
                },

                series: [{
                    name: 'CRITERIO',
                    colorByPoint: true,
                    data:
                        [
                            {
                                name: 'Media A',
                                y: {{$media->gestion }},
                            },
                            {
                                name: 'Moda A',
                                y: {{$moda->gestion }},
                            },
                            {
                                name: 'Mediana A',
                                y: {{$mediana->gestion }},
                            },
                            {
                                name: 'Media B',
                                y: {{$media->actitud }},
                            },
                            {
                                name: 'Moda B',
                                y: {{$moda->actitud }},
                            },
                            {
                                name: 'Mediana B',
                                y: {{$mediana->actitud }},
                            },
                            {
                                name: 'Media C',
                                y: {{$media->disponibilidad_confianza}},
                            },
                            {
                                name: 'Moda C',
                                y: {{$moda->disponibilidad_confianza }},
                            },
                            {
                                name: 'Mediana C',
                                y: {{$mediana->disponibilidad_confianza }},
                            },
                            {
                                name: 'Media D',
                                y: {{$media->servicios_del_programa_de_tutoria}},
                            },
                            {
                                name: 'Moda D',
                                y: {{$moda->servicios_del_programa_de_tutoria }},
                            },
                            {
                                name: 'Mediana D',
                                y: {{$mediana->servicios_del_programa_de_tutoria }},
                            },
                            {
                                name: 'Media E',
                                y: {{$media->tus_logros_y_avances}},
                            },
                            {
                                name: 'Moda E',
                                y: {{$moda->tus_logros_y_avances }},
                            },
                            {
                                name: 'Mediana E',
                                y: {{$mediana->tus_logros_y_avances }},
                            },

                        ]
                }]

            });
            $('#exportar').click(function()
            {


                var chart=$('#ver_grafica').highcharts();
                console.log(chart.getSVG());


                var direccion="177.244.44.90:8006/";
                //var direccionimg="hola";
                var obj = {},
                    exportUrl = 'http://'+direccion;
                obj.type = 'image/png';
                obj.async = true;
                obj.svg=chart.getSVG();

                $.ajax
                ({
                    type: 'post',
                    url: exportUrl,
                    data: obj,
                    success: function (data)
                    {
                        console.log(exportUrl+data);
                        // alert(direccionimg);
                        //var imgContainer = $("#formgeneral");
                        //$('<img>').attr('src', exportUrl + data).attr('width', '250px').appendTo(imgContainer);
                        // $('<a>or Download Here</a>').attr('href', exportUrl + data).appendTo(imgContainer);
                        // $('<input type="text" class="form-control"  placeholder="" id="dir_imagen" name="dir_imagen" value="exportUrl+data">').appendTo(imgContainer);

                        var direccionimg=exportUrl+data;


                        $("#dir_imagen").val(direccionimg);
                        $("#formgeneral").submit();

                    }
                });
            });
        });
    </script>
    <div class="row">
        <p></p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="ver_grafica">

            </div>
        </div>
    </div>

    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Aspectos Evaluados</th>
                <th scope="col">Media</th>
                <th scope="col">Moda</th>
                <th scope="col">Mediana</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>A</th>
                <td>Percepción respecto a tu tutor(a) en la Gestión</td>
                <td>{{$media->gestion }}</td>
                <td>{{$moda->gestion }}</td>
                <td>{{$mediana->gestion }}</td>

            </tr>
            <tr>
                <td>B</td>
                <td>Percepción respecto a tu tutor(a) en la Actitud</td>
                <td>{{$media->actitud }}</td>
                <td>{{$moda->actitud }}</td>
                <td>{{$mediana->actitud }}</td>
            </tr>
            <tr>
                <th>C</th>
                <td>Percepción respecto a tu tutor(a) en la disponibilidad y confianza</td>
                <td>{{$media->disponibilidad_confianza }}</td>
                <td>{{$moda->disponibilidad_confianza }}</td>
                <td>{{$mediana->disponibilidad_confianza }}</td>
            </tr>
            <tr>
                <td>D</td>
                <td>Percepción respecto a los servicios del programa de Tutoría</td>
                <td>{{$media->servicios_del_programa_de_tutoria }}</td>
                <td>{{$moda->servicios_del_programa_de_tutoria }}</td>
                <td>{{$mediana->servicios_del_programa_de_tutoria }}</td>
            </tr>
            <tr>
                <th>E</th>
                <td>Percepción respecto a tus logros y avances</td>
                <td>{{$media->tus_logros_y_avances }}</td>
                <td>{{$moda->tus_logros_y_avances }}</td>
                <td>{{$mediana->tus_logros_y_avances }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection