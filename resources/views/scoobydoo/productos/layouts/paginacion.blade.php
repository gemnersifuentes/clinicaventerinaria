<div class="bg-white px-4 py-3 mb-4 rounded-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
    <!-- Primer div - Ordenar por -->
    <div class="flex flex-col">
        <label for="sort" class="text-sm text-gray-700">Ordenar por:</label>
        <select id="sort" onchange="window.location.href='?sort=' + this.value + '&page=1'" class="p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:bg-indigo-50">
            <option value="todos">todos</option>
            <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Más Nuevos</option>
            <option value="brand" {{ $sortBy == 'brand' ? 'selected' : '' }}>Marca</option>
            <option value="price-low-high" {{ $sortBy == 'price-low-high' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
            <option value="price-high-low" {{ $sortBy == 'price-high-low' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
        </select>
    </div>

    <!-- Segundo div - Paginación -->
    <div class="flex justify-end items-center space-x-3">
        {{-- Previous Page Link --}}
        @if ($productos->onFirstPage())
            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full cursor-not-allowed" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" class="text-gray-700" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        @else
            <a href="{{ $productos->appends(['sort' => $sortBy])->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" class="text-gray-700" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        @endif

        {{-- Page Numbers --}}
        <div class="flex space-x-1">
            @php
                $currentPage = $productos->currentPage();
                $lastPage = $productos->lastPage();
            @endphp

            {{-- First page always shown --}}
            <a href="{{ $productos->appends(['sort' => $sortBy])->url(1) }}" class="px-3 py-1 {{ $currentPage == 1 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                1
            </a>

            {{-- Show ellipsis and adjacent pages for context --}}
            @if($currentPage > 3)
                <span class="px-3 py-1 text-gray-500">...</span>
            @endif

            {{-- Show 2 pages before and after current page --}}
            @for($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++)
                @if($i != 1 && $i != $lastPage)
                    <a href="{{ $productos->appends(['sort' => $sortBy])->url($i) }}" class="px-3 py-1 {{ $currentPage == $i ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        {{ $i }}
                    </a>
                @endif
            @endfor

            {{-- Show ellipsis if needed --}}
            @if($currentPage < $lastPage - 2)
                <span class="px-3 py-1 text-gray-500">...</span>
            @endif

            {{-- Last page always shown --}}
            @if($lastPage > 1)
                <a href="{{ $productos->appends(['sort' => $sortBy])->url($lastPage) }}" class="px-3 py-1 {{ $currentPage == $lastPage ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    {{ $lastPage }}
                </a>
            @endif
        </div>

        {{-- Next Page Link --}}
        @if ($productos->hasMorePages())
            <a href="{{ $productos->appends(['sort' => $sortBy])->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" class="text-gray-700" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full cursor-not-allowed" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" class="text-gray-700" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif
    </div>
</div>