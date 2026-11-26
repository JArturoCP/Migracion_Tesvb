@extends('layouts.panel')
@section('title', 'Servicio social')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
            <x-panel.encabezado titulo="Documentos de la primera etapa del Servicio Social" :migas="['Servicio social' => null]" />
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                            <p><b>No. Cuenta: </b> {{$registro_tipo_empresa[0]->cuenta}}  <b>      Nombre del alumno:</b> {{$registro_tipo_empresa[0]->nombre}} {{$registro_tipo_empresa[0]->apaterno}} {{$registro_tipo_empresa[0]->amaterno}}</p>
                            <p><b>Correo electronico:</b> {{$registro_tipo_empresa[0]->correo_electronico}}  <b>     Tipo de empresa:</b> {{$registro_tipo_empresa[0]->tipo_empresa}}</p>

                        </div>
                    </div>

                </div>
            </div>
        @if($registro_tipo_empresa[0]->id_estado_enviado == 2)
            @if($registro_tipo_empresa[0]->id_tipo_empresa == 1)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                            <p class="tw:text-red-600 tw:dark:text-red-400">Corrige lo indicado en los comentarios de los documentos rechazados.</p>
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th>Nombre del documento</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                    <th>Ver PDF</th>
                                    <th>Modificar</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> Carta de aceptación (solo empresa privada)</td>
                                    @if($datos_empresa[0]->est_carta_aceptacion == 1)
                                    <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                    <td>{{$datos_empresa[0]->coment_carta_aceptacion}}</td>
                                        <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_carta_aceptacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                        <td>
                                            <button   id="id_modificar_carta_aceptacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                        </td>
                                        @else
                                        <td>Aprobado</td>
                                        <td>No cambiar este documento</td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>  Anexo Tecnico (solo empresa privada)</td>
                                    @if($datos_empresa[0]->est_anexo_tecnico == 1)
                                        <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                        <td>{{$datos_empresa[0]->coment_anexo_tecnico }}</td>
                                        <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_anexo_tecnico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                        <td>
                                            <button   id="id_modificar_anexo_tecnico"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                        </td>
                                    @else
                                        <td>Aprobado</td>
                                        <td>No cambiar este documento</td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td> Copia de tu CURP</td>
                                    @if($datos_empresa[0]->est_curp == 1)
                                        <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                        <td>{{$datos_empresa[0]->coment_curp }}</td>
                                        <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_curp)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                        <td>
                                            <button   id="id_modificar_curp"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                        </td>
                                    @else
                                        <td>Aprobado</td>
                                        <td>No cambiar este documento</td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td> Copia de tu Carnet</td>
                                    @if($datos_empresa[0]->est_carnet == 1)
                                        <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                        <td>{{$datos_empresa[0]->coment_carnet }}</td>
                                        <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_carnet)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                        <td>
                                            <button   id="id_modificar_carnet"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                        </td>
                                    @else
                                        <td>Aprobado</td>
                                        <td>No cambiar este documento</td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td> Constancia original del 50% de creditos</td>
                                    @if($datos_empresa[0]->est_constancia_creditos == 1)
                                        <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                        <td>{{$datos_empresa[0]->coment_costancia_creditos}}</td>
                                        <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_constancia_creditos)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                        <td>
                                            <button   id="id_modificar_costancia_creditos"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                        </td>
                                    @else
                                        <td>Aprobado</td>
                                        <td>No cambiar este documento</td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>  Solicitud de registro de autorización</td>
                                    @if($datos_empresa[0]->est_solicitud_reg_autori == 1)
                                        <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                        <td>{{$datos_empresa[0]->coment_solicitud_reg_autori }}</td>
                                        <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_solicitud_reg_autori)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                        <td>
                                            <button   id="id_modificar_solicitud_registro"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                        </td>
                                    @else
                                        <td>Aprobado</td>
                                        <td>No cambiar este documento</td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>

                                </tbody>
                            </table>
