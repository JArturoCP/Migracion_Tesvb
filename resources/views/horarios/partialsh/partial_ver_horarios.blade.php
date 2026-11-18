@section('horario_docente')

<main>
<!-- Modal para ver horario_grupos -->
<x-panel.modal id="modal_hrs" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel"><div id="modal_horas">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="myModalLabel">HORARIOS DOCENTES: {{ $docenten }}</h4>
      </div>
      <div class="tw-modal-cuerpo">
        @if($imprime==1)
            {{--
         <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
  <a href="/crear_pdf/{{ $id_profesor }}" class="crear tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" target="_blank"><span class="fa fa-print"  aria-hidden="true"></span> Imprimir</a>
                        </div>
                        --}}
         @endif
<br>
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="ml tabla_fondo tw-tabla tw-tabla-bordes tw:text-center" style="table-layout:fixed;">
                          <thead>
                            <tr>
                                <th>Hora/Día</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                 <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                                <th>Horas</th>
                            </tr>
                          </thead>

                          <tbody>  
                          <?php $contador=1 ?>
                          <?php $totalesf=0 ?>
                            @foreach($semanas as $semanass)
                            @if($contador==1)
                              <tr>                            
                                <td class="horario">{{ $semanass->hora }}</td> 
                            @endif 
                            <td class="horario iden{{$semanass->id_semana}}"> 
                                  @foreach($horarios_doc as $horario)                    
                                    @if($horario->id_semana==$semanass->id_semana) 
                                        <div style="font-weight:bold; color:white;">
                                            @if($horario->idmat == 20005)
                                                {{ $horario->clave }}
                                                @else
                                         {{ $horario->materia }} @endif<br>
                                         {{ $horario->grupo }}:{{ $horario->abre }}
                                          <?php $totalesf++; ?>
                                        </div>  
                                    @endif    
                                  @endforeach
                            </td>
                                <?php $contador++?>                  
                                  @if($contador==7)
                                  <?php $contador=1 ?> 
                                    <td>
                                      {{ $totalesf }}
                                      <?php $totalesf=0 ?>
                                    </td>            
                                  </tr>
                                  @endif
                                     @endforeach                                                                                           
                          </tbody>
                        </table>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
      <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[33.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="chica tw-tabla tw-tabla-bordes">
                          <tbody>
                            @foreach($ver_totales as $totaless)
                            <tr>
                              <td>{{ $totaless->nombre }}</td>
                              <td>{{ $totaless->sumaa }}</td>
                            </tr>
                            @endforeach
                            <tr class="borde">
                              <td>Total de Horas:</td>
                              <td>{{ $ssuma }}</td>
                            </tr>
                          </tbody>
                        </table>
</div>
    </div>
</div>
      </div>
          <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
              <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Aceptar</button>
          </div>
    
  
</div></x-panel.modal>
</main>

<script>
@foreach($semanas as $semanass)
  @foreach($horarios_doc as $horario)                    
    @if($horario->id_semana==$semanass->id_semana) 
      $(".iden{{$semanass->id_semana}}").css('background', '{{$horario->color}}');
    @endif    
  @endforeach
@endforeach
  $(document).ready(function(){

    $("#modal_hrs").modal("show");

  });

</script>

@endsection