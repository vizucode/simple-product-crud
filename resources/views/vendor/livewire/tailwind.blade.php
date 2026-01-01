@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-6 border-t border-gray-100 pt-8">
            <!-- Info Text - Left -->
            <div class="text-sm text-gray-600">
                <p>
                    {!! __('Showing') !!}
                    <span class="font-semibold text-gray-900">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-semibold text-gray-900">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <!-- Pagination Buttons - Right -->
            <div class="flex items-center gap-2">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <button disabled class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed" aria-disabled="true">
                        {!! __('pagination.previous') !!}
                    </button>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 active:bg-gray-100 transition-all duration-150">
                        {!! __('pagination.previous') !!}
                    </button>
                @endif

                {{-- Pagination Elements --}}
                <div class="flex items-center gap-1">
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="px-2 py-2 text-sm text-gray-400">{{ $element }}</span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <button type="button" disabled class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg cursor-default" aria-current="page">
                                        {{ $page }}
                                    </button>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 active:bg-gray-100 transition-all duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 active:bg-gray-100 transition-all duration-150">
                        {!! __('pagination.next') !!}
                    </button>
                @else
                    <button disabled class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed" aria-disabled="true">
                        {!! __('pagination.next') !!}
                    </button>
                @endif
            </div>
        </nav>
    @endif
</div>
