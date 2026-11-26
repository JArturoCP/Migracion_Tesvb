@section('modal_editar_respuesta')

<main>
<!-- Modal para editar respuesta -->
<x-panel.modal id="modal_editar_respuesta" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <form data-panel-envio action="{{ route('admin.examen_general.respuesta.update', $respuesta->id_respuesta) }}" method="POST" class="">
        @csrf
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel"><span class="fa fa-pencil-square-o"></span> EDITAR RESPUESTA DE LA PREGUNTA: {{ $respuesta->numero_pregunta }}</h4>
        </div>
        <div class="tw-modal-cuerpo">

          <input type="hidden" name="id_examen_egel" value="{{ $respuesta->id_examen_egel }}">

          <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300 tw:px-2"><span class="fa fa-pencil"></span> Respuesta</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <input type="text" name="respuesta" data-panel-etiqueta="el texto de la respuesta" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $respuesta->respuesta }}" placeholder="Escribe la respuesta aquí">
            </div>
          </div>

          <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300 tw:px-2"><span class="fa fa-check-circle-o"></span> ¿Es correcta?</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <select name="es_correcta" data-panel-etiqueta="si la respuesta es correcta" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                <option value="1" {{ $respuesta->es_correcta == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ $respuesta->es_correcta == 0 ? 'selected' : '' }}>No</option>
              </select>
            </div>
          </div>

        </div>
        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Regresar</button>
          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"><span class="fa fa-floppy-o"></span> Actualizar Respuesta</button>
        </div>
      </form>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_editar_respuesta").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
