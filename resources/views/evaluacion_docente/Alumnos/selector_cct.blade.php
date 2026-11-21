<x-panel.encabezado :titulo="$titulo" />
<x-panel.tarjeta titulo="Escuelas de procedencia" subtitulo="Busca por nombre o por Clave de Centro de Trabajo (CCT).">
    <form id="form_cct" method="POST" action="{{ $urlGuardado }}" class="tw:space-y-4">
        @csrf
        <input type="hidden" name="id_escuela" id="id_escuela" value="{{ old('id_escuela', $institucionActual) }}">
        @error('id_escuela')
            <x-panel.alerta tipo="error">{{ $message }}</x-panel.alerta>
        @enderror
        <x-panel.tabla id="registro_cct">
            <thead><tr><th>Seleccionar</th><th>CCT</th><th>Escuela</th><th>Domicilio</th><th>Municipio</th><th>Localidad</th><th>Turno</th><th>Servicio</th></tr></thead>
            <tbody>
                @foreach ($escuelas as $escuela)
                    <tr>
                        <td><input type="radio" name="opcion_cct" class="tw:size-4 tw:accent-brand-500" value="{{ $escuela->id_institucion }}"
                            aria-label="{{ $escuela->cct }} {{ $escuela->nombre_escuela }}" @checked(old('id_escuela', $institucionActual) == $escuela->id_institucion)></td>
                        <td>{{ $escuela->cct }}</td>
                        <td>{{ $escuela->nombre_escuela }}</td>
                        <td>{{ $escuela->domicilio }}</td>
                        <td>{{ $escuela->municipio }}</td>
                        <td>{{ $escuela->localidad }}</td>
                        <td>{{ $escuela->turno }}</td>
                        <td>{{ $escuela->servicio }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
        <div class="tw:flex tw:justify-end tw:gap-3">
            @if ($institucionActual)
                <x-panel.boton variante="secundario" :href="url('/datos_alumno')">Cancelar</x-panel.boton>
            @endif
            <x-panel.boton type="submit" id="enviar" :disabled="!old('id_escuela', $institucionActual)">Guardar escuela</x-panel.boton>
        </div>
    </form>
</x-panel.tarjeta>

@push('scripts')
<script>
$(function () {
    const seleccion = $('#id_escuela');
    $('#registro_cct').DataTable({ columnDefs: [{ targets: 0, orderable: false, searchable: false }], order: [[1, 'asc']] })
        .on('draw.dt', function () {
            $(this).find('input[name="opcion_cct"]').each(function () { this.checked = this.value === seleccion.val(); });
        });
    $('#form_cct').on('change', 'input[name="opcion_cct"]', function () {
        seleccion.val(this.value);
        $('#enviar').prop('disabled', false);
    }).on('submit', function (event) {
        event.preventDefault();
        if (!seleccion.val()) {
            PanelFormularios.errores(this, { opcion_cct: 'Selecciona una escuela de procedencia.' });
            return;
        }
        PanelFormularios.enviar(this, document.getElementById('enviar'));
    });
});
</script>
@endpush
