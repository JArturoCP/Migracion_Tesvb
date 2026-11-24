@extends('layouts.panel')
@section('title', 'DocenteActividad')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="DOCENTES EN ACTIVIDADES" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-target="#nuevo_docente" data-toggle="modal" variante="primario" tamano="sm">
                <span class="fa fa-plus" aria-hidden="true"></span> Asignar Docente
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla class="tabla-grande2">
            <thead>
                <tr>
                    <th>Nombre de Actividad</th>
                    <th>Categoría</th>
                    <th>Número de Horas</th>
                    <th>Docente</th>
                    <th class="tw:text-center">Editar</th>
                    <th class="tw:text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docentes_tabla as $docente)
                <tr>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$docente->descripcion}}</td>
                    <td>{{$docente->descripcion_cat}}</td>
                    <td>{{$docente->horas}}</td>
                    <td>{{$docente->titulo}} {{$docente->nombre}}</td>
                    <td class="tw:text-center">
                        <a href="{{url("/docente_actividad/".$docente->id_docente_actividad."/edit")}}" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Editar">
                            <span class="fa fa-cog em" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="tw:text-center">
                        <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{$docente->id_docente_actividad}}" title="Eliminar">
                            <span class="fa fa-trash em" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

@if(isset($editar_docente))
    @include('actividades_complementarias.partials_actividades.jefatura.editar_docente')
@endif

<x-panel.modal id="nuevo_docente" titulo="Asignar docente" tamano="lg" sin-relleno aria-label="Asignar docente">
    <form method="POST" action="{{ route('docente_actividad.store') }}" id="docente_actividad"
          class="tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600">
        @csrf
        <div class="tw-modal-cuerpo tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
            <x-panel.select etiqueta="Categoría" name="categoria_docente" id="categoria_docente" required>
                <option value="" disabled selected hidden>Selecciona opción</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->descripcion_cat }}</option>
                @endforeach
            </x-panel.select>

            <x-panel.select etiqueta="Actividad" name="actividad_docente" id="actividad_docente" required>
                <option value="" disabled selected hidden>Selecciona opción</option>
            </x-panel.select>

            <x-panel.input etiqueta="Número de horas" id="horas_docente" type="text" placeholder="Horas" disabled />

            <x-panel.select etiqueta="Docente asignado" name="docente" id="docente_asignado" required>
                <option value="" disabled selected hidden>Selecciona opción</option>
                @foreach ($docentes as $docenteAsignado)
                    <option value="{{ $docenteAsignado->id_personal }}">{{ $docenteAsignado->titulo }} {{ $docenteAsignado->nombre }}</option>
                @endforeach
            </x-panel.select>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit">Registrar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

<x-panel.modal id="modal_elimina" titulo="Eliminar asignación" tamano="sm" sin-relleno aria-label="Eliminar asignación">
    <form method="POST" id="form_delete">
        @csrf
        @method('DELETE')
        <div class="tw-modal-cuerpo">¿Realmente deseas eliminar esta asignación?</div>
        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" variante="peligro">Eliminar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>

</main>

<script>
    $(function () {
        const carrera = @json($carrera);
        const actividad = $('#actividad_docente');
        const horas = $('#horas_docente');
        const opcionInicial = actividad.find('option').clone();
        let solicitud;

        $('.elimina').on('click', function () {
            $('#form_delete').attr('action', @json(url('/docente_actividad')) + '/' + this.id);
            $('#modal_elimina').modal('show');
        });

        $('#docente_actividad').validate();

        $('#categoria_docente').on('change', function () {
            solicitud?.abort();
            actividad.empty().append(opcionInicial.clone()).val('');
            horas.val('');

            solicitud = $.get(@json(url('/docente_nueva_actividad')), { id_actividad: this.value }, function (datos) {
                for (const opcion of datos) {
                    if (opcion.estado == 1 && opcion.id_jefatura == carrera) {
                        actividad.append($('<option>', {
                            value: opcion.id_actividad_comple,
                            text: opcion.descripcion,
                            'data-horas': opcion.horas,
                        }));
                    }
                }
            });
        });

        actividad.on('change', function () {
            horas.val(actividad.find(':selected').data('horas') ?? '');
        });
    });
</script>

@endsection
