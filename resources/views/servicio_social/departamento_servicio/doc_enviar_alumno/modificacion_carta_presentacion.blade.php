@extends('layouts.panel')
@section('title', 'Servicio Social')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main>
        <x-panel.encabezado titulo="Envío de Carta de Presentación-Aceptación" :migas="['Servicio social' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">Descargar  Carta de Presentación-Aceptación</div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <p> NO. CUENTA: <b>{{ $carta_presentacion[0]->cuenta }}</b></p>
                        <p> NOMBRE DEL ESTUDIANTE: <b>{{ $carta_presentacion[0]->nombre }}</b> <b>{{ $carta_presentacion[0]->apaterno }}</b> <b>{{ $carta_presentacion[0]->amaterno }}</b></p>
                        <label>Descargar  Carta de Presentación-Aceptación</label>
                        <a  target="_blank" href="{{asset('/servicio_social_pdf/carta_presentacion/'.$carta_presentacion[0]->pdf_constancia_presentacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-file"></i></a>

                    </div>
                </div>
            </div>
        </div>

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">Modifcar la  Carta de Presentación-Aceptación</div>
                        <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Comentario: {{$carta_alumno_presentacion[0]->comentario_departamento}} </h3>
                                </div>
                            </div>
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Ver PDF</th>
                                    <th>Modificar PDF</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Carta de Presentación-Aceptación</td>
                                    <td><a  target="_blank" href="{{asset('/servicio_social_pdf/carta_presentacion/'.$carta_alumno_presentacion[0]->pdf_carta_presentacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-pencil em56"></i></a></td>
                                    <td><button  id="{{ $carta_alumno_presentacion[0]->id_alumno }}" class="modificar_alumno_carta_presentacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-pencil-square-o em56"></i></button></td>

                                </tr>

                                </tbody>
                            </table>
</div>
                        </div>
                    </div>

                </div>
                <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p></p>
                    </div>
                </div>
                <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" title="Enviar " data-toggle="modal" data-target="#enviar_cp_a">Enviar Carta de Presentación-Aceptación</button>

                    </div>
                </div>
                <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p></p>
                    </div>
                </div>
            </div>
            {{---enviar--}}
            <x-panel.modal id="enviar_cp_a" tamano="sm" sin-relleno clase-cerrar="close">
                        <form method="POST" id="enviar_cart_p" action="{{ url("/servicio_social/enviar_cartapresentacionalumno/alumno/{$datos_alumnos[0]->id_datos_alumnos}") }}">
                            @csrf
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Enviar Carta de Presentación-Aceptación</h4>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <p>¿Seguro que quieres, enviar tu Carta de Presentación-Aceptación al Departamento de Servicio Social y Residencia Profesional para su revisión?</p>
                            </div>
                        </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="car_presentacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                        </div>
                    </x-panel.modal>
            {{---enviar--}}
            <x-panel.modal id="modal_modificar_carta_alumno" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Carta de Presentación-Aceptación</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <form id="formulario_modificar_carta_presentacion_alumno" action="{{url("/servicio_social/modificar_cartapresentacionalumno/alumno/")}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <label>Modificar pdf</label>
                                    <input type="hidden"  id="id_al" name="id_al" value=" "   required/>
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="mod_pdf_documento_carta_alumno" name="mod_pdf_documento_carta_alumno" type="file"   accept="application/pdf" required/>
                                </form>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p></p>   </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button   type="button" id="modificar_carta_alumno" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p></p>   </div>
                        </div>

                    </x-panel.modal>



    </main>
    <script type="text/javascript">
        $(document).ready(function() {

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

            $(".modificar_alumno_carta_presentacion").click(function (event) {
                var id_constancia_presentacion_alumno=$(this).attr('id');
                $('#id_al').val(id_constancia_presentacion_alumno);
                $("#modal_modificar_carta_alumno").modal('show');


            });
            $("#modificar_carta_alumno").click(function (event) {
                var mod_pdf_documento_carta_alumno = $("#mod_pdf_documento_carta_alumno").val();


                var ls=mod_pdf_documento_carta_alumno.length;


                //TNotify.alert(ls);
                if(ls > 0 ){
                    $("#formulario_modificar_carta_presentacion_alumno").submit();
                    $("#modificar_carta_alumno").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "hay un campo vacio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#car_presentacion").click(function (event) {

                $("#enviar_cart_p").submit();
                $("#car_presentacion").attr("disabled", true);
            });
        });
    </script>

</div>
@endsection