@extends('layouts.panel')
@section('title', 'Armar Horarios')
@include('partials.panel.recursos_app', ['blockui' => true, 'validacion' => true])
@include('partials.panel.formularios')
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="todo">
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
        <x-panel.encabezado titulo="CREACIÓN DE HORARIOS" />
      </div>
    <div class="cont tw:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                        <div class="tw:p-5 tw:sm:p-6">
                <form id="form_arma_horario" class="" role="form" method="POST">
                  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                    {{ csrf_field() }}
                    <input type="hidden" value="" id="idsemana" name="idsemana"/>
                    <input type="hidden" value="" id="decision" name="decision"/>
                    <input type="hidden" value="" id="idaula" name="idaula"/> <!-- RHPS -->
                    <input type="hidden" value="" id="mat" name="mat"/>
                    <input type="hidden" value="{{ $id_profesor }}" id="tprof" name="tprof"/>
                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                    <div class="tw:mb-4">
                        <div class="dropdown">
                          <label for="dropdownMenu1">Profesor</label>
                                <select name="selectProfesor" id="selectProfesor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                                  <option disabled selected>Selecciona...</option>
                                    @foreach($personales as $personal)
                                  @if($personal->id_personal==$id_profesor)
                                  <option value="{{$id_profesor}}" selected="selected">{{$personal->nombre}}</option>
                                  @else
                                  <option value="{{$personal->id_personal}}" >{{$personal->nombre}}</option>
                                  @endif
                                @endforeach
                                </select>
                        </div>
                      </div>
                  </div>
@if($activo==1)
  <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                  <div class="tw:mb-4">
                      <div class="dropdown">
                        <label for="dropdownMenu1">Tipo/hora</label>
                       <select name="selectTipoHr" id="selectTipoHr" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                          <option disabled selected>Selecciona...</option>
                          @if($tipo_cargo==3)
                                <option value="3" selected="selected">PROFESOR ASIGNATURA  "A"</option>
                                <option value="2">TECNICO DOCENTE ASIGNATURA "A"</option>
                              @endif
                              @if($tipo_cargo==4)
                                <option value="4" selected="selected">PROFESOR ASIGNATURA "B"</option>
                                <option value="2">TECNICO DOCENTE ASIGNATURA "A"</option>
                                <option value="3">PROFESOR ASIGNATURA  "A"</option>
                              @endif
                            @foreach($cargos as $cargo)
                              @if($cargo->id_cargo==$tipo_cargo&&$tipo_cargo!=3&&$tipo_cargo!=4)
                                <option value="{{$cargo->id_cargo}}" selected="selected">{{$cargo->cargo}}</option>
                              @endif
                            @endforeach
                       </select>
                    </div>
                  </div>
                  </div>
                                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                    <div class="tw:mb-4">
                      <div class="dropdown">
                        <label for="dropdownMenu1">Materias</label>
                       <select name="selectMateria" id="selectMateria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                          <option disabled selected>Selecciona...</option>
                  @if($id_carrera==9)
                    <option value="20005">ACTIVIDADES DE APOYO A LA DOCENCIA</option>
                  @else
                          <optgroup label="Materias">
                          @foreach($materias as $materia)
                            <option value="{{ $materia->id_materia }}" data-toggle="tooltip" data-placement="top" title="{{ $materia->clave }}">{{ $materia->nombre }}</option>
                          @endforeach
                        </optgroup>
                        <optgroup label="Extra Clase">
                            @foreach($extras as $extra)
                              <option value="{{ $extra->id_hrs_actividad_extra }}">{{ $extra->descripcion }}</option>
                            @endforeach
                        </optgroup>
                  @endif
                       </select>
                       @if($errors -> has ('selectMateria'))
                          <span class="tw:text-sm tw:text-red-600 tw:dark:text-red-400">{{ $errors -> first('selectMateria') }}</span>

                      @endif
                    </div>
                  </div>
                  </div>
                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                    <div class="tw:mb-4">
                      <div class="dropdown">
                        <label for="dropdownMenu1">Aulas</label>
                       <select name="selectAula" id="selectAula" class="checar_a tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                          <option disabled selected>Selecciona...</option>
                          <optgroup label="Aulas Carrera">
                          <option value="0">Sin Aula</option>
                          @foreach($aulas as $aula)
                            <option value="{{ $aula->id_aula }}">{{ $aula->nombre }}</option>
                          @endforeach
                        </optgroup>
                          <optgroup label="Aulas Compartidas" >
                          @foreach($aula_comp as $a_comp)
                            <option value="{{ $a_comp->id_aula }}">{{ $a_comp->nombre }}</option>
                          @endforeach
                          </optgroup>
                       </select>
                       @if($errors -> has ('selectAula'))
                          <span class="tw:text-sm tw:text-red-600 tw:dark:text-red-400">{{ $errors -> first('selectAula') }}</span>

                      @endif
                    </div>
                  </div>
                  </div>
