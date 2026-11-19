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

<main class="tw-pantalla">
    <x-panel.encabezado titulo="HORARIOS GRUPOS" />

<div class="tw:grid tw:grid-cols-1 tw:gap-6 tw:lg:grid-cols-3">
     {{-- Carreras: pestañas verticales (data-toggle="tab"; las activa el puente del panel). --}}
     <div class="list-group cont tw-lista-pestanas tw:self-start tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800" role="tablist">
  @foreach($carreras as $carrera)
        <a href="#{{ $carrera ["id_carrera"] }}" role="tab" data-toggle="tab" class="list-group-item">{{ $carrera ["nombre_carrera"]}}</a>
  @endforeach
    </div>
        <div class="tab-content tw:lg:col-span-2">
            @foreach($carreras as $carrera)
          <div role="tabpanel" class="tab-pane fade" id="{{ $carrera ["id_carrera"] }}">
              <x-panel.tarjeta :titulo="$carrera['nombre_carrera']" subtitulo="Grupos" sin-relleno class="tw:max-w-xl">
                      <x-panel.tabla class="ml" compacta>
                          <tbody>
                            @foreach($carrera["grupos"] as $grupo)
                            <tr>
                                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $grupo ["id_semestre"] }}0{{ $grupo ["grupo"] }}</td>
                                <td class="tw:text-right">
                                    <a href="/horarios_grupos/{{ $grupo ["id_semestre"] }}/{{ $grupo ["grupo"] }}/{{ $carrera ["id_carrera"] }}" class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:ring-1 tw:ring-brand-200 tw:hover:bg-brand-50" title="Ver horario"><span class="fa fa-list-alt em" aria-hidden="true"></span></a>
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
      @section('horario_grupo')
      @include('horarios.partialsh.partial_ver_grupos')
      @show
@endif

</main>

@endsection