</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                <div class="tw:w-full tw:px-2">
                                    <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar documentacion" data-toggle="modal" data-target="#enviar_registro_servicio">Enviar documentación</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

          @else
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                                <p class="tw:text-red-600 tw:dark:text-red-400">Corrige lo indicado en los comentarios de los documentos rechazados.</p>
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                    <thead>
                                    <tr>
                                        <th>Nombre del documento</th>
                                        <th>Estado</th>
                                        <th>Comentario</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> Copia de tu CURP</td>
                                        @if($datos_empresa[0]->est_curp == 1)
                                            <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                            <td>{{$datos_empresa[0]->coment_curp }}</td>
                                            <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_curp)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_modificar_curp"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @else
                                            <td>Aprobado</td>
                                            <td>No cambiar este documento</td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td> Copia de tu Carnet</td>
                                        @if($datos_empresa[0]->est_carnet == 1)
                                            <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                            <td>{{$datos_empresa[0]->coment_carnet }}</td>
                                            <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_carnet)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_modificar_carnet"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @else
                                            <td>Aprobado</td>
                                            <td>No cambiar este documento</td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td> Constancia original del 50% de creditos</td>
                                        @if($datos_empresa[0]->est_constancia_creditos  == 1)
                                            <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                            <td>{{$datos_empresa[0]->coment_constancia_creditos}}</td>
                                            <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_constancia_creditos)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_modificar_costancia_creditos"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @else
                                            <td>Aprobado</td>
                                            <td>No cambiar este documento</td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>  Solicitud de registro de autorización</td>
                                        @if($datos_empresa[0]->est_solicitud_reg_autori   == 1)
                                            <td class="tw:text-red-600 tw:dark:text-red-400">Rechazado</td>
                                            <td>{{$datos_empresa[0]->coment_solicitud_reg_autori  }}</td>
                                            <td><a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$datos_empresa[0]->pdf_solicitud_reg_autori)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></td>

                                            <td>
                                                <button   id="id_modificar_solicitud_registro"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >Modificar</button>

                                            </td>
                                        @else
                                            <td>Aprobado</td>
                                            <td>No cambiar este documento</td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>

                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                    <div class="tw:w-full tw:px-2">
                                        <button   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar documentacion" data-toggle="modal" data-target="#enviar_registro_servicio">Enviar documentación</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                    @endif
                @elseif($registro_tipo_empresa[0]->id_estado_enviado == 3)
            <x-panel.alerta tipo="exito" class="tw:mb-4">Se envió correctamente la documentación al Departamento del Servicio Social y Residencia Profesional.</x-panel.alerta>
        @elseif($registro_tipo_empresa[0]->id_estado_enviado == 4)
            <x-panel.alerta tipo="exito" class="tw:mb-4">Tu documentación de la primera etapa fue autorizada por Departamento de Servicio social y Residencia</x-panel.alerta>
        @endif
        {{--inicio Enviar registro de empresa  privada--}}
        <x-panel.modal id="enviar_registro_servicio" tamano="sm" sin-relleno clase-cerrar="close">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Enviar documentos</h4>
                        </div>
                        <form method="POST" id="enviar_doc_mod" action="{{ url("/servicio_social/enviar_registro_servicio/{$registro_tipo_empresa[0]->id_datos_alumnos}") }}">
                            @csrf
                        <div class="tw-modal-cuerpo">
                            <p>¿Seguro que quieres, enviar tus documentos  de la primera etapa del Servicio Social con las modificaciones al Departamento de Servicio Social y Recidencia Profesional para su revisión?</p>
                        </div>
                        </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button  id="documentacion_mod" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                        </div>
                    </x-panel.modal>

        {{-- fin de Enviar registro de empresa  privada--}}
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
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar anexo técnico</h4>
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
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar CURP</h4>
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

    </main>

    <script type="text/javascript">
        $(document).ready( function() {

            $(".modificar_privada").click(function (event) {
                var id_empresa_privada=$(this).attr('id');
                $("#modal_modificar_documento").modal('show');
            });

            $(".modificar_publica").click(function (event) {
                var id_empresa_privada=$(this).attr('id');
                $("#modal_modificar_documento_publica").modal('show');
            });
            $("#documentacion_mod").click(function (event) {
                $("#enviar_doc_mod").submit();
                $("#documentacion_mod").attr("disabled", true);
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


        });
    </script>



</div>
@endsection