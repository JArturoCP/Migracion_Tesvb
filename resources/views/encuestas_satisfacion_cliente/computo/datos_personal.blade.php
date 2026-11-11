<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <input class="form-control" type="hidden"  id="id_servicio_mantenimiento" name="id_servicio_mantenimiento"  value="{{ $personal->id_servicio_mantenimiento }}">
        <p> <b>Nombre del personal: </b>{{ $personal->nombre }} </p>
        <p> <b>Servicio que solicita: </b>{{ $personal->servicio_solicita }} </p>
        <p> <b>Fecha que solicita el servicio: </b>{{ $personal->fecha_solicita }} </p>
    </div>
</div>