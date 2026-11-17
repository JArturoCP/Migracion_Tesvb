@extends('layouts.app')
@section('title', 'Modificación Docentes')
@section('content')

<main class="col-md-12">

  <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
  $directivo=session()->has('directivo')?session()->has('directivo'):false;?>

<div class="row">
  <div class="col-md-10 col-xs-10 col-md-offset-1">
    <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title text-center">Modificación de Personal</h3>
        </div>
              <div class="panel-body">

                <div id="warninn" class="alert alert-danger" role="alert" style="display:none;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>La fecha de Nacimiento ingresada es incorrecta</strong>
            </div>

<form id="form_docente_edita" class="form-horizontal" role="form" method="POST" action="/docente/{{ $docente_edit->id_personal }}" novalidate>
  <input type="hidden" name="_method" value="PUT" />
                  {{ csrf_field() }}

            <div class="row">
                <div class="col-md-3 col-md-offset-1" >
                     <div class="form-group">
                      <label for="nombre_docente">Nombre Completo</label>
                      <input type="text" id="caja-error" class="form-control" value="{{ $docente_edit->nombre}}" name="nombre_docente" placeholder="Nombre" style="text-transform:uppercase">
                      @if($errors -> has ('nombre_docente'))
                          <span style="color:red;">{{ $errors -> first('nombre_docente') }}</span>
                         <style>
                          #caja-error
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div> 
                  <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">
                      <label for="clave_docente">Clave Docente(ISSEMyM)</label>
                      <input type="text" class="form-control" maxlength="8" id="caja-error1" value="{{ $docente_edit->clave}}" name="clave_docente" placeholder="Clave">
                      @if($errors -> has ('clave_docente'))
                          <span style="color:red;">{{ $errors -> first('clave_docente') }}</span>
                          <style>
                          #caja-error1
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">
                      <label for="rfc">RFC</label>
                      <input type="text" id="caja-error2" class="form-control"  maxlength="13" value="{{ $docente_edit->rfc}}" name="rfc" placeholder="RFC" style="text-transform:uppercase">
                      @if($errors -> has ('rfc'))
                          <span style="color:red;">{{ $errors -> first('rfc') }}</span>
                         <style>
                          #caja-error2
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>

            </div>
            <div class="row">
                  <div class="col-md-3 col-md-offset-1">
                     <div class="form-group">
                      <label for="esc_p">Esc. de Procedencia</label>
                      <input type="text" class="form-control" id="caja-error3" value="{{ $docente_edit->esc_procedencia}}" name="esc_p" placeholder="Escuela..." style="text-transform:uppercase">
                      @if($errors -> has ('esc_p'))
                          <span style="color:red;">{{ $errors -> first('esc_p') }}</span>
                         <style>
                          #caja-error3
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                <div class="col-md-3 col-md-offset-1 ">
                    <div class="form-group">
                      <label for="dir">Direccion(Calle,No.,Localidad)</label>
                      <input type="text" class="form-control" id="caja-error4" value="{{ $docente_edit->direccion}}" name="dir" placeholder="Calle y número.." style="text-transform:uppercase">
                      @if($errors -> has ('dir'))
                          <span style="color:red;">{{ $errors -> first('dir') }}</span>
                         <style>
                          #caja-error4
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-2 col-md-offset-1 ">
                    <div class="form-group">
                      <label for="correo">Correo</label>
                      <input type="text" class="form-control" id="caja-error5" value="{{ $docente_edit->correo}}" name="correo" placeholder="Correo.." style="text-transform:uppercase">
                    </div>
                  </div>
            </div>
              <div class="row">
                   <div class="col-md-3 col-md-offset-1">
                    <div class="form-group">
                      <label for="telefono">Teléfono</label>
                      <input type="tel" class="form-control" value="{{ $docente_edit->telefono}}" id="caja-error8" name="telefono" placeholder="Teléfono..">
                      @if($errors -> has ('telefono'))
                          <span style="color:red;">{{ $errors -> first('telefono') }}</span>
                         <style>
                          #caja-error8
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-2 col-md-offset-1 ">
                    <div class="form-group">
                      <label for="o_nac">Lugar de Nacimiento</label>
                      <input type="text" class="form-control" id="caja-error6" name="o_nac" value="{{ $docente_edit->origen_nac}}" placeholder="Origen Nac." style="text-transform:uppercase">
                      @if($errors -> has ('o_nac'))
                          <span style="color:red;">{{ $errors -> first('o_nac') }}</span>
                         <style>
                          #caja-error6
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                 <div class="col-md-2 col-md-offset-1 ">
                  <div class="form-group">
                      <label for="f_nac">Fecha de Nacimiento</label>
                          <input type="text" class="form-control datepicker nac" id="caja-error7" value="{{ $docente_edit->fch_nac}}" name="f_nac" placeholder="AAAA/MM/DD">
                          @if($errors -> has ('f_nac'))
                          <span style="color:red;">{{ $errors -> first('f_nac') }}</span>
                         <style>
                          #caja-error7
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                  </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3 col-md-offset-1 ">
                  <div class="form-group">        
                      <div class="dropdown">
                        <label for="selectNombra">Nombramiento</label>
                                <select name="selectNombra" id="selectNombra" class="form-control ">
