<form id="form_mod_bien" class="" action="{{url("/presupuesto_anteproyecto/guardar_eliminar_bien/".$servicio->id_reg_material_ant)}}" role="form" method="POST" >
    {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Descripcion del servicio o bien: <b>{{ $servicio->descripcion }}</b></h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Unidad de medida: <b>{{ $servicio->unidad_medida }}</b></h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Cantidad: <b>{{ $servicio->cantidad }}</b></h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Precio unitario de referencia con IVA incluido: <b>{{ $servicio->precio_unitario }}</b></h4>
    </div>
</div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="error" class="tw:mb-4">
                <strong class="tw:text-center">Seguro(a) que quieres eliminar el bien o servicio</strong>
            </x-panel.alerta>
        </div>
    </div>
</form>