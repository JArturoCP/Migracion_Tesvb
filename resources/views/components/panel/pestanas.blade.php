{{--
    Pestañas de la plantilla (TailAdmin "Tabs" con subrayado).
    Navegación entre páginas (cada pestaña es un enlace):
        <x-panel.pestanas :items="[
            ['etiqueta' => 'Expediente', 'url' => '/tutorias/inicioalu', 'activa' => true],
            ['etiqueta' => 'Actividades', 'url' => '/tutorias/actividad'],
        ]" />
    Paneles dentro de la misma página (data-toggle="tab"; lo atiende partials/panel/puente):
        <x-panel.pestanas :items="[['etiqueta' => 'Datos', 'destino' => '#datos', 'activa' => true], …]" />
        <div class="tab-content">
            <div class="tab-pane active" id="datos">…</div> …
        </div>
    Cada item acepta además 'id' (id del enlace).
--}}
@props(['items' => []])
<div {{ $attributes->class(['tw:mb-6 tw:border-b tw:border-gray-200 tw:dark:border-gray-800']) }}>
    <nav class="tw-pestanas tw:-mb-px tw:flex tw:gap-2 tw:overflow-x-auto tw:no-scrollbar" role="tablist">
        @foreach ($items as $item)
            @php $activa = $item['activa'] ?? false; @endphp
            <a href="{{ $item['url'] ?? $item['destino'] }}"
               @isset($item['id']) id="{{ $item['id'] }}" @endisset
               @isset($item['destino']) data-toggle="tab" role="tab" aria-selected="{{ $activa ? 'true' : 'false' }}" @endisset
               @if ($activa && ! isset($item['destino'])) aria-current="page" @endif
               @class(['tw-pestana', 'active' => $activa])>{{ $item['etiqueta'] }}</a>
        @endforeach
    </nav>
</div>
