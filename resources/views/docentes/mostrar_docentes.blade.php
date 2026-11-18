@extends('layouts.panel')
@section('title', 'Docentes')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true, 'blockui' => true])
@section('content')
    
<main class="tw:w-full tw:lg:w-full tw:px-2">

   <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
 $directivo=session()->has('directivo')?session()->has('directivo'):false;
 $consultas=session()->has('consultas')?session()->has('consultas'):false;
    $jefe_personal=session()->has('personal')?session()->has('personal'):false;?>


<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
    <x-panel.encabezado titulo="PERSONAL DEL TESVB" />  
  </div>

  <div class="cont tw:w-full tw:px-2">
    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">

            <thead>
              <tr>
                 {{-- @if( $jefe_personal!=null)
                      <th>Eliminar</th>
                  @endif--}}
                @if($directivo!=null || $consultas!=null || $jefe_personal!=null)
                  <th>Datos académicos</th>
                @endif
                  <th >Clave</th>
                  <th >Nombre Completo</th>
                  <th >Situacion</th>
                  <th >Origen de Nacimiento</th>
                  <th >Ingreso al TESVB</th>
                  <th >RFC</th>
                  <th >Fecha de Contratación</th>
                  @if($jefe_division!=null)
                  <th >Materias Perfil</th>
                  <th >Agregar Materias/Perfil</th>
                  @endif
                  @if($directivo!=null || $consultas!=null || $jefe_personal!=null  )
                  <th>Cargo</th>
                  <th>Perfil</th>
                  <th>Correo</th>
                  <th>Tel.</th>
                  <th>Cel.</th>
                  <th>Cédula</th>
                  <th>Esc. Procedencia</th>
                  <th>Fecha/Nac.</th>
                  <th>Dir.</th>
                  <th>Escolaridad</th>
                  <th>Hrs.Max</th>
                  <th>Sexo</th>
                  <th>Hrs.Max.Ingles</th>
                  @endif
              </tr>
            </thead>
            <tbody>

        @if($directivo!=null || $consultas!=null || $jefe_personal!=null)
          @foreach($docentes as $docente)
                    <tr>
                      {{--  @if($jefe_personal!=null)
                        <td>
                            <a class="eliminar_personal tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" data-id="{{ $docente->id_personal}}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                        </td>
                        @endif
                        --}}
                                    <td class="tw:text-center">
                  @if($docente->horas_maxima==0 &&$docente->id_cargo==0 || $docente->horas_maxima==0)
                  {{ "INCOMPLETO" }}<br>
                  <a class="edita tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" id="{{ $docente->id_personal }}"><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                  @else
                  {{ "COMPLETO" }}<br>
                  <a class="edita tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" id="{{ $docente->id_personal }}"><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                  @endif
                </td>  
                <td>{{ $docente->clave}}</td>              
                <td>{{ $docente->nombre}}</td>
                <td>{{ $docente->situacion }}</td>
                <td>{{ $docente->origen_nac }}</td>
                <td>{{ $docente->fch_ingreso_tesvb }}</td>
                <td>{{ $docente->rfc }}</td>
                <td>{{ $docente->fch_recontratacion }}</td>

                <td>{{ $docente->cargo }}</td>
                <td>{{ $docente->descripcion }}</td>
                <td>{{ $docente->correo }}</td>
                <td>{{ $docente->telefono }}</td>
                <td>{{ $docente->celular }}</td>
                <td>{{ $docente->cedula }}</td>
                <td>{{ $docente->esc_procedencia }}</td>              
                <td>{{ $docente->fch_nac }}</td>
                <td>{{ $docente->direccion}}</td>  
                <td>{{ $docente->escolaridad }}</td>
                <td>{{ $docente->horas_maxima }}</td>
                <td>{{ $docente->sexo }}</td>
                <td>{{ $docente->maximo_horas_ingles }}</td>   
            </tr>
          @endforeach
        @endif
          @if($jefe_division!=null)
            @foreach($docentesss as $docente)
                              <tr>  
                <td>{{ $docente["clave"]}}</td>              
                <td>{{ $docente["nombre"]}}</td>
                <td>{{ $docente["situacion"] }}</td>
                <td>{{ $docente["origen_nac"] }}</td>
                <td>{{ $docente["fch_ingreso_tesvb"] }}</td>
                <td>{{ $docente["rfc"] }}</td>
                <td>{{ $docente["fch_recontratacion"] }}</td>
                <td>
                  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                  <div class="tw:w-full tw:lg:w-full tw:px-2">
                    @foreach($docente["materias"] as $materia)
                    <div class="tw:w-full tw:lg:w-9/12 tw:px-2">
                      <p>{{ $materia["nombre_materia"]}}</p>                   
                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                      <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $materia["id_materia_perfil"] }}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>                    
                    </div> 
                    @endforeach           
                  </div> 
                  </div>  
                </td>
                <td class="tw:text-center">
                    <a class="agrega" id="{{ $docente ["id_personal"] }}" ><span class="fa fa-tags em2" aria-hidden="true"></span></a>
                </td>
              </tr>
            @endforeach
          @endif
            </tbody>
          </table>
