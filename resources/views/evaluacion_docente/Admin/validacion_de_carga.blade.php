@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app', ['datatables' => true, 'validacion' => true])
@section('content')
<div class="tw-pantalla">

    <main>

        <x-panel.encabezado titulo="Validación de cargas académicas" :migas="['Evaluación docente' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            
            {{--
                    @if($activar_periodo_carga->descripcion==2)
                        <div class="tw:w-full tw:px-2">

                            <a class="activar_periodo_carga tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{$activar_periodo_carga->id_validacion_carga}}" type="button" >Activar periodo de remplazo de carga <span class="fa fa-check" aria-hidden="true" /></a>
          </div>
          @endif
          @if($activar_periodo_carga->descripcion==4)
          <div class="tw:w-full tw:px-2">

            <a class="desactivar_periodo_carga tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{$activar_periodo_carga->id_validacion_carga}}" type="button">Desactivar periodo de remplazo de carga <span class="fa fa-times" aria-hidden="true" /></a>
          </div>
          @endif
          --}}
            {{--@if($activar==1)
          <div class="tw:w-full tw:px-2">

              <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="enviar" type="button" href="/desactivar">Desactivar Cargas <span class="fa fa-times" aria-hidden="true"
                ></a>
          </div>
          @else
          <div class="tw:w-full tw:px-2">

              <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="enviar" type="button" href="/desactivar">Activar Cargas <span class="fa fa-check" aria-hidden="true"
                ></a>
          </div>
          @endif
          --}}
            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">

            <?php $escolar = session()->has('escolar') ? session()->has('escolar') : false;  ?>

            <!-- Nav tabs -->
                <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800" role="tablist">
                    <li role="presentation" class="active"><a href="#uno" aria-controls="home" role="tab" data-toggle="tab">Pendientes</a></li>
                    <li role="presentation"><a href="#dos" aria-controls="dos" role="tab" data-toggle="tab">Aceptados (Normal)</a></li>
                    <li role="presentation"><a href="#tres" aria-controls="dos" role="tab" data-toggle="tab">Aceptados (Duales nueva versión)</a></li>
                    {{-- <li role="presentation"><a href="#cuatro" aria-controls="dos" role="tab" data-toggle="tab">Aceptados (Duales versión antigua)</a></li> --}}

                </ul>

                <!-- Tab panes -->
                <div class="tab-content tw:w-full">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="no_aceptados">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>CARRERA</th>
                                    <th>CARGA ACADEMICA</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($consulta as $consulta)
                                    <tr>
                                        <th>{{$consulta->cuenta}}</th>
                                        <td>{{$consulta->nombre}} {{$consulta->apaterno}} {{$consulta->amaterno}}</td>

                                        <td>{{$consulta->carreras}}</td>
                                        <td>

                                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta->id ) }}')"><span class="fa fa-list-alt em5" aria-hidden="true"></span></a>

                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
</div>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="dos">
                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="aceptados">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>SEMESTRE</th>
                                    <th>CARRERA</th>
                                    <th>CARGA ACADEMICA</th>
                                    @if($periodo_activo == 1)
                                        <th>MODIFICACIÓN DE ESTADO DEL ALUMNO</th>
                                        <th>DAR DE BAJA ALUMNO</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($consulta2 as $consulta2)
                                    <tr>
                                        <th>{{$consulta2->cuenta}}</th>
                                        <td>{{$consulta2->nombre}} {{$consulta2->apaterno}} {{$consulta2->amaterno}}</td>
                                        <td>{{$consulta2->semestre}}</td>
                                        <td>{{$consulta2->carreras}}</td>
                                        <td>
                                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta2->id ) }}')"><span class="fa fa-list-alt em5" aria-hidden="true"></span></a>
                                        </td>
                                        @if($periodo_activo == 1)
                                            <td>
                                                @if($escolar == true)
                                                    <a class="activar_periodo_carga tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{$consulta2->id}}" type="button">Modificar estado del alumno<span class="fa fa-check" aria-hidden="true" /></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($escolar == true)
                                                    <a class="baja tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{$consulta2->id}}" type="button">Dar de baja<span class="fa fa-pencil-square-o" aria-hidden="true" /></a>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
