<div class="row">
    <input class="form-control"  id="id_anteproyecto" name="id_anteproyecto" type="hidden"   value="{{$datos_alumno->id_anteproyecto}}" required/>
    <div class="col-md-8 col-md-offset-2">
        <h4>No. Cuenta: {{ $datos_alumno->cuenta }}</h4>
        <h4>Nombre del estudiante: {{ $datos_alumno->nombre }} {{ $datos_alumno->apaterno }} {{ $datos_alumno->amaterno }}</h4>
    </div>
</div>