</div> 
  </div>
  <!--@if($jefe_division!=null)
        <div>
        <a href="/docentes/create" data-toggle="tooltip" data-placement="left" title="AGREGAR DOCENTE" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600"><span class="fa fa-plus" aria-hidden="true"></span>
            </a>
        </div>
  @endif-->
</div>	
</main>

<!-- Modal para ver materias -->
<form id="form_ver_materias" class="" role="form" method="POST">
<x-panel.modal id="modal_materias" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="myModalLabel">MATERIAS</h4>
        </div>
        <div class="tw-modal-cuerpo">
          {{ csrf_field() }}
          <input type="hidden" id="prof" name="prof" value="">
          <input type="hidden" id="materias" name="materias" value="">
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
              <div id="contenedor_materias">

              </div>
          </div>
        </div>
                      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
              <button type="button" class="acepta tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Agregar</button>
          </div>
    
  
</x-panel.modal>
</form>

<!-- MODAL PARA EDITAR DOCENTES-->

  <x-panel.modal id="modal_editar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="myModalLabel">Datos Académicos</h4>
      </div>
      <div class="tw-modal-cuerpo">

        <div id="contenedor_editar">

        </div>    
      </div> <!-- modal body  -->

      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <input id="modifica_docente" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar" />
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
{{-- (se quitó un </div> sobrante del original que cerraba el área de contenido) --}}
<form action="" method="POST" role="form" id="form_eliminar">
    {{method_field('DELETE') }}
    {{ csrf_field() }}
</form>

<script>
function bloqueo()
{
    $.blockUI({
    //message: '<img src="/img/cargando.gif" />',
  });
        //setTimeout($.unblockUI, 4000); 
} 
$(document).ready(function() {

$("#paginar_table").on('click','.edita',function(){
  
  var idper=$(this).attr('id');

  $.get("/datos_academicos/"+idper,function(request)
  {
      $("#contenedor_editar").html(request);
      $("#modal_editar").modal("show");
  });
});

$("#modifica_docente").click(function(){
var hmi=$("#caja-error13").val(); //hrs_max_ingles
var hm=$("#caja-error12").val(); //hrs_maximas
var cargo=$("#selectCargo").val();

      window.location.href='/modifica_datos/'+cargo+'/'+hm+'/'+hmi;
});

  $('#paginar_table').DataTable();

      $("#paginar_table").on('click','.agrega',function(){
        var idprof=$(this).attr('id');
        $('#prof').val(idprof);
        $.get("/docentes/materias/"+idprof,function(request)
          {
            $("#contenedor_materias").html(request);
        });
        $('#modal_materias').modal('show');

      });

    $(".close").click(function(){
      $('#selectReticula').val($('#selectReticula > option:first').val());
    });

    $(".acepta").click(function(){
      bloqueo();
        var arreglo_materias=[];
        $("input[name='materia[]']:checked").each(function(){
          arreglo_materias[arreglo_materias.length]=$(this).val();        
        });
        $("#materias").val(arreglo_materias);

      $.post("/agrega/materias_perfil", $("#form_ver_materias").serialize(),function(request)
        {
          window.location.href='/docente';
          $('#modal_materias').modal('hide');
          $.unblockUI();
        });
    });
              $("#form_update_docente").validate({
            rules: {
            hrs_max: {
              required: true,
              },
            hrs_max_ingles: {
              required: true,
              },
            selectCargo: "required" 
        },            
          });


 $("#paginar_table").on('click','.elimina',function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            //TNotify.alert(id);
            $('#modal_elimina').modal('show');
        });

                $("#confirma_elimina").click(function(event){
          var id_doc=($(this).data('id'));
          $("#form_delete").attr("action","/docente/"+id_doc)      
          $("#form_delete").submit();
          });
});
$(".eliminar_personal").click(function(){
    var id=$(this).data('id');
    swal({
        title: "¿Seguro que desea eliminar?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $("#form_eliminar").attr("action","/docente/eliminar/"+id)
                $("#form_eliminar").submit();
            }
        });
});

</script> 
@endsection
