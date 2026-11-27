@extends('layouts.panel')
@section('title', 'Revisión de documentación de titulación')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@include('partials.panel.formularios')

@section('content')
    @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.encabezado_expediente', [
        'titulo' => 'Revisión de documentación de titulación',
        'rutaListado' => 'autorizar_alumnos_doc_requisitos',
        'etiquetaListado' => 'Por autorizar',
    ])

    <div id="envio_doc" class="tw:mt-5" x-ignore data-carga-axios>
        <template v-if="cargando">
            <p role="status" class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">Cargando documentación…</p>
        </template>
        <template v-if="errorCarga">
            <x-panel.alerta tipo="error">No se pudo cargar la documentación.</x-panel.alerta>
            <x-panel.boton class="tw:mt-3" variante="secundario" v-on:click="Documentacion">Reintentar</x-panel.boton>
        </template>
        <template v-if="!cargando && !errorCarga && est_actual_doc_al == 0">
            <x-panel.vacio titulo="Sin documentación registrada" />
        </template>
        <template v-if="!cargando && !errorCarga && est_actual_doc_al > 0">


      <template v-if="fecha_activa == 0 ">

          <div class="tw:col-span-full tw:min-w-0">
              <div  class="tw:min-w-0">
                  <div class="tw:my-4 tw:rounded-xl tw:border tw:border-red-200 tw:bg-red-50 tw:p-4 tw:text-red-700 tw:dark:border-red-800 tw:dark:bg-red-500/10 tw:dark:text-red-300">
                      <div class="tw:font-medium">
                          <h3 class="tw:text-sm"> La fecha límite de registro de tu documentación expiro, verifica con el departamento de titulación.</h3>
                      </div>
                  </div>
              </div>
          </div>
      </template>
      <template v-if="fecha_activa == 1 ">

          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Acta de nacimiento</h3><br>
                                  <br/>

                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_acta_nac" v-bind:href="'/titulacion/' + docu.pdf_acta_nac" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_acta_nac == 1">
                                    <template v-if="docu.estado_acta_nac == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                    </template>
                                   <template v-if="docu.estado_acta_nac == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                   </template>
                              </template>
                              <template v-if="docu.cal_acta_nac == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_acta_nac">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_acta_nac == 1">
                          <template v-if="docu.cal_acta_nac == 0">
                              <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_acta($event)">Guardar</button>
                              </div>
                          </template>
                          <template v-if="docu.cal_acta_nac == 1">
                              <div class="tw:min-w-0 tw:lg:col-span-2">
                                     <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                               </div>
                          </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_acta_nac == 2">
                          <template v-if="docu.cal_acta_nac == 0">
                          <div class="tw:col-span-full tw:min-w-0">
                              <div class="tw:min-w-0">
                                  <div class="tw:space-y-2">
                                      <label for="domicilio3">Comentario para la modificación </label>
                                      <textarea id="comentario_acta_nac" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_acta_nac" name="comentario_doc1" rows="1"   required></textarea>
                                  </div>
                              </div>
                          </div>
                          </template>
                          <template v-if="docu.cal_acta_nac == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_acta_nac  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_acta_nac == 0">

                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_acta($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_acta_nac == 1">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Curp</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_curp" v-bind:href="'/titulacion/' + docu.pdf_curp" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_curp == 1">
                                  <template v-if="docu.estado_curp == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_curp == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_curp == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_curp">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_curp == 1">
                              <template v-if="docu.cal_curp == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_curp($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_curp == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_curp == 2">
                          <template v-if="docu.cal_curp == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_curp" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_curp" name="comentario_doc2" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_curp == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_curp  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_curp == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_curp($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_curp == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Certificado de preparatoria <b class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">(Documento legalizado y escaneado por los dos lados)</b></h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_certificado_prep" v-bind:href="'/titulacion/' + docu.pdf_certificado_prep" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_certificado_prep == 1">
                                  <template v-if="docu.estado_certificado_prep == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_certificado_prep == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_certificado_prep == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_certificado_prep">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_certificado_prep == 1">
                              <template v-if="docu.cal_certificado_prep == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_certificado_prepa($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_certificado_prep == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_certificado_prep == 2">
                          <template v-if="docu.cal_certificado_prep == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_certificado_prep" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_certificado_prep" name="comentario_doc3" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_certificado_prep == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_certificado_prep  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_certificado_prep == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_certificado_prepa($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_certificado_prep == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Certificado del TESVB <b class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">(Documento escaneado por los dos lados)</b></h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_certificado_tesvb" v-bind:href="'/titulacion/' + docu.pdf_certificado_tesvb" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_certificado_tesvb == 1">
                                  <template v-if="docu.estado_certificado_tesvb == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_certificado_tesvb == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_certificado_tesvb == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_certificado_tesvb">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_certificado_tesvb == 1">
                              <template v-if="docu.cal_certificado_tesvb == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_certificado_tesvb($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_certificado_tesvb == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_certificado_tesvb == 2">
                          <template v-if="docu.cal_certificado_tesvb == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_certificado_tesvb" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_certificado_tesvb" name="comentario_doc4" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_certificado_tesvb == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_certificado_tesvb  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_certificado_tesvb == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_certificado_tesvb($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_certificado_tesvb == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Constancia de liberación del Servicio Social</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_constancia_ss" v-bind:href="'/titulacion/' + docu.pdf_constancia_ss" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_constancia_ss == 1">
                                  <template v-if="docu.estado_constancia_ss == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_constancia_ss == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_constancia_ss == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_constancia_ss">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_constancia_ss == 1">
                              <template v-if="docu.cal_constancia_ss == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_constancia_ss($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_constancia_ss == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_constancia_ss == 2">
                          <template v-if="docu.cal_constancia_ss == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_constancia_ss" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_constancia_ss" name="comentario_doc5" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_constancia_ss == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_constancia_ss  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_constancia_ss == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_constancia_ss($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_constancia_ss == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>

          <template v-if="veri_constancia_ingles == 2">
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Constancia de Acreditación del Idioma Ingles</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="ingles.pdf_certificado" v-bind:href="'/certificado_ingles/' + ingles.pdf_certificado" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>El departamento de Actividades Culturales y Deportivas subió al sistema la constancia de acreditación del idioma ingles.</label>
                          </div>

                      </div>



                  </div>
              </div>
          </div>
          </template>
          <template v-if="veri_constancia_ingles == 1">
              <div class="tw:col-span-full tw:min-w-0">
                  <div class="tw:min-w-0">
                      <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                          <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                              <div class="tw:min-w-0 tw:lg:col-span-4">
                                  <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Constancia de acreditación del idioma ingles</h3>
                              </div>
                              <div class="tw:min-w-0 tw:lg:col-span-3">
                                  <label>
                                      <a  target="_blank" v-if="docu.pdf_certificado_acred_ingles" v-bind:href="'/titulacion/' + docu.pdf_certificado_acred_ingles" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                                  </label>
                              </div>
                              <div class="tw:min-w-0 tw:lg:col-span-3">
                                  <template v-if="docu.cal_certificado_acred_ingles == 1">
                                      <template v-if="docu.estado_certificado_acred_ingles == 1">
                                          <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                          <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                      </template>
                                      <template v-if="docu.estado_certificado_acred_ingles == 2">
                                          <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                          <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                      </template>
                                  </template>
                                  <template v-if="docu.cal_certificado_acred_ingles == 0">
                                      <div class="tw:space-y-2">
                                          <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                          <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_certificado_acred_ingles">
                                              <option disabled selected hidden :value="0">Selecciona</option>
                                              <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                          </select>
                                      </div>
                                  </template>
                              </div>
                              <template v-if="docu.estado_certificado_acred_ingles == 1">
                                  <template v-if="docu.cal_certificado_acred_ingles == 0">
                                      <div class="tw:min-w-0 tw:lg:col-span-2">
                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_certificado_acred_ingles($event)">Guardar</button>
                                      </div>
                                  </template>
                                  <template v-if="docu.cal_certificado_acred_ingles == 1">
                                      <div class="tw:min-w-0 tw:lg:col-span-2">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                      </div>
                                  </template>
                              </template>

                          </div>


                          <template v-if="docu.estado_certificado_acred_ingles == 2">
                              <template v-if="docu.cal_certificado_acred_ingles == 0">
                                  <div class="tw:col-span-full tw:min-w-0">
                                      <div class="tw:min-w-0">
                                          <div class="tw:space-y-2">
                                              <label for="domicilio3">Comentario para la modificación </label>
                                              <textarea id="comentario_certificado_acred_ingles" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_certificado_acred_ingles" name="comentario_doc6" rows="1"   required></textarea>
                                          </div>
                                      </div>
                                  </div>
                              </template>
                              <template v-if="docu.cal_certificado_acred_ingles == 1">
                                  <div class="tw:col-span-full tw:min-w-0">
                                      <div class="tw:min-w-0">
                                          <div class="tw:space-y-2">
                                              <label for="domicilio3">Comentario para la modificación: </label>
                                              <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_certificado_acred_ingles  }}</h4>
                                          </div>
                                      </div>
                                  </div>
                              </template>
                              <div class="tw:col-span-full tw:min-w-0">

                                  <div class="tw:my-3 tw:flex tw:justify-end">
                                      <template v-if="docu.cal_certificado_acred_ingles == 0">

                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_certificado_acred_ingles($event)">Guardar</button>
                                      </template>
                                      <template v-if="docu.cal_certificado_acred_ingles == 1">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                      </template>
                                  </div>

                              </div>
                          </template>
                      </div>
                  </div>
              </div>
          </template>
          <template v-if="veri_egel == 1">
              <div class="tw:col-span-full tw:min-w-0">
                  <div class="tw:min-w-0">
                      <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                          <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                              <div class="tw:min-w-0 tw:lg:col-span-4">
                                  <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Reporte individual de resultados del EGEL (ceneval)</h3>
                              </div>
                              <div class="tw:min-w-0 tw:lg:col-span-3">
                                  <label>
                                      <a  target="_blank" v-if="docu.pdf_reporte_result_egel" v-bind:href="'/titulacion/' + docu.pdf_reporte_result_egel" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                                  </label>
                              </div>
                              <div class="tw:min-w-0 tw:lg:col-span-3">
                                  <template v-if="docu.cal_reporte_result_egel == 1">
                                      <template v-if="docu.estado_reporte_result_egel == 1">
                                          <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                          <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                      </template>
                                      <template v-if="docu.estado_reporte_result_egel == 2">
                                          <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                          <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                      </template>
                                  </template>
                                  <template v-if="docu.cal_reporte_result_egel == 0">
                                      <div class="tw:space-y-2">
                                          <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                          <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_reporte_result_egel">
                                              <option disabled selected hidden :value="0">Selecciona</option>
                                              <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                          </select>
                                      </div>
                                  </template>
                              </div>
                              <template v-if="docu.estado_reporte_result_egel == 1">
                                  <template v-if="docu.cal_reporte_result_egel == 0">
                                      <div class="tw:min-w-0 tw:lg:col-span-2">
                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_reporte_result_egel($event)">Guardar</button>
                                      </div>
                                  </template>
                                  <template v-if="docu.cal_reporte_result_egel == 1">
                                      <div class="tw:min-w-0 tw:lg:col-span-2">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                      </div>
                                  </template>
                              </template>

                          </div>


                          <template v-if="docu.estado_reporte_result_egel == 2">
                              <template v-if="docu.cal_reporte_result_egel == 0">
                                  <div class="tw:col-span-full tw:min-w-0">
                                      <div class="tw:min-w-0">
                                          <div class="tw:space-y-2">
                                              <label for="domicilio3">Comentario para la modificación </label>
                                              <textarea id="comentario_reporte_result_egel" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_reporte_result_egel" name="comentario_doc5" rows="1"   required></textarea>
                                          </div>
                                      </div>
                                  </div>
                              </template>
                              <template v-if="docu.cal_reporte_result_egel == 1">
                                  <div class="tw:col-span-full tw:min-w-0">
                                      <div class="tw:min-w-0">
                                          <div class="tw:space-y-2">
                                              <label for="domicilio3">Comentario para la modificación: </label>
                                              <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_reporte_result_egel  }}</h4>
                                          </div>
                                      </div>
                                  </div>
                              </template>
                              <div class="tw:col-span-full tw:min-w-0">

                                  <div class="tw:my-3 tw:flex tw:justify-end">
                                      <template v-if="docu.cal_reporte_result_egel == 0">

                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_reporte_result_egel($event)">Guardar</button>
                                      </template>
                                      <template v-if="docu.cal_reporte_result_egel == 1">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                      </template>
                                  </div>

                              </div>
                          </template>
                      </div>
                  </div>
              </div>
          </template>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h4 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Opción de titulación<br>
                                  <br/>

                                      <template v-if="docu.id_opcion_titulacion   == 1">

                                              <b>I. Informe de residencia</b> <br>
                                              Caratula final de residencia <br>
                                      </template>
                                      <template v-if="docu.id_opcion_titulacion   == 2">

                                              <b>II. Proyecto de Innovación</b> <br>
                                              Constancia de Viabilidad <br>

                                      </template>
                                      <template v-if="docu.id_opcion_titulacion   == 3">

                                              <b>III. Proyecto de investigación</b> <br>
                                              Constancia de Viabilidad <br>


                                      </template>
                                      <template v-if="docu.id_opcion_titulacion   == 4">
                                              <b>IV. Informe de Estancia</b> <br>
                                              Constancia de Viabilidad <br>

                                      </template>
                                      <template v-if="docu.id_opcion_titulacion   == 5">

                                              <b>V. Tesis</b> <br>
                                              Constancia de Viabilidad <br>

                                      </template>
                                      <template v-if="docu.id_opcion_titulacion   == 6">

                                              <b>VI. Tesina</b> <br>
                                              Constancia de Viabilidad <br>

                                      </template>
                                  <template v-if="docu.id_opcion_titulacion   == 7">
                                          <b>VII. Otros : Ceneval</b> <br>
                                          Testimonio del examen EGEL<br>

                                  </template>
                                  <template v-if="docu.id_opcion_titulacion   == 8">

                                          <b>VII. Otros : Examen por área del conocimiento</b> <br>
                                          No se necesita documento <br>

                                  </template>
                                      <template v-if="docu.id_opcion_titulacion   == 9">
                                              <b>VII. Otros : Experiencia Profesional</b> <br>
                                              Constancia de Viabilidad <br>

                                      </template>
                                      <template v-if="docu.id_opcion_titulacion   == 10">

                                              <b>VII. Otros : Incubación de negocio</b> <br>
                                              Constancia de Viabilidad <br>


                                      </template>
                                  <template v-if="docu.id_opcion_titulacion   == 11">

                                      <b>VII. Otros : Modalidad dual</b> <br>
                                      Constancia de estudios en el programa dual <br>


                                  </template>

                              </h4>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.id_opcion_titulacion   != 8 ">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_opcion_titulacion" v-bind:href="'/titulacion/' + docu.pdf_opcion_titulacion" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                              </template>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_opcion_titulacion == 1">
                                  <template v-if="docu.estado_opcion_titulacion == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_opcion_titulacion == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_opcion_titulacion == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_opcion_titulacion">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_opcion_titulacion == 1">
                              <template v-if="docu.cal_opcion_titulacion == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_opcion_titulacion($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_opcion_titulacion == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_opcion_titulacion == 2">
                          <template v-if="docu.cal_opcion_titulacion == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_opcion_titulacion" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_opcion_titulacion" name="comentario_doc6" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_opcion_titulacion == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_opcion_titulacion  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_opcion_titulacion == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_opcion_titulacion($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_opcion_titulacion == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>

                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <template v-if="veri_anterior_10 == 0">
              <div class="tw:col-span-full tw:min-w-0">
                  <div class="tw:min-w-0">
                      <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                          <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                              <div class="tw:min-w-0 tw:lg:col-span-4">
                                  <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Acta de residencia profesional</h3>
                              </div>
                              <div class="tw:min-w-0 tw:lg:col-span-3">
                                  <label>
                                      <a  target="_blank" v-if="docu.pdf_acta_residencia" v-bind:href="'/titulacion/' + docu.pdf_acta_residencia" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                                  </label>
                              </div>
                              <div class="tw:min-w-0 tw:lg:col-span-3">
                                  <template v-if="docu.cal_acta_residencia == 1">
                                      <template v-if="docu.estado_acta_residencia == 1">
                                          <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                          <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                      </template>
                                      <template v-if="docu.estado_acta_residencia == 2">
                                          <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                          <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                      </template>
                                  </template>
                                  <template v-if="docu.cal_acta_residencia == 0">
                                      <div class="tw:space-y-2">
                                          <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                          <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_acta_residencia">
                                              <option disabled selected hidden :value="0">Selecciona</option>
                                              <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                          </select>
                                      </div>
                                  </template>
                              </div>
                              <template v-if="docu.estado_acta_residencia == 1">
                                  <template v-if="docu.cal_acta_residencia == 0">
                                      <div class="tw:min-w-0 tw:lg:col-span-2">
                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_acta_residencia($event)">Guardar</button>
                                      </div>
                                  </template>
                                  <template v-if="docu.cal_acta_residencia == 1">
                                      <div class="tw:min-w-0 tw:lg:col-span-2">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                      </div>
                                  </template>
                              </template>

                          </div>


                          <template v-if="docu.estado_acta_residencia == 2">
                              <template v-if="docu.cal_acta_residencia == 0">
                                  <div class="tw:col-span-full tw:min-w-0">
                                      <div class="tw:min-w-0">
                                          <div class="tw:space-y-2">
                                              <label for="domicilio3">Comentario para la modificación </label>
                                              <textarea id="comentario_acta_residencia" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_acta_residencia" name="comentario_doc5" rows="1"   required></textarea>
                                          </div>
                                      </div>
                                  </div>
                              </template>
                              <template v-if="docu.cal_acta_residencia == 1">
                                  <div class="tw:col-span-full tw:min-w-0">
                                      <div class="tw:min-w-0">
                                          <div class="tw:space-y-2">
                                              <label for="domicilio3">Comentario para la modificación: </label>
                                              <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_acta_residencia  }}</h4>
                                          </div>
                                      </div>
                                  </div>
                              </template>
                              <div class="tw:col-span-full tw:min-w-0">

                                  <div class="tw:my-3 tw:flex tw:justify-end">
                                      <template v-if="docu.cal_acta_residencia == 0">

                                          <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_acta_residencia($event)">Guardar</button>
                                      </template>
                                      <template v-if="docu.cal_acta_residencia == 1">
                                          <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                      </template>
                                  </div>

                              </div>
                          </template>
                      </div>
                  </div>
              </div>
          </template>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Pago de registro de título profesional de licenciatura con timbre holograma</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_pago_titulo" v-bind:href="'/titulacion/' + docu.pdf_pago_titulo" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_pago_titulo == 1">
                                  <template v-if="docu.estado_pago_titulo == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_pago_titulo == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_pago_titulo == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_pago_titulo">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_pago_titulo == 1">
                              <template v-if="docu.cal_pago_titulo == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_pago_titulo($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_pago_titulo == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_pago_titulo == 2">
                          <template v-if="docu.cal_pago_titulo == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_pago_titulo" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_pago_titulo" name="comentario_doc5" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_pago_titulo == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_pago_titulo  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_pago_titulo == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_pago_titulo($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_pago_titulo == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>

          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Pago de constancia de no adeudo</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_pago_contancia" v-bind:href="'/titulacion/' + docu.pdf_pago_contancia" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_pago_contancia == 1">
                                  <template v-if="docu.estado_pago_contancia == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_pago_contancia == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_pago_contancia == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_pago_contancia">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_pago_contancia == 1">
                              <template v-if="docu.cal_pago_contancia == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_pago_contancia($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_pago_contancia == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_pago_contancia == 2">
                          <template v-if="docu.cal_pago_contancia == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_pago_contancia" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_pago_contancia" name="comentario_doc5" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_pago_contancia == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_pago_contancia  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_pago_contancia == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_pago_contancia($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_pago_contancia == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>

          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Pago de derecho de titulación</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_pago_derecho_ti" v-bind:href="'/titulacion/' + docu.pdf_pago_derecho_ti" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_pago_derecho_ti == 1">
                                  <template v-if="docu.estado_pago_derecho_ti == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_pago_derecho_ti == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_pago_derecho_ti == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_pago_derecho_ti">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_pago_derecho_ti == 1">
                              <template v-if="docu.cal_pago_derecho_ti == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_pago_derecho_ti($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_pago_derecho_ti == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_pago_derecho_ti == 2">
                          <template v-if="docu.cal_pago_derecho_ti == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_pago_derecho_ti" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_pago_derecho_ti" name="comentario_doc5" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_pago_derecho_ti == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_pago_derecho_ti  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_pago_derecho_ti == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_pago_derecho_ti($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_pago_derecho_ti == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>

          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Pago de integrantes a jurado</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_pago_integrante_jurado" v-bind:href="'/titulacion/' + docu.pdf_pago_integrante_jurado" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_pago_integrante_jurado == 1">
                                  <template v-if="docu.estado_pago_integrante_jurado == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_pago_integrante_jurado == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_pago_integrante_jurado == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_pago_integrante_jurado">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_pago_integrante_jurado == 1">
                              <template v-if="docu.cal_pago_integrante_jurado == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_integrante_jurado($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_pago_integrante_jurado == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_pago_integrante_jurado == 2">
                          <template v-if="docu.cal_pago_integrante_jurado == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_pago_integrante_jurado" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_pago_integrante_jurado" name="comentario_doc5" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_pago_integrante_jurado == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_pago_integrante_jurado  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_pago_integrante_jurado == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_resp_integrante_jurado($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_pago_integrante_jurado == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <div class="tw:col-span-full tw:min-w-0">
              <div class="tw:min-w-0">
                  <div data-documento class="tw:my-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                      <div class="tw:grid tw:gap-4 tw:p-4 tw:sm:p-5 tw:lg:grid-cols-12 tw:lg:items-start">
                          <div class="tw:min-w-0 tw:lg:col-span-4">
                              <h3 class="tw:text-base tw:font-semibold tw:text-gray-900 tw:dark:text-white">Pago por concepto de autenticación de títulos profesionales diplomas o grados académicos electrónicos, para escuelas estatales oficiales o particulares incorporadas de: licenciatura o posgrado, por cada uno.</h3>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <label>
                                  <a  target="_blank" v-if="docu.pdf_pago_concepto_autenticacion" v-bind:href="'/titulacion/' + docu.pdf_pago_concepto_autenticacion" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a>
                              </label>
                          </div>
                          <div class="tw:min-w-0 tw:lg:col-span-3">
                              <template v-if="docu.cal_pago_concepto_autenticacion == 1">
                                  <template v-if="docu.estado_pago_concepto_autenticacion == 1">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">  SI</h4>

                                  </template>
                                  <template v-if="docu.estado_pago_concepto_autenticacion == 2">
                                      <p class="tw:text-sm tw:font-medium">Autorizado</p>
                                      <h4 class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">   NO</h4>
                                  </template>
                              </template>
                              <template v-if="docu.cal_pago_concepto_autenticacion == 0">
                                  <div class="tw:space-y-2">
                                      <span class="tw:text-sm tw:font-medium">Autorizar</span>
                                      <select aria-label="Autorizar documento" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-validate="'required'" v-model="docu.estado_pago_concepto_autenticacion">
                                          <option disabled selected hidden :value="0">Selecciona</option>
                                          <option v-for="respuesta in respuestas" :value="respuesta.id_respuesta">@{{respuesta.descripcion}}</option>
                                      </select>
                                  </div>
                              </template>
                          </div>
                          <template v-if="docu.estado_pago_concepto_autenticacion == 1">
                              <template v-if="docu.cal_pago_concepto_autenticacion == 0">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_pago_concepto_autenticacion($event)">Guardar</button>
                                  </div>
                              </template>
                              <template v-if="docu.cal_pago_concepto_autenticacion == 1">
                                  <div class="tw:min-w-0 tw:lg:col-span-2">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </div>
                              </template>
                          </template>

                      </div>


                      <template v-if="docu.estado_pago_concepto_autenticacion == 2">
                          <template v-if="docu.cal_pago_concepto_autenticacion == 0">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación </label>
                                          <textarea id="comentario_pago_concepto_autenticacion" aria-label="Comentario de corrección" class="tw-control tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:text-gray-800 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100"  v-model="docu.comentario_pago_concepto_autenticacion" name="comentario_doc5" rows="1"   required></textarea>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template v-if="docu.cal_pago_concepto_autenticacion == 1">
                              <div class="tw:col-span-full tw:min-w-0">
                                  <div class="tw:min-w-0">
                                      <div class="tw:space-y-2">
                                          <label for="domicilio3">Comentario para la modificación: </label>
                                          <h4 class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">@{{ docu.comentario_pago_concepto_autenticacion  }}</h4>
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <div class="tw:col-span-full tw:min-w-0">

                              <div class="tw:my-3 tw:flex tw:justify-end">
                                  <template v-if="docu.cal_pago_concepto_autenticacion == 0">

                                      <button   class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="guardar_pago_concepto_autenticacion($event)">Guardar</button>
                                  </template>
                                  <template v-if="docu.cal_pago_concepto_autenticacion == 1">
                                      <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-300">Revisado</p>
                                  </template>
                              </div>

                          </div>
                      </template>
                  </div>
              </div>
          </div>
          <div class="tw:col-span-full tw:min-w-0">
              <div  class="tw:min-w-0">
                  <x-panel.tabla id="tabla_envio" compacta desplazable="Constancia de no adeudo">

                      <thead>
                      <tr>

                          <th>Requisito</th>
                          <th>Ver Documento</th>
                          <th>Acción</th>

                      </tr>
                      </thead>

                      <tbody>
                      <tr>
                          <td>Constancia de No Adeudo</td>
                          <template v-if="docu.evi_constancia_adeudo  == 0">
                              <td>Sin documento</td>
                              <td><button  class="tw:inline-flex tw:items-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-brand-600" v-on:click="abrirModal_constancia_adeudo(false);">Agregar</button></td>
                          </template>
                          <template v-if="docu.evi_constancia_adeudo  == 1">
                              <td><a  target="_blank" v-if="docu.pdf_constancia_adeudo" v-bind:href="'/titulacion/' + docu.pdf_constancia_adeudo" rel="noopener" class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10">Ver PDF</a></td>
                              <td><button  class="tw:inline-flex tw:items-center tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:text-brand-600 tw:hover:bg-brand-50 tw:dark:text-brand-300 tw:dark:hover:bg-brand-500/10" v-on:click="abrirModal_constancia_adeudo(true);">Modificar</button></td>
                          </template>
                      </tr>
                      </tbody>
                  </x-panel.tabla>
              </div>
          </div>

          @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.enviar_revision_doc')
      </template>
        </template>
        @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.confirmar_revision_documento')
        @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.modal_reg_constancia_adeudo')
        @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.modal_enviar_correccion')
        @include('titulacion.jefe_titulacion.autorizar_doc_requisitos.aceptar_documentacion')
    </div>
