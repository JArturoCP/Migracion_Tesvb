@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title','Incidencias')
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">HISTORIAL DE EVIDENCIAS DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO </h3>
                </div>
            </div>  
        </div>

  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_historial_docentes" class="table-responsive tw-tabla tw-tabla-bordes" align="center">
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
                            <a  target="_blank" href="{{$evidhist->arch_evidencia}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver evidencia </a>
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
@endsection