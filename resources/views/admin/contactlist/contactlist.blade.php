<div class="space-y-6" x-data="{ isOpen: false, deleteModalOpen: false, deleteId: null }" 
     @open-contact-modal.window="isOpen = true"
     @close-contact-modal.window="isOpen = false">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Contact & Appointment Inquiries</h1>
                @if($unreadCount > 0)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-rose-500 text-white shadow-sm shadow-rose-500/20 animate-pulse">
                        {{ $unreadCount }} Unread
                    </span>
                @endif
            </div>
            <p class="text-slate-500 text-sm mt-0.5">Manage patient consultation requests, emergency hotline messages, and OPD inquiries.</p>
        </div>
    </div>

    <!-- Filter & Table Container -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col">
        
        <!-- Search and Filter Bar -->
        <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Search Filter Input -->
            <div class="max-w-md relative group w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <i class="ri-search-2-line text-slate-400 group-focus-within:text-[#114b5f] transition-colors"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search by name, phone, email, or message..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
            </div>

            <!-- Status Filter Segmented Toggle -->
            <div class="inline-flex p-1 bg-slate-100/80 rounded-xl border border-slate-200/60 self-start md:self-auto">
                <button wire:click="$set('statusFilter', 'all')" 
                        class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer {{ $statusFilter === 'all' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-500 hover:text-slate-800' }}">
                    All
                </button>
                <button wire:click="$set('statusFilter', 'unread')" 
                        class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'unread' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-500 hover:text-slate-800' }}">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                    Unread
                </button>
                <button wire:click="$set('statusFilter', 'read')" 
                        class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer flex items-center gap-1.5 {{ $statusFilter === 'read' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-500 hover:text-slate-800' }}">
                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                    Read
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Patient Name</th>
                        <th class="py-3.5 px-6">Phone & Email</th>
                        <th class="py-3.5 px-6">Department</th>
                        <th class="py-3.5 px-6">Message Excerpt</th>
                        <th class="py-3.5 px-6">Received</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs">
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-slate-50/50 transition-colors {{ !$contact->is_read ? 'bg-teal-50/30 font-medium' : '' }}">
                            <!-- Status Indicator -->
                            <td class="py-4 px-6">
                                @if(!$contact->is_read)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-500 text-white shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span> Unread
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-500">
                                        <i class="ri-check-line"></i> Read
                                    </span>
                                @endif
                            </td>

                            <!-- Patient Name -->
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                    {{ $contact->name }}
                                </div>
                            </td>

                            <!-- Contact Info -->
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800 flex items-center gap-1 font-mono text-xs">
                                    <i class="ri-phone-line text-slate-400"></i>
                                    <a href="tel:{{ $contact->phone }}" class="hover:text-[#114b5f] hover:underline">{{ $contact->phone }}</a>
                                </div>
                                @if($contact->email)
                                    <div class="text-[11px] text-slate-500 truncate mt-0.5 flex items-center gap-1">
                                        <i class="ri-mail-line text-slate-400"></i>
                                        <a href="mailto:{{ $contact->email }}" class="hover:text-[#114b5f] hover:underline">{{ $contact->email }}</a>
                                    </div>
                                @endif
                            </td>

                            <!-- Department / OPD -->
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-[11px] border border-slate-200/60 inline-block">
                                    {{ $contact->department ?: 'General Inquiry' }}
                                </span>
                                @if($contact->preferred_date)
                                    <div class="text-[10px] text-slate-400 mt-1 font-mono">
                                        OPD: {{ $contact->preferred_date }}
                                    </div>
                                @endif
                            </td>

                            <!-- Message Excerpt -->
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-slate-600 line-clamp-2 leading-relaxed" title="{{ $contact->message }}">
                                    {{ $contact->message }}
                                </p>
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-6 text-slate-400 text-[11px] whitespace-nowrap">
                                <div>{{ $contact->created_at->format('M d, Y') }}</div>
                                <div class="text-[10px] font-mono text-slate-400">{{ $contact->created_at->format('H:i A') }}</div>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right space-x-1 whitespace-nowrap">
                                <button wire:click="viewDetails({{ $contact->id }})" 
                                        class="p-2 rounded-lg bg-teal-50 text-[#114b5f] hover:bg-[#114b5f] hover:text-white transition-all cursor-pointer inline-flex items-center gap-1 font-semibold text-xs border border-teal-200/60 shadow-xs"
                                        title="View Full Details">
                                    <i class="ri-eye-fill text-sm"></i> View
                                </button>
                                <button wire:click="toggleRead({{ $contact->id }})" 
                                        class="p-2 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-slate-800 transition-all cursor-pointer inline-flex items-center"
                                        title="{{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                    <i class="{{ $contact->is_read ? 'ri-mail-unread-line text-amber-600' : 'ri-mail-check-line text-emerald-600' }} text-base"></i>
                                </button>
                                <button @click="deleteId = {{ $contact->id }}; deleteModalOpen = true" 
                                        class="p-2 rounded-lg hover:bg-rose-50 text-slate-400 hover:text-rose-600 transition-all cursor-pointer inline-flex items-center"
                                        title="Delete Inquiry">
                                    <i class="ri-delete-bin-line text-base"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="ri-inbox-line text-4xl text-slate-300"></i>
                                    <span class="font-medium text-slate-600">No contact inquiries found matching criteria</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($contacts->hasPages())
            <div class="p-4 border-t border-slate-50 bg-slate-50/50">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

    <!-- Contact Detail View Modal -->
    <div x-show="isOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" 
         x-cloak>
        
        <!-- Backdrop -->
        <div x-show="isOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
             @click="isOpen = false">
        </div>

        <!-- Dialog Container -->
        <div x-show="isOpen" 
             x-transition:enter="transition-all ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4 opacity-0"
             x-transition:enter-end="scale-100 translate-y-0 opacity-100"
             x-transition:leave="transition-all ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0 opacity-100"
             x-transition:leave-end="scale-95 translate-y-4 opacity-0"
             class="w-full max-w-2xl bg-white border border-slate-100 rounded-2xl shadow-2xl relative z-10 flex flex-col my-8 overflow-hidden">
            
            @if($activeContact)
                <!-- Modal Header -->
                <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#114b5f]/20 border border-teal-500/30 flex items-center justify-center text-teal-400 font-bold text-lg">
                            <i class="ri-user-heart-line"></i>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-white text-base">
                                {{ $activeContact['name'] }}
                            </h3>
                            <p class="text-xs text-slate-400">Inquiry Details & Patient Information</p>
                        </div>
                    </div>
                    <button @click="isOpen = false" 
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6 overflow-y-auto max-h-[75vh]">
                    
                    <!-- Patient Info Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-xl border border-slate-200/80 text-xs">
                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Phone Number</span>
                            <div class="font-bold text-slate-900 flex items-center gap-1.5 text-sm">
                                <i class="ri-phone-fill text-emerald-600"></i>
                                <a href="tel:{{ $activeContact['phone'] }}" class="hover:underline text-emerald-700">{{ $activeContact['phone'] }}</a>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Email Address</span>
                            <div class="font-bold text-slate-900 flex items-center gap-1.5 text-sm">
                                <i class="ri-mail-fill text-[#114b5f]"></i>
                                <a href="mailto:{{ $activeContact['email'] }}" class="hover:underline text-[#114b5f]">{{ $activeContact['email'] ?: 'N/A' }}</a>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Requested Department</span>
                            <div class="font-semibold text-slate-800">
                                {{ $activeContact['department'] ?: 'General Inquiry' }}
                            </div>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Preferred OPD Date</span>
                            <div class="font-semibold text-slate-800">
                                {{ $activeContact['preferred_date'] ?: 'Not Specified' }}
                            </div>
                        </div>
                    </div>

                    <!-- Message Body -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-slate-500 tracking-wider flex items-center justify-between">
                            <span>Message / Symptoms Description</span>
                            <span class="text-[10px] text-slate-400 font-mono">Submitted: {{ \Carbon\Carbon::parse($activeContact['created_at'])->format('M d, Y H:i') }}</span>
                        </label>
                        <div class="p-4 bg-white border border-slate-200 rounded-xl text-slate-800 text-sm leading-relaxed whitespace-pre-line shadow-xs">
                            {{ $activeContact['message'] }}
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 shrink-0">
                    <div class="flex items-center gap-2">
                        <a href="tel:{{ $activeContact['phone'] }}" 
                           class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-sm transition-all flex items-center gap-1.5">
                            <i class="ri-phone-line"></i> Call Patient
                        </a>
                        @if($activeContact['email'])
                            <a href="mailto:{{ $activeContact['email'] }}" 
                               class="px-4 py-2 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-xs rounded-xl shadow-sm transition-all flex items-center gap-1.5">
                                <i class="ri-mail-send-line"></i> Send Email
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <button wire:click="toggleRead({{ $activeContact['id'] }})" 
                                class="px-3.5 py-2 border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 rounded-xl text-xs font-semibold transition-all cursor-pointer flex items-center gap-1">
                            <i class="{{ $activeContact['is_read'] ? 'ri-mail-unread-line' : 'ri-mail-check-line' }}"></i>
                            {{ $activeContact['is_read'] ? 'Mark Unread' : 'Mark Read' }}
                        </button>
                        <button @click="isOpen = false" 
                                class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 rounded-xl text-xs font-semibold transition-all cursor-pointer">
                            Close
                        </button>
                    </div>
                </div>
            @endif

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

        <!-- Dialog -->
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
                    <h3 class="font-heading font-bold text-slate-800 text-base">Delete Inquiry</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Are you sure you want to delete this contact inquiry? This action cannot be undone.</p>
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