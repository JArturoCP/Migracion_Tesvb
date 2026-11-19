@extends('layouts.panel')
@section('title', 'Actividades')
@include('tutorias.partials.recursos_panel')
@section('content')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Actividades', 'activa' => '/tutorias/actividad'])

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane active" id="primero" role="tabpanel" aria-labelledby="primero-tab">
            <x-panel.tarjeta titulo="Actividades" subtitulo="Actividades de tutoría del periodo y sus evidencias." sin-relleno>
                @if (count($datos))
                    <x-panel.tabla>
                        <thead>
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Actividad</th>
                                <th>Objetivo</th>
                                <th>Estrategia</th>
                                <th>Evidencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $plan)
                                <tr>
                                    <td class="tw:whitespace-nowrap">{{$plan->fi_actividad}}</td>
                                    <td class="tw:whitespace-nowrap">{{$plan->ff_actividad}}</td>
                                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$plan->desc_actividad}}</td>
                                    <td>{{$plan->objetivo_actividad}}</td>
                                    <td>{{$plan->estrategia}}</td>
                                    <td>
                                        <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-2">
                                            @if($plan->requiere_evidencia==null)
                                                <x-panel.badge tono="gris">No requiere evidencia</x-panel.badge>
                                            @endif
                                            @if(isset($plan->evidencia[0]) && $plan->requiere_evidencia==1)
                                                <x-panel.boton variante="contorno-peligro" tamano="sm" :href="url('/pdf/',$plan->evidencia[0]->evidencia)" target="_blank" title="Ver evidencia"><i class="fas fa-file-pdf"></i></x-panel.boton>
                                                <x-panel.boton variante="contorno-primario" tamano="sm" class="edit_evidencia" data-toggle="tooltip" data-placement="bottom" title="Modificar Evidencia" data-id="{{$plan->evidencia[0]->id_evidencia}}">
                                                    <i class="fas fa-edit"></i>
                                                </x-panel.boton>
                                            @else
                                                @if($plan->requiere_evidencia==1)
                                                    <x-panel.boton variante="contorno-exito" tamano="sm" class="edit" data-toggle="tooltip" data-placement="bottom" title="Subir Evidencia" data-id="{{$plan->id_asigna_planeacion_tutor}}">
                                                        <i class="fas fa-file-upload"></i>
                                                    </x-panel.boton>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-panel.tabla>
                @else
                    <div class="tw:p-5 tw:sm:p-6">
                        <x-panel.vacio titulo="Sin actividades" mensaje="Aún no hay actividades de tutoría registradas para tu grupo." />
                    </div>
                @endif
            </x-panel.tarjeta>
        </div>
    </div>

    <x-panel.modal id="edit" titulo="Evidencia" sin-relleno aria-labelledby="myModalLabel">
        <form action="{{url('tutorias/actividad')}}" method="post" enctype="multipart/form-data">
            <div class="tw-modal-cuerpo">
                {{ csrf_field() }}
                <x-panel.input etiqueta="Archivo PDF" type="file" name="evidencia" id="evidencia" accept=".pdf" />
                <input type="number" id="id_asigna_planeacion_tutor" name="id_asigna_planeacion_tutor" hidden>
                <input type="number" id="id_evidencia" name="id_evidencia" hidden>
            </div>
            <x-panel.modal-pie>
                <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                <x-panel.boton type="submit">Guardar</x-panel.boton>
            </x-panel.modal-pie>
        </form>
    </x-panel.modal>
    <script>
        $(document).ready(function(){
            $('.edit').click(function(){

                $('#id_asigna_planeacion_tutor').val("");
                $('#id_evidencia').val("");

                var id=$(this).data("id");
                $('#edit').modal('show');
                $('#id_asigna_planeacion_tutor').val(id);
            });
            $('.edit_evidencia').click(function(){
                $('#id_asigna_planeacion_tutor').val("");
                $('#id_evidencia').val("");

                var id=$(this).data("id");

                $('#edit').modal('show');
                $('#id_evidencia').val(id);
            });
        });
    </script>
@endsection
