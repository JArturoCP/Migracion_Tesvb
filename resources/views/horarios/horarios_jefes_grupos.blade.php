@extends('layouts.panel')
@section('title', 'Horarios Grupos')
@include('partials.panel.recursos_app')
@section('content')

    <script>
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  e.target // newly activated tab
  e.relatedTarget // previous active tab
})
    </script>

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="HORARIOS GRUPOS" />

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-xl">
        <div class="dropdown">
            <x-panel.select etiqueta="Grupo" name="selectGrupo" id="selectGrupo">
                <option disabled selected>Selecciona grupo...</option>
                @foreach($grupos as $grupo)
                    <option value="{{$grupo->id_semestre}}" name="{{$grupo->grupo}}">{{$grupo->id_semestre}}0{{$grupo->grupo}}</option>
                @endforeach
            </x-panel.select>
        </div>
    </x-panel.tarjeta>

@if(isset($ver))
    @section('horario_grupo')
    @include('horarios.partialsh.partial_ver_grupos_jefes')
    @show
@endif

</main>
<script>
$(document).ready(function(){
    $("#selectGrupo").on('change',function(e){
        var semestre=$("#selectGrupo").val();
        var grupo=$("#selectGrupo option:selected").attr('name');
        window.location.href='/horarios_grupos/jefes/'+semestre+'/'+grupo;
    });
});
</script>
@endsection
