@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Cupo máximo de grupos de inglés')
@section('content')
    <main class="ingles-cupos tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Cupo máximo de grupos de inglés</h1>
            <p class="tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">Periodo: {{ $periodo->periodo_ingles }}</p>
        </header>

        @if($estado_maximo==0)
            <x-panel.tarjeta titulo="Configurar cupo máximo">
                <form action="{{url("/ingles/guardar_maximo_grupo_alumnos")}}" role="form" method="post" class="tw:space-y-4">
                    @csrf
                    <div class="tw:max-w-md">
                        <label for="num_max_alumnos">Número máximo de alumnos</label>
                        <input type="number" id="num_max_alumnos" name="num_max_alumnos"
                            placeholder="¡¡¡Ingrese número de usuarios para el nivel!!!" class="form-control" required/>
                    </div>
                    <x-panel.boton type="submit" id="boton_azul">Guardar</x-panel.boton>
                </form>
            </x-panel.tarjeta>
        @else($estado_maximo==1)
            <div id="consultar" class="tesvb-tabla-scroll">
                <x-panel.tabla id="table_enviado" class="table tw:mb-0" desplazable="Cupo máximo del periodo">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Número Máximo de Alumnos</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $maximo_estudiantes->num_maximo_alumnos }}</td>
                            <td>
                                <form action="{{url("/ingles/editar_maximo")}}" method="POST">
                                    @csrf
                                    <x-panel.boton variante="secundario" id="boton_editar" type="button" aria-controls="editar_maximo">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar
                                    </x-panel.boton>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </x-panel.tabla>
            </div>

            <div id="editar_maximo" style="display:none;">
                <x-panel.tarjeta titulo="Editar cupo máximo">
                    <form action="{{url("/ingles/guardar_editar_boton")}}" role="form" method="post" class="tw:space-y-4">
                        @csrf
                        <div class="tw:max-w-md">
                            <label for="num_max_alumnos">Nuevo número máximo de alumnos</label>
                            <input type="number" id="num_max_alumnos" name="num_max_alumnos"
                                placeholder="Edite número de usuarios para el nivel!!!" class="form-control" required/>
                        </div>
                        <div class="tw:flex tw:flex-wrap tw:gap-2">
                            <x-panel.boton type="submit" id="boton_azul">Guardar</x-panel.boton>
                            <x-panel.boton variante="secundario" type="button" id="cerrar">Cerrar edición</x-panel.boton>
                        </div>
                    </form>
                </x-panel.tarjeta>
            </div>
        @endif
    </main>

    <style>
        .dark .ingles-cupos .form-control {
            background-color: #1d2939;
            color: #f2f4f7;
            border-color: #667085;
            color-scheme: dark;
        }

        .dark .ingles-cupos .form-control::placeholder {
            color: #b0bfce;
        }

        .ingles-cupos :is(button, .form-control):focus-visible {
            outline: 2px solid #3538cd;
            outline-offset: 2px;
        }

        .dark .ingles-cupos :is(button, .form-control):focus-visible {
            outline-color: #a4bcfd;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
        	$ ("#boton_editar").click(function(){
        		$("#editar_maximo").css("display","block");
        	});
        	$ ("#cerrar").click(function(){
        		$("#editar_maximo").css("display","none");
        	});
        });
    </script>
@endsection
