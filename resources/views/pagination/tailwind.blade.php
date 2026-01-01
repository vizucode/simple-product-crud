@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between border-t border-gray-200 pt-6">
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    {!! __('Showing') !!}
                    <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <div class="isolate inline-flex gap-1 rounded-lg border border-gray-300 shadow-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white cursor-not-allowed">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-0">
                            {!! __('pagination.previous') !!}
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white cursor-default">{{ $element }}</span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold bg-blue-600 text-white focus:z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-0">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-0">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-0">
                            {!! __('pagination.next') !!}
                        </a>
                    @else
                        <span aria-disabled="true" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white cursor-not-allowed">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Mobile Pagination --}}
        <div class="flex w-full sm:hidden">
            <div class="flex-1">
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        {!! __('pagination.previous') !!}
                    </a>
                @endif
            </div>

            <div class="flex-1 text-right">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        {!! __('pagination.next') !!}
                    </a>
                @else
                    <span aria-disabled="true" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
