<div class="space-y-6" 
     x-data="{ addModalOpen: false, editModalOpen: false }"
     @close-add-modal.window="addModalOpen = false"
     @close-edit-modal.window="editModalOpen = false"
     @open-edit-modal.window="editModalOpen = true">

    <!-- Top Action Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <i class="ri-video-upload-line text-[#114b5f] text-xl"></i>
                <h1 class="text-xl font-heading font-extrabold text-slate-900 tracking-tight">Video Content Library</h1>
            </div>
            <p class="text-xs text-slate-500 mt-1">Manage clinical procedure videos, surgical walkthroughs, and patient education media.</p>
        </div>

        <button @click="addModalOpen = true; $wire.resetForm()" 
                type="button"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold text-xs rounded-xl shadow-md shadow-[#114b5f]/20 transition-all cursor-pointer">
            <i class="ri-add-line text-base"></i>
            <span>Add New Video</span>
        </button>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
        <!-- Search Input -->
        <div class="relative w-full sm:w-80">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="ri-search-line text-sm"></i>
            </div>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Search video titles..." 
                   class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-[#114b5f]/20 transition-all" />
        </div>

        <!-- Filter Status Dropdown -->
        <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
            <span class="text-slate-500 font-medium">Status:</span>
            <select wire:model.live="filterStatus" class="px-3 py-2 rounded-xl border border-slate-200 font-semibold text-slate-700 focus:outline-none focus:border-[#114b5f] transition-all bg-slate-50/50">
                <option value="all">All Videos</option>
                <option value="active">Active Only</option>
                <option value="inactive">Hidden Only</option>
            </select>
        </div>
    </div>

    <!-- Videos Grid List -->
    @if($videos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($videos as $video)
                <div class="bg-white border border-slate-200/90 rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
                    
                    <!-- Video Embed Thumbnail / Preview Container -->
                    <div class="relative aspect-video bg-slate-950 overflow-hidden group" x-data="{ playingInline: false }">
                        <template x-if="!playingInline">
                            <div class="relative w-full h-full cursor-pointer" @click="playingInline = true">
                                <img src="{{ $video->thumbnail_url }}" 
                                     alt="{{ $video->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 opacity-90" />
                                
                                <div class="absolute inset-0 bg-slate-950/40 group-hover:bg-slate-950/20 transition-colors flex items-center justify-center">
                                    <div class="w-14 h-14 rounded-full bg-[#114b5f]/90 hover:bg-[#114b5f] text-white flex items-center justify-center shadow-lg transition-transform group-hover:scale-110 border-2 border-teal-400/30">
                                        <i class="ri-play-fill text-3xl ml-1"></i>
                                    </div>
                                </div>

                                <!-- Status Badge Overlay -->
                                <div class="absolute top-3 left-3 z-10" @click.stop>
                                    <button type="button" 
                                            wire:click="toggleStatus({{ $video->id }})" 
                                            class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider backdrop-blur-md cursor-pointer transition-all shadow-sm {{ $video->is_active ? 'bg-emerald-500/90 text-white' : 'bg-slate-700/90 text-slate-200' }}">
                                        {{ $video->is_active ? 'Active' : 'Hidden' }}
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="playingInline">
                            <iframe src="{{ $video->embed_url }}" 
                                    class="w-full h-full border-0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen></iframe>
                        </template>
                    </div>

                    <!-- Video Details -->
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="font-heading font-extrabold text-slate-900 text-sm leading-snug line-clamp-2">
                                {{ $video->title }}
                            </h3>
                            <a href="{{ $video->video_url }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-mono text-slate-400 hover:text-[#114b5f] transition-colors mt-2 truncate max-w-full">
                                <i class="ri-link"></i>
                                <span class="truncate">{{ $video->video_url }}</span>
                            </a>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <button type="button" 
                                    wire:click="edit({{ $video->id }})"
                                    class="inline-flex items-center gap-1 text-slate-700 font-bold hover:text-[#114b5f] transition-colors cursor-pointer">
                                <i class="ri-[#114b5f] ri-edit-box-line text-sm text-[#114b5f]"></i>
                                <span>Edit</span>
                            </button>

                            <button type="button" 
                                    wire:click="delete({{ $video->id }})"
                                    wire:confirm="Are you sure you want to delete this video item?"
                                    class="inline-flex items-center gap-1 text-slate-400 hover:text-rose-600 font-bold transition-colors cursor-pointer">
                                <i class="ri-delete-bin-line text-sm"></i>
                                <span>Delete</span>
                            </button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $videos->links() }}
        </div>
    @else
        <div class="bg-white p-12 rounded-2xl border border-slate-200 text-center space-y-3">
            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl">
                <i class="ri-film-line"></i>
            </div>
            <h3 class="font-bold text-slate-800 text-base">No Videos Found</h3>
            <p class="text-xs text-slate-500 max-w-md mx-auto">No video contents match your current filter criteria. Click "Add New Video" to publish procedure videos.</p>
        </div>
    @endif

    <!-- ADD VIDEO MODAL -->
    <div x-show="addModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-xs flex items-center justify-center p-4"
         x-cloak>
        <div @click.outside="addModalOpen = false" class="bg-white rounded-3xl max-w-lg w-full p-6 space-y-5 border border-slate-200 shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-heading font-extrabold text-slate-900 text-base flex items-center gap-2">
                    <i class="ri-video-add-line text-[#114b5f]"></i> Add New Video Content
                </h3>
                <button @click="addModalOpen = false" type="button" class="text-slate-400 hover:text-slate-600">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <form wire:submit.prevent="createVideo" class="space-y-4 text-xs">
                <!-- Title -->
                <div class="space-y-1">
                    <label for="add_title" class="font-semibold text-slate-700">Video Title <span class="text-rose-500">*</span></label>
                    <input id="add_title" type="text" wire:model="title" placeholder="e.g. Total Knee Replacement Procedure & Recovery" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all" required />
                    @error('title') <span class="text-rose-500 text-[11px] font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Video URL -->
                <div class="space-y-1">
                    <label for="add_url" class="font-semibold text-slate-700">YouTube Video URL <span class="text-rose-500">*</span></label>
                    <input id="add_url" type="url" wire:model="video_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all" required />
                    <p class="text-[11px] text-slate-400">Supports standard YouTube links, shorts, or embed links.</p>
                    @error('video_url') <span class="text-rose-500 text-[11px] font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Active Toggle -->
                <div class="flex items-center gap-2 pt-2">
                    <input id="add_active" type="checkbox" wire:model="is_active" class="w-4 h-4 rounded text-[#114b5f] focus:ring-[#114b5f]" />
                    <label for="add_active" class="font-semibold text-slate-700 select-none">Publish & display immediately on public gallery</label>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button @click="addModalOpen = false" type="button" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold rounded-xl shadow-md">Add Video</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT VIDEO MODAL -->
    <div x-show="editModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-xs flex items-center justify-center p-4"
         x-cloak>
        <div @click.outside="editModalOpen = false" class="bg-white rounded-3xl max-w-lg w-full p-6 space-y-5 border border-slate-200 shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-heading font-extrabold text-slate-900 text-base flex items-center gap-2">
                    <i class="ri-edit-box-line text-[#114b5f]"></i> Edit Video Details
                </h3>
                <button @click="editModalOpen = false" type="button" class="text-slate-400 hover:text-slate-600">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <form wire:submit.prevent="updateVideo" class="space-y-4 text-xs">
                <!-- Title -->
                <div class="space-y-1">
                    <label for="edit_title" class="font-semibold text-slate-700">Video Title <span class="text-rose-500">*</span></label>
                    <input id="edit_title" type="text" wire:model="title" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all" required />
                    @error('title') <span class="text-rose-500 text-[11px] font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Video URL -->
                <div class="space-y-1">
                    <label for="edit_url" class="font-semibold text-slate-700">YouTube Video URL <span class="text-rose-500">*</span></label>
                    <input id="edit_url" type="url" wire:model="video_url" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all" required />
                    @error('video_url') <span class="text-rose-500 text-[11px] font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Active Toggle -->
                <div class="flex items-center gap-2 pt-2">
                    <input id="edit_active" type="checkbox" wire:model="is_active" class="w-4 h-4 rounded text-[#114b5f] focus:ring-[#114b5f]" />
                    <label for="edit_active" class="font-semibold text-slate-700 select-none">Active / Published</label>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button @click="editModalOpen = false" type="button" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold rounded-xl shadow-md">Update Video</button>
                </div>
            </form>
        </div>
    </div>

</div>