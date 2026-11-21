@extends('layouts.panel')
@section('title', 'Datos personales')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
@php
    $secciones = [
        'Datos personales y de contacto' => [
            ['nombre_docente', 'Nombre completo', 'nombre', 'text', 60],
            ['rfc', 'RFC', 'rfc', 'text', 13],
            ['selectSexo', 'Sexo', 'sexo', 'select'],
            ['o_nac', 'Lugar de nacimiento', 'origen_nac', 'text', 30],
            ['f_nac', 'Fecha de nacimiento', 'fch_nac', 'date'],
            ['dir', 'Dirección', 'direccion', 'text', 100],
            ['correo', 'Correo electrónico', 'correo', 'email', 40],
            ['telefono', 'Teléfono', 'telefono', 'tel', 20],
            ['celular', 'Celular', 'celular', 'tel', 20],
        ],
        'Formación y datos laborales' => [
            ['selectEsc', 'Escolaridad', 'escolaridad', 'select'],
            ['esc_p', 'Escuela de procedencia', 'esc_procedencia'],
            ['cedula', 'Cédula profesional', 'cedula', 'number'],
            ['clave_docente', 'Clave docente (ISSEMyM)', 'clave', 'text', 8],
            ['numero_empleado', 'Número de empleado', 'numero_empleado', 'text', 100],
            ['selectNombra', 'Nombramiento', 'nombramiento', 'select'],
            ['f_ingreso', 'Fecha de ingreso', 'fch_ingreso_tesvb', 'date'],
            ['f_contrata', 'Fecha de contratación', 'fch_recontratacion', 'date'],
            ['selectPerfil', 'Perfil', 'id_perfil', 'select'],
            ['selectSituacion', 'Situación', 'id_situacion', 'select'],
            ['selectAbreviacion', 'Abreviación', null, 'select'],
        ],
    ];
    $opciones = [
        'selectSexo' => ['M' => 'M', 'F' => 'F'],
        'selectEsc' => ['Tecnico' => 'Técnico', 'Licenciatura' => 'Licenciatura', 'Maestria' => 'Maestría', 'Doctorado' => 'Doctorado', 'Secundaria' => 'Secundaria', 'Preparatoria' => 'Preparatoria'],
        'selectNombra' => ['T' => 'Temporal', 'D' => 'Definitivo'],
        'selectPerfil' => collect($perfiles)->pluck('descripcion', 'id_perfil'),
        'selectSituacion' => collect($situaciones)->pluck('situacion', 'id_situacion'),
        'selectAbreviacion' => collect($abreviaciones)->pluck('titulo', 'id_abreviacion'),
    ];
    $catalogos = [
        'selectPerfil' => ['perfil', 'Agregar perfil', 'Nombre del perfil', 'perfiles', 'id_perfil', 'descripcion'],
        'selectSituacion' => ['situacion', 'Agregar situación', 'Nombre de la situación', 'situaciones', 'id_situacion', 'situacion'],
        'selectAbreviacion' => ['abreviacion', 'Agregar abreviación', 'Abreviación', 'abreviaciones', 'id_abreviacion', 'titulo'],
    ];
    $cargoActual = collect($cargos)->firstWhere('id_cargo', $docente_edit->id_cargo);
@endphp

<main class="tw:space-y-5">
    <x-panel.encabezado titulo="Datos personales" />
    <x-panel.tarjeta titulo="Datos del docente">
        <x-slot:acciones>
            <x-panel.boton id="abrir_edicion_docente" data-toggle="modal" data-target="#editar_docente">Editar datos personales</x-panel.boton>
        </x-slot:acciones>

        <dl class="tw:grid tw:gap-5 tw:text-sm tw:sm:grid-cols-2 tw:lg:grid-cols-4">
            @foreach ([
                'Nombre completo' => $docente_edit->nombre,
                'Cargo asignado' => $cargoActual?->cargo ?? 'Sin asignar',
                'Horas máximas' => $docente_edit->horas_maxima,
                'Horas máximas de inglés' => $docente_edit->maximo_horas_ingles,
            ] as $etiqueta => $valor)
                <div>
                    <dt class="tw:text-gray-500 tw:dark:text-gray-400">{{ $etiqueta }}</dt>
                    <dd @if ($loop->first) id="nombre_docente_resumen" @endif class="tw:mt-1 tw:font-medium tw:break-words tw:text-gray-800 tw:dark:text-white/90">{{ $valor ?? 'Sin asignar' }}</dd>
                </div>
            @endforeach
        </dl>
    </x-panel.tarjeta>
</main>

