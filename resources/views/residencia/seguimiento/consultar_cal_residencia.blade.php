@extends('layouts.panel')
@section('title', 'Seguimiento de actividades')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        @if($encuesta==0)
            @foreach($semanas as $semana)
        @if($semana['no_semana'] == $ultima and $semana['estatus'] == 1)
            @if($promedio_final== 0)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2 tw:text-center">
                        <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="#"
                           onclick="window.open('{{url('/residencia/pdf_formato_evaluacion/'.$id_anteproyecto)}}')">PDF PARA EVALUACIÓN EXTERNA</a></div>
                </div>
                    @endif


            @endif
            @endforeach
           @endif

        @if($encuesta==1)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2 tw:text-center">

                    <button type="button" class="documentacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{{ $id_anteproyecto }}}" title="Documentacion">Documentación</button>

                </div>
            </div>
        @endif

        @if($promedio_final==1)
            @if($encuesta==0)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2 tw:text-center">

                        <button type="button" class="evaluacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  title="Evaluación Final de Residencia">Evaluación Final de Residencia</button>

                    </div>
                </div>
            @endif
        @endif
            <x-panel.encabezado titulo="Seguimiento de actividades" :migas="['Residencia profesional' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                @if($promedio_final==1)
                    <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><?php $promedio_residencia=round($promedio_residencia); ?>

                            @if($promedio_residencia < 70)
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">  {{  $promedio_residencia }}   </button>

                            @else
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">  {{ $promedio_residencia }}   </button>

                            @endif
                            <br>
                            <b>Promedio General de  Residencia</b>
                            <br></h3>
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
                        <b>Promedio Seguimiento</b>
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
                                    Semana {{$semana['no_semana']}}
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
                                        @else
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
                                                {{$semana['promedio']}}
                                            </button>
                                        @endif
                                    </div>
                                @elseif($semana['estatus'] == 3)
                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">No se ha asignado calificación</button>
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
            @if($semana['no_semana'] == 4 and $semana['estatus'] == 1)
                <?php  $numero1=4 ?>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/residencia/seguimiento_residencia/'.$id_anteproyecto.'/'.$numero1 ) }}')" title="Enviar">Imprimir Reporte 1</button>

                    </div>
                </div>
            @endif
            @if($semana['no_semana'] == 8 and $semana['estatus'] == 1)
                <?php  $numero2=8 ?>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/residencia/seguimiento_residencia/'.$id_anteproyecto.'/'.$numero2 ) }}')" title="Enviar">Imprimir Reporte 2</button>

                    </div>
                </div>
            @endif
            @if($semana['no_semana'] == 12 and $semana['estatus'] == 1)
                <?php  $numero3=12 ?>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/residencia/seguimiento_residencia/'.$id_anteproyecto.'/'.$numero3 ) }}')" title="Enviar">Imprimir Reporte 3</button>

                    </div>
                </div>
            @endif
            @if($semana['no_semana'] == 16 and $semana['estatus'] == 1)
                <?php  $numero4=16 ?>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/residencia/seguimiento_residencia/'.$id_anteproyecto.'/'.$numero4 ) }}')" title="Enviar">Imprimir Reporte 4</button>

                    </div>
                </div>
            @endif
            @if($semana['no_semana'] == $ultima and $semana['estatus'] == 1)
                <?php  $numero5=$semana['no_semana'] ?>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/residencia/ultimo_reporte_residencia/'.$id_anteproyecto.'/'.$numero5 ) }}')" title="Enviar">Imprimir Reporte 5</button>

                    </div>
                </div>

            @endif
        @endforeach
    </main>


    <x-panel.modal id="modal_calificar_actividad" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Calificar actividad</h4>
                </div>
                <div id="contenedor_calificar_actividad">


                </div>



            </x-panel.modal>


    <x-panel.modal id="modal_modificar_asesores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Asesor</h4>
                </div>
                <div id="contenedor_modificar_asesores">


                </div>



            </x-panel.modal>

    <x-panel.modal id="modal_documentacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Oficios Finales</h4>
                </div>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/residencia/seguimiento/oficio_informe_final/'.$id_anteproyecto)}}')">OFICIO DE ACEPTACIÓN DE INFORME FINAL DEL ASESOR INTERNO</a></div>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/residencia/seguimiento/oficio_aceptacion_externo/'.$id_anteproyecto)}}')">OFICIO DE ACEPTACIÓN DE INFORME FINAL DEL ASESOR EXTERNO</a></div>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/residencia/formato_evaluacion/'.$id_anteproyecto)}}')">EVALUACIÓN EXTERNA DE RESIDENCIA PROFESIONAL</a></div>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/residencia/seguimiento/oficio_revisor/'.$id_anteproyecto)}}')">OFICIO DE ACEPTACIÓN DE INFORME FINAL DE REVISOR</a></div>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/residencia/seguimiento/portada/'.$id_anteproyecto)}}')">PORTADA</a></div>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/residencia/seguimiento/pdf_encuesta/'.$id_anteproyecto)}}')">ENCUESTA</a></div>
                        </div>
                    </div>
                </div>



                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                </div>
            </x-panel.modal>

    <x-panel.modal id="modal_evaluacion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel"><form action="{{url("/residencia/evaluacion_final_residencia/")}}" role="form" method="POST" >
            {{ csrf_field() }}
            

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Evaluación Final de Residencia Profesional</h4>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:p-5 tw:sm:p-6">Instrucciones: Responda con la mayor sinceridad posible las sigientes preguntas.</div>
                        </div>

                    </div>

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <input type="hidden" id="id_anteproyecto" name="id_anteproyecto" value="{{$id_anteproyecto}}">

                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:mb-4">
                                            <label for="selectcalidad">1.-¿Se instruyó con el curso de inducción por parte del Departamento de Servicio Social y Residencia Profesional?</label>
                                            <div class="tw:w-full tw:px-2">
                                                <select name="pregunta1" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                                    <option disabled selected>Selecciona...</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            2.¿Se te instruyo en el curso sobre los siguientes aspectos?

                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
                                            <div class="tw:w-full tw:lg:w-5/12 tw:lg:grow tw:px-2">
                                                <label for="selectcalidad">Reglamento de residencia profesional</label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
                                                <select name="pregunta2" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                                    <option disabled selected>Selecciona...</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <br>
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:mb-4">
                                            <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                                                <label for="selectcalidad">El proceso de Residencia Profesional </label>
                                            </div>
                                            <div class="tw:w-full tw:px-2">
                                                <select name="pregunta3" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                                    <option disabled selected>Selecciona...</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
                                            <div class="tw:w-full tw:lg:w-5/12 tw:lg:grow tw:px-2">
                                                <label for="selectcalidad">El proceso de Residencia Profesional</label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
                                                <select name="pregunta4" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                                    <option disabled selected>Selecciona...</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
                                            <div class="tw:w-full tw:lg:w-5/12 tw:lg:grow tw:px-2">
                                                <label for="selectcalidad">Los formatos</label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
                                                <select name="pregunta5" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                                    <option disabled selected>Selecciona...</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:mb-4">
                                            <label for="selectcalidad">3.- Durante tu Residencia Profesional, ¿qué tipo de asesorías recibiste por parte del Departamento de  Servicio Social y Residencia Profesional y de tu Jefatura de División?</label>
                                            <div class="tw:w-full tw:px-2">
                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="pregunta8" name="pregunta8"  rows="2" placeholder="Ingresa una respuesta"  required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:mb-4">
                                            <label for="selectcalidad"> 4.- En una escala de 0 a 100, ¿qué tan satisfecha(o) estas con la atención por parte del Departamento de Servicio Social y Residencia Profesional?</label>
                                            <div class="tw:w-full tw:px-2">
                                                <input type="number" name="pregunta9" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="pregunta9" title="0" required >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:mb-4">
                                            <label for="selectcalidad">5.-En una escala de 0 a 100 indica, ¿cuál es tu nivel de satisfacción personal al término de residencia profesional?</label>
                                            <div class="tw:w-full tw:px-2">
                                                <input type="number" name="pregunta7" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="pregunta7" title="0" required >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:mb-4">
                                        <div class="tw:mb-4">
                                            <label for="selectcalidad">Comentarios</label>

                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario" name="comentario"  rows="2" placeholder="Ingresa comentarios"  required></textarea>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}



                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>

                </form></x-panel.modal>


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


                $("#modal_evaluacion").modal('show');

            });

            $(".documentacion").click(function(){


                $("#modal_documentacion").modal('show');

            });


        });
    </script>
</div>
@endsection
