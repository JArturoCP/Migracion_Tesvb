@extends('layouts.app')
@section('title', 'Encuestas servicio social')
@section('content')
    <?php
    $historial = Session::get('historial_enc_s');

    ?>
    @if($historial == 1)
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/historial_periodo_year/")}}">Historial de  encuestas de satisfacción del cliente</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/menu_historial_servicio_s_year/".$year)}}">Periodos</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Programas de Estudios</span>
                </p>
                <br>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/agregar_periodo_year/")}}">Periodos</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Programas de Estudios</span>

                </p>
                <br>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satisfacción del cliente <br> (Servicio Social) <br>@if($mes == 1) Enero @else Julio @endif del {{ $year }}<br>PROGRAMAS DE ESTUDIO<br></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            @if($periodo->id_estado == 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Tipo de encuesta</th>
                                    <th>Total de estudiantes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Encuestas enviadas a los estudiantes</td>
                                    <td>{{ $encuestas_enviadas }}</td>

                                </tr>
                                <tr>
                                    <td>Encuestas contestadas por los estudiantes</td>
                                    <td>{{$encuestas_contestadas}}</td>
                                </tr>

                                </tbody>
                            </table>
                                @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Tipo de encuesta</th>
                                        <th>Total de estudiantes</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Encuestas contestadas por los estudiantes</td>
                                        <td>{{$encuestas_contestadas}}</td>
                                        <td><button type="button" class="btn btn-success"   onclick="window.location='{{ url('/encuestas_satisfaccion/ver_enc_resultados/'.$mes.'/'.$year ) }}'">Ver resultados</button></td>
                                    </tr>
                                    <tr>
                                        <td>Encuestas no contestadas</td>
                                        <td>{{ $encuestas_rechazadas }}</td>

                                    </tr>

                                    </tbody>
                                </table>
                            @endif

                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-pills nav-stacked" style="background-color:white;border: 2px solid black; border-radius: 7px; padding-right: 0px">
                            @foreach($carreras as $carrera)
                                @if($periodo->id_estado == 0)
                                <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" href="#" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_encuesta_servicio_alumno/'.$carrera->id_carrera.'/'.$mes.'/'.$year ) }}'" >   {{$carrera->nombre}}</a></li>
                                @else
                                    <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" href="#" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_enc_serv_alum_terminado/'.$carrera->id_carrera.'/'.$mes.'/'.$year ) }}'" >   {{$carrera->nombre}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection