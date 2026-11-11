@extends('tutorias.app_tutorias')
@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-info text-white text-center">
                <h4 >Evaluación del tutor</h4>

            </div>

        </div>
    </div>
    <div class="row">
        <p><br></p>
    </div>

    <div class="row">
        @foreach($cordinador_carrera as $cordinador_carrera)
        <div class="col-5 offset-1">
            <div class="card text-black text-center">
                <br>
                <h4 >Carrera: {{ $cordinador_carrera->nombre }}</h4>
                <br>
                <a  class="btn btn-success" href="{{url('/tutoras_evaluacion/resultado_tutorias_jefe/'.$cordinador_carrera->id_asigna_coordinador.' ')}}">ver</a>
            </div>

        </div>
        @endforeach
    </div>


@endsection