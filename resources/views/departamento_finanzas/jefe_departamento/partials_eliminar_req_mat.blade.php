<form id="form_eliminar_requisicion" class="" action="{{url("/presupuesto_anteproyecto/guardar_eliminacion_requisicion_materiales/".$requisicion->id_actividades_req_ante)}}" role="form" method="POST" >
{{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PARTIDA PRESUPUESTAL: {{ $requisicion->clave_presupuestal }}  {{ $requisicion->nombre_partida }}</h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">MES : {{ $requisicion->mes }}</h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PROYECTO: {{ $requisicion->nombre_proyecto }}</h4>
            <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">META: {{ $requisicion->meta }}</h5>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="error" class="tw:mb-4">
                <strong class="tw:text-center">Seguro(a) que quieres eliminar la requisición  de materiales</strong>
            </x-panel.alerta>
        </div>
    </div>
</form>