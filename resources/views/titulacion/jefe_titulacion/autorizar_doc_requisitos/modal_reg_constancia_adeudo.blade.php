<x-panel.modal id="registrar-constancia-adeudo" aria-labelledby="titulo-constancia-adeudo" estatico>
    <x-slot:encabezado>
        <h4 id="titulo-constancia-adeudo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
            @{{ titulo_cons_adeudo }}
        </h4>
    </x-slot:encabezado>

    <x-panel.input type="file" id="file" name="file" etiqueta="Constancia de no adeudo (PDF)"
        accept="application/pdf" v-on:change="variable_doc_1" required />

    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal" v-bind:disabled="estado_guardar_cons_adeudo">Cancelar</x-panel.boton>
        <x-panel.boton v-on:click="guardar_doc_cons_adeudo" v-bind:disabled="estado_guardar_cons_adeudo">Guardar</x-panel.boton>
    </x-slot:pie>
</x-panel.modal>
