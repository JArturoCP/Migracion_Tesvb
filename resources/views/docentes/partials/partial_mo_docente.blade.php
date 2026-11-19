
<div>
<form id="form_update_docente" class="" role="form" method="POST">
          {{ csrf_field() }}
              <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                  <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                     <div class="tw:mb-4">
                      <label for="nombre_docente">Nombre Completo:</label>
                      <input type="text" value="{{ $docente_edit->nombre }}" disabled class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" id="caja-errorm" name="nombre_docente">
                    </div>
                  </div>          
                  <div class="tw:w-full tw:lg:w-5/12 tw:px-2" style="margin-left: 32px;">
                    <div class="tw:mb-4">
                      <label for="clave">Clave docente:</label>
                      <input type="text" value="{{ $docente_edit->clave }}" disabled class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" id="caja-error" name="clave">
                    </div>
                  </div>
                                  <div class="cont tw:w-full tw:lg:w-4/12 tw:px-2">
                    <div class="tw:mb-4">
                      <label for="hrs_max">Horas Maximas</label>
                      <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" value="{{ $docente_edit->horas_maxima }}" id="caja-error12" name="hrs_max" placeholder="Horas M..">
                      @if($errors -> has ('hrs_max'))
                          <span style="color:red;">{{ $errors -> first('hrs_max') }}</span>
                         <style>
                          #caja-error12
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
              </div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
  <div class="tw:w-full tw:lg:w-full tw:px-2">
                  <div class="tw:w-full tw:lg:w-6/12 tw:px-2" style="margin-left: 32px;"> 
                    <div class="tw:mb-4">  
                      <div class="dropdown">
                        <label for="selectCargo">Cargo</label>
                                <select name="selectCargo" id="selectCargo"class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected>Selecciona...</option>
                                    @foreach($cargos as $cargo)
                                      @if($cargo->id_cargo==$docente_edit->id_cargo)
                                        <option value="{{$cargo->id_cargo}}" selected="selected" >{{$cargo->cargo}}</option>
                                      @else
                                        <option value="{{$cargo->id_cargo}}" >{{$cargo->cargo}}</option>
                                      @endif
                                    @endforeach
                                </select>
                    </div>  
                  </div>
                  </div>
               <div class="cont tw:w-full tw:lg:w-4/12 tw:px-2">
                    <div class="tw:mb-4">
                      <label for="hrs_max_ingles">Hrs Max. Ingles</label>
                      <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700"  value="{{ $docente_edit->maximo_horas_ingles }}" id="caja-error13" name="hrs_max_ingles" placeholder="Horas M..">
                      @if($errors -> has ('hrs_max_ingles'))
                          <span style="color:red;">{{ $errors -> first('hrs_max_ingles') }}</span>
                         <style>
                          #caja-error13
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div> 
  </div>
</div>
</form>
</div>



<script>
$(document).ready(function(){
    
  });
</script>