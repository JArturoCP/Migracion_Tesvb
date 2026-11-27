<!-- Modal -->
<div  class="modal tw-modal-compat" :class="{mostrar:modal_opcion_titulacion_reg}" >
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" @click="cerrarModal_opciones_titulacion();">&times;</button>
                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >@{{ titulo_opcion_titulacion }}</h4>
            </div>
            <div class="tw-modal-cuerpo">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-justify"  >Opciones de Titulación</h3>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4">
                            <label for="personal">¿ Elige una opción de titulación ?</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="docu.id_opcion_titulacion">
                                <option disabled selected hidden :value="0">Selecciona una opción</option>
                                <option v-for="respuesta in opciones_titulacion" :value="respuesta.id_opcion_titulacion">@{{respuesta.opcion_titulacion }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <template v-if="docu.id_opcion_titulacion   == 1">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4">
                            <label>Selecciona Caratula final de residencia</label>

                            <input type="file" id="file"  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" accept="application/pdf"  v-on:change="variable_doc_7($event)"/>


                        </div>
                    </div>
                </div>
                </template>
                <template v-if="docu.id_opcion_titulacion   == 2 ||
                 docu.id_opcion_titulacion   == 3 || docu.id_opcion_titulacion   == 4 ||
                 docu.id_opcion_titulacion   == 5 || docu.id_opcion_titulacion   == 6 ||
                 docu.id_opcion_titulacion   == 9 || docu.id_opcion_titulacion   == 10">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label>Selecciona Constancia de Viabilidad</label>

                                <input type="file" id="file"  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" accept="application/pdf"  v-on:change="variable_doc_7($event)"/>


                            </div>
                        </div>
                    </div>
                </template>
                <template v-if="docu.id_opcion_titulacion   == 7">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label>Selecciona Testimonio del examen EGEL</label>

                                <input type="file" id="file"  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" accept="application/pdf"  v-on:change="variable_doc_7($event)"/>


                            </div>
                        </div>
                    </div>
                </template>
                <template v-if="docu.id_opcion_titulacion   == 11">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label>Selecciona constancia de estudios en el programa dual</label>

                                <input type="file" id="file"  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" accept="application/pdf"  v-on:change="variable_doc_7($event)"/>


                            </div>
                        </div>
                    </div>
                </template>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" @click="cerrarModal_opciones_titulacion();">Cerrar</button>
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" @click="guardar_doc_opcion_titulacion();" :disabled="estado_guardar_opcion_titulacion">Guardar</button>
                </div>
            </div>
        </div>

    </div>
</div>