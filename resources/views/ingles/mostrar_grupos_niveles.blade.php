@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Grupos de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Grupos de inglés</h1>


        @if($sin_consultar == 0)
            <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                <div id="niveles_ingles">
                    <div class="dropdown">
                        <label for="id_nivel">Niveles</label>
                        <select name="id_nivel" id="id_nivel" class="form-control ingles-catalogo-select" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($niveles as $nivel)
                                <option value="{{$nivel->id_niveles_ingles}}"> {{$nivel->descripcion}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div id="grupo_ingles" style="display: none;">
                    <div class="dropdown" >
                        <label for="grupos">Grupos</label>
                        <select class="form-control ingles-catalogo-select" placeholder="selecciona una Opcion" id="grupos" name="grupos" value="" required>

                        </select>
                    </div>
                </div>
            </div>
            @else
            <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                <div id="niveles_ingles">
                    <div class="dropdown">
                        <label for="id_nivel">Niveles</label>
                        <select name="id_nivel" id="id_nivel" class="form-control ingles-catalogo-select" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($niveles as $nivel)
                                @if($nivel->id_niveles_ingles==$id_nivel)
                                    <option value="{{$id_nivel}}" selected="selected">{{ $nivel->descripcion }}</option>
                                @else
                                    <option value="{{$nivel->id_niveles_ingles}}" >{{ $nivel->descripcion }}</option>
                                @endif  @endforeach

                        </select>
                    </div>
                </div>
                <div id="grupo_ingles">
                    <div class="dropdown" >
                        <label for="grupos">Grupos</label>
                        <select class="form-control ingles-catalogo-select" placeholder="selecciona una Opcion"id="grupos"  value=""  required>
                            @foreach($grupos as $grupo)
                                @if($grupo->id_grupo_ingles==$id_grupo)
                                    <option value="{{$id_grupo}}" selected="selected">{{ $grupo->descripcion }}</option>
                                @else
                                    <option value="{{$grupo->id_grupo_ingles}}" >{{ $grupo->descripcion }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @if($no_horario==1)
            <div id="facilitador">
                <x-panel.tarjeta>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
                        <h2 class="tw:m-0 tw:text-base tw:font-semibold">
                            Facilitador: {{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}
                        </h2>
                        <div id="imprimir">
                            <x-panel.boton href="/ingles_horarios/pdf_grupo_horarios/{{ $id_grupo }}/{{ $id_nivel }}"
                                class="btn btn-primary crear" target="_blank" rel="noopener">
                                <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
                            </x-panel.boton>
                        </div>
                    </div>
                </x-panel.tarjeta>
            </div>

            @endif
            <div id="consultar" class="tesvb-tabla-scroll">
                    <x-panel.tabla id="table_enviado" class="table tw:mb-0" style="min-width: 720px !important" desplazable="Horario del grupo" aria-label="Horario del grupo">
                        <thead>
                        <tr>
                            <th scope="col">Hora/Día</th>
                            <th scope="col">Lunes </th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miercoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                            <th scope="col">Sabado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador=1 ?>

                        @forelse($semanas as $semana)
                            @if($contador==1)
                                <tr>
                                    <td class="horario">{{ $semana->hora }}</td>
                                    @endif
                                    <td id="{{ $semana->id_semana }}" class="horario">
                                        @foreach($array_ingles as $horario_ingles)
                                            @if($horario_ingles['id_semana']==$semana->id_semana)
                                                @if($horario_ingles['disponibilidad'] ==2)

                                                    <div class="bg-success tw:rounded-lg tw:bg-green-50 tw:p-2 tw:dark:bg-gray-800 tw:dark:text-green-300">{{$horario_ingles['nivel']}} <br><b>GRUPO:</b>{{$horario_ingles['grupo']}}<br>

                                                    </div>
                                                @elseif($horario_ingles['disponibilidad'] == 3 )
                                                    <div class="">
                                                    </div>

                                                @endif



                                            @endif
                                        @endforeach

                                    </td>


                                    <?php $contador++?>
                                    @if($contador==7)
                                    <?php $contador=1 ?>


                                </tr>
                            @endif

                        @empty
                            <tr><td colspan="7">No hay bloques de horario para mostrar.</td></tr>
                        @endforelse
                        </tbody>
                    </x-panel.tabla>
            </div>
        @endif
    </main>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#id_nivel").on('change',function(e) {
                $.get('/ingles_horarios/ingles_niveles/', function (data) {
                    $("#facilitador").css( { "display": "none"});
                    $("#consultar").css( { "display": "none"});
                    $("#grupo_ingles").css( { "display": "inline"});
                    $('#grupos').empty();

                    $.each(data, function (datos_alumno, subcatObj) {
                        //  TNotify.alert(subcatObj);
                        $('#grupos').append('<option disabled selected hidden>Selecciona una opción</option><option value="' + subcatObj.id_grupo_ingles + '">' + subcatObj.descripcion + '</option>');
                    });
                });
            });
            $("#grupos").on('change',function(e) {
                // TNotify.alert($("#grupos").val());
                $("#facilitador").css( { "display": "inline"});
                $("#consultar").css( { "display": "inline"});
                var id_grupos = $("#grupos").val();
                var id_nivel = $("#id_nivel").val();
                window.location.href='/ingles/grupos_niveles/'+id_grupos+'/'+id_nivel ;


            });
        });
</script>
    <style>
        .dark .ingles-catalogo-select {
            background: #1d2939;
            color: #f2f4f7;
            border-color: #667085;
            color-scheme: dark;
        }
    </style>
@endsection

