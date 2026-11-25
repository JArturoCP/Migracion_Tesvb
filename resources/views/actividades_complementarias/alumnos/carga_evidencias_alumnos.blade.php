{{--
    Complementarias › Evidencias del alumno (/evidencias_alumnos, EvidenciasAlumnosController@index).
    Diseño del panel; mismos datos y condiciones ($existe_id, una fila por actividad aprobada y un formulario por
    evidencia faltante). Cada formulario #agrega_evidencia{i} conserva method POST, enctype multipart/form-data,
    @csrf, urlImg[] (#archivo{i}), el botón submit name="id_registro" (.registra, id del registro) y
    registro_alumno. Mismo script (límite de 2 MB y blockUI al subir). Versión anterior: tests/Fixtures/vistas_antes.
    La nota y la tabla se muestran en un modal que se abre al cargar la página (formato de modal_horas).
--}}
@extends('layouts.panel')
@section('title', 'EvidenciasAlumnos')
@include('partials.panel.recursos_app', ['blockui' => true])
@section('content')


<main>
  <x-panel.encabezado titulo="Evidencias" :migas="['Complementarias' => url('/consulta_actividades/')]" />
@if($existe_id == 1)
@else
<!-- Modal para cargar evidencias -->
<x-panel.modal id="modal_evidencias" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel"><div id="modal_evidencias_contenido">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Evidencias</h4>
      </div>
      <div class="tw-modal-cuerpo">
  <x-panel.alerta tipo="advertencia" titulo="NOTA:" class="tw:mb-6">
    LAS EVIDENCIAS SE SUBEN AL SISTEMA UNA POR UNA.<br>
    PASOS HA SEGUIR:<br>
    1.-Dar clic en el botón examinar.<br>
    2.-Seleccionamos la evidencia y después dar en el botón abrir<br>
    3.-Dar clic en el botón subir evidencia<br>
    Esperar que el sistema registre tu evidencia y después subir la siguiente evidencia si se requiere.
  </x-panel.alerta>

    <x-panel.tabla class="tabla-grande2">
      <thead>
        <tr>
          <th>Actividad</th>
          <th>Categoría</th>
          <th>Horas</th>
          <th>Créditos</th>
          <th>Número de evidencias</th>
          <th>Rúbrica</th>
          <th></th>
          <th>Cargar evidencias</th>
        </tr>
      </thead>
      <tbody>
        @foreach($alumnos as $alumnos)
          <tr>
            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$alumnos->descripcion}}</td>
            <td>{{$alumnos->descripcion_cat}}</td>
            <td>{{$alumnos->horas}}</td>
            <td>{{$alumnos->creditos}}</td>
            <td>{{$alumnos->no_evidencias}}
            </td>
            <td>{{$alumnos->rubrica}}</td>
            <td><a href="{{url("/ArchivosDocentes/",$alumnos->rubrica)}}" target="_blank" class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50 tw:dark:text-brand-400 tw:dark:hover:bg-brand-500/10" title="Rúbrica"><i class="fa fa-file-text-o tw:text-lg" aria-hidden="true"></i></a></td>
            <td>
              <div class="tw:flex tw:flex-col tw:gap-3">
              @for ($i=0; $i < $alumnos->faltan ; $i++)
              <form data-panel-envio="evidencia-{{ $alumnos->id_registro_alumno }}-{{ $i }}" method="POST" role="form" class="form tw:flex tw:flex-wrap tw:items-center tw:gap-2" id="agrega_evidencia{{$i}}" enctype="multipart/form-data">
                  {{csrf_field()}}
                <input type="file"  name="urlImg[]" data-panel-etiqueta="el archivo de evidencia" required data-panel-max-bytes="2097152" id="archivo{{$i}}" accept="" class="tw:max-w-64 tw:rounded-lg tw:border tw:border-gray-300 tw:text-sm tw:text-gray-500 tw:file:mr-3 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:px-3 tw:file:py-2 tw:file:text-sm tw:file:text-gray-700 tw:dark:border-gray-700 tw:dark:text-gray-400 tw:dark:file:border-gray-800 tw:dark:file:bg-white/3 tw:dark:file:text-gray-300">
                <x-panel.boton variante="exito" tamano="sm" name="id_registro" type="submit" class="registra" id="{{$alumnos->id_registro_alumno}}"><i class="fa fa-upload" aria-hidden="true"></i> SUBIR EVIDENCIA</x-panel.boton>
                <input style="display:none" id="registro_alumno" value="{{$alumnos->id_registro_alumno}}" name="registro_alumno">
              </form>
              @endfor
              </div>
            </td>
          </tr>
         @endforeach
      </tbody>
    </x-panel.tabla>
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Aceptar</button>
      </div>
</div></x-panel.modal>
@endif

</main>

<script >

function bloqueo()
{
    $.blockUI({
  });
}

  $(document).ready(function(){

  @if($existe_id==0)
    $("#modal_evidencias").modal("show");

    $('[data-panel-envio]').on('panel:enviando', bloqueo);
@endif



 });

</script>

@include('partials.panel.validacion_envio')
@endsection