@endif
                  <div class="tw:w-full tw:lg:w-4/12 tw:px-2" id="div_descripcion" style="display:none">
                     <div class="tw:mb-4">
                      <label for="descripcion" id="label_descripcion" value=""></label>
                      <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion" name="descripcion">
                    </div>
                  </div>

                <div class="tw:w-full tw:lg:w-4/12 tw:px-2" id="div_gestion" style="display:none;padding-left: 8px;">
                     <div class="tw:mb-4">
                      <label for="selectGestion" id="label_descripcion_ges" value=""></label>
                        <select name="selectGestion" id="selectGestion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                            <option disabled selected>Elige...</option>
                              @foreach($act_gestion as $actges)
                                <option value="{{ $actges->id_act_extra_clase }}">{{ $actges->actividad }}</option>
                              @endforeach
                          </select>
                      </div>
                </div>
                <div class="tw:w-full tw:lg:w-1/12 tw:px-2" id="div_but_ges" style="display:none;margin-top:2em;padding-left: 0px;">
                    {{--
                  <button type="button" class="but_ges tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"><span class="fa fa-plus" aria-hidden="true"></span></button>
--}}
                </div>

                 <div class="tw:w-full tw:lg:w-4/12 tw:px-2" id="div_vinculacion" style="display:none">
                     <div class="tw:mb-4">
                      <label for="descripcion" id="label_descripcion_vin" value=""></label>
                        <select name="selectVinculacion" id="selectVinculacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                            <option disabled selected>Elige...</option>
                              @foreach($act_vincu as $actvin)
                                <option value="{{ $actvin->id_act_extra_clase }}">{{ $actvin->actividad }}</option>
                              @endforeach
                          </select>
                    </div>
                  </div>
                <div class="tw:w-full tw:lg:w-1/12 tw:px-2" id="div_but_vin" style="display:none;margin-top:2em;padding-left: 0px;">

                  <button type="button" class="but_vin tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"><span class="fa fa-plus" aria-hidden="true"></span></button>

                </div>

                  <div class="tw:w-full tw:lg:w-2/12 tw:px-2" id="div_grupo" style="display:none">
                         <div class="tw:mb-4">
                      <div class="dropdown">
                        <label for="selectGrupo">Grupo</label>
                       <select name="selectGrupo" id="selectGrupo" class="checar_g tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        <option disabled selected>Elige...</option>
                          @for ($i = 1; $i <=15; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                      </select>
                    </div>
                  </div>
                  </div>
                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2" id="div_grupo_t" style="display:none">
                         <div class="tw:mb-4">
                      <div class="dropdown">
                        <label for="SelectGrupoT">Grupo</label>
                          <input type="number" pattern=".{3,}" required title="Grupo con 3 caracteres" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="SelectGrupoT" name="SelectGrupoT" placeholder="000">
                    </div>
                  </div>
                  </div>
                  </div>
              </form>
            </div>
                </div>

<div class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:relative tw:pr-10 tw:lg:w-full tw:px-2" role="alert" id="notifi_materia" style="display:none">
    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  No terminaste tu registro de horas para : {{ $falta_materia }}
</div>

        </div>
        </div>


@if($activo==1)

<div id="contenedor_horarios" class="tw:min-w-0 tw:w-full">

</div>

@endif

</main>
@foreach ([
    1 => 'El docente ya se encuentra ocupado',
    2 => 'El aula ya se encuentra ocupada',
    3 => 'Límite de horas cubiertas para esta materia',
    4 => 'Solo puedes agregar materias especiales',
    5 => 'El grupo debe ser el mismo para esta materia especial',
    6 => 'El grupo ya se encuentra ocupado',
    7 => 'La materia debe ser la misma para esta materia especial',
    8 => 'El aula debe ser la misma para esta materia especial',
    9 => 'El grupo ya tiene un docente para esta materia',
] as $numero => $aviso)
    <x-panel.modal :id="'notificacion'.$numero" titulo="Revisa la asignación" tamano="sm" aria-label="Revisa la asignación">
        <p data-aviso-horario>{{ $aviso }}</p>
        <x-slot:pie><x-panel.boton data-dismiss="modal">Aceptar</x-panel.boton></x-slot:pie>
    </x-panel.modal>
@endforeach

<x-panel.modal id="modal_crea_act" titulo="Agregar actividad" sin-relleno estatico aria-label="Agregar actividad">
    <form data-panel-validar id="form_crea_act" method="POST">
        @csrf
        <input type="hidden" id="id_act" name="id_act">
        <input type="hidden" id="tipo_act" name="tipo_act">
        <div class="tw-modal-cuerpo tw:space-y-3">
            <x-panel.input etiqueta="Nombre de la actividad" id="nombre_act" name="nombre_act" maxlength="100" required />
            <p id="error_actividad_horario" role="alert" class="tw:text-sm tw:text-red-600 tw:dark:text-red-400"></p>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" id="guarda_act">Guardar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="modal_periodo_change" titulo="Vigencia del horario" tamano="sm" sin-relleno aria-label="Vigencia del horario">
    <form data-panel-validar id="form_vigencia_horario">
        <div class="tw-modal-cuerpo tw:space-y-3">
            <x-panel.select etiqueta="Tipo de contrato" name="seleccionar_tiempo" id="seleccionar_tiempo" required>
                <option value="">Selecciona una opción</option>
                <option value="1">Definitivo</option>
                <option value="2">Temporal</option>
            </x-panel.select>
            <div id="div_fecha_temporal" style="display:none">
                <x-panel.input etiqueta="Fecha de inicio" id="fecha_inicio_periodo_temporal" type="date" :value="$inicio_periodo ?? ''" />
            </div>
            <div id="div_fecha_definitiva" style="display:none" class="tw:space-y-3">
                <x-panel.input etiqueta="Fecha de inicio" id="fecha_inicio_periodo_definitiva" type="date" :value="$inicio_periodo ?? ''" />
                <x-panel.input etiqueta="Fecha final" id="fecha_final_periodo" type="date" :value="$final_periodo ?? ''" />
            </div>
            <p id="error_vigencia_horario" role="alert" class="tw:text-sm tw:text-red-600 tw:dark:text-red-400"></p>
        </div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" id="link_imprime_pdf">Abrir PDF</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<script>

function bloqueo()
{
    $.blockUI({
    });
}

$("#seleccionar_tiempo").on('change', function(e){

    var tiempo = e.target.value;

    if(tiempo == 1){

    $("#div_fecha_temporal").css("display", "block");
    $("#div_fecha_definitiva").css("display", "none");

} else if(tiempo == 2){
    $("#div_fecha_definitiva").css("display", "block");
    $("#div_fecha_temporal").css("display", "none");
}

});

$(document).ready(function() {

    $("#form_vigencia_horario").on("submit", function (event) {
        event.preventDefault();
        if (!PanelFormularios.validar(this)) { return; }
        const tiempo = $("#seleccionar_tiempo").val();
        const campoInicio = tiempo === '1' ? 'fecha_inicio_periodo_temporal' : 'fecha_inicio_periodo_definitiva';
        const inicio = $('#' + campoInicio).val();
        const fin = $("#fecha_final_periodo").val() || (tiempo === '1' ? inicio : '');
        const error = $('#error_vigencia_horario');
        if (!inicio || !fin || (tiempo === '2' && fin < inicio)) {
            const errores = {};
            if (!inicio) { errores[campoInicio] = 'Selecciona la fecha de inicio.'; }
            if (tiempo === '2' && (!fin || (inicio && fin < inicio))) {
                errores.fecha_final_periodo = 'Selecciona una fecha final igual o posterior al inicio.';
            }
            PanelFormularios.errores(this, errores);
            return;
        }
        error.empty();
        const ruta = @json(url('/crear_pdf')) + '/' + [@json($id_profesor), inicio, tiempo, fin].map(encodeURIComponent).join('/');
        window.open(ruta, '_blank', 'noopener');
        $('#modal_periodo_change').modal('hide');
    });

$.post("/crear_horarios", $("#form_arma_horario").serialize(),function(request)
        {
          $("#contenedor_horarios").html(request);
          $.unblockUI();
        });

  $("#selectProfesor").on('change',function(e){
    bloqueo();
      var id_profesor= $("#selectProfesor").val();
      $("#tprof").val(id_profesor);
      window.location.href='/ver/profesores/'+id_profesor;

    });

$("#selectMateria").on('change',function(e){
  var id_materia=$("#selectMateria").val();
  $("#mat").val(id_materia);
  var id_doc=$("#tprof").val();

      if(id_materia==20001) //RESIDENCIA
      {
        document.getElementById('label_descripcion').innerHTML = 'Observaciones';
        $("#div_descripcion").show(1000);
        $("#descripcion").val("");
        $("#div_grupo").hide(1000);
        $("#div_vinculacion").hide(1000);
        $("#label_descripcion_vin").hide(1000);
        $("#div_gestion").hide(1000);
        $("#label_descripcion_ges").hide(1000);
        $("#div_but_ges").hide(1000);
        $("#div_grupo_t").hide(1000);
        $("#div_but_vin").hide(1000);
      }
      else if(id_materia==20002) //TUTORIAS
      {
        $("#div_descripcion").hide(1000);
        $("#div_vinculacion").hide(1000);
        $("#label_descripcion_vin").hide(1000);
        $("#div_gestion").hide(1000);
        $("#label_descripcion_ges").hide(1000);
        $("#div_grupo").hide(1000);
        $("#div_grupo_t").show(1000);
        $("#SelectGrupoT").val("");
        $("#div_but_ges").hide(1000);
        $("#div_but_vin").hide(1000);
      }
      else if(id_materia==20003) //INVESTIGACION
      {
        document.getElementById('label_descripcion').innerHTML = 'Nombre del Proyecto';
        $("#div_grupo").hide(1000);
        $("#descripcion").val("");
        $("#div_vinculacion").hide(1000);
        $("#label_descripcion_vin").hide(1000);
        $("#div_gestion").hide(1000);
        $("#label_descripcion_ges").hide(1000);
        $("#div_descripcion").show(1000);
        $("#div_but_ges").hide(1000);
        $("#div_but_vin").hide(1000);
        $("#div_grupo_t").hide(1000);
      }
      else if(id_materia==20005) //GESTION
      {
        document.getElementById('label_descripcion_ges').innerHTML = 'Actividad';
        $("#label_descripcion_ges").show(1000);
        $("#div_but_ges").show(1000);
        $("#div_but_vin").hide(1000);
        $("#div_gestion").show(1000);
        $("#div_grupo").hide(1000);
        $("#div_grupo_t").show(1000);
        $("#SelectGrupoT").val("");
        $("#div_descripcion").hide(1000);
        $("#div_vinculacion").hide(1000);
        $("#label_descripcion_vin").hide(1000);
      }
      else if(id_materia==20006) //VINCULACION
      {
        document.getElementById('label_descripcion_vin').innerHTML = 'Actividad';
        $("#label_descripcion_vin").show(1000);
        $("#div_but_vin").show(1000);
        $("#div_descripcion").hide(1000);
        $("#div_but_ges").hide(1000);
        $("#div_grupo").hide(1000);
        $("#div_gestion").hide(1000);
        $("#descripcion").val("");
        $("#label_descripcion_ges").hide(1000);
        $("#div_vinculacion").show(1000);
        $("#div_grupo_t").hide(1000);
      }
      else
      {
        $("#div_grupo").show(1000);
        $("#div_descripcion").hide(1000);
        $("#div_vinculacion").hide(1000);
        $("#label_descripcion_vin").hide(1000);
        $("#div_gestion").hide(1000);
        $("#label_descripcion_ges").hide(1000);
       $("#div_but_ges").hide(1000);
        $("#div_but_vin").hide(1000);
        $("#div_grupo_t").hide(1000);

      }
    });

 $(".checar_g").change(function(e)
  {
    bloqueo();
      $.post("/comprueba/creditos", $("#form_arma_horario").serialize(),function(request)
        {
          $.unblockUI();
          $("#contenedor_horarios").html(request);
        });
    });

  $(".checar_a").change(function(e)
  {
    bloqueo();
      $.post("/crear_horarios", $("#form_arma_horario").serialize(),function(request)
        {
          $.unblockUI();
          $("#contenedor_horarios").html(request);
        });
    });


    const modalActividad = $('#modal_crea_act');
    const botonActividad = $('#guarda_act');
    const errorActividad = $('#error_actividad_horario');
    modalActividad.on('shown.bs.modal', function () {
        $('#nombre_act').trigger('focus');
    }).on('hide.bs.modal', function (event) {
        if (botonActividad.prop('disabled')) { event.preventDefault(); }
    }).on('hidden.bs.modal', function () {
        const selector = $('#tipo_act').val() === '1' ? '.but_ges' : '.but_vin';
        $(selector).trigger('focus');
    });

    $('.but_ges, .but_vin').on('click', function () {
        const id = $('#selectMateria').val();
        if (!id) { return; }
        $('#tipo_act').val($(this).hasClass('but_ges') ? '1' : '2');
        $('#id_act').val(id);
        $('#nombre_act').val('');
        errorActividad.empty();
        modalActividad.modal('show');
    });

    $('#form_crea_act').on('submit', function (event) {
        event.preventDefault();
        if (botonActividad.prop('disabled') || !PanelFormularios.validar(this)) { return; }
        const formulario = this;
        const tipo = $('#tipo_act').val();
        const id = $('#id_act').val();
        const nombre = $('#nombre_act').val().trim();

        const gestion = tipo === '1';
        const select = document.getElementById(gestion ? 'selectGestion' : 'selectVinculacion');
        errorActividad.empty();
        botonActividad.prop('disabled', true);
        let guardada = false;
        $.getJSON(@json(url('/agrega/act')) + '/' + [tipo, id, nombre].map(encodeURIComponent).join('/'))
            .done(function (resultado) {
                const actividades = resultado?.[gestion ? 'act_gestion' : 'act_vincu'];
                if (!Array.isArray(actividades)) {
                    errorActividad.text('No se pudo confirmar el guardado.');
                    PanelFormularios.alerta('error', 'Respuesta inesperada', errorActividad.text());
                    return;
                }
                const seleccionAnterior = select.value;
                select.replaceChildren(new Option('Elige…', ''));
                select.options[0].disabled = true;
                actividades.forEach(function (actividad) {
                    select.add(new Option(actividad.actividad, actividad.id_act_extra_clase));
                });
                select.value = resultado.agregada ?? seleccionAnterior;
                if (select.selectedIndex < 0) { select.selectedIndex = 0; }
                guardada = true;
            }).fail(function (xhr) {
                errorActividad.text('No se pudo guardar la actividad.');
                PanelFormularios.fallo(formulario, xhr, errorActividad.text());
            }).always(function () {
                botonActividad.prop('disabled', false);
                if (guardada) {
                    modalActividad.modal('hide');
                    PanelFormularios.alerta('success', 'Actividad guardada', 'La actividad ya está en la lista.');
                }
            });
    });

});
//console.log("{{ $act }}")
@if($act=="false")
  $('#notifi_materia').hide(1000);
@else
  $('#notifi_materia').show(1000);
@endif
        </script>

@endsection
