@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Desactivación de grupos')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Desactivación de grupos<br>(Agregar estudiantes al grupo)</h3>
                    </div>
                </div>
            </div>
        </div>
        @if($estado == 0)
        <div class="row">
            <div class="col-md-3 col-md-offset-2">
                <div class="form-group">
                    <div class="dropdown">
                        <label for="laboratorio">Carreras</label>
                        <select name="id_carrera" id="id_carrera" class="form-control " >
                            <option  disabled selected hidden>Selecciona Carreras</option>
                            @foreach($carreras as $carrera)

                                <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>

                            @endforeach
                        </select>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div class="dropdown">
                        <label for="laboratorio">Semestres</label>
                        <select name="id_semestre" id="id_semestre" class="form-control " >
                            <option  disabled selected hidden>Selecciona Semestre</option>
                            @foreach($semestres as $semestre)

                                <option value="{{$semestre->id_semestre}}" >{{$semestre->descripcion}}</option>

                            @endforeach
                        </select>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div class="dropdown">
                        <label for="laboratorio">Grupos</label>
                        <select name="id_grupos" id="id_grupos" class="form-control " >
                            <option  disabled selected hidden>Selecciona Grupos</option>
                            @foreach($grupos as $grupo)

                                <option value="{{$grupo->id_grupo}}" >{{$grupo->id_grupo}}</option>

                            @endforeach
                        </select>
                        <br>
                    </div>
                </div>
            </div>

            <div class="col-md-1">
                <br>
                <button id="guardar_solicitud" class="btn btn-info">Mostrar</button>
            </div>



        </div>

        <br>
        <br>
        @else
            <div class="row">
                <div class="col-md-3 col-md-offset-2">
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="laboratorio">Carreras</label>
                            <select name="id_carrera" id="id_carrera" class="form-control " >
                                <option  disabled selected hidden>Selecciona Carreras</option>
                                @foreach($carreras as $carrera)
                                    @if($carrera->id_carrera == $id_carrera)
                                        <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                    @else
                                        <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                    @endif

                                @endforeach
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="laboratorio">Semestres</label>
                            <select name="id_semestre" id="id_semestre" class="form-control " >
                                <option  disabled selected hidden>Selecciona Semestre</option>
                                @foreach($semestres as $semestre)
                                    @if($semestre->id_semestre == $id_semestre)
                                        <option value="{{$semestre->id_semestre}}" selected="selected">{{$semestre->descripcion}}</option>
                                    @else
                                        <option value="{{$semestre->id_semestre}}" >{{$semestre->descripcion}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="laboratorio">Grupos</label>
                            <select name="id_grupos" id="id_grupos" class="form-control " >
                                <option  disabled selected hidden>Selecciona Grupos</option>
                                @foreach($grupos as $grupo)
                                    @if($grupo->id_grupo == $id_grupos_carrera)
                                        <option value="{{$grupo->id_grupo}}" selected="selected">{{$grupo->id_grupo}}</option>
                                    @else
                                        <option value="{{$grupo->id_grupo}}" >{{$grupo->id_grupo}}</option>
                                    @endif

                                @endforeach
                            </select>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <br>
                    <button id="guardar_solicitud" class="btn btn-info">Mostrar</button>
                </div>



            </div>

            <br>
            <br>
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <table class="table table-bordered " id="tabla_estudiantes">
                        <thead class="">
                        <tr class="text-center">
                            <th class="text-center">No. CTA</th>
                            <th class="text-center">ALUMNO</th>
                            <th>Agregar</th>

                        </tr>
                        <tbody>

                        @foreach($estudiantes as $estudiante)

                            <tr >
                                <td class="text-center">{{$estudiante->cuenta}}</td>
                                <td class="text-center "> {{$estudiante->nombre.' '.$estudiante->apaterno.' '.$estudiante->amaterno}}</td>
                                <td class="text-left"> <button class="btn btn-primary agregar" id="{{ $estudiante->id_alumno }}">Agregar</button></td>


                            </tr>

                        @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="col-md-5">

                </div>
            </div>


                <div class="modal fade bs-example-modal-sm" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Agregar estudiante</h4>
                            </div>
                            <div id="contenedor_agregar">

                            </div>
                        </div>
                    </div>
                </div>





        @endif





    </main>

    <script type="text/javascript">

        $(document).ready( function() {
            $('#tabla_estudiantes').DataTable( {

            } );
            $("#guardar_solicitud").click(function (event) {
                var id_carrera=$("#id_carrera").val();
                var id_semestre=$("#id_semestre").val();
                var id_grupos_carrera=$("#id_grupos").val();
                if(id_carrera != null && id_semestre != null && id_grupos_carrera != null)
                {
                    window.location.href='/ingles/consultar_usuarios_grupo_prof/{{ $id_nivel}}/{{ $id_grupo}}/'+id_carrera+'/'+id_semestre+'/'+id_grupos_carrera ;
                }else{
                    swal({
                        position: "top",
                        type: "warning",
                        title: "Algún campo se encuentra  vacío.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }



            });
            $("#tabla_estudiantes").on('click','.agregar',function(){

                var id_alumno=$(this).attr('id');
                $.get("/ingles/profesores/datos_usuario_ingles/"+id_alumno+"/{{ $id_nivel }}/{{ $id_grupo}}",function (request) {
                    $("#contenedor_agregar").html(request);
                    $("#modal_agregar").modal('show');
                });
            });





        });
    </script>

@endsection