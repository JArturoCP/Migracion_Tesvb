@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Asignar Líder</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="form-asignar-lider" action="{{ route('auditorias.asignar_lider.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="id_personal">Seleccionar Personal:</label>
                <select name="id_personal" class="form-control" required>
                    <option value="">-- Selecciona un personal --</option>
                    @foreach($personales as $personal)
                        <option value="{{ $personal->id_personal }}">{{ $personal->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        </form>

        <hr>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Líderes Asignados</h2>
            </div>
        </div>

        @if($lideres->isEmpty())
            <p>No hay líderes asignados aún.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
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
                            <form action="{{ route('auditorias.asignar_lider.destroy', $lider->id_lider) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este líder?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                    alert('Este líder ya ha sido asignado.');
                }
            });
        });
    </script>
@endsection