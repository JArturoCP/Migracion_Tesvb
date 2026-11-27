@section('cont_factores')
<x-panel.modal id="modal_riesgos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Nuevo factor de riesgo</h5>
                
            </div>
            <form id="form_add_factor_riesgo" class="" role="form" method="POST" action="{{url('riesgos/reg_factor')}}"/>
            <div class="tw-modal-cuerpo">
                <div class="tw:mb-4">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_registro_riesgo" id="id_registro_riesgo" value="{{$datos_registro_riesgo[0]->id_reg_riesgo}}">
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Descripcion</label>
                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_factor" id="descripcion_factor" cols="3" rows="3"></textarea>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Clasificación Factor</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="clasi_factor" id="clasi_factor">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                        @foreach($clasificaciones_factor as $clasificacion_factor)
                            <option value="{{$clasificacion_factor->id_cl_f}}">{{$clasificacion_factor->des_cl_f}}</option>
                        @endforeach
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Tipo Factor</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_factor" id="tipo_factor">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                        @foreach($tipos_factor as $tipo_factor)
                            <option value="{{$tipo_factor->id_tipo_f}}">{{$tipo_factor->des_tf}}</option>
                        @endforeach
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Tiene controles?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="have_controls" id="have_controls">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>
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

<x-panel.modal id="modal_edit_factor" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar factor de riesgo</h5>
                
            </div>
            <form id="form_edit_factor_riesgo" class="" role="form" method="POST" action=""/>
            <div class="tw-modal-cuerpo">
                <div class="tw:mb-4">
                    @csrf
                    @method('PUT')
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Descripcion</label>
                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_factor_edit" id="descripcion_factor_edit" cols="3" rows="3"></textarea>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Clasificación Factor</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="clasi_factor_edit" id="clasi_factor_edit">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                        @foreach($clasificaciones_factor as $clasificacion_factor)
                            <option value="{{$clasificacion_factor->id_cl_f}}">{{$clasificacion_factor->des_cl_f}}</option>
                        @endforeach
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Tipo Factor</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_factor_edit" id="tipo_factor_edit">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                        @foreach($tipos_factor as $tipo_factor)
                            <option value="{{$tipo_factor->id_tipo_f}}">{{$tipo_factor->des_tf}}</option>
                        @endforeach
                    </select>
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">¿Tiene controles?</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="have_controls_edit" id="have_controls_edit">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>
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
        $("#form_add_factor_riesgo").validate({
            rules: {
                descripcion_factor: {
                    required: true,
                },
                clasi_factor: {
                    required: true,
                },
                tipo_factor: {
                    required: true,
                },
                have_controls: {
                    required: true,
                },
            },
        });
        $("#form_edit_factor_riesgo").validate({
            rules: {
                descripcion_factor_edit: {
                    required: true,
                },
                clasi_factor_edit: {
                    required: true,
                },
                tipo_factor_edit: {
                    required: true,
                },
                have_controls_edit: {
                    required: true,
                },
            },
        });
    });
</script>
@endsection