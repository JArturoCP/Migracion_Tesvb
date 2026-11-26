<form  id="form_guardar_mod_contrato" action="{{url("/presupuesto_autorizado/guardar_contrato/".$documentos->id_solicitud_documento)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Selecciona tipo de contrato</label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_tipo_contrato" name="id_tipo_contrato" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($tipos_contratos as $contrato)
                        @if($documentos->id_tipo_contrato == $contrato->id_tipo_contrato)
                            <option value="{{$contrato->id_tipo_contrato}}" selected="selected" >{{ $contrato->tipo_contrato }}</option>
                        @else
                            <option value="{{$contrato->id_tipo_contrato}}" >{{ $contrato->tipo_contrato }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <x-panel.alerta tipo="exito" class="tw:mb-4"><label>Seleccionar  contrato</label>
                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="doc_contrato" name="doc_contrato" type="file"   accept="application/pdf" required/></x-panel.alerta>
</form>
