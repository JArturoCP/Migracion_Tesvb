@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
<main class="col-md-12">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
     <div class="panel panel-info">
        <div class="panel-heading">
          <h1 class="panel-title text-center">SUBIR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO<br><br>
          Tipo de evidencia: {{ $tipo_evidencia->nombre_evidencia }}</h1>
        </div>
     </div>
    </div>
  <form id="form_enviar_evidencia" action="{{url('/incidencias/guardar_evidencia_fecha_solicita/'.$tipo_evidencia->id_tipo_evid.'/'.$tipo_fecha)}}" role="form" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
<div class="row">
  <div class="col-md-8 col-md-offset-3">
    <label>Instrucciones: </label><br>
      <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
  </div>
</div>

              <div class="row">
                  <div style="" id="fecha_r1" class="col-md-5  col-md-offset-3 ">
                      <label for="fecha_requerida">Fecha requerida:</label>
                      <div class="form-group">
                          <input class="form-control datepicker fecha_requerida1"   type="text"  id="fecha_req1" name="fecha_req1" data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" >
                      </div>
                  </div>
              </div>
            <div class="row">              
                 <div class="col-md-5 col-md-offset-3">
                     <span><label for="archivo_subir">Archivo a subir:</label></span>
                    <input  class="form-control" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required />
                 </div>
            </div>
           @if($tipo_evidencia->id_tipo_evid == 1 || $tipo_evidencia->id_tipo_evid == 3 ||  $tipo_evidencia->id_tipo_evid == 5  ||  $tipo_evidencia->id_tipo_evid == 6)
           <div class="row">
               <div class="col-md-5 col-md-offset-3">
                   <label for="archivo_subir">Número de folio:</label>
               <input class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="no_folio" name="no_folio" type="text" placeholder="Ingresa numero de folio" style="" required></input>
               </div>
           </div>
          @endif

 </form>
 <div class="row" style="display: inline" id="subir">
    <br>
      <div class="col-md-4 col-md-offset-5">
        <button id="enviar_evidencia" type="button" class="btn btn-success btn-lg">Guardar Evidencia</button>
      </div>
</div>
</div>
<script>
    $(document).ready( function() {

        $( '.fecha_requerida1').datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: '-7d',
            });


  $("#enviar_evidencia").click(function(){

         fecha_requerida = $('#fecha_req1').val();


    if( fecha_requerida ==""){
        swal({
            position: "top",
            type: "error",
            title: "Selecciona fecha",
            showConfirmButton: false,
            timer: 3500
        });

    }else{
        var arch_evidencia = $('#arch_evidencia').val();
        if(arch_evidencia == ''){
            swal({
                position: "top",
                type: "error",
                title: "Selecciona evidencia que desea subir",
                showConfirmButton: false,
                timer: 3500
            });
        } else{
            var tipo_evidencia="{{$tipo_evidencia->id_tipo_evid}}";

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
                  $("#enviar_evidencia").attr("disableb", true);
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
                $("#enviar_evidencia").attr("disableb", true);
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
    });
   </script>   
</main>
@endsection