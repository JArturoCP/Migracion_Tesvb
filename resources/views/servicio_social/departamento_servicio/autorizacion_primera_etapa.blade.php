
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:p-5 tw:sm:p-6">
                <label>No. Cuenta : {{ $registro_tipo_empresa[0]->cuenta }}</label>
                <label>Nombre de  Estudiante: {{ $registro_tipo_empresa[0]->nombre }} {{ $registro_tipo_empresa[0]->apaterno }} {{ $registro_tipo_empresa[0]->amaterno }} </label>
                <label>Tipo de Empresa: {{ $registro_tipo_empresa[0]->tipo_empresa }}</label>

            </div>
        </div>

    </div>
</div>
@if($tipo_empresa == 1)
    <form action="{{url("/servicio_social/enviar_primeraetapa/".$registro_tipo_empresa[0]->id_datos_alumnos)}}"  id="formulario_empresa_privada" role="form" method="POST" >
        {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
            <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
            <label>Carta de aceptación (solo empresa privada): <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_carta_aceptacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label> </label>

        </div>
        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
            <select name="carta_aceptacion" id="carta_aceptacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                <option disabled selected>Selecciona...</option>
                <option value="1">Rechazado</option>
                <option value="2">Autorizado</option>
            </select>
        </div>
            </div>
 <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_carta" style="display:none;">

 </div>
        </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Anexo Tecnico (solo empresa privada):<a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_anexo_tecnico)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a> </label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                        <select name="anexo_tecnico" id="anexo_tecnico" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option disabled selected>Selecciona...</option>
                            <option value="1">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_anexo" style="display:none;">
                </div>
            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Copia de tu CURP: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_curp)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                        <select name="curp" id="curp" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option disabled selected>Selecciona...</option>
                            <option value="1">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_curp" style="display:none;">
                </div>
            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Copia de tu Carnet: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_carnet)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                        <select name="carnet" id="carnet" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option disabled selected>Selecciona...</option>
                            <option value="1">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_carnet" style="display:none;">

                </div>
            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Constancia original del 50% de creditos: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_constancia_creditos)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                        <select name="constancia_creditos" id="constancia_creditos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option disabled selected>Selecciona...</option>
                            <option value="1">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_constancia_creditos" style="display:none;">

                </div>
            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                        <label>Solicitud de registro de autorización: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_solicitud_reg_autori)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                        <select name="solicitud_registro" id="solicitud_registro" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            <option disabled selected>Selecciona...</option>
                            <option value="1">Rechazado</option>
                            <option value="2">Autorizado</option>
                        </select>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_solicitud_registro" style="display:none;">

                </div>
            </div>
        </div>
    </div>



    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
        <div class="tw:w-full tw:px-2">
            <button  id="aceptar_empresa_privada"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar</button>
        </div>
        <p class="tw:w-full"></p>
    </div>
    </form>

    @elseif($tipo_empresa == 2)
    <form action="{{url("/servicio_social/enviar_primeraetapa/".$registro_tipo_empresa[0]->id_datos_alumnos)}}"  id="formulario_empresa_publica" role="form" method="POST" >
        {{ csrf_field() }}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                            <label>Copia de tu CURP: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_curp)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                        </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                            <select name="curp" id="curp" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option disabled selected>Selecciona...</option>
                                <option value="1">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_curp" style="display:none;">
                    </div>
                </div>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                            <label>Copia de tu Carnet: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_carnet)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                        </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                            <select name="carnet" id="carnet" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option disabled selected>Selecciona...</option>
                                <option value="1">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_carnet" style="display:none;">

                    </div>
                </div>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                            <label>Constancia original del 50% de creditos: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_constancia_creditos)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                        </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                            <select name="constancia_creditos" id="constancia_creditos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option disabled selected>Selecciona...</option>
                                <option value="1">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_constancia_creditos" style="display:none;">

                    </div>
                </div>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">
                            <label>Solicitud de registro de autorización: <a  target="_blank" href="{{asset('/servicio_social_pdf/primera_etapa/'.$documentacion[0]->pdf_solicitud_reg_autori)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</a></label>

                        </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-left">
                            <select name="solicitud_registro" id="solicitud_registro" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option disabled selected>Selecciona...</option>
                                <option value="1">Rechazado</option>
                                <option value="2">Autorizado</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="comentario_solicitud_registro" style="display:none;">

                    </div>
                </div>
            </div>
        </div>



        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
            <div class="tw:w-full tw:px-2">
                <button  id="aceptar_empresa_publica"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar</button>
            </div>
            <p class="tw:w-full"></p>
        </div>
    </form>

