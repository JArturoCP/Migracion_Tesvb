@extends('layouts.panel')
@section('title', 'AlumnosActividades')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="SOLICITUD DE ALUMNOS" />

    <x-panel.tarjeta sin-relleno>
        <!-- Nav tabs -->
        <div class="tw:border-b tw:border-gray-200 tw:px-6 tw:pt-4 tw:dark:border-gray-800">
            <ul class="tw:flex tw:flex-wrap tw:gap-2" role="tablist">
                <li role="presentation" class="active">
                    <a href="#uno" aria-controls="uno" aria-selected="true" role="tab" data-toggle="tab" class="tw-pestana active">No Liberados</a>
                </li>
                <li role="presentation">
                    <a href="#dos" aria-controls="dos" aria-selected="false" role="tab" data-toggle="tab" class="tw-pestana">Liberados</a>
                </li>  
                <li role="presentation">
                    <a href="#tres" aria-controls="tres" aria-selected="false" role="tab" data-toggle="tab" class="tw-pestana">Registrados</a>
                </li>  
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="tab-content tw:p-6">
            <div role="tabpanel" class="tab-pane active" id="uno">
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
               
                <x-panel.tabla id="paginacion">
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
                            <th class="tw:text-center">Liberación Jefatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($libera_alumnos as $liberacion_jefe)
                        <tr>
                            <td>{{$liberacion_jefe->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_jefe->apaterno}} {{$liberacion_jefe->amaterno}} {{$liberacion_jefe->alumno}}</td>
                            <td>{{$liberacion_jefe->carrera}}</td>
                            <td>{{$liberacion_jefe->semestre}}</td>
                            <td>{{$liberacion_jefe->descripcion}}</td>
                            <td>{{$liberacion_jefe->descripcion_cat}}</td>
                            <td>{{$liberacion_jefe->horas}}</td>
                            <td>{{$liberacion_jefe->creditos}}</td>
                            <td>{{$liberacion_jefe->titulo}} {{$liberacion_jefe->docente}}</td>
                            <td class="tw:text-center">
                                <input class="checkbox tw:size-4 tw:rounded tw:border-gray-300 tw:text-brand-600 tw:focus:ring-brand-500" name="orderbox[]" type="checkbox" value="1" id="liberacion_jefe" data-cuenta="{{$liberacion_jefe->id_registro_alumno}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>    
            </div>

            <div role="tabpanel" class="tab-pane" id="dos">
                <x-panel.tabla id="pagina2">
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
                        @foreach($liberacion_si as $liberacion_si)
                        <tr>
                            <td>{{$liberacion_si->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_si->apaterno}} {{$liberacion_si->amaterno}} {{$liberacion_si->alumno}}</td>
                            <td>{{$liberacion_si->carrera}}</td>
                            <td>{{$liberacion_si->semestre}}</td>
                            <td>{{$liberacion_si->descripcion}}</td>
                            <td>{{$liberacion_si->descripcion_cat}}</td>
                            <td>{{$liberacion_si->horas}}</td>
                            <td>{{$liberacion_si->creditos}}</td>
                            <td>{{$liberacion_si->titulo}} {{$liberacion_si->docente}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>            
            </div>

            <div role="tabpanel" class="tab-pane" id="tres">
                <x-panel.tabla id="pag">
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
                        @foreach($liberacion_registro as $liberacion_registro)
                        <tr>
                            <td>{{$liberacion_registro->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_registro->apaterno}} {{$liberacion_registro->amaterno}} {{$liberacion_registro->alumno}}</td>
                            <td>{{$liberacion_registro->carrera}}</td>
                            <td>{{$liberacion_registro->semestre}}</td>
                            <td>{{$liberacion_registro->descripcion}}</td>
                            <td>{{$liberacion_registro->descripcion_cat}}</td>
                            <td>{{$liberacion_registro->horas}}</td>
                            <td>{{$liberacion_registro->creditos}}</td>
                            <td>{{$liberacion_registro->titulo}} {{$liberacion_registro->docente}}</td>
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

<x-panel.modal id="mensaje_actividad" titulo="Selecciona registros" tamano="sm" aria-label="Selecciona registros">
    <p class="tw:text-sm tw:text-red-700 tw:dark:text-red-400" role="alert">NO HAS SELECCIONADO DATOS A LIBERAR</p>
</x-panel.modal>

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
            window.location.href=direccion+"/edita_jefe_aceptar/"+arreglo;
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

        window.location.href=direccion+"/ed/"+arreglo;
    });

    $('#paginacion').DataTable();
    $('#pagina2').DataTable();
    $('#pag').DataTable();
});
</script>
@endsection
