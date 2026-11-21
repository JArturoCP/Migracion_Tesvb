@extends('layouts.panel')
@section('title', 'EvaluacionActividad')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="EVALUACIÓN DE ACTIVIDADES" />

    <x-panel.tarjeta sin-relleno>
        <x-panel.tabla id="paginacion" class="tabla-grande2">
            <thead>
                <tr>
                    <th>Cuenta</th>
                    <th>Alumno</th>
                    <th>Semestre</th>
                    <th>Carrera</th>
                    <th>Actividad</th>
                    <th>Horas</th>
                    <th>No. Evidencias</th>
                    <th>Rúbrica</th>
                    <th>Promedio</th>
                    <th class="tw:text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluacioon as $eevaluacion)
                <tr>
                    <td>{{$eevaluacion->cuenta}}</td>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$eevaluacion->nombre}} {{$eevaluacion->apaterno}} {{$eevaluacion->amaterno}}</td>
                    <td>{{$eevaluacion->semestre}}</td>
                    <td>{{$eevaluacion->carrera}}</td>
                    <td>{{$eevaluacion->actividad}}</td>
                    <td>{{$eevaluacion->horas}}</td>
                    <td>{{$eevaluacion->evidencias}}</td>
                    <td>
                        <a href="{{url("/ArchivosDocentes",$eevaluacion->rubrica)}}" target="_blank" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Ver rúbrica">
                            <span class="fa fa-file-text em" aria-hidden="true"></span>
                        </a>
                        {{$eevaluacion->rubrica}}
                    </td>
                    <td>{{$eevaluacion->promedio}}</td>
                    <td class="tw:text-center">
                        @if($eevaluacion->promedio == 0)
                            <x-panel.boton tamano="sm" tipo="primario" href="{{url("/consulta_general/".$eevaluacion->id_registro_alumno."/edit")}}">
                                Evaluar
                            </x-panel.boton>
                        @endif
                        @if($eevaluacion->promedio > 0 and $eevaluacion->promedio < 101 )
                            <x-panel.badge tono="verde">Evaluado</x-panel.badge>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

    @if(isset($evaluacionnn))
        @section('evaluacionnn')
        @include('actividades_complementarias.profesor.evaluacion_evidencias')
        @show
    @endif
</main>

<script>
$(document).ready(function(){
    $("#registra").click(function(event){
        $("#evalua_doc").submit();
    });

    $('#paginacion').DataTable();
});
</script>

@endsection
