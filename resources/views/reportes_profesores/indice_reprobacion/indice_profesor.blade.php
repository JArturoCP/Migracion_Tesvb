@extends('layouts.app')
@section('title', 'Indice de reprobación')
@section('content')
<div class="row">
    <div class="col-md-8  col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Indices de Reprobación<br>{{ $carrera->nombre }}<br>Semestre: <b>{{ $semestre->descripcion }}</b></h3>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                    <ul class="nav nav-pills nav-stacked" style="background-color:white;border: 2px solid black; border-radius: 7px; padding-right: 0px">
                        @foreach($docentes as $docente)
                            <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" onclick="window.location='{{ url('/indices_repro_prof/carrrera_sem_prof_grup/'.$carrera->id_carrera.'/'.$semestre->id_semestre.'/'.$docente->id_personal.'/' ) }}'" href="" >{{  $docente->nombrepro }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection