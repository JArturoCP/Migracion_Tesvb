{{-- Modal para editar pregunta: lo incluye examenes/preguntas cuando $ver == 'pregunta'. --}}
<x-panel.modal id="modal_editar_pregunta" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modal_editar_pregunta_titulo">
    <form data-panel-envio action="{{ route('admin.pregunta.update', $pregunta->id_pregunta) }}" method="POST">
        @csrf
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
            <h4 id="modal_editar_pregunta_titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                <span class="fa fa-pencil-square-o tw:text-brand-500" aria-hidden="true"></span> Editar pregunta
            </h4>
        </div>
        <div class="tw-modal-cuerpo tw:space-y-5">
            <input type="hidden" name="id_examen_egel" value="{{ $pregunta->id_examen_egel }}">

            <x-panel.textarea etiqueta="Pregunta" name="pregunta" id="pregunta" rows="4" class="tw:resize-none" data-panel-etiqueta="el texto de la pregunta" required
                placeholder="Escribe la pregunta aquí">{{ $pregunta->pregunta }}</x-panel.textarea>

            <div class="tw:grid tw:gap-5 tw:sm:grid-cols-2">
                <x-panel.select etiqueta="Módulo" name="id_modulo" id="id_modulo" data-panel-etiqueta="el módulo" required>
                    @foreach($modulos_pregunta as $m)
                        <option value="{{ $m->id_modulo }}" {{ $m->id_modulo == $pregunta->id_modulo ? 'selected' : '' }}>{{ $m->nombre }}</option>
                    @endforeach
                </x-panel.select>

                <x-panel.input etiqueta="Número" type="number" name="numero_pregunta" id="numero_pregunta" data-panel-etiqueta="el número de pregunta" min="1" required
                    value="{{ $pregunta->numero_pregunta }}" />
            </div>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">
                <span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar
            </x-panel.boton>
            <x-panel.boton type="submit" variante="exito">
                <span class="fa fa-floppy-o" aria-hidden="true"></span> Actualizar pregunta
            </x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<script>
    $(document).ready(function () {
        $("#modal_editar_pregunta").modal("show");
    });
</script>
