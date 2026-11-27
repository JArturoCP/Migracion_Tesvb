<input type="hidden" id="id_periodo_titulacion" name="id_periodo_titulacion" value="{{ $periodo->id_periodo_titulacion }}">

<div class="tw:space-y-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
    <p><strong>Periodo</strong> {{ $periodo->mes == 1 ? 'Enero' : 'Julio' }} de {{ $periodo->year }}</p>
    <p>Las encuestas pendientes de este periodo se marcarán como rechazadas.</p>
</div>
