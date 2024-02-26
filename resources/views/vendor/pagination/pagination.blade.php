@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center items-center my-40">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center justify-center w-14 md:h-14 h-10 px-4 py-2 md:mx-6 mx-2 md:text-2xl text-xl text-zinc-200 bg-zinc-800 hover:bg-zinc-950 cursor-default leading-5 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
                </svg> 
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center justify-center w-14 md:h-14 h-10 px-4 py-2 md:mx-6 mx-2 md:text-2xl text-xl text-zinc-200 bg-zinc-800 hover:bg-zinc-950 leading-5 rounded-md hover:text-zinc-200 focus:outline-none focus:bg-[#A3765D] focus:shadow-outline-blue active:bg-gray-100 active:text-zinc-200 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
                </svg> 
            </a>
        @endif

        {{-- Page Links --}}
        <div class="flex">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="relative inline-flex items-center justify-center px-4 py-2 md:w-14 w-10 md:h-14 h-10 mx-2 md:text-xl text-base text-zinc-200 bg-zinc-800 hover:bg-zinc-950 cursor-default leading-5 rounded-md">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 2))
                            <a href="{{ $url }}" class="relative inline-flex items-center justify-center md:w-14 w-10 md:h-14 h-10 mx-2 px-4 py-2 md:text-xl text-base text-zinc-200 {{ $page == $paginator->currentPage() ? 'bg-[#A3765D]' : 'bg-zinc-800' }} leading-5 rounded-md hover:text-zinc-200 focus:outline-none focus:bg-[#A3765D] focus:shadow-outline-blue active:bg-gray-100 active:text-zinc-200 transition ease-in-out duration-150 {{ $page == $paginator->currentPage() ? 'bg-[#A3765D] text-white' : '' }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center justify-center w-14 md:h-14 h-10 px-4 py-2 md:mx-6 mx-2 md:text-2xl text-xl text-zinc-200 bg-zinc-800 hover:bg-zinc-950 leading-5 rounded-md hover:text-zinc-200 focus:outline-none focus:bg-[#A3765D] focus:shadow-outline-blue active:bg-gray-100 active:text-zinc-200 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                </svg>                  
            </a>
        @else
            <span class="relative inline-flex items-center justify-center w-14 md:h-14 h-10 px-4 py-2 md:mx-6 mx-2 md:text-2xl text-xl text-zinc-200 bg-zinc-800 hover:bg-zinc-950 cursor-default leading-5 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
                </svg>                  
            </span>
        @endif
    </nav>
@endif
