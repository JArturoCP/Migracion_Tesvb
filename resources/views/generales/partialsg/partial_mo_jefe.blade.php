@section('modifica_jefatura')

<main>
<x-panel.modal id="modal_modifica" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificación Jefaturas de División</h4>
      </div>
      <form class="" role="form" method="POST" action="/generales/jefaturas/{{ $jefe_edit->id_jefe_periodo }}" novalidate>
<div class="tw-modal-cuerpo">
  <input type="hidden" name="_method" value="PUT" />
          {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
              <div class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4"> 
                <label for="selectCarrera">Carrera</label> 
                <select name="selectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  @foreach($carreras as $carrera)
                  @if($carrera->id_carrera==$jefe_edit->id_carrera)
                  <option value="{{ $carrera->id_carrera }}" selected="selected">{{ $carrera->nombre }}</option>
                  @else
                  <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
                  @endif
                  @endforeach
                </select> 
            </div>
        </div>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                      <div class="cont tw:w-full tw:lg:w-5/12 tw:px-2">
            <div class="tw:mb-4"> 
                <label for="selectPersonal">Personal</label> 
                <select name="selectPersonal" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  @foreach($docentes as $docente)
                  @if($docente->id_personal==$jefe_edit->id_personal)
                  <option value="{{ $docente->id_personal }}" selected="selected">{{ $docente->nombre }}</option>
                  @else
                  <option value="{{ $docente->id_personal }}">{{ $docente->nombre }}</option>
                  @endif
                  @endforeach
                </select> 
            </div>
        </div>
                                      <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4"> 
                <label for="selectCargo">Cargo</label> 
                <select name="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                @if($jefe_edit->tipo_cargo==1)
                  <option value="1" selected="selected">JEFE</option>
                  <option value="2">ENCARGADO</option>
                @else
                  @if($jefe_edit->tipo_cargo==2)
                  <option value="2" selected="selected">ENCARGADO</option>
                  <option value="1">JEFE</option>
                  @else
                  <option value="1">JEFE</option>
                  <option value="2">ENCARGADO</option>
                  @endif
                @endif
                </select> 
            </div>
        </div>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
              <div class="tw:mb-4">
                  <label for="nombre_periodo">Periodo</label>
                  <input disabled type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" name="nombre_periodo" value="{{ $periodo }}">
              </div>
          </div>
            </div>
</div>
        
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="" id="modifica_situacion">Guardar</button>
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:dark:bg-white/3 tw:dark:text-gray-300" data-dismiss="modal">Cancelar</button>
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