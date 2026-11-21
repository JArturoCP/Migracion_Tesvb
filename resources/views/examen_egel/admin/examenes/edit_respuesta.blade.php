{{-- Modal para editar respuesta: lo incluye examenes/preguntas cuando $ver == 'respuesta'. --}}
<x-panel.modal id="modal_editar_respuesta" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modal_editar_respuesta_titulo">
    <form data-panel-envio action="{{ route('admin.respuesta.update', $respuesta->id_respuesta) }}" method="POST">
        @csrf
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
            <h4 id="modal_editar_respuesta_titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                <span class="fa fa-pencil-square-o tw:text-brand-500" aria-hidden="true"></span> Editar respuesta de la pregunta {{ $respuesta->numero_pregunta }}
            </h4>
        </div>
        <div class="tw-modal-cuerpo">
            <input type="hidden" name="id_examen_egel" value="{{ $respuesta->id_examen_egel }}">

            <div class="tw:grid tw:gap-5 tw:sm:grid-cols-[1fr_200px]">
                <x-panel.input etiqueta="Respuesta" type="text" name="respuesta" id="respuesta" data-panel-etiqueta="el texto de la respuesta" required
                    value="{{ $respuesta->respuesta }}" placeholder="Escribe la respuesta aquí" />

                <x-panel.select etiqueta="¿Es correcta?" name="es_correcta" id="es_correcta" data-panel-etiqueta="si la respuesta es correcta" required>
                    <option value="1" {{ $respuesta->es_correcta == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $respuesta->es_correcta == 0 ? 'selected' : '' }}>No</option>
                </x-panel.select>
            </div>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">
                <span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar
            </x-panel.boton>
            <x-panel.boton type="submit" variante="exito">
                <span class="fa fa-floppy-o" aria-hidden="true"></span> Actualizar respuesta
            </x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<script>
    $(document).ready(function () {
        $("#modal_editar_respuesta").modal("show");
    });
</script>
