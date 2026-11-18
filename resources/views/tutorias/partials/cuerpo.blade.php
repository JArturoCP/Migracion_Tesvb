{{-- Cuerpo del layout de Tutorías (antes en tutorias/app_tutorias.blade.php L71-268): menú interno, avisos, modal de periodos,
     @yield('content') y pie institucional. Se muestra igual con y sin el marco del panel. --}}

<div id="app" class="container">
    @if(Session::get('nombre'))
        <div class="row">
            <div class="col-12 text-right ">
                <h5> <span class="badge badge-primary">{{ Session::get('nombre')}}    Periodo: {{ Session::get('nombre_periodo')}} </span></h5>
            </div>
        </div>
    @endif
    @if(Session::has('tutor_asignado'))
        <div class="row">
            <div class="col-12 text-right ">
                <h5> <span class="badge badge-info">Tutor {{ Session::get('tutor_asignado')}}     {{ Session::get('generacion_asignada')}} </span></h5>
            </div>
        </div>
    @endif
    <nav class="navbar navbar-expand-md navbar-light shadow-sm subm bg-white">
        <div class="container" >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="active left"><a href="{{url('/')}}" title="Regresar al sistema academico"> <i class="fa fa-arrow-alt-circle-left" style="font-size:25px;color:#d2cd21;margin: 5px"></i> </a></li>

                    @if (Session::has('tutor_asignado'))

                        <li class="nav-item">
                            <a class="nav-link" href="/tutorias/inicioalu">Expediente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href=/tutorias/actividad>Actividades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href=/tutorias/calendario>Calendario de Actividades</a>
                        </li>
                        @if(Session::get('estado_eva') == true)
                            <li>
                                <a class="nav-link text-dark" href="/tutoras_evaluacion/evaluacion_al_tutor/">Evaluación al Tutor</a>
                            </li>
                        @endif

                    @else

                        @guest

                        @else
                            @if (Session::get('jefe'))
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn border-0" type="button" id="MenuJefe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tutorías
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="MenuJefe">
                                        <a class="dropdown-item" href="/tutorias/jefevista">Tutores y Coordinador</a>
                                        <a class="dropdown-item" href="/tutorias/asignacovista">Asigna Coordinador</a>
                                        <a class="dropdown-item" href="/tutorias/asignatuvista">Asigna Tutor</a>
                                        <a class="dropdown-item" href="/tutorias/alumnos">Estudiantes</a>
                                        <a class="dropdown-item" href="/tutoras_evaluacion/resultado_tutorias_jefe/carreras">Evaluación al Tutor</a>

                                    </div>
                                </div>
                            @endif
                            @if (Session::get('tutor'))
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn border-0" type="button" id="MenuTutor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tutorías
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="MenuTutor">
                                        <a class="dropdown-item" href="/tutorias/tutorvista">{{\Illuminate\Support\Facades\Session::get('tutor')>1?'Grupos Tutorías':'Grupo Tutorías'}}</a>
                                        <!--<a class="dropdown-item" href="/eventos">Eventos</a>-->
                                        <a class="dropdown-item" href="/tutorias/seguimiento">Seguimiento</a>
                                        <a class="dropdown-item" href="/tutorias/desercion">Deserción</a>
                                        <a class="dropdown-item" href="/tutorias/repsemestral">Reporte Semestral</a>
                                        <a class="dropdown-item" href="/tutoras_evaluacion/resultado_tutorias/">Evaluación al tutor</a>
                                        @if(Session::get('estado_eva') == false)
                                            <a class="dropdown-item" href="/tutoras_evaluacion/auto_eveluacion/">Cuestionario al tutor</a>
                                    @endif
                                    {{--
                                    <a class="dropdown-item" href="/tutorias/formulario/">Encuesta</a>
                                    <a class="dropdown-item" href="/tutorias/buscador/grupo/0">Buscador</a>
                                    --}}
                                    <!--<a class="dropdown-item" href="/planeaciontutor">Planeación</a>-->
                                    </div>
                                </div>
                            @endif
                            @if (Session::get('coordinador'))
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn border-0" type="button" id="MenuCoordinador" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Coordinador
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="MenuCoordinador">
                                        <a class="dropdown-item" href="/tutorias/carreras">{{ \Illuminate\Support\Facades\Session::get('coordinador')>1 ? 'Programas educativos':'Programa educativo' }}</a>
                                        <!--<a class="dropdown-item" href="/coordina_carrera">Planeación</a>-->
                                        <a class="dropdown-item" href="/tutoras_evaluacion/resultado_tutorias_jefe/carreras">Evaluación al Tutor</a>
                                        <a class="dropdown-item" href="/tutorias/reportecoordinador/repsemestralcarrera">Reporte Semestral</a>

                                    </div>
                                </div>
                            @endif
                            @if (Session::get('coordinadorgeneral'))
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn border-0" type="button" id="MenuCoordinador" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Coordinador Institucional
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="MenuCoordinadorGeneral">
                                        <a class="dropdown-item" href="/tutorias/planeacioncoorgen">Planeación</a>
                                        {{-- <a class="dropdown-item" href="/tutorias/revision">Revisar Sugerencias</a>--}}
                                        <a class="dropdown-item" href="/tutorias/estadisticas/carreras">Programas educativos</a>
                                        <a class="dropdown-item" href="/tutoras_evaluacion/resultado_tutorias_cordinador/">Evaluación al tutor</a>
                                        <a class="dropdown-item" href="/tutorias/reporteinstitucional/repsemestral_ins">Reporte Semestral</a>
                                        <a class="dropdown-item" href="/tutorias/FO-40/">Seguimiento a Coordinadores</a>
                                        <a class="dropdown-item" href="/tutorias/analisis/">Análisis de tutores</a>
                                        <a class="dropdown-item" href="/tutorias/formulario/" >Buscador</a>
                                    </div>
                                </div>
                            @endif
                            @if (Session::get('desarrollo'))
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn border-0" type="button" id="MenuCoordinador" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Desarrollo Académico
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="MenuDesarrollo">
                                        <a class="dropdown-item" href="/tutorias/desarrollovista">Coordinador Institucional</a>
                                        <a class="dropdown-item" href="/tutorias/asignacorgenvista">Asigna Coordinador Institucional</a>
                                        <a class="dropdown-item" href="/tutorias/planeaciondesarrollo">Planeación</a>
                                        {{-- <a class="dropdown-item" href="/tutorias/revisiondesarrollo">Ver Sugerencias</a>--}}
                                        <a class="dropdown-item" href="/tutorias/estadisticas/carreras">Programas educativos</a>
                                        <a class="dropdown-item" href="/tutoras_evaluacion/resultado_tutorias_cordinador/">Evaluación al Tutor</a>
                                        <a class="dropdown-item" href="/tutorias/evaluacion_tutor/estado/">Activacion de Evaluacion al Tutor</a>
                                        <a class="dropdown-item" href="/tutorias/FO-40/">Seguimiento a Coordinadores</a>
                                        <a class="dropdown-item" href="/tutorias/formulario/" >Buscador</a>
                                    </div>
                                </div>

                            @endif

                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" id="periodo" href="#" title="periodos">  <i class="fa fa-calendar" style="font-size:25px;color:#b7432e"></i></a>
                        </li>
                    @endif



                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                           class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                            Salir
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>


            </div>
        </div>
    </nav>
    @section('part_modal_periodos')
        @if (!Auth::guest())
            @include('partials.periodos')
        @endif
    @show
    <main class="py-4">
        <div class="container">

            @yield('content')
        </div>
    </main>
</div>
<br>
<footer class="colorfooter col-12 footer-responsive" style="text-align: center">
    <div class="row">
        <div class=" col-md-12" style="text-align: center">
            Tecnológico de Estudios Superiores Valle de Bravo
            Gobierno Del Estado De México
        </div>
    </div>
    <div class="row">
        <div class=" col-md-12" style="text-align: center">
            Km. 30 de la Carretera Federal Monumento-Valle de Bravo Ejido de San Antonio de la Laguna Valle de Bravo C.P 51200
        </div>
    </div>
    <div class="row">
        <div class=" col-md-12" style="text-align: center">
            Algunos Derechos Reservados 2011 Gobierno del Estado de México | <strong>Dudas y comentarios Webmaster</strong>
        </div>
    </div>
</footer>
