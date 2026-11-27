<x-panel.hero etiqueta="Portal estudiantil TESVB" titulo-id="estudiante-saludo"
    :titulo="$estudiante['nombre'] ? 'Hola, '.$estudiante['nombre'] : 'Te damos la bienvenida'"
    :meta="['Semestre registrado' => $estudiante['semestre'] ?: null, 'Periodo seleccionado' => $estudiante['periodo'] ?? 'No disponible']"
    :mascota="$estudiante['mascota']" :logo="$estudiante['logo']">
    <x-slot:identidad>
        @include('panel.dashboard.estudiante.identidad')
    </x-slot:identidad>
</x-panel.hero>
