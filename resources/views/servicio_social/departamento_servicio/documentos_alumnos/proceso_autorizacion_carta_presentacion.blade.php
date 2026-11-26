@extends('layouts.panel')
@section('title', 'Servicio Social')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main>
        <x-panel.encabezado titulo="Carta de Presentación-Aceptación" :migas="['Servicio social' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            

            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
                <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li><a href="{{ url('/servicio_social/ingresar_contancia/departamento/' ) }}" >Enviar Carta de Presentación</a></li>
                    <li>
                        <a href="{{ url('/servicio_social/proceso_modificacion_cartapresentacion/departamento/' ) }}" >En proceso de Modificación</a>
                    </li>
                    <li>
                        <a href="{{ url('/servicio_social/proceso_revicion_cartapresentacion/departamento/' ) }}" >Estudiantes para Revisión Carta P.</a>
                    </li>
                    <li class="active"><a href="#">Cartas de presentación Autorizadas</a>
                    </li>



                </ul>

                <div class="tab-content tw:w-full">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            </br>
                            <button   class="ver_datos_excel tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Exportar datos</button>
                            </br><p></p>

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tabla_revicion_costancia">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CARRERA</th>
                                    <th>CORREO ELECTRONICO</th>
                                    <th>NOMBRE DEL PERIODO</th>
                                    <th>VER</th>



                                </tr>
                                </thead>
                                <tbody>

                                @foreach($alumnos as $alumno)
                                    <tr>
                                        <th>{{$alumno["cuenta"]}}</th>
                                        <td>{{$alumno["nombre"]}} </td>
                                        <td>{{$alumno["carrera"]}}</td>
                                        <td>{{$alumno["correo_electronico"]}}</td>
                                        <td>{{$alumno["nombre_periodo"]}}</td>
                                        <td><a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" target="_blank" href="{{asset('/servicio_social_pdf/carta_presentacion/'.$alumno["pdf_constancia_presentacion"])}}"><i class="fa fa-file"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <x-panel.modal id="modal_seleccion_periodo" tamano="sm" sin-relleno clase-cerrar="close">
                    <form method="POST" id="form_autorizar" action="{{ url("/servicio_social/exportar_datos_servicio_social") }}">
                        {{ csrf_field() }}
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Seleccionar periodo para exportar datos</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <label for="nombre_proyecto">Seleccionar el Periodo<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_periodo" name="id_periodo" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($periodos as $periodos)
                                            <option value="{{$periodos->id_periodo}}"> {{$periodos->periodo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                    </form>
                </x-panel.modal>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tabla_revicion_costancia').DataTable();
                $(".ver_datos_excel").click(function (event) {
                    $("#modal_seleccion_periodo").modal('show');
                });


            });
        </script>

    </main>

</div>
@endsection