@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 60px; max-width: 600px;">

    <div class="panel panel-success text-center">
        
        <div class="panel-heading">
            <h3 style="margin: 0;">
                <i class="glyphicon glyphicon-ok-circle"></i>
                Sección {{ $id_seccion }} finalizada
            </h3>
        </div>

        <div class="panel-body" style="padding: 30px;">

            <h4 class="text-success" style="margin-bottom: 20px;">
                Has completado correctamente la sección del examen.
            </h4>

            <p style="font-size: 15px;">
                Tus respuestas han sido registradas correctamente.
            </p>

            <hr>

            <a href="{{ url('/examen_conocimientos') }}" class="btn btn-primary btn-lg">
                <i class="glyphicon glyphicon-home"></i>
                Regresar al menú principal
            </a>

        </div>
    </div>

</div>

@endsection