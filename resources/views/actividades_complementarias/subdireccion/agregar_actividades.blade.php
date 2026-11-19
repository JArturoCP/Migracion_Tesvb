@extends('layouts.panel')
@section('title', 'NuevaActividad')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="ACTIVIDADES REGISTRADAS" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-target="#agrega_actsub" data-toggle="modal" tipo="primario" tamano="sm">
                <span class="fa fa-plus" aria-hidden="true"></span> Registrar Actividad
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla id="paginacion" class="tabla-grande2"> 
            <thead>
                <tr>
                    <th>Nombre de Actividad</th>
                    <th>Categoría</th>
                    <th>Horas Asignadas</th>
                    <th>Créditos</th>
                    <th>Departamento Encargado</th>
                    <th class="tw:text-center">Editar</th>
                    <th class="tw:text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoria as $n)
                <tr>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$n->descripcion}}</td>
                    <td>{{$n->descripcion_cat}}</td>
                    <td>{{$n->horas}}</td>
                    <td>{{$n->creditos}}</td>
                    <td>{{$n->nom_jefatura}}</td>
                    <td class="tw:text-center">
                        <a href="{{url("/nueva_actividad/".$n->id_actividad_comple."/edit")}}" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Editar">
                            <span class="fa fa-cog em" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="tw:text-center">
                        <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{$n->id_actividad_comple}}" title="Eliminar">
                            <span class="fa fa-trash em" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

@if(isset($edit))
    @section('editar_actividad')
    @include('actividades_complementarias.partials_actividades.subdireccion.editar_actividad')
    @show
@endif

<!-- Modal PARA AGREGAR NUEVA ACTIVIDAD -->
<form method="POST" role="form" class="form" id="agregar_actividad" action="/nueva_actividad">
    {{csrf_field()}}
    <div class="modal fade" id="agrega_actsub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title text-center" id="myModalLabel">Registro de Actividad</h3>
                </div>
                
                <div class="modal-body">
                    <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="actividad_sub">Nombre de Actividad</label>
                                <input class="form-control" id="actividad_sub" type="text" name="actividad_sub" placeholder="Actividad">
                                @if($errors->has('actividad'))
                                    <span class="text-danger">{{$errors->first('actividad')}}</span>
                                @endif
                            </div>      
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <div class="tw:flex tw:items-center tw:justify-between">
                                    <label for="categoria_sub">Categoría</label>
                                    <button type="button" class="tw:text-xs tw:font-medium tw:text-brand-600 hover:tw:underline" data-target="#agrega_cat" data-toggle="modal">
                                        + Nueva Categoría
                                    </button>
                                </div>
                                <select class="form-control" name="categoria_sub" id="categoria_sub">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                    @if($errors->has('categoriaa'))
                                        <span class="text-danger">{{$errors->first('categoriaa')}}</span>
                                    @endif
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id_categoria}}">{{$categoria->descripcion_cat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="horas_sub">Número de Horas</label>
                                <select class="form-control" name="horas_sub" id="horas_sub">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    @if($errors->has('hora'))
                                        <span class="text-danger">{{$errors->first('hora')}}</span>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="jefatura_sub">Departamento Encargado</label>
                                <select class="form-control" name="jefatura_sub" id="jefatura_sub">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                    @if($errors->has('jefaturas'))
                                        <span class="text-danger">{{$errors->first('jefaturas')}}</span>
                                    @endif
                                    @foreach($jefaturascar as $jefatura)
                                        <option value="{{$jefatura->id_jefatura}}">{{$jefatura->nom_jefatura}}</option>
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

<!--MODAL PARA AGREGAR CATEGORIAS-->
<form role="form" class="form" id="agregar_categoria">
    {{csrf_field()}}
    <div class="modal fade" id="agrega_cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabelCat" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title text-center" id="myModalLabelCat">Nueva Categoría</h3>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categorias">Nombre de Categoría</label>
                        <input class="form-control" id="categorias" type="text" name="categorias" placeholder="Categoría">
                        @if($errors->has('actividad'))
                            <span class="text-danger">{{$errors->first('actividad')}}</span>
                        @endif
                    </div>      
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                    <input type="button" class="btn btn-primary" id="categoria" value="Agregar"/>
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
    $(".elimina").click(function(){
        var id=$(this).attr('id');
        $('#confirma_elimina').data('id',id);
        $('#modal_elimina').modal('show');
    });

    $("#registra").click(function(event){
        $("#agregar_actividad").submit();
    });

    $("#agregar_actividad").validate({
        rules:{
            actividad_sub: {
                required: true,
                minlength: 4
            },
            categoria_sub:"required",
            horas_sub:"required",
            jefatura_sub:"required",
        },
    });

    $("#categoria").click(function(event){
        $.post("nueva_categoria",$("#agregar_categoria").serialize(),function(request){
            var html="";
            for (var i = 0; i < request.length; i++) {
                html+="<option value='"+request[i].id_categoria+"'>"+request[i].descripcion_cat+"</option>";
            }
            $('#categoria_sub').html(html);
            $("#agrega_cat").modal('hide');
        });
    });

    $("#agregar_categoria").validate({
        rules:{
            categorias:"required",
        }
    });

    $("#confirma_elimina").click(function(event){
        var id_sit=($(this).data('id'));
        $("#form_delete").attr("action","/nueva_actividad/"+id_sit);
        $("#form_delete").submit();
    });

    $('#paginacion').DataTable();
});
</script>

@endsection
