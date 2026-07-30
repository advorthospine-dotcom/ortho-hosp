<div class="space-y-6" x-data="{ deleteModalOpen: false, deleteId: null }">


    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Blog Posts</h1>
            <p class="text-slate-500 text-sm mt-0.5">Publish articles, updates, and research documents on orthopaedics, spine surgeries, and health tips.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-sm rounded-xl shadow-md shadow-[#114b5f]/15 active:scale-[0.98] transition-all cursor-pointer">
            <i class="ri-add-line text-lg"></i> Create New Post
        </a>
    </div>

    <!-- Table and Filter Card -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <!-- Search bar -->
        <div class="p-5 border-b border-slate-50">
            <div class="max-w-md relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="ri-search-2-line text-slate-400 group-focus-within:text-[#114b5f] transition-colors"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search posts by title or content..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3 px-6">Article</th>
                        <th class="py-3 px-6">Category</th>
                        <th class="py-3 px-6">Author</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6">Date Published</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs">
                    @forelse($blogs as $blog)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Article Title & Thumbnail -->
                            <td class="py-3.5 px-6">
                                <div class="flex items-center gap-3 max-w-md">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-200/80">
                                        <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="font-semibold text-slate-900 hover:text-[#114b5f] transition-colors truncate">
                                            {{ $blog->title }}
                                        </a>
                                        <span class="text-[10px] text-slate-400 font-mono mt-0.5 truncate">{{ $blog->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <!-- Category Badge -->
                            <td class="py-3.5 px-6">
                                <span class="bg-teal-50 text-[#114b5f] font-semibold px-2 py-0.5 rounded text-[10px]">
                                    {{ $blog->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <!-- Author User -->
                            <td class="py-3.5 px-6 text-slate-600 font-medium">
                                {{ $blog->authorUser->name ?? 'System Admin' }}
                            </td>
                            <!-- Status Toggle -->
                            <td class="py-3.5 px-6">
                                @if($blog->is_active)
                                    <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full text-[10px]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-500 font-bold px-2 py-0.5 rounded-full text-[10px]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <!-- Date Published -->
                            <td class="py-3.5 px-6 text-slate-400">
                                {{ $blog->created_at->format('M d, Y H:i') }}
                            </td>
                            <!-- Action Buttons -->
                            <td class="py-3.5 px-6 text-right space-x-1 whitespace-nowrap">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
                                   class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-[#114b5f] transition-all cursor-pointer inline-flex"
                                   title="Edit Post">
                                    <i class="ri-pencil-fill text-base"></i>
                                </a>
                                <button @click="deleteId = {{ $blog->id }}; deleteModalOpen = true" 
                                        class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-rose-600 transition-all cursor-pointer inline-flex"
                                        title="Delete Post">
                                    <i class="ri-delete-bin-fill text-base"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="ri-file-text-line text-4xl text-slate-300"></i>
                                    <span>No blog posts found</span>
                                    <a href="{{ route('admin.blogs.create') }}" class="text-[#114b5f] hover:underline text-xs mt-1 font-semibold">Write your first post</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
            <div class="p-4 border-t border-slate-50 bg-slate-50/50">
                {{ $blogs->links() }}
            </div>
        @endif
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
                    <h3 class="font-heading font-bold text-slate-800 text-base">Delete Blog Post</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Are you sure you want to delete this blog post? This action cannot be undone and the post will be removed permanently.</p>
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