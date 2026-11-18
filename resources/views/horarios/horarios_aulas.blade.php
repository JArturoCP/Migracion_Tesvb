@extends('layouts.panel')
@section('title', 'Horarios Aulas')
@include('partials.panel.recursos_app')
@section('content')

    <script>
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  e.target // newly activated tab
  e.relatedTarget // previous active tab
})
    </script>

<main class="tw-pantalla">
    <x-panel.encabezado titulo="HORARIOS AULAS" />

<div class="tw:grid tw:grid-cols-1 tw:gap-6 tw:lg:grid-cols-3">
     {{-- Carreras: pestañas verticales (data-toggle="tab"; las activa el puente del panel). --}}
     <div class="list-group cont tw-lista-pestanas tw:self-start tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white" role="tablist">
  @foreach($carreras as $carrera)
    <!--@if($carrera ["id_carrera"]==$id_carrera)
        <a href="#{{ $carrera ["id_carrera"] }}" role="tab" data-toggle="tab" class="list-group-item active">{{ $carrera ["nombre_carrera"]}}</a>
       @else
     @endif-->
        <a href="#{{ $carrera ["id_carrera"] }}" role="tab" data-toggle="tab" class="list-group-item">{{ $carrera ["nombre_carrera"]}}</a>
  @endforeach
    </div>
        <div class="tab-content tw:lg:col-span-2">
            @foreach($carreras as $carrera)
          <div role="tabpanel" class="tab-pane fade" id="{{ $carrera ["id_carrera"] }}">
              <x-panel.tarjeta :titulo="$carrera['nombre_carrera']" subtitulo="Aulas" sin-relleno class="tw:max-w-xl">
                      <x-panel.tabla class="ml" compacta>
                          <tbody>
                            @foreach($carrera["aulas"] as $aula)
                            <tr>
                                <td class="tw:font-medium tw:text-gray-800">{{ $aula ["nombre_aula"] }}</td>
                                <td class="tw:text-right">
                                    <a href="/horarios_aulas/{{ $carrera ["id_carrera"] }}/{{ $aula ["id_aula"] }}" class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:ring-1 tw:ring-brand-200 tw:hover:bg-brand-50" title="Ver horario"><span class="fa fa-list-alt em" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </x-panel.tabla>
              </x-panel.tarjeta>
          </div>

  @endforeach
        </div>
</div>

@if(isset($ver))
      @section('horario_aula')
      @include('horarios.partialsh.partial_ver_aulas')
      @show
@endif

</main>

<script>
  $(document).ready(function() {

   $(".horario_prof").click(function()
  {
    $("#contenedor_horarios").empty();
    var id=$(this).attr('id');

      $.get("/plantilla/horario/"+id,function(request)
        {
          $("#contenedor_horarios").html(request);
        });
    });

});

</script>

@endsection
