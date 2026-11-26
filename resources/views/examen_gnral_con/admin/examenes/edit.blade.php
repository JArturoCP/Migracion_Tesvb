@section('modal_examen_edit')

<main>
<!-- Modal para editar examen -->
<div class="modal fade tw-modal-compat" id="modal_examen_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form data-panel-envio action="{{ route('admin.examen_general.update',$examen->id_examen_egel) }}" method="POST">
        @csrf
        <div class="modal-header tw:bg-sky-100">
          <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> EDITAR EXAMEN</h4>
        </div>
        <div class="modal-body">

          <div class="tw:mb-4">
            <label><i class="fa fa-graduation-cap"></i> Carrera</label>
            <select name="id_carrera" data-panel-etiqueta="la carrera" required class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
              @foreach($carreras as $c)
                <option value="{{ $c->id_carrera }}" {{ $examen->id_carrera == $c->id_carrera ? 'selected' : '' }}>{{ $c->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="tw:mb-4">
            <label><i class="fa fa-file"></i> Nombre del examen</label>
            <input type="text" name="nombre" data-panel-etiqueta="el nombre del examen" maxlength="255" value="{{ $examen->nombre }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ingrese el nombre del examen" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancelar</button>
          <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"><i class="fa fa-floppy-o"></i> Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_examen_edit").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
