@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title', 'Incidencias')
@section('content')
    
<main class="tw:w-full tw:lg:w-full tw:px-2">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
          <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">HISTORIAL DE EVIDENCIAS DE CONOCIMIENTO DE LOS DEPARTAMENTOS ENVIADAS</h3>
        </div>
    </div>  
  </div>
</div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_envio1" class="table-responsive tw-tabla tw-tabla-bordes">
                          <thead>  
                            <tr>                                 
                                <th>No.</th> 
                                <th> Nombre del solicitante</th>
                                <th>Tipo de evidencia</th>
                                <th>Fecha de la incidencia</th>
                                <th>Fecha y Hora de envio de evidencia</th> 
                                <th>Ver evidencia</th>  
                            </tr>                   
                            </thead>
                          <tbody>
                          <?php $i=1; ?>
                            @foreach ($evidencias as $evidencia)
                              <tr>
                                <th>{{$i++}}</th>
                                <th>{{$evidencia->nombre}}</th>
                                <td>{{$evidencia->nombre_evidencia}}

                                    @if($evidencia->id_tipo_evid == 1 || $evidencia->id_tipo_evid == 3 ||  $evidencia->id_tipo_evid == 5  ||  $evidencia->id_tipo_evid == 6)
                                        <br><b>Folio: {{ $evidencia->no_folio }}</b>
                                    @endif
                                </td>
                                  @if($evidencia->no_fecha == 1)
                                      <?php
                                      $fecha_solicita= date('d-m-Y', strtotime($evidencia->fecha_solicita));
                                      ?>
                                      <td>
                                          {{$fecha_solicita}}
                                      </td>
                                  @else
                                      <?php
                                      $fecha_solicita= date('d-m-Y', strtotime($evidencia->fecha_solicita));
                                      $fecha_solicita_2= date('d-m-Y', strtotime($evidencia->fecha_solicita_2));
                                      ?>
                                      <td>
                                          {{$fecha_solicita}} al {{ $fecha_solicita_2 }}
                                      </td>

                                  @endif

                                  <?php  $fecha_envio=date_format(new DateTime($evidencia->fecha_envio), 'd-m-Y H:i:s');?>
                                <th>{{$fecha_envio}}</th>
                                <th>
                                @if($evidencia->arch_evidencia != null)
                                  <a  target="_blank" href="{{$evidencia->arch_evidencia}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver evidencia </a>
                                @else
                                  <p>Sin evidencia</p>
                                @endif
                                </th>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
</div>
        </div>
    </div>


  <script type="text/javascript">
  $(document).ready(function() { 
    $('#tabla_envio').DataTable( {

    } );
    $('#tabla_envio1').DataTable( {

} );
});
</script>
  </main>
@endsection