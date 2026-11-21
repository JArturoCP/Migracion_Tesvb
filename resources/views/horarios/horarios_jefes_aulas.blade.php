@extends('layouts.panel')
@section('title', 'Horarios Aulas')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="HORARIOS AULAS" />

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-xl">
        <div class="dropdown">
            <x-panel.select etiqueta="Aula" name="selectAula" id="selectAula">
                <option disabled selected>Selecciona aula...</option>
                @foreach($aulas as $aula)
                    <option value="{{$aula->id_aula}}">{{ $aula->nombre }}</option>
                @endforeach
            </x-panel.select>
        </div>
    </x-panel.tarjeta>

@if(isset($ver))
    @section('horario_aula')
    @include('horarios.partialsh.partial_ver_aulas_jefes')
    @show
@endif

</main>

<script>
$(document).ready(function() {
    $("#selectAula").on('change',function(e){
        var aula=$("#selectAula").val();
        window.location.href='/horarios_aulas/jefes/'+aula;
    });
});
</script>
@endsection