</div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tres">
                        <div class="tw:w-full tw:px-2">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="version_actual">
                                <thead>
                                <tr>
                                    <th>No. CUENTA</th>
                                    <th>NOMBRE DE ALUMNO(A)</th>
                                    <th>SEMESTRE</th>
                                    <th>CARRERA</th>
                                    <th>CARGA ACADEMICA</th>
                                    @if($periodo_activo == 1)
                                        <th>MODIFICACIÓN DE ESTADO DEL ALUMNO</th>
                                        <th>CALIFICAR ESTUDIANTE</th>
                                        <th>DAR DE BAJA ALUMNO</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($consulta3 as $consulta3)
                                    <tr>
                                        <th>{{$consulta3->cuenta}}</th>
                                        <td>{{$consulta3->nombre}} {{$consulta3->apaterno}} {{$consulta3->amaterno}}</td>
                                        <td>{{$consulta3->semestre}}</td>
                                        <td>{{$consulta3->carreras}}</td>
                                        <td>
                                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta3->id ) }}')"><span class="fa fa-list-alt em5" aria-hidden="true"></span></a>
                                        </td>
                                        @if($periodo_activo == 1)
                                            <td>
                                                @if($escolar == true)
                                                    <a class="activar_periodo_carga tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{$consulta3->id}}" type="button">Modificar estado del alumno<span class="fa fa-check" aria-hidden="true" /></a>
                                                @endif
                                            </td>

                                            <td class="tw:text-center" >
                                                @if($escolar == true)
                                                    <a class="tw:text-brand-500 tw:hover:underline" href="#" onclick="window.open('{{ url('/calificar_estudiante/'.$consulta3->id ) }}')"><span class="fa fa-pencil" aria-hidden="true"></span>Calificar</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($escolar == true)
                                                    <a class="baja tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{$consulta3->id}}" type="button">Dar de baja<span class="fa fa-pencil-square-o" aria-hidden="true" /></a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
