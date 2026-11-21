{{--
    Paginación con el estilo del panel (TailAdmin "Pagination"). Uso: {!! $paginador->links('pagination::panel') !!}
--}}
@if ($paginator->hasPages())
    @php
        $base = 'tw:inline-flex tw:h-10 tw:min-w-10 tw:items-center tw:justify-center tw:rounded-lg tw:px-3 tw:text-sm tw:font-medium';
        $enlace = $base . ' tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:hover:bg-gray-50 tw:hover:text-brand-500 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03]';
        $inactivo = $base . ' tw:cursor-not-allowed tw:text-gray-300 tw:ring-1 tw:ring-gray-200 tw:ring-inset tw:dark:text-gray-600 tw:dark:ring-gray-800';
        $actual = $base . ' tw:bg-brand-500 tw:text-white';
    @endphp
    <nav role="navigation" aria-label="Paginación" class="tw:flex tw:flex-wrap tw:items-center tw:justify-center tw:gap-1.5">
        @if ($paginator->onFirstPage())
            <span class="{{ $inactivo }}" aria-disabled="true" aria-label="Anterior">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $enlace }}" aria-label="Anterior">&lsaquo;</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="{{ $base }} tw:text-gray-500" aria-disabled="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="{{ $actual }}" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="{{ $enlace }}" aria-label="Página {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $enlace }}" aria-label="Siguiente">&rsaquo;</a>
        @else
            <span class="{{ $inactivo }}" aria-disabled="true" aria-label="Siguiente">&rsaquo;</span>
        @endif
    </nav>
@endif
