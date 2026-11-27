@section('modal_examen_create')

<main>
<!-- Modal para crear examen -->
<x-panel.modal id="modal_examen_create" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <form data-panel-envio action="{{ route('admin.examen_general.store') }}" method="POST">
        @csrf
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel"><i class="fa fa-graduation-cap"></i> NUEVO EXAMEN</h4>
        </div>
        <div class="tw-modal-cuerpo">

          <div class="tw:mb-4">
            <label><i class="fa fa-graduation-cap"></i> Carrera</label>
            <select name="id_carrera" data-panel-etiqueta="la carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
              @foreach($carreras as $c)
                <option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="tw:mb-4">
            <label><i class="fa fa-pencil"></i> Nombre del examen</label>
            <input type="text" name="nombre" data-panel-etiqueta="el nombre del examen" maxlength="255" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ej. Examen Final Matemáticas" required>
          </div>

        </div>
        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancelar</button>
          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"><i class="fa fa-floppy-o"></i> Guardar</button>
        </div>
      </form>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_examen_create").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
