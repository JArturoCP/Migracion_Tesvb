@section('modal_valoracion_efectos')

    <x-panel.modal id="modal_efectos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Evaluación de riesgos</h5>
                    
                </div>
                <form id="form_valoracion_efectos" class="" role="form" method="POST" action="{{url('riesgos/valoracion_efectos')."/".$datos_registro_riesgo[0]->valEfectos[0]->id_val_efecto}}">
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <input type="hidden" name="id_reg_riesgo_val_efec" id="id_reg_riesgo_val_efec" value="{{isset($datos_registro_riesgo[0]->id_reg_riesgo)?$datos_registro_riesgo[0]->id_reg_riesgo:""}}">
                        @foreach($datos_registro_riesgo[0]->estrategiaRiesgo as $estrategia)
                            <input type="hidden" name="id_estrategia_r" id="id_estrategia_r" value="{{$estrategia->id_estrategia_r}}">
                        @endforeach
                        <div class="tw:mb-4">
                            <label for="descripcion_efecto" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Posibles efectos del riesgo</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_efecto" id="descripcion_efecto" cols="3" rows="3"> {{isset($datos_registro_riesgo[0]->valEfectos[0])?$datos_registro_riesgo[0]->valEfectos[0]->efecto:""}}</textarea>
                        </div>
                        <hr>
                        <h5 class="text-center tw:text-center tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">Valoracion inicial</h5>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="grado_impacto" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Grado de impacto</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="grado_impacto" id="grado_impacto">
                                    <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                    @for($i=1;$i<=10;$i++)
                                        <option {{($datos_registro_riesgo[0]->valEfectos[0]->grado_impacto==$i)?"selected":""}} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="probabilidad_ocurrencia" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Probabilidad de ocurrencia</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="probabilidad_ocurrencia" id="probabilidad_ocurrencia">
                                    <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                    @for($i=1;$i<=10;$i++)
                                        <option {{($datos_registro_riesgo[0]->valEfectos[0]->probabilidad==$i)?"selected":""}} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div hidden class="cuadrantes tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Cuadrante</label>
                                <h4 class="cuadrante text-center tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"></h4>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_estrategia" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Estrategias</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="id_estrategia" id="id_estrategia">
                                    <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                    
                                    @foreach($ri_estrategia as $estrategias)
                                        <option value="{{$estrategias->id_estrategia}}" {{(isset($datos_registro_riesgo[0]->estrategiaRiesgo[0]->getEstrategia[0]->id_estrategia)==$estrategias->id_estrategia)?"selected":""}} >{{$estrategias->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_efectos_final" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Valoracion Final</h5>
                    
                </div>
                <form id="form_valoracion_efectos" class="" role="form" method="POST" action="{{url('riesgos/valoracion_efectos')."/".(isset($datos_registro_riesgo[0]->valEfectos[0])?$datos_registro_riesgo[0]->valEfectos[0]->id_val_efecto:"")}}">
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <input type="hidden" name="id_reg_riesgo_val_efec" id="id_reg_riesgo_val_efec" value="{{$datos_registro_riesgo[0]->id_reg_riesgo}}">
                        <h5 class="text-center tw:text-center tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">Valoracion final</h5>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="impacto_final" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Grado de impacto</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="impacto_final" id="impacto_final">
                                    <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                    @for($i=1;$i<=10;$i++)
                                        <option {{($datos_registro_riesgo[0]->valEfectos[0]->impacto_final==$i)?"selected":""}} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="ocurrencia_final" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Probabilidad de ocurrencia</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="ocurrencia_final" id="ocurrencia_final">
                                    <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                    @for($i=1;$i<=10;$i++)
                                        <option {{($datos_registro_riesgo[0]->valEfectos[0]->ocurrencia_final==$i)?"selected":""}} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>

    <script>
        $(document).ready(function() {
            if($("#probabilidad_ocurrencia").val()>0&&$("#grado_impacto").val()){
                // $(".cuadrantes").fadeIn(0);
                setCuadrante()
            }
            $("#form_valoracion_efectos").validate({
                rules: {
                    probabilidad_ocurrencia: {
                        required: true,
                    },
                    descripcion_efecto: {
                        required: true,
                    },
                    grado_impacto: {
                        required: true,
                    },
                },
            });
            $("#probabilidad_ocurrencia, #grado_impacto").change( function () {
                if ($("#grado_impacto").val()>0 && $("#probabilidad_ocurrencia").val()>0) {
                    setCuadrante();

                }
                $("#id_estrategia").val("");

            });

        });
        function setCuadrante(){
            var ocurrencia=$("#probabilidad_ocurrencia").val();
            var impacto=$("#grado_impacto").val();
            $("option").each(function () {
                if($(this).html().toString().toLowerCase()=="asumir el riesgo"){
                    $(this).hide();
                }
            })
            if (ocurrencia<=5) {
                if(impacto<=5) {
                    $(".cuadrante").html("III").removeClass().addClass('cuadrante text-center btn-success');
                    $("option").each(function () {
                        if($(this).html().toString().toLowerCase()=="asumir el riesgo"){
                            $(this).show();
                        }
                    })
                }
                else $(".cuadrante").html("IV").removeClass().addClass('cuadrante text-center btn-info');
            }
            else {
                if(impacto<=5) $(".cuadrante").html("II").removeClass().addClass('cuadrante text-center btn-warning');
                else $(".cuadrante").html("I").removeClass().addClass('cuadrante text-center btn-danger');
            }
            $(".cuadrantes").fadeIn(500);
        }
    </script>
@endsection