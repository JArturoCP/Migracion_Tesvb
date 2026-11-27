@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Desactivación de grupos')
@section('content')
    <main class="ingles-i3c tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar estudiantes al grupo</h1>
        @if($estado == 0)
        <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:lg:grid-cols-4">
            <div>
                <div class="form-group">
                    <div class="dropdown">
                        <label for="id_carrera">Carreras</label>
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
            <div>
                <div class="form-group">
                    <div class="dropdown">
                        <label for="id_semestre">Semestres</label>
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
            <div>
                <div class="form-group">
                    <div class="dropdown">
                        <label for="id_grupos">Grupos</label>
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

            <div>
                <br>
                <button id="guardar_solicitud" class="btn btn-info">Mostrar</button>
            </div>



        </div>

        <br>
        <br>
        @else
            <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:lg:grid-cols-4">
            <div>
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="id_carrera">Carreras</label>
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
                <div>
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="id_semestre">Semestres</label>
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
                <div>
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="id_grupos">Grupos</label>
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

                <div>
                    <br>
                    <button id="guardar_solicitud" class="btn btn-info">Mostrar</button>
                </div>



            </div>

            <br>
            <br>
            <x-panel.tarjeta>

                    <table class="table tw-tabla" id="tabla_estudiantes">
                        <thead>
                        <tr class="text-center">
                            <th class="text-center">No. CTA</th>
                            <th class="text-center">ALUMNO</th>
                            <th>Agregar</th>

                        </tr>
                        </thead>
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
                </x-panel.tarjeta>


                <div class="modal fade bs-example-modal-sm" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
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

<style>

    .ingles-i3c .btn:focus-visible,
    .ingles-i3c .form-control:focus-visible,
    .ingles-i3c [tabindex="0"]:focus-visible {
        outline: 2px solid #3538cd;
        outline-offset: 2px;
    }
    .dark .ingles-i3c :is(.btn, .form-control, [tabindex="0"]):focus-visible {
        outline-color: #a4bcfd;
    }
    .dark .ingles-i3c .form-control {
        color: #f2f4f7;
        background: #1d2939;
        border-color: #667085;
        color-scheme: dark;
    }

    .dark .ingles-i3c .modal-content {
        background: #1d2939;
        color: #f2f4f7;
    }
    .dark .ingles-i3c .modal-content :is(.modal-header, .modal-footer) {
        border-color: #475467;
    }
    .dark .ingles-i3c .modal-header.bg-info {
        background: #25324a;
    }
    .dark .ingles-i3c .modal-header .close {
        color: #fff;
        opacity: 1;
        text-shadow: none;
    }

    .dark .ingles-i3c table.dataTable tbody :is(tr, td) {
        background-color: #1d2939;
        color: #e4e7ec;
    }
    .dark .ingles-i3c table.dataTable th {
        background-color: #25324a;
        color: #f2f4f7;
    }
    .dark .ingles-i3c table.dataTable tbody tr:hover td {
        background-color: #25324a;
    }
</style>
@endsection