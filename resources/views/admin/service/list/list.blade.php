<div class="space-y-6" 
     x-data="{ 
         serviceModalOpen: false, 
         deleteModalOpen: false, 
         deleteId: null 
     }"
     @open-service-modal.window="serviceModalOpen = true"
     @close-service-modal.window="serviceModalOpen = false">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 pb-5">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Clinical Services Management</h1>
                <span class="bg-teal-50 text-[#114b5f] text-xs font-semibold px-2.5 py-0.5 rounded-full border border-teal-200/60">
                    {{ $services->total() }} Total
                </span>
            </div>
            <p class="text-slate-500 text-sm mt-1">Add, update, and organize medical treatments, surgical care, and rehabilitation procedures.</p>
        </div>
        
        <a href="{{ route('admin.services.create') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-sm rounded-xl shadow-md shadow-[#114b5f]/15 active:scale-[0.98] transition-all cursor-pointer">
            <i class="ri-add-line text-lg"></i>
            <span>Add New Service</span>
        </a>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Search input -->
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="ri-search-2-line text-base"></i>
            </div>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Search service title, slug, description..." 
                   class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
        </div>

        <!-- Category Dropdown Filter -->
        <div class="flex items-center gap-3 shrink-0">
            <label for="filter-category" class="text-xs font-semibold text-slate-500">Department:</label>
            <select id="filter-category" 
                    wire:model.live="categoryFilter" 
                    class="px-3 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 bg-slate-50 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 cursor-pointer">
                <option value="all">All Departments</option>
                <option value="trauma">Trauma & Emergency</option>
                <option value="spine">Spine & Back Care</option>
                <option value="joints">Joint Replacements</option>
                <option value="sports">Sports Medicine</option>
                <option value="specialized">Specialized & Rehab</option>
            </select>
        </div>
    </div>

    <!-- Services Table Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-6">Service & Specialty</th>
                        <th class="py-3.5 px-6">Department</th>
                        <th class="py-3.5 px-6">Badge / Tag</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($services as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Service Thumbnail & Title -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center text-slate-500">
                                        @if($item->image_url)
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover" />
                                        @else
                                            <i class="ri-stethoscope-line text-xl"></i>
                                        @endif
                                    </div>
                                    <div class="min-w-0 space-y-0.5">
                                        <h3 class="font-semibold text-slate-900 text-sm truncate max-w-xs" title="{{ $item->title }}">
                                            {{ $item->title }}
                                        </h3>
                                        <p class="text-[11px] text-slate-400 font-mono truncate max-w-xs">{{ $item->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-6">
                                <span class="bg-teal-50 text-[#114b5f] font-semibold px-2.5 py-1 rounded-lg text-xs border border-teal-100 inline-block">
                                    {{ $item->category_label ?: ucfirst($item->category) }}
                                </span>
                            </td>

                            <!-- Badge -->
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-600 font-medium px-2 py-0.5 rounded text-[11px]">
                                    {{ $item->badge ?: 'Standard Care' }}
                                </span>
                            </td>

                            <!-- Active Status Switch -->
                            <td class="py-4 px-6">
                                <button type="button" 
                                        wire:click="toggleStatus({{ $item->id }})"
                                        class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $item->is_active ? 'bg-[#114b5f]' : 'bg-slate-300' }}"
                                        role="switch">
                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $item->is_active ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-4 px-6 text-right space-x-1">
                                <a href="{{ route('admin.services.edit', $item->id) }}" 
                                   class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-[#114b5f] transition-all cursor-pointer inline-flex"
                                   title="Edit Service">
                                    <i class="ri-pencil-line text-base"></i>
                                </a>
                                <button @click="deleteId = {{ $item->id }}; deleteModalOpen = true" 
                                        class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-rose-600 transition-all cursor-pointer inline-flex"
                                        title="Delete Service">
                                    <i class="ri-delete-bin-line text-base"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="ri-inbox-archive-line text-3xl text-slate-300"></i>
                                    <span class="text-xs font-semibold text-slate-600">No services found</span>
                                    <p class="text-[11px] text-slate-400">Try adjusting search or category filter</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($services->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $services->links() }}
            </div>
        @endif
    </div>

    <!-- DELETE CONFIRMATION MODAL -->
    <div x-show="deleteModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4" 
         x-cloak
         @keydown.escape.window="deleteModalOpen = false">
        
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

        <!-- Dialog -->
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
                    <h3 class="font-heading font-bold text-slate-800 text-base">Delete Service</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Are you sure you want to delete this clinical service treatment permanently? This action cannot be undone.</p>
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