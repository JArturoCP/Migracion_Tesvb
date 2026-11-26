@section('cont_modals_control')

<div class="modal fade tw-modal-compat" id="modal_controles_factores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
    <div class="modal-dialog tw:mt-2" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo control de riesgo</h5>
                <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_add_eva_control" class="" role="form" method="POST" action="{{url('riesgos/rievaluacioncontrol')}}"/>
            @csrf
            <div class="modal-body">
                    <div class="tw:mb-4">
                        <input type="hidden" id="id_factor_eva" name="id_factor_eva" value="">
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Descripcion</label>
                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_eva_control" id="descripcion_eva_control" cols="3" rows="3"></textarea>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Tipo</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_eva_control" id="tipo_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            @foreach($tipos_evas as $tipo_eva)
                                <option value="{{$tipo_eva->id_tipo_eva}}">{{$tipo_eva->des_eva}}</option>
                            @endforeach
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Está documentado?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="documentado_eva_control" id="documentado_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Está formalizado?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="formalizado_eva_control" id="formalizado_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Se aplica?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="aplica_eva_control" id="aplica_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Es efectivo?</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="efectivo_eva_control" id="efectivo_eva_control">
                            <option value="" disabled="true" selected="true">Seleccione una opción</option>
                            <option value="SI">SI</option>
                            <option value="No">NO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade tw-modal-compat" id="modal_controles_factores_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
    <div class="modal-dialog tw:mt-2" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar control de riesgo</h5>
                <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_edit_eva_control" class="" role="form" method="POST" action=""/>
            @csrf
            @method("PUT")
            <div class="modal-body">
                <div class="tw:mb-4">

                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Descripcion</label>
                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_eva_control_edit" id="descripcion_eva_control_edit" cols="3" rows="3"></textarea>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Tipo</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_eva_control_edit" id="tipo_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        @foreach($tipos_evas as $tipo_eva)
                            <option value="{{$tipo_eva->id_tipo_eva}}">{{$tipo_eva->des_eva}}</option>
                        @endforeach
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Está documentado?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="documentado_eva_control_edit" id="documentado_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Está formalizado?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="formalizado_eva_control_edit" id="formalizado_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Se aplica?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="aplica_eva_control_edit" id="aplica_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">¿Es efectivo?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="efectivo_eva_control_edit" id="efectivo_eva_control_edit">
                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar</button>
            </div>
            </form>
        </div>
    </div>
</div>

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