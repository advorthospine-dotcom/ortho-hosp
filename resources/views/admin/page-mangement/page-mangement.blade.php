<div class="space-y-6" x-data="{ isOpen: false, deleteModalOpen: false, deleteId: null }" 
     @open-page-modal.window="isOpen = true"
     @close-page-modal.window="isOpen = false">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Page SEO & Metadata Management</h1>
            <p class="text-slate-500 text-sm mt-0.5">Control dynamic SEO titles, descriptions, open graph tags, and metadata for all website pages.</p>
        </div>
        <button @click="isOpen = true; $wire.create()" 
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#114b5f] hover:bg-[#0e3f50] text-white font-semibold text-sm rounded-xl shadow-md shadow-[#114b5f]/10 hover:shadow-[#114b5f]/20 active:scale-[0.98] transition-all cursor-pointer">
            <i class="ri-add-circle-fill text-lg"></i> Add New Page SEO
        </button>
    </div>

    <!-- List Table Container -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <!-- Search filter -->
        <div class="p-5 border-b border-slate-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="max-w-md relative group w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="ri-search-2-line text-slate-400 group-focus-within:text-[#114b5f] transition-colors"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search by page name, slug, or title..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Active Pages Live on Site</span>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-6">Page Name</th>
                        <th class="py-3.5 px-6">Slug URL</th>
                        <th class="py-3.5 px-6">Meta Title & Description</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs">
                    @forelse($pages as $page)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm">{{ $page->page_name ?? 'Untitled Page' }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-1 font-mono">
                                    <i class="ri-global-line"></i> /{{ $page->slug }}
                                </div>
                            </td>
                            <td class="py-4 px-6 font-mono text-[11px] text-slate-600">
                                <span class="bg-slate-100 px-2.5 py-1 rounded-md border border-slate-200/60">
                                    /{{ $page->slug }}
                                </span>
                            </td>
                            <td class="py-4 px-6 max-w-xs">
                                <div class="font-semibold text-slate-800 truncate" title="{{ $page->meta_title }}">
                                    {{ $page->meta_title ?: 'No title set' }}
                                </div>
                                <div class="text-[11px] text-slate-500 truncate mt-0.5" title="{{ $page->meta_description }}">
                                    {{ $page->meta_description ?: 'No meta description configured' }}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button wire:click="toggleStatus({{ $page->id }})" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-semibold text-[11px] cursor-pointer transition-all {{ $page->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $page->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ $page->is_active ? 'Active' : 'Disabled' }}
                                </button>
                            </td>
                            <td class="py-4 px-6 text-right space-x-1">
                                <button @click="isOpen = true; $wire.edit({{ $page->id }})" 
                                        class="p-2 rounded-lg hover:bg-teal-50 text-slate-600 hover:text-[#114b5f] transition-all cursor-pointer inline-flex items-center gap-1 font-medium text-xs border border-slate-200 hover:border-teal-200 shadow-xs"
                                        title="Edit SEO Metadata">
                                    <i class="ri-pencil-fill text-sm"></i> Edit SEO
                                </button>
                                <button @click="deleteId = {{ $page->id }}; deleteModalOpen = true" 
                                        class="p-2 rounded-lg hover:bg-rose-50 text-slate-400 hover:text-rose-600 transition-all cursor-pointer inline-flex items-center border border-transparent hover:border-rose-200"
                                        title="Delete Page SEO">
                                    <i class="ri-delete-bin-fill text-base"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="ri-seo-line text-4xl text-slate-300"></i>
                                    <span class="font-medium text-slate-600">No page SEO entries found matching "{{ $search }}"</span>
                                    <p class="text-xs text-slate-400">Click "Add New Page SEO" to create metadata for a custom page.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pages->hasPages())
            <div class="p-4 border-t border-slate-50 bg-slate-50/50">
                {{ $pages->links() }}
            </div>
        @endif
    </div>

    <!-- Edit/Create Page SEO Modal -->
    <div x-show="isOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" 
         x-cloak>
        
        <!-- Backdrop -->
        <div x-show="isOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="isOpen = false">
        </div>

        <!-- Dialog Box -->
        <div x-show="isOpen" 
             x-transition:enter="transition-all ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4 opacity-0"
             x-transition:enter-end="scale-100 translate-y-0 opacity-100"
             x-transition:leave="transition-all ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0 opacity-100"
             x-transition:leave-end="scale-95 translate-y-4 opacity-0"
             class="w-full max-w-3xl bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 flex flex-col my-8 overflow-hidden max-h-[90vh]">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between shrink-0 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#114b5f]/20 border border-teal-500/30 flex items-center justify-center text-teal-400">
                        <i class="ri-search-eye-line text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-white text-base">
                            {{ $pageId ? 'Edit Page SEO & Metadata' : 'Add New Page SEO Entry' }}
                        </h3>
                        <p class="text-xs text-slate-400">Manage search engine optimization and Open Graph tags</p>
                    </div>
                </div>
                <button @click="isOpen = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form wire:submit="save" class="flex-1 overflow-y-auto">
                <div class="p-6 space-y-6">

                    <!-- Live Google Search SERP Preview Box -->
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 space-y-2">
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="ri-google-fill text-[#114b5f]"></i> Live Search Engine Result Preview (SERP)
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-slate-200/80 shadow-xs space-y-1">
                            <div class="text-xs text-slate-600 truncate flex items-center gap-1 font-sans">
                                <span class="w-4 h-4 rounded-full bg-teal-100 text-teal-800 font-bold text-[10px] inline-flex items-center justify-center">AO</span>
                                <span class="font-medium text-slate-800">orthohosp.com</span>
                                <span class="text-slate-400">›</span>
                                <span class="text-slate-500">{{ $slug ?: 'page-url' }}</span>
                            </div>
                            <div class="text-base font-semibold text-[#114b5f] hover:underline truncate cursor-pointer">
                                {{ $meta_title ?: ($page_name ? $page_name . ' | Advance Orthopaedic & Spine Center' : 'Page Title - Advance Orthopaedic Hospital') }}
                            </div>
                            <div class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                {{ $meta_description ?: 'Configure a meta description below to optimize how this page appears on Google, Bing, and social shares.' }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Basic Information Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Page Name -->
                        <div class="space-y-1.5">
                            <label for="page_name" class="text-xs font-semibold text-slate-700 flex items-center justify-between">
                                <span>Page Name <span class="text-rose-500">*</span></span>
                                <span class="text-[10px] text-slate-400 font-normal">Internal admin label</span>
                            </label>
                            <input id="page_name" 
                                   type="text" 
                                   wire:model.live="page_name" 
                                   placeholder="e.g. Home Page, Joint Care Services" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('page_name') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                                   required />
                            @error('page_name')
                                <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                    <i class="ri-error-warning-line"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Slug URL -->
                        <div class="space-y-1.5">
                            <label for="slug" class="text-xs font-semibold text-slate-700 flex items-center justify-between">
                                <span>Page Slug URL <span class="text-rose-500">*</span></span>
                                <span class="text-[10px] text-slate-400 font-normal">Matching route name/path</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-mono text-slate-400 select-none">/</span>
                                <input id="slug" 
                                       type="text" 
                                       wire:model="slug" 
                                       placeholder="home, about, services, contact" 
                                       class="w-full pl-7 pr-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 font-mono text-xs focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('slug') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                                       required />
                            </div>
                            @error('slug')
                                <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                    <i class="ri-error-warning-line"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Meta Title -->
                    <div class="space-y-1.5">
                        <label for="meta_title" class="text-xs font-semibold text-slate-700 flex items-center justify-between">
                            <span>SEO Meta Title</span>
                            <span class="text-[10px] font-mono {{ strlen($meta_title) > 60 ? 'text-amber-600 font-bold' : 'text-slate-400' }}">
                                {{ strlen($meta_title) }}/60 recommended chars
                            </span>
                        </label>
                        <input id="meta_title" 
                               type="text" 
                               wire:model.live="meta_title" 
                               placeholder="e.g. Advance Orthopaedic & Spine Center | Super-Specialty Hospital" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('meta_title') border-rose-400 @enderror" />
                        @error('meta_title')
                            <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                <i class="ri-error-warning-line"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div class="space-y-1.5">
                        <label for="meta_description" class="text-xs font-semibold text-slate-700 flex items-center justify-between">
                            <span>SEO Meta Description</span>
                            <span class="text-[10px] font-mono {{ strlen($meta_description) > 160 ? 'text-amber-600 font-bold' : 'text-slate-400' }}">
                                {{ strlen($meta_description) }}/160 recommended chars
                            </span>
                        </label>
                        <textarea id="meta_description" 
                                  rows="3" 
                                  wire:model.live="meta_description" 
                                  placeholder="Write a clear, concise summary of this page content to maximize click-through rate on search results..." 
                                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('meta_description') border-rose-400 @enderror"></textarea>
                        @error('meta_description')
                            <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                <i class="ri-error-warning-line"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div class="space-y-1.5">
                        <label for="meta_keywords" class="text-xs font-semibold text-slate-700 flex items-center justify-between">
                            <span>Meta Keywords</span>
                            <span class="text-[10px] text-slate-400 font-normal">Comma separated</span>
                        </label>
                        <input id="meta_keywords" 
                               type="text" 
                               wire:model="meta_keywords" 
                               placeholder="orthopaedic hospital, spine surgeon, knee replacement, trauma care" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
                    </div>

                    <!-- OpenGraph Accordion/Fields -->
                    <div class="border border-slate-200 rounded-xl p-4 bg-slate-50/50 space-y-4">
                        <div class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                            <i class="ri-share-line text-[#114b5f]"></i> Open Graph & Social Sharing Tags (Facebook, WhatsApp, Twitter)
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- OG Title -->
                            <div class="space-y-1.5">
                                <label for="og_title" class="text-xs font-medium text-slate-700">Open Graph Title</label>
                                <input id="og_title" 
                                       type="text" 
                                       wire:model="og_title" 
                                       placeholder="Title for social media shares" 
                                       class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-[#114b5f] bg-white" />
                            </div>

                            <!-- OG Description -->
                            <div class="space-y-1.5">
                                <label for="og_description" class="text-xs font-medium text-slate-700">Open Graph Description</label>
                                <input id="og_description" 
                                       type="text" 
                                       wire:model="og_description" 
                                       placeholder="Summary snippet for social posts" 
                                       class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-[#114b5f] bg-white" />
                            </div>
                        </div>
                    </div>

                    <!-- Active Toggle -->
                    <div class="flex items-center gap-3 pt-2">
                        <label for="is_active" class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="is_active" wire:model="is_active" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                        </label>
                        <span class="text-xs font-semibold text-slate-700">Enable Live SEO Meta on Website</span>
                    </div>

                </div>

                <!-- Modal Footer Actions -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2 shrink-0">
                    <button type="button" 
                            @click="isOpen = false" 
                            class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-[#114b5f] hover:bg-[#0e3f50] text-white rounded-xl text-xs font-semibold shadow-md shadow-[#114b5f]/10 hover:shadow-[#114b5f]/20 active:scale-[0.99] transition-all flex items-center gap-2 cursor-pointer">
                        <span wire:loading.delay class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                        <span wire:loading.remove.delay><i class="ri-save-line"></i> Save Page SEO</span>
                        <span wire:loading.delay>Saving...</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4" 
         x-cloak>
        <!-- Backdrop -->
        <div x-show="deleteModalOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="deleteModalOpen = false">
        </div>

        <!-- Modal Dialog -->
        <div x-show="deleteModalOpen" 
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4"
             class="w-full max-w-md bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 p-6 flex flex-col overflow-hidden">
            
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-rose-600 shrink-0">
                    <i class="ri-error-warning-fill text-xl"></i>
                </div>
                <div class="space-y-1">
                    <h3 class="font-heading font-bold text-slate-800 text-base">Delete Page SEO Entry</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Are you sure you want to delete this page SEO record? The page will revert to standard site defaults.</p>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2">
                <button type="button" 
                        @click="deleteModalOpen = false; deleteId = null" 
                        class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                    Cancel
                </button>
                <button type="button" 
                        wire:click="delete(deleteId)"
                        @click="deleteModalOpen = false"
                        class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-rose-600/10 hover:shadow-rose-600/20 active:scale-[0.99] transition-all cursor-pointer">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>