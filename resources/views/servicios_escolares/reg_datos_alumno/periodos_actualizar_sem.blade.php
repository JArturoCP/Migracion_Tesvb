@extends('layouts.panel')
@section('title', 'Servicios escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Periodos de actualización de semestre" :migas="['Servicios escolares' => null]" />
       @if($periodo_activo != null)
           <x-panel.alerta tipo="exito" class="tw:mb-4"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >Periodo activo</h3>
                           <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >Nombre del periodo: {{ $periodo_activo->periodo }}</h3>
                           <p class="tw:text-center">          <button data-toggle="tooltip" data-placement="top" id="{{$periodo_activo->id_periodos_sem_act }}" title="Finalizar periodo" class="h-primary_m finalizar_periodos tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Finalizar periodo</button>
                              <br><br> <button data-toggle="tooltip" data-placement="top"  onclick="window.location='{{ url('/servicios_escolares/carreras_act_sem/') }}'" title="Actualizar semestre por carrer" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Actualizar semestre por carrera</button>

                           </p></x-panel.alerta>
        @endif

     @if($periodo_activo == null)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar periodo" data-target="#modal_crear_periodo" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        @endif

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="registros_periodos">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Periodo</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($periodos_semestre as $peri)
                    <tr>
                        <td>{{ $i++ }}</td>

                        <td>{{ $peri->periodo }}</td>

                            @if($peri->id_estado_actualizacion == 0)
                            <td>
                                <button data-toggle="tooltip" data-placement="top" id="{{$peri->id_periodos_sem_act }}" title="Activar periodo" class="h-primary_m activacion_periodo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Activar periodo</button>
                            </td>
                            @elseif($peri->id_estado_actualizacion == 1)
                                <td>Activo</td>
                           @elseif($peri->id_estado_actualizacion == 2)
                                <td>Finalizado</td>

                            @endif


                    </tr>
                @endforeach



                </tbody>
            </table>
</div>
        </div>
    </div>

    {{-- modal crear periodo--}}

    <x-panel.modal id="modal_crear_periodo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar periodo actualización de semestre</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/servicios_escolares/reg_periodo_act_sem")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Selecciona periodo</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_periodo" name="id_periodo" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($periodos as $periodo)
                                            <option value="{{$periodo->id_periodo}}" data-esta="{{$periodo->periodo }}">{{ $periodo->periodo }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_periodo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal activar periodo--}}

    <x-panel.modal id="modal_activar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Activar periodo de actualizacion de semestre </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_activar">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_activacion_periodo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal finalizar periodo--}}

    <x-panel.modal id="modal_finalizar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Finalizar periodo de actualizacion de semestre </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form  id="form_guardar_activar_est" action="{{url("/servicios_escolares/guardar_finalizacion_periodo/")}}" role="form" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Seguro(a) quieres finalizar periodo?</h4>


                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                    </form>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready( function() {

            $("#guardar_periodo").click(function (){
                var id_periodo = $('#id_periodo').val();
                if(id_periodo != null){

                        $("#form_agregar").submit();
                        $("#guardar_periodo").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Seleccionar periodo para actualizar semestre",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#registros_periodos").on('click','.activacion_periodo',function(){
                var id_periodos_sem_act =$(this).attr('id');

                $.get("/servicios_escolares/activar_periodo_act_sem/"+id_periodos_sem_act,function (request) {
                    $("#contenedor_activar").html(request);
                    $("#modal_activar").modal('show');
                });
            });
           $("#guardar_activacion_periodo").click(function (){
               $("#form_guardar_activar_periodo").submit();
               $("#guardar_activacion_periodo").attr("disabled", true);
           });
            $(".finalizar_periodos").click(function (){

                   $("#modal_finalizar").modal('show');
           });

        });
    </script>

</div>
@endsection