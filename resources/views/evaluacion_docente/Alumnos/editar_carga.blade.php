@section('editar_carga')

<main>
  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
      <x-panel.modal id="modal_edit_actalu" tamano="md" sin-relleno clase-cerrar="close" estatico aria-labelledby="myModalLabel">


          <div class="tw:px-6 tw:pt-6 tw:pr-14">
          {{--  
            --}}
              <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificación de Actividad</h3>
          </div>


            <div class="tw-modal-cuerpo">
              <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                  <form  id="modificar_actalu" role="form" method="POST" action="/checar_cargau/{{$consultaedit->id_carga_academica}}" novalidate>
                    <input type="hidden" name="_method" value="PUT"/>
                      {{csrf_field()}}  

                      <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:lg:w-full tw:px-2">
                        
                          <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                  <label >Status</label>
                                  <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="status" id="status">
                                   @if($consultaedit->id_status_materia==1)
                                      <option value="1" selected="selected">ALTA</option>
                                  @endif
                                  @if($consultaedit->id_status_materia==2)
                                      <option value="1">ALTA</option>
                                  @endif
                                  </select>


                          </div>

                          <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                  <label >Tipo Cursa</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo" id="tipo">
                      @if($consultaedit->id_tipo_curso==1)
                        <option value="1" selected="selected">Normal</option>
                        <option value="2">Repeticion</option>
                        <option value="3">Especial</option>
                        <option value="4">Gloval</option>
                        @endif
                           @if($consultaedit->id_tipo_curso==2)
                        <option value="1" >Normal</option>
                        <option value="2" selected="selected">Repeticion</option>
                        <option value="3">Especial</option>
                        <option value="4">Gloval</option>
                        @endif
                           @if($consultaedit->id_tipo_curso==3)
                        <option value="1">Normal</option>
                        <option value="2">Repeticion</option>
                        <option value="3" selected="selected">Especial</option>
                        <option value="4">Gloval</option>
                        @endif
                           @if($consultaedit->id_tipo_curso==4)
                        <option value="1">Normal</option>
                        <option value="2">Repeticion</option>
                        <option value="3">Especial</option>
                        <option value="4" selected="selected">Global</option>
                        @endif
                      </select>


                          </div>

                          <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                              <label >Grupo</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="grupo" id="grupo">
                      @if($consultaedit->grupo==1)
                        <option value="1" selected="selected">{{$semestre->id_semestre}}01</option>
                        <option value="2">{{$semestre->id_semestre}}02</option>
                        <option value="3">{{$semestre->id_semestre}}03</option>
                                <option value="4" selected="selected">{{$semestre->id_semestre}}04</option>
                        
                        @endif
                           @if($consultaedit->grupo==2)
                        <option value="1" >{{$semestre->id_semestre}}01</option>
                        <option value="2" selected="selected">{{$semestre->id_semestre}}02</option>
                        <option value="3">{{$semestre->id_semestre}}03</option>
                              <option value="4" selected="selected">{{$semestre->id_semestre}}04</option>
                        @endif
                           @if($consultaedit->grupo==3)
                        <option value="1">{{$semestre->id_semestre}}01</option>
                        <option value="2">{{$semestre->id_semestre}}02</option>
                        <option value="3" selected="selected">{{$semestre->id_semestre}}03</option>
                              <option value="4" selected="selected">{{$semestre->id_semestre}}04</option>
                      
                        @endif
                          @if($consultaedit->grupo==4)
                              <option value="1">{{$semestre->id_semestre}}01</option>
                              <option value="2">{{$semestre->id_semestre}}02</option>
                              <option value="3" selected="selected">{{$semestre->id_semestre}}03</option>
                              <option value="4" selected="selected">{{$semestre->id_semestre}}04</option>
                          @endif

                        </select>

                          </div>     
                      </div>



              </div>
            </div>

             
                                

             <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6" >
              <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  id="modifica_actalu">Guardar</button>
              <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="cerrar_modal">Cancelar</button>
            </div>

            </form>

              


          </div>
        </x-panel.modal>
  </div>
</main>


<script>
  $(document).ready(function(){

     $("#modal_edit_actalu").modal("show");
      $('#modal_edit_actalu').modal({backdrop: 'static', keyboard: false})

      $("#cerrar_modal").click(function (){
          var link="/checar_carga";
          window.location.href=link;
      });

  
       

    


    });
</script>
@endsection
