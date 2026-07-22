<div class="space-y-6" x-data="{ isOpen: false }" 
     @open-category-modal.window="isOpen = true"
     @close-category-modal.window="isOpen = false">
    
    <!-- Toast notifications element inside page -->
    <div x-data="{ toasts: [] }" 
         @toast.window="toasts.push({ id: Date.now(), message: $event.detail[0].message, type: $event.detail[0].type }); setTimeout(() => toasts.shift(), 4000)"
         class="fixed top-5 right-5 z-50 space-y-2 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition.duration.300ms 
                 class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg border text-sm font-semibold pointer-events-auto min-w-[280px]"
                 :class="{
                     'bg-emerald-50 border-emerald-100 text-emerald-800': toast.type === 'success',
                     'bg-rose-50 border-rose-100 text-rose-800': toast.type === 'error',
                     'bg-amber-50 border-amber-100 text-amber-800': toast.type === 'warning'
                 }">
                <i class="text-lg" 
                   :class="{
                       'ri-checkbox-circle-fill text-emerald-500': toast.type === 'success',
                       'ri-error-warning-fill text-rose-500': toast.type === 'error',
                       'ri-alert-fill text-amber-500': toast.type === 'warning'
                   }"></i>
                <span x-text="toast.message" class="flex-1"></span>
            </div>
        </template>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Blog Categories</h1>
            <p class="text-slate-500 text-sm mt-0.5">Manage taxonomy groupings for clinical research, hospital news, and surgeon publications.</p>
        </div>
        <button wire:click="create" 
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.98] transition-all cursor-pointer">
            <i class="ri-folder-add-fill text-lg"></i> Add New Category
        </button>
    </div>

    <!-- List Table Container -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <!-- Search filter -->
        <div class="p-5 border-b border-slate-50">
            <div class="max-w-md relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="ri-search-2-line text-slate-400 group-focus-within:text-sky-600 transition-colors"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search by category name or slug..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Slug</th>
                        <th class="py-3 px-6">Associated Posts</th>
                        <th class="py-3 px-6">Created At</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-3.5 px-6 font-semibold text-slate-900">
                                {{ $category->name }}
                            </td>
                            <td class="py-3.5 px-6 text-slate-500 font-mono text-[11px]">
                                {{ $category->slug }}
                            </td>
                            <td class="py-3.5 px-6">
                                <span class="bg-slate-100 text-slate-600 font-bold px-2 py-0.5 rounded-full">
                                    {{ $category->blogs_count }} posts
                                </span>
                            </td>
                            <td class="py-3.5 px-6 text-slate-400">
                                {{ $category->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="py-3.5 px-6 text-right space-x-1">
                                <button wire:click="edit({{ $category->id }})" 
                                        class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-sky-600 transition-all cursor-pointer inline-flex"
                                        title="Edit Category">
                                    <i class="ri-pencil-fill text-base"></i>
                                </button>
                                <button onclick="confirm('Are you sure you want to delete this category? All related blog posts will be removed.') || event.stopImmediatePropagation()" 
                                        wire:click="delete({{ $category->id }})" 
                                        class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-rose-600 transition-all cursor-pointer inline-flex"
                                        title="Delete Category">
                                    <i class="ri-delete-bin-fill text-base"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="ri-inbox-archive-line text-3xl text-slate-300"></i>
                                    <span>No categories found matching "{{ $search }}"</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="p-4 border-t border-slate-50 bg-slate-50/50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Form overlay -->
    <div x-show="isOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4" 
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
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4"
             class="w-full max-w-md bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 flex flex-col overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-heading font-bold text-slate-800 text-base">
                    {{ $categoryId ? 'Edit Category' : 'Add New Category' }}
                </h3>
                <button @click="isOpen = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/50 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form wire:submit="save">
                <div class="p-6 space-y-4">
                    
                    <!-- Category Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="text-xs font-semibold text-slate-700">Category Name</label>
                        <input id="name" 
                               type="text" 
                               wire:model.live="name" 
                               placeholder="e.g. Spine Surgery, Sports Medicine" 
                               class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('name') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                               required />
                        @error('name')
                            <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                <i class="ri-error-warning-line"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Category Slug -->
                    <div class="space-y-1.5">
                        <label for="slug" class="text-xs font-semibold text-slate-700">Slug URL</label>
                        <input id="slug" 
                               type="text" 
                               wire:model="slug" 
                               placeholder="e.g. spine-surgery" 
                               class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 font-mono text-xs focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('slug') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                               required />
                        @error('slug')
                            <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                <i class="ri-error-warning-line"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

                <!-- Modal Footer Actions -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" 
                            @click="isOpen = false" 
                            class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center gap-1.5 cursor-pointer">
                        <span wire:loading.delay class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                        <span wire:loading.remove.delay>Save Category</span>
                        <span wire:loading.delay>Saving...</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
