@extends('tutorias.app_tutorias')
@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-danger text-white text-center">
                <h3>Análisis</h3>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Mejores Tutores</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 11px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Gestion</th>
                    <th>Actitud</th>
                    <th>Disponibilidad</th>
                    <th>Servicios</th>
                    <th>Logros</th>
                    <th>Promedio de Evaluacion</th>
                    <th>Promedio de Autoevaluacion</th>
                </tr>
                @foreach ($top_tutores as $top_tutor)
                    <tr>
                        <td>{{$top_tutor->nombre}}</td>
                        <td>{{$top_tutor->sexo}}</td>
                        <th>{{$top_tutor->descripcion}}</th>
                        <th>{{$top_tutor->escolaridad}}</th>
                        <th>{{$top_tutor->antiguiedad}}</th>

                        <th>{{$top_tutor->gestion}}</th>
                        <th>{{$top_tutor->actitud}}</th>
                        <th>{{$top_tutor->disponibilidad_confianza}}</th>
                        <th>{{$top_tutor->servicios_del_programa_de_tutoria}}</th>
                        <th>{{$top_tutor->tus_logros_y_avances}}</th>
                        <th>{{$top_tutor->promedio}}</th>

                        <th>{{$top_tutor->promedio_autoEva}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Tutores con deficiencias</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 11px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Gestion</th>
                    <th>Actitud</th>
                    <th>Disponibilidad</th>
                    <th>Servicios</th>
                    <th>Logros</th>
                    <th>Promedio de Evaluacion</th>
                    <th>Promedio de Autoevaluacion</th>
                </tr>
                @foreach ($menos_tutores as $menos_tutor)
                    <tr>
                        <td>{{$menos_tutor->nombre}}</td>
                        <td>{{$menos_tutor->sexo}}</td>
                        <th>{{$menos_tutor->descripcion}}</th>
                        <th>{{$menos_tutor->escolaridad}}</th>
                        <th>{{$menos_tutor->antiguiedad}}</th>

                        <th>{{$menos_tutor->gestion}}</th>
                        <th>{{$menos_tutor->actitud}}</th>
                        <th>{{$menos_tutor->disponibilidad_confianza}}</th>
                        <th>{{$menos_tutor->servicios_del_programa_de_tutoria}}</th>
                        <th>{{$menos_tutor->tus_logros_y_avances}}</th>
                        <th>{{$menos_tutor->promedio}}</th>

                        <th>{{$menos_tutor->promedio_autoEva}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Tutores con deficiencias en Percepción respecto a tu tutor(a) en la Gestión</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 12px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Gestion</th>
                </tr>
                @foreach ($gestion as $ges)
                    <tr>
                        <td>{{$ges->nombre}}</td>
                        <td>{{$ges->sexo}}</td>
                        <th>{{$ges->descripcion}}</th>
                        <th>{{$ges->escolaridad}}</th>
                        <th>{{$ges->antiguiedad}}</th>

                        <th>{{$ges->gestion}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Tutores con deficiencias en Percepción respecto a tu tutor(a) en la Actitud</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 12px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Actitud</th>
                </tr>
                @foreach ($actitud as $act)
                    <tr>
                        <td>{{$act->nombre}}</td>
                        <td>{{$act->sexo}}</td>
                        <th>{{$act->descripcion}}</th>
                        <th>{{$act->escolaridad}}</th>
                        <th>{{$act->antiguiedad}}</th>
                        <th>{{$act->actitud}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Tutores con deficiencias en Percepción respecto a tu tutor(a) en la disponibilidad y confianza</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 12px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Actitud</th>
                </tr>
                @foreach ($disponivilidad as $dis)
                    <tr>
                        <td>{{$dis->nombre}}</td>
                        <td>{{$dis->sexo}}</td>
                        <th>{{$dis->descripcion}}</th>
                        <th>{{$dis->escolaridad}}</th>
                        <th>{{$dis->antiguiedad}}</th>
                        <th>{{$dis->disponibilidad_confianza}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Tutores con deficiencias en Percepción respecto a los servicios del programa de Tutoría</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 12px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Actitud</th>
                </tr>
                @foreach ($servicios_del_programa_de_tutoria as $ser)
                    <tr>
                        <td>{{$ser->nombre}}</td>
                        <td>{{$ser->sexo}}</td>
                        <th>{{$ser->descripcion}}</th>
                        <th>{{$ser->escolaridad}}</th>
                        <th>{{$ser->antiguiedad}}</th>
                        <th>{{$ser->servicios_del_programa_de_tutoria}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-secondary text-white text-center">
                <h4>Tutores con deficiencias en Percepción respecto a tus logros y avances</h4>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-responsive-lg" style="font-size: 12px">
                <tr>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Carrera Estudiada</th>
                    <th>Grado Academico</th>
                    <th>Antiguedad</th>
                    <th>Actitud</th>
                </tr>
                @foreach ($logros as $log)
                    <tr>
                        <td>{{$log->nombre}}</td>
                        <td>{{$log->sexo}}</td>
                        <th>{{$log->descripcion}}</th>
                        <th>{{$log->escolaridad}}</th>
                        <th>{{$log->antiguiedad}}</th>
                        <th>{{$log->tus_logros_y_avances}}</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
