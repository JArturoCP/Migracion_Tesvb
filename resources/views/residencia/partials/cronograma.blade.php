@extends('layouts.panel')
@section('title', 'Registrar Anteproyecto')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Generar Anteproyecto" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4">
                            <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:w-full tw:lg:w-2/12 tw:px-2">
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/portada')}}">Portada</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/objetivos')}}">Objetivos</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/alcances')}}">Alcances</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/justificacion')}}">Justificación</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/marco_teorico')}}">Marco Teorico</a></li>
                                <li class="active"><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:bg-brand-50 tw:text-brand-500" href="#">Cronograma</a></li>
                            </ul>
                            <div class="tw:w-full tw:lg:w-10/12 tw:px-2">

                                <div  class="tab-pane">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4"><div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Cronograma de Actividades</h3></div></div>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach( $semanas as $semana)
                                                <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2 tw:mb-1">
                                                    <div class="tw:border-3 tw:border-sky-100 tw:dark:border-sky-500/20 tw:rounded-md tw:p-1.25">
                                                        <div class="tw:p-5 tw:sm:p-6">
                                                            <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                                                                <strong>SEMANA {{ $semana['no_semana'] }}</strong>
                                                            </h5>
                                                            <p>
                                                                @if($semana['estatus']==1)
                                                                    <?php  $fecha_inicial=date("d-m-Y ",strtotime($semana['f_inicio'])) ?>
                                                                    <?php  $fecha_final=date("d-m-Y ",strtotime($semana['f_termino'])) ?>
                                                                    <b>{{{$fecha_inicial}}}</b> al <b>{{{$fecha_final}}}</b><br>
                                                            <p><b>Actividad(es)</b><br>{{$semana['actividad']}}</p><br>
                                                            @if($enviado_anteproyecto==0)
                                                                <button class="modificar_actividad tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{$semana['id_cronograma']}}"><i class="fa fa-cog "></i></button>

                                                            @else
                                                            <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"  disabled><i class="fa fa-cog "></i></button>
                                                            @endif
                                                            @elseif($semana['estatus']==2)
                                                                <h6 class="tw:text-red-600 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">No se ha asignado actividad(es)</h6>
                                                                <button data-toggle="tooltip" data-placement="top" id="{{$semana['no_semana'] }}" title="Asignar actividad(es)" class="h-primary_m agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Asignar actividad(es)</button></span>

                                                            @elseif($semana['estatus']==3)
                                                                <h6 class="tw:text-red-600 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">No se ha asignado actividad(es)</h6>
                                                                <button data-toggle="tooltip" data-placement="top"   class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" disabled>Asignar actividad(es)</button></span>

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

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{--registro de actividad--}}
    <x-panel.modal id="modal_registro_actividad" tamano="md" sin-relleno aria-labelledby="myModalLabel">
                <form id="form_agregar_actividad"  action="{{url("/residencia/anteproyecto/cronograma/registrar_actividad/")}}" role="form" method="POST" >
                    {{ csrf_field() }}


                        <div id="contenedor_registro_actividad">
                        </div>

                </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  id="guarda_actividad" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  >Guardar</button>
                    </div>

            </x-panel.modal>
    {{--fin de registro de actividad--}}
    {{--modificar actividad--}}
    <x-panel.modal id="modal_modificar_actividad" tamano="md" sin-relleno aria-labelledby="myModalLabel">
                <form id="form_modificar_actividades" action="{{url("/residencia/anteproyecto/cronograma/modificacion_actividad/")}}" role="form" method="POST" >
                    {{ csrf_field() }}

                    <div id="contenedor_modificar_actividad">


                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  id="guarda_actividades" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  >Guardar</button>
                    </div>
                </form>
            </x-panel.modal>
    {{--fin modificar actividad--}}
    <script type="text/javascript">

        $(document).ready( function() {
            $(".agregar").click(function (event) {
                var idof=$(this).attr('id');
                $.get("/residencia/anteproyecto/cronograma/agregar_actividad/"+idof,function (request) {
                    $("#contenedor_registro_actividad").html(request);
                    $("#modal_registro_actividad").modal('show');
                });
            });
            $(".modificar_actividad").click(function (event) {
                var id_cronograma=$(this).attr('id');
                $.get("/residencia/anteproyecto/cronograma/modificar_actividad/"+id_cronograma,function(request){
                    $("#contenedor_modificar_actividad").html(request);
                    $("#modal_modificar_actividad").modal('show');
                });
            });


        });
        $("#guarda_actividad").click(function (){
            var actividad = $("#actividad").val();
            if (actividad != "" ) {
                $("#guarda_actividad").attr("disabled", true);
                $("#form_agregar_actividad").submit();


                swal({
                    position: "top",
                    type: "success",
                    title: "Registro exitoso",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            else{
                swal({
                    position: "top",
                    type: "warning",
                    title: "El campo se encuentra  vacío.",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
        });
        $("#guarda_actividades").click(function (){
            var actividades = $("#actividades").val();
            if (actividades != "" ) {
                $("#guarda_actividades").attr("disabled", true);
                $("#form_modificar_actividades").submit();


                swal({
                    position: "top",
                    type: "success",
                    title: "Modificación exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            else{
                swal({
                    position: "top",
                    type: "warning",
                    title: "El campo se encuentra  vacío.",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
        });


        var statSend = false;
        function checkSubmit() {
            if (!statSend) {
                statSend = true;
                return true;
            } else {
                TNotify.alert("El formulario ya se esta enviando...");
                return false;
            }
        }


    </script>
</div>
@endsection