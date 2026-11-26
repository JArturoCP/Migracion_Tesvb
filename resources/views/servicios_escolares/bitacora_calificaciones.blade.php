@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Evaluaciones modificadas" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                        <thead>
                            <tr class="tw:text-center">
                                <th class="tw:text-center">Docente</th>
                                <th class="tw:text-center">Materia</th>
                                <th class="tw:text-center">Unidad</th>
                                <th class="tw:text-center">Calificación modificada</th>
                                <th class="tw:text-center">Calificación actual</th>
                            </tr>
                        </thead>
												<tbody>
												@foreach($array_evaluaciones as $bt_evaluaciones)
														<tr>
																<td>{{$bt_evaluaciones->{'docente'} }}</td>
																<td>{{$bt_evaluaciones->{'materia'} }}</td>
																<td>Unidad {{$bt_evaluaciones->{'unidad'} }}</td>
																<td>{{$bt_evaluaciones->{'cal_antigua'} }}</td>
																<td>{{$bt_evaluaciones->{'cal_nueva'} }}</td>
														</tr>
														@endforeach
												</tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
