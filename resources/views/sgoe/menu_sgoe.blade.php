@section('menu')
    <?php
    //   $permiso_noregis=Session::get('personal_noregis');

    //dd(session());
    $personal_noregis = session()->has('personal_noregis') ? session()->has('personal_noregis') : false;
    $palumno = session()->has('palumno') ? session()->has('palumno') : false;
    $alumno_act = session()->has('alumno_act') ? session()->has('alumno_act') : false;
    $profesor_conact = session()->has('profesor_conact') ? session()->has('profesor_conact') : false;
    $profesor_sinact = session()->has('profesor_sinact') ? session()->has('profesor_sinact') : false;
    $jefe_division = session()->has('jefe_division') ? session()->has('jefe_division') : false;
    $directivo = session()->has('directivo') ? session()->has('directivo') : false;
    $consultas = session()->has('consultas') ? session()->has('consultas') : false;
    $sin_permiso = session()->has('sin_permiso') ? session()->has('sin_permiso') : false;
    $desa = session()->has('desa') ? session()->has('desa') : false;
    $ver_eva = session()->has('ver_eva') ? session()->has('ver_eva') : false;
    $ver_carga = session()->has('ver_carga') ? session()->has('ver_carga') : false;
    $verrifica_carga = session()->has('verrifica_carga') ? session()->has('verrifica_carga') : false;
    $escolar = session()->has('escolar') ? session()->has('escolar') : false;
    $jefe_personal = session()->has('personal') ? session()->has('personal') : false;
    $id_unidad_admin = session()->has('id_unidad_admin') ? session()->has('id_unidad_admin') : false;
    $jefe_computo = session()->has('computo') ? session()->has('computo') : false;
    $jefe_residencia = session()->has('residencia') ? session()->has('residencia') : false;
    $profesor_ingles = session()->has('profesor_ingles') ? session()->has('profesor_ingles') : false;
    $personal_academia = session()->has('personal_academia') ? session()->has('personal_academia') : false;
    $revisor = session()->has('revisor') ? session()->has('revisor') : false;
    $seguimiento_alumno = session()->has('seguimiento_alumno') ? session()->has('seguimiento_alumno') : false;
    $seguimiento_asesor = session()->has('seguimiento_asesor') ? session()->has('seguimiento_asesor') : false;
    $departamento_titulacion = session()->has('titulacion') ? session()->has('titulacion') : false;
    $direccion_finanzas = session()->has('finanzas') ? session()->has('finanzas') : false;
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                $unidad = Session::get('id_unidad_admin');
                ;

                ?>
                @if($id_unidad_admin == true)
                    <div class="col-md-2 ">
                        {{--  <span class="badge badge-pill badge-primary" style="background: #c5d2b0; margin: 10px;"><a
                                      href="{{url('/notificaciones/redireccionar/validar')}}">Solicitud de oficios <b
                                          id="solicitud"></b></a></span>
                        --}}
                    </div>
                    @if($unidad==26)


                        <div class="col-md-2 col-md-offset-2">
                            {{--
                            <span class="badge badge-pill badge-primary"
                                  style="background: #b6d2ce; margin: 10px;">  <a>Validacion oficios <b
                                            id="oficios"></b></a></span>
                             --}}

                        </div>



                    @endif
                    @if($unidad==23)


                        <div class="col-md-2 col-md-offset-2">
                            {{--
                            <span class="badge badge-pill badge-primary"
                                  style="background: #b6d2ce; margin: 10px;">  <a>Validacion oficios <b
                                            id="oficiospersonal"></b></a></span>
                             --}}
                        </div>



                    @endif

                @endif

            </div>
            <div class="col-md-6" style="text-align: right;">
                <?php
                $nombre = Session::get('nombre');
                $cambio_c = Session::get('cambio_carreras');
                $carreras = Session::get('carreras');
                $usuario = Session::get('usuario_alumno');
                $nperiodo = Session::get('nombre_periodo');
                ?>
                @if($jefe_division==true || $consultas==true)
                    <?php
                    $nombre_carrera = Session::get('nombre_carrera');
                    $id_carrera = Session::get('id_carrera');
                    ?>
                    <span class="badge badge-pill badge-primary" style="background: #43a1d2; margin: 10px;"><label>{{$nombre}} . {{ $nombre_carrera }} </label> {{ $nperiodo }}</span>
                @else

                    @if($profesor_ingles==true)
                        <?php
                        $nombre_ingles = Session::get('nombre_ingles');
                        $nombre_periodo_ingles = Session::get('nombre_periodo_ingles');
                        ?>

                        <span class="badge badge-pill badge-primary"
                              style="background: #43a1d2; margin: 10px;">  <label>{{$nombre_ingles}}  </label>  {{ $nombre_periodo_ingles }}</span>

                    @else
                        <span class="badge badge-pill badge-primary"
                              style="background: #43a1d2; margin: 10px;"> <label>{{$nombre}}  </label> {{ $nperiodo }}</span>
                    @endif
                @endif
            </div>
        </div>
        <div class="row ">
            <div class="">
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="navbar-header">
                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->

                    </div>

                    <div class="collapse navbar-collapse " id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>



                    <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-left ">
                            <!-- Authentication Links -->

                            <li class="dropdown bloqueo">
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Salir
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>






                            <ul class="nav navbar-nav navbar-left">
                                <li class="dropdown">
                               <a href="{{url('/sgoe/documentacion')}}">Documentación</a>
                                </li>
                            </ul>










                    </div>


                </nav>
            </div>
        </div>
    </div>
    {{--modificar actividad--}}
    <div class="modal fade" id="modal_modificar_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form" action="" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Modificar periodo</h4>
                    </div>
                    <div id="contenedor_modificar_periodo">


                    </div>

                    <div class="modal-footer">
                    </div>
                </form>
            </div>

        </div>
    </div>
    {{--fin modificar actividad--}}
    <script type="text/javascript">
        function cargar() {
            $("#oficios").empty();
            $.get("/mostrar_validacion", function (request) {
                $('#oficios').append("<span class='badge'><b>" + request.ofs + "</b></span>");
            });
        }

        function cargarpersonal() {
            $("#oficiospersonal").empty();
            $.get("/mostrar_validacion_personal", function (request) {
                $('#oficiospersonal').append("<span class='badge'><b>" + request.ofp + "</b></span>");
            });
        }
        /*
              function notificacionesof() {
                  $("#solicitud").empty();
                  $.get("/notificaciones/oficios", function (request) {
                      $('#solicitud').append("<span class='badge'><b>" + request.ofsl + "</b></span>");
                  });
              }
              */


        $(document).ready(function () {
            $(".periodo_ingles").click(function (event) {
                var periodo_ing = $(this).attr('id');
                $.get("/profesores_ingles/periodos/" + periodo_ing, function (request) {
                    $("#contenedor_modificar_periodo").html(request);
                    $("#modal_modificar_periodo").modal('show');
                });

            });
            $(".link").tooltip({html: true});
            /*
            var img = "<?php  echo $unidad;?>";
          if (img == 26) {

              $.get("/mostrar_validacion", function (request) {
                  $('#oficios').append("<span class='badge'><b>" + request.ofs + "</b></span>");
              });
              setInterval(cargar, 30000);
          }
          if (img == 23) {

              $.get("/mostrar_validacion_personal", function (request) {
                  $('#oficiospersonal').append("<span class='badge'><b>" + request.ofp + "</b></span>");
              });
              setInterval(cargarpersonal, 30000);
          }
          */
            /*var unidadades = "<?php  echo $id_unidad_admin;?>";
          if (unidadades == true) {
              $.get("/notificaciones/oficios", function (request) {
                  $('#solicitud').append("<span class='badge'><b>" + request.ofsl + "</b></span>");
              });
              setInterval(notificacionesof, 30000);
          }
          */
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.test').on("click", function(e){
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
        });
    </script>
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
    </style>
@endsection