@endif
<script type="text/javascript">
    $(document).ready( function() {
        $("#carta_aceptacion").change(function (e) {
            var id_carta_aceptacion = e.target.value;
            $('#comentario_carta').empty();
            if (id_carta_aceptacion == 1) {

                $("#comentario_carta").css("display", "block");
                $('#comentario_carta').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                <div class=\"form-group\">\n" +
                    "                    <label for=\"domicilio3\">Comentario para la modificación de la Carta de aceptacion</label>\n" +
                    "                    <textarea class=\"form-control\" id=\"comentario_carta\" name=\"comentario_carta\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                </div>\n" +
                    "            </div>");

            }
            if (id_carta_aceptacion == 2) {
                $("#comentario_carta").css("display", "none");

            }
        });
        $("#anexo_tecnico").change(function (e) {

            var id_anexo_tecnico = e.target.value;
            $('#comentario_anexo').empty();
            if (id_anexo_tecnico == 1) {

                $("#comentario_anexo").css({ "display": "block"});
                $('#comentario_anexo').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                        <div class=\"form-group\">\n" +
                    "                            <label for=\"domicilio3\">Comentario para la modificación del Anexo Tecnico</label>\n" +
                    "                            <textarea class=\"form-control\" id=\"comentario_anexo\" name=\"comentario_anexo\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                        </div>\n" +
                    "                    </div>");

            }
            if (id_anexo_tecnico == 2) {
                $("#comentario_anexo").css("display", "none");

            }
        });
        $("#curp").change(function (e) {
            var id_curp = e.target.value;
            $('#comentario_curp').empty();
            if (id_curp == 1) {

                $("#comentario_curp").css({ "display": "block"});
                $('#comentario_curp').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                        <div class=\"form-group\">\n" +
                    "                            <label for=\"domicilio3\">Comentario para la modificación de la Copia de tu CURP:</label>\n" +
                    "                            <textarea class=\"form-control\" id=\"comentario_curp\" name=\"comentario_curp\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                        </div>\n" +
                    "                    </div>");

            }
            if (id_curp == 2) {
                $("#comentario_curp").css("display", "none");

            }
        });
        $("#carnet").change(function (e) {
            var id_carnet = e.target.value;
            $('#comentario_carnet').empty();
            if (id_carnet == 1) {

                $("#comentario_carnet").css({ "display": "block"});
                $('#comentario_carnet').append(" <div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                        <div class=\"form-group\">\n" +
                    "                            <label for=\"domicilio3\">Comentario para la modificación de la Copia de tu Carnet:</label>\n" +
                    "                            <textarea class=\"form-control\" id=\"comentario_carnet\" name=\"comentario_carnet\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                        </div>\n" +
                    "                    </div>");

            }
            if (id_carnet == 2) {
                $("#comentario_carnet").css("display", "none");

            }
        });
        $("#constancia_creditos").change(function (e) {
            var id_constancia_creditos = e.target.value;
            $('#comentario_constancia_creditos').empty();
            if (id_constancia_creditos == 1) {

                $("#comentario_constancia_creditos").css({ "display": "block"});
                $('#comentario_constancia_creditos').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                        <div class=\"form-group\">\n" +
                    "                            <label for=\"domicilio3\">Comentario para la modificación de la Constancia original del 50% de creditos :</label>\n" +
                    "                            <textarea class=\"form-control\" id=\"comentario_constancia_creditos\" name=\"comentario_constancia_creditos\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                        </div>\n" +
                    "                    </div>");

            }
            if (id_constancia_creditos == 2) {
                $("#comentario_constancia_creditos").css("display", "none");

            }
        });
        $("#solicitud_registro").change(function (e) {
            var id_solicitud_registro = e.target.value;
            $('#comentario_solicitud_registro').empty();
            if (id_solicitud_registro == 1) {

                $("#comentario_solicitud_registro").css({ "display": "block"});

                $('#comentario_solicitud_registro').append("<div class=\"col-md-10 col-md-offset-1 \">\n" +
                    "                        <div class=\"form-group\">\n" +
                    "                            <label for=\"domicilio3\">Comentario para la modificación de la Constancia original del 50% de creditos :</label>\n" +
                    "                            <textarea class=\"form-control\" id=\"comentario_solicitud_registro\" name=\"comentario_solicitud_registro\" rows=\"1\"  style=\"\" required></textarea>\n" +
                    "                        </div>\n" +
                    "                    </div>");

            }
            if (id_solicitud_registro == 2) {
                $("#comentario_solicitud_registro").css("display", "none");

            }
        });
        $("#aceptar_empresa_privada").click(function(event){
            var carta_aceptacion = $('#carta_aceptacion').val();
            var anexo_tecnico = $('#anexo_tecnico').val();
            var curp = $('#curp').val();
            var carnet = $('#carnet').val();
            var curp = $('#curp').val();
            var constancia_creditos = $('#constancia_creditos').val();
            var solicitud_registro = $('#solicitud_registro').val();

            if(carta_aceptacion != null && anexo_tecnico != null && curp != null && carnet != null && constancia_creditos != null && solicitud_registro !=null ){
                 if(carta_aceptacion ==2  && anexo_tecnico == 2 && curp == 2 && carnet == 2 && constancia_creditos == 2 && solicitud_registro ==2 ){

                     swal({
                         position: "top",
                         type: "acept",
                         title: "La documentacion del alumno fue aceptada",
                         showConfirmButton: false,
                         timer: 3500
                     });
                     $("#formulario_empresa_privada").submit();

                }
                 else{

                     $("#formulario_empresa_privada").submit();

                 }
                $("#aceptar_empresa_privada").attr("disabled", true);
            }
            else{


                swal({
                    position: "top",
                    type: "error",
                    title: "Hay un campo no seleccionado en el formulario",
                    showConfirmButton: false,
                    timer: 3500
                });

            }
        });
        $("#aceptar_empresa_publica").click(function(event){
            var curp = $('#curp').val();
            var carnet = $('#carnet').val();
            var curp = $('#curp').val();
            var constancia_creditos = $('#constancia_creditos').val();
            var solicitud_registro = $('#solicitud_registro').val();

            if( curp != null && carnet != null && constancia_creditos != null && solicitud_registro !=null ){
                if( curp == 2 && carnet == 2 && constancia_creditos == 2 && solicitud_registro ==2 ){

                    swal({
                        position: "top",
                        type: "acept",
                        title: "La documentacion del alumno fue aceptada",
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $("#formulario_empresa_publica").submit();

                }
                else{

                    $("#formulario_empresa_publica").submit();

                }

            }
            else{


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