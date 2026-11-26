@extends('layouts.panel')
@section('title', 'Distribución de hrs de los profesores')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Distribución de horas de los docentes" :migas="['Reportes de profesores' => null]" />
        @if($estado == 0)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
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
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <p class="tw:w-full"><br></p>
            </div>
        @else
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <a href="/distribucion_horas_profesores/excel_totales_profesor/{{$id_categoria}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Exportar concentrado <span class="oi oi-document tw:p-1"></span></a>

                </div>
            </div>
            <div class="tw:w-full tw:px-2" >
                <div class="dropdown-center">
                    <label for="selectCargo">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        <option disabled selected>Selecciona cargo...</option>
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
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <p class="tw:w-full"><br></p>
            </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <?php $i=1; ?>
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_empresa" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Docente</th>
                        <th>Horas Asignatura</th>
                        <th>Horas de Actividades de apoyo a la docencia</th>
                        <th>Total de horas</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $suma=0; ?>
                    @foreach($array_materia as $materia)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$materia['nombre'] }}</td>
                            @if($materia['horas_asignatura'] <= 19 )
                            <td>{{$materia['horas_asignatura']  }}</td>
                            @else
                                <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{$materia['horas_asignatura']  }}</td>
                            @endif
                            <td>{{$materia['horas_apoyo'] }}</td>
                            <td>{{$materia['totales_horas'] }}</td>
                         {{--    <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15" >{{ $materia['horas_profesor'] }}</td> --}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>
</div>
            </div>
        </div>
            @endif
    </main>


    <script type="text/javascript">

        $(document).ready(function() {
            $("#tabla_empresa").DataTable();
            $("#id_categoria").change(function(e){
                var id_categoria= e.target.value;
                window.location.href='/distribucion_horas_profesores/totales_profesor/'+id_categoria ;

            });

        });
    </script>
</div>
@endsection