<option value="">Selecciona una opción</option>
<option value="T" @selected(strtoupper((string) old('selectNombra', $docente_edit->nombramiento)) === strtoupper('T'))>Temporal</option>
<option value="D" @selected(strtoupper((string) old('selectNombra', $docente_edit->nombramiento)) === strtoupper('D'))>Definitivo</option>
</select>
                    </div>
                    </div>      
                  </div>
                    <div class="col-md-2 col-md-offset-1 ">
                    <div class="form-group">
                      <label for="celular">Celular</label>
                      <input type="tel" class="form-control" value="{{ $docente_edit->celular}}" id="caja-error9" name="celular" placeholder="Celular..">
                      @if($errors -> has ('celular'))
                          <span style="color:red;">{{ $errors -> first('celular') }}</span>
                         <style>
                          #caja-error9
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">
                      <label for="cedula">Cedula</label>
                      <input type="number" class="form-control" maxlength="13" value="{{ $docente_edit->cedula}}" id="caja-error10" name="cedula" placeholder="Cedula..">
                      @if($errors -> has ('cedula'))
                          <span style="color:red;">{{ $errors -> first('cedula') }}</span>
                         <style>
                          #caja-error10
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
                </div>
                  
          <div class="row">
                <div class="col-md-3 col-md-offset-1">
                    <div class="form-group"> 
                    <label for="f_ingreso">Fecha de Ingreso</label> 
                          <input type="text" class="form-control datepicker normal" value="{{ $docente_edit->fch_ingreso_tesvb}}" id="caja-error11" name="f_ingreso" placeholder="AAAA/MM/DD">
                      @if($errors -> has ('f_ingreso'))
                          <span style="color:red;">{{ $errors -> first('f_ingreso') }}</span>
                         <style>
                          #caja-error11
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                      </div>  
                  </div>
                  <div class="col-md-2 col-md-offset-1 ">
                  <div class="form-group">    
                      <div class="dropdown">
                        <label for="selectEsc">Escolaridad</label>
                                <select id="selectEsc" name="selectEsc" class="form-control ">
<option value="">Selecciona una opción</option>
<option value="Tecnico" @selected(strtoupper((string) old('selectEsc', $docente_edit->escolaridad)) === strtoupper('Tecnico'))>Técnico</option>
<option value="Licenciatura" @selected(strtoupper((string) old('selectEsc', $docente_edit->escolaridad)) === strtoupper('Licenciatura'))>Licenciatura</option>
<option value="Maestria" @selected(strtoupper((string) old('selectEsc', $docente_edit->escolaridad)) === strtoupper('Maestria'))>Maestría</option>
<option value="Doctorado" @selected(strtoupper((string) old('selectEsc', $docente_edit->escolaridad)) === strtoupper('Doctorado'))>Doctorado</option>
<option value="Secundaria" @selected(strtoupper((string) old('selectEsc', $docente_edit->escolaridad)) === strtoupper('Secundaria'))>Secundaria</option>
<option value="Preparatoria" @selected(strtoupper((string) old('selectEsc', $docente_edit->escolaridad)) === strtoupper('Preparatoria'))>Preparatoria</option>
</select>
                    </div>
                  </div>
                  </div>
              <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">  
                      <div class="dropdown">
                        <label for="selectSexo">Sexo</label>
                                <select name="selectSexo" id="selectSexo" class="form-control ">
