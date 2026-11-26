<form id="form_desactivar_proyecto" class="" action="{{url("/presupuesto_anteproyecto/guardar_desactivacion_proyecto/".$proyecto->id_proyecto)}}" role="form" method="POST" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">NOMBRE DEL PROYECTO:{{ $proyecto->nombre_proyecto }}</h4>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Desea desactivar el proyecto</h2>
        </div>
    </div>
</form>