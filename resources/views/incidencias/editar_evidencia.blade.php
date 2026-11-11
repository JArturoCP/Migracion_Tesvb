@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
<main class="col-md-12">
<div class="row">
    <div class="col-md-5 col-md-offset-4">
     <div class="panel panel-info">
       <div class="panel-heading">
          <h1 class="panel-title text-center">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO </h1>
      </div>
    </div>  
</div>
    <div class="row">
    <div class="col-md-5 col-md-offset-4">
     <div class="panel panel-default">
        <div class="panel-heading">
          <h3  class="text-center"> Tipo de evidencia enviada: {{ $evidencia->nombre_evidencia }}</h3>
            <?php
            $fecha= date('d-m-Y', strtotime($evidencia->fecha_solicita));
            ?>
            <h2 style="text-align: center">Fecha: {{ $fecha }}</h2>
             @if($evidencia->id_tipo_evid == 1 || $evidencia->id_tipo_evid == 3 || $evidencia->id_tipo_evid == 5 || $evidencia->id_tipo_evid == 6)
            <h4 style="text-align: center">No. folio: {{ $evidencia->no_folio }}</h4>
            @endif
          <br>
          <div class="row">
    <div class="col-md-10 col-md-offset-1 text-center">

          <a  target="_blank" href="/incidencias/{{$evidencia->arch_evidencia}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
          <button id="{{$evidencia->id_evid}}" class="btn btn-primary editar_evid"> Editar </button>
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#enviar">Enviar</button>
        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#cancelar">Cancelar</button>
       {{--  <a href="{{url('/incidencias/historial_docentesEv')}}" class="btn btn-success ">Enviar</a> --}}
        </div>  
    </div>  
    </div>  
    </div>
  <div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
        </div>
      <div class="modal-body">
    <div id="contenedor_editar">
  </div>
</div> <!-- modal body  -->
                    <div class="modal-footer">
                    
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                       
                        <button type="button" id="guardar_mod"class="btn btn-primary" >Guardar</button>
                   </div>
 
                </div>
            </div>
        </div>

        <div class="modal fade" id="enviar" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enviar evidencia</h4>
                    </div>
                    <div class="modal-body">
                        <p>Seguro(a) que quiere enviar la evidencia.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                        <button type="button" id="enviar_evid"class="btn btn-success" >Enviar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cancelar" role="dialog">
            <div class="modal-dialog modal-sm">
                <form  action="{{url("/incidencias/eliminar_evidencia/".$evidencia->id_evid)}}" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cancelar evidencia</h4>
                    </div>
                    <div class="modal-body">
                        <p>Seguro(a) que quiere cancelar la evidencia.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                        <button type="submit"  class="btn btn-primary" >Aceptar</button>

                    </div>
                </div>
                </form>
            </div>
        </div>

     <script>
$(document).ready(function(){

    $("#enviar_evid").click(function (){
        window.location.href='/incidencias/enviar_evidencia_fecha/{{$evidencia->id_evid}}';
    });
  $(".editar_evid").click(function(){
        //alert("HOLA");
    var id_evid = $(this).attr('id');
    $.get("/incidencias/modificar_evidencia/"+id_evid,function(request){
    $("#contenedor_editar").html(request);
    $("#modal_editar").modal('show');
    });
  }); 
  $("#guardar_mod").click(function(){


//alert(id_tipo_evid);

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
            var tipo_evidencia="{{$evidencia->id_tipo_evid}}";

            if(tipo_evidencia == 1 ||  tipo_evidencia== 3 || tipo_evidencia== 5 || tipo_evidencia==6)
            {
                var no_folio = $('#no_folio').val();
                if(no_folio == ""){
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa el número de folio",
                        showConfirmButton: false,
                        timer: 3500
                    });

                }else{
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


            }else {

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