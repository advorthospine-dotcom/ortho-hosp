<div class="space-y-6">
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
    <div class="border-b border-slate-100 pb-4">
        <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Media Library</h1>
        <p class="text-slate-500 text-sm mt-0.5">Upload and manage image assets to embed inside clinical blogs and press announcements.</p>
    </div>

    <!-- Main Grid Content: Upload Area Top, Gallery Bottom -->
    <div class="space-y-6">
        
        <!-- Upload Widget Card -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
            <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2">
                <i class="ri-upload-cloud-fill text-sky-600 text-lg"></i> Upload Multiple Images
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <!-- Dropzone Left -->
                <div class="md:col-span-2 relative border-2 border-dashed border-slate-200 rounded-2xl p-6 flex flex-col items-center justify-center hover:border-sky-500 transition-colors text-center group cursor-pointer">
                    <input type="file" 
                           wire:model="images" 
                           id="media-uploads" 
                           accept="image/*" 
                           multiple
                           class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                    
                    <div class="space-y-1 py-2">
                        <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:text-sky-600 transition-colors mx-auto">
                            <i class="ri-image-add-line text-2xl"></i>
                        </div>
                        <p class="text-xs font-semibold text-slate-700">Drag & drop your files here, or <span class="text-sky-600 hover:underline">browse</span></p>
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
                                        <span class="truncate max-w-[150px] font-medium">{{ $image->getClientOriginalName() }}</span>
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
                            <span class="w-3.5 h-3.5 border-2 border-sky-600 border-t-transparent rounded-full animate-spin"></span>
                            Uploading to cache...
                        </div>

                        <button wire:click="upload" 
                                wire:loading.attr="disabled"
                                @if (count($images) === 0) disabled @endif
                                class="w-full bg-sky-600 hover:bg-sky-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed disabled:shadow-none text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                            <span wire:loading wire:target="upload" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            <span wire:loading.remove wire:target="upload"><i class="ri-upload-2-line"></i> Save to Media Library</span>
                            <span wire:loading wire:target="upload">Saving files...</span>
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

        <!-- Media Grid Gallery -->
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
            <h3 class="font-heading font-bold text-slate-800 text-sm border-b border-slate-50 pb-2">Uploaded Images</h3>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($mediaList as $media)
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col shadow-sm group hover:shadow-md transition-shadow"
                         x-data="{ copied: false, fileUrl: '{{ $media->file_url }}' }">
                        
                        <!-- Thumbnail Preview -->
                        <div class="aspect-square bg-slate-100 relative overflow-hidden flex items-center justify-center border-b border-slate-200">
                            <img src="{{ $media->file_url }}" alt="{{ $media->file_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            
                            <!-- Delete button (visible on hover) -->
                            <button onclick="confirm('Delete this image from storage permanently?') || event.stopImmediatePropagation()" 
                                    wire:click="delete({{ $media->id }})" 
                                    class="absolute top-2 right-2 w-7 h-7 bg-white/90 hover:bg-rose-500 hover:text-white rounded-lg flex items-center justify-center text-slate-500 shadow transition-colors cursor-pointer focus:outline-none">
                                <i class="ri-delete-bin-fill text-sm"></i>
                            </button>
                        </div>

                        <!-- Card Detail info -->
                        <div class="p-2.5 flex-1 flex flex-col justify-between gap-2 min-w-0">
                            <div class="text-[10px] text-slate-400 font-medium truncate space-y-0.5">
                                <p class="text-slate-700 font-semibold truncate" title="{{ $media->file_name }}">{{ $media->file_name }}</p>
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
                            <span>No images uploaded yet.</span>
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

    </div>
</div>
