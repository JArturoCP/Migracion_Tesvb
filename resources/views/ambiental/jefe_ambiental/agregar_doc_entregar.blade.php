@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Procedimiento: '.$proc->nom_procedimiento.' · Encargado: '.$proc->nombre" :migas="['Gestión ambiental' => null]" />
    <div id="reg_doc" x-ignore data-carga-axios>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/ambiental/ver_periodos")}}">Periodos Ambiental</a>
                    <span class="fa fa-chevron-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/ambiental/ver_proc_ambiental/$id_periodo")}}">Procedimientos Registrados </a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Documentación del Procedimiento para entregar</span>
                </p>
            </div>
        </div>
        <main class="tw:w-full tw:lg:w-full tw:px-2">
            <template v-if="activo == 0">
            <x-panel.alerta tipo="error" class="tw:mb-4">Seleccionar los documentos  que entregará el encargado del procedimiento</x-panel.alerta>
            </template>
            <template v-if="activo == 1">
                <x-panel.alerta tipo="exito" class="tw:mb-4">los documentos  que entregará el encargado del procedimiento</x-panel.alerta>
            </template>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 1</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p class="tw:text-base" >a) El estado de las acciones de las revisiones por la dirección previas.<br>
                                    <br/>
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="uno" value="1" v-model="encargado.doc1">
                                <label class="tw:text-lg" for="uno" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >

                                <input type="radio" id="dos" style="transform: scale(2);" value="2" v-model="encargado.doc1">
                                <label class="tw:text-lg" for="dos" >. Si</label>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 2</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p><b>b) Los cambios en:</b> <br> 1) Las cuestiones externas e internas que sean pertinentes
                                    al sistema  de gestión ambiental.
                                    <br/>
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="tres" value="1" v-model="encargado.doc2">
                                <label class="tw:text-lg" for="tres" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >

                                <input type="radio" id="cuatro" style="transform: scale(2);" value="2" v-model="encargado.doc2">
                                <label class="tw:text-lg" for="cuatro" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>2) Las necesidades y expectativas de las partes interesadas , incluidos
                                    los requisitos legales y otros requisitos.

                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="cinco" value="1" v-model="encargado.doc3">
                                <label class="tw:text-lg" for="cinco" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="seis" style="transform: scale(2);" value="2" v-model="encargado.doc3">
                                <label class="tw:text-lg" for="seis" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>3) Sus aspectos ambientales  significativos.<br>
                                    <br/>
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="siete" value="1" v-model="encargado.doc4">
                                <label class="tw:text-lg" for="siete" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="ocho" style="transform: scale(2);" value="2" v-model="encargado.doc4">
                                <label class="tw:text-lg" for="ocho" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>4) Los riesgos y oportunidades<br>
                                    <br/>
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="nueve" value="1" v-model="encargado.doc5">
                                <label class="tw:text-lg" for="nueve" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="diez" style="transform: scale(2);" value="2" v-model="encargado.doc5">
                                <label class="tw:text-lg" for="diez" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 3</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p> <b>c) El grado en que se han logrado los objetivos ambientales.</b>
                                    <br/>
                                    1) Objetivos ambientales del S. de G. A.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="once" value="1" v-model="encargado.doc6">
                                <label class="tw:text-lg" for="once" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="doce" style="transform: scale(2);" value="2" v-model="encargado.doc6">
                                <label class="tw:text-lg" for="doce" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    2) Programa de G. A.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="trece" value="1" v-model="encargado.doc7">
                                <label class="tw:text-lg" for="trece" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="catorce" style="transform: scale(2);" value="2" v-model="encargado.doc7">
                                <label class="tw:text-lg" for="catorce" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 4</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p> <b>d) La información sobre el desempeño ambiental de la organización,
                                        incluidas las tendencias relativas a:</b> <br>
                                    1) No conformidades y acciones correctivas.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="quince" value="1" v-model="encargado.doc8">
                                <label class="tw:text-lg" for="quince" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="diesiseis" style="transform: scale(2);" value="2" v-model="encargado.doc8">
                                <label class="tw:text-lg" for="diesiseis" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    2) Resultados de seguimiento y medición.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="diesisiete" value="1" v-model="encargado.doc9">
                                <label class="tw:text-lg" for="diesisiete" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="diesiocho" style="transform: scale(2);" value="2" v-model="encargado.doc9">
                                <label class="tw:text-lg" for="diesiocho" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    3) Cumplimiento de los requisitos legales y otros requisitos.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="diesinueve" value="1" v-model="encargado.doc10">
                                <label class="tw:text-lg" for="diesinueve" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="veinte" style="transform: scale(2);" value="2" v-model="encargado.doc10">
                                <label class="tw:text-lg" for="veinte" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    4)Resultados de las auditorias.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="veintiuno" value="1" v-model="encargado.doc11">
                                <label class="tw:text-lg" for="veintiuno" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="veintidos" style="transform: scale(2);" value="2" v-model="encargado.doc11">
                                <label class="tw:text-lg" for="veintidos" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 5</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    e)Adecuación de los recursos .
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="veintitres" value="1" v-model="encargado.doc12">
                                <label class="tw:text-lg" for="veintitres" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="veinticuatro" style="transform: scale(2);" value="2" v-model="encargado.doc12">
                                <label class="tw:text-lg" for="veinticuatro" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 6</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    f)Las comunicaciones pertinentes de las partes interesadas, incluidas las quejas.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="veinticinco" value="1" v-model="encargado.doc13">
                                <label class="tw:text-lg" for="veinticinco" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="veintiseis" style="transform: scale(2);" value="2" v-model="encargado.doc13">
                                <label class="tw:text-lg" for="veintiseis" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>Modulo 7</p></h3>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>
                                    g)Las oportunidades de mejora continua.
                                </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" style="transform: scale(2);" id="veintisiete" value="1" v-model="encargado.doc14">
                                <label class="tw:text-lg" for="veintisiete" >  . No   </label>

                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2" >
                                <input type="radio" id="veintiocho" style="transform: scale(2);" value="2" v-model="encargado.doc14">
                                <label class="tw:text-lg" for="veintiocho" >. Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">


                    <template v-if="encargado.doc1   != 0 &&
                      encargado.doc2   != 0 &&
                       encargado.doc3   != 0 &&
                        encargado.doc4   != 0 &&
                         encargado.doc5   != 0 &&
                          encargado.doc6   != 0 &&
                           encargado.doc7   != 0 &&
                            encargado.doc8   != 0 &&
                             encargado.doc9   != 0 &&
                              encargado.doc10   != 0 &&
                               encargado.doc11   != 0 &&
                                encargado.doc12   != 0 &&
                                 encargado.doc13   != 0 &&
                                  encargado.doc14   != 0 ">
                        <template v-if="activo == 0">
                            <button  class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="Registrar_dat();" >Documentación para autorizar</button>
                        </template>
                        <template v-if="activo == 1">
                           {{-- <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base tw:flex tw:w-full" v-on:click="Modificar_dat();" >Modificar Documentación para autorizar</button>
--}}
                        </template>
                        </template>


                </div>
            </div>
        </main>
        <div  class="modal tw-modal-compat" :class="{mostrar:modal}" >
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" @click="cerrarModal_enviar();">&times;</button>
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >Notificación de Registro</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-justify"  >¿ La documentación seleccionada de entregar es corrrecta?</h5>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" @click="cerrarModal_enviar();">Cerrar</button>
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" @click="estado_guardar=true,guardar_enviar();" :disabled="estado_guardar">Aceptar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div  class="modal tw-modal-compat" :class="{mostrar:modal_mod}" >
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" @click="cerrarModal_mod_enviar();">&times;</button>
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >Notificación de Modificación Registro</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-justify"  >¿ La documentación seleccionada de entregar es correcta?</h5>
                            </div>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" @click="cerrarModal_mod_enviar();">Cerrar</button>
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" @click="guardar_enviar_mod();" :disabled="estadoguardar">Aceptar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        new Vue({
            el:"#reg_doc",

            data(){
                return {
                    //objeto donde se va a guardar los datos de un procedimiento
                    encargado:{
                        id_encargado:0,
                        id_periodo_amb:0,
                        doc1:0,
                        doc2:0,
                        doc3:0,
                        doc4:0,
                        doc5:0,
                        doc6:0,
                        doc7:0,
                        doc8:0,
                        doc9:0,
                        doc10:0,
                        doc11:0,
                        doc12:0,
                        doc13:0,
                        doc14:0,

                    },
                    modal:0,
                    modal_mod:0,
                    estado_guardar:false,
                      activaciones:[],
                    documentacion:[],
                    activo:0,





                }
            },
            methods:{
                async Documentacion() {
                    //llamar datos al controlador
                    const contar = await axios.get('/ambiental/estado_registro_encargado/{{$id_periodo}}/{{$id_encargado}}');
                    this.activaciones = contar.data;
                    this.activo = this.activaciones;
                    if(this.activo == 0){
                        this.encargado.doc1=0;
                        this.encargado.doc2=0;
                        this.encargado.doc3=0;
                        this.encargado.doc4=0;
                        this.encargado.doc5=0;
                        this.encargado.doc6=0;
                        this.encargado.doc7=0;
                        this.encargado.doc8=0;
                        this.encargado.doc9=0;
                        this.encargado.doc10=0;
                        this.encargado.doc11=0;
                        this.encargado.doc12=0;
                        this.encargado.doc13=0;
                        this.encargado.doc14=0;

                    }else{
                        const documentacion = await axios.get('/ambiental/ver_documentacion_encargado/{{$id_encargado}}');
                        this.documentacion = documentacion.data;
                        this.encargado.doc1=this.documentacion[0].solic_estado_acc_m1;
                        this.encargado.doc2=this.documentacion[0].solic_cuestion_ambas_per_m2;
                        this.encargado.doc3=this.documentacion[0].solic_necesidades_espectativas_m2;
                        this.encargado.doc4=this.documentacion[0].solic_aspecto_ambiental_m2;
                        this.encargado.doc5=this.documentacion[0].solic_riesgo_oportu_m2;
                        this.encargado.doc6=this.documentacion[0].solic_grado_objetivo_m3;
                        this.encargado.doc7=this.documentacion[0].solic_programa_gestion_m3;
                        this.encargado.doc8=this.documentacion[0].solic_noconformid_correctivas_m4;
                        this.encargado.doc9=this.documentacion[0].solic_resu_seg_med_m4;
                        this.encargado.doc10=this.documentacion[0].solic_cumplimiento_req_m4;
                        this.encargado.doc11=this.documentacion[0].solic_resultado_audi_m4;
                        this.encargado.doc12=this.documentacion[0].solic_adecuacion_recurso_m5;
                        this.encargado.doc13=this.documentacion[0].solic_comunicacion_pertinente_m6;
                        this.encargado.doc14=this.documentacion[0].solic_oportunidades_mejora_m7;

                    }




                },
                //meetodo para mostrar tabla
                async  Registrar_dat(){
                    this.estado_guardar=false;
                    this.modal=1;

                },
                async  Modificar_dat(){
                    this.estado_guardar=false;
                    this.modal_mod=1;

                },
                async  cerrarModal_enviar(){
                    this.modal=0;

                },
                async  cerrarModal_mod_enviar(){
                    this.modal_mod=0;

                },

                async  guardar_enviar(){
                    this.estado_guardar=true;
                    const resultado=await axios.post('/ambiental/guardar_dat_doc/{{$id_periodo}}/{{$id_encargado}}',this.encargado);
                    this.Documentacion();
                    this.modal=0;
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });

                },
                async guardar_enviar_mod(){
                    this.estado_guardar=true;
                    const resultado=await axios.post('/ambiental/modificar_guardar_dat_doc/{{$id_periodo}}/{{$id_encargado}}',this.encargado);
                    this.Documentacion();
                    this.modal_mod=0;
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            },
            //funciones para cuando se cargue la vista
            async created(){
                this.Documentacion();

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