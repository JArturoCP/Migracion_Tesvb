@extends('layouts.panel')
@section('title', 'Modificación Docentes')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')
@section('content')
    <?php $moduloIngles = true; ?>
    <main>
        <x-panel.encabezado titulo="Modificar Facilitador de Ingles" :migas="['Inglés' => url('/ingles/')]" />

        <x-panel.tarjeta titulo="Datos del facilitador">
            <x-slot:acciones>
                <x-panel.boton id="abrir_edicion_facilitador" data-toggle="modal" data-target="#editar_facilitador">Editar datos</x-panel.boton>
            </x-slot:acciones>
            <p class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                {{ $datos_profesor->nombre }} {{ $datos_profesor->apellido_paterno }} {{ $datos_profesor->apellido_materno }}
            </p>
            @if (session('facilitador_actualizado'))
                <x-panel.alerta tipo="exito" class="tw:mt-4">{{ session('facilitador_actualizado') }}</x-panel.alerta>
            @endif
        </x-panel.tarjeta>

        <x-panel.modal id="editar_facilitador" titulo="Editar datos del facilitador" tamano="lg" sin-relleno estatico aria-label="Editar datos del facilitador">
            <form data-panel-guardar id="form_modificar_profesores_ingles" action="{{ url('/profesores_ingles/modificacion/profesor') }}" method="POST">
                @csrf
                <div class="tw-modal-cuerpo tw:max-h-[60dvh] tw:space-y-6 tw:overflow-y-auto">
                    <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-3">
                        <x-panel.input etiqueta="Nombre Completo" type="text" id="nombre_profesor" name="nombre_profesor" placeholder="Nombre" class="tw:uppercase" :value="old('nombre_profesor', $datos_profesor->nombre)" :error="$errors->first('nombre_profesor')" required />
                        <x-panel.input etiqueta="Apellido Paterno" type="text" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno" class="tw:uppercase" :value="old('ap_paterno', $datos_profesor->apellido_paterno)" :error="$errors->first('ap_paterno')" required />
                        <x-panel.input etiqueta="Apellido Materno" type="text" id="ap_materno" name="ap_materno" placeholder="Apellido Materno" class="tw:uppercase" :value="old('ap_materno', $datos_profesor->apellido_materno)" :error="$errors->first('ap_materno')" required />
                    </div>

                    <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-3">
                        <x-panel.select etiqueta="Sexo" name="sexo" id="sexo" :error="$errors->first('sexo')" required>
                            <option value="">Selecciona una opción</option>
                            @foreach ($sexos as $sexo)
                                <option value="{{ $sexo->id_sexo }}" @selected((string) old('sexo', $datos_profesor->id_sexo) === (string) $sexo->id_sexo)>{{ $sexo->descripcion }}</option>
                            @endforeach
                        </x-panel.select>
                        <x-panel.select etiqueta="Nivel ingles" name="nivel_ingles" id="nivel_ingles" :error="$errors->first('nivel_ingles')" required>
                            <option value="">Selecciona una opción</option>
                            @foreach ($nivel_ingles as $nivel)
                                <option value="{{ $nivel->id_nivel_ingles }}" @selected((string) old('nivel_ingles', $datos_profesor->id_nivel_ingles) === (string) $nivel->id_nivel_ingles)>{{ $nivel->descripcion }}</option>
                            @endforeach
                        </x-panel.select>
                        <x-panel.select etiqueta="Certificado o Constancia" name="titulo" id="titulo" :error="$errors->first('titulo')" required>
                            <option value="">Selecciona una opción</option>
                            @foreach ($titulos as $titulo)
                                <option value="{{ $titulo->id_titulo }}" @selected((string) old('titulo', $datos_profesor->id_tipo_titulo) === (string) $titulo->id_titulo)>{{ $titulo->descripcion }}</option>
                            @endforeach
                        </x-panel.select>
                    </div>

                    <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-3">
                        <x-panel.input etiqueta="Fecha de emisión del certificado o constancia" type="date" id="fecha_termino" name="fecha_termino"
                            :value="str_replace('/', '-', (string) old('fecha_termino', $datos_profesor->fecha_emision_titulo))"
                            :error="$errors->first('fecha_termino')" required />
                    </div>
                </div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
                    <x-panel.boton type="submit">Guardar datos</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    </main>
@endsection

@push('scripts')
<script>
$(function () {
    const boton = document.getElementById('abrir_edicion_facilitador');
    $('#editar_facilitador').on('hidden.bs.modal', function () { boton.focus(); });
    @if ($errors->any())
        window.PanelModal.abrir('editar_facilitador', boton);
    @endif
});
</script>
@endpush
