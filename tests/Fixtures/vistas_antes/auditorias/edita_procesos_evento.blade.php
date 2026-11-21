@section('modal_procesos_evento')

<main>
<!-- Modal para editar procesos del evento -->
<div class="modal fade bs-example-modal-lg" id="modal_procesos_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Editar procesos del evento</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          @foreach($procesos as $proceso)
            <div class="col-md-6">
              @if(\Illuminate\Support\Facades\Session::get('procesos-evento'))
                @if(in_array($proceso->id_auditoria_proceso,\Illuminate\Support\Facades\Session::get('procesos-evento')))
                  <label class="checkbox-inline"><input class="existentes" type="checkbox" data-id="{{$proceso->id_auditoria_proceso}}" checked>{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
                @else
                  <label class="checkbox-inline"><input class="existentes" type="checkbox" data-id="{{$proceso->id_auditoria_proceso}}">{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
                @endif
              @else
                <label class="checkbox-inline"><input class="existentes" type="checkbox" data-id="{{$proceso->id_auditoria_proceso}}">{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
              @endif
            </div>
          @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success guardar_procesos">Guardar</button>
      </div>
    </div>
  </div>
</div>

<form data-panel-envio action="{{url('auditorias/evento')}}/{{$id}}" method="POST" id="form_procesos_evento">
  @csrf
  @method('PUT')
  <input type="text" name="data" id="data_procesos_evento" hidden>
</form>
</main>

<script>
  $(document).ready(function(){

    $("#modal_procesos_evento").modal("show");

    $('.guardar_procesos').click(function () {
      var agregar=[];
      $('#modal_procesos_evento .existentes:checkbox:checked').each(function () {
        agregar.push($(this).data('id'));
      });
      if (agregar.length>0){
        $('#data_procesos_evento').val(JSON.stringify(agregar));
        $('#form_procesos_evento').submit();
      } else {
        PanelFormularios.alerta('warning', 'Revisa la selección', 'Selecciona al menos un proceso.');
      }
    });

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
