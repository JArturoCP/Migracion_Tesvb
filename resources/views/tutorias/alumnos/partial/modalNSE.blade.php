{{-- Test de nivel socioeconómico del expediente (dentro de la plantilla Vue #expediente). Lo abre el botón con data-toggle="modal" data-target="#modalNSE" y lo cierra CalculaNivel() con $('#modalNSE').modal('hide'). --}}
<x-panel.modal id="modalNSE" name="modal" tamano="xl" titulo="TEST NIVEL SOCIO-ECONÓMICO">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" v-if="test.testlleno==false">
                    <div class="tw:w-full tw:px-2">
                        <h5 class="tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:text-center">Debes de responder todas las preguntas</h5>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4">
                            <div class="tw:w-8/12 tw:px-2">
                                <label for="p1"><b>1.-</b> Pensando en el jefe o jefa de hogar, ¿Cuál fue el último año de estudios que aprobó en la
                                    escuela? </label>
                            </div>
                            <div class="tw:w-4/12 tw:px-2">
                                <select name="" id="p1" v-model.number="test.p1" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="null" selected>Elija una opción</option>
                                    <option value="0">Sin Instrucción</option>
                                    <option value="0">Preescolar</option>
                                    <option value="10">Primaria Incompleta</option>
                                    <option value="22">Primaria Completa</option>
                                    <option value="23">Secundaria Incompleta</option>
                                    <option value="31">Secundaria Completa</option>
                                    <option value="35">Preparatoria Incompleta</option>
                                    <option value="43">Preparatoria Completa</option>
                                    <option value="59">Licenciatura Incompleta</option>
                                    <option value="73">Licenciatura Completa</option>
                                    <option value="101">Posgrado</option>
                                </select>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4">
                            <div class="tw:w-8/12 tw:px-2">
                                <label for="p2"><b>2.-</b> ¿Cuántos baños completos con regadera y W.C. (excusado) hay en esta vivienda? </label>
                            </div>
                            <div class="tw:w-4/12 tw:px-2">
                                <select name="" v-model.number="test.p2"  id="p2" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="null" selected>Elija una opción</option>
                                    <option value="0">0</option>
                                    <option value="24">1</option>
                                    <option value="47">2 o más</option>
                                </select>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4">
                            <div class="tw:w-8/12 tw:px-2">
                                <label for="p3"><b>3.-</b> ¿Cuántos automóviles o camionetas tienen en su hogar, incluyendo camionetas cerradas, o
                                    con cabina o caja? </label>
                            </div>
                            <div class="tw:w-4/12 tw:px-2">
                                <select name="" v-model.number="test.p3"  id="p3" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="null" selected>Elija una opción</option>
                                    <option value="0">0</option>
                                    <option value="18">1</option>
                                    <option value="37">2 o más</option>
                                </select>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4">
                            <div class="tw:w-8/12 tw:px-2">
                                <label for="p4"><b>4.-</b> Sin tomar en cuenta la conexión móvil que pudiera tener desde algún celular ¿Este hogar
                                    cuenta con internet? </label>
                            </div>
                            <div class="tw:w-4/12 tw:px-2">
                                <select name="" v-model.number="test.p4"  id="p4" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="null" selected>Elija una opción</option>
                                    <option value="0">No tiene</option>
                                    <option value="31">Sí tiene</option>
                                </select>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4">
                            <div class="tw:w-8/12 tw:px-2">
                                <label for="p5"><b>5.-</b> De todas las personas de 14 años o más que viven en el hogar, ¿Cuántas trabajaron en el
                                    último mes? </label>
                            </div>
                            <div class="tw:w-4/12 tw:px-2">
                                <select name="" v-model.number="test.p5"  id="p5" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="null" selected>Elija una opción</option>
                                    <option value="0">0</option>
                                    <option value="15">1</option>
                                    <option value="31">2</option>
                                    <option value="46">3</option>
                                    <option value="61">4 o más</option>
                                </select>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4">
                            <div class="tw:w-8/12 tw:px-2">
                                <label for="p6"><b>6.-</b> En esta vivienda, ¿Cuántos cuartos se usan para dormir, sin contar pasillos ni baños? </label>
                            </div>
                            <div class="tw:w-4/12 tw:px-2">
                                <select name=""  v-model.number="test.p6" id="p6" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="null" selected>Elija una opción</option>
                                    <option value="0">0</option>
                                    <option value="6">1</option>
                                    <option value="12">2</option>
                                    <option value="17">3</option>
                                    <option value="23">4 o más</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
    <x-slot:pie>
        <button type="button" @click="CalculaNivel()" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
    </x-slot:pie>
</x-panel.modal>
