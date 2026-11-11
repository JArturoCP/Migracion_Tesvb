<form id="form_enviar_evidencia" action="{{url("/incidencias/guardar_mod_evidencia/".$evidencia->id_evid)}}" role="form" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <label>Instrucciones: </label><br>
      <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
  </div>
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
        <h2>Tipo de evidencia:{{ $evidencia->nombre_evidencia }}</h2>
    </div>

</div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="fecha_tervac">Fecha requerida</label>
            <div class="form-group">
                <input class="form-control datepicker fecha_mod_requerida"   type="text"  id="fecha_mod_requerida" name="fecha_mod_requerida" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD"  value="{{$evidencia->fecha_solicita}}">
            </div>
        </div>
    </div>
<div class="row">              
    <div class="col-md-8 col-md-offset-2">
        <span><label for="archivo_subir">Archivo a subir:</label>
            <input  class="form-control" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required/></span>
      </div> 
</div>
    @if($evidencia->id_tipo_evid == 1 || $evidencia->id_tipo_evid == 3 ||  $evidencia->id_tipo_evid == 5  ||  $evidencia->id_tipo_evid == 6)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <label for="archivo_subir">Número de folio:</label>
                <input class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="no_folio" name="no_folio" type="text" placeholder="Ingresa numero de folio" value="{{ $evidencia->no_folio }}" required>
            </div>
        </div>
    @endif
 </form>

<script>
    $( '.fecha_mod_requerida').datepicker({
        pickTime: false,
        autoclose: true,
        language: 'es',
        startDate: '-7d',
    });
</script>