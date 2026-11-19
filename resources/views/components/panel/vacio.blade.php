{{--
    Estado vacío: cuando una lista o tabla no tiene registros.
    <x-panel.vacio titulo="Sin actividades" mensaje="Tu tutor aún no registra actividades." />
    El slot (opcional) va debajo del mensaje, p. ej. un botón.
--}}
@props(['titulo' => 'Sin datos', 'mensaje' => null])
<div {{ $attributes->class(['tw:flex tw:flex-col tw:items-center tw:justify-center tw:gap-2 tw:rounded-xl tw:border tw:border-dashed tw:border-gray-300 tw:px-6 tw:py-10 tw:text-center tw:dark:border-gray-700']) }}>
    <span class="tw:flex tw:size-12 tw:items-center tw:justify-center tw:rounded-full tw:bg-gray-100 tw:text-gray-500 tw:dark:bg-white/5 tw:dark:text-gray-400" aria-hidden="true">
        <svg class="tw:fill-current" width="24" height="24" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5C19.7426 20.75 20.75 19.7426 20.75 18.5V5.5C20.75 4.25736 19.7426 3.25 18.5 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5C18.9142 4.75 19.25 5.08579 19.25 5.5V13.25H15.5C15.0858 13.25 14.75 13.5858 14.75 14C14.75 15.5188 13.5188 16.75 12 16.75C10.4812 16.75 9.25 15.5188 9.25 14C9.25 13.5858 8.91421 13.25 8.5 13.25H4.75V5.5ZM4.75 14.75V18.5C4.75 18.9142 5.08579 19.25 5.5 19.25H18.5C18.9142 19.25 19.25 18.9142 19.25 18.5V14.75H16.1708C15.8221 16.6014 14.0629 18.25 12 18.25C9.93712 18.25 8.17788 16.6014 7.82918 14.75H4.75Z" /></svg>
    </span>
    <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h4>
    @if ($mensaje)
        <p class="tw:max-w-md tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $mensaje }}</p>
    @endif
    {{ $slot }}
</div>
