
<div>


        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_envio" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Nombre del Comisionado</th>
                        <th>Viaticos</th>
                        <th>Auto</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><b>{{ $personal->titulo }}</b> {{ $personal->nombre }}</td>
                            @if(($personal->viaticos==1))
                                <td class="tw:text-center">NO</td>
                            @endif
                            @if(($personal->viaticos==2))
                                <td class="tw:text-center">SI</td>
                            @endif
                            @if(($personal->automovil==1))
                                <td class="tw:text-center">NO</td>
                                @endif
                            @if(($personal->automovil==2))
                                <td class="tw:text-center"><b>Modelo:</b>{{$personal->modelo}}<br><b>Placas:</b>{{$personal->placas}}<br><b>Licencia:</b>{{$personal->licencia}}</td>
                            @endif
                        </tr>
                    

                    </tbody>
                </table>
</div>
            </div>
            <div class="tw:w-full tw:px-2" >
                <p align="justify"><b>Motivo de la comisión:</b> <br>{{ $oficios->desc_comision }}</p>
            </div>
            <div class="tw:w-full tw:px-2" >
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_envio" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Dependencias de la comisión</th>
                        <th>Domicilio de la comision</th>
                        <th>Municipio</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dependencias as $dependencias)
                    <tr>
                        <td>{{ $dependencias->dependencia }}</td>
                        <td>{{ $dependencias->domicilio }}</td>
                        <td>{{ $dependencias->nombre_municipio }}</td>
                        <td>{{ $dependencias->nombre_estado }}</td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
</div>
            </div>

            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" >
                <?php $fecha_salida = date("d-m-Y", strtotime($oficios->fecha_salida));?>
                <p class="tw:text-center"><b>Fecha de salida:</b> <br>{{ $fecha_salida }}<br><b>Hora: </b>{{$oficios->hora_s}}</p>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" >
                <?php $fecha_regreso = date("d-m-Y", strtotime($oficios->fecha_regreso));?>
                <p class="tw:text-center"><b>Fecha de regreso:</b> <br>{{ $fecha_regreso }}<br><b>Hora: </b>{{$oficios->hora_r}}</p>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" >
                <p class="tw:text-center"><b>Lugar salida:</b> {{ $lugar_s->descripcion }}</p>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2" >
                <p class="tw:text-center"><b>Lugar regreso:</b> {{ $lugar_r->descripcion }}</p>
            </div>



        </div>



</div>

