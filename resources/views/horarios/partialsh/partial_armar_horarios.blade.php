<div class="tw:w-full tw:md:max-w-md tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
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

      @if($imprime==1)


        <div class="tw:w-full tw:md:max-w-md tw:px-2">

        <button class="crear tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="modal" data-target="#modal_periodo_change"><span class="fa fa-print"  aria-hidden="true"></span> Imprimir</button>
                        </div>


      @endif
</div>


<main class="tw:w-full tw:lg:w-full tw:px-2">

<input type="hidden" id="notifi" name="notifi" value="{{ $noti }}"/>
<input type="hidden" id="estado" name="estado" value="{{ $estado }}"/>

<div class="cont tw:w-full tw:px-2" id="horario" >
  <input type="hidden" value="" id="checa" />

<div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert" id="notifi_bloqueo" style="display:none">
  Elementos bloqueados hasta completar hrs para: {{ $nombre_materia }}
</div>

<div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes tw:text-center tw:table-fixed tw:min-w-[850px]">
    <thead>
        <tr>
          <th>Hora/Día</th>
            @foreach($dias as $diass)
              <th>{{ $diass->dia }}</th>
            @endforeach
          <th>Totales</th>
        </tr>
    </thead>
    <tbody>
        <?php $contador=1 ?>
        <?php $totalesf=0 ?>
        <?php $totalest=0 ?>
            @foreach($semanas as $semanass)
                @if($contador==1)
                    <tr>
                      <td class="horario">{{ $semanass->hora }}</td>
                @endif
                <?php $bandera_ok=true; ?>
                <?php $bandera_max=true; ?>

                      <td id="{{ $semanass->id_semana }}" class="horario">
                      @foreach($horarios as $horario)
                          @if($horario->id_semana==$semanass->id_semana)
                              @if($id_carrera==$horario->id_carrera)
                                  <?php $bandera_ok=false; ?>
                                  <?php $bandera_max=false; ?>

                                    @if($horario->estado==2)
                                      @if($contar>=$hrs_maximas)
                                        <div style="font-weight:bold; height:7.5em; vertical-align:middle;">
                                            {{ "HORAS MÁXIMAS" }}
                                          </div>
                                      @else
                                        @if($horario->especial==1)
                                          @if($horario->checa_esp<2)
                                          <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->nombre }}<br> {{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; vertical-align:middle;background-color: #ccffcc;">
                                            <a id="{{ $semanass->id_semana }}" class="guarda tw:cursor-pointer tw:text-green-600 tw:dark:text-green-400" title="Asignar bloque"><span class="fa fa-check em5" aria-hidden="true"></span></a>
                                          <br><br>
                                          {{ $semanass->dia }}
                                          <br><br>
                                          </div>
                                          @else
                                          <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->nombre }}<br> {{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; color:{{ $horario->color }}; vertical-align:middle;">
                                            <br>{{ "AULA OCUPADA" }}
                                            </div>
                                          @endif
                                        @else
                                            <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->nombre }}<br> {{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; color:{{ $horario->color }}; height:9em; vertical-align:middle;">
                                            <br><br>
                                              {{ "AULA OCUPADA" }}
                                            <br><br>
                                            <br><br>
                                            </div>
                                        @endif
                                      @endif
                                    @else
                                      @if($horario->estado==3)
                                        @if($contar>=$hrs_maximas)
                                          <div style="font-weight:bold; height:7.5em; vertical-align:middle;">
                                            {{ "HORAS MÁXIMAS" }}
                                          </div>
                                         @else
                                            @if($horario->especial==1)
                                              @if($horario->checa_esp<2)
                                                <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->nombre }}<br> {{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; vertical-align:middle;background-color: #ccffcc;">
                                                  <a id="{{ $semanass->id_semana }}" class="guarda tw:cursor-pointer tw:text-green-600 tw:dark:text-green-400" title="Asignar bloque"><span class="fa fa-check em5" aria-hidden="true"></span></a>
                                                <br><br>
                                                {{ $semanass->dia }}
                                                <br><br>
                                                </div>
                                                @else
                                                <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->nombre }}<br> {{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; color:{{ $horario->color }}; vertical-align:middle;">
                                                  <br>{{ "GRUPO OCUPADO" }}
                                                  </div>
                                                @endif
                                            @else
                                                <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->nombre }}<br>{{ $horario->materia }} <br> {{ $horario->aula }}" style="font-weight:bold; color:{{ $horario->color }}; height:9em; vertical-align:middle;">
                                                  <br><br>
                                                  {{ "GRUPO OCUPADO" }}
                                                  <br><br>
                                                </div>
                                            @endif
                                        @endif
                                      @else
                                      @if($contador==1)
                                          <input name="uno[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==2)
                                          <input name="dos[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==3)
                                          <input name="tres[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==4)
                                          <input name="cua[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==5)
                                          <input name="cinco[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==6)
                                          <input name="seis[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        <input type="hidden" value="{{ $horario->hrs_prof }}" name="hrsprof"/>
                                        <input type="hidden" value="{{ $horario->rhps }}" name="rhps"/>
                                      @if($horario->idmat == 20005)
                                              <div class="tooltip-options link" data-toggle="tooltip" data-placement="right"title="{{  $horario->materia }}">{{ $horario->clave }}

                                              @else
                                              <div class="tooltip-options link" data-toggle="tooltip" data-placement="right"title="{{ $horario->clave }}">{{ $horario->materia }}

                                              @endif

                                        <!--si materia es especial y el profesor es diferente se agrega en el div -->
                                        <div>
                                        @if( $horario->grupo == 0)
                                          {{ $horario->abre }}
                                        @else
                                          Grupo {{ $horario->grupo }}:{{ $horario->abre }}
                                        @endif
                                        <div>{{ $horario->aula }}</div>
                                        <?php $totalesf++; ?>
                                        <div><a class="elimina tw:cursor-pointer tw:text-red-600 tw:dark:text-red-400" title="Quitar bloque" id="{{ $horario->rhps }}" data-mat="{{ $horario->idmat }}"><span class="fa fa-times em4" aria-hidden="true"></span></a></div>
                                        </div>
                                        </div>
                                      @endif
                                    @endif
                              @else
                                  <?php $bandera_ok=false; ?>
                                  <?php $bandera_max=false; ?>
                                  @if($horario->estado==2)
                                    @if($contar>=$hrs_maximas)
                                      <div style="font-weight:bold; height:7.5em; vertical-align:middle;">
                                            {{ "HORAS MÁXIMAS" }}
                                          </div>
                                      @else
                                      <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->carrera }} <br> {{ $horario->nombre }}<br> {{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; color:{{ $horario->color }}; height:9em; vertical-align:middle;">
                                        <br><br>
                                          {{ "AULA OCUPADA" }}
                                        <br><br>
                                      </div>
                                    @endif
                                  @else
                                    @if($horario->estado==3)
                                      @if($contar>=$hrs_maximas)
                                        <div style="font-weight:bold; height:7.5em; vertical-align:middle;">
                                          {{ "HORAS MÁXIMAS" }}
                                        </div>
                                      @else
                                        <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->carrera }} <br> {{ $horario->nombre }}<br>{{ $horario->materia }} <br> {{ $horario->aula }}" style="font-weight:bold; color:{{ $horario->color }}; height:9em; vertical-align:middle;">
                                          <br><br>
                                          {{ "GRUPO OCUPADO" }}
                                          <br><br>
                                        </div>
                                      @endif
                                    @else
                                      @if($contador==1)
                                          <input name="uno[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==2)
                                          <input name="dos[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==3)
                                          <input name="tres[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==4)
                                          <input name="cua[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==5)
                                          <input name="cinco[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                        @if($contador==6)
                                          <input name="seis[]" type="checkbox" checked="checked" style="display:none"/>
                                        @endif
                                      <div class = "tooltip-options link" data-toggle="tooltip" data-placement="right" title = "{{ $horario->materia }} <br> {{ $horario->grupo }}" style="font-weight:bold; color:{{ $horario->color }}; height:9em; vertical-align:middle;"><br>
                                        {{ $horario->carrera }}
                                        <?php $totalesf++; ?>
                                      </div>
                                    @endif
                                  @endif
                              @endif
                          @endif
                      @endforeach

                      @if($contar >= $hrs_maximas)
                          @if($bandera_max)
                            <div style="font-weight:bold; height:7.5em; vertical-align:middle;">
                              {{ "HORAS MÁXIMAS" }}
                            </div>
                          @endif
                      @else
                          @if($bandera_ok)
                            <?php $bandera_max=false; ?>
                            <div class="tw:min-h-24"> <a id="{{ $semanass->id_semana }}" class="guarda tw:cursor-pointer tw:text-green-600 tw:dark:text-green-400" title="Asignar bloque"><span class="fa fa-check em5" aria-hidden="true"></span></a> <br><br>{{ $semanass->dia }}</div>
                          @endif
                       @endif
                      <?php $contador++?>

                      @if($contador==7)
                        <?php $contador=1 ?>
                      </td>
                      <td>
                        <input name="totales[]" value="{{ $totalesf }}" type="checkbox" checked="checked" style="display:none"/>
                        <?php $totalest=$totalest+$totalesf; ?>
                        {{ $totalesf }}
                        <?php $totalesf=0 ?>
                      </td>
                  </tr>
                      @endif
            @endforeach
            <tr>
              <td></td>
                <td><label id="dos" value=""></label></td>
                <td><label id="tres" value=""></label></td>
                <td><label id="cuatro" value=""></label></td>
                <td><label id="cinco" value=""></label></td>
                <td><label id="seis" value=""></label></td>
                <td><label id="siete" value=""></label></td>
                <td>{{ $totalest }}</td>
            </tr>
    </tbody>
