<div>


    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2" >
            <p align="justify"><b>No. cuenta: </b> {{ $datos->cuenta }} <b>
                    <br> Nombre del alumno:</b> {{ $datos->nombre }} {{ $datos->apaterno}} {{ $datos->amaterno}}
                    <br><b>Curp:</b> {{ $datos->curp_al }}
                    <br><b>Genero:</b> {{ $datos->genero }}
                    <br><b>Fecha nacimiento:</b> {{ $datos->fecha_nac}}
                <br><b>Edad:</b> {{ $datos->edad }}
                <br><b>Estado civil:</b>{{ $datos->edo_civil}}
                <br><b>Nacionalidad:</b> {{ $datos->nacionalidad }}
                <br><b>Correo:</b> {{ $datos->correo_al}}
                <br><b>Telefono:</b> {{ $datos->cel_al }}
                <br><b>Grado de estudios:</b> {{ $datos->grado_estudio_al}}
                <br><b>Carrera:</b> {{ $datos->carrera }}
                 <br><b>Semestre:</b> {{ $datos->semestre}}
                 <br><b>Grupo:</b> {{ $datos->id_semestre}}0{{ $datos->grupo }}
                <br><b>Promedio de la preparatoria:</b> {{ $datos->promedio_preparatoria}}
                <br><b>Discapacidad:</b>
                @if( $datos->discapacidad==0 )
                    No respondio

                @elseif( $datos->discapacidad==2 )
                    SI   <b>¿Cuál?</b> {{ $datos->descripcion_discapacidad }}
                @elseif( $datos->discapacidad==1 )
                    NO
                @endif



            <br><b>Habla un lengua ingigena:</b>
                @if( $datos->lengua==0 )
                    No respondio

                @elseif( $datos->lengua==2 )
                    SI   <b>¿Cuál?</b> {{ $datos->descripcion_lengua }}
                @elseif( $datos->lengua==1 )
                    NO
                @endif
                <br><b> Institucion de Salud Pública:</b>
                @if( $datos->seguro==0 )
                    No respondio

                @elseif( $datos->seguro==1 )
                    IMSS

                @elseif( $datos->seguro==2 )
                    ISSSTE

                @elseif( $datos->seguro==3 )

                    ISSEMYM

                @elseif( $datos->seguro==4 )
                    SEGURO POPULAR

                @endif
                <br><b>Número de seguro social:</b> {{ $datos->numero_seguro_social}}
            </p>
        </div>

    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>Domicilio:</p>
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_envio" class="tw-tabla tw-tabla-bordes">
                <thead>
                <tr>
                    <th>Estado</th>
                    <th>Municipio</th>
                    <th>Calle</th>
                    <th>No. exterior</th>
                    <th>No. interior</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>{{ $datos->nombre_estado }}</td>
                    <td>{{ $datos->nombre_municipio }}</td>
                    <td>{{ $datos->calle_al }}</td>
                    <td>{{ $datos->numero_exterior }}</td>
                    <td>{{ $datos->numero_interior }}</td>

                </tr>
                </tbody>
                <thead>
                <tr>
                    <th>Entre calle</th>
                    <th>Y calle</th>
                    <th>Otra referncia</th>
                    <th>Colonia</th>
                    <th>Codigo postal</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>{{ $datos->entre_calle }}</td>
                    <td>{{ $datos->y_calle }}</td>
                    <td>{{ $datos->otra_ref }}</td>
                    <td>{{ $datos->localidad_al }}</td>
                    <td>{{ $datos->cp }}</td>

                </tr>
                </tbody>
            </table>
</div>
        </div>
    </div>







</div>