@section('editar_personal')

<main>
  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <x-panel.modal id="modal_edit_actalu" tamano="md" sin-relleno aria-labelledby="myModalLabel">


          <div class="tw:px-6 tw:pt-6 tw:pr-14">
            
              <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center" id="myModalLabel">Modificación de Actividad</h3>
          </div>


            <div class="tw-modal-cuerpo">
              <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:p-5 tw:sm:p-6">

                  <form class=""  id="modificar_actalu" role="form" method="POST" action="/personalesu/{{$consultaedit->id_personal}}" novalidate>
                    <input type="hidden" name="_method" value="PUT"/>
                      {{csrf_field()}}  

                      <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                          <label for="exampleInputEmail1">{{$consultaedit->nombre}}</label>
                        </div>
                        <div class="tw:mb-4 tw:w-full tw:md:w-full tw:lg:w-full tw:xl:w-full tw:px-2">
                            <label for="exampleInputEmail1">Tipo de Permiso<b style="color:red; font-size:23px;">*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="permiso">

                        @if($consultaedit->id_departamento==0)
                        <option  value="0">sin permisos</option>

                          @foreach($combo as $co)
                       
                            <option  value="{{$co->id_departamento}}">{{$co->nombre_departamento}}</option>
                           @endforeach
                       
                        @else
                       <option  value="0">sin permisos</option>

                       @foreach($combo as $co)
                             @if($consultaedit->id_departamento == $co->id_departamento)
                             <option  selected value="{{$co->id_departamento}}">{{$co->nombre_departamento}}</option>
                             @else
                             <option  value="{{$co->id_departamento}}">{{$co->nombre_departamento}}</option>
                            
                             @endif
                         @endforeach
                      @endif
                    </select>
                    </div>
                     </div>



                      
             
                                
                    
             <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6" >
              <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="" id="modifica_actalu">Aceptar</button>
              <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
            </div>

           </form>

                </div>
              </div>
            </div>

                
          
        
      </x-panel.modal>
    </div>
  </div>
</main>


<script>
  $(document).ready(function(){

     $("#modal_edit_actalu").modal("show");

  
       

    


    });
</script>
@endsection
