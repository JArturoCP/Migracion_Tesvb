<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">

            <thead>
            <tr>

                <th>Requisito</th>
                <th>Ver documento</th>
                <th>Acción</th>
                <th>Comentarios</th>


            </tr>
            </thead>

            <tbody>
            <template v-if="docu.estado_acta_nac  == 2">
            <tr>

                <td>Acta de nacimiento</td>
                <template v-if="docu.evi_acta_nac  == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_acta=false, abrirModal_agregar_acta();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_acta_nac  == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_acta_nac   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_acta=true, abrirModal_agregar_acta();" >Modificar</button></td>
                    <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_acta_nac   }}</th>
                </template>


            </tr>
            </template>

            <template v-if="docu.estado_curp  == 2">
            <tr>
                <td>Curp</td>
                <template v-if="docu.evi_curp  == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_curp=false, abrirModal_agregar_curp();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_curp  == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_curp   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_curp=true, abrirModal_agregar_curp();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_curp   }}</th>
            </tr>
            </template>

            <template v-if="docu.estado_certificado_prep  == 2">
            <tr>
                <td>Certificado de preparatoria  <b class="tw:text-red-600 tw:dark:text-red-400" >(Documento legalizado y escaneado por los dos lados)</b></td>
                <template v-if="docu.evi_certificado_prep  == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_certificado_prepa=false, abrirModal_agregar_certificado_prepa();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_certificado_prep  == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_certificado_prep   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_certificado_prepa=true, abrirModal_agregar_certificado_prepa();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_certificado_prep   }}</th>
            </tr>
            </template>

            <template v-if="docu.estado_certificado_tesvb  == 2">
            <tr>
                <td>Certificado del TESVB <b class="tw:text-red-600 tw:dark:text-red-400" >(Documento escaneado por los dos lados)</b></td>
                <template v-if="docu.evi_certificado_tesvb  == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_certificado_tesvb=false, abrirModal_agregar_tesvb();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_certificado_tesvb  == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_certificado_tesvb   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_certificado_tesvb=true, abrirModal_agregar_tesvb();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_certificado_tesvb   }}</th>
            </tr>
            </template>

            <template v-if="docu.estado_constancia_ss  == 2">
            <tr>
                <td>Constancia de liberación del Servicio Social</td>
                <template v-if="docu.evi_constancia_ss  == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_constancia_ss=false, abrirModal_agregar_constancia_ss();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_constancia_ss  == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_constancia_ss   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_constancia_ss=true, abrirModal_agregar_constancia_ss();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_constancia_ss   }}</th>
            </tr>
            </template>

            <template v-if="veri_constancia_ingles == 1">{{--alumnos de no. cuenta menor 2010--}}

                <template v-if="docu.estado_certificado_acred_ingles  == 2">
                <tr>
                    <td>Constancia de  Acreditación del Idioma Ingles</td>
                    <template v-if="docu.evi_certificado_acred_ingles  == 0">
                        <th></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_certificado_ingles=false, abrirModal_agregar_certificado_ingles();" >Agregar</button></td>
                    </template>
                    <template v-if="docu.evi_certificado_acred_ingles  == 1">
                        <th><a  target="_blank" href="/titulacion/@{{docu.pdf_certificado_acred_ingles   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_certificado_ingles=true, abrirModal_agregar_certificado_ingles();">Modificar</button></td>
                    </template>
                    <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_certificado_acred_ingles   }}</th>
                </tr>
                </template>
            </template>
            <template v-if="docu.estado_reporte_result_egel == 2">
                <template v-if="veri_egel  == 1">
                    <tr>
                        <td>Reporte individual de resultados del EGEL (Ceneval)</td>
                        <template v-if="docu.evi_reporte_result_egel   == 0">
                            <th></th>
                            <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_reporte_result_egel=false, abrirModal_agregar_reporte_result_egel();" >Agregar</button></td>
                        </template>
                        <template v-if="docu. 	evi_reporte_result_egel   == 1">
                            <th><a  target="_blank" href="/titulacion/@{{docu.pdf_reporte_result_egel   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                            <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_reporte_result_egel=true, abrirModal_agregar_reporte_result_egel();" >Modificar</button></td>
                        </template>
                        <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_reporte_result_egel   }}</th>
                    </tr>
                </template>
            </template>

            <template v-if="docu.estado_opcion_titulacion == 2">
            <tr>
                <td>Opción de Titulación</td>
                <template v-if="docu.evi_opcion_titulacion   == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_opcion_titulacion=false, abrirModal_agregar_opciones_titulacion();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_opcion_titulacion   == 1  || docu.evi_opcion_titulacion   == 2">
                    <template v-if="docu.id_opcion_titulacion   == 1">
                        <th>
                            <b>I. Informe de residencia</b> <br>
                            Caratula final de residencia <br>

                            <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>

                    </template>

                    <template v-if="docu.id_opcion_titulacion   == 2 || docu.id_opcion_titulacion   == 3 ||
                                     docu.id_opcion_titulacion   == 4 || docu.id_opcion_titulacion   == 5 ||
                                     docu.id_opcion_titulacion   == 6 || docu.id_opcion_titulacion   == 9 ||
                                     docu.id_opcion_titulacion   == 10 ||
                                     docu.id_opcion_titulacion   == 11">
                        <template v-if="docu.id_opcion_titulacion   == 2">
                            <th>
                                <b>II. Proyecto de Innovación</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 3">
                            <th>
                                <b>III. Proyecto de investigación</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 4">
                            <th>
                                <b>IV. Informe de Estancia</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 5">
                            <th>
                                <b>V. Tesis</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 6">
                            <th>
                                <b>VI. Tesina</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 9">
                            <th>
                                <b>VII. Otros : Experiencia Profesional</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 10">
                            <th>
                                <b>VII. Otros : Incubación de negocio</b> <br>
                                Constancia de Viabilidad <br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 11">
                            <th>
                                <b>VII. Otros : Modalidad dual</b> <br>
                                Constancia de estudios en el programa dual<br>

                                <a  target="_blank" href="/titulacion/@{{ docu.pdf_opcion_titulacion    }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                            </th>

                        </template>
                    </template>
                    <template v-if="docu.id_opcion_titulacion   == 7 || docu.id_opcion_titulacion   == 8">
                        <template v-if="docu.id_opcion_titulacion   == 7">
                            <th>
                                <b>VII. Otros : Ceneval</b> <br>
                                No  se necesita documento <br>

                            </th>

                        </template>
                        <template v-if="docu.id_opcion_titulacion   == 8">
                            <th>
                                <b>VII. Otros : Examen por área del conocimiento</b> <br>
                                No se necesita documento <br>

                            </th>

                        </template>

                    </template>


                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_opcion_titulacion=true, abrirModal_agregar_opciones_titulacion();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_opcion_titulacion   }}</th>
            </tr>
            </template>
            <template v-if="docu.estado_acta_residencia == 2">
                <template v-if="veri_anterior_10   == 0">
                    <tr>
                        <td>Acta de residencia profesional</td>
                        <template v-if="docu.evi_acta_residencia   == 0">
                            <th></th>
                            <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_acta_residencia=false, abrirModal_agregar_acta_residencia();" >Agregar</button></td>
                        </template>
                        <template v-if="docu.evi_acta_residencia   == 1">
                            <th><a  target="_blank" href="/titulacion/@{{docu.pdf_acta_residencia   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                            <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_acta_residencia=true, abrirModal_agregar_acta_residencia();">Modificar</button></td>
                        </template>
                        <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_acta_residencia   }}</th>
                    </tr>

                </template>
            </template>
            <template v-if="docu.estado_pago_titulo == 2">
            <tr>
                <td>Pago de registro de título profesional de licenciatura con timbre holograma </td>
                <template v-if="docu.evi_pago_titulo   == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_titulo=false, abrirModal_agregar_pago_titulo();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_pago_titulo   == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_pago_titulo   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_titulo=true, abrirModal_agregar_pago_titulo();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_pago_titulo   }}</th>
            </tr>
            </template>
            <template v-if="docu.estado_pago_contancia == 2">
                <tr>
                    <td>Pago de constancia de no adeudo</td>
                    <template v-if="docu.evi_pago_contancia   == 0">
                        <th></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_contancia=false, abrirModal_agregar_pago_contancia();" >Agregar</button></td>
                    </template>
                    <template v-if="docu.evi_pago_contancia   == 1">
                        <th><a  target="_blank" href="/titulacion/@{{docu.pdf_pago_contancia   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_contancia=true, abrirModal_agregar_pago_contancia();">Modificar</button></td>
                    </template>
                    <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_pago_contancia   }}</th>
                </tr>
            </template>
            <template v-if="docu.estado_pago_derecho_ti == 2">
            <tr>
                <td>Pago de derecho de titulación</td>
                <template v-if="docu.evi_pago_derecho_ti   == 0">
                    <th></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_derecho_ti=false, abrirModal_agregar_pago_derecho_ti();" >Agregar</button></td>
                </template>
                <template v-if="docu.evi_pago_derecho_ti   == 1">
                    <th><a  target="_blank" href="/titulacion/@{{docu.pdf_pago_derecho_ti   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                    <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_derecho_ti=true, abrirModal_agregar_pago_derecho_ti();">Modificar</button></td>
                </template>
                <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_pago_derecho_ti   }}</th>
            </tr>
            </template>
            <template v-if="docu.estado_pago_integrante_jurado == 2">
                <tr>
                    <td>Pago de integrantes a jurado</td>
                    <template v-if="docu.evi_pago_integrante_jurado   == 0">
                        <th></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_integrante_jurado=false, abrirModal_agregar_pago_integrante_jurado();" >Agregar</button></td>
                    </template>
                    <template v-if="docu.evi_pago_integrante_jurado   == 1">
                        <th><a  target="_blank" href="/titulacion/@{{docu.pdf_pago_integrante_jurado   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_integrante_jurado=true, abrirModal_agregar_pago_integrante_jurado();">Modificar</button></td>
                    </template>
                    <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_pago_integrante_jurado   }}</th>
                </tr>
            </template>

            <template v-if="docu.estado_pago_concepto_autenticacion == 2">
                <tr>
                    <td>Pago por concepto de autenticación de títulos profesionales diplomas o grados académicos electrónicos, para escuelas estatales oficiales o particulares incorporadas de: licenciatura o posgrado, por cada uno.</td>
                    <template v-if="docu.evi_pago_concepto_autenticacion   == 0">
                        <th></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_concepto_autenticacion=false, abrirModal_pago_concepto_autenticacion();" >Agregar</button></td>
                    </template>
                    <template v-if="docu.evi_pago_concepto_autenticacion   == 1">
                        <th><a  target="_blank" href="/titulacion/@{{docu.pdf_pago_concepto_autenticacion   }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a></th>
                        <td><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="modificar_pago_concepto_autenticacion=true, abrirModal_pago_concepto_autenticacion();">Modificar</button></td>
                    </template>
                    <th class="tw:text-red-600 tw:dark:text-red-400" >@{{docu.comentario_pago_concepto_autenticacion   }}</th>
                </tr>
            </template>

            </tbody>
        </table>
</div>
    </div>
</div>