@section('horario_aula')

<main>
<!-- Modal para ver horario_grupos -->
<x-panel.modal id="modal_hrs" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel"><div id="modal_horas">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">HORARIO AULA: {{ $aulan }}</h4>
      </div>
      <div class="tw-modal-cuerpo">

        @if($imprime==1)
         <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
  <a href="/pdf_aulas/{{$id_carrera}}/{{$id_aula}}" class="crear tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" target="_blank"><span class="fa fa-print"  aria-hidden="true"></span> Imprimir</a>
                        </div>
         @endif

            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800">
<table class="ml tw-tabla tw-tabla-bordes tw:text-center" style="table-layout:fixed;">
                          <thead>
                            <tr>
                                <th>Hora/Día</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                 <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                            </tr>
                          </thead>

                       <tbody>  
                          <?php $contador=1 ?>
                            @foreach($semanas as $semanass)
                              @if($contador==1)
                                <tr>                            
                                  <td class="horario">{{ $semanass->hora }}</td> 
                              @endif                        
                              <td class="horario iden{{$semanass->id_semana}}"> 
                                  @foreach($horario_aula as $horario)                    
                                    @if($horario->id_semana==$semanass->id_semana) 
                                        <div style="font-weight:bold; color:white;">

                                          <div>
                                              @if( $horario->idmat == 20005)
                                                  {{ $horario->clave }}
                                                  @else
                                              {{ $horario->materia }}
                                                  @endif
                                          </div>
                                          <div>{{ $horario->grupo }}</div>
                                        </div>                                     
                                    @endif    
                                  @endforeach
                                  <?php $contador++ ?>                  
                                    @if($contador==7)
                                      <?php $contador=1 ?>                                                
                                </tr>
                                    @endif
                            @endforeach                                                                                           
                      </tbody>
            </table>
</div>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
  <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
                  <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800">
<table class="tabla-grande2 tw-tabla tw-tabla-bordes">
                    <thead>
                      <th>Materia</th>
                      <th>Profesor</th>
                      <th>Grupo</th>
                    </thead>
                          <tbody>
                            @foreach($docentes as $docente)
                            <tr>
                                @if( $docente->idmat == 20005)
                                    <td>{{ $docente->clave}}</td>
                                @else
                                    <td>{{ $docente->materia}}</td>
                                    @endif

                              <td>{{ $docente->nombre }} </td>
                              <td>{{ $docente->grupo }} </td>
                            </tr>
                            @endforeach
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
  @foreach($horario_aula as $horario)                    
    @if($horario->id_semana==$semanass->id_semana) 
      $(".iden{{$semanass->id_semana}}").css('background', '{{$horario->COLOR}}');
    @endif    
  @endforeach
@endforeach
  $(document).ready(function(){

    $("#modal_hrs").modal("show");

  });

</script>

@endsection