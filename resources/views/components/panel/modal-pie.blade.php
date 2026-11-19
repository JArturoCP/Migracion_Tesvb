{{-- Pie de un <x-panel.modal> (botones a la derecha). Se usa suelto cuando un <form> envuelve el cuerpo y los botones. --}}
<div {{ $attributes->class(['tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6']) }}>{{ $slot }}</div>
