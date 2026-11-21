@extends('layouts.panel')
@section('title', 'PlaneacionActividad')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="PLANEACIÓN DE ACTIVIDADES" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-target="#planea_doc" data-toggle="modal" variante="primario" tamano="sm">
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

<x-panel.modal id="planea_doc" tamano="lg" sin-relleno aria-labelledby="myModalLabel">
    <x-slot:encabezado>
        <h3 id="myModalLabel" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Planeación de actividad</h3>
    </x-slot:encabezado>

    <form method="POST" role="form" id="agregar_planeacion" enctype="multipart/form-data"
          class="tw:[&_label.error]:mt-1.5 tw:[&_label.error]:block tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600 tw:dark:[&_label.error]:text-red-400">
        {{csrf_field()}}
        <input name="fecha" type="hidden" id="fecha" value="{{ date('Y/m/d') }}">
        <div class="tw-modal-cuerpo">
            <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
                <x-panel.select etiqueta="Actividad" name="actividad_docen" id="actividad_docen">
                    <option disabled selected hidden>Selecciona Opción...</option>
                    @foreach($actividad_docen as $actividad_docen)
                        <option value="{{$actividad_docen->id_actividad_comple}}" data-horas="{{$actividad_docen->horas}}">{{$actividad_docen->descripcion}}</option>
                    @endforeach
                </x-panel.select>

                <x-panel.input etiqueta="Número de Horas" name="horas_docente" id="horas_docente" type="text" value="" placeholder="Horas" disabled />
                <x-panel.input etiqueta="Número de evidencias" name="evidencias_doc" id="evidencias_doc" type="text" placeholder="Evidencias" />
                <x-panel.input etiqueta="Rúbrica de evaluación (.pdf)" type="file" name="urlImg" id="archivo" accept=".pdf" required />
            </div>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" id="registra">Guardar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="modal_elimina" tamano="sm" titulo="Eliminar planeación" sin-relleno aria-label="Eliminar planeación">
    <form action="" method="POST" role="form" id="form_delete">
        {{method_field('DELETE')}}
        {{csrf_field()}}
        <div class="tw-modal-cuerpo">
            <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">¿Realmente deseas eliminar este elemento?</p>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="confirma_elimina" variante="peligro">Aceptar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="mensaje_actividad" tamano="sm" titulo="Actividad duplicada" aria-label="Actividad duplicada">
    <p class="tw:text-sm tw:font-medium tw:text-red-700 tw:dark:text-red-400" role="alert">
        LA ACTIVIDAD QUE INTENTA REGISTRAR YA EXISTE
    </p>
</x-panel.modal>


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
        errorPlacement: function(error, element){
            if (element.is('#actividad_docen')) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
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
