<form  id="form_guardar_activar_periodo" action="{{url("/servicios_escolares/guardar_activar_periodo/".$periodo->id_periodos_sem_act)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PERIODO: {{ $periodo->periodo }}</h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Seguro(a) que quieres activar el periodo?</h4>
        </div>

    </div>
</form>