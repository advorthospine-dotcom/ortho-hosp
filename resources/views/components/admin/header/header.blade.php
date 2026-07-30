<header class="sticky top-0 z-30 h-16 bg-white border-b border-slate-100 flex items-center justify-between px-4 sm:px-6 lg:px-8 shadow-sm">
    <!-- Left Section: Sidebar Toggle & Page Context -->
    <div class="flex items-center gap-4">
        <!-- Sidebar Toggle (Mobile only) -->
        <button @click="sidebarOpen = !sidebarOpen" 
                class="md:hidden w-10 h-10 rounded-lg flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none"
                aria-label="Toggle Sidebar">
            <i class="ri-menu-2-line text-2xl"></i>
        </button>

        <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-slate-500">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-slate-800 font-heading font-bold text-sm">{{ setting('hospital_name', 'Advance Orthopaedic & Spine Center') }}</span>
        </div>
    </div>

    <!-- Right Section: Date, Notifications & Profile -->
    <div class="flex items-center gap-3 sm:gap-4">
        @php
            $unreadContactCount = \App\Models\Contact::where('is_read', false)->count();
            $recentContacts = \App\Models\Contact::latest()->take(5)->get();
        @endphp

        <!-- System Status Badge -->
        <div class="hidden lg:flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold tracking-wider uppercase px-2.5 py-1 rounded-full border border-emerald-100">
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
                    class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 border border-slate-200/80 transition-all focus:outline-none relative cursor-pointer"
                    title="Inquiries & Notifications">
                <i class="ri-notification-3-line text-xl"></i>
                @if($unreadContactCount > 0)
                    <span class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1.5 rounded-full bg-rose-500 text-white font-extrabold text-[10px] flex items-center justify-center shadow-xs animate-pulse">
                        {{ $unreadContactCount }}
                    </span>
                @endif
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-80 sm:w-96 bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/50 py-2 z-50 origin-top-right focus:outline-none"
                 x-cloak>
                <div class="px-4 py-2.5 border-b border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-sm text-slate-900">Patient Inquiries</span>
                        @if($unreadContactCount > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-500 text-white">
                                {{ $unreadContactCount }} New
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" wire:navigate class="text-xs text-[#114b5f] font-semibold hover:underline">View All</a>
                </div>
                <div class="divide-y divide-slate-50 max-h-72 overflow-y-auto">
                    @forelse($recentContacts as $contact)
                        <a href="{{ route('admin.contacts.index') }}" wire:navigate class="flex gap-3 px-4 py-3 hover:bg-slate-50 transition-colors group {{ !$contact->is_read ? 'bg-teal-50/20' : '' }}">
                            <div class="w-8 h-8 rounded-full {{ !$contact->is_read ? 'bg-rose-50 text-rose-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center shrink-0">
                                <i class="{{ !$contact->is_read ? 'ri-mail-unread-fill' : 'ri-mail-check-line' }} text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-1">
                                    <p class="text-xs text-slate-800 font-bold truncate group-hover:text-[#114b5f] transition-colors">{{ $contact->name }}</p>
                                    <span class="text-[10px] text-slate-400 shrink-0 font-mono">{{ $contact->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $contact->message }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-xs">
                            <i class="ri-inbox-line text-2xl text-slate-300 block mb-1"></i>
                            No contact inquiries yet
                        </div>
                    @endforelse
                </div>
                <div class="px-4 py-2.5 border-t border-slate-50 text-center bg-slate-50/50">
                    <a href="{{ route('admin.contacts.index') }}" wire:navigate class="text-xs font-bold text-[#114b5f] hover:underline">Go to Contact Inquiries →</a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" 
                    class="flex items-center gap-2 p-1.5 pr-3 rounded-xl border border-slate-100 hover:bg-slate-50 hover:border-slate-200 transition-all focus:outline-none cursor-pointer">
                <div class="w-8 h-8 rounded-lg bg-[#114b5f] flex items-center justify-center text-white font-bold text-xs uppercase shadow-inner">
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
                    <a href="{{ route('admin.settings.index') }}" wire:navigate class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="ri-settings-line text-slate-400 text-lg"></i>
                        System Settings
                    </a>
                </div>

                <div class="border-t border-slate-50 pt-1">
                    <button wire:click="logout" 
                            class="w-full flex items-center gap-3 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 transition-colors font-medium text-left focus:outline-none cursor-pointer">
                        <i class="ri-logout-box-r-line text-lg"></i>
                        Log out
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>