@extends('layouts.app')
@section('title', 'Certificado de Acreditación')
@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">CARRERA: {{$carrera->nombre}}  </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/titulacion/ver_certificado_ingles_carrera")}}">Programas de Estudios</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Estudiantes </span>

            </p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Estudiantes de la carrera  </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="tabla_alumnos" class="table table-bordered " Style="background: white;" >
                        <thead>
                        <tr>
                            <th>NO. CUENTA</th>
                            <th>NOMBRE DEL ALUMNO</th>
                            <th>ESTADO DEL ESTUDIANTE</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($array_alumnos as $alumno)
                            <tr>
                                <td>{{$alumno['cuenta'] }} </td>
                                <td>{{$alumno['nombre'] }} </td>
                                @if($alumno['estado_certificado'] == 0 )
                                    <td>No tiene registrado su certificado de ingles</td>
                                @else
                                    <td style="background: #3f9ae5">Certificado registrado</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">



        $(document).ready(function() {
            $('#tabla_alumnos').DataTable();
        } );

    </script>



@endsection