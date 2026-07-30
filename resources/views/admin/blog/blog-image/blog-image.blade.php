<div class="space-y-6" x-data="{ uploadModalOpen: false, deleteModalOpen: false, deleteId: null }"
     @close-upload-modal.window="uploadModalOpen = false">


    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Media Library</h1>
            <p class="text-slate-500 text-sm mt-0.5">Upload and manage image assets to embed inside clinical blogs and press announcements.</p>
        </div>
        <button @click="uploadModalOpen = true" 
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-sm rounded-xl shadow-md shadow-[#114b5f]/15 active:scale-[0.98] transition-all cursor-pointer">
            <i class="ri-upload-cloud-2-line text-lg"></i> Upload New Images
        </button>
    </div>

    <!-- Media Grid Gallery -->
    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
        <h3 class="font-heading font-bold text-slate-800 text-sm border-b border-slate-50 pb-2">Uploaded Images</h3>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($mediaList as $media)
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col shadow-sm group hover:shadow-md transition-shadow"
                     x-data="{ copied: false, fileUrl: '{{ $media->file_url }}' }">
                    
                    <!-- Thumbnail Preview -->
                    <div class="aspect-square bg-slate-100 relative overflow-hidden flex items-center justify-center border-b border-slate-200">
                        <img src="{{ $media->file_url }}" alt="{{ $media->image_path }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        
                        <!-- Delete button (visible on hover) -->
                        <button @click="deleteId = {{ $media->id }}; deleteModalOpen = true" 
                                class="absolute top-2 right-2 w-7 h-7 bg-white/90 hover:bg-rose-500 hover:text-white rounded-lg flex items-center justify-center text-slate-500 shadow transition-colors cursor-pointer focus:outline-none">
                            <i class="ri-delete-bin-fill text-sm"></i>
                        </button>
                    </div>

                    <!-- Card Detail info -->
                    <div class="p-2.5 flex-1 flex flex-col justify-between gap-2 min-w-0">
                        <div class="text-[10px] text-slate-400 font-medium truncate space-y-0.5">
                            <p class="text-slate-700 font-semibold truncate" title="{{ basename($media->image_path) }}">{{ basename($media->image_path) }}</p>
                            <p>{{ $media->file_size }}</p>
                        </div>

                        <!-- Interactive Copy Link Button with checkmark transition -->
                        <button type="button" 
                                @click="navigator.clipboard.writeText(fileUrl); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-full inline-flex items-center justify-center gap-1 py-1.5 rounded-lg border text-[10px] font-bold transition-all cursor-pointer focus:outline-none"
                                :class="copied ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-800'">
                            <i :class="copied ? 'ri-checkbox-circle-fill text-emerald-500' : 'ri-link-m'"></i>
                            <span x-text="copied ? 'Copied!' : 'Copy Link'"></span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-400">
                    <div class="flex flex-col items-center justify-center gap-2">
                        <i class="ri-image-2-line text-4xl text-slate-300"></i>
                        <span>No images uploaded yet. Click "Upload New Images" to get started.</span>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Gallery Pagination -->
        @if ($mediaList->hasPages())
            <div class="pt-4 border-t border-slate-50">
                {{ $mediaList->links() }}
            </div>
        @endif
    </div>

    <!-- Upload Modal Container -->
    <div x-show="uploadModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4" 
         x-cloak>
        
        <!-- Backdrop -->
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

        <!-- Dialog Box -->
        <div x-show="uploadModalOpen" 
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4"
             class="w-full max-w-3xl bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 flex flex-col overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="ri-upload-cloud-fill text-[#114b5f] text-lg"></i> Upload Multiple Images
                </h3>
                <button @click="uploadModalOpen = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/50 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    
                    <!-- Dropzone Left -->
                    <div class="md:col-span-2 relative border-2 border-dashed border-slate-200 rounded-2xl p-6 flex flex-col items-center justify-center hover:border-[#114b5f] transition-colors text-center group cursor-pointer">
                        <input type="file" 
                               wire:model="images" 
                               id="media-uploads" 
                               accept="image/*" 
                               multiple
                               class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                        
                        <div class="space-y-1 py-2">
                            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:text-[#114b5f] transition-colors mx-auto">
                                <i class="ri-image-add-line text-2xl"></i>
                            </div>
                            <p class="text-xs font-semibold text-slate-700">Drag & drop your files here, or <span class="text-[#114b5f] hover:underline">browse</span></p>
                            <p class="text-[10px] text-slate-400">Select multiple JPG, PNG, WEBP files up to 4MB each</p>
                        </div>
                    </div>

                    <!-- Selected Files List & Action Button Right -->
                    <div class="space-y-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 h-full flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Selected Queue:</span>
                            
                            @if (count($images) > 0)
                                <div class="max-h-24 overflow-y-auto space-y-1 pr-1">
                                    @foreach ($images as $key => $image)
                                        <div class="flex items-center justify-between bg-white px-2.5 py-1.5 rounded-lg border border-slate-200 text-[10px] text-slate-600">
                                            <span class="truncate max-w-[120px] font-medium">{{ $image->getClientOriginalName() }}</span>
                                            <span class="text-slate-400 shrink-0">{{ round($image->getSize() / 1024, 1) }} KB</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-slate-400 italic">No files selected</p>
                            @endif
                        </div>

                        <!-- Upload Button & Loading -->
                        <div class="space-y-2">
                            <!-- Loading spinner -->
                            <div wire:loading wire:target="images" class="w-full text-center flex items-center justify-center gap-1.5 text-xs text-slate-500 font-semibold bg-white p-2 rounded-xl border border-slate-100">
                                <span class="w-3.5 h-3.5 border-2 border-[#114b5f] border-t-transparent rounded-full animate-spin"></span>
                                Uploading to cache...
                            </div>

                            <button wire:click="uploadImages" 
                                    wire:loading.attr="disabled"
                                    @if (count($images) === 0) disabled @endif
                                    class="w-full bg-[#114b5f] hover:bg-[#0e3b4b] disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed disabled:shadow-none text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-md shadow-[#114b5f]/15 transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                                <span wire:loading wire:target="uploadImages" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                <span wire:loading.remove wire:target="uploadImages"><i class="ri-upload-2-line"></i> Save to Media Library</span>
                                <span wire:loading wire:target="uploadImages">Saving files...</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Validation Errors -->
                @error('images.*')
                    <div class="text-xs font-semibold text-rose-500 flex items-center gap-1.5 mt-2 bg-rose-50 border border-rose-100 p-2.5 rounded-xl">
                        <i class="ri-error-warning-line text-base"></i>
                        <span>One or more files did not meet constraints (Verify file size limit & file format).</span>
                    </div>
                @enderror
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end">
                <button type="button" 
                        @click="uploadModalOpen = false" 
                        class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                    Close
                </button>
            </div>

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
                    <h3 class="font-heading font-bold text-slate-800 text-base">Delete Media Image</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Are you sure you want to delete this image permanently from storage? This action cannot be undone.</p>
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