</div>
                        </div>
                    </div>
                    {{--
                      <div role="tabpanel" class="tab-pane" id="cuatro">
                          <div class="tw:w-full tw:px-2">

                              <table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="version_antigua">
                                  <thead>
                                  <tr>
                                      <th>No. CUENTA</th>
                                      <th>NOMBRE DE ALUMNO(A)</th>
                                      <th>SEMESTRE</th>
                                      <th>CARRERA</th>
                                      <th>CARGA ACADEMICA</th>
                                      @if($periodo_activo == 1)
                                      <th>MODIFICACIÓN DE ESTADO DEL ALUMNO</th>
                                      <th>DAR DE BAJA ALUMNO</th>
                                      @endif
                                  </tr>
                                  </thead>
                                  <tbody>

                                  @foreach($consulta4 as $consulta4)
                                      <tr>
                                          <th>{{$consulta4->cuenta}}</th>
                    <td>{{$consulta4->nombre}} {{$consulta4->apaterno}} {{$consulta4->amaterno}}</td>
                    <td>{{$consulta4->semestre}}</td>
                    <td>{{$consulta4->carreras}}</td>
                    <td>
                      <a onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta4->id ) }}')"><span class="fa fa-list-alt em5" aria-hidden="true"></span></a>
                    </td>
                    @if($periodo_activo == 1)
                    <td>
                      @if($escolar == true)
                      <a class="activar_periodo_carga tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{$consulta4->id}}" type="button">Modificar estado del alumno<span class="fa fa-check" aria-hidden="true" /></a>
                      @endif
                    </td>
                    <td>
                      @if($escolar == true)
                      <a class="baja tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{$consulta4->id}}" type="button">Dar de baja<span class="fa fa-pencil-square-o" aria-hidden="true" /></a>
                      @endif
                    </td>
                    @endif

                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                  </div>
                </div>
                --}}

                </div>
            </div>

        </div>

    </main>
    <form method="POST" role="form" id="form_modificar">
        {{ csrf_field() }}
    </form>
    <form id="form_agregar" class="" action="/modificar/estado_carga/" role="form" method="POST">
        <x-panel.modal id="modal_agregar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar estado del alumno</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_carga" name="id_carga" value="">

                            <div class="tw:w-full tw:px-2">

                                <label for="exampleInputEmail1">Estado del alumno<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="estado" id="estado" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option value="1">NORMAL</option>
                                    <option value="2">DUAL NUEVA VERSIÓN</option>
                                    {{-- <option  value="3">DUAL VERSIÓN ANTIGUA</option> --}}
                                    <option value="4">PERMISO DE MODIFICAR CARGA ACADEMICA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregado" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </x-panel.modal>
        
    </form>
    <form id="form_baja" class="" action="/baja/alumno_baja/" role="form" method="POST">
        <x-panel.modal id="modal_baja" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Dar de baja alumno</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_carga_a" name="id_carga_a" value="">

                            <div class="tw:w-full tw:px-2">

                                <label for="exampleInputEmail1">Dar de baja alumno<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="estado" id="estado" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option value="1">BAJA TEMPORAL (SIN ELIMINACION DE CARGA)</option>
                                    <option value="2">BAJA TEMPORAL (ELIMINACION DE CARGA)</option>
                                    <option value="3">BAJA DEFINITIVA</option>
  
                                </select>
                            </div>
                            <div class="tw:w-full tw:px-2">
    <label for="obser">Motivo de la baja:</label>

    <select class="rounded-0 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="obser" name="obser" required>
        <option value="">Seleccione un motivo</option>
        <option value="Económicas">Económicas</option>
        <option value="Salud">Salud</option>
        <option value="No le gustó la carrera">No le gustó la carrera</option>
        <option value="Problemas sociales">Problemas sociales</option>
        <option value="Falta de motivación">Falta de motivación</option>
        <option value="Falta de vocación">Falta de vocación</option>
        <option value="Problemas familiares">Problemas familiares</option>
        <option value="Deficiencias académicas">Deficiencias académicas</option>
        <option value="Carrera difícil">Carrera difícil</option>
        <option value="Reprobación">Reprobación</option>
        <option value="Baja por oficio">Baja por Oficio</option>
    </select>
</div>

                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_baja" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </x-panel.modal>
        
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#no_aceptados').DataTable();
            $('#aceptados').DataTable();
            $('#version_actual').DataTable();
            $('#version_antigua').DataTable();
            $("#aceptados").on('click', '.activar_periodo_carga', function() {
                var idof = $(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');
            });
            $("#aceptados").on('click', '.baja', function() {
                var idof = $(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');
            });
            $("#version_actual").on('click', '.baja', function() {
                var idof = $(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');
            });
            $("#version_antigua").on('click', '.baja', function() {
                var idof = $(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');
            });
            $("#guardar_baja").click(function(event) {
                $("#form_baja").submit();
            });
            $("#form_baja").validate({
                rules: {
                    estado: "required",
                    obser: "required",
                },
            });
            $("#guardar_agregado").click(function(event) {
                $("#form_agregar").submit();
            });
            $("#form_agregar").validate({
                rules: {
                    estado: "required",
                },
            });
            $("#version_actual").on('click', '.activar_periodo_carga', function() {
                var idof = $(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');
            });
            $("#version_antigua").on('click', '.activar_periodo_carga', function() {
                var idof = $(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');
            });
            $(".desactivar_periodo_carga").click(function(event) {
                var idof = $(this).attr('id');
                swal({
                    title: "¿Desactivar periodo de remplazar carga academica?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_modificar").attr("action", "/desactivar/periodo_modificacion_carga/" + idof)
                            $("#form_modificar").submit();
                        }
                    });
            });
        });
    </script>
</div>
@endsection