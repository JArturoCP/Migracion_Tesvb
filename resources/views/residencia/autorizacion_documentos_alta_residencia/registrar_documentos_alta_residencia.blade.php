@extends('layouts.panel')
@section('title', 'Documentación de alta de residenciaa')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Enviar Documentación de Alta de Residencia" :migas="['Residencia profesional' => null]" />

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <form id="formulario_modificar_correo" action="{{url("/residencia/modificar_correo_documentacion")}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="nombre_proyecto">Nombre del alumno:</label>
                                            <p>{{$datosalumno->nombre}} {{$datosalumno->apaterno}} {{$datosalumno->amaterno}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="nombre_proyecto">Modificar tu correo electronico.</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="id_alta_residencia" name="id_alta_residencia" type="hidden"   value="{{$documentos_alta->id_alta_residencia}}" required/>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="correo_electronico_doc" name="correo_electronico_doc" type="email"  placeholder="Ingresa tu correo electronico" value="{{$documentos_alta->correo}}" required/>
                                        </div>
                                    </div>
                                </div>



                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <button id="modificar_correo_alta" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Modificar correo</button>
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
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
                                <td>Solicitud de Residencia Profesional</td>
                                @if($documentos_alta->pdf_solicitud_residencia  == "" )
                                    <td>
                                        <form id="form_solicitud_residencia" action="{{url("/residencia/registrar_solicitud_residencia/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="solicitud_residencia" name="solicitud_residencia" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_solicitud_residencia" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_solicitud_residencia)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_solicitud_residencia"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Constancia de 80% de avance académico, no adeudo de asignatura en curso especial,
                                haber acreditado  el servicio social y haber acrdeitado los 5 creditos  de actividades complementarias
                                emitido por la Subdirección de Servicios Escolares del TESVB.</td>
                                @if($documentos_alta->pdf_constancia_avance_academico   == "" )
                                    <td>
                                        <form id="form_constancia_avance_academico" action="{{url("/residencia/registrar_constancia_avance_academico/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="constancia_avance_academico" name="constancia_avance_academico" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_constancia_avance_academico" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_constancia_avance_academico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_constancia_avance_academico"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)</td>
                                @if($documentos_alta->pdf_comprobante_seguro == "" )
                                    <td>
                                        <form id="form_comprobante_seguro" action="{{url("/residencia/registrar_comprobante_seguro/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="comprobante_seguro" name="comprobante_seguro" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_comprobante_seguro" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_comprobante_seguro)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_comprobante_seguro"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Oficio de Asignación del Proyecto emitido por la Jefatura de División</td>
                                @if($documentos_alta->pdf_oficio_asignacion_jefatura  == "" )
                                    <td>
                                        <form id="form_oficio_asignacion_jefatura" action="{{url("/residencia/registrar_oficio_asignacion_jefatura/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_asignacion_jefatura" name="oficio_asignacion_jefatura" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_oficio_asignacion_jefatura" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_oficio_asignacion_jefatura)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_oficio_asignacion_jefatura"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Oficio de Aceptación por parte de la empresa en hoja Membretada</td>
                                @if($documentos_alta->pdf_oficio_aceptacion_empresa   == "" )
                                    <td>
                                        <form id="form_oficio_aceptacion_empresa" action="{{url("/residencia/registrar_oficio_aceptacion_empresa/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_empresa" name="oficio_aceptacion_empresa" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_oficio_aceptacion_empresa" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_oficio_aceptacion_empresa)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_oficio_aceptacion_empresa"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Oficio de Presentación por parte del TESVB</td>
                                @if($documentos_alta->pdf_oficio_presentacion_tecnologico == "" )
                                    <td>
                                        <form id="form_oficio_presentacion_tecnologico" action="{{url("/residencia/registrar_oficio_presentacion_tecnologico/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_presentacion_tecnologico" name="oficio_presentacion_tecnologico" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_oficio_presentacion_tecnologico" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_oficio_presentacion_tecnologico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_oficio_presentacion_tecnologico"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Anteproyecto con el Visto Bueno de la Academia</td>
                                @if($documentos_alta->pdf_anteproyecto  == "" )
                                    <td>
                                        <form id="form_anteproyecto" action="{{url("/residencia/registrar_anteproyectos/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="anteproyecto" name="anteproyecto" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_anteproyecto" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_anteproyecto)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_anteproyecto"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Carta de compromiso firmada por el Asesor Interno y revisor</td>
                                @if($documentos_alta->pdf_carta_compromiso  == "" )
                                    <td>
                                        <form id="form_carta_compromiso" action="{{url("/residencia/registrar_carta_compromiso/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="carta_compromiso" name="carta_compromiso" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_carta_compromiso" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_carta_compromiso)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_carta_compromiso"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td class="tw:text-red-600 tw:dark:text-red-400">Convenio con la empresa (opcional)</td>
                                @if($documentos_alta->pdf_convenio_empresa   == "" )
                                    <td>
                                        <form id="form_convenio_empresa" action="{{url("/residencia/registrar_convenio_empresa/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="convenio_empresa" name="convenio_empresa" type="file"   accept="application/pdf" required/>
                                        </form>
                                    </td>
                                    <td>
                                        <button  id="guardar_convenio_empresa" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                    </td>
                                @else

                                    <td><a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos_alta->pdf_convenio_empresa)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                    <td>
                                        <button   id="id_convenio_empresa"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                    </td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
