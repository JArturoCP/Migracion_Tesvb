<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <input class="form-control" type="hidden"  id="id_servicio_mantenimiento" name="id_servicio_mantenimiento"  value="{{ $mantenimiento->id_servicio_mantenimiento }}">
        <p> <b>Nombre del personal: </b>{{ $mantenimiento->nombre }} </p>
        <p> <b>Servicio que solicita: </b>{{ $mantenimiento->servicio_solicita }} </p>
        <p> <b>Fecha que solicita el servicio: </b>{{ $mantenimiento->fecha_solicita }} </p>
    </div>
</div>