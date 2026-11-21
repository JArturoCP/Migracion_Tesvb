<x-panel.modal id="editar_escuela_cct" titulo="Modificar escuela de procedencia" tamano="xl" sin-relleno aria-label="Modificar escuela de procedencia"
    class="tw:[&_.tw-modal-caja]:motion-safe:animate-in tw:[&_.tw-modal-caja]:motion-safe:fade-in-0 tw:[&_.tw-modal-caja]:motion-safe:zoom-in-95 tw:[&_.tw-modal-caja]:motion-safe:duration-200">
    <form id="form_escuela_cct_modal" method="POST" action="{{ url('/datos_alumnos/guardar_mod_cct/'.$datos->id_alumno) }}">
        @csrf
        <input type="hidden" name="id_escuela" id="seleccion_escuela_cct">
        <div class="tw-modal-cuerpo tw:max-h-[64dvh] tw:space-y-4 tw:overflow-y-auto">
            <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                <div class="tw:min-w-0 tw:rounded-lg tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-3 tw:dark:border-gray-700 tw:dark:bg-white/5">
                    <p id="etiqueta_escuela_cct" class="tw:text-xs tw:font-medium tw:text-gray-600 tw:dark:text-gray-300">Plantel actual</p>
                    <p id="resumen_escuela_cct" class="tw:mt-1 tw:wrap-break-word tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:text-white" aria-live="polite"></p>
                </div>
                <x-panel.input id="buscar_escuela_cct" type="search" etiqueta="Buscar escuela" placeholder="CCT, nombre o municipio"
                    autocomplete="off" aria-controls="catalogo_escuela_cct" disabled />
            </div>
            <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-3">
                <p id="estado_escuela_cct" role="status" class="tw:empty:hidden tw:text-sm tw:text-gray-600 tw:dark:text-gray-300"></p>
                <div id="reintento_escuela_cct" hidden>
                    <x-panel.boton variante="secundario" tamano="sm" id="recargar_escuela_cct">Reintentar</x-panel.boton>
                </div>
            </div>
            <div id="resultados_escuela_cct" hidden>
                <x-panel.tabla id="catalogo_escuela_cct" compacta>
                    <caption class="tw:sr-only">Escuelas que coinciden con la búsqueda</caption>
                    <thead><tr><th scope="col" class="tw:w-12"><span class="tw:sr-only">Seleccionar</span></th><th scope="col">Escuela y ubicación</th></tr></thead>
                    <tbody></tbody>
                </x-panel.tabla>
            </div>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="guardar_escuela_cct" type="submit" disabled>Guardar escuela</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

