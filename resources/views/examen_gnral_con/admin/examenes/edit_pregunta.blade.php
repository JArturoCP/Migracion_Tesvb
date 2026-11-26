@section('modal_editar_pregunta')

<main>
<!-- Modal para editar pregunta -->
<div class="modal fade bs-example-modal-lg tw-modal-compat" id="modal_editar_pregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form data-panel-envio action="{{ route('admin.examen_general.pregunta.update', $pregunta->id_pregunta) }}" method="POST" class="">
        @csrf
        <div class="modal-header tw:bg-sky-100">
          <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil-square-o"></span> EDITAR PREGUNTA</h4>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_examen_egel" value="{{ $pregunta->id_examen_egel }}">

          <div class="tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2"><span class="fa fa-pencil"></span> Pregunta</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <textarea name="pregunta" data-panel-etiqueta="el texto de la pregunta" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" rows="4" placeholder="Escribe la pregunta aquí" style="resize:none;">{{ $pregunta->pregunta }}</textarea>
            </div>
          </div>

          <div class="tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2"><span class="fa fa-book"></span> Módulo</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <select name="id_modulo" data-panel-etiqueta="el módulo" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                @foreach($modulos_pregunta as $m)
                  <option value="{{ $m->id_modulo }}" {{ $m->id_modulo == $pregunta->id_modulo ? 'selected' : '' }}>{{ $m->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="tw:mb-4">
            <label class="tw:w-full tw:md:w-2/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2"><span class="fa fa-sort-numeric-asc"></span> Número</label>
            <div class="tw:w-full tw:md:w-10/12 tw:px-2">
              <input type="number" name="numero_pregunta" data-panel-etiqueta="el número de pregunta" min="1" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $pregunta->numero_pregunta }}">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Regresar</button>
          <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"><span class="fa fa-floppy-o"></span> Actualizar Pregunta</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_editar_pregunta").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
