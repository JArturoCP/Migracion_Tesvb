{{-- Fragmento AJAX (GET /ingles/registro_periodo_ingles/{unidad}/{nivel}/{grupo}) dentro de #modal_registro de
     periodos_calificaciones. Mismos campos (fecha_periodo, id_nivel, id_unidad, id_grupo) y mismo datepicker. --}}
<div>
    <div class="tw:flex tw:flex-col tw:gap-1.5">
        <label for="fecha_periodo" class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400">Seleccionar fecha de evaluación</label>

        <input class="datepicker tw:h-11 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-white/90"  type="text"  id="fecha_periodo" name="fecha_periodo"  placeholder="dd/MM/YYYY" required>
        <input type="hidden"  id="id_nivel" name="id_nivel"  value="{{ $id_nivel }}">
        <input type="hidden"  id="id_unidad" name="id_unidad"  value="{{ $id_unidad}}">
        <input type="hidden"  id="id_grupo" name="id_grupo"  value="{{ $id_grupo }}">
    </div>
</div>
<script type="text/javascript">
$(document).ready( function() {
$('#fecha_periodo').datepicker({
pickTime: false,
autoclose: true,
language: 'es',
startDate: '+0d',
});
});
</script>
