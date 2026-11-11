@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
    
<main class="col-md-12">
<div class="row">
        <div class="col-md-5 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title text-center">HISTORIAL DE EVIDENCIAS DE CONOCIMIENTO DE LOS DEPARTAMENTOS ENVIADAS</h3>
        </div>
    </div>  
  </div>
</div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabla_envio1" class="table table-bordered table-resposive">
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
                                  <a  target="_blank" href="{{$evidencia->arch_evidencia}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
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