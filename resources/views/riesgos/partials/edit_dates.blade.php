@section('cont_modals_edit_dates')
    <div class="modal fade tw-modal-compat" id="modal_edit_date_accion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
        <div class="modal-dialog tw:mt-2" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar fecha</h5>
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_date_riesgo" class="" role="form" method="POST" action=""/>
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="tw:mb-4">
                        <input type="hidden" id="id_date_riesgo" value="">
                        <label for="fecha_final_edit_ri" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Fecha Final</label>
                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final_edit_ri" name="fecha_final_edit_ri" data-flatpickr-date data-flatpickr-min-days="1" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="update_date_riesgo">Aceptar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection