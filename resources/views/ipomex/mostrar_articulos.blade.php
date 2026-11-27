@extends('layouts.panel')
@section('title', 'Ipomex')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <x-panel.encabezado titulo="Tabla general de Ipomex" :migas="['IPOMEX' => null]" />

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>ARTÍCULO LEY GENERAL</th>
                        <th>FRACCIÓN</th>
                        <th>CONSULTAR FRACCIÓN ART. GENERAL</th>
                        <th>ARTÍCULO LEY ESTATAL</th>
                        <th>FRACCIÓN</th>
                        <th>CONSULTAR FRACCIÓN ART. LEY  ESTATAL</th>
                        <th>DENOMINACIÓN DE LA FRACCIÓN</th>
                        <th>PERIODO DE ACTUALIZACIÓN, PRE APROBACIÓN Y VALIDACIÓN</th>
                        <th>OBSERVACIONES ACERCA DE LA INFORMACIÓN A PUBLICAR</th>
                        <th>PERIODO DE CONSERVACIÓN</th>


                    </tr>
                    </thead>

                    <tbody>
                    @foreach($articulos as $articulo)
                        <tr>
                            <?php   $denominacion_fraccion=$articulo->denominacion_fraccion; ?>
                            <?php   $periodo_ley_general=$articulo->periodo_ley_general; ?>
                            <?php   $observacion_inf_general=$articulo->observacion_inf_general; ?>
                            <?php   $periodo_actualizacion_general=$articulo->periodo_actualizacion_general; ?>

                            <td>{{ $articulo->articulo_general }} </td>
                            <td>{{ $articulo->fraccion_general }} </td>
                                <td>
                            @if($articulo->tiene_fra_general==0)
                                <a class="tw:text-brand-500 tw:hover:underline" target="_blank" href="{{asset($articulo->pdf_general)}}">Ver PDF</a>
                            @else
                                No tiene PDF
                            @endif
                                    <br>
                                @if($articulo->pdf_general_2 != "")
                                    <a class="tw:text-brand-500 tw:hover:underline" target="_blank" href="{{asset($articulo->pdf_general_2)}}">Ver PDF 2</a>
                                @else

                                @endif
                                </td>
                            <td>{{ $articulo->articulo_estatal }} </td>
                            <td>{{ $articulo->fraccion_estatal }} </td>
                                <td>
                            @if($articulo->tiene_fra_estatal==1)
                                <a class="tw:text-brand-500 tw:hover:underline" target="_blank" href="{{asset($articulo->pdf_general)}}"> Ver PDF</a>
                            @else
                                No tiene PDF
                            @endif

                                </td>
                            <td>{{ $denominacion_fraccion }} </td>
                            <td> <textarea id="myTextarea">{{ $periodo_ley_general }} </textarea></td>
                            <td>{{  $observacion_inf_general }} </td>
                            <td><textarea id="myTextarea">{{$periodo_actualizacion_general}} </textarea></td>




                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
    </main>
</div>
@endsection