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
                    <li class="active"><a href="#">Enviar Carta de Presentación</a></li>
                    <li>
                        <a href="{{ url('/servicio_social/proceso_modificacion_cartapresentacion/departamento/' ) }}" >En proceso de Modificación</a>
                    </li>
                    <li>
                        <a href="{{ url('/servicio_social/proceso_revicion_cartapresentacion/departamento/' ) }}" >Estudiantes para Revisión Carta P.</a>
                    </li>
                    <li>
                        <a href="{{ url('/servicio_social/proceso_autorizadas_cartapresentacion/departamento/' ) }}" >Cartas de presentación Autorizadas</a>
                    </li>



                </ul>

                <div class="tab-content tw:w-full">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tabla_enviar_costancia">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CARRERA</th>
                                    <th>REGISTRAR CARTA PRESENTACIÓN</th>
                                    <th>ENVIAR CARTA PRESENTACIÓN</th>


                                </tr>
                                </thead>
                                <tbody>

                                @foreach($autorizados as $autorizados)
                                    <tr>
                                        <th>{{$autorizados->cuenta}}</th>
                                        <td>{{$autorizados->nombre}} {{$autorizados->apaterno}} {{$autorizados->amaterno}}</td>
                                        <td>{{$autorizados->carrera}}</td>
                                        @if($autorizados->id_estado_presentacion == 0)
                                        <td class="tw:text-center"><button  id="{{ $autorizados->id_datos_alumnos }}" class="registrar_presentacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-plus"></i></button></td>
                                            <td></td>
                                        @elseif($autorizados->id_estado_presentacion == 1)
                                            <td class="tw:text-center"><button  id="{{ $autorizados->id_datos_alumnos }}" class="modificar_presentacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-pencil-square-o"></i></button>
                                                <button  id="{{ $autorizados->id_datos_alumnos }}" class="ver_presentacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-file"></i></button></td>
                                            <td><button  id="{{ $autorizados->id_datos_alumnos }}" class="enviar_presentacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Enviar</button></td>


                                        @endif
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


   <x-panel.modal id="modal_registrar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Registrar  Carta de Presentación-Aceptación del Estudiante</h4>
                    </div>
                    <div id="contenedor_registrar">


                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button   type="button" id="reg_pre" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >guardar</button>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                         <p></p>   </div>
                    </div>

                </x-panel.modal>
        {{--fin autorizar--}}

        <x-panel.modal id="modal_modificar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar  Carta de Presentación-Aceptación del Estudiante</h4>
                    </div>
                    <div id="contenedor_modificar">


                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button   type="button" id="modificar_carta" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <p></p>   </div>
                    </div>

                </x-panel.modal>
        {{--fin autorizar--}}
        <x-panel.modal id="modal_ver" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Ver  Carta de Presentación-Aceptación del Estudiante</h4>
                    </div>
                    <div id="contenedor_ver">


                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <p></p>   </div>
                    </div>

                </x-panel.modal>
        <x-panel.modal id="enviar_peresentacion" tamano="sm" sin-relleno clase-cerrar="close">
                    <form method="POST" id="enviar_doc_carta" action="{{ url("/servicio_social/enviar_carta_presentacion/") }}">
                        @csrf
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Enviar Carta de Presentación-Aceptación al Estudiante</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <input type="hidden" id="id_datos_alumnos_m" name="id_datos_alumnos_m" value="">
                            <p>¿Seguro que quieres, enviar el documento?</p>
                        </div>
                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  id="enviar_carta_presentacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </x-panel.modal>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#tabla_enviar_costancia').on('click','.registrar_presentacion',function(){
                var id_datos_alumnos=$(this).attr('id');
                       // TNotify.alert(id_datos_alumnos);
                $.get('/servicio_social/registrar_constancia/departamento/'+id_datos_alumnos,function(request){
                    $('#contenedor_registrar').html(request);
                    $('#modal_registrar').modal('show');
                });
            });
            $("#reg_pre").click(function (event) {
                var pdf_documento_carta = $("#pdf_documento_carta").val();
                var id_periodo = $("#id_periodo").val();

                var ls=pdf_documento_carta.length;
                var l=id_periodo.length;

                //TNotify.alert(ls);
               if(ls > 0 && l > 0 ){
                   $("#formulario_carta_presentacion").submit();
                   $("#reg_pre").attr("disabled", true);
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
            $('#tabla_enviar_costancia').DataTable();
            $('#tabla_enviar_costancia').on('click','.modificar_presentacion',function(){
                var id_datos_alumnos=$(this).attr('id');
                // TNotify.alert(id_datos_alumnos);
                $.get('/servicio_social/modificar_carta_presentacion/'+id_datos_alumnos,function(request){
                    $('#contenedor_modificar').html(request);
                    $('#modal_modificar').modal('show');
                });
            });
            $("#modificar_carta").click(function (event) {
                var pdf_documento_carta = $("#pdf_documento_carta").val();
                var id_periodo = $("#id_periodo").val();

                var ls=pdf_documento_carta.length;
                var l=id_periodo.length;

                //TNotify.alert(ls);
                if(ls > 0 && l > 0 ){
                    $("#formulario_modificar_carta_presentacion").submit();
                    $("#modificar_carta").attr("disabled", true);
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
            $('#tabla_enviar_costancia').on('click','.ver_presentacion',function(){
                var id_datos_alumnos=$(this).attr('id');
                 //TNotify.alert(id_datos_alumnos);
                $.get('/servicio_social/ver_carta_presentacion/'+id_datos_alumnos,function(request){
                    $('#contenedor_ver').html(request);
                    $('#modal_ver').modal('show');
                });
            });
            $('#tabla_enviar_costancia').on('click','.enviar_presentacion',function(){
                var id_datos_alumnos=$(this).attr('id');
                //TNotify.alert(id_datos_alumnos);
                $('#id_datos_alumnos_m').val(id_datos_alumnos);
                    $('#enviar_peresentacion').modal('show');

            });



            $("#enviar_carta_presentacion").click(function (event) {

                    $("#enviar_doc_carta").submit();
                    $("#enviar_carta_presentacion").attr("disabled", true);
            });
        });
    </script>
</div>
@endsection