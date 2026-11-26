@extends('layouts.panel')
@section('title', 'Evaluacion Docente')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:flex tw:flex-wrap tw:gap-y-4">

        <x-panel.encabezado :titulo="'Evaluación docente de: '.$docentes[0]->nombre.' carrera perteneciente: '.$carreras[0]->carrera" :migas="['Evaluación docente' => null]" />

        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
            <div class="tw:w-full" id="semes_box">
                @foreach($semestres as $semestre)
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                                <a class="tw:text-brand-500 tw:hover:underline" data-toggle="collapse" href="#semestre_{{$semestre->id_semestre}}_materia_{{$loop->index}}">
                                    {{ $semestre->semestre }} - {{ $semestre->materia }}
                                </a>
                            </h4>
                        </div>

                        <div id="semestre_{{$semestre->id_semestre}}_materia_{{$loop->index}}" class="collapse">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                                        <li><a data-toggle="tab" href="#materia{{$semestre->id_semestre }}">Grupos</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="materia{{$semestre->id_semestre}}">
                                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_mate{{$semestre->id_semestre}}" class="tw-tabla tw-tabla-bordes">
                                                <thead>
                                                <tr>
                                                    <th class="tw:text-center" >#</th>
                                                    <th class="tw:text-center" >Grupos a Cargo</th>
                                                    <th class="tw:text-center" >Ver Comentarios de la Evaluación Docente</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($datos_grupos as $grupo)
                                                    @if($grupo['id_semestre'] == $semestre->id_semestre && $grupo['id_materia'] == $semestre->id_materia)
                                                        <tr data-id-materia="{{ $grupo['id_materia'] }}" data-semestre="{{ $semestre->id_semestre }}">
                                                            <th class="tw:text-center" >{{ $loop->iteration }}</th>
                                                            <th class="tw:text-center" >{{ $grupo['id_semestre'] }}0{{$grupo['id_grupo']}}</th>
                                                            <th class="tw:text-center" >
                                                                <a href="#" class="ver-comentario"
                                                                   data-id-personal="{{ $grupo['id_personal'] }}"
                                                                   data-id-grupo="{{ $grupo['id_grupo'] }}"
                                                                   data-grupo="{{ $grupo['grupo'] }}"
                                                                   data-id-materia="{{ $grupo['id_materia'] }}"
                                                                   data-semestre="{{ $semestre->id_semestre }}">
                                                                    <span class="fa"></span>
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_mate1').DataTable();
            $('#table_mate2').DataTable();
            $('#table_mate3').DataTable();
            $('#table_mate4').DataTable();
            $('#table_mate5').DataTable();
            $('#table_mate6').DataTable();
            $('#table_mate7').DataTable();
            $('#table_mate8').DataTable();
            $('#table_mate9').DataTable();
            $('#table_mate10').DataTable();
            $('#table_mate11').DataTable();
            $('#table_mate12').DataTable();
            $('#table_mate13').DataTable();
            $('#table_mate14').DataTable();
            $('#table_mate15').DataTable();
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".ver-comentario").forEach(link => {
                link.addEventListener("click", function(event) {
                    event.preventDefault(); // Evita la navegación predeterminada

                    let id_personal = this.getAttribute("data-id-personal");
                    let id_grupo = this.getAttribute("data-id-grupo");
                    let grupo = this.getAttribute("data-grupo");
                    let id_materia = this.getAttribute("data-id-materia"); // Tomamos directamente desde el enlace

                    if (!id_materia) {
                        TNotify.alert("No se pudo encontrar el ID de la materia correspondiente.");
                        return;
                    }

                    // Construir la URL dinámica
                    let url = `/ver_comentario_docente/${id_personal}/${id_grupo}/${grupo}/${id_materia}`;

                    // Redireccionar a la nueva URL
                    window.location.href = url;
                });
            });
        });
    </script>

</div>
@endsection