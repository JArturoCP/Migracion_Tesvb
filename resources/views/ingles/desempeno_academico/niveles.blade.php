@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Indices de Aprovechamiento')
@section('content')

    <style>
        .custom-tabs > li > a{
            font-weight:bold;
            padding:10px 18px;
            font-size:15px;
        }
        th{
            text-align:center;
            background:#f5f5f5;
        }
        .table td{
            vertical-align:top !important;
            font-size:13px;
        }
        .grupo-box{
            padding:4px 0;
            border-bottom:1px dotted #ccc;
            margin-bottom:4px;
        }

    </style>

    <div class="container">

        <!-- Encabezado -->
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading text-center" style="padding: 15px;">
                        <h3 class="panel-title" style="font-weight: bold; margin: 0;">
                            Seguimiento de Resultados Académicos Institucionales (Programas de Estudio)
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs custom-tabs">
            <li class="active"><a data-toggle="tab" href="#aprobados"><i class="fa fa-check-circle"></i> Aprobación</a></li>
            <li><a data-toggle="tab" href="#reprobados"><i class="fa fa-times-circle"></i> Reprobación</a></li>
            <li><a data-toggle="tab" href="#desertores"><i class="fa fa-user-times"></i> Deserción</a></li>
        </ul>

        <div class="tab-content">

            {{-- ========================================================= --}}
            {{-- ====================== A P R O B A D O S ===================== --}}
            {{-- ========================================================= --}}
            <div id="aprobados" class="tab-pane fade in active">
                <h3 class="text-center">APROBADOS</h3>

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="success">
                        <th>Programas de Estudio</th>
                        @foreach($niveles as $nivel)
                            <th class="text-center">{{ $nivel }}</th>
                        @endforeach
                        <th>Total de Alumnos</th>
                        <th>Porcentaje</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($tabla as $carrera => $datos)
                        <tr>
                            <td><strong>{{ $carrera }}</strong></td>

                            @foreach($niveles as $nivel)
                                <td>

                                    @php
                                        $lista = $grupos_por_categoria['aprobados'][$carrera][$nivel] ?? [];
                                    @endphp

                                    @if(count($lista) > 0)

                                        @foreach($lista as $g)
                                            <div class="grupo-box">
                                        <span class="label label-success">
                                            Grupo: {{ $g['grupo'] }}
                                        </span>

                                                <span class="badge">
                                            Estudiantes: {{ $g['total'] }}
                                        </span>

                                                <br>

                                                <small class="text-success">
                                                    Porcentaje por Nivel: {{ $porcentaje_por_nivel['aprobados'][$nivel] ?? 0 }}%
                                                </small>
                                            </div>
                                        @endforeach

                                    @else
                                        <span class="label label-danger">SIN GRUPO</span>
                                    @endif

                                </td>
                            @endforeach

                            <td class="text-center"><strong>{{ $datos['total_aprobados'] }}</strong></td>
                            <td><span class="badge">{{ $datos['porcentaje_aprobados'] }}%</span></td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr class="success text-center">
                        <td><strong>Total General</strong></td>

                        @foreach($niveles as $nivel)
                            <td class="text-center">{{ $totales_por_nivel['aprobados'][$nivel] }}</td>
                        @endforeach

                        <td class="text-center">{{ $total_general['aprobados'] }}</td>
                        <td class="text-center">{{ $porcentaje_general['aprobados'] }}%</td>
                    </tr>
                    </tfoot>

                </table>
            </div>


            {{-- ========================================================= --}}
            {{-- =======================  R E P R O B A D O S  ============ --}}
            {{-- ========================================================= --}}
            <div id="reprobados" class="tab-pane fade">
                <h3 class="text-center">REPROBADOS</h3>

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="warning">
                        <th>Programas de Estudio</th>
                        @foreach($niveles as $nivel)
                            <th>{{ $nivel }}</th>
                        @endforeach
                        <th>Total de Estudiantes</th>
                        <th>Porcentaje</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($tabla as $carrera => $datos)

                        <tr>
                            <td><strong>{{ $carrera }}</strong></td>

                            @foreach($niveles as $nivel)
                                <td>

                                    @php
                                        $lista = $grupos_por_categoria['reprobados'][$carrera][$nivel] ?? [];
                                    @endphp

                                    @if(count($lista) > 0)
                                        @foreach($lista as $g)
                                            <div class="grupo-box">
                                                <span class="label label-warning">Grupo: {{ $g['grupo'] }}</span>
                                                <span class="badge">Estudiantes: {{ $g['total'] }}</span>
                                                <br>
                                                <small class="text-warning">
                                                    Porcentaje por Nivel: {{ $porcentaje_por_nivel['reprobados'][$nivel] ?? 0 }}%
                                                </small>
                                            </div>
                                        @endforeach

                                    @else
                                        <span class="label label-danger">SIN GRUPO</span>
                                    @endif

                                </td>
                            @endforeach

                            <td class="text-center"><strong>{{ $datos['total_reprobados'] }}</strong></td>
                            <td class="text-center"><span class="badge">{{ $datos['porcentaje_reprobados'] }}%</span></td>
                        </tr>

                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr class="warning">
                        <td class="text-center"><strong>Total General</strong></td>

                        @foreach($niveles as $nivel)
                            <td class="text-center">{{ $totales_por_nivel['reprobados'][$nivel] }}</td>
                        @endforeach

                        <td class="text-center">{{ $total_general['reprobados'] }}</td>
                        <td class="text-center">{{ $porcentaje_general['reprobados'] }}%</td>
                    </tr>
                    </tfoot>

                </table>
            </div>



            {{-- ========================================================= --}}
            {{-- =======================  D E S E R T O R E S  ============ --}}
            {{-- ========================================================= --}}
            <div id="desertores" class="tab-pane fade">
                <h3 class="text-center">DESERTORES</h3>

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="danger">
                        <th>Programas de Estudio</th>
                        @foreach($niveles as $nivel)
                            <th>{{ $nivel }}</th>
                        @endforeach
                        <th>Total de Estudiantes</th>
                        <th>Porcentaje</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($tabla as $carrera => $datos)

                        <tr>
                            <td><strong>{{ $carrera }}</strong></td>

                            @foreach($niveles as $nivel)
                                <td>

                                    @php
                                        $lista = $grupos_por_categoria['desertores'][$carrera][$nivel] ?? [];
                                    @endphp

                                    @if(count($lista) > 0)
                                        @foreach($lista as $g)
                                            <div class="grupo-box">
                                                <span class="label label-danger">Grupo: {{ $g['grupo'] }}</span>
                                                <span class="badge">Estudiantes: {{ $g['total'] }}</span>
                                                <br>
                                                <small class="text-danger">
                                                    Porcentaje por Nivel: {{ $porcentaje_por_nivel['desertores'][$nivel] ?? 0 }}%
                                                </small>
                                            </div>
                                        @endforeach

                                    @else
                                        <span class="label label-danger">SIN GRUPO</span>
                                    @endif

                                </td>
                            @endforeach

                            <td class="text-center"><strong>{{ $datos['total_desertores'] }}</strong></td>
                            <td class="text-center"><span class="badge">{{ $datos['porcentaje_desertores'] }}%</span></td>
                        </tr>

                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr class="danger">
                        <td class="text-center"><strong>Total General</strong></td>

                        @foreach($niveles as $nivel)
                            <td class="text-center">{{ $totales_por_nivel['desertores'][$nivel] }}</td>
                        @endforeach

                        <td class="text-center">{{ $total_general['desertores'] }}</td>
                        <td class="text-center">{{ $porcentaje_general['desertores'] }}%</td>
                    </tr>
                    </tfoot>

                </table>
            </div>

        </div>

    </div>

@endsection