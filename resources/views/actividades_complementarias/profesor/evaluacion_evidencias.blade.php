<x-panel.modal id="modal_evaluacion" titulo="Evaluación de actividad" tamano="lg" sin-relleno aria-label="Evaluación de actividad">
    <form id="evaluacion_evidencia" data-url="{{ url('/insercion_datos') }}">
        <div class="tw-modal-cuerpo tw:space-y-4">
            <p class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Alumno(a) {{ session('nombres') }}</p>

            <x-panel.tabla class="tabla-grande2">
                <thead>
                    <tr>
                        <th>Evidencia</th>
                        <th>Evaluación</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(collect($evalua_evidencia)->unique('id_evidencia_alumno') as $evidencia)
                        <tr>
                            <td>
                                <a href="{{ url('/ArchivosAlumnos', $evidencia->archivo) }}" target="_blank" rel="noopener"
                                   class="tw:text-brand-600 tw:hover:underline tw:dark:text-brand-400">
                                    <span class="fa fa-file-text" aria-hidden="true"></span> {{ $evidencia->archivo }}
                                </a>
                            </td>
                            <td>
                                <x-panel.select id="evaluacion_{{ $evidencia->id_evidencia_alumno }}" required
                                                aria-label="Evaluación de {{ $evidencia->archivo }}"
                                                data-evidencia="{{ $evidencia->id_evidencia_alumno }}" data-cuenta="{{ $evidencia->cuenta }}">
                                    <option value="" disabled selected>Selecciona opción</option>
                                    <option value="100">Excelente</option>
                                    <option value="90">Muy bien</option>
                                    <option value="80">Bien</option>
                                    <option value="70">Regular</option>
                                    <option value="0">No aprobado</option>
                                </x-panel.select>
                            </td>
                            <td><output for="evaluacion_{{ $evidencia->id_evidencia_alumno }}">—</output></td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay evidencias para evaluar.</td></tr>
                    @endforelse
                </tbody>
            </x-panel.tabla>

            <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-400">Una vez evaluada la actividad, ya no podrás volver a ver la evidencia.</p>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" :disabled="empty($evalua_evidencia)">Guardar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<script>
    $(function () {
        const formulario = document.getElementById('evaluacion_evidencia');
        const selectores = Array.from(formulario.querySelectorAll('[data-evidencia]'));

        for (const selector of selectores) {
            selector.addEventListener('change', () => {
                selector.closest('tr').querySelector('output').value = selector.value;
            });
        }

        formulario.addEventListener('submit', (evento) => {
            evento.preventDefault();
            if (!selectores.length) return;

            const calificaciones = selectores.map(selector => selector.value);
            const evidencias = selectores.map(selector => selector.dataset.evidencia);
            const cuentas = selectores.map(selector => selector.dataset.cuenta);
            const datos = [...calificaciones, ...evidencias, ...cuentas].map(encodeURIComponent);
            window.location.href = formulario.dataset.url + '/' + datos.join(',');
        });

        $('#modal_evaluacion').modal('show');
    });
</script>
