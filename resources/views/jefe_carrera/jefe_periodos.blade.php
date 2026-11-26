@extends('layouts.panel')
@section('title', 'Periodos J.C.')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Periodos para evaluar unidades" :migas="['Jefatura de división' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">{{$nom_carrera}}</label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-left tw:px-2">
                            Materia: {{ $tot_unidades->nombre }}
                            <br>
                            Grupo: {{$grupo}}
                        </label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
                            Clave: {{ $tot_unidades->clave }}
                            <br>
                            No. Unidades: {{ $tot_unidades->unidades }}
                        </label>
                    </div>
                    <hr class="tw:border tw:border-gray-400 tw:dark:border-gray-600"/>
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        @foreach( $array_perio as $periodo)
                            <div class="tw:w-full tw:lg:w-3/12 tw:text-center tw:px-2 tw:mb-1" >
                                <div class="tw:border-3 tw:border-sky-100 tw:dark:border-sky-500/20 tw:rounded-md tw:p-1.25">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                                            <strong>UNIDAD {{($periodo['id_unidad']==1 ? 'I' :
                                                ($periodo['id_unidad']==2 ? 'II' :
                                                    ($periodo['id_unidad']==3 ? 'III' :
                                                        ($periodo['id_unidad']==4 ? 'IV' :
                                                            ($periodo['id_unidad']==5 ? 'V' :
                                                                ($periodo['id_unidad']==6 ? 'VI' :
                                                                    ($periodo['id_unidad']==7 ? 'VII' :
                                                                        ($periodo['id_unidad']==8 ? 'VIII' :
                                                                            ($periodo['id_unidad']==9 ? 'IX' :
                                                                                ($periodo['id_unidad']==10 ? 'X' :
                                                                                    ($periodo['id_unidad']==11 ? 'XI' :
                                                                                        ($periodo['id_unidad']==12 ? 'XII' :
                                                                                            ($periodo['id_unidad']==13 ? 'XIII' :
                                                                                                ($periodo['id_unidad']==14 ? 'XIV' :
                                                                                                    ($periodo['id_unidad']==15 ? 'XV' : ' ' )))))))))))))))}}
                                            </strong>
                                        </h5>
                                        <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                                        <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>Fecha limite para cargar  calificaciones de la unidad</strong></h5>
                                        @if($periodo['status']==1)
                                            <?php  $fecha_periodo=date("d-m-Y ",strtotime($periodo['fecha'])) ?>
                                            <h6 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">{{$fecha_periodo }}</h6>
                                            @if($periodo['evaluada']==1)
                                                <a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Evaluación realizada"><span class="oi oi-check tw:p-1"></span></a>
                                            @elseif($periodo['evaluada']==0)
                                                <a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Evaluación pendiente"><span class="oi oi-clock"></span></a>
                                                    {{--    quitar el disabled en eeste boton  --}}
                                                <button data-toggle="tooltip" data-placement="top" id="{{$periodo['id_unidad'] }}" title="Modificar fecha" class="h-primary_m disabled tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="oi oi-pencil tw:p-1"></span></button>

                                            @endif

                                        @elseif($periodo['status']==2)
                                            <h6 class="tw:text-red-600 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">No asignado</h6>
                                        {{--    quitar el disabled en eeste boton  --}}
                                            <button data-toggle="tooltip" data-placement="top" id="{{$periodo['id_unidad'] }}" title="Modificar fecha" class="h-primary_m agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Asignar fecha</button>
                                            {{--     <span data-toggle="modal" data-target="#{{$periodo['id_materia']  }}modal_evaluaciones{{$periodo['id_unidad']}}"><button data-toggle="tooltip" data-placement="top" title="Modificar fecha" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:pl-12 tw:pr-12 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" {{ ($i!=0 && isset($uni_asignadas[$i-1]) ? 'enable' : ($i==0) ? 'enable':'disabled') }}>Asignar fecha</button></span>
                                            --}}
                                        @elseif($periodo['status']==3)
                                            <h6 class="tw:text-red-600 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">No asignado</h6>
                                            <button data-toggle="tooltip" data-placement="top"  title="Modificar fecha" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" disabled>Asignar fecha</button>

                                            @endif
                                            </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <form id="form_periodoss" class="" action="{{url("/docente/acciones/crear_periodos")}}" role="form" method="POST" >
        <x-panel.modal id="modal_reg_periodo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    {{ csrf_field() }}
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Asignar fecha de evaluación</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_mostrar_periodo">
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_periodoss" type="button"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>

                </x-panel.modal>
    </form>
    <x-panel.modal id="modal_modificar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <form id="form_modificar" class="" action="{{url("/docente/acciones/modificar_periodo")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar fecha de evaluación</h4>
                    </div>
                    <div id="contenedor_modificar">

                    </div>
                </form>
            </x-panel.modal>

    <script type="text/javascript">

        $(document).ready( function() {
            $(".agregar").click(function (event) {
                var idof=$(this).attr('id');
                var id_materia = "<?php  echo $id_materia;?>";
                var id_grupo = "<?php  echo $id_grupo;?>";

                $.get("/docente/regperiodos/"+idof+"/"+id_materia+"/"+id_grupo,function (request) {
                    $("#contenedor_mostrar_periodo").html(request);
                    $("#modal_reg_periodo").modal('show');
                });

            });
            $(".modificar").click(function (event) {
                var idof=$(this).attr('id');
                var id_materia = "<?php  echo $id_materia;?>";
                var id_grupo = "<?php  echo $id_grupo;?>";
                var id_docente = "<?php  echo $id_docente;?>";

                $.get("/docente/acciones/modificar_periodo/"+idof+"/"+id_materia+"/"+id_grupo+"/"+id_docente,function (request) {
                    $("#contenedor_modificar").html(request);
                    $("#modal_modificar").modal('show');
                });;


            });
            $("#guardar_periodoss").click(function(event){
                var fech = $("#fecha_s").val();
                if (fech != "") {


                    $("#form_periodoss").submit();
                    $("#guardar_periodoss").attr("disabled", true);

                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "La fecha no debe ser vacia",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });

            $("#modificar_periodo").click(function(event){
                $("#form_modificar").submit();
            });
            $("#form_modificar").validate({
                rules: {
                    fecha_s : "required",
                },
            });
        });
    </script>

</div>
@endsection