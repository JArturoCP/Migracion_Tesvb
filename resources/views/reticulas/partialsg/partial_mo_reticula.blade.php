
<div>
<form id="form_update_materia" class="" role="form" method="POST" action="/reticulass/{{ $materia_edit->id_materia }}">
  <input type="hidden" name="_method" value="PUT" />
          {{ csrf_field() }}
              <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                  <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                     <div class="tw:mb-4">
                      <label for="nombre_materia">Nombre de la Materia:</label>
                      <input type="text" value="{{ $materia_edit->nombre }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" id="nombrem" name="nombre_materia"placeholder="Materia" style="text-transform:uppercase">
                      @if($errors -> has ('nombre_materia'))
                          <span style="color:red;">{{ $errors -> first('nombre_materia') }}</span>
                         <style>
                          #nombrem
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>          
                  <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                    <div class="tw:mb-4">
                      <label for="clave_materia">Clave de la Materia:</label>
                      <input type="text" value="{{ $materia_edit->clave }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" id="clavem" name="clave_materia" placeholder="Clave" style="text-transform:uppercase">
                      @if($errors -> has ('clave_materia'))
                          <span style="color:red;">{{ $errors -> first('clave_materia') }}</span>
                         <style>
                          #clavem
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
              </div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
  <div class="cont tw:w-full tw:lg:w-full tw:px-2">
                       <div class="ml tw:w-full tw:lg:w-3/12 tw:px-2"> 
                  <div class="tw:mb-4">              
                         <label for="creditos">Creditos</label> 
                                <select name="creditos" id="creditos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected >Elige...</option>
                                  @for ($i = 1; $i <=10; $i++)
                                    @if($i==$materia_edit->creditos)
                                    <option value="{{ $i }}" selected="selected">{{ $i }}</option>
                                    @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                  @endfor
                                </select> 
                    </div> 
                  </div>

                  <div class="cont ml tw:w-full tw:lg:w-3/12 tw:px-2">
                      <div class="tw:mb-4">
                          <label for="hrs_t">Hrs.Teoria</label>
                          <select name="hrs_t" id="hrs_t" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                              <option disabled selected >Elige...</option>
                              @for ($i = 0; $i <=6; $i++)
                                  @if($i==$materia_edit->hrs_teoria)
                                      <option value="{{ $i }}" selected="selected">{{ $i }}</option>
                                  @else
                                      <option value="{{ $i }}">{{ $i }}</option>
                                  @endif
                              @endfor
                          </select>
                      </div>

                  </div>
                  <div class="ml cont tw:w-full tw:lg:w-3/12 tw:px-2">
                      <div class="tw:mb-4">
                          <label for="hrs_p">Hrs.Practicas</label>
                          <select name="hrs_p" id="hrs_p" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                              <option disabled selected>Elige...</option>
                              @for ($i = 0; $i <=6; $i++)
                                  @if($i==$materia_edit->hrs_practicas)
                                      <option value="{{ $i }}" selected="selected">{{ $i }}</option>
                                  @else
                                      <option value="{{ $i }}">{{ $i }}</option>
                                  @endif
                              @endfor
                          </select>
                      </div>
                  </div>
  </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
  <div clas="col-md-12">
    <div class="ml tw:w-full tw:lg:w-3/12 tw:lg:ml-[8.3333%] tw:px-2">
                  <div class="tw:mb-4">              
                         <label for="uni">Unidades</label> 
                                <select name="uni" id="unidades" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected >Elige...</option>
                                  @for ($i = 1; $i <=10; $i++)
                                    @if($i==$materia_edit->unidades)
                                    <option value="{{ $i }}" selected="selected">{{ $i }}</option>
                                    @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                  @endfor
                                </select> 
                    </div> 
                  </div>
                    <div class="ml cont tw:w-full tw:lg:w-3/12 tw:px-2"> 
                  <div class="tw:mb-4">              
                         <label for="especial">Especial</label> 
                                <select name="especial" id="espe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected >Elige...</option>
                                    @if($materia_edit->especial==1)
                                      <option value="1" selected="selected">Si</option>
                                      <option value="0">No </option>
                                      @else
                                        @if($materia_edit->especial==0)
                                          <option value="0" selected="selected">No </option>
                                          <option value="1">Si</option>
                                          @endif
                                    @endif
                                </select> 
                    </div> 
                  </div> 
                      <div class="cont ml tw:w-full tw:lg:w-3/12 tw:px-2" style="<?php if($no_ver==1){ echo "display:none"; } ?>">
                         <div class="tw:mb-4"> 
                         <label for="semestre">Semestre</label> 
                                <select name="semestre" id="sem" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected>Elige...</option>
                                  @foreach($semestres as $semestre)
                                      @if($materia_edit->id_semestre==$semestre->id_semestre)
                                            <option value="{{$semestre->id_semestre}}" selected="selected">{{$semestre->descripcion}}</option>
                                      @else
                                      <option value="{{$semestre->id_semestre}}">{{$semestre->descripcion}}</option>
                                      @endif
                                    @endforeach
                                </select> 
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