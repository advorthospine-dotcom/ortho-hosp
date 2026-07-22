<div>
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 md:hidden" 
         @click="sidebarOpen = false"
         x-cloak>
    </div>

    <!-- Sidebar Container -->
    <aside class="fixed inset-y-0 left-0 w-64 bg-slate-950 text-slate-400 flex flex-col z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0 border-r border-slate-900"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           x-cloak>
        
        <!-- Header / Logo -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-900">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-500/20 group-hover:scale-105 transition-transform">
                    <i class="ri-heart-pulse-fill text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-heading font-bold text-sm tracking-tight text-white leading-none">Advance Ortho</span>
                    <span class="text-[10px] text-sky-500 font-medium tracking-widest uppercase mt-0.5">Spine Center</span>
                </div>
            </a>
            
            <!-- Mobile Close Button -->
            <button @click="sidebarOpen = false" 
                    class="md:hidden w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-900 transition-colors">
                <i class="ri-close-line text-xl"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-7 overflow-y-auto">
            <!-- Main section -->
            <div>
                <span class="px-3 text-[10px] font-bold text-slate-500 tracking-wider uppercase">Overview</span>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600 text-white' : 'hover:text-slate-200 hover:bg-slate-900' }}">
                        <i class="ri-dashboard-2-fill text-lg {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Medical Operations Section -->
            <div>
                <span class="px-3 text-[10px] font-bold text-slate-500 tracking-wider uppercase">Clinical Operations</span>
                <div class="mt-3 space-y-1">
                    <a href="#" 
                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <div class="flex items-center gap-3">
                            <i class="ri-calendar-todo-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                            <span>Appointments</span>
                        </div>
                        <span class="bg-sky-500/10 text-sky-400 text-xs px-2 py-0.5 rounded-full font-bold">12</span>
                    </a>
                    <a href="#" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <i class="ri-user-heart-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                        <span>Patients</span>
                    </a>
                    <a href="#" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <i class="ri-contacts-book-3-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                        <span>Medical Records</span>
                    </a>
                </div>
            </div>

            <!-- Staff & Resources Section -->
            <div>
                <span class="px-3 text-[10px] font-bold text-slate-500 tracking-wider uppercase">Management</span>
                <div class="mt-3 space-y-1">
                    <a href="#" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <i class="ri-shield-user-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                        <span>Doctors & Staff</span>
                    </a>
                    <a href="#" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <i class="ri-hotel-bed-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                        <span>Bed Allotment</span>
                    </a>
                    <a href="#" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <i class="ri-file-chart-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                        <span>Reports & Analytics</span>
                    </a>
                </div>
            </div>

            <!-- Content Management Section -->
            <div>
                <span class="px-3 text-[10px] font-bold text-slate-500 tracking-wider uppercase">Content Management</span>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('admin.categories') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('admin.categories') ? 'bg-sky-600 text-white' : 'hover:text-slate-200 hover:bg-slate-900' }}">
                        <i class="ri-folders-fill text-lg {{ request()->routeIs('admin.categories') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
                        <span>Blog Categories</span>
                    </a>
                    <a href="{{ route('admin.blogs.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('admin.blogs.*') ? 'bg-sky-600 text-white' : 'hover:text-slate-200 hover:bg-slate-900' }}">
                        <i class="ri-newspaper-fill text-lg {{ request()->routeIs('admin.blogs.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
                        <span>Blog Posts</span>
                    </a>
                    <a href="{{ route('admin.media.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('admin.media.index') ? 'bg-sky-600 text-white' : 'hover:text-slate-200 hover:bg-slate-900' }}">
                        <i class="ri-image-2-fill text-lg {{ request()->routeIs('admin.media.index') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
                        <span>Media Library</span>
                    </a>
                </div>
            </div>

            <!-- System Settings -->
            <div>
                <span class="px-3 text-[10px] font-bold text-slate-500 tracking-wider uppercase">Configure</span>
                <div class="mt-3 space-y-1">
                    <a href="#" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:text-slate-200 hover:bg-slate-900 group">
                        <i class="ri-settings-4-fill text-lg text-slate-500 group-hover:text-slate-300"></i>
                        <span>System Settings</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- User Profile Card -->
        <div class="p-4 border-t border-slate-900 bg-slate-950/50">
            <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-900/50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white border border-slate-700 font-bold uppercase shadow-inner">
                    {{ substr(Auth::user()->name ?? 'A', 0, 2) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-semibold text-white truncate">{{ Auth::user()->name ?? 'System Administrator' }}</h4>
                    <p class="text-[10px] text-slate-500 truncate mt-0.5">{{ Auth::user()->email ?? 'admin@orthohosp.com' }}</p>
                </div>
            </div>
        </div>
    </aside>
</div>