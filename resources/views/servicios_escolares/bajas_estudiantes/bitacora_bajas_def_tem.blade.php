@extends('layouts.panel')
@section('title', 'Bitacoras Bajas Estudiantes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main>
        <div class="tw:w-full">

            <x-panel.encabezado titulo="Bitácora de Bajas de Estudiantes" :migas="['Servicios escolares' => null]" />


            @if($ver == 1)

                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800" id="bajasTabs" role="tablist">
                    <li class="active">
                        <a href="#temporales" data-toggle="tab">Bajas Temporales</a>
                    </li>
                    <li>
                        <a href="#definitivas" data-toggle="tab">Bajas Definitivas</a>
                    </li>
                </ul>


                <div class="tab-content tw:mt-6" id="bajasTabsContent">

                    <!-- TAB: TEMPORALES -->
                    <div class="tab-pane fade in active" id="temporales">
                        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6 tw:p-0">
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_temporales" class="tw-tabla tw-tabla-bordes tw:mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="tw:text-center">#</th>
                                        <th class="tw:text-center">No.Cuenta</th>
                                        <th class="tw:text-center">Nombre del Alumno</th>
                                        <th class="tw:text-center">No. de Oficio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos_temporales as $alum_temp)
                                        <tr>
                                            <td class="tw:text-center">{{$loop->iteration}}</td>
                                            <td class="tw:text-center">{{$alum_temp->cuenta}}</td>
                                            <td class="tw:text-center">{{$alum_temp->nombre}} {{$alum_temp->apaterno}}  {{$alum_temp->amaterno}}</td>
                                            <td class="tw:text-center">{{$alum_temp->observaciones}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: DEFINITIVAS -->
                    <div class="tab-pane fade" id="definitivas">
                        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6 tw:p-0">
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_definitivas" class="tw-tabla tw-tabla-bordes tw:mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="tw:text-center">#</th>
                                        <th class="tw:text-center">No.Cuenta</th>
                                        <th class="tw:text-center">Nombre del Alumno</th>
                                        <th class="tw:text-center">No. de Oficio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos_definitivos as $alum_def)
                                        <tr>
                                            <td class="tw:text-center">{{$loop->iteration}}</td>
                                            <td class="tw:text-center">{{$alum_def->cuenta}}</td>
                                            <td class="tw:text-center">{{$alum_def->nombre}} {{$alum_def->apaterno}}  {{$alum_def->amaterno}}</td>
                                            <td class="tw:text-center">{{$alum_def->observaciones}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>

                </div>


            @endif

        </div>
    </main>


    <script>
        $(document).ready(function () {
            $('#bajasTabs a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>


</div>
@endsection