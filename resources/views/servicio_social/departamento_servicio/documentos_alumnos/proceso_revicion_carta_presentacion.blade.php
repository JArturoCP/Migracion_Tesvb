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
                    <li class="active"><a href="#">Estudiantes para Revisión Carta P.</a>
                    </li>
                    <li>
                        <a href="{{ url('/servicio_social/proceso_autorizadas_cartapresentacion/departamento/' ) }}" >Cartas de presentación Autorizadas</a>
                    </li>



                </ul>

                <div class="tab-content tw:w-full">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class="tw:w-full tw:lg:w-full tw:px-2">

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
                                    <th>AUTORIZACIÓN</th>


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
                                        <td><button  id="{{$alumno["id_datos_alumnos"] }}" class="autorizar_carta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Autorizar</button><br>
                                            <br><button  id="{{$alumno["id_datos_alumnos"] }}" class="rechazar_carta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Rechazar</button></td>

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

        <x-panel.modal id="modal_autorizar_carta" tamano="sm" sin-relleno clase-cerrar="close">
                    <form method="POST" id="form_autorizar" action="{{ url("/servicio_social/autorizar_cartapresentacionalumno/alumno/") }}">
                        {{ csrf_field() }}
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Autorización de la Carta de Presentación-Aceptación al Estudiante</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <input type="hidden" id="id_dat" name="id_dat" value="">
                            <p>¿Seguro que quieres autorizar la Carta de Presentación-Aceptación del Estudiante?</p>
                        </div>
                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  id="autorizar_carta_alumno" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </x-panel.modal>

        <x-panel.modal id="modal_rechazar_carta" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Rechazar la Carta de Presentación-Aceptación del Estudiante</h4>
                    </div>
                    <div id="contenedor_rechazar_carta">


                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  id="rech_carta_presentacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar</button>
                    </div>
                </x-panel.modal>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#tabla_revicion_costancia').on('click','.autorizar_carta',function(){
                var id_datos_alumnos=$(this).attr('id');
                $('#id_dat').val(id_datos_alumnos);
                $("#modal_autorizar_carta").modal('show');
                
            });
            $("#autorizar_carta_alumno").click(function (event) {
                $("#form_autorizar").submit();
                $("#autorizar_carta_alumno").attr("disabled", true);
            });
            $('#tabla_revicion_costancia').DataTable();
            $('#tabla_revicion_costancia').on('click','.rechazar_carta',function(){
                var id_datos_alumnos=$(this).attr('id');
                // TNotify.alert(id_datos_alumnos);
                $.get('/servicio_social/rechazar_cartapresentacionalumno/'+id_datos_alumnos,function(request){
                    $('#contenedor_rechazar_carta').html(request);
                    $('#modal_rechazar_carta').modal('show');
                });
            });
            $("#rech_carta_presentacion").click(function (event) {
                var comentario_carta = $('#comentario_carta').val();
                var s=comentario_carta.length;
                 if(s> 0){
                     $("#form_rechar_carta_presentcion").submit();
                     $("#rech_carta_presentacion").attr("disabled", true);
                 }else{

                     swal({
                         position: "top",
                         type: "error",
                         title: "Hay un campo no seleccionado en el formulario",
                         showConfirmButton: false,
                         timer: 3500
                     });
                 }
            });


        });
    </script>
</div>
@endsection