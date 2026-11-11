@extends('layouts.app')
@section('title', 'Gestión Académica')
@section('content')
<div class="row">
    <div class="col-md-10 col-xs-10 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">GESTIÓN ACADÉMCIA DE ALUMNOS DUALES</h3>
                <h5 class="panel-title text-center">(DOCENTES)</h5>
            </div>
        </div>
    </div>
</div>

@if($docentes->isEmpty())
        <div class="row">
            <div class="col-md-8 col-xs-10 col-md-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">No Hay Mentores Duales Asignados en esta Carrera</h3>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8 col-xs-10 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Mentores Duales de la Carrera <br>{{$nombre_carrera}}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <table id="paginar_table" class="table table-bordered " style="text-align: center">
                <thead>
                <tr class="info">
                    <th style="text-align: center"><strong>Nombre del Docente</strong></th>
                    <th style="text-align: center"><strong>Ver Estudiantes Asignados</strong></th>
                </tr>
                </thead>
                <tbody>
                @foreach($docentes as $docente)
                    <tr>
                        <td>{{$docente->titulo." ".$docente->profesor}}</td>
                        <td>
                            <a href="{{url('/duales/gestion_academica/alumnos/'.$docente->id_personal)}}">
                                <span class="glyphicon glyphicon-user" style="color: crimson"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready( function()
    {
        $('#paginar_table').DataTable();
    });
</script>
@endsection