<option value="">Selecciona una opción</option>
<option value="M" @selected(strtoupper((string) old('selectSexo', $docente_edit->sexo)) === strtoupper('M'))>M</option>
<option value="F" @selected(strtoupper((string) old('selectSexo', $docente_edit->sexo)) === strtoupper('F'))>F</option>
</select>
                    </div>  
                  </div>
                  </div>
          </div>
          <div class="row">
                  <div class="col-md-3 col-md-offset-1">
                    <div class="form-group">
                      <label for="f_nac">Fecha de Contratacion</label>
                          <input type="text" class="form-control datepicker normal" value="{{ $docente_edit->fch_recontratacion }}" id="caja-error14" name="f_contrata" placeholder="AAAA/MM/DD">
                       @if($errors -> has ('f_contrata'))
                          <span style="color:red;">{{ $errors -> first('f_contrata') }}</span>
                         <style>
                          #caja-error14
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                  </div>
                  </div>
            <div class="col-md-2 col-md-offset-1 ">
                    <div class="form-group">
                      <label for="hrs_max_ingles">Hrs Max. Ingles</label>
                      <input type="number" disabled class="form-control" value="{{ $docente_edit->maximo_horas_ingles }}" id="caja-error13" name="hrs_max_ingles">
                      @if($errors -> has ('hrs_max_ingles'))
                          <span style="color:red;">{{ $errors -> first('hrs_max_ingles') }}</span>
                         <style>
                          #caja-error13
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
          <div class="col-md-2 col-md-offset-1 ">
                    <div class="form-group">
                      <label for="hrs_max">Horas Maximas</label>
                      <input type="number" disabled class="form-control" value="{{ $docente_edit->horas_maxima }}" id="caja-error12" name="hrs_max" placeholder="Horas M..">
                      @if($errors -> has ('hrs_max'))
                          <span style="color:red;">{{ $errors -> first('hrs_max') }}</span>
                         <style>
                          #caja-error12
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
          </div>

          <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                  <div class="form-group">              
                      <div class="dropdown">
                        <label for="selectSituacion">Situacion</label>
                                <select name="selectSituacion" id="selectSituacion" class="form-control ">
                                  <option disabled selected>Selecciona...</option>
                                   @foreach($situaciones as $situacion)
                                      @if($docente_edit->id_situacion==$situacion->id_situacion)
                                            <option value="{{$situacion->id_situacion}}" selected="selected">{{$situacion->situacion}}</option>
                                      @else
                                      <option value="{{$situacion->id_situacion}}">{{$situacion->situacion}}</option>
                                      @endif
                                    @endforeach
                                </select>
                    </div> 
                    </div>       
              </div>
                             <div class="col-md-1 ml" style="margin-top:3em;padding-left: 0px;margin-left: 10px;">
                  <button type="button" class="btn btn-primary b_situacion"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                </div>

                <div class="col-md-3 col-md-offset-1" style="margin-left: 0px;">
                         <div class="form-group">  
                      <div class="dropdown">
                        <label for="selectPerfil">Perfil</label>
                                <select id="selectPerfil" name="selectPerfil" class="form-control ">
                                  <option disabled selected>Selecciona...</option>
                                   @foreach($perfiles as $perfil)
                                      @if($docente_edit->id_perfil==$perfil->id_perfil)
                                            <option value="{{$perfil->id_perfil}}" selected="selected">{{$perfil->descripcion}}</option>
                                      @else
                                      <option value="{{$perfil->id_perfil}}">{{$perfil->descripcion}}</option>
                                      @endif
                                    @endforeach
                                </select>
                    </div> 
                  </div>
                  </div>
                                  <div class="col-md-1 " style="margin-top:3em;padding-left: 0px; margin-left: 10px;">
                  <button type="button" class="btn btn-primary b_perfil"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                </div> 

          </div>
         <div class="row">
             <div class="col-md-2 col-md-offset-1">
                 <div class="form-group">
                     <label for="abrevia">Abreviación</label>
                     <select name="selectAbreviacion" id="selectAbreviacion" class="form-control ">
                         <option disabled selected>Selecciona...</option>
                         @foreach($abreviaciones as $abreviacion)
                             @if($abre_doc==$abreviacion->id_abreviacion)
                                 <option value="{{$abreviacion->id_abreviacion}}" selected="selected">{{$abreviacion->titulo}}</option>
                             @else
                                 <option value="{{$abreviacion->id_abreviacion}}">{{$abreviacion->titulo}}</option>
                             @endif
                         @endforeach
                     </select>
                 </div>
             </div>
             <div class="col-md-1 " style="margin-top:3em;padding-left: 0px;margin-left: 10px;">
                 <button type="button" class="btn btn-primary b_abreviacion"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
             </div>
                    <div class="col-md-3 col-md-offset-1 ">
                    <div class="form-group">  
                      <div class="dropdown">
                        <label for="selectCargo">Cargo</label>
                                <select name="selectCargo" disabled id="selectCargo" class="form-control ">
                                  <option disabled selected>Selecciona...</option>
                                   @foreach($cargos as $cargo)
                                      @if($docente_edit->id_cargo==$cargo->id_cargo)
                                            <option value="{{$cargo->id_cargo}}" selected="selected">{{$cargo->cargo}}</option>
                                      @else
                                      <option value="{{$cargo->id_cargo}}">{{$cargo->cargo}}</option>
                                      @endif
                                    @endforeach
                                </select>
                    </div>  
                  </div>
                  </div>
                <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">
                        <label for="c_abrevia">Numero de empleado:</label>
                        <input type="text" class="form-control" id="numero_empleado" name="numero_empleado" placeholder="1556" value="{{ $docente_edit->numero_empleado }}">
                        @if($errors -> has ('numero_empleado'))
                            <span style="color:red;">{{ $errors -> first('numero_empleado') }}</span>
                            <style>
                                #numero_empleado
                                {
                                    border:solid 1px red;
                                }
                            </style>
                        @endif
                    </div>
                </div>
                                 <!--<div class="col-md-1 ml" style="margin-top:3em;padding-left: 0px;margin-left: 10px;">
                  <button type="button" class="btn btn-primary b_cargo"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                </div>-->
                                  <div class="col-md-11 col-md-offset-1">
                                    @if($directivo==0)
                     <strong>{{ "Los campos desabilitados sólo los puede modificar el administrador." }}</strong>
                     @endif  
                        @if($docente_edit->id_cargo==0||$docente_edit->horas_maxima==0)
                        {{ "Aún no te han asignado cargo y hrs. máximas." }}
                        @endif
                  </div>



          </div>
