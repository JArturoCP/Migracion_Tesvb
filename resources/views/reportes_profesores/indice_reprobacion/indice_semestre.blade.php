@extends('layouts.app')
@section('title', 'Indice de reprobación')
@section('content')

    <div class="row">
        <div class="col-md-6 col-xs-10 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Indice de Reprobación {{ $carreras->nombre }}<br> (Semestres) </h3>
                </div>
                <div class="panel-body " style="text-align: center">
                    @if($semestres!=null)
                        <div class="col-md-5 col-md-offset-3">
                            <ul class="nav nav-pills nav-stacked" style="background-color:white;border: 2px solid black; border-radius: 7px; padding-right: 0px">
                                @foreach($semestres as $semestre)
                                    <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" href="#" onclick="window.location='{{ url('/indices_repro_prof/carrrera_sem_prof/'.$carreras->id_carrera.'/'.$semestre->id_semestre ) }}'" > {{$semestre->descripcion}}</a></li>

                                @endforeach
                            </ul>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection