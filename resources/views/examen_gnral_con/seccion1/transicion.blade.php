@extends('layouts.app')

@section('content')

<div class="container text-center" style="margin-top: 50px; max-width: 700px;">

    <div class="panel panel-success">

        <div class="panel-heading">
            <h3 style="margin: 0;">
                <i class="glyphicon glyphicon-ok-circle"></i>
                Área concluida
            </h3>
        </div>

        <div class="panel-body" style="padding: 30px;">

            <div class="alert alert-success">
                <h4 style="margin: 0;">
                    Has concluido el área: <strong>{{ $moduloActual->nombre }}</strong>
                </h4>
            </div>

            <hr>

            <h4 style="margin-bottom: 20px;">
                Prepárate para comenzar la siguiente área
            </h4>

            <a href="{{ route('examen_general.seccion.pregunta', [
        'id_seccion' => $id_seccion,
        'page' => $nextPage
    ]) }}"
   class="btn btn-primary btn-lg">
    <i class="glyphicon glyphicon-arrow-right"></i>
    Comenzar siguiente área
</a>

        </div>
    </div>

</div>

@endsection