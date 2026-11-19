@extends('layouts.app')
@section('title', 'Mi horario')
@section('content')
<main class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading"><h1 class="panel-title">Mi horario</h1></div>
        <div class="panel-body">
            @if(!$alumno)
                <div class="alert alert-warning">Tu cuenta aún no tiene un registro de estudiante asociado. Solicita su revisión en Servicios Escolares.</div>
            @elseif(!$periodo)
                <div class="alert alert-info">No hay un periodo escolar vigente para consultar tu horario.</div>
            @else
                <p><strong>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</strong> · {{ $alumno->cuenta }}</p>
                <p>{{ $carrera }} · {{ $periodo->periodo }}</p>
                <p>Clases correspondientes a las materias y grupos registrados en tu carga académica.</p>
                @if(empty($tabla))
                    <div class="alert alert-info">Aún no hay clases programadas para tu carga académica en este periodo.</div>
                @else
                    @include('alumnos.partials.horario-cuadricula')
                @endif
                @if($pendientes->isNotEmpty())
                    <div class="alert alert-warning">
                        <strong>Materias de tu carga sin horario registrado:</strong>
                        <ul>@foreach($pendientes as $materia)<li>{{ $materia->nombre }} · Grupo {{ $materia->grupo }}</li>@endforeach</ul>
                    </div>
                @endif
            @endif
        </div>
    </div>
</main>
@endsection
