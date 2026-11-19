@extends('layouts.panel')
@section('title', 'AlumnosActividades')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="SOLICITUD DE ALUMNOS" />

    <x-panel.tarjeta sin-relleno>
        <!-- Nav tabs -->
        <div class="tw:border-b tw:border-gray-200 tw:px-6 tw:pt-4 tw:dark:border-gray-800">
            <ul class="nav nav-tabs tw:flex tw:gap-2 tw:border-0" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tres" aria-controls="home" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-brand-500 tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-brand-600 tw:dark:text-brand-400">No Liberados</a>
                </li>
                <li role="presentation">
                    <a href="#cuatro" aria-controls="cuatro" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-transparent tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-500 tw:hover:text-gray-700 tw:dark:text-gray-400">Liberados</a>
                </li>
            </ul>
        </div>

        <div class="tab-content tw:p-6">
            <div role="tabpanel" class="tab-pane active" id="tres">
                <div class="tw:mb-4 tw:flex tw:items-center tw:justify-between">
                    <div class="tw:flex tw:items-center tw:gap-2">
                        <label for="checktodos" class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Seleccionar Todos</label>
                        <input type="checkbox" id="checktodos" class="tw:size-4 tw:rounded tw:border-gray-300 tw:text-brand-600 tw:focus:ring-brand-500">
                    </div>
                    <div>
                        <x-panel.boton tipo="primario" tamano="sm" id="insertar">
                            <span class="fa fa-check" aria-hidden="true"></span> Liberar Seleccionados
                        </x-panel.boton>
                    </div>
                </div>
                   
                <x-panel.tabla id="paginacion" class="tabla-grande2">
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Actividad</th>
                            <th>Categoría</th>
                            <th>Horas</th>
                            <th>Créditos</th>
                            <th>Docente</th>
                            <th class="tw:text-center">Liberación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liberacion_sub as $liberacion_sub)
                        <tr>
                            <td>{{$liberacion_sub->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_sub->apaterno}} {{$liberacion_sub->amaterno}} {{$liberacion_sub->alumno}}</td>
                            <td>{{$liberacion_sub->carrera}}</td>
                            <td>{{$liberacion_sub->semestre}}</td>
                            <td>{{$liberacion_sub->descripcion}}</td>
                            <td>{{$liberacion_sub->descripcion_cat}}</td>
                            <td>{{$liberacion_sub->horas}}</td>
                            <td>{{$liberacion_sub->creditos}}</td>
                            <td>{{$liberacion_sub->titulo}} {{$liberacion_sub->docente}}</td>
                            <td class="tw:text-center">  
                                <input class="checkbox tw:size-4 tw:rounded tw:border-gray-300 tw:text-brand-600 tw:focus:ring-brand-500" name="orderbox[]" type="checkbox" value="1" id="liberacion_jefe" data-cuenta="{{$liberacion_sub->id_registro_alumno}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>     
            </div>

            <div role="tabpanel" class="tab-pane" id="cuatro">
                <x-panel.tabla id="pagina2" class="tabla-grande2">
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Actividad</th>
                            <th>Categoría</th>
                            <th>Horas</th>
                            <th>Créditos</th>
                            <th>Docente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liberacion_subsi as $liberacion_subsi)
                        <tr>
                            <td>{{$liberacion_subsi->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_subsi->apaterno}} {{$liberacion_subsi->amaterno}} {{$liberacion_subsi->alumno}}</td>
                            <td>{{$liberacion_subsi->carrera}}</td>
                            <td>{{$liberacion_subsi->semestre}}</td>
                            <td>{{$liberacion_subsi->descripcion}}</td>
                            <td>{{$liberacion_subsi->descripcion_cat}}</td>
                            <td>{{$liberacion_subsi->horas}}</td>
                            <td>{{$liberacion_subsi->creditos}}</td>
                            <td>{{$liberacion_subsi->titulo}} {{$liberacion_subsi->docente}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>
            </div>
        </div>
    </x-panel.tarjeta>

<?php
  $direccion=Session::get('ip');
?>

<div id="mensaje_actividad" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-warning">
        <p style="font-weight: bold; color:#BA0000; text-align:center;">NO HAS SELECCIONADO DATOS A LIBERAR</p>
      </div>
    </div>
  </div>
</div>

</main>

<script>
$(document).ready(function(){
    var direccion="{{$direccion}}";

    $("#checktodos").change(function(){
        $('input[name="orderbox[]"]').prop('checked',$(this).prop("checked"));
    });

    $("#checktodoss").change(function(){
        $('input[name="orderboxx[]"]').prop('checked',$(this).prop("checked"));
    });

    $('#insertar').click(function(){
        var checkboxValues=[];
        var cuenta=[];

        $('input[name="orderbox[]"]:checked').each(function(){
            checkboxValues[checkboxValues.length]=$(this).val();
            cuenta[cuenta.length]=$(this).data('cuenta'); 
        });
            
        var $marcados=$('input[name="orderbox[]"]:checked');
        var numero=$marcados.length;
        if(numero==0)
        {
            $('#mensaje_actividad').modal('show');
            setTimeout(myFunction, 2000); 

            function myFunction(){
                $('#mensaje_actividad').modal('hide');
            }
        }
        else
        {
            var suma=numero+numero;
            var arreglo=[];
            var j=0;
            for(var i=0;i<numero;i++){
                arreglo[i]=checkboxValues[i];
            }
            for(var e=numero;e<suma;e++){
                arreglo[e]=cuenta[j];
                j++;
            }

            window.location.href=direccion+"/edita_sub_aceptar/"+arreglo;
        }
    });

    $('#remover').click(function(){
        var checkboxValues=[];
        var cuenta=[];

        $('input[name="orderboxx[]"]:checked').each(function(){
            checkboxValues[checkboxValues.length]=$(this).val();
            cuenta[cuenta.length]=$(this).data('cuentaa'); 
        });
        var $marcados=$('input[name="orderboxx[]"]:checked');
        var numero=$marcados.length;
        var suma=numero+numero;
        var arreglo=[];
        var j=0;
        for(var i=0;i<numero;i++){
            arreglo[i]=checkboxValues[i];
        }
        for(var e=numero;e<suma;e++){
            arreglo[e]=cuenta[j];
            j++;
        }

        window.location.href=direccion+"/ed_sub/"+arreglo;
    });

    $('#paginacion').DataTable();
    $('#pagina2').DataTable();
});
</script>
@endsection
