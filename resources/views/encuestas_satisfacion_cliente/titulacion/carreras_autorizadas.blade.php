@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
    <?php
    $historial = Session::get('historial_enc_t');
    ?>
    @if($historial == 1)
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion")}}">Historial de  encuestas (TITULACIÓN)</a>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/menu_historial_titulacion_year/".$year)}}">Periodos de las encuestas</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Programas de estudios</span>
            </p>
            <br>
        </div>
    </div>
   @else
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/enviar_encuesta_estudiante_titulacion/")}}">Periodos de las encuestas</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Programas de estudios</span>
            </p>
            <br>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satisfacción del cliente<br> (TITULACIÓN)<br>PROGRAMAS DE ESTUDIO<br>@if($mes == 1) Enero @else Julio  @endif del {{ $year }}</h3>
                </div>
                <div class="panel-body " >
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <table id="tabla_alumnos" class="table table-bordered " Style="background: white;" >
                                <thead>
                                <tr>
                                    <th>ENCUESTAS</th>
                                    <th>TOTAL ESTUDIANTES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>ENCUESTAS CONTESTADAS</td>
                                    <td>{{ $encuestas_autorizadas->contar }}</td>
                                </tr>
                                {{--
                                <tr>
                                    <td>ENCUESTAS NO CONTESTADAS</td>
                                    <td>{{ $encuestas_rechazadas->contar }}</td>
                                </tr>
                                --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <ul class="nav nav-pills nav-stacked" style="background-color:white;border: 2px solid black; border-radius: 7px; padding-right: 0px">
                                @foreach($carreras as $carrera)
                                    <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" href="#" onclick="window.location='{{ url('/encuestas_satisfaccion/enc_est_ti_carrera_termino/'.$carrera->id_carrera.'/'.$mes.'/'.$year ) }}'" >{{$carrera->nombre}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection