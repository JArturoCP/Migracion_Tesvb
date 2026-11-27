@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    
<main class="tw:w-full tw:lg:w-full tw:px-2">
<x-panel.encabezado titulo="Historial de evidencias de conocimiento de los departamentos enviadas" :migas="['Incidencias' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio1" class="tw-tabla tw-tabla-bordes">
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
                                  <a  target="_blank" href="{{$evidencia->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"> <i class="fa fa-book em128" title="Ver PDF"> </i> Ver evidencia </a>
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
</div>
@endsection