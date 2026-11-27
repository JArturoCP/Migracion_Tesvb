<input type="hidden" name="id_servicio_mantenimiento" value="{{ $mantenimiento->id_servicio_mantenimiento }}">
<dl class="tw:space-y-3 tw:text-sm">
    <div><dt class="tw:font-medium">Nombre del personal</dt><dd>{{ $mantenimiento->nombre }}</dd></div>
    <div><dt class="tw:font-medium">Servicio solicitado</dt><dd>{{ $mantenimiento->servicio_solicita }}</dd></div>
    <div><dt class="tw:font-medium">Fecha de la solicitud</dt><dd>{{ $mantenimiento->fecha_solicita }}</dd></div>
</dl>
