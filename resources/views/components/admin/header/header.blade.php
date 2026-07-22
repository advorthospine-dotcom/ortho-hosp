<header class="sticky top-0 z-30 h-16 bg-white border-b border-slate-100 flex items-center justify-between px-4 sm:px-6 lg:px-8 shadow-sm">
    <!-- Left Section: Sidebar Toggle & Search -->
    <div class="flex items-center gap-4">
        <!-- Sidebar Toggle (Mobile only) -->
        <button @click="sidebarOpen = !sidebarOpen" 
                class="md:hidden w-10 h-10 rounded-lg flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none"
                aria-label="Toggle Sidebar">
            <i class="ri-menu-2-line text-2xl"></i>
        </button>

        <!-- Search Bar (Desktop) -->
        <div class="hidden sm:flex items-center gap-2 bg-slate-50 border border-slate-200/80 rounded-xl px-3 py-1.5 w-64 md:w-80 group focus-within:border-sky-500 focus-within:ring-2 focus-within:ring-sky-100 transition-all">
            <i class="ri-search-2-line text-slate-400 group-focus-within:text-sky-600 transition-colors"></i>
            <input type="text" 
                   placeholder="Search patients, doctors, records..." 
                   class="bg-transparent text-sm text-slate-700 w-full placeholder-slate-400 focus:outline-none" />
        </div>
    </div>

    <!-- Right Section: Date, Notifications & Profile -->
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- System Status Badge -->
        <div class="hidden lg:flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold tracking-wider uppercase px-2 py-1 rounded-full border border-emerald-100">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            System Live
        </div>

        <!-- Date Indicator -->
        <div class="hidden md:flex flex-col items-end text-xs">
            <span class="font-medium text-slate-800">{{ date('l, d M Y') }}</span>
            <span class="text-slate-400 text-[10px]">Hospital Server Time</span>
        </div>

        <div class="h-6 w-[1px] bg-slate-100 hidden md:block"></div>

        <!-- Notifications Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" 
                    class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 border border-slate-100 transition-all focus:outline-none relative">
                <i class="ri-notification-3-line text-xl"></i>
                <span class="absolute top-2 right-2.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-80 bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/50 py-2 z-50 origin-top-right focus:outline-none"
                 x-cloak>
                <div class="px-4 py-2 border-b border-slate-50 flex items-center justify-between">
                    <span class="font-semibold text-sm text-slate-800">Notifications</span>
                    <a href="#" class="text-xs text-sky-600 hover:underline">Mark all read</a>
                </div>
                <div class="divide-y divide-slate-50 max-h-64 overflow-y-auto">
                    <a href="#" class="flex gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center text-rose-600 shrink-0">
                            <i class="ri-alarm-warning-line text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-700 font-medium">New emergency case admitted</p>
                            <span class="text-[10px] text-slate-400">2 minutes ago</span>
                        </div>
                    </a>
                    <a href="#" class="flex gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 shrink-0">
                            <i class="ri-calendar-event-line text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-700">Dr. Sarah updated appointment schedule</p>
                            <span class="text-[10px] text-slate-400">1 hour ago</span>
                        </div>
                    </a>
                    <a href="#" class="flex gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-emerald-55 bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                            <i class="ri-checkbox-circle-line text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-700">Lab report #4928 compiled successfully</p>
                            <span class="text-[10px] text-slate-400">3 hours ago</span>
                        </div>
                    </a>
                </div>
                <div class="px-4 py-2 border-t border-slate-50 text-center">
                    <a href="#" class="text-xs font-semibold text-slate-500 hover:text-slate-800">View all notifications</a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" 
                    class="flex items-center gap-2 p-1.5 pr-3 rounded-xl border border-slate-100 hover:bg-slate-50 hover:border-slate-200 transition-all focus:outline-none">
                <div class="w-8 h-8 rounded-lg bg-sky-600 flex items-center justify-center text-white font-bold text-xs uppercase shadow-inner">
                    {{ substr(Auth::user()->name ?? 'A', 0, 2) }}
                </div>
                <span class="hidden sm:inline text-xs font-semibold text-slate-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                <i class="ri-arrow-down-s-line text-slate-400 text-sm"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/50 py-2 z-50 origin-top-right focus:outline-none"
                 x-cloak>
                <div class="px-4 py-2.5 border-b border-slate-50">
                    <p class="text-xs text-slate-400 font-medium">Logged in as</p>
                    <p class="text-sm font-semibold text-slate-800 truncate mt-0.5">{{ Auth::user()->email ?? 'admin@orthohosp.com' }}</p>
                </div>
                
                <div class="py-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="ri-user-settings-line text-slate-400 text-lg"></i>
                        My Profile
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="ri-settings-line text-slate-400 text-lg"></i>
                        System settings
                    </a>
                </div>

                <div class="border-t border-slate-50 pt-1">
                    <button wire:click="logout" 
                            class="w-full flex items-center gap-3 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 transition-colors font-medium text-left focus:outline-none">
                        <i class="ri-logout-box-r-line text-lg"></i>
                        Log out
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>