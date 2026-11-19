@extends('layouts.panel')
@section('title', 'Armar Horarios')
@include('partials.panel.recursos_app', ['blockui' => true, 'datepicker' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="CREACIÓN DE HORARIOS" />

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-5xl" id="todo">
        <form id="form_arma_horario" class="form" role="form" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="" id="idsemana" name="idsemana"/>
            <input type="hidden" value="" id="decision" name="decision"/>
            <input type="hidden" value="" id="idaula" name="idaula"/> <!-- RHPS -->
            <input type="hidden" value="" id="mat" name="mat"/>
            <input type="hidden" value="{{ $id_profesor }}" id="tprof" name="tprof"/>

            <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-3">
                <div class="tw:min-w-0">
                    <x-panel.select etiqueta="Profesor" name="selectProfesor" id="selectProfesor">
                        <option disabled selected>Selecciona...</option>
                        @foreach($personales as $personal)
                            @if($personal->id_personal==$id_profesor)
                                <option value="{{$id_profesor}}" selected="selected">{{$personal->nombre}}</option> 
                            @else
                                <option value="{{$personal->id_personal}}">{{$personal->nombre}}</option>                              
                            @endif
                        @endforeach
                    </x-panel.select>
                </div>

                @if($activo==1)
                <div class="tw:min-w-0">
                    <x-panel.select etiqueta="Tipo/hora" name="selectTipoHr" id="selectTipoHr">
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
                    </x-panel.select>
                </div>

                <div class="tw:min-w-0">
                    <div class="form-group">  
                        <div class="dropdown">
                            <label for="selectMateria" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300">Materias</label>
                            <select name="selectMateria" id="selectMateria" class="tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white">
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
                                <span style="color:red;">{{ $errors -> first('selectMateria') }}</span>
                                <style>
                                #selectMateria { border:solid 1px red; }
                                </style>
                            @endif
                        </div>  
                    </div>
                </div>

                <div class="tw:min-w-0">
                    <div class="form-group">  
                        <div class="dropdown">
                            <label for="selectAula" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300">Aulas</label>
                            <select name="selectAula" id="selectAula" class="checar_a tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white">
                                <option disabled selected>Selecciona...</option>
                                <optgroup label="Aulas Carrera">
                                    <option value="0">Sin Aula</option>
                                    @foreach($aulas as $aula)       
                                        <option value="{{ $aula->id_aula }}">{{ $aula->nombre }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Aulas Compartidas">
                                    @foreach($aula_comp as $a_comp)       
                                        <option value="{{ $a_comp->id_aula }}">{{ $a_comp->nombre }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @if($errors -> has ('selectAula'))
                                <span style="color:red;">{{ $errors -> first('selectAula') }}</span>
                                <style>
                                #selectAula { border:solid 1px red; }
                                </style>
                            @endif
                        </div>  
                    </div>
                </div> 
                @endif

                <div class="tw:min-w-0" id="div_descripcion" style="display:none">
                    <div class="form-group">
                        <label for="descripcion" id="label_descripcion" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300"></label>
                        <input type="text" class="tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white" id="descripcion" name="descripcion">
                    </div>
                </div>

                <div class="tw:min-w-0" id="div_gestion" style="display:none">
                    <div class="form-group">
                        <label for="selectGestion" id="label_descripcion_ges" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300"></label>
                        <select name="selectGestion" id="selectGestion" class="tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white">
                            <option disabled selected>Elige...</option>
                            @foreach($act_gestion as $actges)
                                <option value="{{ $actges->id_act_extra_clase }}">{{ $actges->actividad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="div_but_ges" style="display:none" class="tw:flex tw:items-end"></div>

                <div class="tw:min-w-0" id="div_vinculacion" style="display:none">
                    <div class="form-group">
                        <label for="selectVinculacion" id="label_descripcion_vin" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300"></label>
                        <select name="selectVinculacion" id="selectVinculacion" class="tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white">
                            <option disabled selected>Elige...</option>
                            @foreach($act_vincu as $actvin)
                                <option value="{{ $actvin->id_act_extra_clase }}">{{ $actvin->actividad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="div_but_vin" style="display:none" class="tw:flex tw:items-end">
                    <button type="button" class="btn btn-primary but_vin"><span class="fa fa-plus" aria-hidden="true"></span></button>
                </div>

                <div class="tw:min-w-0" id="div_grupo" style="display:none">
                    <div class="form-group">  
                        <div class="dropdown">
                            <label for="selectGrupo" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300">Grupo</label>
                            <select name="selectGrupo" id="selectGrupo" class="checar_g tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white">
                                <option disabled selected>Elige...</option>
                                @for ($i = 1; $i <=15; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select> 
                        </div> 
                    </div>
                </div> 

                <div class="tw:min-w-0" id="div_grupo_t" style="display:none">
                    <div class="form-group">  
                        <div class="dropdown">
                            <label for="SelectGrupoT" class="tw:block tw:text-xs tw:font-semibold tw:uppercase tw:tracking-wider tw:text-gray-600 tw:dark:text-gray-300">Grupo</label>
                            <input type="number" pattern=".{3,}" required title="Grupo con 3 caracteres" class="tw:mt-1 tw:block tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white" id="SelectGrupoT" name="SelectGrupoT" placeholder="000">
                        </div> 
                    </div>
                </div>  
            </div> 
        </form>
    </x-panel.tarjeta>

    <div class="alert alert-danger alert-dismissible" role="alert" id="notifi_materia" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        No terminaste tu registro de horas para : {{ $falta_materia }}
    </div>

    @if($activo==1)
    <div id="contenedor_horarios">
    </div>
    @endif

</main>

<!-- MODAL DE DOCENTE OCUPADO-->
<div id="notificacion1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel1">El docente ya se encuentra ocupado</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE AULA OCUPADA-->
<div id="notificacion2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel2">El aula ya se encuentra ocupada</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE LIMITES CUBIERTOS-->
<div id="notificacion3" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel3">Límite de hrs cubiertas para ésta materia</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE NOTIFICACION ESPECIAL-->
<div id="notificacion4" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel4">Sólo puedes agregar materias especiales</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE GRUPO ESPECIAL-->
<div id="notificacion5" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel5">El grupo debe ser el mismo para ésta materia especial</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE GRUPO OCUPADO-->
<div id="notificacion6" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel6">El grupo ya se encuentra ocupado</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE MATERIA ESPECIAL-->
<div id="notificacion7" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel7">La materia debe ser la misma para ésta materia especial</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE AULA ESPECIAL-->
<div id="notificacion8" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel8">El aula debe ser la misma para ésta materia especial</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DE GRUPO OCUPADO 9-->
<div id="notificacion9" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title" id="exampleModalLabel9">El grupo ya tiene un docente para ésta materia</h4>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal para crear actividad de gestion y vinculacion-->
<form id="form_crea_act" class="form" role="form" method="POST">
<div class="modal fade" id="modal_crea_act" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelAct">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabelAct">Agregar Actividad</h4>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
                     <div class="form-group">
                      <label>Nombre/Actividad:</label>
                      <input type="hidden" id="id_act" name="id_act" value="" />
                      <input type="hidden" id="tipo_act" name="tipo_act" value=""/>
                      <input type="text" class="form-control" id="nombre_act" name="nombre_act" placeholder="Nombre...">
                      @if($errors -> has ('nombre_act'))
                          <span style="color:red;">{{ $errors -> first('nombre_act') }}</span>
                         <style>
                          #nombre_act
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>          
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input id="guarda_act" type="button" class="btn btn-primary" value="Guardar"/>
      </div>
    </div>
  </div>
</div>
</form>

<!--Modal para cambio periodo-->
<div id="modal_periodo_change" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabelPeriodo">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title" id="exampleModalLabelPeriodo">Fecha de Inicio de Vigencia</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="seleccionar_tiempo">Selecciona que tipo de contrato tiene</label>
                    <select name="seleccionar_tiempo" id="seleccionar_tiempo" class="form-control">
                      <option disabled selected>Elige...</option>
                      <option value="1">Definitivo</option>
                      <option value="2">Temporal</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="row" id="div_fecha_temporal" style="display:none">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="fecha_inicio_periodo_temporal" class="form-control-label">Fecha</label>
                    <input id="fecha_inicio_periodo_temporal" type="text" class="form-control" value="{{ isset($inicio_periodo)?$inicio_periodo:'' }}">
                  </div>
                </div>
            </div>
            <div class="row" id="div_fecha_definitiva" style="display:none">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fecha_inicio_periodo_definitiva" class="form-control-label">Fecha inicial</label>
                        <input id="fecha_inicio_periodo_definitiva" type="text" class="form-control fecha_inicio_periodo_definitiva" value="{{ isset($inicio_periodo)?$inicio_periodo:'' }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fecha_final_periodo" class="form-control-label">Fecha final</label>
                        <input id="fecha_final_periodo" type="text" class="form-control fecha_final_periodo" value="{{ isset($final_periodo)?$final_periodo:'' }}">
                    </div>
                </div>
            </div>
        </form>
      </div>
        <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <a type="button" id="link_imprime_pdf" class="btn btn-default btn-success" href="#!" data-dismiss="modal" target="_blank">Aceptar</a>
        </div>
    </div>
  </div>
</div>

<script>
function bloqueo()
{
    $.blockUI({});
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

$('#fecha_inicio_periodo_temporal').datepicker({
    format: "yyyy-mm-dd",
    language: "es",
    autoclose: true
});

$('.fecha_inicio_periodo_definitiva').datepicker({
    format: "yyyy-mm-dd",
    language: "es",
    autoclose: true
});

$('.fecha_final_periodo').datepicker({
    format: "yyyy-mm-dd",
    language: "es",
    autoclose: true
});

$(document).ready(function() {

    $("#link_imprime_pdf").click(function(event) {
        var tiempo = $("#seleccionar_tiempo").val();
        var init_periodo = $("#fecha_inicio_periodo_temporal").val();
        var fin_periodo = $("#fecha_final_periodo").val();

        if(tiempo == 1){
            var link = "/crear_pdf/{{ $id_profesor }}/"
                + init_periodo
                + "/"
                + tiempo
                + "/"
                + fin_periodo;
        } else {
            var init_periodo = $("#fecha_inicio_periodo_definitiva").val();
            var fin_periodo = $("#fecha_final_periodo").val();

            var link = "/crear_pdf/{{ $id_profesor }}/"
                + init_periodo
                + "/"
                + tiempo
                + "/"
                + fin_periodo;
        }

        console.log("URL:", link);
        window.open(link, '_blank');
    });

    $.post("/crear_horarios", $("#form_arma_horario").serialize(),function(request) {
        $("#contenedor_horarios").html(request);  
        $.unblockUI(); 
    });

    $("#selectProfesor").on('change',function(e){
        bloqueo();
        var id_profesor= $("#selectProfesor").val();
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

    $(".checar_g").change(function(e) {
        bloqueo();
        $.post("/comprueba/creditos", $("#form_arma_horario").serialize(),function(request) {
            $.unblockUI();
            $("#contenedor_horarios").html(request);
        });
    });

    $(".checar_a").change(function(e) {
        bloqueo();
        $.post("/crear_horarios", $("#form_arma_horario").serialize(),function(request) {
            $.unblockUI();
            $("#contenedor_horarios").html(request);
        });
    });

    $(".but_ges").click(function(event){
        var num=1;
        $("#tipo_act").val(num);
        var id_act= $("#selectMateria").val();
        $("#id_act").val(id_act);
        $("#modal_crea_act").modal('show');
    });

    $(".but_vin").click(function(event){
        var num=2;
        $("#tipo_act").val(num);
        var id_act= $("#selectMateria").val();
        $("#id_act").val(id_act);
        $("#modal_crea_act").modal('show');
    });

    $("#guarda_act").click(function(event){
        var tipo= $("#tipo_act").val();
        var idact=$("#id_act").val();
        var nombre=$("#nombre_act").val();
        if(tipo==1)
        {
            $("#selectGestion").empty();
            $.get('/agrega/act/'+tipo+'/'+idact+'/'+nombre,{},function(request){
                var datos=request['act_gestion'];
                var act1='<option disabled selected>Elige...</option>';
                $("#selectGestion").append(act1);
                for (var i=0; i<datos.length ; i++) 
                {
                    var act='<option value="'+datos[i].id_act_extra_clase+'">'+datos[i].actividad+'</option>';
                    $("#selectGestion").append(act);
                }
            }); 
            $("#modal_crea_act").modal("hide");
        }
        else
        {
            $("#selectVinculacion").empty();
            $.get('/agrega/act/'+tipo+'/'+idact+'/'+nombre,{},function(request){
                var datos=request['act_vincu']; 
                var act1='<option disabled selected>Elige...</option>';
                $("#selectVinculacion").append(act1);
                for (var i=0; i<datos.length ; i++) 
                {
                    var act='<option value="'+datos[i].id_act_extra_clase+'">'+datos[i].actividad+'</option>';
                    $("#selectVinculacion").append(act);
                }
            }); 
            $("#modal_crea_act").modal("hide");
        }
    }); 

});

@if($act=="false")
    $('#notifi_materia').hide(1000);
@else
    $('#notifi_materia').show(1000);
@endif
</script>

@endsection