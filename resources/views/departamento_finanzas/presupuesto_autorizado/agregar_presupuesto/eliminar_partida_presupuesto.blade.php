<form id="form_eliminar_partida" class="" action="{{url("/presupuesto_autorizado/guardar_eliminar_presupesto_partida/".$partida_reg->id_presupuesto_aut)}}" role="form" method="POST" >
    {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">{{ $partida_reg->clave_presupuestal }} {{ $partida_reg->nombre_partida }}</h3>
        <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">¿Quieres eliminar la partida seleccionada?</h3>
    </div>
</div>
</form>