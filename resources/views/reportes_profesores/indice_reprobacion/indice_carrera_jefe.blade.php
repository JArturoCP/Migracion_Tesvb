@extends('layouts.panel')
@section('title', 'Indice de reprobación')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Índices de reprobación" :migas="['Reportes de profesores' => null]" />
    <?php
    $jefe_division = session()->has('jefe_division') ? session()->has('jefe_division') : false;
    ?>

    @if($estado == 1)
        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Indices de Reprobación<br><b>@foreach($carreras as $carrera) {{ $carrera->nombre }} @endforeach</b></h3>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2" style="display: none" >
                <div class="dropdown-center">
                    <label for="selectCargo"></label>
                    <select name="id_carrera" id="id_carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" selected="selected" >{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2" >
                <div class="dropdown-center">
                    <label for="selectCargo">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        <option disabled selected>Selecciona cargo...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id_cargo}}" >{{$categoria->cargo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @else
        @if($jefe_division != true)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/indices_repro_prof/")}}">Planes de Estudios</a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Indice Reprobación docentes</span>

                </p>
            </div>
        </div>
        @endif
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                @foreach($carreras as $carrera)
                    <a href="/indices_repro_prof/excel_indice_rep_prof/{{$carrera->id_carrera}}/{{$id_categoria}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Exportar concentrado <span class="oi oi-document tw:p-1"></span></a>
                @endforeach
            </div>
        </div>
        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Indices de Reprobación<br><b>@foreach($carreras as $carrera) {{ $carrera->nombre }} @endforeach</b></h3>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" style="display: none" >
                <div class="dropdown-center">
                    <label for="selectCargo">Carrera</label>
                    <select name="id_carrera" id="id_carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" selected="selected" >{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" >
                <div class="dropdown-center">
                    <label for="selectCargo">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        @foreach($categorias as $categoria)
                            @if($categoria->id_cargo==$id_categoria)
                                <option value="{{$categoria->id_cargo}}" selected="selected">{{$categoria->cargo}}</option>
                            @else
                                <option value="{{$categoria->id_cargo}}" >{{$categoria->cargo}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <?php $i=1; ?>
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Docente</th>
                                <th>Asignatura</th>
                                <th>Grupo</th>
                                <th>Unidades</th>
                                <th>No. estudiantes inscritos</th>
                                <th>Unidad 1</th>
                                <th>Unidad 2</th>
                                <th>Unidad 3</th>
                                <th>Unidad 4</th>
                                <th>Unidad 5</th>
                                <th>Unidad 6</th>
                                <th>Unidad 7</th>
                                <th>Unidad 8</th>
                                <th>Unidad 9</th>
                                <th>Unidad 10</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($array_materias as $materia)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$materia['profesor'] }}</td>
                                    <td>{{$materia['materia'] }}</td>
                                    <td>{{$materia['id_semestre'].'0'.$materia['grupo'] }}</td>
                                    <td>{{$materia['unidades_mat'] }}</td>
                                    <td>{{$materia['total_estudiantes'] }}</td>
                                    @if($materia['max_unidad'] == 1)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 2)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 3)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 4)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 5)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 6)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 7)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 8)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 9)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 10)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach

                                    @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @endif

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
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <p class="tw:w-full"><br></p>
    </div>

    <script type="text/javascript">

        $(document).ready(function() {
            $("#id_carrera").change(function(e){
                var id_carrera= e.target.value;
                window.location.href='/indices_repro_prof/carrera_categoria/'+id_carrera ;

            });

            $("#id_categoria").change(function(e){
                var id_categoria= e.target.value;
                var id_carrera= $("#id_carrera").val();
                window.location.href='/indices_repro_prof/carrera_cat_docente/'+id_carrera+'/'+id_categoria ;

            });

        });
    </script>


</div>
@endsection