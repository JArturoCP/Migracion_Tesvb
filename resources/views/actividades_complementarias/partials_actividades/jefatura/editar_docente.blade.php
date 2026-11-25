<x-panel.modal id="modal_edit_docente" titulo="Modificación de docente" tamano="lg" sin-relleno aria-label="Modificación de docente">
    <form id="modificar_docente" method="POST" action="{{ route('docente_actividad.update', $doce->id_docente_actividad) }}"
          class="tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600">
        @csrf
        @method('PUT')

        <div class="tw-modal-cuerpo tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
            <x-panel.select etiqueta="Actividad" name="actividad_docente" id="editar_actividad_docente" required>
                <option value="" disabled selected hidden>Selecciona opción</option>
                @foreach ($actividades as $actividad)
                    <option value="{{ $actividad->id_actividad_comple }}" @selected($doce->id_actividad_comple == $actividad->id_actividad_comple)>
                        {{ $actividad->descripcion }}
                    </option>
                @endforeach
            </x-panel.select>

            <x-panel.select etiqueta="Docente asignado" name="docente" id="editar_docente_asignado" required>
                <option value="" disabled selected hidden>Selecciona opción</option>
                @foreach ($docentes as $docenteAsignado)
                    <option value="{{ $docenteAsignado->id_personal }}" @selected($doce->id_personal == $docenteAsignado->id_personal)>
                        {{ $docenteAsignado->titulo }} {{ $docenteAsignado->nombre }}
                    </option>
                @endforeach
            </x-panel.select>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit">Guardar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<script>
    $(function () {
        $('#modificar_docente').validate();
        $('#modal_edit_docente').modal('show');
    });
</script>
