@extends('layouts.panel')
@section('title', 'PlaneacionActividad')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="PLANEACIÓN DE ACTIVIDADES" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-target="#planea_doc" data-toggle="modal" tipo="primario" tamano="sm">
                <span class="fa fa-plus" aria-hidden="true"></span> Agregar Planeación
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla class="tabla-grande2">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Número Evidencias</th>
                    <th>Rúbrica de Evaluación</th>
                    <th>Estado</th>
                    <th class="tw:text-center">Editar</th>
                    <th class="tw:text-center">Eliminar</th>
                </tr>
            </thead> 
            <tbody>
                @foreach($docente_actividad as $docente)
                <tr>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$docente->descripcion}}</td>
                    <td>{{$docente->no_evidencias}}</td>
                    <td>
                        <a href="{{url("/ArchivosDocentes/".$docente->rubrica)}}" target="_blank" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Ver rúbrica">
                            <span class="fa fa-file-text em" aria-hidden="true"></span>
                        </a>
                        {{$docente->rubrica}}
                    </td>
                    <td>
                        @if($docente->evi == 1)
                            <x-panel.badge tono="amarillo">En proceso...</x-panel.badge>
                        @elseif($docente->evi == 2)
                            <x-panel.badge tono="verde">Aprobado</x-panel.badge>
                        @endif
                    </td>
                    <td class="tw:text-center">
                        @if($docente->evi == 1)
                            <a href="{{url("/planeacion_actividad/".$docente->id_reg_coordinador."/edit")}}" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Editar">
                                <span class="fa fa-cog em" aria-hidden="true"></span>
                            </a>
                        @endif
                    </td>
                    <td class="tw:text-center">
                        @if($docente->evi == 1)
                            <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{$docente->id_reg_coordinador}}" title="Eliminar">
                                <span class="fa fa-trash em" aria-hidden="true"></span>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

@if(isset($editar_planeacion))
    @section('editar_planeacion')
    @include('actividades_complementarias.partials_actividades.profesor.editar_planeacion')
    @show
@endif

<!-- Modal PARA AGREGAR NUEVA ACTIVIDAD -->
<form method="POST" role="form" class="form" id="agregar_planeacion" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal fade" id="planea_doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title text-center" id="myModalLabel">Planeación de actividad</h3>
                </div>
                <div class="modal-body">
                    <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="actividad_docen">Actividad</label>
                                <select class="form-control" name="actividad_docen" id="actividad_docen">
                                    <option disabled selected hidden>Selecciona Opción...</option>
                                    @foreach($actividad_docen as $actividad_docen)
                                        <option value="{{$actividad_docen->id_actividad_comple}}" data-horas="{{$actividad_docen->horas}}">{{$actividad_docen->descripcion}}</option>
                                    @endforeach
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
                                <label for="evidencias_doc">Número de evidencias</label>
                                <input class="form-control" name="evidencias_doc" id="evidencias_doc" type="text" placeholder="Evidencias">
                            </div>
                        </div>

                        <div class="tw:min-w-0">
                            <div class="form-group">
                                <label for="archivo">Rúbrica de evaluación (.pdf)</label>
                                <input type="file" name="urlImg" id="archivo" accept=".pdf" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="registra">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <input name="fecha" type="text" id="fecha" value="<?php echo date("Y/m/d"); ?>" style="visibility:hidden"/>
</form>

<!--MODAL PARA ELIMINAR REGISTRO DEL PROFESOR-->
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

<div id="mensaje_actividad" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-warning">
        <p style="font-weight: bold; color:#BA0000; text-align:center;">LA ACTIVIDAD QUE INTENTA REGISTRAR YA EXISTE</p>
      </div>
    </div>
  </div>
</div>

<?php
  $direccion=Session::get('ip');
?>

</main>

<script>
$(document).ready(function(){
    var direccion="{{$direccion}}";

    $(".elimina").click(function(){
        var id=$(this).attr('id');
        $('#confirma_elimina').data('id',id);
        $('#modal_elimina').modal('show');
    });

    $("#registra").click(function(event){
        $("#agregar_planeacion").submit();
    });

    $("#agregar_planeacion").validate({
        rules:{
            evidencias_doc: {
                required:true,
                digits: true,
                minlength: 1,
            },
            actividad_docen: "required",
        },
    });

    $('#actividad_docen').on('change',function(){
        var selected = $(this).find('option:selected');
        var extra = selected.data('horas'); 
        document.getElementById("horas_docente").value = extra+" Horas";
    });

    $("#confirma_elimina").click(function(event){
        var id_sit=($(this).data('id'));
        $("#form_delete").attr("action","/planeacion_actividad/"+id_sit);
        $("#form_delete").submit();
    });   

    @if($condicion != 0)
        <?php Session::put('entra',0); ?>
        $('#mensaje_actividad').modal('show');
        setTimeout(myFunction, 2000); 

        function myFunction(){
            window.location.href=direccion+"/planeacion_actividad/";
        }
    @endif
});
</script>
@endsection
