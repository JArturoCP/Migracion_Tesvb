
@extends('layouts.panel')
@section('title', 'Registrar Anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Generar anteproyecto" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4">
                            <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                                @if($registro_proy ==0)
                                    <li class="active"><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:bg-brand-50 tw:text-brand-500" href="#">Portada</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje">Objetivos</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje1">Alcances</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje2">Justificación</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje3">Marco teórico</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50"   id="mensaje4">Cronograma</a></li>

                                @else
                                    <li class="active"><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:bg-brand-50 tw:text-brand-500" href="#">Portada</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/objetivos')}}">Objetivos</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/alcances')}}">Alcances</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/justificacion')}}">Justificación</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/marco_teorico')}}">Marco teórico</a></li>
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/cronograma')}}">Cronograma</a></li>

                                @endif
                            </ul>
                            <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">

                                <div  class="tab-pane">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <form role="form" method="POST" id="form_portada" >
                                            {{ csrf_field() }}
                                            <div class="tw:p-5 tw:sm:p-6">
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                        <div class="tw:mb-4">
                                                            <label for="nombre_proyecto">NOMBRE DEL RESIDENTE</label>
                                                            <p>{{$nombres->nombre}} {{$nombres->apaterno}} {{$nombres->amaterno}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                        <div class="tw:mb-4">
                                                            <input type="hidden" id="sin_proyecto" name="sin_proyecto" value="{{ $sin_proyecto }}">
                                                            <label for="exampleInputEmail1">PROYECTO:</label>
                                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="tipo_proy" name="tipo_proy" readonly required>
                                                                @foreach($tipo_proyecto as $tipo_proyecto)
                                                                        <option value="{{$tipo_proyecto->id_tipo_proyecto}}" selected="selected">{{$tipo_proyecto->descripcion}}</option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                        <div class="tw:mb-4">
                                                            <label for="nombre_proyecto">NOMBRE DEL PROYECTO</label>
                                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="nombre_proyecto" name="nombre_proyecto" rows="3" placeholder="Ingresa el nombre del proyecto, no se aceptan comillas, ni caracteres " required>{{ $nombre }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($enviado_anteproyecto==0)
                                                    @if($sin_proyecto == 0)
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:px-2">
                                                        <button id="guardar_solicitud" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>
                                                    </div>
                                                </div>
                                                    @else
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:px-2">
                                                                <button id="modificar_solicitud" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @else
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:px-2">
                                                            <button id="modificar_solicitud" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" disabled>Guardar</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>

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

                    <p class="tw:text-center">Primero, completa la portada.</p>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>

                </div>
            </x-panel.modal>

    <script type="text/javascript">
        $(document).ready( function() {
            $("#guardar_solicitud").click(function(event){
                var nombre_proyecto = $("#nombre_proyecto").val();
                if (nombre_proyecto != "") {
                    $("#guardar_solicitud").attr("disabled", true);
                    $("#form_portada").submit();
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
            $("#modificar_solicitud").click(function(event){
                var nombre_proyecto = $("#nombre_proyecto").val();
                if (nombre_proyecto != "") {
                    $("#modificar_solicitud").attr("disabled", true);
                    $("#form_portada").submit();
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
        });
    </script>
</div>
@endsection
