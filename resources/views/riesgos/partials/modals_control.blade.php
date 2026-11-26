@section('cont_modals_control')

<x-panel.modal id="modal_controles_factores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Nuevo control de riesgo</h5>
                
            </div>
            <form id="form_add_eva_control" class="" role="form" method="POST" action="{{url('riesgos/rievaluacioncontrol')}}"/>
            @csrf
            <div class="tw-modal-cuerpo">
                    <div class="tw:mb-4">
                        <input type="hidden" id="id_factor_eva" name="id_factor_eva" value="">
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Descripcion</label>
                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_eva_control" id="descripcion_eva_control" cols="3" rows="3"></textarea>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Tipo</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_eva_control" id="tipo_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            @foreach($tipos_evas as $tipo_eva)
                                <option value="{{$tipo_eva->id_tipo_eva}}">{{$tipo_eva->des_eva}}</option>
                            @endforeach
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Está documentado?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="documentado_eva_control" id="documentado_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Está formalizado?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="formalizado_eva_control" id="formalizado_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Se aplica?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="aplica_eva_control" id="aplica_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Es efectivo?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="efectivo_eva_control" id="efectivo_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="No">NO</option>
                        </select>
                    </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                </div>
            </form>
        </x-panel.modal>
<x-panel.modal id="modal_controles_factores_edit" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar control de riesgo</h5>
                
            </div>
            <form id="form_edit_eva_control" class="" role="form" method="POST" action=""/>
            @csrf
            @method("PUT")
            <div class="tw-modal-cuerpo">
                <div class="tw:mb-4">

                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Descripcion</label>
                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_eva_control_edit" id="descripcion_eva_control_edit" cols="3" rows="3"></textarea>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Tipo</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_eva_control_edit" id="tipo_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        @foreach($tipos_evas as $tipo_eva)
                            <option value="{{$tipo_eva->id_tipo_eva}}">{{$tipo_eva->des_eva}}</option>
                        @endforeach
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Está documentado?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="documentado_eva_control_edit" id="documentado_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Está formalizado?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="formalizado_eva_control_edit" id="formalizado_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Se aplica?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="aplica_eva_control_edit" id="aplica_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Es efectivo?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="efectivo_eva_control_edit" id="efectivo_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
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
        $("#form_add_eva_control").validate({
            rules: {
                descripcion_eva_control:{required:true,},
                tipo_eva_control:{required:true,},
                documentado_eva_control:{required:true,},
                formalizado_eva_control:{required:true,},
                aplica_eva_control:{required:true,},
                efectivo_eva_control:{required:true,},

            },
        });
        $("#form_edit_eva_control").validate({
            rules: {
                descripcion_eva_control_edit:{required:true,},
                tipo_eva_control_edit:{required:true,},
                documentado_eva_control_edit:{required:true,},
                formalizado_eva_control_edit:{required:true,},
                aplica_eva_control_edit:{required:true,},
                efectivo_eva_control_edit:{required:true,},

            },
        });
        $(".btn_edit_control_riesgo").click(function(){
            //console.log($(this).data("descripcion"));
            $("#descripcion_eva_control_edit").val($(this).data("descripcion"));
            $("#tipo_eva_control_edit").val($(this).data("tipo_eva"));
            $("#documentado_eva_control_edit").val($(this).data("documentado"));
            $("#formalizado_eva_control_edit").val($(this).data("formalizado"));
            $("#aplica_eva_control_edit").val($(this).data("aplica"));
            $("#efectivo_eva_control_edit").val($(this).data("efectivo"));
            $("#form_edit_eva_control").attr("action","{{url('riesgos/rievaluacioncontrol')}}/"+$(this).data("id"));
        });

        $(".btn_add_eva_control").click(function(){
            $("#id_factor_eva").val($(this).data("id"));
        });
    });
</script>
@endsection