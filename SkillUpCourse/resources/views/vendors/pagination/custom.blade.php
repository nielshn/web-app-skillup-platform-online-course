@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 border border-gray-300 cursor-default leading-5 rounded-md"
                                aria-hidden="true">
                                {!! __('pagination.previous') !!}
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 border border-gray-300 leading-5 rounded-md hover:text-white focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                            aria-label="@lang('pagination.previous')">
                            {!! __('pagination.previous') !!}
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-800 border border-gray-300 cursor-default leading-5 rounded-md">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-800 border border-gray-300 cursor-default leading-5 rounded-md">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-800 border border-gray-300 leading-5 rounded-md hover:text-white focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-800 border border-gray-300 leading-5 rounded-md hover:text-white focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                            aria-label="@lang('pagination.next')">
                            {!! __('pagination.next') !!}
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-800 border border-gray-300 cursor-default leading-5 rounded-md"
                                aria-hidden="true">
                                {!! __('pagination.next') !!}
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

<style>
    .pagination nav {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        margin: 0 2px;
        font-size: 14px;
        font-weight: 500;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .pagination a:hover {
        background-color: #e9ecef;
        border-color: #ccc;
        text-decoration: none;
    }

    .pagination .active span {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .pagination a svg,
    .pagination span svg {
        width: 16px;
        height: 16px;
        margin-left: 4px;
    }

    .pagination a[rel="prev"] svg,
    .pagination span[rel="prev"] svg {
        margin-left: 0;
        margin-right: 4px;
    }
</style>
