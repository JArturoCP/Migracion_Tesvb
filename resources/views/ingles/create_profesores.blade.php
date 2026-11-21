@extends('layouts.app')
@section('title', 'Creación Docentes')
@section('content')

<main>
<!-- Modal para agregar facilitador -->
<div class="modal fade bs-example-modal-lg" id="modal_agregar_facilitador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="form_profesores_ingles" class="form" role="form" method="POST">
        {{ csrf_field() }}
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Agregar Facilitador</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="nombre_docente">Nombre Completo</label>
                <input type="text" id="nombre_profesor" class="form-control" name="nombre_profesor" placeholder="Nombre" style="text-transform:uppercase" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" id="ap_paterno" class="form-control" name="ap_paterno" placeholder="Apellido Paterno" style="text-transform:uppercase" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" id="ap_materno" class="form-control" name="ap_materno" placeholder="Apellido Materno" style="text-transform:uppercase" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="nivel_ingles">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" required>
                  <option disabled selected>Selecciona ...</option>
                  @foreach($sexos as $sexo)
                    <option value="{{$sexo->id_sexo}}" >{{$sexo->descripcion}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="nivel_ingles">Nivel ingles</label>
                <select name="nivel_ingles" id="nivel_ingles" class="form-control" required>
                  <option disabled selected>Selecciona nivel de ingles...</option>
                  @foreach($nivel_ingles as $nivel)
                    <option value="{{$nivel->id_nivel_ingles}}" >{{$nivel->descripcion}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="titulo">Certificado o Constancia</label>
                <select name="titulo" id="titulo" class="form-control" required>
                  <option disabled selected>Selecciona ...</option>
                  @foreach($titulos as $titulo)
                    <option value="{{$titulo->id_titulo}}" >{{$titulo->descripcion}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_termino">Fecha emision de Constancia o Certificado</label>
                <input class="form-control datepicker fecha_termino" type="text" id="fecha_termino" name="fecha_termino" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Guardar datos</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script type="text/javascript">
  $(document).ready(function(){

    $("#modal_agregar_facilitador").modal("show");

    $('.fecha_termino').datepicker({
      pickTime: false,
      autoclose: true,
      language: 'es',
      startDate: '+0d',
    });

  });
</script>

@endsection
