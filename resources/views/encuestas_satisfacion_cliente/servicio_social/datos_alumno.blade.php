<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <input class="form-control" type="hidden"  id="id_alumno" name="id_alumno"  value="{{ $alumno->id_alumno }}">
        <p><b>No. cuenta:</b> {{ $alumno->cuenta }}<br>  <b>Nombre del estudiante: </b>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</p>
    </div>
</div>