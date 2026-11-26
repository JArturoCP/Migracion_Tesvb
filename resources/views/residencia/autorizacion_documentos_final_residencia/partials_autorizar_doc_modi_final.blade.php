<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:p-5 tw:sm:p-6">
                <label>No. Cuenta : {{ $alumno[0]->cuenta }}</label>
                <label>Nombre de  Estudiante: {{ $alumno[0]->alumno }} {{ $alumno[0]->apaterno }} {{ $alumno[0]->amaterno }} </label>
            </div>
        </div>
    </div>
</div>
<form action="{{url("/residencia/enviar_doc_final_dep/".$alumno[0]->id_liberacion_documentos)}}"   role="form" method="POST" >
    {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
            <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                @if($alumno[0]->estado_acta_calificacion == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Acta de Calificación de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_acta_calificacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="acta_calificacion" id="acta_calificacion" value="{{$alumno[0]->estado_acta_calificacion}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Acta de Calificación de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_acta_calificacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="acta_calificacion" id="acta_calificacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_acta_calificacion">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación de la Acta de Calificación de Residencia Profesional</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_acta_calificacion" name="comentario_acta_calificacion" rows="1"   required>{{ $alumno[0]->comentario_acta_calificacion }}</textarea>
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
                @if($alumno[0]->estado_proyecto == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Proyecto Completo de Residencia Profesional: </label>    <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="proyecto" id="proyecto" value="{{$alumno[0]->estado_proyecto}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Proyecto Completo de Residencia Profesional: <b class="tw:text-red-600 tw:dark:text-red-400">Debio ser enviado a su correo</b></label>
                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="proyecto" id="proyecto" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_proyecto">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Proyecto Completo de Residencia Profesional</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_proyecto" name="comentario_proyecto" rows="1"   required>{{ $alumno[0]->comentario_proyecto}}</textarea>
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
                @if($alumno[0]->estado_portada == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Portada de Proyecto de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_portada)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="portada" id="portada" value="{{$alumno[0]->estado_portada}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Portada de Proyecto de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_portada)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="portada" id="portada" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_portada">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación de la Portada de Proyecto de Residencia Profesional</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_portada" name="comentario_portada" rows="1"   required>{{ $alumno[0]->comentario_portada }}</textarea>
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
                @if($alumno[0]->estado_evaluacion_final_residencia == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Evaluación Final de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_evaluacion_final_residencia)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="evaluacion_final_residencia" id="evaluacion_final_residencia" value="{{$alumno[0]->estado_evaluacion_final_residencia}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Evaluación Final de Residencia Profesional: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_evaluacion_final_residencia)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="evaluacion_final_residencia" id="evaluacion_final_residencia" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_evaluacion_final_residencia">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación de la Evaluación Final de Residencia Profesional</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_evaluacion_final_residencia" name="comentario_evaluacion_final_residencia" rows="1"   required>{{ $alumno[0]->comentario_evaluacion_final_residencia }}</textarea>
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
                @if($alumno[0]->estado_oficio_aceptacion_informe_interno == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Oficio de Aceptación de Informe  Final del Asesor  Interno: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_oficio_aceptacion_informe_interno)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                    </div>
                    <input type="hidden" name="oficio_aceptacion_informe_interno" id="oficio_aceptacion_informe_interno" value="{{$alumno[0]->estado_oficio_aceptacion_informe_interno}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Oficio de Aceptación de Informe  Final del Asesor  Interno: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_oficio_aceptacion_informe_interno)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="oficio_aceptacion_informe_interno" id="oficio_aceptacion_informe_interno" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_oficio_aceptacion_informe_interno">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Oficio de Aceptación de Informe  Final del Asesor  Interno</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_oficio_aceptacion_informe_interno" name="comentario_oficio_aceptacion_informe_interno" rows="1"   required>{{ $alumno[0]->comentario_oficio_aceptacion_informe_interno }}</textarea>
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
                @if($alumno[0]->estado_formato_evaluacion == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Formato de Evaluación: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_formato_evaluacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="formato_evaluacion" id="formato_evaluacion" value="{{$alumno[0]->estado_formato_evaluacion}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Formato de Evaluación: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_formato_evaluacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="formato_evaluacion" id="formato_evaluacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_formato_evaluacion">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Formato de Evaluación</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_formato_evaluacion" name="comentario_formato_evaluacion" rows="1"   required>{{ $alumno[0]->comentario_formato_evaluacion }}</textarea>
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
                @if($alumno[0]->estado_oficio_aceptacion_informe_revisor == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Oficio de Aceptación de Informe Final del Revisor: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_oficio_aceptacion_informe_revisor)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="oficio_aceptacion_informe_revisor" id="oficio_aceptacion_informe_revisor" value="{{$alumno[0]->estado_oficio_aceptacion_informe_revisor}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Oficio de Aceptación de Informe Final del Revisor: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_oficio_aceptacion_informe_revisor)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="oficio_aceptacion_informe_revisor" id="oficio_aceptacion_informe_revisor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_oficio_aceptacion_informe_revisor">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Oficio de Aceptación de Informe Final del Revisor</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_oficio_aceptacion_informe_revisor" name="comentario_oficio_aceptacion_informe_revisor" rows="1"   required>{{ $alumno[0]->comentario_oficio_aceptacion_informe_revisor }}</textarea>
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
                @if($alumno[0]->estado_oficio_aceptacion_informe_externo == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Oficio de Aceptación de Informe Final del Asesor Externo: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_oficio_aceptacion_informe_externo)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="oficio_aceptacion_informe_externo" id="oficio_aceptacion_informe_externo" value="{{$alumno[0]->estado_oficio_aceptacion_informe_externo}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Oficio de Aceptación de Informe Final del Asesor Externo: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_oficio_aceptacion_informe_externo)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="oficio_aceptacion_informe_externo" id="oficio_aceptacion_informe_externo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_oficio_aceptacion_informe_externo">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Oficio de Aceptación de Informe Final del Asesor Externo</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_oficio_aceptacion_informe_externo" name="comentario_oficio_aceptacion_informe_externo" rows="1"   required>{{ $alumno[0]->comentario_oficio_aceptacion_informe_externo }}</textarea>
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
                @if($alumno[0]->estado_formato_hora == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Formato de Horas: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_formato_hora)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="formato_hora" id="formato_hora" value="{{$alumno[0]->estado_formato_hora}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Formato de Horas: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_formato_hora)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="formato_hora" id="formato_hora" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_formato_hora">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Formato de Horas</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_formato_hora" name="comentario_formato_hora" rows="1"   required>{{ $alumno[0]->comentario_formato_hora }}</textarea>
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
                @if($alumno[0]->estado_seguimiento_interno == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Formato de Seguimiento Interno: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_seguimiento_interno)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="seguimiento_interno" id="seguimiento_interno" value="{{$alumno[0]->estado_seguimiento_interno}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Formato de Seguimiento Interno: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_seguimiento_interno)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="seguimiento_interno" id="seguimiento_interno" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_seguimiento_interno">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Formato de Seguimiento Interno</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_seguimiento_interno" name="comentario_seguimiento_interno" rows="1"   required>{{ $alumno[0]->comentario_seguimiento_interno }}</textarea>
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
                @if($alumno[0]->estado_seguimiento_externo == 2)
                    <div class="tw:w-full tw:px-2 tw:text-red-600 tw:dark:text-red-400">
                        <label>Formato de Seguimiento Externo: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_seguimiento_externo)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>
                        <b>Autorizado</b>
                    </div>
                    <input type="hidden" name="seguimiento_externo" id="seguimiento_externo" value="{{$alumno[0]->estado_seguimiento_externo}}" >

                @else
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Formato de Seguimiento Externo: <a  target="_blank" href="{{asset('/residencia_pdf_doc_final/'.$alumno[0]->pdf_seguimiento_externo)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">

                        <select name="seguimiento_externo" id="seguimiento_externo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option value=1 selected="selected">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_seguimiento_externo">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Comentario para la modificación del Formato de Seguimiento Externo</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_seguimiento_externo" name="comentario_seguimiento_externo" rows="1"   required>{{ $alumno[0]->comentario_seguimiento_externo }}</textarea>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>
<div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Enviar</button>
</div>
</form>
<script type="text/javascript">
    $(document).ready( function() {
        $("#acta_calificacion").change(function (e) {
            var id_acta_calificacion = e.target.value;
            $('#comentario_acta_calificacion').empty();
            if (id_acta_calificacion == 1) {

                $("#comentario_acta_calificacion").css("display", "block");
                $('#comentario_acta_calificacion').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Acta de Calificación de Residencia Profesional</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_acta_calificacion\" name=\"comentario_acta_calificacion\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_acta_calificacion == 2) {
                $("#comentario_acta_calificacion").css("display", "none");

            }
        });
        $("#proyecto").change(function (e) {
            var id_proyecto = e.target.value;
            $('#comentario_proyecto').empty();
            if (id_proyecto == 1) {

                $("#comentario_proyecto").css("display", "block");
                $('#comentario_proyecto').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para del Proyecto Completo de Residencia Profesional</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_proyecto\" name=\"comentario_proyecto\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_acta_calificacion == 2) {
                $("#comentario_acta_calificacion").css("display", "none");

            }
        });
        $("#portada").change(function (e) {
            var id_portada = e.target.value;
            $('#comentario_portada').empty();
            if (id_portada == 1) {

                $("#comentario_portada").css("display", "block");
                $('#comentario_portada').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para de la Portada de Proyecto de Residencia Profesional</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_portada\" name=\"comentario_portada\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_portada == 2) {
                $("#comentario_portada").css("display", "none");

            }
        });
        $("#evaluacion_final_residencia").change(function (e) {
            var id_evaluacion_final_residencia = e.target.value;
            $('#comentario_evaluacion_final_residencia').empty();
            if (id_evaluacion_final_residencia == 1) {

                $("#comentario_evaluacion_final_residencia").css("display", "block");
                $('#comentario_evaluacion_final_residencia').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Evaluación Final de Residencia Profesional</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_evaluacion_final_residencia\" name=\"comentario_evaluacion_final_residencia\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_evaluacion_final_residencia == 2) {
                $("#comentario_evaluacion_final_residencia").css("display", "none");

            }
        });
        $("#oficio_aceptacion_informe_interno").change(function (e) {
            var id_oficio_aceptacion_informe_interno = e.target.value;
            $('#comentario_oficio_aceptacion_informe_interno').empty();
            if (id_oficio_aceptacion_informe_interno == 1) {

                $("#comentario_oficio_aceptacion_informe_interno").css("display", "block");
                $('#comentario_oficio_aceptacion_informe_interno').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Oficio de Aceptación de Informe  Final del Asesor  Interno </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_oficio_aceptacion_informe_interno\" name=\"comentario_oficio_aceptacion_informe_interno\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_oficio_aceptacion_informe_interno == 2) {
                $("#comentario_oficio_aceptacion_informe_interno").css("display", "none");

            }
        });
        $("#formato_evaluacion").change(function (e) {
            var id_formato_evaluacion = e.target.value;
            $('#comentario_formato_evaluacion').empty();
            if (id_formato_evaluacion == 1) {

                $("#comentario_formato_evaluacion").css("display", "block");
                $('#comentario_formato_evaluacion').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Formato de Evaluación </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_formato_evaluacion\" name=\"comentario_formato_evaluacion\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_formato_evaluacion == 2) {
                $("#comentario_formato_evaluacion").css("display", "none");

            }
        });
        $("#oficio_aceptacion_informe_revisor").change(function (e) {
            var id_oficio_aceptacion_informe_revisor = e.target.value;
            $('#comentario_oficio_aceptacion_informe_revisor').empty();
            if (id_oficio_aceptacion_informe_revisor == 1) {

                $("#comentario_oficio_aceptacion_informe_revisor").css("display", "block");
                $('#comentario_oficio_aceptacion_informe_revisor').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Oficio de Aceptación de Informe Final del Revisor </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_oficio_aceptacion_informe_revisor\" name=\"comentario_oficio_aceptacion_informe_revisor\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_oficio_aceptacion_informe_revisor == 2) {
                $("#comentario_oficio_aceptacion_informe_revisor").css("display", "none");

            }
        });
        $("#oficio_aceptacion_informe_externo").change(function (e) {
            var id_oficio_aceptacion_informe_externo = e.target.value;
            $('#comentario_oficio_aceptacion_informe_externo').empty();
            if (id_oficio_aceptacion_informe_externo == 1) {

                $("#comentario_oficio_aceptacion_informe_externo").css("display", "block");
                $('#comentario_oficio_aceptacion_informe_externo').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Oficio de Aceptación de Informe Final del Asesor Externo </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_oficio_aceptacion_informe_externo\" name=\"comentario_oficio_aceptacion_informe_externo\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_oficio_aceptacion_informe_externo == 2) {
                $("#comentario_oficio_aceptacion_informe_externo").css("display", "none");

            }
        });
        $("#formato_hora").change(function (e) {
            var id_formato_hora = e.target.value;
            $('#comentario_formato_hora').empty();
            if (id_formato_hora == 1) {

                $("#comentario_formato_hora").css("display", "block");
                $('#comentario_formato_hora').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Formato de Horas </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_formato_hora\" name=\"comentario_formato_hora\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_formato_hora == 2) {
                $("#comentario_formato_hora").css("display", "none");

            }
        });
        $("#seguimiento_interno").change(function (e) {
            var id_seguimiento_interno = e.target.value;
            $('#comentario_seguimiento_interno').empty();
            if (id_seguimiento_interno == 1) {

                $("#comentario_seguimiento_interno").css("display", "block");
                $('#comentario_seguimiento_interno').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Formato de Seguimiento Interno </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_seguimiento_interno\" name=\"comentario_seguimiento_interno\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_seguimiento_interno == 2) {
                $("#comentario_seguimiento_interno").css("display", "none");

            }
        });
        $("#seguimiento_externo").change(function (e) {
            var id_seguimiento_externo = e.target.value;
            $('#comentario_seguimiento_externo').empty();
            if (id_seguimiento_externo == 1) {

                $("#comentario_seguimiento_externo").css("display", "block");
                $('#comentario_seguimiento_externo').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación del Formato de Seguimiento Externo </label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_seguimiento_externo\" name=\"comentario_seguimiento_externo\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_seguimiento_externo == 2) {
                $("#comentario_seguimiento_externo").css("display", "none");

            }
        });








    });
</script>