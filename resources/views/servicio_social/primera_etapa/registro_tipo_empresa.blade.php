@extends('layouts.panel')
@section('title', 'Servicio social')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        @if($registro_servicio == 0)
        <x-panel.encabezado titulo="Registro de la primera etapa del servicio social" :migas="['Servicio social' => null]" />

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <form id="formulario_registrar_tipo" action="{{url("/servicio_social/registro_tipo_empresa/")}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="nombre_proyecto">Nombre del alumno:</label>
                                            <p>{{$alumno[0]->nombre}} {{$alumno[0]->apaterno}} {{$alumno[0]->amaterno}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="nombre_proyecto">Ingresa tu correo electronico. (En el se te notificará, el estado que se encuentra tu documentación, si tienes que corregir o se encuentra autorizada).<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="correo_electronico" name="correo_electronico" type="email"  placeholder="Ingresa tu correo electronico" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="exampleInputEmail1">La empresa donde llevaras a cabo tu servicio social es:<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="tipo_empresa" name="tipo_empresa" required>
                                                <option disabled selected hidden>Selecciona una opción</option>
                                                @foreach($tipos_empresas as $tipo_empresa)
                                                    <option value="{{$tipo_empresa->id_tipo_empresa}}" data-esta="{{$tipo_empresa->tipo_empresa}}">{{$tipo_empresa->tipo_empresa}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <button id="guardar_datos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                                    </div>
                                    </div>

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
            @else
            <x-panel.encabezado titulo="Documentos de la primera etapa del servicio social" :migas="['Servicio social' => null]" />
            @if($registro_tipo_empresa[0]->id_tipo_empresa == 1)
                @if($registro_tipo_empresa[0]->id_estado_enviado== 0)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                            <p><b>No. Cuenta: </b> {{$registro_tipo_empresa[0]->cuenta}}  <b>      Nombre del alumno:</b> {{$registro_tipo_empresa[0]->nombre}} {{$registro_tipo_empresa[0]->apaterno}} {{$registro_tipo_empresa[0]->amaterno}}</p>
                            <p><b>Correo electronico:</b> {{$registro_tipo_empresa[0]->correo_electronico}}  <b>     Tipo de empresa:</b> {{$registro_tipo_empresa[0]->tipo_empresa}}</p>
                            @if($verificacion_registro_empresa == 0)
                                <button class="modificar_datos_alumnos tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{$registro_tipo_empresa[0]->id_datos_alumnos}}"><i class="fa fa-cog "></i></button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <p class="tw:text-red-600 tw:dark:text-red-400"><b>Nota: El documento se deben escanear y guardar en un pdf legible</b></p>

                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                        <thead>
                                        <tr>
                                            <th>Nombre del documento</th>
                                            <th> Agregar o ver PDF</th>
                                            <th>Guardar o modificar PDF</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Carta de aceptación </td>
                                            @if($datos_empresa[0]->pdf_carta_aceptacion == "" )
                                                <td>
                                                    <form id="form_carta_aceptacion" action="{{url("/servicio_social/registrar_carta_aceptacion/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                        {{ csrf_field() }}
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="carta_aceptacion" name="carta_aceptacion" type="file"   accept="application/pdf" required/>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button  id="guardar_carta_aceptacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else

                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_carta_aceptacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_carta_aceptacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Anexo Tecnico </td>
                                            @if($datos_empresa[0]->pdf_anexo_tecnico == "" )
                                                <form id="form_anexo_tecnico" action="{{url("/servicio_social/registrar_anexo_tecnico/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="anexo_tecnico" name="anexo_tecnico" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>

                                                <td>
                                                    <button  id="guardar_anexo_tecnico" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_anexo_tecnico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_anexo_tecnico"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td>Copia de tu CURP</td>
                                            @if($datos_empresa[0]->pdf_curp == "" )
                                                <form id="form_curp" action="{{url("/servicio_social/registrar_curp/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="curp" name="curp" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_curp" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_curp)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_curp"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td>Copia de tu Carnet</td>
                                            @if($datos_empresa[0]->pdf_carnet == "" )
                                                <form id="form_carnet" action="{{url("/servicio_social/registrar_carnet/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="carnet" name="carnet" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_carnet" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_carnet)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_carnet"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Constancia original del 50% de creditos</td>
                                            @if($datos_empresa[0]->pdf_constancia_creditos == "" )
                                                <form id="form_costancia_creditos" action="{{url("/servicio_social/registrar_costancia_creditos/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="costancia_creditos" name="costancia_creditos" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_costancia_creditos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_constancia_creditos)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_costancia_creditos"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Solicitud de registro de autorización</td>
                                            @if($datos_empresa[0]->pdf_solicitud_reg_autori == "" )
                                                <form id="form_solicitud_registro" action="{{url("/servicio_social/registrar_solicitud_registro/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="solicitud_registro" name="solicitud_registro" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_solicitud_registro" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_solicitud_reg_autori)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_solicitud_registro"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif

                                        </tr>

                                        </tbody>
                                    </table>
</div>

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                            <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" title="Eliminar registro" data-toggle="modal" data-target="#eliminar_empresa_privada"><i class="fa fa-trash em56"></i></button>
                                        </div>
                                        @if($datos_empresa[0]->pdf_carta_aceptacion !=" " && $datos_empresa[0]->pdf_anexo_tecnico != "" && $datos_empresa[0]->pdf_curp != "" && $datos_empresa[0]->pdf_carnet != "" && $datos_empresa[0]->pdf_constancia_creditos != "" && $datos_empresa[0]->pdf_solicitud_reg_autori != ""  )
                                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar documentacion" data-toggle="modal" data-target="#enviar_registro_servicio">Enviar documentación</button>

                                            </div>
                                        @endif
                                    </div>




                                </div>
                            </div>

                        </div>
                    </div>
                @elseif($registro_tipo_empresa[0]->id_estado_enviado== 1)
                    <x-panel.alerta tipo="exito" class="tw:mb-4">Se envió correctamente la documentación al Departamento del Servicio Social y Residencia.</x-panel.alerta>
                    @endif
                @endif
            @if($registro_tipo_empresa[0]->id_tipo_empresa == 2)
                @if($registro_tipo_empresa[0]->id_estado_enviado== 0)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <p class="tw:text-red-600 tw:dark:text-red-400"><b>Nota: El documento se deben escanear y guardar en un pdf legible</b></p>

                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                        <thead>
                                        <tr>
                                            <th>Nombre del documento</th>
                                            <th> Agregar o ver PDF</th>
                                            <th>Guardar o modificar PDF</th>

                                        </tr>
                                        </thead>
                                        <tbody>


                                        <tr>
                                            <td>Copia de tu CURP</td>
                                            @if($datos_empresa[0]->pdf_curp == "" )
                                                <form id="form_curp" action="{{url("/servicio_social/registrar_curp/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="curp" name="curp" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_curp" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_curp)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_curp"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td>Copia de tu Carnet</td>
                                            @if($datos_empresa[0]->pdf_carnet == "" )
                                                <form id="form_carnet" action="{{url("/servicio_social/registrar_carnet/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="carnet" name="carnet" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_carnet" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_carnet)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_carnet"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Constancia original del 50% de creditos</td>
                                            @if($datos_empresa[0]->pdf_constancia_creditos == "" )
                                                <form id="form_costancia_creditos" action="{{url("/servicio_social/registrar_costancia_creditos/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="costancia_creditos" name="costancia_creditos" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_costancia_creditos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_constancia_creditos)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_costancia_creditos"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Solicitud de registro de autorización</td>
                                            @if($datos_empresa[0]->pdf_solicitud_reg_autori == "" )
                                                <form id="form_solicitud_registro" action="{{url("/servicio_social/registrar_solicitud_registro/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <td>
                                                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"   id="solicitud_registro" name="solicitud_registro" type="file"   accept="application/pdf" required/>
                                                    </td>
                                                </form>
                                                <td>
                                                    <button  id="guardar_solicitud_registro" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </td>
                                            @else
                                                <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_solicitud_reg_autori)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                                <td>
                                                    <button   id="id_modificar_solicitud_registro"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                                </td>
                                            @endif

                                        </tr>

                                        </tbody>
                                    </table>
