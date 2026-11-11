@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

    <main>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">VALIDACIÓN DE CARGAS ACADEMICAS</h3>
                    </div>
                </div>
            </div>
            {{--
                    @if($activar_periodo_carga->descripcion==2)
                        <div class="col-md-2 col-md-offset-8">

                            <a class=" btn btn-success activar_periodo_carga" id="{{$activar_periodo_carga->id_validacion_carga}}" type="button" >Activar periodo de remplazo de carga <span class="glyphicon glyphicon-ok " aria-hidden="true" /></a>
          </div>
          @endif
          @if($activar_periodo_carga->descripcion==4)
          <div class="col-md-2 col-md-offset-8">

            <a class=" btn btn btn-danger desactivar_periodo_carga" id="{{$activar_periodo_carga->id_validacion_carga}}" type="button">Desactivar periodo de remplazo de carga <span class="glyphicon glyphicon-remove " aria-hidden="true" /></a>
          </div>
          @endif
          --}}
            {{--@if($activar==1)
          <div class="col-md-3 col-md-offset-9">

              <a class=" btn btn-danger" id="enviar" type="button" href="/desactivar">Desactivar Cargas <span class="glyphicon glyphicon-remove " aria-hidden="true"
                ></a>
          </div>
          @else
          <div class="col-md-3 col-md-offset-9">

              <a class=" btn btn-success " id="enviar" type="button" href="/desactivar">Activar Cargas <span class="glyphicon glyphicon-ok " aria-hidden="true"
                ></a>
          </div>
          @endif
          --}}
            <div class="row col-md-10 col-md-offset-1">

            <?php $escolar = session()->has('escolar') ? session()->has('escolar') : false;  ?>

            <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#uno" aria-controls="home" role="tab" data-toggle="tab">Pendientes</a></li>
                    <li role="presentation"><a href="#dos" aria-controls="dos" role="tab" data-toggle="tab">Aceptados (Normal)</a></li>
                    <li role="presentation"><a href="#tres" aria-controls="dos" role="tab" data-toggle="tab">Aceptados (Duales nueva versión)</a></li>
                    {{-- <li role="presentation"><a href="#cuatro" aria-controls="dos" role="tab" data-toggle="tab">Aceptados (Duales versión antigua)</a></li> --}}

                </ul>

                <!-- Tab panes -->
                <div class="tab-content ">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class=" col-md-10 col-md-offset-1">

                            </br></br></br>

                            <table class="table table-bordered " Style="background: white;" id="no_aceptados">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CARRERA</th>
                                    <th>CARGA ACADEMICA</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($consulta as$consulta)
                                    <tr>
                                        <th>{{$consulta->cuenta}}</th>
                                        <td>{{$consulta->nombre}} {{$consulta->apaterno}} {{$consulta->amaterno}}</td>

                                        <td>{{$consulta->carreras}}</td>
                                        <td>

                                            <a onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta->id ) }}')"><span class="glyphicon glyphicon-list-alt em5" aria-hidden="true"></span></a>

                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dos">
                        <div class=" col-md-10 col-md-offset-1">

                            </br></br></br>

                            <table class="table table-bordered " Style="background: white;" id="aceptados">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>SEMESTRE</th>
                                    <th>CARRERA</th>
                                    <th>CARGA ACADEMICA</th>
                                    @if($periodo_activo == 1)
                                        <th>MODIFICACIÓN DE ESTADO DEL ALUMNO</th>
                                        <th>DAR DE BAJA ALUMNO</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($consulta2 as$consulta2)
                                    <tr>
                                        <th>{{$consulta2->cuenta}}</th>
                                        <td>{{$consulta2->nombre}} {{$consulta2->apaterno}} {{$consulta2->amaterno}}</td>
                                        <td>{{$consulta2->semestre}}</td>
                                        <td>{{$consulta2->carreras}}</td>
                                        <td>
                                            <a onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta2->id ) }}')"><span class="glyphicon glyphicon-list-alt em5" aria-hidden="true"></span></a>
                                        </td>
                                        @if($periodo_activo == 1)
                                            <td>
                                                @if($escolar == true)
                                                    <a class=" btn btn-success activar_periodo_carga" id="{{$consulta2->id}}" type="button">Modificar estado del alumno<span class="glyphicon glyphicon-ok " aria-hidden="true" /></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($escolar == true)
                                                    <a class=" btn btn-danger baja" id="{{$consulta2->id}}" type="button">Dar de baja<span class="glyphicon glyphicon-edit " aria-hidden="true" /></a>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tres">
                        <div class=" col-md-10 col-md-offset-1">

                            </br></br></br>

                            <table class="table table-bordered " Style="background: white;" id="version_actual">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>SEMESTRE</th>
                                    <th>CARRERA</th>
                                    <th>CARGA ACADEMICA</th>
                                    @if($periodo_activo == 1)
                                        <th>MODIFICACIÓN DE ESTADO DEL ALUMNO</th>
                                        <th>CALIFICAR ESTUDIANTE</th>
                                        <th>DAR DE BAJA ALUMNO</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($consulta3 as$consulta3)
                                    <tr>
                                        <th>{{$consulta3->cuenta}}</th>
                                        <td>{{$consulta3->nombre}} {{$consulta3->apaterno}} {{$consulta3->amaterno}}</td>
                                        <td>{{$consulta3->semestre}}</td>
                                        <td>{{$consulta3->carreras}}</td>
                                        <td>
                                            <a onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta3->id ) }}')"><span class="glyphicon glyphicon-list-alt em5" aria-hidden="true"></span></a>
                                        </td>
                                        @if($periodo_activo == 1)
                                            <td>
                                                @if($escolar == true)
                                                    <a class=" btn btn-success activar_periodo_carga" id="{{$consulta3->id}}" type="button">Modificar estado del alumno<span class="glyphicon glyphicon-ok " aria-hidden="true" /></a>
                                                @endif
                                            </td>

                                            <td style="text-align: center">
                                                @if($escolar == true)
                                                    <a href="#" onclick="window.open('{{ url('/calificar_estudiante/'.$consulta3->id ) }}')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Calificar</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($escolar == true)
                                                    <a class=" btn btn-danger baja" id="{{$consulta3->id}}" type="button">Dar de baja<span class="glyphicon glyphicon-edit " aria-hidden="true" /></a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--
                      <div role="tabpanel" class="tab-pane" id="cuatro">
                          <div class=" col-md-10 col-md-offset-1">

                              </br></br></br>

                              <table class="table table-bordered " Style="background: white;" id="version_antigua">
                                  <thead>
                                  <tr>
                                      <th>No. CUENTA</th>
                                      <th>NOMBRE DE ALUMNO(A)</th>
                                      <th>SEMESTRE</th>
                                      <th>CARRERA</th>
                                      <th>CARGA ACADEMICA</th>
                                      @if($periodo_activo == 1)
                                      <th>MODIFICACIÓN DE ESTADO DEL ALUMNO</th>
                                      <th>DAR DE BAJA ALUMNO</th>
                                      @endif
                                  </tr>
                                  </thead>
                                  <tbody>

                                  @foreach($consulta4 as$consulta4)
                                      <tr>
                                          <th>{{$consulta4->cuenta}}</th>
                    <td>{{$consulta4->nombre}} {{$consulta4->apaterno}} {{$consulta4->amaterno}}</td>
                    <td>{{$consulta4->semestre}}</td>
                    <td>{{$consulta4->carreras}}</td>
                    <td>
                      <a onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta4->id ) }}')"><span class="glyphicon glyphicon-list-alt em5" aria-hidden="true"></span></a>
                    </td>
                    @if($periodo_activo == 1)
                    <td>
                      @if($escolar == true)
                      <a class=" btn btn-success activar_periodo_carga" id="{{$consulta4->id}}" type="button">Modificar estado del alumno<span class="glyphicon glyphicon-ok " aria-hidden="true" /></a>
                      @endif
                    </td>
                    <td>
                      @if($escolar == true)
                      <a class=" btn btn-danger baja" id="{{$consulta4->id}}" type="button">Dar de baja<span class="glyphicon glyphicon-edit " aria-hidden="true" /></a>
                      @endif
                    </td>
                    @endif

                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                  </div>
                </div>
                --}}

                </div>
            </div>

        </div>

    </main>
    <form method="POST" role="form" id="form_modificar">
        {{ csrf_field() }}
    </form>
    <form id="form_agregar" class="form" action="/modificar/estado_carga/" role="form" method="POST">
        <div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Modificar estado del alumno</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_carga" name="id_carga" value="">

                            <div class="col-md-8 col-md-offset-1">

                                <label for="exampleInputEmail1">Estado del alumno<b style="color:red; font-size:23px;">*</b></label>
                                <select class="form-control " name="estado" id="estado" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option value="1">NORMAL</option>
                                    <option value="2">DUAL NUEVA VERSIÓN</option>
                                    {{-- <option  value="3">DUAL VERSIÓN ANTIGUA</option> --}}
                                    <option value="4">PERMISO DE MODIFICAR CARGA ACADEMICA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregado" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </form>
    <form id="form_baja" class="form" action="/baja/alumno_baja/" role="form" method="POST">
        <div class="modal fade" id="modal_baja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Dar de baja alumno</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_carga_a" name="id_carga_a" value="">

                            <div class="col-md-8 col-md-offset-1">

                                <label for="exampleInputEmail1">Dar de baja alumno<b style="color:red; font-size:23px;">*</b></label>
                                <select class="form-control " name="estado" id="estado" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option value="1">BAJA TEMPORAL (SIN ELIMINACION DE CARGA)</option>
                                    <option value="2">BAJA TEMPORAL (ELIMINACION DE CARGA)</option>
                                    <option value="3">BAJA DEFINITIVA</option>
  
                                </select>
                            </div>
                            <div class="col-md-8 col-md-offset-1">
    <label for="obser">Motivo de la baja:</label>

    <select class="form-control rounded-0" id="obser" name="obser" required>
        <option value="">Seleccione un motivo</option>
        <option value="Económicas">Económicas</option>
        <option value="Salud">Salud</option>
        <option value="No le gustó la carrera">No le gustó la carrera</option>
        <option value="Problemas sociales">Problemas sociales</option>
        <option value="Falta de motivación">Falta de motivación</option>
        <option value="Falta de vocación">Falta de vocación</option>
        <option value="Problemas familiares">Problemas familiares</option>
        <option value="Deficiencias académicas">Deficiencias académicas</option>
        <option value="Carrera difícil">Carrera difícil</option>
        <option value="Reprobación">Reprobación</option>
        <option value="Baja por oficio">Baja por Oficio</option>
    </select>
