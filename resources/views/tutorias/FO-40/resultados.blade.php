@extends('tutorias.app_tutorias')
@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-info text-white text-center">
                <h3>Resultados de Seguiminto a los Coordinadores de Carrera</h3>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <a  class="btn btn-info" href=" {{url('/tutorias/FO-40/pdf/'.$periodo.'/') }} ">
                    Imprimir
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg">
                <tr>
                    <th>Carrera</th>
                    <th>Nombre</th>
                    <th>{{$datos[0]->res1}}</th>
                    <th>{{$datos[0]->res2}}</th>
                    <th>Comentario</th>
                </tr>
                @foreach ($datos as $dato)
                    <tr>
                        <td>{{$dato->carrera}}</td>
                        <td>{{$dato->nombre}}</td>
                        <th>{{$dato->se1}}</th>
                        <th>{{$dato->se2}}</th>
                        <th>{{$dato->com}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <dic class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg">
                <thead>
                    <th>Calificaciones</th>
                </thead>
                <tbody>
                    <td>Cumplió</td>
                    <td>No cumplió</td>
                    <td>Avance 75%</td>
                    <td>Avance 50%</td>
                    <td>Avance 25%</td>
                </tbody>
            </table>
        </div>
    </dic>
@endsection