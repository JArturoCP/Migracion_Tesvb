
<form  class="form" role="form" action="{{url("/ingles/profesores/reg_datos_usuario_ingles/".$id_nivel."/".$id_grupo)}}" method="POST">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <input class="form-control" type="hidden"  id="id_alumno" name="id_alumno"  value="{{ $datos_alumno->id_alumno }}">
                <h4>Número de cuenta: {{ $datos_alumno->cuenta }}</h4>
                <h5>Nombre del usuario: {{ $datos_alumno->nombre." ".$datos_alumno->apaterno." ".$datos_alumno->amaterno }}</h5>
            </div>
        </div>

    </div>
</form>
@if($estado_periodo == 0)
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger">
                <strong>El periodo no esta activo.</strong>
            </div>
        </div>
    </div>
    @else
    @if($contar_estado > 1)
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-danger">
                    <strong>No hay historial del usuario, usted autoriza el nivel que se va a agregar.</strong>
                </div>
            </div>
        </div>

        @else
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success">
                    <strong>El nivel sugerido es:</strong>
                    @foreach($niveles as $nivel)
                    <p>{{ $nivel->descripcion }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

    <button id="guardar_registro"  class="btn btn-primary">Agregar</button>
</div>
    @endif

