@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Ipomex')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Tabla general de Ipomex</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
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
                                <a target="_blank" href="{{asset($articulo->pdf_general)}}">Ver PDF</a>
                            @else
                                No tiene PDF
                            @endif
                                    <br>
                                @if($articulo->pdf_general_2 != "")
                                    <a target="_blank" href="{{asset($articulo->pdf_general_2)}}">Ver PDF 2</a>
                                @else

                                @endif
                                </td>
                            <td>{{ $articulo->articulo_estatal }} </td>
                            <td>{{ $articulo->fraccion_estatal }} </td>
                                <td>
                            @if($articulo->tiene_fra_estatal==1)
                                <a target="_blank" href="{{asset($articulo->pdf_general)}}"> Ver PDF</a>
                            @else
                                No tiene PDF
                            @endif

                                </td>
                            <td>{{ $denominacion_fraccion }} </td>
                            <td> <textarea id="myTextarea" style="">{{ $periodo_ley_general }} </textarea></td>
                            <td>{{  $observacion_inf_general }} </td>
                            <td><textarea id="myTextarea" style="">{{$periodo_actualizacion_general}} </textarea></td>




                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
    </main>
@endsection