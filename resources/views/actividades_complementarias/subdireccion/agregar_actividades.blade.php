@extends('layouts.panel')
@section('title', 'NuevaActividad')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="ACTIVIDADES REGISTRADAS" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-target="#agrega_actsub" data-toggle="modal" variante="primario" tamano="sm">
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
    @include('actividades_complementarias.partials_actividades.subdireccion.editar_actividad')
@endif

<x-panel.modal id="agrega_actsub" tamano="lg" sin-relleno aria-labelledby="myModalLabel">
    <x-slot:encabezado>
        <h3 id="myModalLabel" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Registro de Actividad</h3>
    </x-slot:encabezado>

    <form method="POST" role="form" id="agregar_actividad" action="/nueva_actividad"
          class="tw:[&_label.error]:mt-1.5 tw:[&_label.error]:block tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600 tw:dark:[&_label.error]:text-red-400">
        {{csrf_field()}}
        <div class="tw-modal-cuerpo">
            <div class="tw:grid tw:gap-4 tw:md:grid-cols-2">
                <x-panel.input etiqueta="Nombre de Actividad" id="actividad_sub" type="text" name="actividad_sub" placeholder="Actividad"
                               :error="$errors->first('actividad_sub')" />

                <div>
                    <div class="tw:flex tw:flex-wrap tw:items-baseline tw:justify-between tw:gap-x-2">
                        <x-panel.etiqueta for="categoria_sub">Categoría</x-panel.etiqueta>
                        <x-panel.boton variante="contorno-primario" tamano="sm" class="tw:mb-1.5 tw:px-2 tw:py-1 tw:text-xs"
                                       data-target="#agrega_cat" data-toggle="modal">+ Nueva Categoría</x-panel.boton>
                    </div>
                    <x-panel.select name="categoria_sub" id="categoria_sub" :error="$errors->first('categoria_sub')">
                        <option disabled selected hidden>Selecciona Opción...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id_categoria}}">{{$categoria->descripcion_cat}}</option>
                        @endforeach
                    </x-panel.select>
                </div>

                <x-panel.select etiqueta="Número de Horas" name="horas_sub" id="horas_sub" :error="$errors->first('horas_sub')">
                    <option disabled selected hidden>Selecciona Opción...</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                </x-panel.select>

                <x-panel.select etiqueta="Departamento Encargado" name="jefatura_sub" id="jefatura_sub" :error="$errors->first('jefatura_sub')">
                    <option disabled selected hidden>Selecciona Opción...</option>
                    @foreach($jefaturascar as $jefatura)
                        <option value="{{$jefatura->id_jefatura}}">{{$jefatura->nom_jefatura}}</option>
                    @endforeach
                </x-panel.select>
            </div>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" id="registra">Registrar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="agrega_cat" sin-relleno aria-labelledby="myModalLabelCat">
    <x-slot:encabezado>
        <h3 id="myModalLabelCat" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Nueva Categoría</h3>
    </x-slot:encabezado>

    <form role="form" id="agregar_categoria" class="tw:[&_label.error]:mt-1.5 tw:[&_label.error]:block tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600 tw:dark:[&_label.error]:text-red-400">
        {{csrf_field()}}
        <div class="tw-modal-cuerpo">
            <x-panel.input etiqueta="Nombre de Categoría" id="categorias" type="text" name="categorias"
                           placeholder="Categoría" :error="$errors->first('categorias')" />
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="categoria" value="Agregar">Agregar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
    <x-slot:encabezado>
        <h3 id="mySmallModalLabel" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Eliminar actividad</h3>
    </x-slot:encabezado>

    <form action="" method="POST" role="form" id="form_delete">
        {{method_field('DELETE')}}
        {{csrf_field()}}
        <div class="tw-modal-cuerpo">
            <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">¿Realmente deseas eliminar este elemento?</p>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="confirma_elimina" variante="peligro" value="Aceptar">Aceptar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>


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
        errorPlacement: function(error, element){
            error.insertAfter(element.is('select') ? element.parent() : element);
        },
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

    @if(!isset($edit) && $errors->hasAny(['actividad_sub', 'categoria_sub', 'horas_sub', 'jefatura_sub']))
        $('#agrega_actsub').modal('show');
    @endif

    $('#paginacion').DataTable();
});
</script>

@endsection
