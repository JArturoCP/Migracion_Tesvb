@extends('layouts.app')
@section('title','Incidencias')
@section('content')

<main class="col-md-12">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">HISTORIAL DE EVIDENCIAS DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO </h3>
                </div>
            </div>  
        </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <table id="tabla_historial_docentes" class="table table-bordered table-resposive" align="center">
                <thead >                                     
                    <th class="text-center">No.</th> 
                    <th class="text-center">Evidencia aplicada</th>
                    <th class="text-center">Fecha solicitada</th>
                    <th class="text-center">Fecha y hora de envio</th>    
                    <th class="text-center">Ver evidencia</th>
                <th class="text-center">Estado de la evidencia</th>
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
                            <a  target="_blank" href="{{$evidhist->arch_evidencia}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
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
  <script type="text/javascript">
  $(document).ready(function() { 
    $('#tabla_historial_docentes').DataTable( {

    } );
});
</script>
</main>
@endsection