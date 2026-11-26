@extends('layouts.panel')
@section('title', 'DocenteActividad')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="DOCENTES EN ACTIVIDADES" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-target="#nuevo_docente" data-toggle="modal" tipo="primario" tamano="sm">
                <span class="fa fa-plus" aria-hidden="true"></span> Asignar Docente
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla class="tabla-grande2">
            <thead>
                <tr>
                    <th>Nombre de Actividad</th>
                    <th>Categoría</th>
                    <th>Número de Horas</th>
                    <th>Docente</th>
                    <th class="tw:text-center">Editar</th>
                    <th class="tw:text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docentes_tabla as $docente)
                <tr>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$docente->descripcion}}</td>
                    <td>{{$docente->descripcion_cat}}</td>
                    <td>{{$docente->horas}}</td>
                    <td>{{$docente->titulo}} {{$docente->nombre}}</td>
                    <td class="tw:text-center">
                        <a href="{{url("/docente_actividad/".$docente->id_docente_actividad."/edit")}}" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Editar">
                            <span class="fa fa-cog em" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="tw:text-center">
                        <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{$docente->id_docente_actividad}}" title="Eliminar">
                            <span class="fa fa-trash em" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

@if(isset($editar_docente))
    @section('editar_docente')
    @include('actividades_complementarias.partials_actividades.jefatura.editar_docente')
    @show
@endif

<!-- Modal PARA AGREGAR NUEVO DOCENTE -->
<form method="POST" role="form" class="form" id="docente_actividad">
    {{csrf_field()}}
    <div class="modal fade" id="nuevo_docente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title text-center" id="myModalLabel">Asignar Docente</h3>
                </div>
                <div class="modal-body">
                    <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="categoria_docente">Categoría</label>
                                <select class="form-control" name="categoria_docente" id="categoria_docente">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                    @foreach($categorias as $categorias)
                                        <option value="{{$categorias->id_categoria}}">{{$categorias->descripcion_cat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="actividad_docente">Actividad</label>
                                <select class="form-control" name="actividad_docente" id="actividad_docente">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                </select>
                            </div>
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="horas_docente">Número de Horas</label>
                                <input class="form-control" name="horas_docente" type="text" id="horas_docente" value="" placeholder="Horas" disabled>
                            </div>
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="docente">Docente Asignado</label>
                                <select class="form-control" name="docente">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                    @foreach($docentes as $docentes)
                                        <option value="{{$docentes->id_personal}}">{{$docentes->titulo}} {{$docentes->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="registra">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL PARA ELIMINAR -->
<div id="modal_elimina" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="" method="POST" role="form" id="form_delete">
            {{method_field('DELETE') }}
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

</main>

<script>
$(document).ready(function(){
    var carrera={!!$carrera!!};

    $(".elimina").click(function(){
        var id=$(this).attr('id');
        $('#confirma_elimina').data('id',id);
        $('#modal_elimina').modal('show');
    });

    $("#registra").click(function(event){
        $("#docente_actividad").submit();
    });

    $("#docente_actividad").validate({
        rules:{
            categoria_docente: "required",
            actividad_docente:"required",
            docente: "required",
        },
    });

    $('#categoria_docente').on('change', function(e) {
        var id_actividad=e.target.value;

        $.get('/docente_nueva_actividad?id_actividad=' +id_actividad,function(data){
            $('#actividad_docente').empty();
            $.each(data,function(docente_actividad,subCatObj){
                if(subCatObj.estado==1 && subCatObj.id_jefatura==carrera)
                {
                    $('#actividad_docente').append(
                        '<option value="'+subCatObj.id_actividad_comple+'" data-horas="'+subCatObj.horas+'">'+subCatObj.descripcion+ ' </option>'
                    );
                }
            });
        });
    });

    $('#actividad_docente').click(function(){
        var selected = $(this).find('option:selected');
        var extra = selected.data('horas');
        document.getElementById("horas_docente").value = extra+" Horas";
    });

    $("#confirma_elimina").click(function(event){
        var id_sit=($(this).data('id'));
        $("#form_delete").attr("action","/docente_actividad/"+id_sit);
        $("#form_delete").submit();
    });
});
</script>

@endsection