<x-panel.modal id="editar_docente" tamano="xl" sin-relleno estatico aria-labelledby="editar_docente_titulo">
    <x-slot:encabezado>
        <h2 id="editar_docente_titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Editar datos personales</h2>
    </x-slot:encabezado>
    <form data-panel-stepper data-panel-seguimiento="docente" id="form_docente_edita" method="POST" action="{{ url('/docente/'.$docente_edit->id_personal) }}"
        data-stepper-errores="{{ json_encode($errors->messages()) }}" novalidate>
        @csrf
        @method('PUT')
        <div class="tw-modal-cuerpo tw:max-h-[60dvh] tw:space-y-6 tw:overflow-y-auto">
            @if ($ok === 'true')
                <x-panel.alerta tipo="error">La fecha de nacimiento ingresada es incorrecta.</x-panel.alerta>
            @endif
            @error('guardado')
                <x-panel.alerta tipo="error">{{ $message }}</x-panel.alerta>
            @enderror
            <x-panel.stepper id="edicion-docente" :pasos="array_keys($secciones)" />
            @foreach ($secciones as $titulo => $campos)
                <fieldset id="edicion-docente-paso-{{ $loop->index }}" data-stepper-seccion class="tw:min-w-0 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
                    <legend tabindex="-1" class="tw:mb-3 tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</legend>
                    <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:lg:grid-cols-3">
                        @foreach ($campos as $campo)
                            @php
                                [$nombre, $etiqueta, $propiedad] = $campo;
                                $tipo = $campo[3] ?? 'text';
                                $valor = old($nombre, $propiedad === null ? $abre_doc : $docente_edit->{$propiedad});
                                if ($tipo === 'date') {
                                    $valor = str_replace('/', '-', (string) $valor);
                                }
                            @endphp
                            @if ($tipo === 'select')
                                <div class="tw:min-w-0">
                                    <x-panel.select :id="$nombre" :name="$nombre" :etiqueta="$etiqueta" class="tw:aria-invalid:border-red-500" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($opciones[$nombre] as $clave => $texto)
                                            <option value="{{ $clave }}" @selected(strcasecmp((string) $valor, (string) $clave) === 0)>{{ $texto }}</option>
                                        @endforeach
                                    </x-panel.select>
                                    @isset($catalogos[$nombre])
                                        <x-panel.boton tamano="sm" variante="contorno-primario" class="tw:mt-2" data-toggle="modal" :data-target="'#agregar_'.$catalogos[$nombre][0]">
                                            {{ $catalogos[$nombre][1] }}
                                        </x-panel.boton>
                                    @endisset
                                </div>
                            @else
                                <x-panel.input :id="$nombre" :name="$nombre" :etiqueta="$etiqueta" :type="$tipo" :value="$valor"
                                    :maxlength="$campo[4] ?? null" :min="$nombre === 'cedula' ? 0 : null"
                                    :max="match ($nombre) { 'f_nac' => today()->subDay()->toDateString(), 'cedula' => 2147483647, default => null }"
                                    :pattern="$nombre === 'correo' ? '[^\s@]+@[^\s@]+\.[^\s@]+' : null"
                                    class="tw:aria-invalid:border-red-500" required />
                            @endif
                        @endforeach
                    </div>
                </fieldset>
            @endforeach
        </div>
        <x-panel.modal-pie>
            <x-panel.stepper-navegacion />
            <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
            <x-panel.boton id="guarda_docente" type="submit">Guardar cambios</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

@foreach ($catalogos as $select => [$id, $titulo, $etiqueta, $recurso, $clave, $texto])
    <x-panel.modal :id="'agregar_'.$id" sin-relleno :aria-labelledby="'titulo_'.$id">
        <x-slot:encabezado>
            <h2 id="titulo_{{ $id }}" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h2>
        </x-slot:encabezado>
        <form data-docente-catalogo data-select="{{ $select }}" data-url="{{ url('/docentes/'.$recurso) }}"
            data-recurso="{{ $recurso }}" data-clave="{{ $clave }}" data-texto="{{ $texto }}">
            <div class="tw-modal-cuerpo tw:space-y-4">
                <x-panel.input :id="'catalogo_'.$id" :etiqueta="$etiqueta" required />
                @if ($id === 'situacion')
                    <x-panel.input id="catalogo_situacion_abreviacion" etiqueta="Abreviación" required />
                @endif
                <p data-catalogo-error role="alert" class="tw:text-sm tw:text-red-600 tw:dark:text-red-400"></p>
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
window.docenteEdicion = {
    modal: 'editar_docente',
    errors: @json($errors->getBag('default')->messages()),
    success: @json(session('docente_success')),
    advertenciaFecha: @json($ok === 'true'),
    alertaClase: 'tw:z-[100001]'
};
</script>
<script src="{{ asset('js/docentes/editar.js') }}?v={{ filemtime(public_path('js/docentes/editar.js')) }}"></script>
@endpush
