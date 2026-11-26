<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:p-5 tw:sm:p-6">
                <label>No. Cuenta : {{ $alumno->cuenta }}</label>
                <label>Nombre de  Estudiante: {{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }} </label>
            </div>
        </div>
    </div>
</div>
<form action="{{url("/residencia/enviar_alumno_documentacion_sin_convenio/".$documentos->id_alumno."/".$documentos->id_periodo."/".$documentos->id_estado_convenio)}}"  id="formulario_empresa_privada" role="form" method="POST" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->solicitud_residencia == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Solicitud de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_solicitud_residencia)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                        <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="solicitud_residencia" id="solicitud_residencia" value="{{$documentos->solicitud_residencia}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Solicitud de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_solicitud_residencia)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="solicitud_residencia" id="solicitud_residencia" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                    <option value=1 selected="selected">Rechazado</option>
                                    <option value="2">Autorizado</option>
                            </select>
                        </div>

                <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_solicitud_residencia">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4">
                            <label for="domicilio3">Comentario para la modificación de la Solicitud de Residencia Profesional</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_solicitud_residencia" name="comentario_solicitud_residencia" rows="2"   required>{{ $documentos->comentario_solicitud_residencia }}</textarea>
                        </div>
                    </div>
                </div>

                @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->constancia_avance_academico == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Constancia de 80% de avance académico: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_constancia_avance_academico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="constancia_avance_academico" id="constancia_avance_academico" value="{{$documentos->constancia_avance_academico}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Constancia de 80% de avance académico: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_constancia_avance_academico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="constancia_avance_academico" id="constancia_avance_academico" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_constancia_avance_academico">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación de la Constancia de 80% de avance académico</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_constancia_avance_academico" name="comentario_constancia_avance_academico" rows="2"   required>{{ $documentos->comentario_constancia_avance_academico }}</textarea>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->comprobante_seguro == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.): <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_comprobante_seguro)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="comprobante_seguro" id="comprobante_seguro" value="{{$documentos->comprobante_seguro}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.): <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_comprobante_seguro)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="comprobante_seguro" id="comprobante_seguro" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_comprobante_seguro">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación del Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_comprobante_seguro" name="comentario_comprobante_seguro" rows="2"   required>{{ $documentos->comentario_comprobante_seguro }}</textarea>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->oficio_asignacion_jefatura == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Oficio de Asignación del Proyecto emitido por la Jefatura de División: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_oficio_asignacion_jefatura)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="oficio_asignacion_jefatura" id="oficio_asignacion_jefatura" value="{{$documentos->oficio_asignacion_jefatura}}" >

                    @else

                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="oficio_asignacion_jefatura" id="oficio_asignacion_jefatura" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_oficio_asignacion_jefatura">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación del Oficio de Asignación del Proyecto emitido por la Jefatura de División</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_oficio_asignacion_jefatura" name="comentario_oficio_asignacion_jefatura" rows="2"   required>{{ $documentos->comentario_oficio_asignacion_jefatura }}</textarea>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->oficio_aceptacion_empresa == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Oficio de Aceptación por parte de la empresa en hoja Membretada: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_oficio_aceptacion_empresa)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="oficio_aceptacion_empresa" id="oficio_aceptacion_empresa" value="{{$documentos->oficio_aceptacion_empresa}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Oficio de Aceptación por parte de la empresa en hoja Membretada: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_oficio_aceptacion_empresa)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="oficio_aceptacion_empresa" id="oficio_aceptacion_empresa" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_oficio_aceptacion_empresa">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación del Oficio de Aceptación por parte de la empresa en hoja Membretada</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_oficio_aceptacion_empresa" name="comentario_oficio_aceptacion_empresa" rows="2"   required>{{ $documentos->comentario_oficio_aceptacion_empresa }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->oficio_presentacion_tecnologico == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Oficio de Presentación por parte del TESVB: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_oficio_presentacion_tecnologico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="oficio_presentacion_tecnologico" id="oficio_presentacion_tecnologico" value="{{$documentos->oficio_presentacion_tecnologico}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Oficio de Presentación por parte del TESVB: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_oficio_presentacion_tecnologico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="oficio_presentacion_tecnologico" id="oficio_presentacion_tecnologico" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_oficio_presentacion_tecnologico">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación del Oficio de Presentación por parte del TESVB</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_oficio_presentacion_tecnologico" name="comentario_oficio_presentacion_tecnologico" rows="2"   required>{{ $documentos->comentario_oficio_presentacion_tecnologico }}</textarea>
                                </div>
                            </div>
                        </div>
                   @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->anteproyecto == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Anteproyecto con el Visto Bueno de la Academia: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_anteproyecto)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="anteproyecto" id="anteproyecto" value="{{$documentos->anteproyecto}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Anteproyecto con el Visto Bueno de la Academia: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_anteproyecto)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="anteproyecto" id="anteproyecto" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_anteproyecto">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación del Anteproyecto con el Visto Bueno de la Academia</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_anteproyecto" name="comentario_anteproyecto" rows="2"   required>{{ $documentos->comentario_anteproyecto }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    @if($documentos->carta_compromiso == 2)
                        <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                            <label>Carta de compromiso firmada por el Asesor Interno y revisor: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_carta_compromiso)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                            <b>Autorizado</b>
                        </div>
                        <input type="hidden" name="carta_compromiso" id="carta_compromiso" value="{{$documentos->carta_compromiso}}" >

                    @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Carta de compromiso firmada por el Asesor Interno y revisor: <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_carta_compromiso)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                    </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                            <select name="carta_compromiso" id="carta_compromiso" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option value=1 selected="selected">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>

                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_carta_compromiso">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domicilio3">Comentario para la modificación de la Carta de compromiso firmada por el Asesor Interno y revisor</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_carta_compromiso" name="comentario_carta_compromiso" rows="2"   required>{{ $documentos->comentario_carta_compromiso }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($documentos->id_estado_convenio == 1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                        @if($documentos->convenio_empresa == 2)
                            <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                                <label>Convenio con la empresa (opcional): <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_convenio_empresa)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>
                                <b>Autorizado</b>
                            </div>
                            <input type="hidden" name="convenio_empresa" id="convenio_empresa" value="{{$documentos->convenio_empresa}}" >

                        @else
                        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                            <label>Convenio con la empresa (opcional): <a  target="_blank" href="{{asset('/residencia_pdf/'.$documentos->pdf_convenio_empresa)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

                        </div>
                            <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                                <select name="convenio_empresa" id="convenio_empresa" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                    <option value=1 selected="selected">Rechazado</option>
                                    <option value="2">Autorizado</option>
                                </select>
                            </div>

                            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_convenio_empresa">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="domicilio3">Comentario para la modificación del Convenio con la empresa (opcional)</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_convenio_empresa" name="comentario_convenio_empresa" rows="2"   required>{{ $documentos->comentario_convenio_empresa }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Enviar</button>
    </div>

</form>
<script type="text/javascript">
    $(document).ready( function() {
        $("#solicitud_residencia").change(function (e) {
            var id_solicitud_residencia = e.target.value;
            $('#comentario_solicitud_residencia').empty();
            if (id_solicitud_residencia == 1) {

                $("#comentario_solicitud_residencia").css("display", "block");
                $('#comentario_solicitud_residencia').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Solicitud de Residencia Profesional</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_solicitud_residencia\" name=\"comentario_solicitud_residencia\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_solicitud_residencia == 2) {
                $("#comentario_solicitud_residencia").css("display", "none");

            }
        });

        $("#constancia_avance_academico").change(function (e) {
            var id_constancia_avance_academico = e.target.value;
            $('#comentario_constancia_avance_academico').empty();
            if (id_constancia_avance_academico == 1) {

                $("#comentario_constancia_avance_academico").css("display", "block");
                $('#comentario_constancia_avance_academico').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Constancia de 80% de avance académico</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_constancia_avance_academico\" name=\"comentario_constancia_avance_academico\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_solicitud_residencia == 2) {
                $("#comentario_constancia_avance_academico").css("display", "none");

            }
        });

        $("#comprobante_seguro").change(function (e) {
            var id_comprobante_seguro = e.target.value;
            $('#comentario_comprobante_seguro').empty();
            if (id_comprobante_seguro == 1) {

                $("#comentario_comprobante_seguro").css("display", "block");
                $('#comentario_comprobante_seguro').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Comprobante de seguro médico (IMSS, ISSSTE, ISSEMYM, etc.)</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_comprobante_seguro\" name=\"comentario_comprobante_seguro\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_solicitud_residencia == 2) {
                $("#comentario_comprobante_seguro").css("display", "none");

            }
        });

        $("#oficio_asignacion_jefatura").change(function (e) {
            var id_oficio_asignacion_jefatura = e.target.value;
            $('#comentario_oficio_asignacion_jefatura').empty();
            if (id_oficio_asignacion_jefatura == 1) {

                $("#comentario_oficio_asignacion_jefatura").css("display", "block");
                $('#comentario_oficio_asignacion_jefatura').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Oficio de Asignación del Proyecto emitido por la Jefatura de División</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_oficio_asignacion_jefatura\" name=\"comentario_oficio_asignacion_jefatura\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_oficio_asignacion_jefatura == 2) {
                $("#comentario_oficio_asignacion_jefatura").css("display", "none");

            }
        });
        $("#oficio_aceptacion_empresa").change(function (e) {
            var id_oficio_aceptacion_empresa = e.target.value;
            $('#comentario_oficio_aceptacion_empresa').empty();
            if (id_oficio_aceptacion_empresa == 1) {

                $("#comentario_oficio_aceptacion_empresa").css("display", "block");
                $('#comentario_oficio_aceptacion_empresa').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Oficio de Aceptación por parte de la empresa en hoja Membretada</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_oficio_aceptacion_empresa\" name=\"comentario_oficio_aceptacion_empresa\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_oficio_aceptacion_empresa == 2) {
                $("#comentario_oficio_aceptacion_empresa").css("display", "none");

            }
        });

        $("#oficio_presentacion_tecnologico").change(function (e) {
            var id_oficio_presentacion_tecnologico = e.target.value;
            $('#comentario_oficio_presentacion_tecnologico').empty();
            if (id_oficio_presentacion_tecnologico == 1) {

                $("#comentario_oficio_presentacion_tecnologico").css("display", "block");
                $('#comentario_oficio_presentacion_tecnologico').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Oficio de Presentación por parte del TESVB</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_oficio_presentacion_tecnologico\" name=\"comentario_oficio_presentacion_tecnologico\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_oficio_presentacion_tecnologico == 2) {
                $("#comentario_oficio_presentacion_tecnologico").css("display", "none");

            }
        });

        $("#anteproyecto").change(function (e) {
            var id_anteproyecto = e.target.value;
            $('#comentario_anteproyecto').empty();
            if (id_anteproyecto == 1) {

                $("#comentario_anteproyecto").css("display", "block");
                $('#comentario_anteproyecto').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Anteproyecto con el Visto Bueno de la Academia</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_anteproyecto\" name=\"comentario_anteproyecto\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_anteproyecto == 2) {
                $("#comentario_anteproyecto").css("display", "none");

            }
        });

        $("#carta_compromiso").change(function (e) {
            var id_carta_compromiso = e.target.value;
            $('#comentario_carta_compromiso').empty();
            if (id_carta_compromiso == 1) {

                $("#comentario_carta_compromiso").css("display", "block");
                $('#comentario_carta_compromiso').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Carta de compromiso firmada por el Asesor Interno y revisor</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_carta_compromiso\" name=\"comentario_carta_compromiso\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_carta_compromiso == 2) {
                $("#comentario_carta_compromiso").css("display", "none");

            }
        });
        $("#convenio_empresa").change(function (e) {
            var id_convenio_empresa = e.target.value;
            $('#comentario_convenio_empresa').empty();
            if (id_convenio_empresa == 1) {

                $("#comentario_convenio_empresa").css("display", "block");
                $('#comentario_convenio_empresa').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Carta de compromiso firmada por el Asesor Interno y revisor</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_convenio_empresa\" name=\"comentario_convenio_empresa\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_convenio_empresa == 2) {
                $("#comentario_convenio_empresa").css("display", "none");

            }
        });
    });
</script>