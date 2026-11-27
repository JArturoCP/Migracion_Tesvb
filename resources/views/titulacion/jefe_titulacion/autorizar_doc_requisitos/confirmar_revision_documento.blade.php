<x-panel.modal id="confirmar-revision-documento" titulo="Confirmar revisión" aria-label="Confirmar revisión" estatico>
    <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">Confirma que deseas guardar la revisión.</p>
    <p class="tw:mt-2 tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:text-white" v-text="tituloDocumentoRevision"></p>

    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal" v-bind:disabled="estadoguardar">Cancelar</x-panel.boton>
        <x-panel.boton v-on:click="guardarRevision" v-bind:disabled="estadoguardar">Guardar revisión</x-panel.boton>
    </x-slot:pie>
</x-panel.modal>
