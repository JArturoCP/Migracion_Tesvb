@extends('layouts.app')
@section('title', 'Estadisticas de Indice de reprobación')
@section('content')
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/servicios_escolares/estadisticas/indice_reprobacion/".$id_carrera)}}">Semestres</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>indice de reprobacion del semestre</span>

            </p>
            <br>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;">INDICE DE REPROBACIÓN <br> {{ $carreras->nombre }}</div>

            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-8 col-md-offset-2">
@foreach($ind_rep as$carrera)
    <div class="panel panel-info" style="margin :5px 0px">
            <div class="panel-body">
                <div class="col-md-12">
                    @foreach($carrera['semestres'] as $semestre)
                        @if($semestre['materias']!=null)
                            <h4><label for="" class="col-md-12 text-center label label-success">SEMESTRE: {{$semestre['nom_semestre']}}</label></h4>
                            <table class="table table-striped text-center my-0 border-table">
                                <thead>
                                <tr class="text-center">
                                    <th class="text-center">Materia</th>
                                    <th class="text-center">Docente</th>
                                    <th class="text-center">Grupo</th>
                                    <th class="text-center">Matricula</th>
                                    <th class="text-center">Promedio</th>
                                    <th class="text-center">Reprobados</th>
                                    <th class="text-center">Índice de reprobación</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($semestre['materias'] as $materia)
                                    <tr class="">
                                        <td>{{ $materia['mat'] }}</td>
                                        <td>{{ $materia['docente'] }}</td>
                                        <td>{{ $materia['grupo'] }}</td>
                                        <td>{{ $materia['matricula'] }}</td>
                                        <td>{{ $materia['promedio'] }}</td>
                                        <td>{{ $materia['reprobados'] }}</td>
                                        <td>{{ $materia['ind_rep'] }}%</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else

                        @endif
                    @endforeach
            </div>
        </div>
    </div>
@endforeach
        </div>
    </div>
@endsection