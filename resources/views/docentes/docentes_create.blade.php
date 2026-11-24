@extends('layouts.panel')
@section('title', 'Alta de docente')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
@php
    $jefeDivision = session()->has('jefe_division');
    $secciones = [
        'Datos personales y de contacto' => [
            ['nombre_docente', 'Nombre completo'],
            ['rfc', 'RFC', 'text', 13],
            ['selectSexo', 'Sexo', 'select'],
            ['o_nac', 'Lugar de nacimiento'],
            ['f_nac', 'Fecha de nacimiento', 'date'],
            ['dir', 'Dirección'],
            ['correo', 'Correo electrónico', 'email'],
            ['telefono', 'Teléfono', 'tel'],
            ['celular', 'Celular', 'tel'],
        ],
        'Formación' => [
            ['selectEsc', 'Escolaridad', 'select'],
            ['esc_p', 'Escuela de procedencia'],
            ['cedula', 'Cédula profesional', 'number'],
        ],
        'Datos laborales' => [
            ['clave_docente', 'Clave docente (ISSEMyM)', 'text', 8],
            ['numero_empleado', 'Número de empleado'],
            ['selectNombra', 'Nombramiento', 'select'],
            ['f_ingreso', 'Fecha de ingreso', 'date'],
            ['f_contrata', 'Fecha de contratación', 'date'],
            ['selectPerfil', 'Perfil', 'select'],
            ['selectSituacion', 'Situación', 'select'],
            ['abrevia', 'Abreviación', 'select'],
        ],
    ];
    $opciones = [
        'selectSexo' => ['F' => 'F', 'M' => 'M'],
        'selectEsc' => ['Tecnico' => 'Técnico', 'Licenciatura' => 'Licenciatura', 'Maestria' => 'Maestría', 'Doctorado' => 'Doctorado', 'Preparatoria' => 'Preparatoria', 'Secundaria' => 'Secundaria'],
        'selectNombra' => ['T' => 'Temporal', 'D' => 'Definitivo'],
        'selectPerfil' => collect($perfiles)->pluck('descripcion', 'id_perfil'),
        'selectSituacion' => collect($situaciones)->pluck('situacion', 'id_situacion'),
        'abrevia' => collect($abreviaciones)->pluck('titulo', 'id_abreviacion'),
    ];
    $catalogos = [
        'selectPerfil' => ['perfil', 'Agregar perfil', 'Nombre del perfil', 'perfiles', 'id_perfil', 'descripcion'],
        'selectSituacion' => ['situacion', 'Agregar situación', 'Nombre de la situación', 'situaciones', 'id_situacion', 'situacion'],
        'abrevia' => ['abreviacion', 'Agregar abreviación', 'Abreviación', 'abreviaciones', 'id_abreviacion', 'titulo'],
    ];
@endphp

<x-panel.encabezado titulo="Alta de docente" />
<x-panel.tarjeta titulo="Agregar personal">
    <form data-panel-guardar data-panel-stepper data-panel-seguimiento="docente" id="form_docente_crea" method="POST"
        data-stepper-errores="{{ json_encode($errors->messages()) }}" action="{{ url('/docentes/create') }}" class="tw:space-y-6">
        @csrf
        <x-panel.stepper id="alta-docente" :pasos="array_keys($secciones)" />
        @foreach ($secciones as $titulo => $campos)
            <fieldset id="alta-docente-paso-{{ $loop->index }}" data-stepper-seccion class="tw:min-w-0 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
                <legend tabindex="-1" class="tw:mb-3 tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</legend>
                <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:lg:grid-cols-3">
                    @foreach ($campos as $campo)
                        @php
                            [$nombre, $etiqueta] = $campo;
                            $tipo = $campo[2] ?? 'text';
                            $id = $nombre === 'abrevia' ? 'selectAbrevia' : $nombre;
                            $valor = old($nombre, ['correo' => $correo, 'selectNombra' => 'T'][$nombre] ?? '');
                            if ($tipo === 'date') {
                                $valor = str_replace('/', '-', (string) $valor);
                            }
                        @endphp
                        @if ($tipo === 'select')
                            <div class="tw:min-w-0">
                                <x-panel.select :id="$id" :name="$nombre" :etiqueta="$etiqueta" class="tw:aria-invalid:border-red-500" required>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($opciones[$nombre] as $clave => $opcion)
                                        <option value="{{ $clave }}" @selected((string) $valor === (string) $clave)>{{ $opcion }}</option>
                                    @endforeach
                                </x-panel.select>
                                @isset($catalogos[$nombre])
                                    <x-panel.boton tamano="sm" variante="contorno-primario" class="tw:mt-2" data-toggle="modal" :data-target="'#m_'.$catalogos[$nombre][0]">
                                        {{ $catalogos[$nombre][1] }}
                                    </x-panel.boton>
                                @endisset
                            </div>
                        @else
                            <x-panel.input :id="$id" :name="$nombre" :etiqueta="$etiqueta" :type="$tipo" :value="$valor"
                                :maxlength="$campo[3] ?? ['nombre_docente' => 60, 'o_nac' => 30, 'dir' => 100, 'correo' => 40, 'telefono' => 20, 'celular' => 20, 'numero_empleado' => 100][$nombre] ?? null" :disabled="$nombre === 'correo' && !$jefeDivision"
                                :min="$nombre === 'f_nac' ? today()->subYears(90)->toDateString() : ($nombre === 'cedula' ? 0 : null)"
                                :max="$nombre === 'f_nac' ? today()->subYears(18)->toDateString() : ($nombre === 'cedula' ? 2147483647 : null)"
                                class="tw:aria-invalid:border-red-500" required />
                        @endif
                    @endforeach
                </div>
            </fieldset>
        @endforeach
        <div class="tw:flex tw:flex-wrap tw:justify-between tw:gap-3">
            <x-panel.stepper-navegacion />
            <x-panel.boton id="guarda_docente" type="submit" class="tw:ms-auto">Agregar docente</x-panel.boton>
        </div>
    </form>
