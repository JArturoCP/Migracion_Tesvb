@extends('layouts.app')
@section('title', 'Encuestas Residencia')
@section('content')
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/agregar_periodo_year_residencia/")}}">Inicio de encuestas</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Programas de Estudios</span>


            </p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satisfacción del cliente (Residencia Profesional)<br>(PROGRAMAS DE ESTUDIO) </h3>
                </div>
                <div class="panel-body " >
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-pills nav-stacked" style="background-color:white;border: 2px solid black; border-radius: 7px; padding-right: 0px">
                            @foreach($carreras as $carrera)
                                <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" href="#" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_encuesta_residencia_alumno/'.$carrera->id_carrera ) }}'" > {{$carrera->nombre}}</a></li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection