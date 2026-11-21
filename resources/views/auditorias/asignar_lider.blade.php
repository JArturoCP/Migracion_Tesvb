@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:w-full">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h2 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Asignar Líder</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">{{ session('success') }}</div>
        @endif

        <form id="form-asignar-lider" action="{{ route('auditorias.asignar_lider.store') }}" method="POST">
        @csrf
            <div class="tw:mb-4">
                <label for="id_personal">Seleccionar Personal:</label>
                <select name="id_personal" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                    <option value="">-- Selecciona un personal --</option>
                    @foreach($personales as $personal)
                        <option value="{{ $personal->id_personal }}">{{ $personal->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:mt-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
        </form>

        <hr>
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h2 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Líderes Asignados</h2>
            </div>
        </div>

        @if($lideres->isEmpty())
            <p>No hay líderes asignados aún.</p>
        @else
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes tw:mt-4">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Personal</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lideres as $index => $lider)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $lider->personal->nombre ?? 'No encontrado' }}</td>
                        <td>
                            <form action="{{ route('auditorias.asignar_lider.destroy', $lider->id_lider) }}" method="POST" onsubmit="return TNotify.confirmAction(event, this, '¿Estás seguro de eliminar este líder?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
</div>
        @endif
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lideresAsignados = [...new Set(@json($lideresAsignadosIds).map(Number))];
            console.log("IDs asignados (limpios):", lideresAsignados);

            const form = document.querySelector('#form-asignar-lider');
            form.addEventListener('submit', function(e) {
                const seleccionado = parseInt(document.querySelector('[name="id_personal"]').value);
                console.log("ID seleccionado:", seleccionado);

                if (lideresAsignados.includes(seleccionado)) {
                    e.preventDefault();
                    TNotify.alert('Este líder ya ha sido asignado.');
                }
            });
        });
    </script>
</div>
@endsection
