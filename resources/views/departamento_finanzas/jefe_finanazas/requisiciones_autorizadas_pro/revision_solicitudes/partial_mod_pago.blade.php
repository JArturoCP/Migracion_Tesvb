<form  id="form_guardar_mod_pago" action="{{url("/presupuesto_autorizado/guardar_pago/".$documentos->id_solicitud_documento)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}


    <x-panel.alerta tipo="exito" class="tw:mb-4"><label>Selecciona documento pdf del pago</label>
                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="doc_pago" name="doc_pago" type="file"   accept="application/pdf" required/></x-panel.alerta>
</form>