{{-- Modal para crear examen: lo incluye examenes/index cuando $ver == 'create'. --}}
<x-panel.modal id="modal_examen_create" sin-relleno clase-cerrar="close" aria-labelledby="modal_examen_create_titulo">
    <form data-panel-envio action="{{ route('admin.examen.store') }}" method="POST">
        @csrf
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
            <h4 id="modal_examen_create_titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                <span class="fa fa-graduation-cap tw:text-brand-500" aria-hidden="true"></span> Nuevo examen
            </h4>
        </div>
        <div class="tw-modal-cuerpo tw:space-y-5">
            <x-panel.select etiqueta="Carrera" name="id_carrera" id="id_carrera" data-panel-etiqueta="la carrera" required>
                @foreach($carreras as $c)
                    <option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
                @endforeach
            </x-panel.select>

            <x-panel.input etiqueta="Nombre del examen" type="text" name="nombre" id="nombre" data-panel-etiqueta="el nombre del examen" maxlength="255" placeholder="Ej. Examen Final Matemáticas" required />
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">
                <span class="fa fa-arrow-left" aria-hidden="true"></span> Cancelar
            </x-panel.boton>
            <x-panel.boton type="submit" variante="exito">
                <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
            </x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<script>
    $(document).ready(function () {
        $("#modal_examen_create").modal("show");
    });
</script>
