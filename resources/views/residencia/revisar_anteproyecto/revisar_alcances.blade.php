@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Anteproyecto para revisar de '.$alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                <li ><a href="{{ url('residencia/revisar_anteproyecto/'.$id_anteproyecto.'/'.$id_profesor ) }}">Portada</a></li>
                <li >
                    <a href="{{ url('/residencia/revisar_objetivos/'.$id_anteproyecto.'/'.$id_profesor ) }}" >Objetivos</a>
                </li>
                <li class="active">
                    <a href="#" >Alcances </a>
                </li>
                <li>
                    <a href="{{ url('/residencia/revisar_justificacion/'.$id_anteproyecto.'/'.$id_profesor ) }}" >Justificación</a>
                </li>
                <li>
                    <a href="{{ url('/residencia/revisar_marcoteorico/'.$id_anteproyecto.'/'.$id_profesor ) }}" >Marco teorico</a>
                </li>
                <li>
                    <a  href="{{ url('/residencia/revisar_cronograma/'.$id_anteproyecto.'/'.$id_profesor ) }}" >Cronograma</a>
                </li>
                @if($anteproyecto_calificado == 1)
                    <li>
                        <button type="button" id="enviar_anteproyecto" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location='{{ url('/residencia/enviar_anteproyecto_alumno/'.$id_anteproyecto.'/'.$id_profesor ) }}'" title="Enviar">Enviar Anteproyecto</button>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:lg:grow tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Alcances</h3>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="objetivo_general">ALCANCES</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="alcance" name="alcance" rows="10" placeholder="Ingresar alcances de tu anteproyecto " required>{{ $alcances->alcances }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="objetivo_especifico">lIMITACIONES</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="limitacion" name="limitacion" rows="10" placeholder="Ingresa las limitaciones de tu anteproyecto " required>{{ $alcances->limitaciones }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($comentario_alcances == 0 )
            <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2">
                @if($autorizado_profesor==0)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">Evaluaciòn</div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th>Autorizado</th>
                                <th>Autorizado con cambios</th>
                                <th>Rechazado</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="tw:text-center">
                                    <button type="button" class="aceptar_alcances_anteproyecto tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"  title="Aceptar"><i class="fa fa-check"></i></button>

                                </td>
                                <td class="tw:text-center">
                                    <button type="button" class="cambios_alcances_anteproyecto tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:size-9 tw:text-base"  title="Aceptado con cambios"><i class="fa fa-exclamation-circle" ></i></button>

                                </td>
                                <td class="tw:text-center">
                                    <button type="button" class="rechazar_alcances_anteproyecto tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"  title="Rechazar"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
</div>
                    </div>
                </div>
                </div>
                    @else
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <x-panel.alerta tipo="error" class="tw:mb-4">
                                    Ya autorizaste alcances y limitaciones
                                </x-panel.alerta>
                            </div>
                        </div>
                @endif
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">COMENTARIOS</h3>
                    @for ($i =$numero_evaluacion; $i >0;  $i--)
                        @if($i==$numero_evaluacion)

                            <x-panel.alerta tipo="exito" class="tw:mb-4"><a href="#" class="comentarios" id="{{$i}}">Ver comentarios de la evaluación {{ $i }} actual </a></x-panel.alerta>
                        @else
                            <x-panel.alerta tipo="exito" class="tw:mb-4"><a href="#" class="comentarios" id="{{$i}}">Ver comentarios de la evaluación {{ $i }}</a></x-panel.alerta>
                        @endif
                    @endfor
            </div>
        @else

            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                @if($autorizado_profesor == 1)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <x-panel.alerta tipo="error" class="tw:mb-4">
                                Ya autorizaste alcances y limitaciones
                            </x-panel.alerta>
                        </div>
                    </div>
                @endif
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">COMENTARIOS</h3>
                @for ($i =$numero_evaluacion; $i >0;  $i--)
                    @if($i==$numero_evaluacion)

                        <x-panel.alerta tipo="exito" class="tw:mb-4"><a href="#" class="comentarios" id="{{$i}}">Ver comentarios de la evaluación {{ $i }} actual </a></x-panel.alerta>
                    @else
                        <x-panel.alerta tipo="exito" class="tw:mb-4"><a href="#" class="comentarios" id="{{$i}}">Ver comentarios de la evaluación {{ $i }}</a></x-panel.alerta>
                    @endif
                @endfor
            </div>
    
    @endif

    </div>
    {{-- Modal para agregar evaluación--}}
        <x-panel.modal id="modal_agregar_comentario_alcances" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Nuevo Comentario</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <form id="form_registrar" action="{{url("/residencia/guardar_comentarios_alcances/")}}" class="" role="form" method="POST">

                        {{ csrf_field() }}
                        <input type="hidden" id="id_alcances" name="id_alcances" value="{{ $alcances->id_alcances }}">
                        <input type="hidden" id="id_profesor" name="id_profesor" value="{{ $id_profesor }}">
                        <input type="hidden" id="comentario_alcances" name="comentario_alcances" value="{{ $comentario_alcances }}">
                        <input type="hidden" id="id_anteproyecto" name="id_anteproyecto" value="{{$id_anteproyecto }}">
                        <input type="hidden" id="id_estado_evaluacion" name="id_estado_evaluacion" value="">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="descripcion">Comentario</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa el motivo " required></textarea>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="guardar">Aceptar</button>
                    </div>
                </x-panel.modal>


    <x-panel.modal id="modal_mostrar_alcances" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Comentarios</h4>
                </div>
                <div id="mostrar_comentarios_alcances">


                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
                </div>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#guardar").click(function(event) {
                var descripcion = $("#descripcion").val();
                if (descripcion != "") {
                    $("#guardar").attr("disabled", true);
                    $("#form_registrar").submit();


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
            $(".aceptar_alcances_anteproyecto").click(function(){
                var aceptado=1;
                $('#id_estado_evaluacion').val(aceptado);
                $('#modal_agregar_comentario_alcances').modal('show');

            });
            $(".cambios_alcances_anteproyecto").click(function(){
                var cambios=2;
                $('#id_estado_evaluacion').val(cambios);
                $('#modal_agregar_comentario_alcances').modal('show');

            });
            $(".rechazar_alcances_anteproyecto").click(function(){
                var rechazado=3;
                $('#id_estado_evaluacion').val(rechazado);
                $('#modal_agregar_comentario_alcances').modal('show');

            });
            $(".comentarios").click(function(){
                var id_anteproyecto="<?php  echo $id_anteproyecto;?>";
                var id_evaluacion=$(this).attr("id");
                // TNotify.alert(id_anteproyecto);
                $.get("/residencia/mostrar_comentario_alcances/"+id_evaluacion+"/"+id_anteproyecto,function(request){
                    $("#mostrar_comentarios_alcances").html(request);
                    $("#modal_mostrar_alcances").modal('show');

                });
                $("#enviar_anteproyecto").click(function (){
                    $("#enviar_anteproyecto").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Envio correctamente",
                        showConfirmButton: false,
                        timer: 3500
                    });
                });


            });

        });
    </script>

</div>
@endsection