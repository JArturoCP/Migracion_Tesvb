<input type="hidden" id="id_alumno" name="id_alumno" value="{{ $alumno->id_alumno }}">
<dl class="tw:space-y-3 tw:text-sm">
    <div>
        <dt class="tw:font-medium">No. de cuenta</dt>
        <dd>{{ $alumno->cuenta }}</dd>
    </div>
    <div>
        <dt class="tw:font-medium">Nombre del estudiante</dt>
        <dd>{{ trim($alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno) }}</dd>
    </div>
</dl>
