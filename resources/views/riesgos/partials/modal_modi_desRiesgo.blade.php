@section('modal_modiriesgo')
    <div class="modal fade tw-modal-compat" id="modal_modi_descRiesgo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Descripción del riesgp</h5>
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_modi_descRiesgo" class="" role="form" method="POST" action="{{url('riesgos/registroriesgos')."/".$datos_registro_riesgo[0]->id_reg_riesgo}}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="tw:mb-4">
                            <label for="descripcion_efecto" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Descripción del riesgo</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion_riesgo" id="descripcion_riesgo" cols="3" rows="3"> {{$datos_registro_riesgo[0]->descip_riesgo}}</textarea>
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
            $("#form_modi_descRiesgo").validate({
                rules: {
                    descripcion_riesgo: {
                        required: true,
                    },
                },
            });
        });
    </script>
@endsection