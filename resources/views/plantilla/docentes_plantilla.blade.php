@extends('layouts.panel')
@section('title', 'Docentes en Plantilla')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="DOCENTES EN PLANTILLA" />

    <div class="tw:grid tw:grid-cols-1 tw:gap-6 tw:lg:grid-cols-12">
        <div class="tw:lg:col-span-7">
            <x-panel.tarjeta titulo="PROFESORES" sin-relleno>
                <x-panel.tabla id="paginar_table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Perfil</th>
                            <th>Fecha/Recontrato</th>
                            <th class="tw:text-center">A Plantilla</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($docentes as $docente)
                        <tr>
                            <td>{{ $docente->clave }}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $docente->nombre }}</td>
                            <td>{{ $docente->descripcion }}</td>
                            <td>{{ $docente->fch_recontratacion }}</td>
                            <td class="tw:text-center">
                                <a class="agrega tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" id="{{ $docente->id_personal }}" title="Agregar a plantilla">
                                    <span class="fa fa-sign-in em2" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>  
                        @endforeach                     
                    </tbody>
                </x-panel.tabla>
            </x-panel.tarjeta>
        </div>

        <div class="tw:lg:col-span-5">
            <x-panel.tarjeta titulo="PROFESORES EN PLANTILLA" sin-relleno>
                <x-panel.tabla>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="tw:text-center">Eliminar</th>
                            <th class="tw:text-center">Materias/Perfil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plantillas as $plantilla)
                        <tr>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $plantilla->nombre }}</td>
                            <td class="tw:text-center">
                                <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $plantilla->id_personal }}" title="Eliminar">
                                    <span class="fa fa-trash em2" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td class="tw:text-center">
                                <a class="materias tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" id="{{ $plantilla->id_personal }}" title="Materias">
                                    <span class="fa fa-list-alt em2" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>
            </x-panel.tarjeta>
        </div>
    </div>
</main>

<!-- MODAL PARA ELIMINAR -->
<div id="modal_elimina" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="" method="POST" role="form" id="form_delete">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          ¿Realmente deseas eliminar éste elemento?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input id="confirma_elimina" type="button" class="btn btn-danger" value="Aceptar"></input>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal para ver materias -->
<form id="form_ver_materias" class="form" role="form" method="POST">
<div class="modal fade bs-example-modal-lg" id="modal_materias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">MATERIAS</h4>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" id="prof" name="prof" value="">
          <input type="hidden" id="materias" name="materias" value="">
          <div class="row">
              <div id="contenedor_materias"></div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary acepta">Agregar</button>
        </div>
    </div>
  </div>
</div>
</form>

<!-- MODAL PARA AGREGAR DOCENTES A PLANTILLA -->
<div id="modal_agrega" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabelAgrega">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="form_docente_crea" class="form" role="form" method="POST" action="/plantilla/docentes">
          {{ csrf_field() }}
          <input type="hidden" id="docente" name="docente" value="" />
          ¿Realmente deseas agregar a éste docente a plantilla?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input id="confirma_agrega" type="button" class="btn btn-success" value="Aceptar"></input>
      </div>
        </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#paginar_table').DataTable();
  
    $(".materias").click(function(){
        var idprof=$(this).attr('id');
        $('#prof').val(idprof);
        $.get("/docentes/materias/"+idprof,function(request) {
            $("#contenedor_materias").html(request);
        });
        $('#modal_materias').modal('show');
    });

    $(".elimina").click(function(){
        var id=$(this).attr('id');
        $('#confirma_elimina').data('id',id);
        $('#modal_elimina').modal('show');
    });

    $("#paginar_table").on('click','.agrega',function(){
        var id=$(this).attr('id');
        $('#docente').val(id);
        $('#modal_agrega').modal('show');
    });

    $("#confirma_elimina").click(function(event){
        var id_docente=($(this).data('id'));
        $("#form_delete").attr("action","/plantilla/docentes/"+id_docente);
        $("#form_delete").submit();
    });

    $("#confirma_agrega").click(function(event){    
        $("#form_docente_crea").submit();
    });

    $(".acepta").click(function(){
        var arreglo_materias=[];
        $("input[name='materia[]']:checked").each(function(){
            arreglo_materias[arreglo_materias.length]=$(this).val();        
        });
        $("#materias").val(arreglo_materias);

        $.post("/agrega/materias_perfil", $("#form_ver_materias").serialize(),function(request) {
            window.location.href='/plantilla/docentes';
            $('#modal_materias').modal('hide');
        });
    });
});
</script>

@endsection