</x-panel.tarjeta>

@foreach ($catalogos as $select => [$id, $titulo, $etiqueta, $recurso, $clave, $texto])
    <x-panel.modal :id="'m_'.$id" :titulo="$titulo" sin-relleno :aria-label="$titulo">
        <form data-panel-validar data-alta-catalogo data-select="{{ $select }}" data-url="{{ url('/docentes/'.$recurso) }}"
            data-recurso="{{ $recurso }}" data-clave="{{ $clave }}" data-texto="{{ $texto }}">
            <div class="tw-modal-cuerpo tw:space-y-4">
                <x-panel.input :id="'alta_'.$id" name="nombre" :etiqueta="$etiqueta" required />
                @if ($id === 'situacion')
                    <x-panel.input :id="'alta_'.$id.'_abre'" name="abreviacion" etiqueta="Abreviación" required />
                @endif
                <p data-error-catalogo role="alert" class="tw:text-sm tw:text-red-600 tw:dark:text-red-400"></p>
            </div>
            <x-panel.modal-pie>
                <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                <x-panel.boton type="submit">Guardar</x-panel.boton>
            </x-panel.modal-pie>
        </form>
    </x-panel.modal>
@endforeach
@endsection

@push('scripts')
<script>
$(function () {
    const alta = document.getElementById('form_docente_crea');
    $('[data-alta-catalogo]').each(function () {
        const formulario = this;
        const select = alta.elements.namedItem(formulario.dataset.select);
        const dialogo = $(formulario).closest('[data-panel-modal]');
        const boton = formulario.querySelector('button[type="submit"]');
        const error = formulario.querySelector('[data-error-catalogo]');
        const inputs = Array.from(formulario.querySelectorAll('input'));
        let disparador;

        dialogo.on('shown.bs.modal', function (event) {
            disparador = event.relatedTarget;
            inputs[0].focus();
        }).on('hide.bs.modal', function (event) {
            if (boton.disabled) { event.preventDefault(); }
        }).on('hidden.bs.modal', function () {
            formulario.reset();
            error.textContent = '';
            disparador?.focus();
        });

        formulario.addEventListener('submit', function (event) {
            event.preventDefault();
            if (boton.disabled || !PanelFormularios.validar(formulario)) { return; }
            const valores = inputs.map(input => input.value.trim());
            const existentes = new Set(Array.from(select.options, opcion => opcion.value));
            error.textContent = '';
            boton.disabled = true;
            $.getJSON(formulario.dataset.url + '/' + valores.map(encodeURIComponent).join('/'))
                .done(function (respuesta) {
                    const opciones = respuesta?.[formulario.dataset.recurso];
                    if (!Array.isArray(opciones)) {
                        error.textContent = 'No se pudo confirmar el guardado.';
                        PanelFormularios.alerta('error', 'Respuesta inesperada', error.textContent);
                        return;
                    }
                    let nuevoId;
                    opciones.forEach(function (opcion) {
                        const id = String(opcion[formulario.dataset.clave]);
                        const titulo = opcion[formulario.dataset.texto];
                        if (!existentes.has(id)) {
                            select.add(new Option(titulo, id));
                            if (titulo === valores[0] && (!nuevoId || Number(id) > Number(nuevoId))) {
                                nuevoId = id;
                            }
                        }
                    });
                    if (nuevoId) {
                        select.value = nuevoId;
                        select.dispatchEvent(new Event('change', {bubbles: true}));
                    }
                }).fail(function (xhr) {
                    error.textContent = 'No se pudo agregar la opción.';
                    PanelFormularios.fallo(formulario, xhr, error.textContent);
                }).always(function () {
                    boton.disabled = false;
                    if (!error.textContent) {
                        dialogo.modal('hide');
                        PanelFormularios.alerta('success', 'Opción guardada', 'La opción ya está en la lista.');
                    }
                });
        });
    });
});
</script>
@endpush