</div>

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                            <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" title="Eliminar registro" data-toggle="modal" data-target="#eliminar_empresa_privada"><i class="fa fa-trash em56"></i></button>
                                        </div>
                                        @if($datos_empresa[0]->pdf_curp != "" && $datos_empresa[0]->pdf_carnet != "" && $datos_empresa[0]->pdf_constancia_creditos != "" && $datos_empresa[0]->pdf_solicitud_reg_autori != ""  )
                                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                            <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar documentacion" data-toggle="modal" data-target="#enviar_registro_servicio">Enviar documentación</button>

                                        </div>
                                        @endif
                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>
                    @elseif($registro_tipo_empresa[0]->id_estado_enviado== 1)
                    <x-panel.alerta tipo="exito" class="tw:mb-4">Se envió correctamente la documentación al Departamento del Servicio Social y Residencia.</x-panel.alerta>
                @endif
            @endif
            {{--modificar carta aceptacion --}}
            <x-panel.modal id="modal_modificar_carta_aceptacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar carta de aceptación</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p>
                                    <label for="nombre_proyecto">Ingresar nuevo PDF con la Carta Aceptación.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <form id="form_modificar_carta_aceptacion" action="{{url("/servicio_social/registrar_carta_aceptacion/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="carta_aceptacion" name="carta_aceptacion" type="file"   accept="application/pdf" required/>
                                </form>
                                </p>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="modificar_carta_aceptacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                        </div>
                    </x-panel.modal>
            {{--modificar anexo tecnico --}}
            <x-panel.modal id="modal_modificar_anexo_tecnico" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Anexo Tecnico</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p>
                                    <label for="nombre_proyecto">Ingresar nuevo PDF con el Anexo Tecnico.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <form id="form_modificar_anexo_tecnico"action="{{url("/servicio_social/registrar_anexo_tecnico/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="anexo_tecnico" name="anexo_tecnico" type="file"   accept="application/pdf" required/>
                                </form>
                                </p>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="modificar_anexo_tecnico" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                        </div>
                    </x-panel.modal>
            {{--modificar curp --}}
            <x-panel.modal id="modal_modificar_curp" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Curp</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p>
                                    <label for="nombre_proyecto">Ingresar nuevo PDF con la Curp.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <form id="form_modificar_curp"action="{{url("/servicio_social/registrar_curp/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="curp" name="curp" type="file"   accept="application/pdf" required/>
                                </form>
                                </p>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="modificar_curp" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                        </div>
                    </x-panel.modal>

            {{--modificar carnet --}}
            <x-panel.modal id="modal_modificar_carnet" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Carnet</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p>
                                    <label for="nombre_proyecto">Ingresar nuevo PDF con el Carnet.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <form id="form_modificar_carnet"action="{{url("/servicio_social/registrar_carnet/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="carnet" name="carnet" type="file"   accept="application/pdf" required/>
                                </form>
                                </p>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="modificar_carnet" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                        </div>
                    </x-panel.modal>

            {{--modificar carnet --}}
            <x-panel.modal id="modal_modificar_costancia_creditos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Costancia de Creditos</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p>
                                    <label for="nombre_proyecto">Ingresar nuevo PDF con la Constancia de Creditos.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <form id="form_modificar_costancia_creditos"action="{{url("/servicio_social/registrar_costancia_creditos/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="costancia_creditos" name="costancia_creditos" type="file"   accept="application/pdf" required/>
                                </form>
                                </p>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="modificar_costancia_creditos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                        </div>
                    </x-panel.modal>
            {{--modificar solicitud_registro --}}
            <x-panel.modal id="modal_modificar_solicitud_registro" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Solicitud de registro de autorización</h4>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <p>
                                    <label for="nombre_proyecto">Ingresar nuevo PDF con la Solicitud de registro de autorización.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <form id="form_modificar_solicitud_registro"action="{{url("/servicio_social/registrar_solicitud_registro/".$datos_empresa[0]->id_alumno."/".$registro_tipo_empresa[0]->id_tipo_empresa)}}" role="form" method="POST" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="solicitud_registro" name="solicitud_registro" type="file"   accept="application/pdf" required/>
                                </form>
                                </p>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="modificar_solicitud_registro" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                        </div>
                    </x-panel.modal>

            {{--modificar registro tipo_empresa--}}
            <x-panel.modal id="modal_modificar_datos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                        <form action="{{url("/servicio_social/modificacion_tipo_empresa/")}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Datos</h4>
                            </div>
                            <div id="contenedor_modificar_datos">


                            </div>

                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >guardar</button>
                            </div>
                        </form>
                    </x-panel.modal>
            {{--fin modificar actividad--}}
            {{--inicio Eliminar registro de empresa  privada--}}
            <x-panel.modal id="eliminar_empresa_privada" tamano="sm" sin-relleno clase-cerrar="close"><form method="POST" action="{{ url("/servicio_social/eliminar_registro_servicio/{$registro_tipo_empresa[0]->id_datos_alumnos}") }}">
                    @csrf
                    @method('DELETE')
                    
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Eliminar Registro</h4>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <p>¿Seguro que quieres, eliminar tu registro de la primera etapa del Servicio Social?</p>
                            </div>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                            </div>
                        </form></x-panel.modal>

            {{-- fin de Eliminar registro de empresa  privada--}}

            {{--inicio Enviar registro de empresa  privada--}}
            <x-panel.modal id="enviar_registro_servicio" tamano="sm" sin-relleno clase-cerrar="close">
                        <form method="POST" id="enviar_doc" action="{{ url("/servicio_social/enviar_registro_servicio/{$registro_tipo_empresa[0]->id_datos_alumnos}") }}">
                            @csrf
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Enviar documentos</h4>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <p>¿Seguro que quieres, enviar tus documentos de la primera etapa del Servicio Social al Departamento de Servicio Social y Residencia Profesional para su revisión?</p>
                            </div>
                        </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="documentacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                        </div>
                    </x-panel.modal>

            {{-- fin de Enviar registro de empresa  privada--}}
            @endif

    </main>

    <script type="text/javascript">
        $(document).ready( function() {

            $("#guardar_carta_aceptacion").click(function (event) {
                var carta_aceptacion = $("#carta_aceptacion").val();
                if(carta_aceptacion != ""){
                    $("#form_carta_aceptacion").submit();
                    $("#guardar_carta_aceptacion").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Carta de Aceptación",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#guardar_anexo_tecnico").click(function (event) {
                var anexo_tecnico = $("#anexo_tecnico").val();
                if(anexo_tecnico != ""){
                    $("#form_anexo_tecnico").submit();
                    $("#guardar_anexo_tecnico").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el anexo tecnico",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#guardar_curp").click(function (event) {
                var curp = $("#curp").val();
                //TNotify.alert(curp);
                if(curp != ""){
                    $("#form_curp").submit();
                    $("#guardar_curp").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con tu Curp",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#guardar_carnet").click(function (event) {
                var carnet = $("#carnet").val();
                if(carnet != ""){
                    $("#form_carnet").submit();
                    $("#guardar_carnet").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el carnet",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#guardar_costancia_creditos").click(function (event) {
                var costancia_creditos = $("#costancia_creditos").val();
                if(costancia_creditos != ""){
                    $("#form_costancia_creditos").submit();
                    $("#guardar_costancia_creditos").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Constancia original del 50% de creditos",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });

            $("#guardar_solicitud_registro").click(function (event) {
                var solicitud_registro = $("#solicitud_registro").val();
                if(solicitud_registro != ""){
                    $("#form_solicitud_registro").submit();
                    $("#guardar_solicitud_registro").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Solicitud de registro de autorización",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });


            $("#id_modificar_carta_aceptacion").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_carta_aceptacion").modal('show');
            });
            $("#id_modificar_anexo_tecnico").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_anexo_tecnico").modal('show');
            });
            $("#id_modificar_curp").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_curp").modal('show');
            });
            $("#id_modificar_carnet").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_carnet").modal('show');
            });
            $("#id_modificar_costancia_creditos").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_costancia_creditos").modal('show');
            });
            $("#id_modificar_solicitud_registro").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_solicitud_registro").modal('show');
            });


            $("#modificar_carta_aceptacion").click(function (event) {

                var carta_aceptacion = $("#carta_aceptacion").val();
                if(carta_aceptacion != ""){
                    $("#form_modificar_carta_aceptacion").submit();
                    $("#modificar_carta_aceptacion").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Carta de Aceptación",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_anexo_tecnico").click(function (event) {

                var anexo_tecnico = $("#anexo_tecnico").val();
                if(anexo_tecnico != ""){
                    $("#form_modificar_anexo_tecnico").submit();
                    $("#modificar_anexo_tecnico").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con anexo_tecnico",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_curp").click(function (event) {

                var curp = $("#curp").val();
                if(curp != ""){
                    $("#form_modificar_curp").submit();
                    $("#modificar_curp").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con tu curp",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_carnet").click(function (event) {

                var carnet = $("#carnet").val();
                if(carnet != ""){
                    $("#form_modificar_carnet").submit();
                    $("#modificar_carnet").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con tu carnet",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_costancia_creditos").click(function (event) {

                var costancia_creditos = $("#costancia_creditos").val();
                if(costancia_creditos != ""){
                    $("#form_modificar_costancia_creditos").submit();
                    $("#modificar_costancia_creditos").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con tu Constancia de creditos ",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_solicitud_registro").click(function (event) {

                var solicitud_registro = $("#solicitud_registro").val();
                if(solicitud_registro != ""){
                    $("#form_modificar_solicitud_registro").submit();
                    $("#modificar_solicitud_registro").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con tu Solicitud de registro de autorización ",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });


            $("#guardar_datos").click(function (event) {
                var correo_electronico = $("#correo_electronico").val();
                var tipo_empresa = $("#tipo_empresa").val();

                if(correo_electronico != "" && tipo_empresa == 1 || correo_electronico != " " && tipo_empresa ==2 )
                {
                    $("#formulario_registrar_tipo").submit();
                    $("#guardar_datos").attr("disabled", true);
                }
            });
            $(".modificar_datos_alumnos").click(function (event) {
                var id_datos_alumnos=$(this).attr('id');
                $.get("/servicio_social/modificar_tipo_empresa/"+id_datos_alumnos,function(request){
                    $("#contenedor_modificar_datos").html(request);
                    $("#modal_modificar_datos").modal('show');
                });
            });
            $("#documentacion").click(function (event) {
                $("#enviar_doc").submit();
                $("#documentacion").attr("disabled", true);
            });

        });
    </script>



</div>
@endsection