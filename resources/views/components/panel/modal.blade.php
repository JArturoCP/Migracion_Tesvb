{{--
    Modal de la plantilla (TailAdmin "Modal") con JS propio mínimo (partials/panel/puente.blade.php),
    sin depender de Alpine ni de Bootstrap. Se abre y se cierra igual que un modal de Bootstrap:
      - <button data-toggle="modal" data-target="#editar">…</button>, y data-dismiss="modal" para cerrar;
      - $('#editar').modal('show' | 'hide' | 'toggle'), con los eventos show/shown/hide/hidden.bs.modal;
      - window.PanelModal.abrir('editar') / window.PanelModal.cerrar('editar').
    <x-panel.modal id="editar" titulo="Editar evidencia" tamano="md">
        …cuerpo…
        <x-slot:pie><x-panel.boton type="submit">Guardar</x-panel.boton></x-slot:pie>
    </x-panel.modal>
    Si un <form> debe envolver el cuerpo y los botones, se usa sin-relleno y, dentro del form,
    <div class="tw-modal-cuerpo">…</div> y <x-panel.modal-pie>…</x-panel.modal-pie>.
    tamano: sm | md (predeterminado) | lg | xl. estatico: no se cierra con clic fuera ni con Esc.
--}}
@props(['titulo' => null, 'tamano' => 'md', 'sinRelleno' => false, 'estatico' => false])
@php
    $anchos = ['sm' => 'tw:max-w-sm', 'md' => 'tw:max-w-lg', 'lg' => 'tw:max-w-3xl', 'xl' => 'tw:max-w-5xl'];
@endphp
<div {{ $attributes->merge(['role' => 'dialog', 'aria-modal' => 'true', 'tabindex' => '-1'])->class(['tw-modal']) }}
     data-panel-modal hidden aria-hidden="true" @if ($estatico) data-backdrop="static" data-keyboard="false" @endif>
    <div class="tw-modal-fondo" data-panel-modal-fondo></div>
    <div class="tw-modal-caja {{ $anchos[$tamano] ?? $anchos['md'] }}">
        <button type="button" class="tw-modal-cerrar" data-dismiss="modal" aria-label="Cerrar">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill="currentColor" /></svg>
        </button>
        @if ($titulo || isset($encabezado))
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                @isset($encabezado)
                    {{ $encabezado }}
                @else
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h4>
                @endisset
            </div>
        @endif
        @if ($sinRelleno)
            {{ $slot }}
        @else
            <div class="tw-modal-cuerpo">{{ $slot }}</div>
        @endif
        @isset($pie)
            <x-panel.modal-pie>{{ $pie }}</x-panel.modal-pie>
        @endisset
    </div>
</div>
