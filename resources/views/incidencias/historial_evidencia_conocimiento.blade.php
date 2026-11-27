@extends('layouts.panel')
@section('title','Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Historial de evidencias de conocimiento que no requiere autorización de jefe inmediato" :migas="['Incidencias' => null]" />
        @if($estado == 0)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <div class="tw:mb-4">
                            <label for="ano_oficio">Seleccionar personal</label>
                            <select name="id_personal" id="id_personal" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                @foreach($personal as $personal)
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option value="{{$personal->id_personal}}" >{{$personal->nombre}} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <div class="tw:mb-4">
                            <label for="ano_oficio">Seleccionar personal</label>
                            <select name="id_personal" id="id_personal" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                @foreach($personal as $personal)
                                    @if($personal->id_personal==$id_personal)
                                        <option value="{{$personal->id_personal}}" selected="selected">{{$personal->nombre}}</option>
                                    @else
                                    <option value="{{$personal->id_personal}}" >{{$personal->nombre}} </option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_historial_docentes" class="tw-tabla tw-tabla-bordes" align="center">
                    <thead >
                    <th class="tw:text-center">No.</th>
                    <th>Nombre del solicitante</th>
                    <th class="tw:text-center">Evidencia aplicada</th>
                    <th class="tw:text-center">Fecha</th>
                    <th class="tw:text-center">Fecha y hora de envio</th>
                    <th class="tw:text-center">Ver evidencia</th>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach ($histEvi as $evidhist)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{$evidhist->nombre}}</td>
                                <td>{{$evidhist->nombre_evidencia}}
                                    @if($evidhist->id_tipo_evid == 1 || $evidhist->id_tipo_evid == 3 ||  $evidhist->id_tipo_evid == 5  ||  $evidhist->id_tipo_evid == 6)
                                        <br><b>Folio: {{ $evidhist->no_folio }} </b>
                                    @endif
                                </td>
                                @if($evidhist->no_fecha == 1)
                                    <?php
                                    $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                                    ?>
                                    <td>
                                        {{$fecha_solicita}}
                                    </td>
                                @else
                                    <?php
                                    $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                                    $fecha_solicita_2= date('d-m-Y', strtotime($evidhist->fecha_solicita_2));
                                    ?>
                                    <td>
                                        {{$fecha_solicita}} al {{ $fecha_solicita_2 }}
                                    </td>

                                @endif
                                <?php  $fecha_envio=date_format(new DateTime($evidhist->fecha_envio), 'd-m-Y H:i:s');?>
                                <td>{{$fecha_envio}}</td>
                                <th>
                                    <a  target="_blank" href="/incidencias/{{$evidhist->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"> <i class="fa fa-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                                </th>

                            </tr>
                    @endforeach
                    <tbody>
                </table>
</div>
            </div>
        </div>

        @endif
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tabla_historial_docentes').DataTable( {

                } );
                $("#id_personal").on('change',function(e) {
                    // TNotify.alert($("#grupos").val());
                    var id_personal = $("#id_personal").val();
                    window.location.href='/incidencias/historial_evidencias_conocimient/'+id_personal;
                });

            });
        </script>
    </main>
</div>
@endsection