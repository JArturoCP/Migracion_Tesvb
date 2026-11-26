<input type="hidden" id="id_periodo_serv" name="id_periodo_serv" value="{{ $registro->id_periodo_serv }}">
<p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
    ¿Confirmas el cierre del periodo de {{ $registro->mes == 1 ? 'enero' : 'julio' }} de {{ $registro->year }}? Las encuestas sin contestar se marcarán como rechazadas.
</p>
