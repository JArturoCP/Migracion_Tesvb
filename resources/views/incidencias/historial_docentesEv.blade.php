@extends('layouts.panel')
@section('title','Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Historial de evidencias de conocimiento que no requiere autorización de jefe inmediato" :migas="['Incidencias' => null]" />

  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_historial_docentes" class="tw-tabla tw-tabla-bordes" align="center">
                <thead >                                     
                    <th class="tw:text-center">No.</th> 
                    <th class="tw:text-center">Evidencia aplicada</th>
                    <th class="tw:text-center">Fecha solicitada</th>
                    <th class="tw:text-center">Fecha y hora de envio</th>    
                    <th class="tw:text-center">Ver evidencia</th>
                <th class="tw:text-center">Estado de la evidencia</th>
                </thead>
                <tbody>
                <?php $i=1 ?>
                @foreach ($histEvi as $evidhist)
                    <tr>
                        <td>{{$i++}} </td>
                        <td>{{$evidhist->nombre_evidencia}}</td>

                        @if($evidhist->no_fecha == 1)
                        <?php
                        $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                        ?>
                        <td><b>{{$fecha_solicita}}</b></td>
                        @else
                            <?php
                            $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                            $fecha_solicita_2= date('d-m-Y', strtotime($evidhist->fecha_solicita_2));
                            ?>
                            <td><b>{{$fecha_solicita}} al {{ $fecha_solicita_2 }}</b></td>
                        @endif
                        <?php  $fecha_envio=date_format(new DateTime($evidhist->fecha_envio), 'd-m-Y H:i:s');?>
                        <td>{{$fecha_envio}}</td>

                        <th>
                            <a  target="_blank" href="{{$evidhist->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"> <i class="fa fa-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                        </th>
                             @if($evidhist->id_autorizado == 1)
                            <td>Enviado al Dpto. personal para revisión</td>
                            @elseif($evidhist->id_autorizado == 2)
                            <td>Autorizada la revisión</td>
                        @elseif($evidhist->id_autorizado == 3)
                            <td>Rechazado</td>
                            @endif

                    </tr>
                @endforeach
            <tbody>
        </table>
</div>
    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() { 
    $('#tabla_historial_docentes').DataTable( {

    } );
});
</script>
</main>
</div>
@endsection