@endsection

@push('scripts')
<script>
  new Vue({
      el:"#envio_doc",

      data(){
          return {
              cargando: true,
              errorCarga: false,

              //lo inicialisamos el array
              documentacion:[],
              fecha_activa:[],
              veri_egel:[],
              veri_anterior_10:[],
              est_actual_doc_al:[],
              veri_constancia_ingles:[],
              estado_certi_in:[],
              opciones_titulacion:[],
              respuestas:[],

              estado_guardar_correo:false,
              estado_guardar_acta:false,
              estado_guardar_certificado_prepa:false,
              estado_guardar_certificado_tesvb:false,
              estado_guardar_constancia_ss:false,
              estado_guardar_certificado_ingles:false,
              estado_guardar_opcion_titulacion:false,
              estado_enviar:false,



              correo_electronico:"",
              estadoguardar: false,
              documentoEnRevision: null,
              tituloDocumentoRevision: '',

              docu:{
                  id_requisitos:0,
                  id_alumno :0,

                  evi_acta_nac:0,
                  comentario_acta_nac:"",
                  pdf_acta_nac:"",
                  estado_acta_nac :0,
                  cal_acta_nac :0,

                  evi_curp:0,
                  comentario_curp:"",
                  pdf_curp:"",
                  estado_curp :0,
                  cal_curp :0,

                  evi_certificado_prep:0,
                  comentario_certificado_prep:"",
                  pdf_certificado_prep:"",
                  estado_certificado_prep :0,
                  cal_certificado_prep :0,

                  evi_certificado_tesvb:0,
                  comentario_certificado_tesvb:"",
                  pdf_certificado_tesvb:"",
                  estado_certificado_tesvb :0,
                  cal_certificado_tesvb :0,

                  evi_constancia_ss:0,
                  comentario_constancia_ss:"",
                  pdf_constancia_ss:"",
                  estado_constancia_ss :0,
                  cal_constancia_ss:0,

                  evi_certificado_acred_ingles:0,
                  comentario_certificado_acred_ingles:"",
                  pdf_certificado_acred_ingles:"",
                  estado_certificado_acred_ingles :0,
                  cal_certificado_acred_ingles:0,

                  evi_reporte_result_egel:0,
                  comentario_reporte_result_egel:"",
                  pdf_reporte_result_egel:"",
                  estado_reporte_result_egel:0,
                  cal_reporte_result_egel:0,

                  id_opcion_titulacion:0,


                  evi_opcion_titulacion:0,
                  comentario_opcion_titulacion:"",
                  pdf_opcion_titulacion:"",
                  estado_opcion_titulacion :0,
                  cal_opcion_titulacion:0,

                  evi_constancia_adeudo:0,
                  comentario_constancia_adeudo:"",
                  pdf_constancia_adeudo:"",
                  estado_constancia_adeudo :0,

                  evi_pago_titulo:0,
                  comentario_pago_titulo:"",
                  pdf_pago_titulo:"",
                  estado_pago_titulo:0,
                  cal_pago_titulo:0,

                  evi_pago_contancia:0,
                  comentario_pago_contancia:"",
                  pdf_pago_contancia:"",
                  estado_pago_contancia:0,
                  cal_pago_contancia:0,

                  evi_pago_derecho_ti:0,
                  comentario_pago_derecho_ti:"",
                  pdf_pago_derecho_ti:"",
                  estado_pago_derecho_ti:0,
                  cal_pago_derecho_ti:0,

                  evi_pago_integrante_jurado:0,
                  comentario_pago_integrante_jurado:"",
                  pdf_pago_integrante_jurado:"",
                  estado_pago_integrante_jurado:0,
                  cal_pago_integrante_jurado:0,

                  evi_acta_residencia:0,
                  comentario_acta_residencia:"",
                  pdf_acta_residencia:"",
                  estado_acta_residencia:0,
                  cal_acta_residencia:0,

                  evi_pago_concepto_autenticacion:0,
                  comentario_pago_concepto_autenticacion:"",
                  pdf_pago_concepto_autenticacion:"",
                  estado_pago_concepto_autenticacion:0,
                  cal_pago_concepto_autenticacion:0,

                  correo_electronico:"",
                  id_estado_enviado:0,


              },
              ingles:{
                  id_certificado_acreditacion:0,
                  pdf_certificado:"",
                  id_alumno:0,
                  estado_cert:0,
              },


              titulo_cons_adeudo:"",
              estado_guardar_cons_adeudo:false,
              guarda_envio_correccion:false,

              file:'',





          }
      },
      methods: {
          //meetodo para mostrar tabla
          async Documentacion() {
              this.cargando = true;
              this.errorCarga = false;
              try {
                  const contar = await axios.get('/titulacion/estado_actual_fecha/{{$id_alumno}}');
                  this.fecha_activa = contar.data;
                  const respuestas = await axios.get('/ambiental/respuestas/');
                  this.respuestas = respuestas.data;
                  const verificacion_reg_doc = await axios.get('/titulacion/est_actual_doc_al/{{$id_alumno}}');
                  this.est_actual_doc_al = verificacion_reg_doc.data;
                  const verificacion_const_ing = await axios.get('/titulacion/veri_constancia_ingles/{{$id_alumno}}');
                  this.veri_constancia_ingles = verificacion_const_ing.data;
                  const veri_egel_al= await axios.get('/titulacion/veri_egel_al/{{$id_alumno}}');
                  this.veri_egel = veri_egel_al.data;
                  const veri_ante_2010= await axios.get('/titulacion/veri_ante_2010/{{$id_alumno}}');
                  this.veri_anterior_10 = veri_ante_2010.data;



                  if(this.veri_constancia_ingles == 2){
                      const certificado_ingles = await axios.get('/titulacion/status_certi_ingles/{{$id_alumno}}');
                      this.estado_certi_in = certificado_ingles.data;
                      this.ingles.id_certificado_acreditacion=this.estado_certi_in[0].id_certificado_acreditacion;
                      this.ingles.pdf_certificado=this.estado_certi_in[0].pdf_certificado;
                      this.ingles.id_alumno=this.estado_certi_in[0].id_alumno;
                      this.ingles.estado_cert=this.estado_certi_in[0].estado_cert;
                  }
                  if(this.est_actual_doc_al > 0){
                      const doc = await axios.get('/titulacion/documentacion_alumno/{{$id_alumno}}');
                      this.documentacion = doc.data;

                      this.docu.id_requisitos =this.documentacion[0].id_requisitos;
                      this.docu.id_alumno =this.documentacion[0].id_alumno;

                      this.docu.evi_acta_nac =this.documentacion[0].evi_acta_nac;
                      this.docu.comentario_acta_nac =this.documentacion[0].comentario_acta_nac;
                      this.docu.pdf_acta_nac =this.documentacion[0].pdf_acta_nac;
                      this.docu.estado_acta_nac =this.documentacion[0].estado_acta_nac;
                      this.docu.cal_acta_nac =this.documentacion[0].cal_acta_nac;

                      this.docu.evi_curp =this.documentacion[0].evi_curp;
                      this.docu.comentario_curp =this.documentacion[0].comentario_curp;
                      this.docu.pdf_curp =this.documentacion[0].pdf_curp;
                      this.docu.estado_curp =this.documentacion[0].estado_curp;
                      this.docu.cal_curp =this.documentacion[0].cal_curp;

                      this.docu.evi_certificado_prep =this.documentacion[0].evi_certificado_prep;
                      this.docu.comentario_certificado_prep =this.documentacion[0].comentario_certificado_prep;
                      this.docu.pdf_certificado_prep =this.documentacion[0].pdf_certificado_prep;
                      this.docu.estado_certificado_prep =this.documentacion[0].estado_certificado_prep;
                      this.docu.cal_certificado_prep =this.documentacion[0].cal_certificado_prep;

                      this.docu.evi_certificado_tesvb =this.documentacion[0].evi_certificado_tesvb;
                      this.docu.comentario_certificado_tesvb =this.documentacion[0].comentario_certificado_tesvb;
                      this.docu.pdf_certificado_tesvb =this.documentacion[0].pdf_certificado_tesvb;
                      this.docu.estado_certificado_tesvb =this.documentacion[0].estado_certificado_tesvb;
                      this.docu.cal_certificado_tesvb =this.documentacion[0].cal_certificado_tesvb;

                      this.docu.evi_constancia_ss =this.documentacion[0].evi_constancia_ss;
                      this.docu.comentario_constancia_ss =this.documentacion[0].comentario_constancia_ss ;
                      this.docu.pdf_constancia_ss =this.documentacion[0].pdf_constancia_ss;
                      this.docu.estado_constancia_ss =this.documentacion[0].estado_constancia_ss;
                      this.docu.cal_constancia_ss =this.documentacion[0].cal_constancia_ss;

                      this.docu.evi_certificado_acred_ingles =this.documentacion[0].evi_certificado_acred_ingles;
                      this.docu.comentario_certificado_acred_ingles =this.documentacion[0].comentario_certificado_acred_ingles ;
                      this.docu.pdf_certificado_acred_ingles =this.documentacion[0].pdf_certificado_acred_ingles;
                      this.docu.estado_certificado_acred_ingles =this.documentacion[0].estado_certificado_acred_ingles;
                      this.docu.cal_certificado_acred_ingles =this.documentacion[0].cal_certificado_acred_ingles;

                      this.docu.evi_reporte_result_egel =this.documentacion[0].evi_reporte_result_egel;
                      this.docu.comentario_reporte_result_egel =this.documentacion[0].comentario_reporte_result_egel ;
                      this.docu.pdf_reporte_result_egel =this.documentacion[0].pdf_reporte_result_egel;
                      this.docu.estado_reporte_result_egel =this.documentacion[0].estado_reporte_result_egel;
                      this.docu.cal_reporte_result_egel =this.documentacion[0].cal_reporte_result_egel;

                      this.docu.id_opcion_titulacion =this.documentacion[0].id_opcion_titulacion;

                      this.docu.evi_opcion_titulacion =this.documentacion[0].evi_opcion_titulacion;
                      this.docu.comentario_opcion_titulacion =this.documentacion[0].comentario_opcion_titulacion ;
                      this.docu.pdf_opcion_titulacion =this.documentacion[0].pdf_opcion_titulacion;
                      this.docu.estado_opcion_titulacion =this.documentacion[0].estado_opcion_titulacion;
                      this.docu.cal_opcion_titulacion =this.documentacion[0].cal_opcion_titulacion;

                      this.docu.evi_constancia_adeudo =this.documentacion[0].evi_constancia_adeudo;
                      this.docu.comentario_constancia_adeudo =this.documentacion[0].comentario_constancia_adeudo ;
                      this.docu.pdf_constancia_adeudo =this.documentacion[0].pdf_constancia_adeudo;
                      this.docu.estado_constancia_adeudo =this.documentacion[0].estado_constancia_adeudo;

                      this.docu.evi_pago_titulo =this.documentacion[0].evi_pago_titulo;
                      this.docu.comentario_pago_titulo =this.documentacion[0].comentario_pago_titulo ;
                      this.docu.pdf_pago_titulo =this.documentacion[0].pdf_pago_titulo;
                      this.docu.estado_pago_titulo =this.documentacion[0].estado_pago_titulo;
                      this.docu.cal_pago_titulo =this.documentacion[0].cal_pago_titulo;

                      this.docu.evi_pago_contancia =this.documentacion[0].evi_pago_contancia;
                      this.docu.comentario_pago_contancia =this.documentacion[0].comentario_pago_contancia ;
                      this.docu.pdf_pago_contancia =this.documentacion[0].pdf_pago_contancia;
                      this.docu.estado_pago_contancia =this.documentacion[0].estado_pago_contancia;
                      this.docu.cal_pago_contancia =this.documentacion[0].cal_pago_contancia;

                      this.docu.evi_pago_derecho_ti =this.documentacion[0].evi_pago_derecho_ti;
                      this.docu.comentario_pago_derecho_ti =this.documentacion[0].comentario_pago_derecho_ti ;
                      this.docu.pdf_pago_derecho_ti =this.documentacion[0].pdf_pago_derecho_ti;
                      this.docu.estado_pago_derecho_ti =this.documentacion[0].estado_pago_derecho_ti;
                      this.docu.cal_pago_derecho_ti =this.documentacion[0].cal_pago_derecho_ti;

                      this.docu.evi_pago_integrante_jurado =this.documentacion[0].evi_pago_integrante_jurado;
                      this.docu.comentario_pago_integrante_jurado =this.documentacion[0].comentario_pago_integrante_jurado ;
                      this.docu.pdf_pago_integrante_jurado =this.documentacion[0].pdf_pago_integrante_jurado;
                      this.docu.estado_pago_integrante_jurado =this.documentacion[0].estado_pago_integrante_jurado;
                      this.docu.cal_pago_integrante_jurado =this.documentacion[0].cal_pago_integrante_jurado;

                      this.docu.evi_acta_residencia =this.documentacion[0].evi_acta_residencia;
                      this.docu.comentario_acta_residencia =this.documentacion[0].comentario_acta_residencia ;
                      this.docu.pdf_acta_residencia =this.documentacion[0].pdf_acta_residencia;
                      this.docu.estado_acta_residencia =this.documentacion[0].estado_acta_residencia;
                      this.docu.cal_acta_residencia =this.documentacion[0].cal_acta_residencia;

                      this.docu.evi_pago_concepto_autenticacion =this.documentacion[0].evi_pago_concepto_autenticacion;
                      this.docu.comentario_pago_concepto_autenticacion =this.documentacion[0].comentario_pago_concepto_autenticacion ;
                      this.docu.pdf_pago_concepto_autenticacion =this.documentacion[0].pdf_pago_concepto_autenticacion;
                      this.docu.estado_pago_concepto_autenticacion =this.documentacion[0].estado_pago_concepto_autenticacion;
                      this.docu.cal_pago_concepto_autenticacion =this.documentacion[0].cal_pago_concepto_autenticacion;



                      this.docu.correo_electronico =this.documentacion[0].correo_electronico;
                      this.docu.id_estado_enviado =this.documentacion[0].id_estado_enviado;



                  }
                  const opciones_titulacion = await axios.get('/titulacion/opciones_titulacion/{{ $id_alumno }}/');
                  this.opciones_titulacion = opciones_titulacion.data;
              } catch {
                  this.errorCarga = true;
              } finally {
                  this.cargando = false;
              }
          },
          abrirModal_constancia_adeudo(modificar) {
              if (this.estado_guardar_cons_adeudo || this.estadoguardar) { return; }
              this.titulo_cons_adeudo = modificar ? 'Modificar constancia de no adeudo' : 'Registrar constancia de no adeudo';
              this.file = null;
              document.getElementById('file').value = '';
              PanelModal.abrir('registrar-constancia-adeudo', document.activeElement);
          },
          variable_doc_1(event) {
              this.file = event.target.files[0] ?? null;
          },
          async guardar_doc_cons_adeudo() {
              if (this.estado_guardar_cons_adeudo || this.estadoguardar) { return; }
              if (!this.file) {
                  await PanelFormularios.alerta('warning', 'Selecciona la constancia de no adeudo', 'Adjunta el documento en PDF.');
                  document.getElementById('file').focus();
                  return;
              }

              const datos = new FormData();
              datos.append('name', 'my-file');
              datos.append('file', this.file);
              this.estado_guardar_cons_adeudo = true;
              try {
                  await axios.post('/titulacion/registrar_constancia_adeudo/'+this.docu.id_requisitos, datos);
              } catch {
                  await PanelFormularios.alerta('error', 'No se pudo guardar la constancia', 'Intenta de nuevo.');
                  return;
              } finally {
                  this.estado_guardar_cons_adeudo = false;
              }

              PanelModal.cerrar('registrar-constancia-adeudo');
              await this.Documentacion();
              PanelFormularios.alerta('success', 'Constancia guardada');
          },
          guardar_resp_acta(evento) {
            if(this.docu.estado_acta_nac == 1)
            {
                  this.abrirConfirmacionRevision(1, evento.currentTarget);
            }
              if(this.docu.estado_acta_nac == 2)
              {
                  if(this.docu.comentario_acta_nac == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(1, evento.currentTarget);
                  }
              }
          },
          guardar_resp_curp(evento) {
              if(this.docu.estado_curp == 1)
              {
                  this.abrirConfirmacionRevision(2, evento.currentTarget);
              }
              if(this.docu.estado_curp == 2)
              {
                  if(this.docu.comentario_curp == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(2, evento.currentTarget);
                  }
              }
          },
          guardar_resp_certificado_prepa(evento) {
              if(this.docu.estado_certificado_prep == 1)
              {
                  this.abrirConfirmacionRevision(3, evento.currentTarget);
              }
              if(this.docu.estado_certificado_prep == 2)
              {
                  if(this.docu.comentario_certificado_prep == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(3, evento.currentTarget);
                  }
              }

          },
          guardar_resp_certificado_tesvb(evento) {
              if(this.docu.estado_certificado_tesvb == 1)
              {
                  this.abrirConfirmacionRevision(4, evento.currentTarget);
              }
              if(this.docu.estado_certificado_tesvb == 2)
              {
                  if(this.docu.comentario_certificado_tesvb == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(4, evento.currentTarget);
                  }
              }
          },
          guardar_resp_constancia_ss(evento) {
              if(this.docu.estado_constancia_ss == 1)
              {
                  this.abrirConfirmacionRevision(5, evento.currentTarget);
              }
              if(this.docu.estado_constancia_ss == 2)
              {
                  if(this.docu.comentario_constancia_ss == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(5, evento.currentTarget);
                  }
              }
          },
          guardar_resp_certificado_acred_ingles(evento) {
              if(this.docu.estado_certificado_acred_ingles == 1)
              {
                  this.abrirConfirmacionRevision(6, evento.currentTarget);
              }
              if(this.docu.estado_certificado_acred_ingles == 2)
              {
                  if(this.docu.comentario_certificado_acred_ingles == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(6, evento.currentTarget);
                  }
              }
          },
          guardar_resp_reporte_result_egel(evento) {
              if(this.docu.estado_reporte_result_egel == 1)
              {
                  this.abrirConfirmacionRevision(8, evento.currentTarget);
              }
              if(this.docu.estado_reporte_result_egel == 2)
              {
                  if(this.docu.comentario_reporte_result_egel == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(8, evento.currentTarget);
                  }
              }
          },
          guardar_resp_opcion_titulacion(evento) {
              if(this.docu.estado_opcion_titulacion == 1)
              {
                  this.abrirConfirmacionRevision(7, evento.currentTarget);
              }
              if(this.docu.estado_opcion_titulacion == 2)
              {
                  if(this.docu.comentario_opcion_titulacion == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(7, evento.currentTarget);
                  }
              }
          },
          guardar_resp_pago_titulo(evento) {
              if(this.docu.estado_pago_titulo == 1)
              {
                  this.abrirConfirmacionRevision(9, evento.currentTarget);
              }
              if(this.docu.estado_pago_titulo == 2)
              {
                  if(this.docu.comentario_pago_titulo == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(9, evento.currentTarget);
                  }
              }
          },
          guardar_resp_pago_contancia(evento) {
              if(this.docu.estado_pago_contancia == 1)
              {
                  this.abrirConfirmacionRevision(10, evento.currentTarget);
              }
              if(this.docu.estado_pago_contancia == 2)
              {
                  if(this.docu.comentario_pago_contancia == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(10, evento.currentTarget);
                  }
              }
          },
          guardar_resp_pago_derecho_ti(evento) {
              if(this.docu.estado_pago_derecho_ti == 1)
              {
                  this.abrirConfirmacionRevision(11, evento.currentTarget);
              }
              if(this.docu.estado_pago_derecho_ti == 2)
              {
                  if(this.docu.comentario_pago_derecho_ti == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(11, evento.currentTarget);
                  }
              }
          },
          guardar_resp_integrante_jurado(evento) {
              if(this.docu.estado_pago_integrante_jurado == 1)
              {
                  this.abrirConfirmacionRevision(12, evento.currentTarget);
              }
              if(this.docu.estado_pago_integrante_jurado == 2)
              {
                  if(this.docu.comentario_pago_integrante_jurado == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(12, evento.currentTarget);
                  }
              }
          },
          guardar_resp_acta_residencia(evento) {
              if(this.docu.estado_acta_residencia == 1)
              {
                  this.abrirConfirmacionRevision(13, evento.currentTarget);
              }
              if(this.docu.estado_acta_residencia == 2)
              {
                  if(this.docu.comentario_acta_residencia == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(13, evento.currentTarget);
                  }
              }
          },
          guardar_pago_concepto_autenticacion(evento) {
              if(this.docu.estado_pago_concepto_autenticacion == 1)
              {
                  this.abrirConfirmacionRevision(14, evento.currentTarget);
              }
              if(this.docu.estado_pago_concepto_autenticacion == 2)
              {
                  if(this.docu.comentario_pago_concepto_autenticacion == ""){
                      swal({
                          position: "top",
                          type: "warning",
                          title: "El campo del comentario se encuentra  vacío.",
                          showConfirmButton: false,
                          timer: 3500});
                  }else{
                      this.abrirConfirmacionRevision(14, evento.currentTarget);
                  }
              }
          },

          abrirConfirmacionRevision(numero, boton) {
              if (this.estadoguardar || this.estado_guardar_cons_adeudo) { return; }
              this.documentoEnRevision = numero;
              this.tituloDocumentoRevision = boton.closest('[data-documento]')?.querySelector('h3, h4')?.textContent.trim() ?? '';
              PanelModal.abrir('confirmar-revision-documento', boton);
          },
          async guardarRevision() {
              if (this.estadoguardar || this.estado_guardar_cons_adeudo || !this.documentoEnRevision) { return; }
              this.estadoguardar = true;
              try {
                  await axios.post('/titulacion/guardar_validar_'+this.documentoEnRevision+'/'+this.docu.id_requisitos, this.docu);
              } catch {
                  await PanelFormularios.alerta('error', 'No se pudo guardar la revisión', 'Intenta de nuevo.');
                  return;
              } finally {
                  this.estadoguardar = false;
              }

              PanelModal.cerrar('confirmar-revision-documento');
              await this.Documentacion();
              PanelFormularios.alerta('success', 'Revisión guardada');
          },
          abrirModalenviar_modificaciones() {
              PanelModal.abrir('confirmar-envio-correcciones', document.activeElement);
          },
          Enviar_correcciones() {
              if (this.guarda_envio_correccion) { return; }
              this.guarda_envio_correccion = true;
              window.location.assign('/requisitos/enviar_correcciones_alumno/'+this.docu.id_requisitos);
          },
          abrirModalautorizar_Doc() {
              PanelModal.abrir('confirmar-autorizacion-documentacion', document.activeElement);
          },
          Enviar_aceptacion() {
              if (this.guarda_envio_correccion) { return; }
              this.guarda_envio_correccion = true;
              window.location.assign('/requisitos/enviar_autorizacion_documentacion/'+this.docu.id_requisitos);
          },
      },
      //funciones para cuando se cargue la vista
      created() {
          this.Documentacion();
      },

  })
</script>
@endpush
