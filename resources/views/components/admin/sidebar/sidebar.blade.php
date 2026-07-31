<div>
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-md z-40 md:hidden" 
         @click="sidebarOpen = false"
         x-cloak>
    </div>

    <!-- Sidebar Container -->
    <aside class="fixed inset-y-0 left-0 w-[270px] md:w-64 bg-slate-950 text-slate-400 flex flex-col z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0 border-r border-slate-800/70 shadow-2xl md:shadow-none"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           x-cloak>
        
        <!-- Header / Logo -->
        <div class="h-16 flex items-center justify-between px-5 border-b border-slate-900/80 bg-slate-950/80">
            <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="flex items-center group">
                <img src="{{ asset('logo.webp') }}" 
                     alt="{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}" 
                     class="h-9 w-auto object-contain transition-transform group-hover:scale-105" />
            </a>
            
            <!-- Mobile Close Button -->
            <button @click="sidebarOpen = false" 
                    type="button"
                    class="md:hidden w-8 h-8 rounded-full bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800 flex items-center justify-center transition-colors">
                <i class="ri-close-line text-lg"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-5 space-y-6 overflow-y-auto custom-scrollbar text-xs font-medium">
            
            <!-- Overview Section -->
            <div class="space-y-1">
                <span class="px-3 text-[10px] font-extrabold text-slate-500 tracking-widest uppercase">Overview</span>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-dashboard-2-fill text-base {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Content Management Section -->
            <div class="space-y-1">
                <span class="px-3 text-[10px] font-extrabold text-slate-500 tracking-widest uppercase">Content & SEO</span>
                <div class="mt-2 space-y-1">
                    
                    <!-- Pages & SEO -->
                    <a href="{{ route('admin.pages.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.pages.*') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-pages-fill text-base {{ request()->routeIs('admin.pages.*') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Pages & SEO</span>
                    </a>

                    <!-- Contact Inquiries -->
                    <a href="{{ route('admin.contacts.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.contacts.*') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <div class="flex items-center gap-3">
                            <i class="ri-mail-unread-fill text-base {{ request()->routeIs('admin.contacts.*') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                            <span>Contact Inquiries</span>
                        </div>
                        @php
                            $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#3b774b] text-white shadow-xs">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Blog Categories -->
                    <a href="{{ route('admin.categories') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.categories') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-folders-fill text-base {{ request()->routeIs('admin.categories') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Blog Categories</span>
                    </a>

                    <!-- Blog Posts -->
                    <a href="{{ route('admin.blogs.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.blogs.*') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-newspaper-fill text-base {{ request()->routeIs('admin.blogs.*') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Blog Posts</span>
                    </a>

                    <!-- Media Library -->
                    <a href="{{ route('admin.media.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.media.index') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-image-2-fill text-base {{ request()->routeIs('admin.media.index') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Media Library</span>
                    </a>

                    <!-- Gallery -->
                    <a href="{{ route('admin.gallery.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.gallery.index') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-gallery-fill text-base {{ request()->routeIs('admin.gallery.index') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Photo Gallery</span>
                    </a>

                    <!-- Video List -->
                    <a href="{{ route('admin.videos.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.videos.*') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-video-fill text-base {{ request()->routeIs('admin.videos.*') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Video Library</span>
                    </a>

                    <!-- Clinical Services -->
                    <a href="{{ route('admin.services.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.services.*') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-stethoscope-fill text-base {{ request()->routeIs('admin.services.*') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Clinical Services</span>
                    </a>

                </div>
            </div>

            <!-- Configuration Section -->
            <div class="space-y-1 pt-2">
                <span class="px-3 text-[10px] font-extrabold text-slate-500 tracking-widest uppercase">System</span>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.settings.index') }}" 
                       wire:navigate 
                       @click="sidebarOpen = false"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group {{ request()->routeIs('admin.settings.*') ? 'bg-[#114b5f] text-white font-bold shadow-md shadow-[#114b5f]/20' : 'text-slate-300 hover:text-white hover:bg-slate-900/80' }}">
                        <i class="ri-settings-4-fill text-base {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-400' }}"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>

        </nav>

        <!-- Minimal Profile Card -->
        <div class="p-3 border-t border-slate-900 bg-slate-950 shrink-0">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-900/60 border border-slate-800/60">
                <div class="w-8 h-8 rounded-lg bg-[#114b5f] text-white flex items-center justify-center font-bold text-xs shadow-sm uppercase shrink-0">
                    {{ substr(Auth::user()->name ?? 'A', 0, 2) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</h4>
                    <p class="text-[10px] text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@orthohosp.com' }}</p>
                </div>
            </div>
        </div>

    </aside>
</div>