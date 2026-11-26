<input type="hidden" id="id_periodo_mantenimiento" name="id_periodo_mantenimiento" value="{{ $periodo->id_periodo_mantenimiento }}">
<p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
    ¿Confirmas el cierre del periodo de {{ $periodo->mes == 1 ? 'enero' : 'julio' }} de {{ $periodo->year }}?
</p>