</form>
          <br>
                  <div class="col-md-3 col-md-offset-5">
                    <button id="guarda_docente" type="submit" form="form_docente_edita" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>Guardar cambios</button>
                  </div>  

            </div>
          </div>
    </div>  
  </div>

<!-- Modal para crear perfil-->
<div id="m_perfil" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Perfil</h4>
      </div>
      <div class="modal-body">
              <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="form-group">
                  <label for="nombre_perfil">Perfil:</label>
                  <input type="text" class="form-control" id="nombre_perfil" name="nombre_perfil" placeholder="Perfil...">
                  @if($errors -> has ('nombre_perfil'))
                          <span style="color:red;">{{ $errors -> first('nombre_perfil') }}</span>
                         <style>
                          #nombre_perfil
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
        <button id="guarda_perfil" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para crear abreviacion-->
<div id="m_abreviacion" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Abreviación</h4>
      </div>
      <div class="modal-body">
              <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="form-group">
                  <label for="nombre_abre">Abreviación:</label>
                  <input type="text" class="form-control" id="nombre_abre" name="nombre_abre" placeholder="Abreviación...">
                  @if($errors -> has ('nombre_abre'))
                          <span style="color:red;">{{ $errors -> first('nombre_abre') }}</span>
                         <style>
                          #nombre_abre
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
        <button id="guarda_abreviacion" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para crear cargo-->
<div id="m_cargo" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Cargos</h4>
      </div>
      <div class="modal-body">
              <div class="row">
          <div class="col-md-7 col-md-offset-1">
              <div class="form-group">
                  <label for="nombre_cargo">Cargo:</label>
                  <input type="text" class="form-control" id="nombre_cargo" name="nombre_cargo" placeholder="Cargo...">
                  @if($errors -> has ('nombre_cargo'))
                          <span style="color:red;">{{ $errors -> first('nombre_cargo') }}</span>
                         <style>
                          #nombre_cargo
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
              </div>
          </div> 
                    <div class="col-md-3 ">
              <div class="form-group">
                  <label for="c_abrevia">Abreviación:</label>
                  <input type="text" class="form-control" id="c_abrevia" name="c_abrevia" placeholder="Abreviación...">
                  @if($errors -> has ('c_abrevia'))
                          <span style="color:red;">{{ $errors -> first('c_abrevia') }}</span>
                         <style>
                          #c_abrevia
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
              </div>
          </div>
                  <div class="col-md-3 ">
                      <div class="form-group">
                          <label for="c_abrevia">Numero de empleado:</label>
                          <input type="text" class="form-control" id="numero_empleado" name="numero_empleado" placeholder="1556...">
                          @if($errors -> has ('numero_empleado'))
                              <span style="color:red;">{{ $errors -> first('numero_empleado') }}</span>
                              <style>
                                  #numero_empleado
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
        <button id="guarda_cargo" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para crear situacion-->