</div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_baja" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#no_aceptados').DataTable();
            $('#aceptados').DataTable();
            $('#version_actual').DataTable();
            $('#version_antigua').DataTable();
            $("#aceptados").on('click', '.activar_periodo_carga', function() {
                var idof = $(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');
            });
            $("#aceptados").on('click', '.baja', function() {
                var idof = $(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');
            });
            $("#version_actual").on('click', '.baja', function() {
                var idof = $(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');
            });
            $("#version_antigua").on('click', '.baja', function() {
                var idof = $(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');
            });
            $("#guardar_baja").click(function(event) {
                $("#form_baja").submit();
            });
            $("#form_baja").validate({
                rules: {
                    estado: "required",
                    obser: "required",
                },
            });
            $("#guardar_agregado").click(function(event) {
                $("#form_agregar").submit();
            });
            $("#form_agregar").validate({
                rules: {
                    estado: "required",
                },
            });
            $("#version_actual").on('click', '.activar_periodo_carga', function() {
                var idof = $(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');
            });
            $("#version_antigua").on('click', '.activar_periodo_carga', function() {
                var idof = $(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');
            });
            $(".desactivar_periodo_carga").click(function(event) {
                var idof = $(this).attr('id');
                swal({
                    title: "¿Desactivar periodo de remplazar carga academica?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_modificar").attr("action", "/desactivar/periodo_modificacion_carga/" + idof)
                            $("#form_modificar").submit();
                        }
                    });
            });
        });
    </script>
@endsection