@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

    <div class="container" style="margin-top:30px;">

        <div class="row">

            <div class="col-md-3">
                <a href="{{ route('admin.egel.resultados') }}" 
                class="btn btn-primary btn-lg btn-block">
                <span class="glyphicon glyphicon-stats"></span><br>
                Ver Resultados EGEL
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('admin.egel.alumno') }}" 
                class="btn btn-success btn-lg btn-block">
                <span class="glyphicon glyphicon-user"></span><br>
                Lista de Alumnos
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('admin.examenes.index') }}" 
                class="btn btn-warning btn-lg btn-block">
                <span class="glyphicon glyphicon-file"></span><br>
                Administrar Exámenes
                </a>
            </div>

            <!-- ✅ NUEVO BOTÓN -->
            <div class="col-md-3">
                <a href="{{ route('admin.periodos.index') }}" 
                class="btn btn-info btn-lg btn-block">
                <span class="glyphicon glyphicon-calendar"></span><br>
                Configurar Periodos
                </a>
            </div>

        </div>

        <br>
        <br>

    </div>

    @endsection