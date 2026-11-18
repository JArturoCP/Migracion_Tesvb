@section('modifica_aula')

<main>
<x-panel.modal id="modal_modifica" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Modificación de Aulas</h4>
      </div>
      <form class="" role="form" method="POST" action="/generales/aulas/{{ $aula_edit->id_aula }}" novalidate>
<div class="tw-modal-cuerpo">
  <input type="hidden" name="_method" value="PUT" />
          {{ csrf_field() }}
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
              <div class="cont tw:w-full tw:lg:w-5/12 tw:px-2">
                <div class="tw:mb-4">
                    <label for="nombre_aula">Nombre del Aula</label>
                    <input type="text" value="{{ $aula_edit->nombre }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="caja-error" name="nombre_aula" placeholder="Nombre..." style="text-transform:uppercase">
                    @if($errors -> has ('nombre_aula'))
                        <span style="color:red;">{{ $errors -> first('nombre_aula') }}</span>
                        <style>
                        #caja-error
                        {
                          border:solid 1px red;
                        }
                        </style>
                    @endif
                </div>
              </div>
                                    <div class="tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <div class="tw:inline-flex tw:gap-2">
                          <label for="selectEstado">Estado</label>
                                <select name="selectEstado" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona...........</option>
                                    @if($aula_edit->comp==1)
                                      <option value="1" selected="selected">Compartida</option>
                                      <option value="0">No Compartida</option>
                                      @else
                                        @if($aula_edit->comp==0)
                                          <option value="0" selected="selected">No Compartida</option>
                                          <option value="1">Compartida</option>
                                          @endif
                                    @endif
                                </select>
                        </div>
                      </div>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="cont tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <div class="tw:inline-flex tw:gap-2">
                          <label for="selectEdificio">Edificio</label>
                                <select name="selectEdificio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona...</option>
                                    @foreach($edificios as $edificio)
                                      @if($aula_edit->id_edificio==$edificio->id_edificio)
                                            <option value="{{$edificio->id_edificio}}" selected="selected">{{$edificio->nombre}}</option>
                                      @else
                                      <option value="{{$edificio->id_edificio}}">{{$edificio->nombre}}</option>
                                      @endif
                                    @endforeach
                                </select>
                        </div>
                      </div>
                      <div class="tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <div class="tw:inline-flex tw:gap-2">
                          <label for="dropdown">Carrera</label>
                                <select name="selectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona...</option>
                                    @foreach($carreras as $carrera)
                                    @if($aula_edit->id_carrera==$carrera->id_carrera)
                                            <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                      @else
                                        <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                    @endif
                                    @endforeach
                                </select>
                        </div>
                      </div> 
            </div>
          </div>
        
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="modifica_situacion">Guardar</button>
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