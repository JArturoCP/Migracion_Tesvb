@section('modifica_carrera')

<main>
<x-panel.modal id="modal_modifica" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Modificación Carreras</h4>
      </div>
      <form class="" role="form" method="POST" action="/generales/carreras/{{ $carrera_edit->id_carrera }}" novalidate>
<div class="tw-modal-cuerpo">
  <input type="hidden" name="_method" value="PUT" />
          {{ csrf_field() }}
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                          <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[8.3333%] tw:px-2">
                     <div class="tw:mb-4">
                      <label for="nombre_carrera">Descripción</label>
                      <input type="text" value="{{ $carrera_edit->nombre }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="caja-error1" name="nombre_carrera" placeholder="Nombre..." style="text-transform:uppercase">
                      @if($errors -> has ('nombre_carrera'))
                          <span style="color:red;">{{ $errors -> first('nombre_carrera') }}</span>
                         <style>
                          #caja-error1
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
            </div>          
                  <div class="tw:w-full tw:lg:w-3/12 tw:lg:ml-[8.3333%] tw:px-2">
                    <div class="tw:mb-4">
                      <label for="color">Color</label>
                     <div id="cp1" class="colorpicker-component tw:flex tw:w-full tw:items-stretch">
                        <input name="color" type="text" value="{{ $carrera_edit->COLOR }}"class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" style="text-transform:uppercase" />
                        <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i></i></span>
                      </div>
                     @if($errors -> has ('color'))
                          <span style="color:red;">{{ $errors -> first('color') }}</span>
                         <style>
                          #caja-error
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
            </div>
          </div>
        
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="" id="modifica_carrera">Guardar</button>
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    
  
</x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_modifica").modal("show");

  });

</script>

@endsection