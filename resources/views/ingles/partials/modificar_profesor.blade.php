{{--
    Datos P. › Editar del profesor de inglés (/profesores_ingles/modificar/{id_usuario},
    In_registrar_profesoresController@modificar_profesor). Diseño del panel; mismo formulario
    (#form_modificar_profesores_ingles, POST /profesores_ingles/modificacion/profesor, mismos campos, valores
    y opciones) y mismo datepicker en .fecha_termino. Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'Modificación Docentes')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
    <?php $moduloIngles = true; ?>
    <main>
        <x-panel.encabezado titulo="Modificar Facilitador de Ingles" :migas="['Inglés' => url('/ingles/')]" />

        <x-panel.tarjeta titulo="Datos del facilitador">
            <form id="form_modificar_profesores_ingles" action="{{url("/profesores_ingles/modificacion/profesor")}}" class="form tw:space-y-6" role="form" method="POST">
                {{ csrf_field() }}
                <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-3">
                    <x-panel.input etiqueta="Nombre Completo" type="text" id="nombre_profesor" name="nombre_profesor" placeholder="Nombre" style="text-transform:uppercase" value="{{  $datos_profesor->nombre }}" required />
                    <x-panel.input etiqueta="Apellido Paterno" type="text" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno" style="text-transform:uppercase" value="{{  $datos_profesor->apellido_paterno }}" required />
                    <x-panel.input etiqueta="Apellido Materno" type="text" id="ap_materno" name="ap_materno" placeholder="Apellido Materno" style="text-transform:uppercase" value="{{  $datos_profesor->apellido_materno}}" required />
                </div>

                <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-3">
                    <x-panel.select etiqueta="Sexo" name="sexo" id="sexo" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($sexos as $sexo)
                            @if($sexo->id_sexo==$datos_profesor->id_sexo)
                                <option value="{{$datos_profesor->id_sexo}}" selected="selected" >{{$sexo->descripcion}}</option>
                            @else
                                <option value="{{$sexo->id_sexo}}"> {{$sexo->descripcion}}</option>
                            @endif
                        @endforeach
                    </x-panel.select>
                    <x-panel.select etiqueta="Nivel ingles" name="nivel_ingles" id="nivel_ingles" required>
                        <option disabled selected>Selecciona nivel de ingles...</option>
                        @foreach($nivel_ingles as $nivel)
                            @if($nivel->id_nivel_ingles==$datos_profesor->id_nivel_ingles)
                                <option value="{{$datos_profesor->id_nivel_ingles}}" selected="selected" >{{$nivel->descripcion}}</option>
                            @else
                                <option value="{{$nivel->id_nivel_ingles}}"> {{$nivel->descripcion}}</option>
                            @endif
                        @endforeach
                    </x-panel.select>
                    <x-panel.select etiqueta="Certificado o Constancia" name="titulo" id="titulo" required>
                        <option disabled selected>Selecciona ...</option>
                        @foreach($titulos as $titulo)
                            @if($titulo->id_titulo==$datos_profesor->id_tipo_titulo)
                                <option value="{{$datos_profesor->id_tipo_titulo}}" selected="selected" >{{$titulo->descripcion}}</option>
                            @else
                                <option value="{{$titulo->id_titulo}}"> {{$titulo->descripcion}}</option>
                            @endif
                        @endforeach
                    </x-panel.select>
                </div>

                <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-3">
                    <x-panel.input etiqueta="Fecha emision de Constancia o Certificado" class="datepicker fecha_termino" type="text" id="fecha_termino" name="fecha_termino" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" value="{{  $datos_profesor->fecha_emision_titulo}}" required />
                </div>

                <div class="tw:flex tw:justify-end">
                    <x-panel.boton type="submit" variante="exito" tamano="lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar datos</x-panel.boton>
                </div>
            </form>
        </x-panel.tarjeta>
    </main>
    <script type="text/javascript">
        $(document).ready( function() {
            $( '.fecha_termino').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            });
        });
    </script>
@endsection
