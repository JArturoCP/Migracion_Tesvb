 @extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')




<script type="text/javascript">



  $(document).ready(function() {


      $('#ejemplo').DataTable();

$(".elimina").click(function(){
            //TNotify.alert('hola');
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            
            $('#modal_elimina').modal('show');
        });


$("#confirma_elimina").click(function(event){
          var id_sit=($(this).data('id'));
          $("#form_delete").attr("action","/personales/"+id_sit)      
          $("#form_delete").submit();
          });       

  
} );

</script>

<main>

<div class="tw:w-full tw:px-2">
    <x-panel.encabezado titulo="ASIGNACIÓN DE PERMISOS" />
  </div>


  <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">

      


                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table id="ejemplo" class="tw-tabla tw-tabla-bordes" >
                                   <thead>
                                          <tr>
                                                  <th>NOMBRE</th>
                                                
                                                  <th>CLAVE</th>
                                                  <th>CORREO</th>
                                                  <th>PERMISO</th>
                                                  <th>MODIFICAR</th>
                                                  <th>ELIMINAR</th>

                                                  
                                           </tr>
                                    </thead>
                                    <tbody>

                                            @foreach($personal as $per)
                                          <tr>
                                                  <th>{{$per->nombre}}</th>
                                                  <th>{{$per->clave}}</th>
                                                   <th>{{$per->correo}}</th>
                                                    <th>{{$per->id_departamento}}</th>
                                                  <th class="tw:text-center"><a href="/personales/{{$per->id_personal}}/edit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50"><span class="fa fa-cog em6" aria-hidden="true" ></span></a></th>
                                                  <th class="tw:text-center"><a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{$per->id_personal}}"><span class="fa fa-trash em6" aria-hidden="true" ></span></a></th>
                                                  
                                          </tr>
                                          @endforeach

                                         
    
                                   </tbody>
                            </table>
</div>

                
       </div>



   @if(isset($edit))
  @section('editar_personal')
  @include('editar_personal')
  @show
  @endif
                     
  <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
      <form action="" method="POST" role="form" id="form_delete">
<div class="tw-modal-cuerpo tw:pt-12">
        
         {{method_field('DELETE') }}
          {{ csrf_field() }}
                ¿Realmente deseas eliminar a este usuario?
              </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                <input id="confirma_elimina" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Aceptar"></input>
              </div>
        </form>
      
    
  </x-panel.modal>
{{-- (se quitó un </div> sobrante del original que cerraba el área de contenido) --}}
      
</main>
@endsection