@extends('layouts.app')
@section('title', 'Documentación de alta de residenciaa')
@section('content')

<main>
<!-- Modal para registrar correo de documentación -->
<div class="modal fade" id="modal_registrar_correo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form data-panel-envio class="form" id="formulario_registrar_correo" action="{{url("/residencia/registrar_correo_documentacion")}}" role="form" method="POST" >
        {{ csrf_field() }}
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Enviar Documentación de Alta de Residencia</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre_proyecto">Nombre del alumno:</label>
            <p>{{$datosalumno->nombre}} {{$datosalumno->apaterno}} {{$datosalumno->amaterno}}</p>
          </div>
          <div class="form-group">
            <label for="correo_electronico_doc">Ingresa tu correo electronico. (En el se te notificará, el estado que se encuentra tu documentación, si tienes que corregir o se encuentra autorizada).<b style="color:red; font-size:23px;">*</b></label>
            <input class="form-control" id="correo_electronico_doc" name="correo_electronico_doc" data-panel-etiqueta="el correo electrónico" type="email" placeholder="Ingresa tu correo electronico" required/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="guardar_correo_alta" type="submit" form="formulario_registrar_correo" class="btn btn-primary">Aceptar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
$(function () {
    $("#modal_registrar_correo").modal("show");
});
</script>

@include('partials.panel.validacion_envio')
@endsection
