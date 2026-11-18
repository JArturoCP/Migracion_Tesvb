 <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
 $directivo=session()->has('directivo')?session()->has('directivo'):false; ?>

<div>

<ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200" role="tablist">
  @foreach($semestres as $semes)
    @if($semes["id_semestre"]==1)
      <li role="presentation" class="active"><a href="#{{ $semes["id_semestre"] }}s" aria-controls="profile" role="tab" data-toggle="tab">{{ $semes ["semestre"]}}</a></li>
    @else
      <li role="presentation"><a href="#{{ $semes["id_semestre"] }}s" aria-controls="profile" role="tab" data-toggle="tab">{{ $semes ["semestre"]}}</a></li>
    @endif
  @endforeach
</ul>


        <!-- Tab panes -->
    <div class="tab-content">
        @foreach($semestres as $semes)
                     <div role="tabpanel" class="tab-pane fade <?php if($semes["id_semestre"]==1) echo"in active"; ?>" id="{{ $semes["id_semestre"] }}s">
            <div style="margin-top:1em;" class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:text-center tw:lg:w-5/12 tw:lg:ml-[25%] tw:px-2">
                <h4 >Materias de {{ $semes["semestre"] }}</h4>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
              <div class="tw:w-full tw:lg:w-full tw:md:w-1/12 tw:px-2">
            @foreach($semes["materias"] as $materias)
                <div class="materia tw:w-full tw:lg:w-2/12 tw:text-center tw:px-2">
                  {{ $materias["materia"]}}<br>
                    {{ $materias["clave"] }}<br>
                    {{ $materias["hrs_t"]}}-{{ $materias["hrs_p"]}}-{{ $materias["creditos"]}}
                  @if($jefe_division!=null)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-2/12 tw:lg:ml-[25%] tw:px-2">
                            <a class="editar tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" id="{{ $materias["id_materia"]}}" ><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                        </div>
                        <!--<div class="tw:w-full tw:lg:w-2/12 tw:lg:ml-[8.3333%] tw:px-2">
                            <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $materias["id_materia"]}}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                        </div> -->
                    </div> 
                  @endif

                </div>
          @endforeach
              </div>         
            </div>
          </div>
        @endforeach
    </div>
@if($jefe_division==1)
       <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:text-center">
        <button data-toggle="modal" id="abre_modal" data-tooltip="true" data-placement="left" title="Agrega una materia" data-target="#agrega_materias" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
        <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>

      <!--<div class="ml tw:w-full tw:lg:w-3/12 tw:lg:ml-[41.6667%] tw:px-2">
        <button id="recoje_combo" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base"><span class="fa fa-file-o" aria-hidden="true"></span> Ver PDF</button>
      </div>-->
@endif
</div>

<!-- MODAL PARA EDITAR MATERIAS -->
  <x-panel.modal id="modal_editar" tamano="md" sin-relleno aria-labelledby="myModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="myModalLabel" style="text-align: center">Modificación Materias</h4>
      </div>
      <div class="tw-modal-cuerpo">
          <div id="warnin" class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert" style="display:none">
              <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>El número de hrs. es incorrecto</strong>
  </div>
        <div id="contenedor_editar">

        </div>    
      </div> <!-- modal body  -->

      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <!--<input id="modifica_materia" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar" />-->
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
      </div>

    
  
</x-panel.modal>

<!-- MODAL PARA ELIMINAR -->
<x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
      <form action="" method="POST" role="form" id="form_delete">
<div class="tw-modal-cuerpo tw:pt-12">

 {{method_field('DELETE') }}
  {{ csrf_field() }}
        ¿Realmente deseas eliminar éste elemento?
      </div>
            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <input id="confirma_elimina" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Aceptar"></input>
      </div>
</form>
      
    
  </x-panel.modal>
{{-- (se quitó un </div> sobrante del original) --}}

      <script>
  $(document).ready(function(){

    $("#modal_modifica").modal("show");

$("#modifica_materia").click(function(){

          var hp=$("#hrs_p").val();
          var ht=$("#hrs_t").val();

          if(hp==0 && ht==0)
          {
            $("#warnin").show(1000);
          }
          else
          {
            if($("#nombrem").valid()&&$("#clavem").valid()&&$("#nombrem").valid()&&$("#creditos").valid()&&
              $("#hrs_p").valid()&&$("#hrs_t").valid()&&$("#unidades").valid()&&$("#espe").valid())
            {
              $("#warnin").hide(1000);
              $("#form_update_materia").submit(); 
            }
          } 
        });

         $("#abre_modal").click(function(){
            var id_reticula= $("#selectReticula").val();
            $("#reticula").val(id_reticula);
        });

      $(".editar").click(function(){
        var idmat=$(this).attr('id');

        $.get("/reticulasmo/"+idmat+"/edit",function(request)
            {
              $("#contenedor_editar").html(request);
              $("#modal_editar").modal("show");
            });

        });

                    $(".elimina").click(function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            $('#modal_elimina').modal('show');
        });
              
          $("#confirma_elimina").click(function(event){
          var id_mat=($(this).data('id'));
          $("#form_delete").attr("action","/reticulass/"+id_mat);      
          $("#form_delete").submit();
         /*$.get("/reticulass_elimina/"+id_mat,function(request)
            {
              //$("#contenedor_materias").html(request);
              $('.modal-backdrop').remove();
              //$("#modal_editar").modal("show");
            });*/
        });

$("#form_update_materia").validate(
  {
    rules: 
    {
      nombre_materia: 
      {
        required: true,
      },
      clave_materia:
      {
        required: true,
      },
      semestre : "required",
            hrs_p : "required",  
            hrs_t : "required",
            uni : "required",
            especial : "required" ,
            creditos: "required" 
    },            
  });

  });

</script>

