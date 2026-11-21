@extends('layouts.panel')
@section('title', 'Docentes en Plantilla')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')

@section('content')
<x-panel.encabezado titulo="Docentes en plantilla" />
<div class="tw:grid tw:gap-5 tw:xl:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
    <x-panel.tarjeta titulo="Profesores disponibles">
        <x-panel.tabla id="paginar_table">
            <thead><tr><th>Clave</th><th>Nombre</th><th>Perfil</th><th>Fecha de recontrato</th><th>A plantilla</th></tr></thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->clave }}</td>
                        <td>{{ $docente->nombre }}</td>
                        <td>{{ $docente->descripcion }}</td>
                        <td>{{ $docente->fch_recontratacion }}</td>
                        <td><x-panel.boton tamano="sm" variante="contorno-primario" data-toggle="modal" data-target="#modal_agrega"
                            :data-docente="$docente->id_personal" :data-nombre="$docente->nombre">Agregar</x-panel.boton></td>
                    </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

    <x-panel.tarjeta titulo="Profesores en plantilla">
        <x-panel.tabla>
            <thead><tr><th>Nombre</th><th>Materias y perfil</th><th>Quitar</th></tr></thead>
            <tbody>
                @forelse ($plantillas as $plantilla)
                    <tr>
                        <td>{{ $plantilla->nombre }}</td>
                        <td><x-panel.boton tamano="sm" variante="contorno-primario" data-toggle="modal" data-target="#modal_materias"
                            :data-docente="$plantilla->id_personal">Materias</x-panel.boton></td>
                        <td><x-panel.boton tamano="sm" variante="contorno-peligro" data-toggle="modal" data-target="#modal_elimina"
                            :data-docente="$plantilla->id_personal" :data-nombre="$plantilla->nombre">Quitar</x-panel.boton></td>
                    </tr>
                @empty
                    <tr><td colspan="3">Aún no hay docentes en la plantilla.</td></tr>
                @endforelse
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>
</div>

<x-panel.modal id="modal_agrega" titulo="Agregar docente a la plantilla" tamano="sm" sin-relleno aria-label="Agregar docente a la plantilla">
    <form data-panel-guardar id="form_docente_crea" method="POST" action="{{ url('/plantilla/docentes') }}">
        @csrf
        <input type="hidden" id="docente" name="docente">
        <div class="tw-modal-cuerpo">¿Agregar a <strong data-nombre-plantilla></strong> a la plantilla?</div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="confirma_agrega" type="submit">Agregar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="modal_elimina" titulo="Quitar docente de la plantilla" tamano="sm" sin-relleno aria-label="Quitar docente de la plantilla">
    <form data-panel-guardar id="form_delete" method="POST">
        @csrf
        @method('DELETE')
        <div class="tw-modal-cuerpo">¿Quitar a <strong data-nombre-plantilla></strong> de la plantilla?</div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="confirma_elimina" type="submit" variante="peligro">Quitar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="modal_materias" titulo="Materias del docente" tamano="xl" sin-relleno aria-label="Materias del docente">
    <form id="form_ver_materias" method="POST" action="{{ url('/agrega/materias_perfil') }}">
        @csrf
        <input type="hidden" id="prof" name="prof">
        <input type="hidden" id="materias" name="materias">
        <div class="tw-modal-cuerpo tw:max-h-[60dvh] tw:overflow-y-auto">
            <div id="estado_materias_plantilla" role="status" class="tw:mb-3 tw:text-sm"></div>
            <div id="contenedor_materias"></div>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
            <x-panel.boton type="submit" id="guardar_materias_plantilla" disabled>Guardar materias</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>
@endsection

@push('scripts')
<script>
$(function () {
    $('#paginar_table').DataTable();
    const formMaterias = $('#form_ver_materias');
    const botonMaterias = $('#guardar_materias_plantilla');
    const estadoMaterias = $('#estado_materias_plantilla');
    let cargaMaterias;

    $('#modal_agrega, #modal_elimina').on('show.bs.modal', function (event) {
        const { docente, nombre } = event.relatedTarget.dataset;
        $(this).find('[data-nombre-plantilla]').text(nombre);
        if (this.id === 'modal_agrega') {
            $('#docente').val(docente);
        } else {
            $('#form_delete').attr('action', @json(url('/plantilla/docentes')) + '/' + docente);
        }
    });

    $('#modal_materias').on('show.bs.modal', function (event) {
        const docente = event.relatedTarget.dataset.docente;
        $('#prof').val(docente);
        botonMaterias.prop('disabled', true);
        $('#contenedor_materias').empty();
        estadoMaterias.text('Cargando materias…');
        cargaMaterias = $.get(@json(url('/docentes/materias')) + '/' + docente)
            .done(function (html) {
                $('#contenedor_materias').html(html);
                botonMaterias.prop('disabled', false);
                estadoMaterias.empty();
            })
            .fail(function (xhr, estado) {
                if (estado !== 'abort') {
                    estadoMaterias.text('No se pudieron cargar las materias. Cierra y vuelve a abrir el formulario.');
                    PanelFormularios.fallo(formMaterias[0], xhr, estadoMaterias.text());
                }
            });
    }).on('hide.bs.modal', function (event) {
        if (formMaterias.attr('aria-busy') === 'true') {
            event.preventDefault();
        } else if (cargaMaterias) {
            cargaMaterias.abort();
        }
    });

    formMaterias.on('submit', function (event) {
        event.preventDefault();
        if (botonMaterias.prop('disabled')) { return; }
        const materias = formMaterias.find('input[name="materia[]"]:checked').map(function () { return this.value; }).get();
        if (!materias.length) {
            estadoMaterias.text('Selecciona al menos una materia.');
            PanelFormularios.errores(this, {'materia[]': estadoMaterias.text()});
            return;
        }
        $('#materias').val(materias.join(','));
        estadoMaterias.empty();
        PanelFormularios.enviar(this, botonMaterias[0]);
    });
});
</script>
@endpush
