@extends('layouts.panel')
@section('title', 'Registrar Anteproyecto')
@include('partials.panel.recursos_app')
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
                               @if($registro_proy ==0)
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/portada')}}">Portada</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje">Objetivos</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje1">Alcances</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje2">Justificación</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje3">Marco Teorico</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje4">Cronograma</a></li>

                                @else
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/portada')}}">Portada</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/objetivos')}}">Objetivos</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/alcances')}}">Alcances</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/justificacion')}}">Justificación</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/marco_teorico')}}">Marco Teorico</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/cronograma')}}">Cronograma</a></li>

                                @endif
                                   </ul>
                               <div class="tab-content tw:w-full tw:lg:w-10/12 tw:px-2">
                                   @if($enviado_anteproyecto ==0)
                                   @if($registro_proy ==0)
                                   <div class="tab-pane fade in active tw:text-center">
                                       <div class="tw:w-full tw:px-2">
                                           <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800"  data-toggle="tab" >Seleccione rubro de Portada para registrar anteproyecto
                                           </label>
                                       </div>
                                   </div>
                                       @else
                                       @if($autorizar_proyecto==0)
                                           <div class="tab-pane fade in active tw:text-center">
                                               <div class="tw:w-full tw:px-2">
                                                   <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800"  data-toggle="tab" > Te falta llenar un apartado de tu anteproyecto, verifica.<br>
                                                       <button  type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar" disabled>Enviar Anteproyecto</button>
                                                   </label>
                                               </div>
                                           </div>
                                           @else
                                           <div class="tab-pane fade in active tw:text-center">
                                               <div class="tw:w-full tw:px-2">
                                                   <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800"  data-toggle="tab" >    <button type="button" class="enviar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{$reg_proy}}" title="Enviar">Enviar Anteproyecto</button>

                                                   </label>
                                               </div>
                                           </div>

                                           @endif

                                   @endif
                                       @else
                                       <div class="tab-pane fade in active tw:text-center">
                                           <div class="tw:w-full tw:px-2">
                                               <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800"  data-toggle="tab" > Tu proyecto ya fue enviado, ya no puedes hacer ninguna modificación de registro de anteproyecto.<br>
                                                 </label>
                                           </div>
                                       </div>

                                   @endif

                               </div>

                           </div>

                       </div>
               </div>
               </div>
                        </div>
                    </div>
    
    <!-- Mensaje de anteproyecto -->
    <x-panel.modal id="modal_verificar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <div class="tw-modal-cuerpo tw:pt-14">

                    <p class="tw:text-center">Primero se debe llenar el apartado de portada</p>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>

                </div>
            </x-panel.modal>
    <!-- enviar anteproyecto -->
    <x-panel.modal id="modal_enviar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form id="form_envio_anteproyecto" action="{{url("/residencia/anteproyecto/enviar/")}}" method="POST" role="form" >
                    <div class="tw-modal-cuerpo tw:pt-14">

                        {{ csrf_field() }}
                        ¿Realmente deseas deseas enviar tu anteproyecto?
                        <input type="hidden" id="id_anteproyecto" name="id_anteproyecto" value="">
                    </div>

                </form>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button id="confirma_elimina_oficio"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready( function() {
            $("#mensaje").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje1").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje2").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje3").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje4").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $(".enviar").click(function (event) {
                var id=$(this).attr('id');
                $('#id_anteproyecto').val(id);
                $('#modal_enviar').modal('show');
            });
            $("#confirma_elimina_oficio").click(function (){
                $("#confirma_elimina_oficio").attr("disabled", true);
                $("#form_envio_anteproyecto").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Envio exitoso",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
        });
    </script>
</div>
@endsection