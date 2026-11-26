{{-- Fragmento AJAX (GET /ingles/modificar_per/{unidad}/{nivel}/{grupo}) dentro de #modal_modificar_per de
     periodos_calificaciones. Mismos campos y valores (fecha_periodo, id_nivel, id_unidad, id_grupo, fecha_anterior). --}}
<div>
    <div class="tw:flex tw:flex-col tw:gap-1.5">
        <label for="fecha_periodo" class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400">Seleccionar fecha de evaluación</label>
        <?php  $fecha=date("d/m/Y ",strtotime($periodo_calificacion[0]->fecha)) ?>
        <input class="tw:h-11 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-white/90"  type="text"  id="fecha_periodo" name="fecha_periodo" data-flatpickr-date="d/m/Y" data-flatpickr-min-days="0"  placeholder="dd/MM/YYYY" value="{{$fecha}}" required>
        <input type="hidden"  id="id_nivel" name="id_nivel"  value="{{ $periodo_calificacion[0]->id_nivel }}">
        <input type="hidden"  id="id_unidad" name="id_unidad"  value="{{ $periodo_calificacion[0]->id_unidad}}">
        <input type="hidden"  id="id_grupo" name="id_grupo"  value="{{ $periodo_calificacion[0]->id_grupo }}">
        <input type="hidden"  id="fecha_anterior" name="fecha_anterior"  value="{{ $periodo_calificacion[0]->fecha }}">
    </div>
</div>
