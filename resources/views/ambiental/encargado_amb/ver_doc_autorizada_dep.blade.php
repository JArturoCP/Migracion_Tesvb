@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <div id="autorizar_encargado_doc" x-ignore data-carga-axios>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/ambiental/historial_documentacion")}}">Historial de los procedimientos de ambiental </a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Documentación del Procedimiento Autorizado</span>
                </p>
            </div>
        </div>
        <main class="tw:w-full tw:lg:w-full tw:px-2">
            <x-panel.encabezado :titulo="'Documentación autorizada del periodo '.$periodo[0]->nombre_periodo_amb.' · {{ encargados[0].nombre }} · {{ encargados[0].nom_procedimiento }}'" :migas="['Gestión ambiental' => null]" />
            <template v-if="encargados[0].solic_estado_acc_m1 == 2">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 1</p></h3>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>a) El estado de las acciones de las revisiones por la dirección previas.<br>
                                        <br/>
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_estado_acc_m1  }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_estado_acc_m1 == 1">
                                        <template v-if="encargados[0].estado_estado_acc_m1 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_estado_acc_m1 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_estado_acc_m1 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_estado_acc_m1" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_estado_acc_m1 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_estado_acc_m1 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc1(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_estado_acc_m1 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revisado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_estado_acc_m1 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc1" v-model="encargados[0].comentario_estado_acc_m1" name="comentario_doc1" rows="1"   required>@{{ $encargados[0]->comentario_estado_acc_m1 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_estado_acc_m1 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc1(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_estado_acc_m1 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revisado</p>
                                        </template>
                                    </div>

                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_cuestion_ambas_per_m2 == 2 ||
            encargados[0].solic_necesidades_espectativas_m2 ==  2 ||
            encargados[0].solic_aspecto_ambiental_m2 ==2 ||
            encargados[0].solic_riesgo_oportu_m2 == 2
            ">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 2</p></h3>
            </template>
            <template v-if="encargados[0].solic_cuestion_ambas_per_m2 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p><b>b) Los cambios en:</b> <br> 1) Las cuestiones externas e internas que sean pertinentes
                                        al sistema  de gestión ambiental.<br>
                                        <br/>
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <template v-if="encargados[0].evi_cuestion_ambas_per_m2  == 1">
                                        <label> ¿Existen cambios?:<br> Si
                                            <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_cuestion_ambas_per_m2  }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </label>
                                    </template>
                                    <template v-if="encargados[0].evi_cuestion_ambas_per_m2  == 2">
                                        <label> ¿Existen cambios?: <br>No (No hay documento)
                                        </label>
                                    </template>

                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_cuestion_ambas_per_m2 == 1">
                                        <template v-if="encargados[0].estado_cuestion_ambas_per_m2 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_cuestion_ambas_per_m2 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_cuestion_ambas_per_m2 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_cuestion_ambas_per_m2" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>

                                    <template v-if="encargados[0].estado_cuestion_ambas_per_m2 == 1">

                                        <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                            <template v-if="encargados[0].cal_cuestion_ambas_per_m2 == 0">
                                                <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc2(encargados);" >Guardar</button>
                                            </template>
                                            <template v-if="encargados[0].cal_cuestion_ambas_per_m2 == 1">
                                                <p class="tw:text-red-600 tw:dark:text-red-400" >Revisado</p>
                                            </template>

                                        </div>

                                    </template>
                                </div>


                                <template v-if="encargados[0].estado_cuestion_ambas_per_m2 == 2">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:px-2">
                                            <div class="tw:mb-4">
                                                <label for="domicilio3">Comentario para la modificación </label>
                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc2" v-model="encargados[0].comentario_cuestion_ambas_per_m2" name="comentario_doc2" rows="1"   required>@{{ $encargados[0]->comentario_cuestion_ambas_per_m2 }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:px-2">
                                            <template v-if="encargados[0].cal_cuestion_ambas_per_m2 == 0">
                                                <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc2(encargados);" >Guardar</button>
                                            </template>
                                            <template v-if="encargados[0].cal_cuestion_ambas_per_m2 == 1">
                                                <p class="tw:text-red-600 tw:dark:text-red-400" >Revisado</p>
                                            </template>

                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_necesidades_espectativas_m2 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>2) Las necesidades y expectativas de las partes interesadas , incluidos
                                        los requisitos legales y otros requisitos.<br>
                                        <br/>
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <template v-if="encargados[0].evi_necesidades_espectativas_m2  == 1">
                                        <label> ¿Existen cambios?:<br> Si
                                            <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_necesidades_espectativas_m2  }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </label>
                                    </template>
                                    <template v-if="encargados[0].evi_necesidades_espectativas_m2  == 2">
                                        <label> ¿Existen cambios?: <br>No (No hay documento)
                                        </label>
                                    </template>

                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_necesidades_espectativas_m2 == 1">
                                        <template v-if="encargados[0].estado_necesidades_espectativas_m2 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_necesidades_espectativas_m2 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_necesidades_espectativas_m2 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_necesidades_espectativas_m2" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_necesidades_espectativas_m2 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_necesidades_espectativas_m2 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc3(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_necesidades_espectativas_m2 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>



                                <template v-if="encargados[0].estado_necesidades_espectativas_m2 == 2">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:px-2">
                                            <div class="tw:mb-4">
                                                <label for="domicilio3">Comentario para la modificación </label>
                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc3" v-model="encargados[0].comentario_necesidades_espectativas_m2" name="comentario_doc3" rows="1"   required>@{{ $encargados[0]->comentario_necesidades_espectativas_m2 }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:px-2">
                                            <template v-if="encargados[0].cal_necesidades_espectativas_m2 == 0">
                                                <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc3(encargados);" >Guardar</button>
                                            </template>
                                            <template v-if="encargados[0].cal_necesidades_espectativas_m2 == 1">
                                                <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="encargados[0].solic_aspecto_ambiental_m2 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>3) Sus aspectos ambientales  significativos.<br>
                                        <br/>
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_aspecto_ambiental_m2  }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_aspecto_ambiental_m2 == 1">
                                        <template v-if="encargados[0].estado_aspecto_ambiental_m2 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_aspecto_ambiental_m2 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_aspecto_ambiental_m2 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_aspecto_ambiental_m2" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_aspecto_ambiental_m2 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_aspecto_ambiental_m2 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc4(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_aspecto_ambiental_m2 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_aspecto_ambiental_m2 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc4" v-model="encargados[0].comentario_aspecto_ambiental_m2" name="comentario_doc4" rows="1"   required>@{{ $encargados[0]->comentario_aspecto_ambiental_m2 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_aspecto_ambiental_m2 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc4(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_aspecto_ambiental_m2 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_riesgo_oportu_m2 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>4) Los riesgos y oportunidades<br>
                                        <br/>
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_riesgo_oportu_m2   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_riesgo_oportu_m2 == 1">
                                        <template v-if="encargados[0].estado_riesgo_oportu_m2 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_riesgo_oportu_m2 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_riesgo_oportu_m2 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_riesgo_oportu_m2" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_riesgo_oportu_m2 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_riesgo_oportu_m2 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc5(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_riesgo_oportu_m2 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_riesgo_oportu_m2 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc5" v-model="encargados[0].comentario_riesgo_oportu_m2" name="comentario_doc5" rows="1"   required>@{{ $encargados[0]->comentario_riesgo_oportu_m2 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_riesgo_oportu_m2 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc5(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_riesgo_oportu_m2 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_grado_objetivo_m3 == 2 ||
            encargados[0].solic_programa_gestion_m3 == 2">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 3</p></h3>
            </template>
            <template v-if="encargados[0].solic_grado_objetivo_m3 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p> <b>c) El grado en que se han logrado los objetivos ambientales.</b>
                                        <br/>
                                        1) Objetivos ambientales del S. de G. A.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_grado_objetivo_m3   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_grado_objetivo_m3 == 1">
                                        <template v-if="encargados[0].estado_grado_objetivo_m3 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_grado_objetivo_m3 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_grado_objetivo_m3 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_grado_objetivo_m3" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_grado_objetivo_m3 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_grado_objetivo_m3== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc6(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_grado_objetivo_m3== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_grado_objetivo_m3 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc6" v-model="encargados[0].comentario_grado_objetivo_m3" name="comentario_doc6" rows="1"   required>@{{ $encargados[0]->comentario_grado_objetivo_m3 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_grado_objetivo_m3== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc6(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_grado_objetivo_m3== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_programa_gestion_m3 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        2) Programa de G. A.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_programa_gestion_m3   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_programa_gestion_m3 == 1">
                                        <template v-if="encargados[0].estado_programa_gestion_m3 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_programa_gestion_m3 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_programa_gestion_m3 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_programa_gestion_m3" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_programa_gestion_m3 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_programa_gestion_m3== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc7(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_programa_gestion_m3== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_programa_gestion_m3 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc7" v-model="encargados[0].comentario_programa_gestion_m3" name="comentario_doc7" rows="1"   required>@{{ $encargados[0]->comentario_programa_gestion_m3 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_programa_gestion_m3== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc7(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_programa_gestion_m3== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_noconformid_correctivas_m4 == 2 ||
            encargados[0].solic_resu_seg_med_m4 == 2 ||
            encargados[0].solic_cumplimiento_req_m4 == 2 ||
             encargados[0].solic_resultado_audi_m4 == 2   ">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 4</p></h3>
            </template>
            <template v-if="encargados[0].solic_noconformid_correctivas_m4 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p> <b>d) La información sobre el desempeño ambiental de la organización,
                                            incluidas las tendencias relativas a:</b> <br>
                                        1) No conformidades y acciones correctivas.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_noconformid_correctivas_m4   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_noconformid_correctivas_m4 == 1">
                                        <template v-if="encargados[0].estado_noconformid_correctivas_m4 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_noconformid_correctivas_m4 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_noconformid_correctivas_m4 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_noconformid_correctivas_m4" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_noconformid_correctivas_m4 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_noconformid_correctivas_m4== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc8(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_noconformid_correctivas_m4== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_noconformid_correctivas_m4 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc8" v-model="encargados[0].comentario_noconformid_correctivas_m4" name="comentario_doc8" rows="1"   required>@{{ $encargados[0]->comentario_noconformid_correctivas_m4 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_noconformid_correctivas_m4== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc8(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_noconformid_correctivas_m4== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_resu_seg_med_m4 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        2) Resultados de seguimiento y medición.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_resu_seg_med_m4 }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_resu_seg_med_m4 == 1">
                                        <template v-if="encargados[0].estado_resu_seg_med_m4 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_resu_seg_med_m4 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_resu_seg_med_m4 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_resu_seg_med_m4" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_resu_seg_med_m4 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_resu_seg_med_m4== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc9(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_resu_seg_med_m4== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_resu_seg_med_m4 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc9" v-model="encargados[0].comentario_resu_seg_med_m4" name="comentario_doc9" rows="1"   required>@{{ $encargados[0]->comentario_resu_seg_med_m4 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_resu_seg_med_m4== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc9(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_resu_seg_med_m4== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_cumplimiento_req_m4 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        3) Cumplimiento de los requisitos legales y otros requisitos.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_cumplimiento_req_m4 }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_cumplimiento_req_m4 == 1">
                                        <template v-if="encargados[0].estado_cumplimiento_req_m4 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_cumplimiento_req_m4 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_cumplimiento_req_m4 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_cumplimiento_req_m4" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_cumplimiento_req_m4 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_cumplimiento_req_m4== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc10(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_cumplimiento_req_m4== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_cumplimiento_req_m4 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc10" v-model="encargados[0].comentario_cumplimiento_req_m4" name="comentario_doc10" rows="1"   required>@{{ $encargados[0]->comentario_cumplimiento_req_m4 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_cumplimiento_req_m4== 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc10(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_cumplimiento_req_m4== 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_resultado_audi_m4 == 2">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        4)Resultados de las auditorias.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_resultado_audi_m4 }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_resultado_audi_m4 == 1">
                                        <template v-if="encargados[0].estado_resultado_audi_m4 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_resultado_audi_m4 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_resultado_audi_m4 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_resultado_audi_m4" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_resultado_audi_m4 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_resultado_audi_m4 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc11(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_resultado_audi_m4 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_resultado_audi_m4 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc11" v-model="encargados[0].comentario_resultado_audi_m4" name="comentario_doc11" rows="1"   required>@{{ $encargados[0]->comentario_resultado_audi_m4 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_resultado_audi_m4 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc11(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_resultado_audi_m4 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_adecuacion_recurso_m5 == 2">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 5</p></h3>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        e)Adecuación de los recursos .
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <template v-if="encargados[0].evi_adecuacion_recurso_m5 == 1">
                                        <label> ¿ Requiere adecuación de recursos ?: Si
                                            <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_adecuacion_recurso_m5 }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </label>
                                    </template>
                                    <template v-if="encargados[0].evi_adecuacion_recurso_m5 == 2">
                                        <label> ¿ Requiere adecuación de recursos ?: No
                                        </label>
                                    </template>


                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_adecuacion_recurso_m5 == 1">
                                        <template v-if="encargados[0].estado_adecuacion_recurso_m5 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_adecuacion_recurso_m5 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_adecuacion_recurso_m5 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_adecuacion_recurso_m5" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_adecuacion_recurso_m5 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_adecuacion_recurso_m5 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc12(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_adecuacion_recurso_m5 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_adecuacion_recurso_m5 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc12" v-model="encargados[0].comentario_adecuacion_recurso_m5" name="comentario_doc12" rows="1"   required>@{{ $encargados[0]->comentario_adecuacion_recurso_m5 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_adecuacion_recurso_m5 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc12(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_adecuacion_recurso_m5 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_comunicacion_pertinente_m6 == 2">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 6</p></h3>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        f)Las comunicaciones pertinentes de las partes interesadas, incluidas las quejas.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">

                                    <label> Documento: Si
                                        <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_comunicacion_pertinente_m6 }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                    </label>



                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_comunicacion_pertinente_m6 == 1">
                                        <template v-if="encargados[0].estado_comunicacion_pertinente_m6 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-if="encargados[0].estado_comunicacion_pertinente_m6 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_comunicacion_pertinente_m6 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_comunicacion_pertinente_m6" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_comunicacion_pertinente_m6 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_comunicacion_pertinente_m6 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc13(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_comunicacion_pertinente_m6 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_comunicacion_pertinente_m6 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc13" v-model="encargados[0].comentario_comunicacion_pertinente_m6" name="comentario_doc13" rows="1"   required>@{{ $encargados[0]->comentario_comunicacion_pertinente_m6 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_comunicacion_pertinente_m6 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc13(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_comunicacion_pertinente_m6 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="encargados[0].solic_oportunidades_mejora_m7 == 2">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 7</p></h3>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <p>
                                        g)Las oportunidades de mejora continua.
                                    </p>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <template v-if="encargados[0].evi_oportunidades_mejora_m7 == 1">
                                        <label> ¿ Presenta oportunidades de mejora continua ?: Si
                                            <a  target="_blank" href="/sub_vinculacion/@{{encargados[0].pdf_oportunidades_mejora_m7 }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </label>
                                    </template>
                                    <template v-if="encargados[0].evi_oportunidades_mejora_m7 == 2">
                                        <label> ¿ Presenta oportunidades de mejora continua ?: No
                                        </label>
                                    </template>


                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2 tw:text-left" >
                                    <template v-if="encargados[0].cal_oportunidades_mejora_m7 == 1">
                                        <template v-if="encargados[0].estado_oportunidades_mejora_m7 == 1">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400"  >  SI</h4>
                                        </template>
                                        <template v-elseif="encargados[0].estado_oportunidades_mejora_m7 == 2">
                                            <label for="personal">Autorizado</label>
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400" >   NO</h4>
                                        </template>

                                    </template>
                                    <template v-if="encargados[0].cal_oportunidades_mejora_m7 == 0">
                                        <div class="tw:mb-4">
                                            <label for="personal">Autorizar</label>
                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="encargados[0].estado_oportunidades_mejora_m7" >
                                                <option disabled selected hidden :value="0">Selecciona</option>
                                                <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                                <template v-if="encargados[0].estado_oportunidades_mejora_m7 == 1">

                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <template v-if="encargados[0].cal_oportunidades_mejora_m7 == 0">
                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc14(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_oportunidades_mejora_m7 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>

                                </template>
                            </div>


                            <template v-if="encargados[0].estado_oportunidades_mejora_m7 == 2">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domicilio3">Comentario para la modificación </label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_doc12" v-model="encargados[0].comentario_oportunidades_mejora_m7" name="comentario_doc12" rows="2"   required>@{{ $encargados[0]->comentario_oportunidades_mejora_m7 }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <template v-if="encargados[0].cal_oportunidades_mejora_m7 == 0">

                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="guardar_resp_doc14(encargados);" >Guardar</button>
                                        </template>
                                        <template v-if="encargados[0].cal_oportunidades_mejora_m7 == 1">
                                            <p class="tw:text-red-600 tw:dark:text-red-400" >Revizado</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </main>
        @include('ambiental.jefe_ambiental.validar_doc1')
        @include('ambiental.jefe_ambiental.validar_doc2')
        @include('ambiental.jefe_ambiental.validar_doc3')
        @include('ambiental.jefe_ambiental.validar_doc4')
        @include('ambiental.jefe_ambiental.validar_doc5')
        @include('ambiental.jefe_ambiental.validar_doc6')
        @include('ambiental.jefe_ambiental.validar_doc7')
        @include('ambiental.jefe_ambiental.validar_doc8')
        @include('ambiental.jefe_ambiental.validar_doc9')
        @include('ambiental.jefe_ambiental.validar_doc10')
        @include('ambiental.jefe_ambiental.validar_doc11')
        @include('ambiental.jefe_ambiental.validar_doc12')
        @include('ambiental.jefe_ambiental.validar_doc13')
        @include('ambiental.jefe_ambiental.validar_doc14')


    </div>
    <script>
        new Vue({
            el:"#autorizar_encargado_doc",

            data(){
                return {
                    //objeto donde se va a guardar los datos de un procedimiento
                    encargado:{
                        id_encargado:0,
                        id_periodo_amb:0,
                        evi_estado_acc_m1:0,
                        estado_estado_acc_m1:0,
                        pdf_estado_acc_m1:"",
                        comentario_estado_acc_m1:"",
                        evi_cuestion_ambas_per_m2:0,
                        estado_cuestion_ambas_per_m2:0,
                        pdf_cuestion_ambas_per_m2:"",
                        comentario_cuestion_ambas_per_m2:"",
                        evi_necesidades_espectativas_m2:0,
                        estado_necesidades_espectativas_m2:0,
                        pdf_necesidades_espectativas_m2:"",
                        comentario_necesidades_espectativas_m2:"",
                        evi_aspecto_ambiental_m2:0,
                        estado_aspecto_ambiental_m2:0,
                        pdf_aspecto_ambiental_m2:"",
                        comentario_aspecto_ambiental_m2:"",
                        evi_riesgo_oportu_m2:0,
                        estado_riesgo_oportu_m2:0,
                        pdf_riesgo_oportu_m2:"",
                        comentario_riesgo_oportu_m2:"",
                        evi_grado_objetivo_m3:0,
                        estado_grado_objetivo_m3:0,
                        pdf_grado_objetivo_m3:"",
                        comentario_grado_objetivo_m3:"",
                        evi_programa_gestion_m3:0,
                        estado_programa_gestion_m3:0,
                        pdf_programa_gestion_m3:"",
                        comentario_programa_gestion_m3:"",
                        evi_noconformid_correctivas_m4:0,
                        estado_noconformid_correctivas_m4:0,
                        pdf_noconformid_correctivas_m4:"",
                        comentario_noconformid_correctivas_m4:"",
                        evi_resu_seg_med_m4:0,
                        estado_resu_seg_med_m4:0,
                        pdf_resu_seg_med_m4:"",
                        comentario_resu_seg_med_m4:"",
                        evi_cumplimiento_req_m4:0,
                        estado_cumplimiento_req_m4:0,
                        pdf_cumplimiento_req_m4:"",
                        comentario_cumplimiento_req_m4:"",
                        evi_resultado_audi_m4:0,
                        estado_resultado_audi_m4:0,
                        pdf_resultado_audi_m4:"",
                        comentario_resultado_audi_m4:"",
                        evi_adecuacion_recurso_m5:0,
                        estado_adecuacion_recurso_m5:0,
                        pdf_adecuacion_recurso_m5:"",
                        comentario_adecuacion_recurso_m5:"",
                        evi_comunicacion_pertinente_m6:0,
                        estado_comunicacion_pertinente_m6:0,
                        pdf_comunicacion_pertinente_m6:"",
                        comentario_comunicacion_pertinente_m6:"",
                        evi_oportunidades_mejora_m7:0,
                        estado_oportunidades_mejora_m7:0,
                        pdf_oportunidades_mejora_m7:"",
                        comentario_oportunidades_mejora_m7:"",
                        nombre_encargado:"",
                        nombre_procedimiento:"",
                    },
                    modal:0,
                    tituloModal:" ",
                    //lo inicialisamos el array
                    encargados:[],
                    respuestas:[],
                    id_documentacion_encar:0,
                    estadoguardar:false,
                    esta1:0,
                    modal_validar1:0,
                    modal_validar2:0,
                    modal_validar3:0,
                    modal_validar4:0,
                    modal_validar5:0,
                    modal_validar6:0,
                    modal_validar7:0,
                    modal_validar8:0,
                    modal_validar9:0,
                    modal_validar10:0,
                    modal_validar11:0,
                    modal_validar12:0,
                    modal_validar13:0,
                    modal_validar14:0,
                    modal_env_correcciones:0,
                    modal_autorizacion_doc:0,
                    modal_aceptar_documento:0,


                }
            },
            methods:{
                //meetodo para mostrar tabla
                async documentacion_enc() {
                    //llamar datos al controlador
                    const resultado=await axios.get('/ambiental/ver_doc_encargado_proc/{{ $id_documentacion_encar }}');
                    this.encargados=resultado.data;
                    const respuestas = await axios.get('/ambiental/respuestas/');
                    this.respuestas = respuestas.data;

                    //aqui se guarda el arreglo que traemos
                },
                async abrirModalsinmodificacion(data={}) {
                    this.id_documentacion_encar=data.id_documentacion_encar;
                    window.location.href = '/ambiental/documentacion_encar/'+this.id_documentacion_encar;
                },
                async guardar_resp_doc1(data={}){
                    this.encargado.estado_estado_acc_m1=data[0].estado_estado_acc_m1;
                    this.encargado.comentario_estado_acc_m1=data[0].comentario_estado_acc_m1;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_estado_acc_m1 == 1){
                        this.modal_validar1=1;
                    }
                    else{
                        if( this.encargado.comentario_estado_acc_m1 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar1=1;
                        }

                    }
                },
                async guardar_resp_doc2(data={}){

                    this.encargado.estado_cuestion_ambas_per_m2=data[0].estado_cuestion_ambas_per_m2;
                    this.encargado.comentario_cuestion_ambas_per_m2=data[0].comentario_cuestion_ambas_per_m2;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_cuestion_ambas_per_m2 == 1){
                        this.modal_validar2=1;
                    }
                    else{
                        if( this.encargado.comentario_cuestion_ambas_per_m2 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar2=1;
                        }

                    }
                },
                async guardar_resp_doc3(data={}){

                    this.encargado.estado_necesidades_espectativas_m2=data[0].estado_necesidades_espectativas_m2;
                    this.encargado.comentario_necesidades_espectativas_m2=data[0].comentario_necesidades_espectativas_m2;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_necesidades_espectativas_m2 == 1){
                        this.modal_validar3=1;
                    }
                    else{
                        if( this.encargado.comentario_necesidades_espectativas_m2 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar3=1;
                        }

                    }
                },
                async guardar_resp_doc4(data={}){

                    this.encargado.estado_aspecto_ambiental_m2 =data[0].estado_aspecto_ambiental_m2 ;
                    this.encargado.comentario_aspecto_ambiental_m2=data[0].comentario_aspecto_ambiental_m2;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_aspecto_ambiental_m2  == 1){
                        this.modal_validar4=1;
                    }
                    else{
                        if( this.encargado.comentario_aspecto_ambiental_m2 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar4=1;
                        }

                    }
                },
                async guardar_resp_doc5(data={}){

                    this.encargado.estado_riesgo_oportu_m2 =data[0].estado_riesgo_oportu_m2 ;
                    this.encargado.comentario_riesgo_oportu_m2=data[0].comentario_riesgo_oportu_m2;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_riesgo_oportu_m2  == 1){
                        this.modal_validar5=1;
                    }
                    else{
                        if( this.encargado.comentario_riesgo_oportu_m2 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar5=1;
                        }

                    }
                },
                async guardar_resp_doc6(data={}){

                    this.encargado.estado_grado_objetivo_m3 =data[0].estado_grado_objetivo_m3 ;
                    this.encargado.comentario_grado_objetivo_m3=data[0].comentario_grado_objetivo_m3;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_grado_objetivo_m3  == 1){
                        this.modal_validar6=1;
                    }
                    else{
                        if( this.encargado.comentario_grado_objetivo_m3 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar6=1;
                        }

                    }
                },
                async guardar_resp_doc7(data={}){

                    this.encargado.estado_programa_gestion_m3 =data[0].estado_programa_gestion_m3 ;
                    this.encargado.comentario_programa_gestion_m3=data[0].comentario_programa_gestion_m3;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_programa_gestion_m3  == 1){
                        this.modal_validar7=1;
                    }
                    else{
                        if( this.encargado.comentario_programa_gestion_m3 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar7=1;
                        }

                    }
                },
                async guardar_resp_doc8(data={}){

                    this.encargado.estado_noconformid_correctivas_m4 =data[0].estado_noconformid_correctivas_m4 ;
                    this.encargado.comentario_noconformid_correctivas_m4=data[0].comentario_noconformid_correctivas_m4;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_noconformid_correctivas_m4  == 1){
                        this.modal_validar8=1;
                    }
                    else{
                        if( this.encargado.comentario_noconformid_correctivas_m4 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar8=1;
                        }

                    }
                },
                async guardar_resp_doc9(data={}){

                    this.encargado.estado_resu_seg_med_m4 =data[0].estado_resu_seg_med_m4 ;
                    this.encargado.comentario_resu_seg_med_m4=data[0].comentario_resu_seg_med_m4;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_resu_seg_med_m4  == 1){
                        this.modal_validar9=1;
                    }
                    else{
                        if( this.encargado.comentario_resu_seg_med_m4 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar9=1;
                        }

                    }
                },
                async guardar_resp_doc10(data={}){

                    this.encargado.estado_cumplimiento_req_m4 =data[0].estado_cumplimiento_req_m4 ;
                    this.encargado.comentario_cumplimiento_req_m4=data[0].comentario_cumplimiento_req_m4;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_cumplimiento_req_m4  == 1){
                        this.modal_validar10=1;
                    }
                    else{
                        if( this.encargado.comentario_cumplimiento_req_m4 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar10=1;
                        }

                    }
                },
                async guardar_resp_doc11(data={}){

                    this.encargado.estado_resultado_audi_m4 =data[0].estado_resultado_audi_m4 ;
                    this.encargado.comentario_resultado_audi_m4=data[0].comentario_resultado_audi_m4;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_resultado_audi_m4  == 1){
                        this.modal_validar11=1;
                    }
                    else{
                        if( this.encargado.comentario_resultado_audi_m4 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar11=1;
                        }

                    }
                },
                async guardar_resp_doc12(data={}){

                    this.encargado.estado_adecuacion_recurso_m5 =data[0].estado_adecuacion_recurso_m5 ;
                    this.encargado.comentario_adecuacion_recurso_m5=data[0].comentario_adecuacion_recurso_m5;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_adecuacion_recurso_m5  == 1){
                        this.modal_validar12=1;
                    }
                    else{
                        if( this.encargado.comentario_adecuacion_recurso_m5 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar12=1;
                        }

                    }
                },
                async guardar_resp_doc13(data={}){

                    this.encargado.estado_comunicacion_pertinente_m6 =data[0].estado_comunicacion_pertinente_m6 ;
                    this.encargado.comentario_comunicacion_pertinente_m6=data[0].comentario_comunicacion_pertinente_m6;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_comunicacion_pertinente_m6  == 1){
                        this.modal_validar13=1;
                    }
                    else{
                        if( this.encargado.comentario_comunicacion_pertinente_m6 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar13=1;
                        }

                    }
                },
                async guardar_resp_doc14(data={}){

                    this.encargado.estado_oportunidades_mejora_m7 =data[0].estado_oportunidades_mejora_m7 ;
                    this.encargado.comentario_oportunidades_mejora_m7=data[0].comentario_oportunidades_mejora_m7;
                    this.id_documentacion_encar=data[0].id_documentacion_encar;
                    if(this.encargado.estado_oportunidades_mejora_m7  == 1){
                        this.modal_validar14=1;
                    }
                    else{
                        if( this.comentario_oportunidades_mejora_m7 == ""){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo del comentario se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500});
                        }else {
                            this.modal_validar14=1;
                        }

                    }
                },
                async abrirModalAutorizar_doc(data={}){

                    this.id_documentacion_encar=data[0].id_documentacion_encar;

                    this.modal_aceptar_documento=1;
                },
                cerrarModal_aceptar_doc(){
                    this.modal_aceptar_documento=0;
                },
                async abrirModalenviar_correcciones(data={}){

                    this.id_documentacion_encar=data[0].id_documentacion_encar;

                    this.modal_env_correcciones=1;
                },
                cerrarModalenviar_correcciones(){
                    this.modal_env_correcciones=0;
                },

                async guardar_enviar_aceptacion(){
                    window.location.href = '/ambiental/enviar_aceptacion_documentacion/'+this.id_documentacion_encar;
                    swal({
                        position: "top",
                        type: "success",
                        title: "autorización  exitosa",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                async Enviar_correcciones(){
                    window.location.href = '/ambiental/enviar_correciones_documentacion/'+this.id_documentacion_encar;
                    swal({
                        position: "top",
                        type: "success",
                        title: "Envio exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                async guardar_validar1(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc1/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar1();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar1(){
                    this.modal_validar1=0;
                },
                async guardar_validar2(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc2/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar2();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar2(){
                    this.modal_validar2=0;
                },
                async guardar_validar3(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc3/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar3();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar3(){
                    this.modal_validar3=0;
                },
                async guardar_validar4(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc4/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar4();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar4(){
                    this.modal_validar4=0;
                },
                async guardar_validar5(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc5/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar5();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar5(){
                    this.modal_validar5=0;
                },
                async guardar_validar6(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc6/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar6();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar6(){
                    this.modal_validar6=0;
                },
                async guardar_validar7(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc7/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar7();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar7(){
                    this.modal_validar7=0;
                },
                async guardar_validar8(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc8/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar8();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar8(){
                    this.modal_validar8=0;
                },
                async guardar_validar9(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc9/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar9();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar9(){
                    this.modal_validar9=0;
                },
                async guardar_validar10(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc10/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar10();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar10(){
                    this.modal_validar10=0;
                },
                async guardar_validar11(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc11/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar11();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar11(){
                    this.modal_validar11=0;
                },
                async guardar_validar12(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc12/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar12();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar12(){
                    this.modal_validar12=0;
                },
                async guardar_validar13(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc13/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar13();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar13(){
                    this.modal_validar13=0;
                },
                async guardar_validar14(){
                    const resultado=await axios.post('/ambiental/guardar_validacion_doc14/'+this.id_documentacion_encar,this.encargado);
                    this.documentacion_enc();
                    this.cerrarModal_validar14();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });


                },
                cerrarModal_validar14(){
                    this.modal_validar14=0;
                },
            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion
                const resultado=await axios.get('/ambiental/ver_doc_encargado_proc/{{ $id_documentacion_encar }}');
                this.encargados=resultado.data;
                this.documentacion_enc();

            },
        })
    </script>
    <style>
        .mostrar{
            display: list-item;
            opacity: 1;
            background: rgba(44,38,75,0.849);
        }
    </style>

</div>
@endsection