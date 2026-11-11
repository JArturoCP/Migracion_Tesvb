@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h4>{{ $evid->nombre_articulo }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p><b>Fecha solicitada: </b>{{ $evid->fecha_req }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p><b>Motivo del oficio: </b>{{ $evid->motivo_oficio }}</p>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-5 col-md-offset-4">
                                    <a  target="_blank" href="/incidencias/{{$evid->arch_evidencia}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                                    <button id="{{$evid->id_evid}}" class="btn btn-primary editar_evid"> Editar </button>
                                    <a href="{{url('/incidencias/historial_docentesSo')}}" class="btn btn-success ">Regresar </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal fade bs-example-modal-lg" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div id="contenedor_agregar">

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info" >Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function(){
                            $(".editar_evid").click(function(){
                                //alert("HOLA");
                                var id_evid=$(this).attr('id');

                                $.get("/incidencias/ver_datos_oficio_evidencia/"+id_evid,function (request) {
                                    $("#contenedor_agregar").html(request);
                                    $("#modal_agregar").modal('show');
                                });
                            });
                            $("#guardar_mod").click(function(){

                                var id_tipo_evid= $('#id_tipo_evid').val();
//alert(id_tipo_evid);
                                if(id_tipo_evid == null)
                                {
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "Selecciona tipo de evidencia",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }else{
                                    var fecha_mod_requerida = $('#fecha_mod_requerida').val();
                                    if(fecha_mod_requerida == ""){
                                        swal({
                                            position: "top",
                                            type: "error",
                                            title: "Selecciona una fecha",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    }else {
                                        var arch_evidencia = $('#arch_evidencia').val();

                                        if (arch_evidencia == '') {
                                            swal({
                                                position: "top",
                                                type: "error",
                                                title: "Selecciona evidencia que desea subir",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        } else {
                                            $("#form_enviar_evidencia").submit();
                                            $("#guardar_mod").attr("disableb", true);
                                            swal({
                                                position: "top",
                                                type: "success",
                                                title: "Registro exitoso",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        }
                                    }
                                }
///////seecion de evidencia////
                            });

/////////Sigue script//////
                        });
                    </script>


    </main>
@endsection