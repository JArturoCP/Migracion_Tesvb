@extends('layouts.app')
@section('title', 'Seguimiento de actividades')
@section('content')
    <?php
    $unidad = Session::get('id_unidad_admin');
    $jefe_residencia = session()->has('residencia') ? session()->has('residencia') : false;
    ?>


    <main class="col-md-12">
        @if($unidad == 26 || $unidad == 20 )
            <div class="row">
                <div class="col-md-2 " style="text-align: center;">
                    <a href="{{url('/residencia/carreras_proyectos')}}"><span class="glyphicon glyphicon-arrow-left" style="font-size:15px;color:#363636"></span><br>Regresar</a>
                </div>

            </div>
        @else
            <div class="row">

                <div class="col-md-2 " style="text-align: center;">
                    <a    href="{{url('/residentes/carrera')}}"><span class="glyphicon glyphicon-arrow-left" style="font-size:15px;color:#363636"></span><br>Regresar</a>
                </div>

            </div>
        @endif
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                @if($terminado_proyecto == 1)
                    @if($promedio_final==0)
                        <button type="button" class="btn btn-primary evaluacion" id="{{{ $id_anteproyecto }}}" title="Enviar" disabled>Evaluación de residencia</button>
                    @else

                        <div class="panel panel-default">
                            <div class="panel-heading text-center" >
                                <?php $promedio_residencia=round($promedio_residencia); ?>

                                @if($promedio_residencia < 70)
                                    <button type="button" class="btn btn-danger btn-lg">  <h5 size="">{{  $promedio_residencia }}</h5>   </button>

                                @else
                                    <button type="button" class="btn btn-success btn-lg">  <h5 size="">{{ $promedio_residencia }}</h5>   </button>

                                @endif
                                <br>
                                <b>Promedio Residencia</b>
                                <br>
                            </div>
                        </div>
                    @endif

                @endif
            </div>
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><b>Seguimiento de actividades  <br> {{ $nombre_alumno }}</b></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2 " id="imprimir" style="display: block;">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" >
                        <?php $promedio=round($promedio); ?>

                        @if($promedio < 70)
                            <button type="button" class="btn btn-danger btn-lg">  <h5 size="">{{  $promedio }}</h5>   </button>

                        @else
                            <button type="button" class="btn btn-success btn-lg">  <h5 size="">{{  $promedio }}</h5>   </button>

                        @endif
                        <br>
                        <b>Promedio Final</b>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        @foreach($semanas as $semana)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <b>Semana</b> {{$semana['no_semana']}}
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                    <?php  $fecha_inicial=date("d-m-Y",strtotime($semana['f_inicio'])); ?>
                                    <?php  $fecha_final=date("d-m-Y",strtotime($semana['f_termino'])); ?>
                                    Del {{$fecha_inicial}} al  {{$fecha_final}}
                                </div>
                                @if($semana['estatus'] == 1)
                                    <div class="col-md-2 col-md-offset-1">
                                        @if($semana['promedio'] < 70 )
                                            <button type="button" class="btn btn-danger">
                                                N. A.
                                            </button>
                                            @if($jefe_residencia == true)
                                                <button type="button"
                                                        class="btn btn-warning editar-calificacion"
                                                        data-id="{{ $semana['id_cronograma'] }}"
                                                        data-promedio="{{ $semana['promedio'] }}">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </button>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-success">
                                                {{$semana['promedio']}}
                                            </button>
                                            @if($jefe_residencia == true)
                                                <button type="button"
                                                        class="btn btn-warning editar-calificacion"
                                                        data-id="{{ $semana['id_cronograma'] }}"
                                                        data-promedio="{{ $semana['promedio'] }}">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                @elseif($semana['estatus'] == 2)
                                    <div class="col-md-2 col-md-offset-1">
                                        <button type="button" class="btn btn-primary calificar" id="{{ $semana['id_cronograma'] }}" disabled>Calificar</button>
                                    </div>
                                @elseif($semana['estatus'] == 3)
                                    <div class="col-md-2 col-md-offset-1">
                                        <button type="button" class="btn btn-primary calificar" disabled >Calificar</button>

                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <b>Actividad(es):</b>  {{$semana['actividad']}}
                        </div>
                    </div>
                </div>

            </div>

            <br>

        @endforeach
        <br>
    </main>


    <div class="modal fade" id="modal_calificar_actividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Calificar actividad <br>  {{ $nombre_alumno }}</h4>
                </div>
                <div id="contenedor_calificar_actividad"></div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="modal_modificar_asesores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Modificar Asesor</h4>
                </div>
                <div id="contenedor_modificar_asesores"></div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="modal_formato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Calificar residencia <br>  {{ $nombre_alumno }}</h4>
                </div>
                <div id="contenedor_formato"></div>
            </div>

        </div>
    </div>




    <div class="modal fade" id="modal_editar_calificacion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center">Editar Calificación</h4>
                </div>

                <div class="modal-body">
                    <form id="formEditarCalificacion">
                        <input type="hidden" id="idSemana">
                        <div class="form-group">
                            <label for="nuevaCalificacion">Nueva calificación:</label>
                            <input type="number" id="nuevaCalificacion" class="form-control" min="0" max="100" required>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardarNuevaCalificacion">Guardar</button>
                </div>

            </div>
        </div>
    </div>



    <script type="text/javascript">

        $(document).ready(function() {

            $(".calificar").click(function(){
                var id_cronograma=$(this).attr("id");
                $.get("/residencia/calificar_anteproyecto/"+id_cronograma,function(request){
                    $("#contenedor_calificar_actividad").html(request);
                    $("#modal_calificar_actividad").modal('show');

                });
            });
            $(".modificar").click(function(){
                var id_anteproyecto=$(this).data("id");
                $.get("/residencia/modificar_asesores_anteproyecto/"+id_anteproyecto,function(request){
                    $("#contenedor_modificar_asesores").html(request);
                    $("#modal_modificar_asesores").modal('show');

                });

            });
            $(".evaluacion").click(function(){
                var id_anteproyecto=$(this).attr("id");
                $.get("/residencia/formato_evaluacion_residencia/"+id_anteproyecto,function(request){
                    $("#contenedor_formato").html(request);
                    $("#modal_formato").modal('show');

                });


            });
            // Abrir el modal y cargar los datos
            $(".editar-calificacion").click(function() {
                var id = $(this).data("id");
                var promedio = $(this).data("promedio");

                $("#idSemana").val(id);
                $("#nuevaCalificacion").val(promedio);
                $("#modal_editar_calificacion").modal("show");
            });

            // Guardar nueva calificación vía AJAX
            $("#guardarNuevaCalificacion").click(function() {
                var id = $("#idSemana").val();
                var nuevaCalificacion = $("#nuevaCalificacion").val();

                $.ajax({
                    url: "/residencia/actualizar_calificacion/" + id,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        calificacion: nuevaCalificacion
                    },
                    success: function() {
                        $("#modal_editar_calificacion").modal("hide");
                        location.reload();
                    }
                });
            });


        });
    </script>
@endsection