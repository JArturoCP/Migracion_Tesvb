<x-panel.modal id="confirmar-autorizacion-documentacion" titulo="Autorizar documentación" aria-label="Autorizar documentación" estatico>
    <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
        Confirma la autorización de los requisitos de titulación para notificar al estudiante.
    </p>

    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal" v-bind:disabled="guarda_envio_correccion">Cancelar</x-panel.boton>
        <x-panel.boton v-on:click="Enviar_aceptacion" v-bind:disabled="guarda_envio_correccion">Autorizar y notificar</x-panel.boton>
    </x-slot:pie>
</x-panel.modal>
