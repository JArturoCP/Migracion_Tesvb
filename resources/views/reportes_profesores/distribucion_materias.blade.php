@extends('layouts.panel')
@section('title', 'Distribución de hrs del profesor')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/distribucion_horas_profesores/profesores_categoria/".$id_categoria)}}">Docentes</a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Distribución de horas del docente</span>

                </p>
            </div>
        </div>
        <x-panel.encabezado :titulo="'Distribución de horas del docente Perfil: '.$profesor->perfil.' Nombre del docente: '.$profesor->titulo.' '.$profesor->nombre.' Categoria: '.$profesor->cargo" :migas="['Reportes de profesores' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <?php $i=1; ?>
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Programa de Estudios</th>
                        <th>Asignatura</th>
                        <th>Horas por grupo</th>
                        <th>Número de grupos</th>
                        <th>Horas por Asignatura</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $suma=0; ?>
                    @foreach($array_materia as $materia)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$materia['carrera'] }}</td>
                            <td>{{$materia['materia'] }}</td>
                            <td>{{$materia['horas_totales']  }}</td>
                            <td>{{$materia['total_grupos']  }}</td>
                            <td>{{$materia['total_horas_grupos']  }}</td>
                            <?php $suma+=$materia['total_horas_grupos']; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total de horas de asignaturas</b></td>
                        @if($suma <=19)
                        <td>{{ $suma }}</td>
                        @else
                            <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90" ><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $suma }}</h4><br></td>
                        @endif
                    </tr>

                    </tbody>
                </table>
</div>
            </div>
        </div>
    </main>


    <script type="text/javascript">

        $(document).ready(function() {
            $("#tabla_empresa").DataTable();
            $("#tabla_empresa").on('click','.ver_materia',function(){
                var id_personal=$(this).data("id");
                window.location.href='/distribucion_horas_profesores/materias/'+id_personal ;
            });
        });
    </script>
</div>
@endsection