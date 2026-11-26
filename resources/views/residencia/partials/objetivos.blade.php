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
                            <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/portada')}}">Portada</a></li>
                                <li class="active"><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:bg-brand-50 tw:text-brand-500" href="#">Objetivos</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/alcances')}}">Alcances</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/justificacion')}}">Justificación</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/marco_teorico')}}">Marco Teorico</a></li>
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" href="{{url('/residencia/anteproyecto/cronograma')}}">Cronograma</a></li>
                            </ul>
                            <div class="tw:w-full tw:lg:w-8/12 tw:lg:grow tw:px-2">

                                <div  class="tab-pane">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <form role="form" method="POST" id="form_objetivos" >
                                            {{ csrf_field() }}
                                            <div class="tw:p-5 tw:sm:p-6">
                                                <input type="hidden" id="sin_objetivos" name="sin_objetivos" value="{{ $sin_objetivos }}">
                                                @if($sin_objetivos==0)
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                            <div class="tw:mb-4">
                                                                <label for="objetivo_general">OBJETIVO GENERAL</label>
                                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="objetivo_general" name="objetivo_general" rows="10" placeholder="Ingresa el Objetivo General " required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                            <div class="tw:mb-4">
                                                                <label for="objetivo_especifico">OBJETIVOS ESPECIFICOS</label>
                                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="objetivo_especifico" name="objetivo_especifico" rows="10" placeholder="Ingresa los Objetivos Especificos " required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($sin_objetivos==1)
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                            <div class="tw:mb-4">
                                                                <label for="objetivo_general">OBJETIVO GENERAL</label>
                                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="objetivo_general" name="objetivo_general" rows="10" placeholder="Ingresa el Objetivo General " required>{{ $objetivo_general }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                            <div class="tw:mb-4">
                                                                <label for="objetivo_especifico">OBJETIVOS ESPECIFICOS</label>
                                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="objetivo_especifico" name="objetivo_especifico" rows="10" placeholder="Ingresa los Objetivos Especificos " required>{{ $objetivo_especifico }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                                @if($enviado_anteproyecto==0)
                                                    @if($sin_objetivos==0)
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:px-2">
                                                        <button id="guardar_objetivos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>

                                                    </div>
                                                </div>
                                                    @else
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:px-2">
                                                                <button id="modificar_objetivos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>

                                                            </div>
                                                        </div>
                                                        @endif
                                                    @else
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:px-2">
                                                            <button id="guardar_objetivos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" disabled>Guardar</button>

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
        </div></div>
    
    <script  type="text/javascript">
        $(document).ready( function() {
            $("#guardar_objetivos").click(function(event){
                var objetivo_general = $("#objetivo_general").val();
                var objetivo_especifico = $("#objetivo_especifico").val();
                if (objetivo_general != "" && objetivo_especifico != "" ) {
                    $("#guardar_objetivos").attr("disabled", true);
                    $("#form_objetivos").submit();
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
            $("#modificar_objetivos").click(function(event){
                var objetivo_general = $("#objetivo_general").val();
                var objetivo_especifico = $("#objetivo_especifico").val();
                if (objetivo_general != "" && objetivo_especifico != "" ) {
                    $("#modificar_objetivos").attr("disabled", true);
                    $("#form_objetivos").submit();
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

        });
    </script>
</div>
@endsection