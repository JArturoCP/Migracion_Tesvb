@extends('layouts.panel')
@section('title', 'Corregir Anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Enviar Anterpoyecto" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                <div class="tw:w-full tw:px-2 tw:text-center">
                                    <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('/residencia/anteproyecto/corregir_cronograma')}}"><span class="fa fa-arrow-left" aria-hidden="true"></span> Atras</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($modificar == 3)
                        <!-- Modal de mensaje -->
                        <x-panel.modal id="modal_mensaje" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="modal_mensaje_titulo">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modal_mensaje_titulo">Anteproyecto</h4>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <x-panel.alerta tipo="exito" data-panel-mensaje>Tu anteproyecto fue aceptado, registra tu empresa y ya puedes imprimir tu dictamen de anteproyecto</x-panel.alerta>
                            </div>
                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
                            </div>
                        </x-panel.modal>
                  @else


                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <button type="button" class="enviar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $id_anteproyecto }}" title="Enviar">Enviar Anteproyecto</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- enviar anteproyecto -->
    <x-panel.modal id="modal_enviar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form id="form_enviar_anteproyecto" action="{{url("/residencia/enviar_anteproyecto_corregido/")}}" method="POST" role="form" >
                    <div class="tw-modal-cuerpo tw:pt-14">

                        {{ csrf_field() }}
                        ¿Realmente deseas deseas enviar tu anteproyecto?
                        <input type="hidden" id="id_anteproyecto" name="id_anteproyecto" value="">
                    </div>
                </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="enviar_anteproyecto" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                    </div>

            </x-panel.modal>
    <script type="text/javascript">

        $(document).ready( function() {
            $(".modificar_actividad").click(function (event) {
                var id_cronograma=$(this).attr('id');
                $.get("/residencia/anteproyecto/cronograma/modificar_actividad/"+id_cronograma,function(request){
                    $("#contenedor_modificar_actividad").html(request);
                    $("#modal_modificar_actividad").modal('show');
                });
            });

            $(".enviar").click(function (event) {
                var id=$(this).attr('id');
                $('#id_anteproyecto').val(id);
                $('#modal_enviar').modal('show');
            });
            $("#enviar_anteproyecto").click(function (){
                $("#enviar_anteproyecto").attr("disabled", true);
                $("#form_enviar_anteproyecto").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Envio correctamente",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
            @if($modificar == 3)
            $("#modal_mensaje").modal("show");
            @else
            $(".enviar").first().trigger("click");
            @endif
        });





    </script>
</div>
@endsection