<x-panel.encabezado :titulo="$titulo" :migas="[$etiquetaListado => url('/titulacion/'.$rutaListado.'/'.$alumno->id_carrera)]" />

<x-panel.tarjeta :titulo="trim($alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno)">
    <dl class="tw:grid tw:gap-4 tw:text-sm tw:sm:grid-cols-2">
        <div>
            <dt class="tw:text-gray-600 tw:dark:text-gray-400">No. de cuenta</dt>
            <dd class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $alumno->cuenta }}</dd>
        </div>
        <div>
            <dt class="tw:text-gray-600 tw:dark:text-gray-400">Carrera</dt>
            <dd class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $alumno->carrera }}</dd>
        </div>
    </dl>
</x-panel.tarjeta>
