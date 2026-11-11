@extends('layouts.app')

@section('content')

<style>
    .main{
        margin-top:30px;
        margin-bottom:30px;
    }

    .panel-dashboard .panel-body{
        padding:25px;
    }

    .resultado-principal{
        font-size:72px;
        font-weight:bold;
        color:#337ab7;
        margin:0;
    }

    .table>thead>tr>th{
        text-align:center;
        vertical-align:middle;
        background:#f5f5f5;
    }

    .table>tbody>tr>td{
        vertical-align:middle;
    }

    .progress{
        margin-bottom:0;
        height:22px;
    }

    .progress-bar{
        line-height:22px;
        font-weight:bold;
    }

    .panel{
        margin-bottom:30px;
    }

    .resumen-numero{
        font-size:30px;
        font-weight:bold;
    }
</style>

<div class="container main">

    <!-- Título -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h2><strong>Resultado EGEL</strong></h2>
            <p class="text-muted">
                Consulta tu desempeño general y el detalle por módulos y secciones.
            </p>
            <hr>
        </div>
    </div>

    @if($resultado)

    <!-- Resumen -->
    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-info text-center panel-dashboard">
                <div class="panel-heading">
                    Calificación
                </div>

                <div class="panel-body">
                    <div class="resumen-numero">
                        {{ $resultado->calificacion_general }}%
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-success text-center panel-dashboard">
                <div class="panel-heading">
                    Nivel obtenido
                </div>

                <div class="panel-body">
                    <div class="resumen-numero">
                        {{ $resultado->nivel }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning text-center panel-dashboard">
                <div class="panel-heading">
                    Módulos evaluados
                </div>

                <div class="panel-body">
                    <div class="resumen-numero">
                        {{ count($porModulo) }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @endif


    <!-- Resultado General -->
    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary">

                <div class="panel-heading text-center">
                    <h3 class="panel-title">
                        Resultado General
                    </h3>
                </div>

                <div class="panel-body text-center">

                    @if($resultado)

                        <div class="resultado-principal">
                            {{ $resultado->calificacion_general }}%
                        </div>

                        <hr>

                        <h4>
                            Nivel alcanzado
                        </h4>

                        <span class="label label-success" style="font-size:18px;padding:10px 20px;">
                            {{ $resultado->nivel }}
                        </span>

                    @else

                        <h4 class="text-muted">
                            Aún no existe un resultado disponible.
                        </h4>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- Módulos -->
    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <strong>Resultados por módulo</strong>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover">

                            <thead>

                            <tr>
                                <th>Módulo</th>
                                <th>Puntos obtenidos</th>
                                <th>Total puntos</th>
                                <th width="35%">Desempeño</th>
                            </tr>

                            </thead>

                            <tbody>

                            @foreach($porModulo as $m)

                                @php

                                    if($m->porcentaje>=90){
                                        $color="success";
                                    }elseif($m->porcentaje>=75){
                                        $color="info";
                                    }elseif($m->porcentaje>=60){
                                        $color="warning";
                                    }else{
                                        $color="danger";
                                    }

                                @endphp

                                <tr>

                                    <td>{{ $m->nombre }}</td>

                                    <td class="text-center">
                                        {{ number_format($m->puntos,2) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($m->total_valor,2) }}
                                    </td>

                                    <td>

                                        <div class="progress">

                                            <div
                                                class="progress-bar progress-bar-{{ $color }}"
                                                role="progressbar"
                                                style="width:{{ $m->porcentaje }}%;">

                                                {{ $m->porcentaje }}%

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Secciones -->
    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-success">

                <div class="panel-heading">
                    <strong>Resultados por sección</strong>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover">

                            <thead>

                            <tr>

                                <th>Sección</th>
                                <th>Puntos obtenidos</th>
                                <th>Total puntos</th>
                                <th width="35%">Desempeño</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($porSeccion as $s)

                                @php

                                    if($s->porcentaje>=90){
                                        $color="success";
                                    }elseif($s->porcentaje>=75){
                                        $color="info";
                                    }elseif($s->porcentaje>=60){
                                        $color="warning";
                                    }else{
                                        $color="danger";
                                    }

                                @endphp

                                <tr>

                                    <td>
                                        Sección {{ $s->id_seccion }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($s->puntos,2) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($s->total_valor,2) }}
                                    </td>

                                    <td>

                                        <div class="progress">

                                            <div
                                                class="progress-bar progress-bar-{{ $color }}"
                                                role="progressbar"
                                                style="width:{{ $s->porcentaje }}%;">

                                                {{ $s->porcentaje }}%

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Botón -->
    <div class="row">

        <div class="col-md-12 text-center">

            <a href="{{ route('examen_general.pdf.oficial') }}"
               class="btn btn-primary btn-lg">

                <span class="glyphicon glyphicon-file"></span>

                Descargar reporte

            </a>

        </div>

    </div>

</div>

@endsection