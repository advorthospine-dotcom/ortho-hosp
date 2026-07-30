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
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full py-2">
            
            <!-- Showing info text (Clean frameless) -->
            <div class="text-xs text-slate-500 font-medium text-center sm:text-left">
                Showing <span class="font-extrabold text-slate-900">{{ $paginator->firstItem() }}</span> to <span class="font-extrabold text-slate-900">{{ $paginator->lastItem() }}</span> of <span class="font-extrabold text-[#114b5f]">{{ $paginator->total() }}</span> items
            </div>

            <!-- Page Buttons Group -->
            <div class="flex items-center gap-1.5 flex-wrap justify-center">
                
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-bold text-slate-300 bg-slate-100/60 border border-slate-200/60 rounded-xl cursor-not-allowed select-none">
                        <i class="ri-arrow-left-s-line text-sm"></i>
                        <span>Previous</span>
                    </span>
                @else
                    <button type="button" 
                            wire:click="previousPage('{{ $paginator->getPageName() }}')" 
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" 
                            class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-bold text-slate-700 hover:text-[#114b5f] bg-white hover:bg-teal-50/80 border border-slate-200/80 rounded-xl transition-all cursor-pointer shadow-xs active:scale-[0.98]">
                        <i class="ri-arrow-left-s-line text-sm text-[#114b5f]"></i>
                        <span>Previous</span>
                    </button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- Three Dots Separator --}}
                    @if (is_string($element))
                        <span class="px-2.5 py-2 text-xs font-bold text-slate-400 select-none">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span class="inline-flex items-center justify-center min-w-[36px] h-9 px-3 text-xs font-extrabold text-white bg-[#114b5f] rounded-xl shadow-md shadow-[#114b5f]/15 ring-2 ring-teal-100 select-none">
                                        {{ $page }}
                                    </span>
                                @else
                                    <button type="button" 
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" 
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}" 
                                            class="inline-flex items-center justify-center min-w-[36px] h-9 px-3 text-xs font-bold text-slate-700 hover:text-[#114b5f] bg-white hover:bg-teal-50 border border-slate-200/80 rounded-xl transition-all cursor-pointer shadow-xs active:scale-[0.98]">
                                        {{ $page }}
                                    </button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" 
                            wire:click="nextPage('{{ $paginator->getPageName() }}')" 
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" 
                            class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-bold text-slate-700 hover:text-[#114b5f] bg-white hover:bg-teal-50/80 border border-slate-200/80 rounded-xl transition-all cursor-pointer shadow-xs active:scale-[0.98]">
                        <span>Next</span>
                        <i class="ri-arrow-right-s-line text-sm text-[#114b5f]"></i>
                    </button>
                @else
                    <span class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-bold text-slate-300 bg-slate-100/60 border border-slate-200/60 rounded-xl cursor-not-allowed select-none">
                        <span>Next</span>
                        <i class="ri-arrow-right-s-line text-sm"></i>
                    </span>
                @endif

            </div>
        </nav>
    @endif
</div>
