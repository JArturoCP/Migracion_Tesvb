@extends('layouts.app')
@section('title', 'Titulacion')
@section('content')
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/titulacion/liberacion_titulado_carrera")}}">Programas de Estudios</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Estudiantes de Titulación </span>

            </p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Ver titulados liberados <br> (CARRERA: {{$carrera->nombre}})  </h3>
                </div>
            </div>
        </div>
    </div>


            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table id="tabla_alumnos" class="table table-bordered " Style="background: white;" >
                        <thead>
                        <tr>
                            <th style="text-align: center">NO. CUENTA</th>
                            <th style="text-align: center">NOMBRE DEL ALUMNO</th>
                            <th style="text-align: center">ACCIÓN</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($alumnos as $alumno)
                            <tr>
                                <td style="text-align: center">{{$alumno->no_cuenta }} </td>
                                <td style="text-align: center">{{$alumno->nombre_al }} {{ $alumno->apaterno }}  {{ $alumno->amaterno }}</td>
                                <td style="text-align: center"><button type="button" class="btn btn-success" onclick="window.location='{{ url('/titulacion/ver_datos_titulado/'.$alumno->id_alumno ) }}'">Ver Datos de la titulación</button></td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>

    <script>
        $(document).ready(function() {
            $('#tabla_alumnos').DataTable();
        });
    </script>

@endsection