</div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                @if($documentos_alta->pdf_solicitud_residencia  != "" && $documentos_alta->pdf_constancia_avance_academico  != "" && $documentos_alta->pdf_comprobante_seguro  != "" && $documentos_alta->pdf_oficio_asignacion_jefatura  != "" && $documentos_alta->pdf_oficio_aceptacion_empresa  != "" && $documentos_alta->pdf_oficio_presentacion_tecnologico  != "" && $documentos_alta->pdf_anteproyecto  != "" && $documentos_alta->pdf_carta_compromiso   != "")
                                    <div class="tw:w-full tw:px-2">
                                        <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar documentacion" data-toggle="modal" data-target="#enviar_documentacion_residencia">Enviar documentación</button>

                                    </div>
                                @endif

                        </div>



                    </div>
                </div>

            </div>
        </div>


    </main>
    {{--modificar solicitud de residencia --}}
    <x-panel.modal id="modal_modificar_solicitud_residencia" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Solicitud de Residencia Profesional</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con la Solicitud de Residencia Profesional.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_solicitud_residencia" action="{{url("/residencia/registrar_solicitud_residencia/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="solicitud_residencia" name="solicitud_residencia" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_solicitud_residencia" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar solicitud de residencia--}}

    {{--modificar constancia_avance_academico --}}
    <x-panel.modal id="modal_modificar_constancia_avance_academico" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Constancia de 80% de avance académico</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con la Constancia de 80% de avance académico.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_constancia_avance_academico" action="{{url("/residencia/registrar_constancia_avance_academico/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="constancia_avance_academico" name="constancia_avance_academico" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_constancia_avance_academico" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar constancia_avance_academico--}}
    {{--modificar comprobante_seguro --}}
    <x-panel.modal id="modal_modificar_comprobante_seguro" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con el Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_comprobante_seguro" action="{{url("/residencia/registrar_comprobante_seguro/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="comprobante_seguro" name="comprobante_seguro" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_comprobante_seguro" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar comprobante_seguro--}}
    {{--modificar oficio_asignacion_jefatura --}}
    <x-panel.modal id="modal_modificar_oficio_asignacion_jefatura" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Asignación del Proyecto emitido por la Jefatura de División</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con Oficio de Asignación del Proyecto emitido por la Jefatura de División<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_oficio_asignacion_jefatura" action="{{url("/residencia/registrar_oficio_asignacion_jefatura/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_asignacion_jefatura" name="oficio_asignacion_jefatura" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_oficio_asignacion_jefatura" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar oficio_asignacion_jefatura--}}
    {{--modificar oficio_aceptacion_empresa --}}
    <x-panel.modal id="modal_modificar_oficio_aceptacion_empresa" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Aceptación por parte de la empresa en hoja Membretada</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con el Oficio de Aceptación por parte de la empresa en hoja Membretada<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_oficio_aceptacion_empresa" action="{{url("/residencia/registrar_oficio_aceptacion_empresa/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_empresa" name="oficio_aceptacion_empresa" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_oficio_aceptacion_empresa" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar oficio_aceptacion_empresa--}}
    {{--modificar oficio_presentacion_tecnologico --}}
    <x-panel.modal id="modal_modificar_oficio_presentacion_tecnologico" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Presentación por parte del TESVB</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con el Oficio de Presentación por parte del TESVB<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_oficio_presentacion_tecnologico" action="{{url("/residencia/registrar_oficio_presentacion_tecnologico/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_presentacion_tecnologico" name="oficio_presentacion_tecnologico" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_oficio_presentacion_tecnologico" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar oficio_presentacion_tecnologico--}}
    {{--modificar anteproyecto --}}
    <x-panel.modal id="modal_modificar_anteproyecto" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Anteproyecto con el Visto Bueno de la Academia</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con el Anteproyecto con el Visto Bueno de la Academia<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_anteproyecto" action="{{url("/residencia/registrar_anteproyectos/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="anteproyecto" name="anteproyecto" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_anteproyecto" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar anteproyecto--}}
    {{--modificar carta_compromiso --}}
    <x-panel.modal id="modal_modificar_carta_compromiso" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar la Carta de compromiso firmada por el Asesor Interno y revisor</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con la Carta de compromiso firmada por el Asesor Interno y revisor<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_carta_compromiso" action="{{url("/residencia/registrar_carta_compromiso/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="carta_compromiso" name="carta_compromiso" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_carta_compromiso" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar carta_compromiso--}}
    {{--modificar carta_compromiso --}}
    <x-panel.modal id="modal_modificar_convenio_empresa" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Convenio con la empresa (opcional)</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="nombre_proyecto">Ingresar nuevo PDF con el Convenio con la empresa (opcional)<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_convenio_empresa" action="{{url("/residencia/registrar_convenio_empresa/".$documentos_alta->id_alta_residencia)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="convenio_empresa" name="convenio_empresa" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_convenio_empresa" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar carta_compromiso--}}

    <x-panel.modal id="enviar_documentacion_residencia" tamano="sm" sin-relleno clase-cerrar="close">
                <form method="POST" id="enviar_doc" action="{{url("/residencia/envio_documento_residencia/".$documentos_alta->id_alta_residencia)}}">
                    @csrf
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Enviar documentos</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <p>¿Seguro que quieres, enviar tus documentos al Departamento de Servicio Social y Residencia Profesional para su revisión?</p>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </form>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready( function() {

            $("#modificar_correo_alta").click(function (event) {
                var correo_electronico_doc = $("#correo_electronico_doc").val();
                if(correo_electronico_doc != ""){
                    $("#formulario_modificar_correo").submit();
                    $("#modificar_correo_alta").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Ingresa tu correo electronico.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#guardar_solicitud_residencia").click(function (event) {
                var solicitud_residencia = $("#solicitud_residencia").val();
                if(solicitud_residencia != ""){
                    $("#form_solicitud_residencia").submit();
                    $("#guardar_solicitud_residencia").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Solicitud de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_constancia_avance_academico").click(function (event) {
                var constancia_avance_academico = $("#constancia_avance_academico").val();
                if(constancia_avance_academico != ""){
                    $("#form_constancia_avance_academico").submit();
                    $("#guardar_constancia_avance_academico").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Constancia de 80% de avance académico, no adeudo de asignatura en curso especial,\n" +
                            "                                haber acreditado  el servicio social y haber acrdeitado los 5 creditos  de actividades complementarias\n" +
                            "                                emitido por la Subdirección de Servicios Escolares del TESVB.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_comprobante_seguro").click(function (event) {
                var comprobante_seguro = $("#comprobante_seguro").val();
                if(comprobante_seguro != ""){
                    $("#form_comprobante_seguro").submit();
                    $("#guardar_comprobante_seguro").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)" ,
                            showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_oficio_asignacion_jefatura").click(function (event) {
                var oficio_asignacion_jefatura = $("#oficio_asignacion_jefatura").val();
                if(oficio_asignacion_jefatura != ""){
                    $("#form_oficio_asignacion_jefatura").submit();
                    $("#guardar_oficio_asignacion_jefatura").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Asignación del Proyecto emitido por la Jefatura de División" ,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_oficio_aceptacion_empresa").click(function (event) {
                var oficio_aceptacion_empresa = $("#oficio_aceptacion_empresa").val();
                if(oficio_aceptacion_empresa != ""){
                    $("#form_oficio_aceptacion_empresa").submit();
                    $("#guardar_oficio_aceptacion_empresa").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación por parte de la empresa en hoja Membretada" ,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_oficio_presentacion_tecnologico").click(function (event) {
                var oficio_presentacion_tecnologico = $("#oficio_presentacion_tecnologico").val();
                if(oficio_presentacion_tecnologico != ""){
                    $("#form_oficio_presentacion_tecnologico").submit();
                    $("#guardar_oficio_presentacion_tecnologico").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Presentación por parte del TESVB" ,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_anteproyecto").click(function (event) {
                var anteproyecto = $("#anteproyecto").val();
                if(anteproyecto != ""){
                    $("#form_anteproyecto").submit();
                    $("#guardar_anteproyecto").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Anteproyecto con el Visto Bueno de la Academia" ,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_carta_compromiso").click(function (event) {
                var  carta_compromiso = $("#carta_compromiso").val();
                if( carta_compromiso != ""){
                    $("#form_carta_compromiso").submit();
                    $("#guardar_carta_compromiso").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Carta de compromiso firmada por el Asesor Interno y revisor" ,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_convenio_empresa ").click(function (event) {
                var  convenio_empresa  = $("#convenio_empresa ").val();
                if( convenio_empresa  != ""){
                    $("#form_convenio_empresa").submit();
                    $("#guardar_convenio_empresa").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Convenio con la empresa (opcional)" ,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#id_solicitud_residencia").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_solicitud_residencia").modal('show');
            });
            $("#id_constancia_avance_academico").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_constancia_avance_academico").modal('show');
            });
            $("#id_comprobante_seguro").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_comprobante_seguro").modal('show');
            });
            $("#id_oficio_asignacion_jefatura").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_oficio_asignacion_jefatura").modal('show');
            });
            $("#id_oficio_aceptacion_empresa").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_oficio_aceptacion_empresa").modal('show');
            });
            $("#id_oficio_presentacion_tecnologico").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_oficio_presentacion_tecnologico").modal('show');
            });
            $("#id_anteproyecto").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_anteproyecto").modal('show');
            });
            $("#id_carta_compromiso").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_carta_compromiso").modal('show');
            });
            $("#id_convenio_empresa").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_convenio_empresa").modal('show');
            });


            $("#modificar_solicitud_residencia").click(function (event) {

                var solicitud_residencia = $("#solicitud_residencia").val();
                if(solicitud_residencia != ""){
                    $("#form_modificar_solicitud_residencia").submit();
                    $("#modificar_solicitud_residencia").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Solicitud de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_constancia_avance_academico").click(function (event) {

                var constancia_avance_academico = $("#constancia_avance_academico").val();
                if(constancia_avance_academico != ""){
                    $("#form_modificar_constancia_avance_academico").submit();
                    $("#modificar_constancia_avance_academico").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Constancia de 80% de avance académico, no adeudo de asignatura en curso especial,\n" +
                            "                                haber acreditado  el servicio social y haber acrdeitado los 5 creditos  de actividades complementarias\n" +
                            "                                emitido por la Subdirección de Servicios Escolares del TESVB.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_comprobante_seguro").click(function (event) {

                var comprobante_seguro = $("#comprobante_seguro").val();
                if(comprobante_seguro != ""){
                    $("#form_modificar_comprobante_seguro").submit();
                    $("#modificar_comprobante_seguro").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_oficio_asignacion_jefatura").click(function (event) {

                var oficio_asignacion_jefatura = $("#oficio_asignacion_jefatura").val();
                if(oficio_asignacion_jefatura != ""){
                    $("#form_modificar_oficio_asignacion_jefatura").submit();
                    $("#modificar_oficio_asignacion_jefatura").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Asignación del Proyecto emitido por la Jefatura de División",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_oficio_aceptacion_empresa").click(function (event) {

                var oficio_aceptacion_empresa = $("#oficio_aceptacion_empresa").val();
                if(oficio_aceptacion_empresa != ""){
                    $("#form_modificar_oficio_aceptacion_empresa").submit();
                    $("#modificar_oficio_aceptacion_empresa").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación por parte de la empresa en hoja Membretada",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_oficio_presentacion_tecnologico").click(function (event) {

                var oficio_presentacion_tecnologico = $("#oficio_presentacion_tecnologico").val();
                if(oficio_presentacion_tecnologico != ""){
                    $("#form_modificar_oficio_presentacion_tecnologico").submit();
                    $("#modificar_oficio_presentacion_tecnologico").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Presentación por parte del TESVB",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_anteproyecto").click(function (event) {

                var anteproyecto = $("#anteproyecto").val();
                if(anteproyecto != ""){
                    $("#form_modificar_anteproyecto").submit();
                    $("#modificar_anteproyecto").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Anteproyecto con el Visto Bueno de la Academia",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_carta_compromiso").click(function (event) {

                var carta_compromiso = $("#carta_compromiso").val();
                if(carta_compromiso != ""){
                    $("#form_modificar_carta_compromiso").submit();
                    $("#modificar_carta_compromiso").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Carta de compromiso firmada por el Asesor Interno y revisor",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_convenio_empresa").click(function (event) {

                var convenio_empresa = $("#convenio_empresa").val();
                if(convenio_empresa != ""){
                    $("#form_modificar_convenio_empresa").submit();
                    $("#modificar_convenio_empresa").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Convenio con la empresa (opcional)",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
        });
    </script>



</div>
@endsection