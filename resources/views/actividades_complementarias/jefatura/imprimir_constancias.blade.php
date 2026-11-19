@extends('layouts.panel')
@section('title', 'Constancias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="LIBERACIÓN DE ACTIVIDADES" />

    <x-panel.tarjeta sin-relleno>
        <!-- Nav tabs -->
        <div class="tw:border-b tw:border-gray-200 tw:px-6 tw:pt-4 tw:dark:border-gray-800">
            <ul class="nav nav-tabs tw:flex tw:gap-2 tw:border-0" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tres" aria-controls="home" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-brand-500 tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-brand-600 tw:dark:text-brand-400">No Liberados</a>
                </li>
                <li role="presentation">
                    <a href="#cuatro" aria-controls="cuatro" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-transparent tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-500 tw:hover:text-gray-700 tw:dark:text-gray-400">Aprobados</a>
                </li>
                <li role="presentation">
                    <a href="#dos" aria-controls="dos" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-transparent tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-500 tw:hover:text-gray-700 tw:dark:text-gray-400">No Aprobados</a>
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

                <x-panel.tabla id="paginacion">
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Semestre</th>
                            <th>Grupo</th>
                            <th>Actividad</th>
                            <th>Docente</th>
                            <th>Créditos</th>
                            <th>Promedio</th>
                            <th class="tw:text-center">Liberación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liberacion_evaluacion_si as $liberacion_evaluacion_si)
                        <tr>
                            <td>{{$liberacion_evaluacion_si->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_evaluacion_si->nombre}} {{$liberacion_evaluacion_si->apaterno}} {{$liberacion_evaluacion_si->amaterno}}</td>
                            <td>{{$liberacion_evaluacion_si->semestre}}</td>
                            <td>{{$liberacion_evaluacion_si->grupo}}</td>
                            <td>{{$liberacion_evaluacion_si->descripcion}}</td>
                            <td>{{$liberacion_evaluacion_si->titulo}} {{$liberacion_evaluacion_si->docente}}</td>
                            <td>{{$liberacion_evaluacion_si->creditos}}</td>
                            <td>{{$liberacion_evaluacion_si->promedio}}</td>
                            <td class="tw:text-center">  
                                <input class="checkbox tw:size-4 tw:rounded tw:border-gray-300 tw:text-brand-600 tw:focus:ring-brand-500" name="orderbox[]" type="checkbox" value="1" id="liberacion_jefe" data-cuenta="{{$liberacion_evaluacion_si->id_registro_alumno}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>      
            </div>

            <div role="tabpanel" class="tab-pane" id="cuatro">
                <div class="tw:mb-4 tw:flex tw:justify-end">
                    <x-panel.boton href="{{ url('/constancias_todas') }}" target="_blank" tamano="sm">
                        <span class="fa fa-print" aria-hidden="true"></span> Imprimir Todo
                    </x-panel.boton>
                </div>

                <x-panel.tabla id="pagi">
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Semestre</th>
                            <th>Grupo</th>
                            <th>Actividad</th>
                            <th>Docente</th>
                            <th>Créditos</th>
                            <th>Promedio</th>
                            <th class="tw:text-center">Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liberacion_evaluacion_no as $liberacion_evaluacion_no)
                        @if($liberacion_evaluacion_no->promedio>=70)
                        <tr>
                            <td>{{$liberacion_evaluacion_no->cuenta}}</td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$liberacion_evaluacion_no->nombre}} {{$liberacion_evaluacion_no->apaterno}} {{$liberacion_evaluacion_no->amaterno}}</td>
                            <td>{{$liberacion_evaluacion_no->semestre}}</td>
                            <td>{{$liberacion_evaluacion_no->grupo}}</td>
                            <td>{{$liberacion_evaluacion_no->descripcion}}</td>
                            <td>{{$liberacion_evaluacion_no->titulo}} {{$liberacion_evaluacion_no->docente}}</td>
                            <td>{{$liberacion_evaluacion_no->creditos}}</td>
                            <td>{{$liberacion_evaluacion_no->promedio}}</td>
                            <td class="tw:text-center">
                                @if($liberacion_evaluacion_no->estado==1)
                                    <a href="{{url("/Constancia/".$liberacion_evaluacion_no->id_registro_alumno."/edit")}}" target="_blank" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Imprimir constancia">
                                        <span class="fa fa-print em" aria-hidden="true"></span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </x-panel.tabla>
            </div>

            <div role="tabpanel" class="tab-pane" id="dos">
                <x-panel.tabla id="pag">
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Actividad</th>
                            <th>Docente</th>
                            <th>Créditos</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promedio_cero as $promedio_cero)
                            @if($promedio_cero->promedio < 70)
                            <tr>
                                <td>{{$promedio_cero->cuenta}}</td>
                                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$promedio_cero->nombre}} {{$promedio_cero->apaterno}} {{$promedio_cero->amaterno}}</td>
                                <td>{{$promedio_cero->semestre}}</td>
                                <td>{{$promedio_cero->grupo}}</td>
                                <td>{{$promedio_cero->descripcion}}</td>
                                <td>{{$promedio_cero->titulo}} {{$promedio_cero->docente}}</td>
                                <td>{{$promedio_cero->creditos}}</td>
                                <td>{{$promedio_cero->promedio}}</td>
                            </tr>
                            @endif
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
        <p style="font-weight: bold; color:#BA0000; text-align:center;">NO HAS SELECCIONADO DATOS A IMPRIMIR</p>
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
            window.location.href=direccion+"/constancias_si/"+arreglo;
        }
    });

    $('#paginacion').DataTable();
    $('#pag').DataTable();  
    $('#pagi').DataTable();    
});
</script>
@endsection
