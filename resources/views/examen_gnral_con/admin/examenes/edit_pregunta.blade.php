@section('modal_editar_pregunta')

<main>
<!-- Modal para editar pregunta -->
<x-panel.modal id="modal_editar_pregunta" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <form data-panel-envio action="{{ route('admin.examen_general.pregunta.update', $pregunta->id_pregunta) }}" method="POST" class="">
        @csrf
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel"><span class="fa fa-pencil-square-o"></span> EDITAR PREGUNTA</h4>
        </div>
        <div class="tw-modal-cuerpo">

          <input type="hidden" name="id_examen_egel" value="{{ $pregunta->id_examen_egel }}">

          <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300 tw:px-2"><span class="fa fa-pencil"></span> Pregunta</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <textarea name="pregunta" data-panel-etiqueta="el texto de la pregunta" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" rows="4" placeholder="Escribe la pregunta aquí" style="resize:none;">{{ $pregunta->pregunta }}</textarea>
            </div>
          </div>

          <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300 tw:px-2"><span class="fa fa-book"></span> Módulo</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <select name="id_modulo" data-panel-etiqueta="el módulo" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                @foreach($modulos_pregunta as $m)
                  <option value="{{ $m->id_modulo }}" {{ $m->id_modulo == $pregunta->id_modulo ? 'selected' : '' }}>{{ $m->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300 tw:px-2"><span class="fa fa-sort-numeric-asc"></span> Número</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <input type="number" name="numero_pregunta" data-panel-etiqueta="el número de pregunta" min="1" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $pregunta->numero_pregunta }}">
            </div>
          </div>

        </div>
        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Regresar</button>
          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"><span class="fa fa-floppy-o"></span> Actualizar Pregunta</button>
        </div>
      </form>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_editar_pregunta").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