@push('scripts')
<script>
$(function () {
    const modal = $('#editar_escuela_cct');
    const form = $('#form_escuela_cct_modal');
    const seleccion = $('#seleccion_escuela_cct');
    const boton = $('#guardar_escuela_cct');
    const estado = $('#estado_escuela_cct');
    const buscador = $('#buscar_escuela_cct');
    const resultados = $('#resultados_escuela_cct');
    const reintento = $('#reintento_escuela_cct');
    let carga;
    let tabla;
    let escuelas = new Map();
    let escuelaActual;
    let guardando = false;

    function presentarSeleccion() {
        const escuela = escuelas.get(seleccion.val());
        $('#etiqueta_escuela_cct').text(seleccion.val() === escuelaActual ? 'Plantel actual' : 'Plantel seleccionado');
        $('#resumen_escuela_cct').text(escuela
            ? [escuela.cct, escuela.nombre_escuela].filter(Boolean).join(' · ')
            : 'Selecciona un plantel de la lista.');
        boton.prop('disabled', !escuela || guardando);
    }

    function cargarEscuelas() {
        boton.prop('disabled', true);
        buscador.prop('disabled', true).val('');
        seleccion.val('');
        escuelaActual = '';
        escuelas = new Map();
        presentarSeleccion();
        reintento.prop('hidden', true);
        resultados.prop('hidden', true);
        estado.text('Cargando escuelas…');
        carga = $.getJSON(@json(url('/datos_alumnos/modificar_cct/'.$datos->id_alumno)))
            .done(function (data) {
                escuelaActual = String(data.seleccion ?? '');
                escuelas = new Map(data.escuelas.map(escuela => [String(escuela.id_institucion), escuela]));
                seleccion.val(escuelaActual);
                presentarSeleccion();
                resultados.prop('hidden', false);
                buscador.prop('disabled', false);

                if (!tabla) {
                    tabla = $('#catalogo_escuela_cct').DataTable({
                        dom: 'tip',
                        pageLength: 6,
                        columns: [{
                            data: null, render: () => '', orderable: false, searchable: false,
                            createdCell: function (celda, _, escuela) {
                                const radio = document.createElement('input');
                                radio.id = 'escuela-cct-' + escuela.id_institucion;
                                radio.type = 'radio';
                                radio.name = 'opcion_escuela_cct';
                                radio.value = escuela.id_institucion;
                                radio.className = 'tw:size-5 tw:accent-brand-500';
                                celda.appendChild(radio);
                            },
                        }, {
                            data: null,
                            render: function (escuela, tipo) {
                                if (tipo === 'display') { return ''; }
                                if (tipo === 'filter') {
                                    return [escuela.cct, escuela.nombre_escuela, escuela.municipio, escuela.localidad, escuela.turno].filter(Boolean).join(' ');
                                }
                                return escuela.cct || '';
                            },
                            createdCell: function (celda, _, escuela) {
                                const etiqueta = document.createElement('label');
                                etiqueta.htmlFor = 'escuela-cct-' + escuela.id_institucion;
                                etiqueta.className = 'tw:block tw:cursor-pointer tw:wrap-break-word tw:py-1';
                                const nombre = document.createElement('span');
                                nombre.className = 'tw:block tw:font-semibold tw:text-gray-900 tw:dark:text-white';
                                nombre.textContent = escuela.nombre_escuela;
                                const detalle = document.createElement('span');
                                detalle.className = 'tw:mt-1 tw:block tw:text-xs tw:text-gray-600 tw:dark:text-gray-300';
                                detalle.textContent = [escuela.cct, escuela.municipio, escuela.turno].filter(Boolean).join(' · ');
                                etiqueta.append(nombre, detalle);
                                celda.appendChild(etiqueta);
                            },
                        }],
                        order: [[1, 'asc']],
                        drawCallback: function () {
                            this.api().rows({page: 'current'}).nodes().to$().find('input[type="radio"]').each(function () {
                                this.checked = this.value === seleccion.val();
                            });
                        }
                    });
                }

                tabla.clear().search('').rows.add(data.escuelas).draw();
                estado.empty();
                buscador.trigger('focus');
            }).fail(function (xhr, motivo) {
                if (motivo === 'abort') { return; }
                estado.text('No se pudo cargar el catálogo.');
                reintento.prop('hidden', false);
                PanelFormularios.fallo(form[0], xhr, estado.text());
            });
    }

    modal.on('shown.bs.modal', function () {
        if (!this.hidden) { cargarEscuelas(); }
    }).on('hide.bs.modal', function (event) {
        if (guardando) { event.preventDefault(); }
        else if (carga) { carga.abort(); }
    }).on('hidden.bs.modal', function () {
        $('#abrir_escuela_cct').trigger('focus');
    });

    buscador.on('input', function () {
        if (tabla) { tabla.search(this.value).draw(); }
    }).on('keydown', function (event) {
        if (event.key === 'Enter') { event.preventDefault(); }
    });
    $('#recargar_escuela_cct').on('click', cargarEscuelas);

    form.on('change', 'input[name="opcion_escuela_cct"]', function () {
        seleccion.val(this.value);
        presentarSeleccion();
    }).on('submit', function (event) {
        event.preventDefault();
        if (boton.prop('disabled') || !seleccion.val()) { return; }
        guardando = true;
        boton.prop('disabled', true).text('Guardando…');
        form.attr('aria-busy', 'true');
        estado.text('Guardando escuela…');
        $.ajax({
            url: this.action, method: 'POST', dataType: 'json',
            data: { _token: form.find('[name="_token"]').val(), id_escuela: seleccion.val() }
        }).done(function (escuela) {
            $('[data-escuela-campo]').each(function () {
                $(this).text(escuela[this.dataset.escuelaCampo] ?? '');
            });
            $('#resultado_escuela_cct').text('Escuela de procedencia actualizada.');
            guardando = false;
            modal.modal('hide');
            PanelFormularios.alerta('success', 'Escuela guardada', 'La escuela de procedencia se actualizó.');
        }).fail(function (xhr) {
            estado.text('No se pudo guardar la escuela.');
            PanelFormularios.fallo(form[0], xhr, estado.text());
        }).always(function () {
            guardando = false;
            form.removeAttr('aria-busy');
            boton.text('Guardar escuela');
            presentarSeleccion();
        });
    });
});
</script>
@endpush
