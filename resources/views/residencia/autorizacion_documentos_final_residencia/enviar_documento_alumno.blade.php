@extends('layouts.panel')
@section('title', 'Documentación final de residenciaa')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Enviar Documentación de Liberación de Residencia" :migas="['Residencia profesional' => null]" />
        @if( $estado_enviado == 0)
        @if( $estado_documentacion->correo_electronico == "")
         <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
             <div class="tw:w-full tw:px-2">
                 <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                     <div class="tw:p-5 tw:sm:p-6">
                         <form id="formulario_modificar_correo" action="{{url("/residencia/modificar_correo_documentacionfinal/alumno")}}" role="form" method="POST" >
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
                                             <label for="nombre_proyecto">Ingresar tu correo electronico.</label>
                                             <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="id_liberacion_documentos" name="id_liberacion_documentos" type="hidden"   value="{{$estado_documentacion->id_liberacion_documentos}}" required/>
                                             <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="correo_electronico_doc" name="correo_electronico_doc" type="email"  placeholder="Ingresa tu correo electronico" value="{{$estado_documentacion->correo_electronico}}" required/>
                                         </div>
                                     </div>
                                 </div>



                                 <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                     <div class="tw:w-full tw:px-2">
                                         <button id="modificar_correo_alta" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>
                                     </div>
                                 </div>

                             </div>
                         </form>


                     </div>
                 </div>
             </div>
         </div>
            @else
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <form id="formulario_modificar_correo" action="{{url("/residencia/modificar_correo_documentacionfinal/alumno")}}" role="form" method="POST" >
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
                                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="id_liberacion_documentos" name="id_liberacion_documentos" type="hidden"   value="{{$estado_documentacion->id_liberacion_documentos}}" required/>
                                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="correo_electronico_doc" name="correo_electronico_doc" type="email"  placeholder="Ingresa tu correo electronico" value="{{$estado_documentacion->correo_electronico}}" required/>
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
                                <p class="tw:text-red-600 tw:dark:text-red-400"><b>Nota: El documento se deben escanear y guardar en un pdf legible,<br>
                                       Tambien igual el Proyecto Completo de Residencia Profesional se debe enviar al correo del Depto. de Servicio Social y Residencia Profesional</b></p>

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
                                        <td>Acta de Calificación de Residencia Profesional</td>
                                        @if($estado_documentacion->pdf_acta_calificacion  == "" )
                                            <td>
                                                <form id="form_acta_calificacion" action="{{url("/residencia/acta_calificacion/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="acta_calificacion" name="acta_calificacion" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_acta_calificacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else

                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_acta_calificacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_acta_calificacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Portada del Proyecto de Residencia Profesional</td>
                                        @if($estado_documentacion->pdf_portada   == "" )
                                            <td>
                                                <form id="form_portada" action="{{url("/residencia/portada/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="portada" name="portada" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_portada" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else

                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_portada)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_portada"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Evaluación Final de Residencia Profesional</td>
                                        @if($estado_documentacion->pdf_evaluacion_final_residencia   == "" )
                                            <td>
                                                <form id="form_evaluacion_final_residencia" action="{{url("/residencia/evaluacion_final_residencia/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="evaluacion_final_residencia" name="evaluacion_final_residencia" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_evaluacion_final_residencia" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else

                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_evaluacion_final_residencia)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_evaluacion_final_residencia"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Oficio de Aceptación de Informe Final del Asesor Interno</td>
                                        @if($estado_documentacion->pdf_oficio_aceptacion_informe_interno    == "" )
                                            <td>
                                                <form id="form_oficio_aceptacion_informe_interno" action="{{url("/residencia/oficio_aceptacion_informe_interno/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_informe_interno" name="oficio_aceptacion_informe_interno" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_oficio_aceptacion_informe_interno" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else

                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_oficio_aceptacion_informe_interno)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_oficio_aceptacion_informe_interno"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Formato de Evaluación</td>
                                        @if($estado_documentacion->pdf_formato_evaluacion     == "" )
                                            <td>
                                                <form id="form_formato_evaluacion" action="{{url("/residencia/formato_evaluacion/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="formato_evaluacion" name="formato_evaluacion" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_formato_evaluacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else

                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_formato_evaluacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_formato_evaluacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Oficio de Aceptación de Informe Final del Revisor</td>
                                        @if($estado_documentacion->pdf_oficio_aceptacion_informe_revisor == "" )
                                            <td>
                                                <form id="form_oficio_aceptacion_informe_revisor" action="{{url("/residencia/oficio_aceptacion_informe_revisor/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_informe_revisor" name="oficio_aceptacion_informe_revisor" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_oficio_aceptacion_informe_revisor" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else
                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_oficio_aceptacion_informe_revisor)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_oficio_aceptacion_informe_revisor"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Oficio de Aceptación de Informe Final del Asesor Externo</td>
                                        @if($estado_documentacion->pdf_oficio_aceptacion_informe_externo == "" )
                                            <td>
                                                <form id="form_oficio_aceptacion_informe_externo" action="{{url("/residencia/oficio_aceptacion_informe_externo/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_informe_externo" name="oficio_aceptacion_informe_externo" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_oficio_aceptacion_informe_externo" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else
                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_oficio_aceptacion_informe_externo)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_oficio_aceptacion_informe_externo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Formato de Horas</td>
                                        @if($estado_documentacion->pdf_formato_hora == "" )
                                            <td>
                                                <form id="form_formato_hora" action="{{url("/residencia/formato_hora/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="formato_hora" name="formato_hora" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_formato_hora" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else
                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_formato_hora)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_formato_hora"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Formato de Seguimiento Interno</td>
                                        @if($estado_documentacion->pdf_seguimiento_interno  == "" )
                                            <td>
                                                <form id="form_seguimiento_interno" action="{{url("/residencia/seguimiento_interno/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="seguimiento_interno" name="seguimiento_interno" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_seguimiento_interno" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else
                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_seguimiento_interno)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_seguimiento_interno"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Formato de Seguimiento Externo</td>
                                        @if($estado_documentacion->pdf_seguimiento_externo  == "" )
                                            <td>
                                                <form id="form_seguimiento_externo" action="{{url("/residencia/seguimiento_externo/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}
                                                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="seguimiento_externo" name="seguimiento_externo" type="file"   accept="application/pdf" required/>
                                                </form>
                                            </td>
                                            <td>
                                                <button  id="guardar_seguimiento_externo" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                            </td>
                                        @else
                                            <td><a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$estado_documentacion->pdf_seguimiento_externo)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_seguimiento_externo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>
                                            </td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
