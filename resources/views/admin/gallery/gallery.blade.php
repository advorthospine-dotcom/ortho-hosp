<div class="space-y-6" 
     x-data="{ 
         uploadModalOpen: false, 
         editModalOpen: false, 
         previewModalOpen: false, 
         deleteModalOpen: false, 
         deleteId: null,
         previewImage: '',
         previewTitle: '',
         previewSize: '',
         previewDate: '' 
     }"
     @close-upload-modal.window="uploadModalOpen = false"
     @open-edit-modal.window="editModalOpen = true"
     @close-edit-modal.window="editModalOpen = false">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 pb-5">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Hospital Gallery</h1>
                <span class="bg-sky-50 text-sky-700 text-xs font-semibold px-2.5 py-0.5 rounded-full border border-sky-200/60">
                    {{ $galleries->total() }} Images
                </span>
            </div>
            <p class="text-slate-500 text-sm mt-1">Upload and manage photo galleries for hospital facilities, surgical suites, and clinical events.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button @click="uploadModalOpen = true; $wire.resetUploadForm()" 
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.98] transition-all cursor-pointer">
                <i class="ri-upload-cloud-2-line text-lg"></i>
                <span>Upload New Images</span>
            </button>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Search bar -->
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="ri-search-2-line text-base"></i>
            </div>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Search gallery by title..." 
                   class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
        </div>

        <!-- Filter tabs -->
        <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl shrink-0 self-start md:self-auto">
            <button wire:click="$set('filterStatus', 'all')" 
                    class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer {{ $filterStatus === 'all' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                All Items
            </button>
            <button wire:click="$set('filterStatus', 'active')" 
                    class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer {{ $filterStatus === 'active' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 mr-1.5"></span> Published
            </button>
            <button wire:click="$set('filterStatus', 'inactive')" 
                    class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all cursor-pointer {{ $filterStatus === 'inactive' ? 'bg-white text-amber-700 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                <span class="inline-block w-2 h-2 rounded-full bg-amber-500 mr-1.5"></span> Hidden
            </button>
        </div>
    </div>

    <!-- Media Grid Gallery -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($galleries as $item)
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col shadow-sm group hover:shadow-md transition-all duration-200">
                    
                    <!-- Image Box with hover overlay -->
                    <div class="aspect-4/3 bg-slate-200 relative overflow-hidden flex items-center justify-center border-b border-slate-200">
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        
                        <!-- Status Badge Overlay -->
                        <div class="absolute top-3 left-3 z-10">
                            @if($item->is_active)
                                <span class="bg-emerald-500/90 text-white backdrop-blur-md text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm">
                                    Active
                                </span>
                            @else
                                <span class="bg-amber-500/90 text-white backdrop-blur-md text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm">
                                    Hidden
                                </span>
                            @endif
                        </div>

                        <!-- Hover Action Buttons -->
                        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 p-2">
                            <!-- Preview / Full View -->
                            <button type="button"
                                    @click="previewImage = '{{ $item->image_url }}'; previewTitle = '{{ addslashes($item->title) }}'; previewSize = '{{ $item->file_size }}'; previewDate = '{{ $item->created_at->format('M d, Y') }}'; previewModalOpen = true"
                                    class="w-9 h-9 bg-white/90 hover:bg-white text-slate-700 rounded-xl flex items-center justify-center shadow transition-all hover:scale-110 cursor-pointer"
                                    title="View Image">
                                <i class="ri-eye-line text-base"></i>
                            </button>

                            <!-- Edit Details -->
                            <button type="button"
                                    wire:click="edit({{ $item->id }})"
                                    class="w-9 h-9 bg-white/90 hover:bg-sky-600 hover:text-white text-slate-700 rounded-xl flex items-center justify-center shadow transition-all hover:scale-110 cursor-pointer"
                                    title="Edit Gallery Info">
                                <i class="ri-pencil-line text-base"></i>
                            </button>

                            <!-- Delete -->
                            <button type="button"
                                    @click="deleteId = {{ $item->id }}; deleteModalOpen = true"
                                    class="w-9 h-9 bg-white/90 hover:bg-rose-600 hover:text-white text-slate-700 rounded-xl flex items-center justify-center shadow transition-all hover:scale-110 cursor-pointer"
                                    title="Delete Image">
                                <i class="ri-delete-bin-line text-base"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Card Body info -->
                    <div class="p-3.5 flex-1 flex flex-col justify-between gap-3">
                        <div>
                            <h3 class="text-xs font-semibold text-slate-800 line-clamp-1" title="{{ $item->title }}">
                                {{ $item->title ?: 'Untitled Image' }}
                            </h3>
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1">
                                <span>{{ $item->created_at->format('M d, Y') }}</span>
                                <span>{{ $item->file_size }}</span>
                            </div>
                        </div>

                        <!-- Quick Toggle Status Button -->
                        <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between">
                            <span class="text-[11px] font-medium text-slate-500">Status</span>
                            <button type="button" 
                                    wire:click="toggleStatus({{ $item->id }})"
                                    class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $item->is_active ? 'bg-sky-600' : 'bg-slate-300' }}"
                                    role="switch" 
                                    aria-checked="{{ $item->is_active ? 'true' : 'false' }}">
                                <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $item->is_active ? 'translate-x-4' : 'translate-x-0' }}"></span>
                            </button>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-400">
                    <div class="flex flex-col items-center justify-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                            <i class="ri-gallery-line text-3xl"></i>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-semibold text-slate-700">No gallery images found</p>
                            <p class="text-xs text-slate-400">
                                @if($search)
                                    No results match your search term "{{ $search }}"
                                @else
                                    Get started by uploading photo assets to your gallery.
                                @endif
                            </p>
                        </div>
                        @if(!$search)
                            <button @click="uploadModalOpen = true; $wire.resetUploadForm()" 
                                    class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all cursor-pointer">
                                <i class="ri-upload-cloud-line text-base"></i> Upload Images Now
                            </button>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($galleries->hasPages())
            <div class="pt-4 border-t border-slate-100">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>

    <!-- UPLOAD MODAL -->
    <div x-show="uploadModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4" 
         x-cloak
         @keydown.escape.window="uploadModalOpen = false">
        
        <!-- Modal Backdrop -->
        <div x-show="uploadModalOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="uploadModalOpen = false">
        </div>

        <!-- Modal Box -->
        <div x-show="uploadModalOpen" 
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4"
             class="w-full max-w-2xl bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 flex flex-col overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center">
                        <i class="ri-upload-cloud-fill text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-slate-800 text-sm">Upload Gallery Images</h3>
                        <p class="text-[11px] text-slate-400">Add single or multiple high-resolution photos to the gallery</p>
                    </div>
                </div>
                <button @click="uploadModalOpen = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/50 transition-colors cursor-pointer">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form wire:submit.prevent="uploadImages">
                <div class="p-6 space-y-5">
                    
                    <!-- File Drag & Drop Box -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Image Files <span class="text-rose-500">*</span></label>
                        <div class="relative border-2 border-dashed border-slate-200 hover:border-sky-500 rounded-2xl p-6 flex flex-col items-center justify-center transition-colors text-center group cursor-pointer bg-slate-50/50 hover:bg-sky-50/20">
                            <input type="file" 
                                   wire:model="images" 
                                   id="gallery-file-input" 
                                   accept="image/*" 
                                   multiple
                                   class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                            
                            <div class="space-y-2 py-1 pointer-events-none">
                                <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-400 group-hover:text-sky-600 group-hover:border-sky-200 transition-colors mx-auto">
                                    <i class="ri-image-add-line text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-700">Click to choose files or drag & drop</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Supports PNG, JPG, JPEG, WEBP up to 10MB per file</p>
                                </div>
                            </div>
                        </div>
                        @error('images.*')
                            <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                <i class="ri-error-warning-line"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Selected Files Queue Display -->
                    @if (count($images) > 0)
                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/80 space-y-2">
                            <div class="flex items-center justify-between text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">
                                <span>Selected Queue ({{ count($images) }})</span>
                                <button type="button" wire:click="$set('images', [])" class="text-rose-600 hover:underline cursor-pointer">Clear Queue</button>
                            </div>
                            <div class="max-h-32 overflow-y-auto space-y-1.5 pr-1">
                                @foreach ($images as $key => $img)
                                    <div class="flex items-center justify-between bg-white px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                        <div class="flex items-center gap-2 truncate">
                                            <i class="ri-image-fill text-sky-600"></i>
                                            <span class="truncate font-medium text-slate-700">{{ $img->getClientOriginalName() }}</span>
                                        </div>
                                        <span class="text-[11px] text-slate-400 shrink-0 font-mono">{{ round($img->getSize() / 1024, 1) }} KB</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Optional Title Input -->
                    <div class="space-y-1.5">
                        <label for="upload-title" class="text-xs font-semibold text-slate-700">
                            Gallery Title <span class="text-slate-400 font-normal">(Optional)</span>
                        </label>
                        <input id="upload-title" 
                               type="text" 
                               wire:model="title" 
                               placeholder="e.g., Main Surgical Operating Room, Executive Ward" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                        <p class="text-[11px] text-slate-400">If left empty, the original file name will be formatted as the title.</p>
                    </div>

                    <!-- Visibility Toggle -->
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <div>
                            <span class="text-xs font-semibold text-slate-800 block">Publish Immediately</span>
                            <span class="text-[11px] text-slate-400">Visible in public website gallery</span>
                        </div>
                        <button type="button" 
                                wire:click="$toggle('is_active')"
                                class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $is_active ? 'bg-sky-600' : 'bg-slate-300' }}"
                                role="switch">
                            <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $is_active ? 'translate-x-4' : 'translate-x-0' }}"></span>
                        </button>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" 
                            @click="uploadModalOpen = false" 
                            class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" 
                            wire:loading.attr="disabled"
                            @if (count($images) === 0) disabled @endif
                            class="px-4 py-2 bg-sky-600 hover:bg-sky-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed text-white rounded-xl text-xs font-semibold shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center gap-1.5 cursor-pointer">
                        <span wire:loading wire:target="uploadImages" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                        <span wire:loading.remove wire:target="uploadImages"><i class="ri-upload-2-line"></i> Save & Upload</span>
                        <span wire:loading wire:target="uploadImages">Uploading...</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- EDIT DETAILS MODAL -->
    <div x-show="editModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4" 
         x-cloak
         @keydown.escape.window="editModalOpen = false">
        
        <!-- Backdrop -->
        <div x-show="editModalOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="editModalOpen = false">
        </div>

        <!-- Dialog -->
        <div x-show="editModalOpen" 
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4"
             class="w-full max-w-md bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 flex flex-col overflow-hidden">
            
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-heading font-bold text-slate-800 text-sm">Edit Gallery Item</h3>
                <button @click="editModalOpen = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/50 transition-colors cursor-pointer">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <form wire:submit.prevent="updateGallery">
                <div class="p-6 space-y-4">
                    <div class="space-y-1.5">
                        <label for="edit-title" class="text-xs font-semibold text-slate-700">Gallery Title</label>
                        <input id="edit-title" 
                               type="text" 
                               wire:model="title" 
                               placeholder="Enter photo title" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                    </div>

                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <div>
                            <span class="text-xs font-semibold text-slate-800 block">Publication Status</span>
                            <span class="text-[11px] text-slate-400">Show or hide on public website</span>
                        </div>
                        <button type="button" 
                                wire:click="$toggle('is_active')"
                                class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $is_active ? 'bg-sky-600' : 'bg-slate-300' }}"
                                role="switch">
                            <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $is_active ? 'translate-x-4' : 'translate-x-0' }}"></span>
                        </button>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" 
                            @click="editModalOpen = false" 
                            class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center gap-1.5 cursor-pointer">
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PREVIEW LIGHTBOX MODAL -->
    <div x-show="previewModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" 
         x-cloak
         @keydown.escape.window="previewModalOpen = false">
        
        <!-- Backdrop -->
        <div x-show="previewModalOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-950/80 backdrop-blur-md" 
             @click="previewModalOpen = false">
        </div>

        <!-- Lightbox Container -->
        <div x-show="previewModalOpen" 
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 opacity-0"
             x-transition:enter-end="scale-100 opacity-100"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 opacity-100"
             x-transition:leave-end="scale-95 opacity-0"
             class="max-w-4xl w-full bg-slate-900 rounded-3xl shadow-2xl overflow-hidden relative z-10 flex flex-col max-h-[90vh]">
            
            <!-- Lightbox Header -->
            <div class="px-6 py-4 bg-slate-950/80 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-white truncate max-w-md" x-text="previewTitle"></h3>
                    <p class="text-[11px] text-slate-400 flex items-center gap-3 mt-0.5">
                        <span x-text="'Uploaded: ' + previewDate"></span>
                        <span x-text="'Size: ' + previewSize"></span>
                    </p>
                </div>
                <button @click="previewModalOpen = false" 
                        class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Lightbox Image View -->
            <div class="flex-1 bg-slate-950 flex items-center justify-center p-4 overflow-hidden">
                <img :src="previewImage" :alt="previewTitle" class="max-h-[70vh] w-auto max-w-full object-contain rounded-xl shadow-lg" />
            </div>
        </div>
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
                    <h3 class="font-heading font-bold text-slate-800 text-base">Delete Gallery Image</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Are you sure you want to delete this photo permanently from the gallery and server storage? This action cannot be undone.</p>
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