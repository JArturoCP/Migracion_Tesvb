<input type="hidden" id="id_alumno" name="id_alumno" value="{{ $alumno->id_alumno }}">

<dl class="tw:grid tw:gap-3 tw:text-sm tw:text-gray-700 tw:sm:grid-cols-2 tw:dark:text-gray-300">
    <div>
        <dt class="tw:font-semibold">No. de cuenta</dt>
        <dd>{{ $alumno->no_cuenta }}</dd>
    </div>
    <div>
        <dt class="tw:font-semibold">Nombre del estudiante</dt>
        <dd>{{ $alumno->nombre_al }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</dd>
    </div>
</dl>
