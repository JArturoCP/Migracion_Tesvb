@extends('layouts.panel')
@section('title', 'Servicio Social')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main>
        <x-panel.encabezado titulo="Envío de Carta de Presentación-Aceptación" :migas="['Servicio social' => null]" />
        <!-- Modal de mensaje -->
        <x-panel.modal id="modal_mensaje" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="modal_mensaje_titulo">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modal_mensaje_titulo">Carta de Presentación-Aceptación</h4>
            </div>
            <div class="tw-modal-cuerpo">
                @if($estado_servicio == 0)
                  <x-panel.alerta tipo="error" data-panel-mensaje>No se encontró ningún registro.</x-panel.alerta>
                    @elseif($estado_servicio == 1 && $estado_carta == 0)
                    <x-panel.alerta tipo="error" data-panel-mensaje>Para realizar este tramite, tus documentos de la primera etapa deben estar autorizados y el Departamento de Servicio Social y Residencia Profesional debe enviarte tu Carta de Presentación-Aceptación. .</x-panel.alerta>
                @elseif($estado_servicio == 2 && $estado_carta == 1)
                    <x-panel.alerta tipo="error" data-panel-mensaje>Tus documentos de la primera etapa ya se encuentran autorizados, Para realizar este tramite el Departamento de Servicio Social y Residencia Profesional debe enviarte tu Carta de Presentación-Aceptación.</x-panel.alerta>
                @elseif($estado_servicio == 2 && $estado_carta == 2)
                    <x-panel.alerta tipo="error" data-panel-mensaje>Tus documentos de la primera etapa ya se encuentran autorizados, Para realizar este tramite el Departamento de Servicio Social y Residencia Profesional debe enviarte tu Carta de Presentación-Aceptación.</x-panel.alerta>
                @elseif($estado_servicio == 2 && $estado_carta == 4)
                    <x-panel.alerta tipo="exito" data-panel-mensaje>Tu Carta de Presentación-Aceptación se envío correctamente al Departamento de Servicio Social y Residencia Profesional</x-panel.alerta>
                @elseif($estado_servicio == 2 && $estado_carta == 5)
                    <x-panel.alerta tipo="exito" data-panel-mensaje>Tu Carta de Presentación-Aceptación se encuentra Autorizada por el Departamento de Servicio Social y Residencia Profesional</x-panel.alerta>


                @endif
            </div>
            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
            </div>
        </x-panel.modal>



    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#modal_mensaje").modal("show");

            $("#guardar_carta_presentacion_estado").click(function (event) {
                var pdf_documento_carta_alumno = $("#ls_pdf_documento_carta_alumno").val();

                var ls=pdf_documento_carta_alumno.length;


                //TNotify.alert(ls);
                if(ls > 0){
                    $("#guardar_carta_presentacion").submit();
                    $("#guardar_carta_presentacion_estado").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresar tu Carta de Presentación-Aceptación",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });


        });
    </script>

</div>
@endsection