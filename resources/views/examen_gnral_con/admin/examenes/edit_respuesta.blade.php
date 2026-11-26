@section('modal_editar_respuesta')

<main>
<!-- Modal para editar respuesta -->
<div class="modal fade bs-example-modal-lg tw-modal-compat" id="modal_editar_respuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form data-panel-envio action="{{ route('admin.examen_general.respuesta.update', $respuesta->id_respuesta) }}" method="POST" class="">
        @csrf
        <div class="modal-header tw:bg-sky-100">
          <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil-square-o"></span> EDITAR RESPUESTA DE LA PREGUNTA: {{ $respuesta->numero_pregunta }}</h4>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_examen_egel" value="{{ $respuesta->id_examen_egel }}">

          <div class="tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2"><span class="fa fa-pencil"></span> Respuesta</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <input type="text" name="respuesta" data-panel-etiqueta="el texto de la respuesta" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $respuesta->respuesta }}" placeholder="Escribe la respuesta aquí">
            </div>
          </div>

          <div class="tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2"><span class="fa fa-check-circle-o"></span> ¿Es correcta?</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <select name="es_correcta" data-panel-etiqueta="si la respuesta es correcta" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                <option value="1" {{ $respuesta->es_correcta == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ $respuesta->es_correcta == 0 ? 'selected' : '' }}>No</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Regresar</button>
          <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"><span class="fa fa-floppy-o"></span> Actualizar Respuesta</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_editar_respuesta").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
