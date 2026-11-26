@extends('layouts.panel')
@section('title', 'Servicio Social')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main>
        <x-panel.encabezado titulo="Revisión de Documentación Primera Etapa" :migas="['Servicio social' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            

            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">



                <!-- Nav tabs -->
                <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800" role="tablist">
                    <li role="presentation" class="active"><a href="#uno" aria-controls="home" role="tab" data-toggle="tab">Autorizar Documentación</a></li>
                    <li role="presentation"><a href="#dos" aria-controls="dos" role="tab" data-toggle="tab">En proceso de Modificación</a></li>
                  <li role="presentation"><a href="#tres" aria-controls="dos" role="tab" data-toggle="tab">Estudiantes con Documentación Autorizada</a></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content tw:w-full">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="autorizar_servicio">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CORREO ELECTRONICO</th>
                                    <th>CARRERA</th>
                                    <th>TIPO DE EMPRESA</th>
                                    <th>FECHA DE REGISTRO</th>
                                    <th>AUTORIZAR</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($autorizaciones as $autorizaciones)
                                    <tr>
                                        <th>{{$autorizaciones->cuenta}}</th>
                                        <td>{{$autorizaciones->nombre}} {{$autorizaciones->apaterno}} {{$autorizaciones->amaterno}}</td>
                                        <td>{{$autorizaciones->correo_electronico}}</td>
                                        <td>{{$autorizaciones->carrera}}</td>
                                        <td>{{$autorizaciones->tipo_empresa}}</td>
                                        <td>{{$autorizaciones->fecha_registro}}</td>
                                        @if($autorizaciones->id_estado_enviado ==1)
                                        <td><button  id="{{ $autorizaciones->id_datos_alumnos }}" class="autorizacion_docuemntos tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-pencil-square-o em56"></i></button></td>
                                    @else
                                            <td><button  id="{{ $autorizaciones->id_datos_alumnos }}" class="autorizacion_documentos_modificaciones tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-pencil-square-o em56"></i></button></td>

                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dos">
                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="modificar_servicio">
                                <thead>
                                <tr>
                                    <th>NO. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CORREO ELECTRONICO</th>
                                    <th>CARRERA</th>
                                    <th>TIPO DE EMPRESA</th>


                                </tr>
                                </thead>
                                <tbody>

                                @foreach($modificaciones as $modificaciones)
                                    <tr>
                                        <th>{{$modificaciones->cuenta}}</th>
                                        <td>{{$modificaciones->nombre}} {{$modificaciones->apaterno}} {{$modificaciones->amaterno}}</td>
                                        <td>{{$modificaciones->correo_electronico}}</td>
                                        <td>{{$modificaciones->carrera}}</td>
                                        <td>{{$modificaciones->tipo_empresa}}</td>
                                      </tr>
                                @endforeach



                                </tbody>
                            </table>
</div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="tres">
                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="documentacion_autorizada">
                                <thead>
                                <tr>
                                    <th>NO. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CORREO ELECTRONICO</th>
                                    <th>CARRERA</th>
                                    <th>TIPO DE EMPRESA</th>
                                    <th>FECHA REGISTRO</th>
                                    <th>VER DOCUMENTACIÓN</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($autorizados as $autorizados)
                                    <tr>
                                        <th>{{$autorizados->cuenta}}</th>
                                        <td>{{$autorizados->nombre}} {{$autorizados->apaterno}} {{$autorizados->amaterno}}</td>
                                        <td>{{$autorizados->correo_electronico}}</td>
                                        <td>{{$autorizados->carrera}}</td>
                                        <td>{{$autorizados->tipo_empresa}}</td>
                                        <td>{{$autorizados->fecha_registro}}</td>
                                        <td><button  id="{{ $autorizados->id_datos_alumnos }}" class="documentacion_autorizada tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Mostrar</button></td>

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
        {{--autorizar documentos--}}
        <x-panel.modal id="modal_autorizar_documentos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorización de Documentación Primera Etapa</h4>
                        </div>
                        <div id="contenedor_autorizar_docuementos">


                        </div>

                </x-panel.modal>
        {{--fin autorizar--}}

        {{--autorizar documentos con modificaciones--}}
        <x-panel.modal id="modal_autorizar_documentos_modificaciones" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorización de Documentación Primera Etapa</h4>
                    </div>
                    <div id="contenedor_autorizar_docuementos_modificaciones">


                    </div>


                </x-panel.modal>
        {{--fin autorizar--}}
        {{--autorizado documentos --}}
        <x-panel.modal id="modal_autorizado_documentos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Documentación Primera Etapa</h4>
                    </div>
                    <div id="contenedor_autorizar_documentos">


                    </div>


                </x-panel.modal>
        {{--fin autorizar--}}

    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#autorizar_servicio').DataTable(  );
            $('#modificar_servicio').DataTable(  );
            $('#documentacion_autorizada').DataTable(  );
        });
        $("#autorizar_servicio").on('click','.autorizacion_docuemntos',function(){
            var id_datos_alumnos=$(this).attr('id');
            $.get("/servicio_social/autorizacion_documentacion/"+id_datos_alumnos,function(request){
                $("#contenedor_autorizar_docuementos").html(request);
                $("#modal_autorizar_documentos").modal('show');
            });

        });
        $("#autorizar_servicio").on('click','.autorizacion_documentos_modificaciones',function(){
            var id_datos_alumnos=$(this).attr('id');
            $.get("/servicio_social/autorizacion_documentacion_modifcaciones/"+id_datos_alumnos,function(request){
                $("#contenedor_autorizar_docuementos_modificaciones").html(request);
                $("#modal_autorizar_documentos_modificaciones").modal('show');
            });
        });
        $("#documentacion_autorizada").on('click','.documentacion_autorizada',function(){
            var id_datos_alumnos=$(this).attr('id');
            $.get("/servicio_social/autorizada_documentacion_serv/"+id_datos_alumnos,function(request){
                $("#contenedor_autorizar_documentos").html(request);
                $("#modal_autorizado_documentos").modal('show');
            });
        })

    </script>
</div>
@endsection