<div id="m_situacion" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Situaciones</h4>
      </div>
      <div class="modal-body">
              <div class="row">
          <div class="col-md-7 col-md-offset-1">
              <div class="form-group">
                  <label for="nombre_situacion">Situación:</label>
                  <input type="text" class="form-control" id="nombre_situacion" name="nombre_situacion" placeholder="Situación...">
                  @if($errors -> has ('nombre_situacion'))
                          <span style="color:red;">{{ $errors -> first('nombre_situacion') }}</span>
                         <style>
                          #nombre_situacion
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
              </div>
          </div> 
          <div class="col-md-3 ">
              <div class="form-group">
                  <label for="s_abrevia">Abreviación:</label>
                  <input type="text" class="form-control" id="s_abrevia" name="s_abrevia" placeholder="Abreviación...">
                  @if($errors -> has ('s_abrevia'))
                          <span style="color:red;">{{ $errors -> first('s_abrevia') }}</span>
                         <style>
                          #s_abrevia
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
        <button id="guarda_situacion" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</main>

<script>
window.docenteEdicion = {
    old: @json(session()->getOldInput()),
    errors: @json($errors->getBag('default')->messages()),
    success: @json(session('docente_success'))
};
</script>
<script src="{{ asset('js/docentes/editar.js') }}?v={{ filemtime(public_path('js/docentes/editar.js')) }}"></script>
<script>
$(document).ready(function() {
  $(".b_perfil").click(function(event){
    $("#m_perfil").modal("show");
  });
    $(".b_abreviacion").click(function(event){
    $("#m_abreviacion").modal("show");
  });
      $(".b_cargo").click(function(event){
    $("#m_cargo").modal("show");
  });
        $(".b_situacion").click(function(event){
    $("#m_situacion").modal("show");
  });

  $("#guarda_perfil").click(function(event){
      var perfil=$("#nombre_perfil").val();
          $("#selectPerfil tbody").empty();

      $.get('/docentes/perfiles/'+perfil,{},function(request){
        var datos=request['perfiles'];
        for (var i=0; i<datos.length ; i++) 
        {
          var perfil='<option value="'+datos[i].id_perfil+'">'+datos[i].descripcion+'</option>';
          $("#selectPerfil").append(perfil);
        }
        $("#m_perfil").modal("hide");
      }); 
  });

  $("#guarda_abreviacion").click(function(event){
      var abrevia=$("#nombre_abre").val();
    $("#selectAbreviacion tbody").empty();

      $.get('/docentes/abreviaciones/'+abrevia,{},function(request){
        var datos=request['abreviaciones'];
        //console.log(datos);
        for (var i=0; i<datos.length ; i++) 
        {
          var abrevia='<option value="'+datos[i].id_abreviacion+'">'+datos[i].titulo+'</option>';
          $("#selectAbreviacion").append(abrevia);
        }
        $("#m_abreviacion").modal("hide");
      }); 
  });

  $("#guarda_cargo").click(function(event){
      var cargo=$("#nombre_cargo").val();
      var c_abrevia=$("#c_abrevia").val();

          $("#selectCargo tbody").empty();

      $.get('/docentes/cargos/'+cargo+'/'+c_abrevia,{},function(request){
        var datos=request['cargos'];
        //console.log(datos);
        for (var i=0; i<datos.length ; i++) 
        {
          var cargo='<option value="'+datos[i].id_cargo+'">'+datos[i].cargo+'</option>';
          $("#selectCargo").append(cargo);
        }
        $("#m_cargo").modal("hide");
      });       
  });
  $("#guarda_situacion").click(function(event){
      var situacion=$("#nombre_situacion").val();
      var s_abrevia=$("#s_abrevia").val();
          $("#selectSituacion tbody").empty();

      $.get('/docentes/situaciones/'+situacion+'/'+s_abrevia,{},function(request){
        var datos=request['situaciones'];
        for (var i=0; i<datos.length ; i++) 
        {
          var situacion='<option value="'+datos[i].id_situacion+'">'+datos[i].situacion+'</option>';
          $("#selectSituacion").append(situacion);
        }
        $("#m_situacion").modal("hide");
      });       
  });


});

@if($ok=="true")
$("#warninn").show(1000);
@else
$("#warninn").hide(1000);
@endif

    $('.nac').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true,
        startDate: "-90y",
        endDate:"-18y"
    });
    $('.normal').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>
@endsection
