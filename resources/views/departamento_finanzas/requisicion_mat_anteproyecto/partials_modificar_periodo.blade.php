<form id="form_modificar_periodo" class="" action="{{url("/presupuesto_anteproyecto/guardar_modificacion_periodos_anteproyecto/".$periodo->id_peri_anteproyecto)}}" role="form" method="POST" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Seleccionar fecha inicial del periodo</label>
                <input class="datepicker fecha_inicio_mod tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="fecha_inicial_mod" name="fecha_inicial_mod" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"  value="{{ $fecha_i }}" >
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Seleccionar fecha final del periodo</label>
                <input class="datepicker fecha_final_mod tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="fecha_final_mod" name="fecha_final_mod" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ $fecha_f }}">

            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Año actual</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="year_actual_mod" name="year_actual_mod" readonly value="{{ $periodo->year }}" >

            </div>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(document).ready( function() {
        $( '.fecha_inicio_mod').datepicker({
            pickTime: false,
            autoclose: true,
            language: 'es',
            startDate: '+0d',

        });
        $( '.fecha_final_mod' ).datepicker({
            pickTime: false,
            autoclose: true,
            language: 'es',
            startDate: '+0d',
        });
    });
</script>