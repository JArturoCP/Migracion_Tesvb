@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado :titulo="'Indice de Reprobación '.$carreras->nombre.' (Semestres)'" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                    @if($semestres!=null)
                        <div class="tw:w-full tw:px-2">
                            <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                @foreach($semestres as $semestre)
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" href="#" onclick="window.location='{{ url('/servicios_escolares/estadisticas/indice_reprobacion_semestre_materia/'.$carreras->id_carrera.'/'.$semestre->id_semestre ) }}'"> {{$semestre->descripcion}}</a></li>

                                @endforeach
                            </ul>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection