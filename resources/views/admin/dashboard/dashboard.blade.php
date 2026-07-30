<div class="space-y-6">

    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 pb-5">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <span>Executive Overview Dashboard</span>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase bg-teal-50 text-[#114b5f] border border-teal-200/80">Live Data</span>
            </h1>
            <p class="text-slate-500 text-sm mt-0.5">Real-time clinical inquiries, patient appointment requests, and content management overview.</p>
        </div>

        <div class="flex items-center gap-2.5">
            <button wire:click="loadDashboardMetrics" 
                    type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-slate-200 bg-white hover:bg-slate-50 rounded-xl text-xs font-semibold text-slate-700 hover:text-slate-900 transition-all shadow-xs cursor-pointer">
                <i class="ri-refresh-line text-sm text-[#114b5f]"></i>
                <span>Refresh Metrics</span>
            </button>

            <a href="{{ route('admin.settings.index') }}" 
               wire:navigate
               class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-[#114b5f] hover:bg-[#0e3b4b] rounded-xl text-xs font-bold text-white transition-all shadow-md shadow-[#114b5f]/15 cursor-pointer">
                <i class="ri-settings-4-line text-sm"></i>
                <span>System Settings</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Card 1: Patient Inquiries / Appointments -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#114b5f] border border-teal-100 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-calendar-check-fill text-2xl"></i>
                </div>
                @if($unreadInquiries > 0)
                    <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200/80">
                        <i class="ri-notification-3-fill"></i> {{ $unreadInquiries }} Pending
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200/80">
                        <i class="ri-checkbox-circle-fill"></i> All Reviewed
                    </span>
                @endif
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Patient Inquiries</h3>
                <p class="text-3xl font-heading font-extrabold text-slate-900 mt-1">{{ $totalAppointments }}</p>
                <span class="text-[11px] text-slate-500 mt-1 block">Total appointment requests received</span>
            </div>
        </div>

        <!-- Card 2: Clinical Services -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#3b774b] border border-emerald-100 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-stethoscope-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-[#3b774b] bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200/80">
                    Active Catalog
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Medical Specialties</h3>
                <p class="text-3xl font-heading font-extrabold text-slate-900 mt-1">{{ $totalServices }}</p>
                <span class="text-[11px] text-slate-500 mt-1 block">Surgical & OPD service procedures</span>
            </div>
        </div>

        <!-- Card 3: Medical Blog Articles -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 border border-slate-200 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-article-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-200">
                    Published
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Blog Articles</h3>
                <p class="text-3xl font-heading font-extrabold text-slate-900 mt-1">{{ $totalBlogs }}</p>
                <span class="text-[11px] text-slate-500 mt-1 block">Health insights & patient guides</span>
            </div>
        </div>

        <!-- Card 4: Photo Gallery Media -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#114b5f] border border-teal-100 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-gallery-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-teal-800 bg-teal-50 px-2.5 py-1 rounded-full border border-teal-200">
                    Gallery Assets
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Photo Gallery</h3>
                <p class="text-3xl font-heading font-extrabold text-slate-900 mt-1">{{ $totalGallery }}</p>
                <span class="text-[11px] text-slate-500 mt-1 block">Infrastructure & campus photos</span>
            </div>
        </div>

    </div>

    <!-- Main Content Panels (2 Cols Left + 1 Col Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Panel: Recent Patient Inquiries (Takes 2/3 cols) -->
        <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl shadow-xs flex flex-col overflow-hidden">
            
            <!-- Panel Header -->
            <div class="p-5 border-b border-slate-100 flex items-center justify-between flex-wrap gap-2 bg-slate-50/50">
                <div>
                    <h2 class="text-base font-heading font-bold text-slate-900 flex items-center gap-2">
                        <i class="ri-inbox-archive-line text-[#114b5f]"></i>
                        <span>Recent Appointment Requests</span>
                    </h2>
                    <span class="text-xs text-slate-400 block mt-0.5">Latest consultation forms submitted by site visitors</span>
                </div>
                <a href="{{ route('admin.contacts.index') }}" wire:navigate class="text-xs font-bold text-[#114b5f] hover:underline flex items-center gap-1">
                    <span>View All Inquiries</span>
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <!-- Inquiries Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="py-3 px-5">Patient Details</th>
                            <th class="py-3 px-5">Department</th>
                            <th class="py-3 px-5">Preferred Date</th>
                            <th class="py-3 px-5">Status</th>
                            <th class="py-3 px-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse ($recentInquiries as $inquiry)
                            <tr class="hover:bg-slate-50/70 transition-colors group">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center font-bold text-[#114b5f] shrink-0">
                                            {{ strtoupper(substr($inquiry->name ?? 'P', 0, 2)) }}
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <span class="font-bold text-slate-900 truncate">{{ $inquiry->name }}</span>
                                            <span class="text-[11px] text-slate-500 truncate">{{ $inquiry->phone ?? $inquiry->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 font-medium text-slate-700">
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg font-semibold text-[11px]">
                                        {{ $inquiry->department ?? 'General OPD' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-5 text-slate-600 font-medium whitespace-nowrap">
                                    {{ $inquiry->preferred_date ? \Carbon\Carbon::parse($inquiry->preferred_date)->format('M d, Y') : 'Flexible' }}
                                </td>
                                <td class="py-3.5 px-5 whitespace-nowrap">
                                    @if ($inquiry->is_read)
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 border border-emerald-200/80 font-bold px-2.5 py-0.5 rounded-full text-[10px]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Reviewed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-200/80 font-bold px-2.5 py-0.5 rounded-full text-[10px]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Review
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-5 text-right whitespace-nowrap space-x-1">
                                    @if (!$inquiry->is_read)
                                        <button wire:click="markAsRead({{ $inquiry->id }})" 
                                                type="button"
                                                class="px-2.5 py-1 bg-teal-50 hover:bg-[#114b5f] text-[#114b5f] hover:text-white rounded-lg font-semibold text-[11px] transition-colors cursor-pointer"
                                                title="Mark as reviewed">
                                            Mark Read
                                        </button>
                                    @endif
                                    <button wire:click="deleteInquiry({{ $inquiry->id }})"
                                            wire:confirm="Are you sure you want to delete this inquiry record?"
                                            type="button"
                                            class="p-1.5 rounded-lg hover:bg-rose-50 text-slate-400 hover:text-rose-600 transition-colors cursor-pointer"
                                            title="Delete Record">
                                        <i class="ri-delete-bin-line text-sm"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-5 text-center text-slate-400">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                        <i class="ri-inbox-line text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-600">No appointment inquiries received yet.</p>
                                    <p class="text-[11px] text-slate-400 mt-1">Submissions from the Contact page form will automatically appear here.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Panel Footer -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between text-xs text-slate-500">
                <span>Showing latest {{ count($recentInquiries) }} inquiry records</span>
                <a href="{{ route('admin.contacts.index') }}" wire:navigate class="font-bold text-[#114b5f] hover:underline flex items-center gap-1">
                    Manage All Inquiries <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>
        </div>

        <!-- Right Panel: Hospital Live Overview & Quick Links (Takes 1 col) -->
        <div class="space-y-6">
            
            <!-- Card 1: Active System Info Summary -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h2 class="text-sm font-heading font-bold text-slate-900 flex items-center gap-2">
                        <i class="ri-[#114b5f] ri-hospital-line text-[#114b5f]"></i>
                        <span>Hospital Configuration</span>
                    </h2>
                    <a href="{{ route('admin.settings.index') }}" wire:navigate class="text-xs font-semibold text-[#114b5f] hover:underline">Edit</a>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Center Name</span>
                        <p class="font-bold text-slate-800 mt-0.5 truncate">{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}</p>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">24/7 Helpline</span>
                        <p class="font-bold text-emerald-700 mt-0.5 flex items-center gap-1.5">
                            <i class="ri-phone-fill text-xs"></i>
                            <span>{{ setting('phone_number', '+1 (555) 234-5678') }}</span>
                        </p>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">WhatsApp Desk</span>
                        <p class="font-bold text-emerald-600 mt-0.5 flex items-center gap-1.5">
                            <i class="ri-whatsapp-line text-xs"></i>
                            <span>{{ setting('whatsapp_number', '+1 (555) 987-6543') }}</span>
                        </p>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Hospital Address</span>
                        <p class="text-slate-600 mt-0.5 leading-snug">{{ setting('address', '450 Health Avenue, Medical District, NY 10001') }}</p>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">OPD Hours</span>
                        <p class="text-slate-600 mt-0.5">{{ setting('opd_timings', 'Mon - Sat: 8:00 AM - 8:00 PM') }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Quick Management Shortcuts -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-3">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Quick Management</h2>
                
                <div class="space-y-2">
                    <a href="{{ route('admin.services.index') }}" wire:navigate class="w-full flex items-center justify-between px-3.5 py-2.5 bg-slate-50 hover:bg-teal-50/80 rounded-xl text-xs font-bold text-slate-700 hover:text-[#114b5f] border border-slate-200/80 transition-colors">
                        <div class="flex items-center gap-2.5">
                            <i class="ri-stethoscope-line text-base text-[#114b5f]"></i>
                            <span>Clinical Services ({{ $totalServices }})</span>
                        </div>
                        <i class="ri-arrow-right-s-line text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.blogs.index') }}" wire:navigate class="w-full flex items-center justify-between px-3.5 py-2.5 bg-slate-50 hover:bg-teal-50/80 rounded-xl text-xs font-bold text-slate-700 hover:text-[#114b5f] border border-slate-200/80 transition-colors">
                        <div class="flex items-center gap-2.5">
                            <i class="ri-article-line text-base text-[#114b5f]"></i>
                            <span>Blog Articles ({{ $totalBlogs }})</span>
                        </div>
                        <i class="ri-arrow-right-s-line text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.gallery.index') }}" wire:navigate class="w-full flex items-center justify-between px-3.5 py-2.5 bg-slate-50 hover:bg-teal-50/80 rounded-xl text-xs font-bold text-slate-700 hover:text-[#114b5f] border border-slate-200/80 transition-colors">
                        <div class="flex items-center gap-2.5">
                            <i class="ri-gallery-line text-base text-[#114b5f]"></i>
                            <span>Photo Gallery ({{ $totalGallery }})</span>
                        </div>
                        <i class="ri-arrow-right-s-line text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" wire:navigate class="w-full flex items-center justify-between px-3.5 py-2.5 bg-slate-50 hover:bg-teal-50/80 rounded-xl text-xs font-bold text-slate-700 hover:text-[#114b5f] border border-slate-200/80 transition-colors">
                        <div class="flex items-center gap-2.5">
                            <i class="ri-settings-4-line text-base text-[#114b5f]"></i>
                            <span>System Settings</span>
                        </div>
                        <i class="ri-arrow-right-s-line text-slate-400"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>