</div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    @if($estado_documentacion->pdf_acta_calificacion  != "" &&
                                         $estado_documentacion->pdf_portada   != "" &&
                                         $estado_documentacion->pdf_evaluacion_final_residencia  != "" &&
                                         $estado_documentacion->pdf_oficio_aceptacion_informe_interno  != "" &&
                                         $estado_documentacion->pdf_formato_evaluacion   != "" &&
                                         $estado_documentacion->pdf_oficio_aceptacion_informe_revisor  != "" &&
                                         $estado_documentacion->pdf_oficio_aceptacion_informe_externo   != "" &&
                                         $estado_documentacion->pdf_formato_hora   != "" &&
                                         $estado_documentacion->pdf_seguimiento_interno   != "" &&
                                         $estado_documentacion->pdf_seguimiento_externo   != "" )
                                        <div class="tw:w-full tw:px-2">
                                            <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar documentacion" data-toggle="modal" data-target="#enviar_documentacion_residencia_final">Enviar documentación</button>

                                        </div>
                                    @endif


                                </div>



                            </div>
                        </div>

                    </div>
                </div>

            @endif
     @endif
 </main>
    {{--modificar acta de calificacion --}}
    <x-panel.modal id="modal_modificar_acta_calificacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar la Acta de Calificación de Residencia Profesional</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="acta_calificacion">Ingresar nuevo PDF con la Acta de Calificación de Residencia Profesional<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_acta_calificacion" action="{{url("/residencia/acta_calificacion/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="acta_calificacion" name="acta_calificacion" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_acta_calificacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar acta de calificacion--}}
    {{--modificar portada --}}
    <x-panel.modal id="modal_modificar_portada" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar la Portada del Proyecto de Residencia Profesional</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="acta_calificacion">Ingresar nuevo PDF con la Portada del Proyecto de Residencia Profesional<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_portada" action="{{url("/residencia/portada/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="portada" name="portada" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_portada" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar portada--}}
    {{--modificar evaluacion final --}}
    <x-panel.modal id="modal_modificar_evaluacion_final_residencia" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar la Evaluación Final de Residencia Profesional</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="evaluacion_final_residencia">Ingresar nuevo PDF con la Evaluación Final de Residencia Profesional<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_evaluacion_final_residencia" action="{{url("/residencia/evaluacion_final_residencia/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="evaluacion_final_residencia" name="evaluacion_final_residencia" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_evaluacion_final_residencia" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar evaluacion final--}}
    {{--modificar oficio_aceptacion_informe_interno --}}
    <x-panel.modal id="modal_modificar_oficio_aceptacion_informe_interno" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Aceptación de Informe Final del Asesor Interno</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="oficio_aceptacion_informe_interno">Ingresar nuevo PDF con el Oficio de Aceptación de Informe Final del Asesor Interno<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_oficio_aceptacion_informe_interno" action="{{url("/residencia/oficio_aceptacion_informe_interno/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_informe_interno" name="oficio_aceptacion_informe_interno" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_oficio_aceptacion_informe_interno" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar oficio_aceptacion_informe_interno--}}
    {{--modificar formato_evaluacion --}}
    <x-panel.modal id="modal_modificar_formato_evaluacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Formato de Evaluación</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="formato_evaluacion">Ingresar nuevo PDF con el Formato de Evaluación<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_formato_evaluacion" action="{{url("/residencia/formato_evaluacion/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="formato_evaluacion" name="formato_evaluacion" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_formato_evaluacion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar formato_evaluacion--}}
    {{--modificar oficio_aceptacion_informe_revisor --}}
    <x-panel.modal id="modal_modificar_oficio_aceptacion_informe_revisor" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Aceptación de Informe Final del Revisor</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="oficio_aceptacion_informe_revisor">Ingresar nuevo PDF con el Oficio de Aceptación de Informe Final del Revisor<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_oficio_aceptacion_informe_revisor" action="{{url("/residencia/oficio_aceptacion_informe_revisor/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_informe_revisor" name="oficio_aceptacion_informe_revisor" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_oficio_aceptacion_informe_revisor" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar oficio_aceptacion_informe_revisor--}}
    {{--modificar oficio_aceptacion_informe_externo --}}
    <x-panel.modal id="modal_modificar_oficio_aceptacion_informe_externo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Aceptación de Informe Final del Asesor Externo</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="oficio_aceptacion_informe_externo">Ingresar nuevo PDF con el Oficio de Aceptación de Informe Final del Asesor Externo<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_oficio_aceptacion_informe_externo" action="{{url("/residencia/oficio_aceptacion_informe_externo/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="oficio_aceptacion_informe_externo" name="oficio_aceptacion_informe_externo" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_oficio_aceptacion_informe_externo" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar oficio_aceptacion_informe_revisor--}}
    {{--modificar formato_hora --}}
    <x-panel.modal id="modal_modificar_formato_hora" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Oficio de Aceptación de Informe Final del Asesor Externo</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="formato_hora">Ingresar nuevo PDF con el Oficio de Aceptación de Informe Final del Asesor Externo<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_formato_hora" action="{{url("/residencia/formato_hora/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="formato_hora" name="formato_hora" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_formato_hora" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar formato_hora--}}
    {{--modificar seguimiento_interno --}}
    <x-panel.modal id="modal_modificar_seguimiento_interno" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Formato de Seguimiento Interno</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="seguimiento_interno">Ingresar nuevo PDF con el Formato de Seguimiento Interno<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_seguimiento_interno" action="{{url("/residencia/seguimiento_interno/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="seguimiento_interno" name="seguimiento_interno" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_seguimiento_interno" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar seguimiento_interno--}}
    {{--modificar seguimiento_externo --}}
    <x-panel.modal id="modal_modificar_seguimiento_externo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar el Formato de Seguimiento Externo</h4>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <p>
                            <label for="seguimiento_externo">Ingresar nuevo PDF con el Formato de Seguimiento Externo<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <form id="form_modificar_seguimiento_externo" action="{{url("/residencia/seguimiento_externo/documentacionfinal/".$estado_documentacion->id_liberacion_documentos)}}" role="form" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="seguimiento_externo" name="seguimiento_externo" type="file"   accept="application/pdf" required/>
                        </form>
                        </p>
                    </div>
                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button  id="modificar_seguimiento_externo" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                </div>
            </x-panel.modal>
    {{--modificar seguimiento_externo--}}
    <x-panel.modal id="enviar_documentacion_residencia_final" tamano="sm" sin-relleno clase-cerrar="close">
                <form method="POST" id="enviar_doc" action="{{url("/residencia/envio_documento_residencia_final/".$estado_documentacion->id_liberacion_documentos)}}">
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


            $("#guardar_acta_calificacion").click(function (event) {
                var acta_calificacion = $("#acta_calificacion").val();
                if(acta_calificacion != ""){
                    $("#form_acta_calificacion").submit();
                    $("#guardar_acta_calificacion").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Acta de Calificación de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });

            $("#guardar_portada").click(function (event) {
                var portada = $("#portada").val();
                if(portada != ""){
                    $("#form_portada").submit();
                    $("#guardar_portada").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Portada del Proyecto de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_evaluacion_final_residencia").click(function (event) {
                var evaluacion_final_residencia = $("#evaluacion_final_residencia").val();
                if(evaluacion_final_residencia != ""){
                    $("#form_evaluacion_final_residencia").submit();
                    $("#guardar_evaluacion_final_residencia").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Evaluación Final de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_oficio_aceptacion_informe_interno").click(function (event) {
                var oficio_aceptacion_informe_interno = $("#oficio_aceptacion_informe_interno").val();
                if(oficio_aceptacion_informe_interno != ""){
                    $("#form_oficio_aceptacion_informe_interno").submit();
                    $("#guardar_oficio_aceptacion_informe_interno").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación de Informe Final del Asesor Interno",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_formato_evaluacion").click(function (event) {
                var formato_evaluacion = $("#formato_evaluacion").val();
                if(formato_evaluacion != ""){
                    $("#form_formato_evaluacion").submit();
                    $("#guardar_formato_evaluacion").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Evaluación",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_oficio_aceptacion_informe_revisor").click(function (event) {
                var oficio_aceptacion_informe_revisor = $("#oficio_aceptacion_informe_revisor").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(oficio_aceptacion_informe_revisor != ""){
                    $("#form_oficio_aceptacion_informe_revisor").submit();
                    $("#guardar_oficio_aceptacion_informe_revisor").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación de Informe Final del Revisor",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_oficio_aceptacion_informe_externo").click(function (event) {
                var oficio_aceptacion_informe_externo = $("#oficio_aceptacion_informe_externo").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(oficio_aceptacion_informe_externo != ""){
                    $("#form_oficio_aceptacion_informe_externo").submit();
                    $("#guardar_oficio_aceptacion_informe_externo").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación de Informe Final del Asesor Externo",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_formato_hora").click(function (event) {
                var formato_hora = $("#formato_hora").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(formato_hora != ""){
                    $("#form_formato_hora").submit();
                    $("#guardar_formato_hora").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Horas",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_seguimiento_interno").click(function (event) {
                var seguimiento_interno = $("#seguimiento_interno").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(seguimiento_interno != ""){
                    $("#form_seguimiento_interno").submit();
                    $("#guardar_seguimiento_interno").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Seguimiento Interno",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_seguimiento_externo").click(function (event) {
                var seguimiento_externo = $("#seguimiento_externo").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(seguimiento_externo != ""){
                    $("#form_seguimiento_externo").submit();
                    $("#guardar_seguimiento_externo").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Seguimiento Externo",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });



            $("#id_acta_calificacion").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_acta_calificacion").modal('show');
            });
            $("#id_portada").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_portada").modal('show');
            });
            $("#id_evaluacion_final_residencia").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_evaluacion_final_residencia").modal('show');
            });
            $("#id_oficio_aceptacion_informe_interno").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_oficio_aceptacion_informe_interno").modal('show');
            });
            $("#id_formato_evaluacion").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_formato_evaluacion").modal('show');
            });
            $("#id_oficio_aceptacion_informe_revisor").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_oficio_aceptacion_informe_revisor").modal('show');
            });
            $("#id_oficio_aceptacion_informe_externo").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_oficio_aceptacion_informe_externo").modal('show');
            });
            $("#id_formato_hora").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_formato_hora").modal('show');
            });
            $("#id_seguimiento_interno").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_seguimiento_interno").modal('show');
            });
            $("#id_seguimiento_externo").click(function (event) {
                //TNotify.alert('hola');
                $("#modal_modificar_seguimiento_externo").modal('show');
            });

            $("#modificar_acta_calificacion").click(function (event) {

                var acta_calificacion = $("#acta_calificacion").val();
                if(acta_calificacion != ""){
                    $("#form_modificar_acta_calificacion").submit();
                    $("#modificar_acta_calificacion").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Acta de Calificación de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_portada").click(function (event) {

                var portada = $("#portada").val();
                if(portada != ""){
                    $("#form_modificar_portada").submit();
                    $("#modificar_portada").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Portada del Proyecto de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_evaluacion_final_residencia").click(function (event) {

                var evaluacion_final_residencia = $("#evaluacion_final_residencia").val();
                if(evaluacion_final_residencia != ""){
                    $("#form_modificar_evaluacion_final_residencia").submit();
                    $("#modificar_evaluacion_final_residencia").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con la Evaluación Final de Residencia Profesional",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_oficio_aceptacion_informe_interno").click(function (event) {
                var oficio_aceptacion_informe_interno = $("#oficio_aceptacion_informe_interno").val();
                if(oficio_aceptacion_informe_interno != ""){
                    $("#form_modificar_oficio_aceptacion_informe_interno").submit();
                    $("#modificar_oficio_aceptacion_informe_interno").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación de Informe Final del Asesor Interno",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_formato_evaluacion").click(function (event) {
                var formato_evaluacion = $("#formato_evaluacion").val();
                if(formato_evaluacion != ""){
                    $("#form_modificar_formato_evaluacion").submit();
                    $("#modificar_formato_evaluacion").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Evaluación",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_oficio_aceptacion_informe_revisor").click(function (event) {
                var oficio_aceptacion_informe_revisor = $("#oficio_aceptacion_informe_revisor").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(oficio_aceptacion_informe_revisor != ""){
                    $("#form_modificar_oficio_aceptacion_informe_revisor").submit();
                    $("#modificar_oficio_aceptacion_informe_revisor").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación de Informe Final del Revisor",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_oficio_aceptacion_informe_externo").click(function (event) {
                var oficio_aceptacion_informe_externo = $("#oficio_aceptacion_informe_externo").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(oficio_aceptacion_informe_externo != ""){
                    $("#form_modificar_oficio_aceptacion_informe_externo").submit();
                    $("#modificar_oficio_aceptacion_informe_externo").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Oficio de Aceptación de Informe Final del Asesor Externo",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_formato_hora").click(function (event) {
                var formato_hora = $("#formato_hora").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(formato_hora != ""){
                    $("#form_modificar_formato_hora").submit();
                    $("#modificar_formato_hora").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Horas",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_seguimiento_interno").click(function (event) {
                var seguimiento_interno = $("#seguimiento_interno").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(seguimiento_interno != ""){
                    $("#form_modificar_seguimiento_interno").submit();
                    $("#modificar_seguimiento_interno").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Seguimiento Interno",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#modificar_seguimiento_externo").click(function (event) {
                var seguimiento_externo = $("#seguimiento_externo").val();
                //TNotify.alert(oficio_aceptacion_informe_revisor);
                if(seguimiento_externo != ""){
                    $("#form_modificar_seguimiento_externo").submit();
                    $("#modificar_seguimiento_externo").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "acept",
                        title: "Selecciona el PDF con el Formato de Seguimiento Externo",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
        });
    </script>
</div>
@endsection