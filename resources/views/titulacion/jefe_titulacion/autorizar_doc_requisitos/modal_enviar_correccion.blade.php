<x-panel.modal id="confirmar-envio-correcciones" titulo="Enviar correcciones" aria-label="Enviar correcciones" estatico>
    <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
        Confirma el envío de las correcciones de los documentos revisados.
    </p>

    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal" v-bind:disabled="guarda_envio_correccion">Cancelar</x-panel.boton>
        <x-panel.boton v-on:click="Enviar_correcciones" v-bind:disabled="guarda_envio_correccion">Enviar correcciones</x-panel.boton>
    </x-slot:pie>
</x-panel.modal>