</table>
</div>
  </div>

  <!-- MODAL PARA ELIMINAR -->
<x-panel.modal id="modal_elimina" titulo="Quitar bloque del horario" tamano="sm" sin-relleno aria-label="Quitar bloque del horario">
    <form action="" method="POST" id="form_delete">
        @method('DELETE')
        @csrf
        <input type="hidden" id="id_materia" name="id_materia">
        <input type="hidden" id="t_doc">
        <div class="tw-modal-cuerpo">¿Quieres quitar este bloque del horario?</div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton id="confirma_elimina" variante="peligro" data-dismiss="modal">Quitar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>
</main>

<script>

function bloqueo()
{
    $.blockUI({
  });
}
$(document).ready(function()
{

  $(".link").tooltip({html:true});

var total1 = $("input[name='uno[]']:checked").length;
var total2 = $("input[name='dos[]']:checked").length;
var total3 = $("input[name='tres[]']:checked").length;
var total4 = $("input[name='cua[]']:checked").length;
var total5 = $("input[name='cinco[]']:checked").length;
var total6 = $("input[name='seis[]']:checked").length;
var totales=[];

$('input[name="totales[]"]:checked').each(function()
{
    totales[totales.length]=$(this).val();
});

document.getElementById('dos').innerHTML = total1;
document.getElementById('tres').innerHTML = total2;
document.getElementById('cuatro').innerHTML = total3;
document.getElementById('cinco').innerHTML = total4;
document.getElementById('seis').innerHTML = total5;
document.getElementById('siete').innerHTML = total6;


    const formularioHorario = document.getElementById('form_arma_horario');
    function enviarBloque(ruta, mensaje) {
        if (formularioHorario.getAttribute('aria-busy') === 'true') { return; }
        formularioHorario.setAttribute('aria-busy', 'true');
        bloqueo();
        $.post(ruta, $(formularioHorario).serialize())
            .done(function (html) {
                $('#contenedor_horarios').html(html);
                if (Number($('#notifi').val()) === 0) {
                    PanelFormularios.alerta('success', 'Horario actualizado', mensaje);
                }
            })
            .fail(function (xhr) {
                PanelFormularios.fallo(formularioHorario, xhr, 'No se pudo actualizar el horario.');
            })
            .always(function () {
                formularioHorario.removeAttribute('aria-busy');
                $.unblockUI();
            });
    }

    $('.guarda').click(function () {
        const materia = $('#selectMateria').val();
        const aula = $('#selectAula').val();
        const grupoTutor = $('#SelectGrupoT').val();
        const errores = {};
        if (!materia) { errores.selectMateria = 'Selecciona una materia o actividad.'; }
        if (!aula) { errores.selectAula = 'Selecciona un aula o la opción Sin Aula.'; }
        if (['20002', '20005'].includes(materia) && !/^\d{3}$/.test(grupoTutor)) {
            errores.SelectGrupoT = 'Escribe un grupo de tres cifras.';
        }
        if (materia === '20005' && !$('#selectGestion').val()) {
            errores.selectGestion = 'Selecciona una actividad de gestión.';
        }
        if (['20001', '20003'].includes(materia) && !$('#descripcion').val().trim()) {
            errores.descripcion = 'Completa las observaciones de la actividad.';
        }
        if (materia === '20006' && !$('#selectVinculacion').val()) {
            errores.selectVinculacion = 'Selecciona una actividad de vinculación.';
        }
        if (materia && !['20001', '20002', '20003', '20005', '20006'].includes(materia) && !$('#selectGrupo').val()) {
            errores.selectGrupo = 'Selecciona un grupo.';
        }
        if (Object.keys(errores).length) {
            PanelFormularios.errores(formularioHorario, errores);
            return;
        }
        $('#idsemana').val(this.id);
        enviarBloque('/agrega_horario', 'Bloque agregado al horario.');
    });
  $(".elimina").click(function(){
      var id=$(this).attr('id');//rhps

      var did=$(this).data('mat'); //materia
      $('#id_materia').val(did);
      $('#confirma_elimina').data('id',id);

      $('#modal_elimina').modal('show');
    });

    $('#confirma_elimina').click(function () {
        const id = $(this).data('id');
        if (!id) { return; }
        $('#decision').val(Number($('#id_materia').val()) > 20000 ? 2 : 1);
        $('#idaula').val(id);
        enviarBloque('/elimina_horario', 'Bloque retirado del horario.');
    });

    $.unblockUI();
    const codigo = Number($('#notifi').val());
    const aviso = document.querySelector('#notificacion' + codigo + ' [data-aviso-horario]');
    if (codigo > 0) {
        PanelFormularios.alerta('warning', 'Revisa la asignación', aviso?.textContent.trim() || 'El bloque no se pudo asignar.');
    }
});

@if($ok=="false")
  $('.bloqueo').removeClass('disabled');
  $('#selectMateria').prop('disabled', false);
  $('#selectProfesor').prop('disabled', false);
  $('#notifi_bloqueo').hide(1000);
@else
    $('.bloqueo').addClass('disabled');
    $('#selectProfesor').prop('disabled', true);
    $('#notifi_bloqueo').show(1000);
@endif
        </script>

