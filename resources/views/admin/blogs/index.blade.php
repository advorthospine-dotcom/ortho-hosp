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
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Blog Posts</h1>
            <p class="text-slate-500 text-sm mt-0.5">Publish articles, updates, and research documents on orthopaedics, spine surgeries, and health tips.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.98] transition-all cursor-pointer">
            <i class="ri-add-line text-lg"></i> Create New Post
        </a>
    </div>

    <!-- Table and Filter Card -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <!-- Search bar -->
        <div class="p-5 border-b border-slate-50">
            <div class="max-w-md relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="ri-search-2-line text-slate-400 group-focus-within:text-sky-600 transition-colors"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search posts by title or content..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
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
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="font-semibold text-slate-900 hover:text-sky-600 transition-colors truncate">
                                            {{ $blog->title }}
                                        </a>
                                        <span class="text-[10px] text-slate-400 font-mono mt-0.5 truncate">{{ $blog->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <!-- Category Badge -->
                            <td class="py-3.5 px-6">
                                <span class="bg-sky-50 text-sky-700 font-semibold px-2 py-0.5 rounded text-[10px]">
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
                                   class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-sky-600 transition-all cursor-pointer inline-flex"
                                   title="Edit Post">
                                    <i class="ri-pencil-fill text-base"></i>
                                </a>
                                <button onclick="confirm('Are you sure you want to delete this blog post?') || event.stopImmediatePropagation()" 
                                        wire:click="delete({{ $blog->id }})" 
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
                                    <a href="{{ route('admin.blogs.create') }}" class="text-sky-600 hover:underline text-xs mt-1 font-semibold">Write your first post</a>
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
</div>
