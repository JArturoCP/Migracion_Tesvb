@extends('layouts.panel')
@section('title', 'Seguimiento de actividades')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <?php
    $unidad = Session::get('id_unidad_admin');
    $jefe_residencia = session()->has('residencia') ? session()->has('residencia') : false;
    ?>


    <main class="tw:w-full tw:lg:w-full tw:px-2">
            <x-panel.encabezado :titulo="'Seguimiento de actividades '.$nombre_alumno" :migas="['Residencia profesional' => null]" />
        @if($unidad == 26 || $unidad == 20 )
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                    <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('/residencia/carreras_proyectos')}}"><span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar</a>
                </div>

            </div>
        @else
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                    <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('/residentes/carrera')}}"><span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar</a>
                </div>

            </div>
        @endif
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                @if($terminado_proyecto == 1)
                    @if($promedio_final==0)
                        <button type="button" class="evaluacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{{ $id_anteproyecto }}}" title="Enviar" disabled>Evaluación de residencia</button>
                    @else

                        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><?php $promedio_residencia=round($promedio_residencia); ?>

                                @if($promedio_residencia < 70)
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">  {{  $promedio_residencia }}   </button>

                                @else
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">  {{ $promedio_residencia }}   </button>

                                @endif
                                <br>
                                <b>Promedio Residencia</b>
                                <br></h3>
                    @endif

                @endif
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" id="imprimir" style="display: block;">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><?php $promedio=round($promedio); ?>

                        @if($promedio < 70)
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">  {{  $promedio }}   </button>

                        @else
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">  {{  $promedio }}   </button>

                        @endif
                        <br>
                        <b>Promedio Final</b>
                        <br></h3>
            </div>
        </div>
        @foreach($semanas as $semana)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2">
                                    <b>Semana</b> {{$semana['no_semana']}}
                                </div>
                                <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2">
                                    <?php  $fecha_inicial=date("d-m-Y",strtotime($semana['f_inicio'])); ?>
                                    <?php  $fecha_final=date("d-m-Y",strtotime($semana['f_termino'])); ?>
                                    Del {{$fecha_inicial}} al  {{$fecha_final}}
                                </div>
                                @if($semana['estatus'] == 1)
                                    <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                                        @if($semana['promedio'] < 70 )
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                                                N. A.
                                            </button>
                                            @if($jefe_residencia == true)
                                                <button type="button"
                                                        class="editar-calificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                                        data-id="{{ $semana['id_cronograma'] }}"
                                                        data-promedio="{{ $semana['promedio'] }}"><span class="fa fa-pencil-square-o"></span></button>
                                            @endif
                                        @else
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
                                                {{$semana['promedio']}}
                                            </button>
                                            @if($jefe_residencia == true)
                                                <button type="button"
                                                        class="editar-calificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                                        data-id="{{ $semana['id_cronograma'] }}"
                                                        data-promedio="{{ $semana['promedio'] }}"><span class="fa fa-pencil-square-o"></span></button>
                                            @endif
                                        @endif
                                    </div>
                                @elseif($semana['estatus'] == 2)
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <button type="button" class="calificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $semana['id_cronograma'] }}" disabled>Calificar</button>
                                    </div>
                                @elseif($semana['estatus'] == 3)
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <button type="button" class="calificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" disabled >Calificar</button>

                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tw:p-5 tw:sm:p-6">
                            <b>Actividad(es):</b>  {{$semana['actividad']}}
                        </div>
                    </div>
                </div>

            </div>


        @endforeach
    </main>


    <x-panel.modal id="modal_calificar_actividad" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Calificar actividad <br>  {{ $nombre_alumno }}</h4>
                </div>
                <div id="contenedor_calificar_actividad"></div>
            </x-panel.modal>


    <x-panel.modal id="modal_modificar_asesores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Asesor</h4>
                </div>
                <div id="contenedor_modificar_asesores"></div>
            </x-panel.modal>
    <x-panel.modal id="modal_formato" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Calificar residencia <br>  {{ $nombre_alumno }}</h4>
                </div>
                <div id="contenedor_formato"></div>
            </x-panel.modal>




    <x-panel.modal id="modal_editar_calificacion" tamano="md" sin-relleno clase-cerrar="close">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Editar Calificación</h4>
                </div>

                <div class="tw-modal-cuerpo">
                    <form id="formEditarCalificacion">
                        <input type="hidden" id="idSemana">
                        <div class="tw:mb-4">
                            <label for="nuevaCalificacion">Nueva calificación:</label>
                            <input type="number" id="nuevaCalificacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" min="0" max="100" required>
                        </div>
                    </form>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="guardarNuevaCalificacion">Guardar</button>
                </div>

            </x-panel.modal>



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
</div>
@endsection
