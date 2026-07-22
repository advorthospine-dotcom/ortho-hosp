<div class="space-y-6">
    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Overview Dashboard</h1>
            <p class="text-slate-500 text-sm mt-0.5">Real-time clinical metrics, bed allocations, and appointments.</p>
        </div>
        <div class="flex items-center gap-2">
            <button class="inline-flex items-center justify-center gap-2 px-4 py-2 border border-slate-200 bg-white hover:bg-slate-50 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all shadow-sm cursor-pointer">
                <i class="ri-refresh-line"></i> Refresh Data
            </button>
            <button class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 rounded-xl text-xs font-semibold text-white transition-all shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 cursor-pointer">
                <i class="ri-file-chart-line"></i> Export PDF Report
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Card 1: Appointments -->
        <div class="bg-white border border-slate-100 rounded-2xl p-5 hover:shadow-lg hover:shadow-slate-200/30 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-calendar-check-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <i class="ri-arrow-right-up-line"></i> +12.5%
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Appointments</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">248</p>
                <span class="text-[10px] text-slate-400 mt-1 block">Scheduled for today</span>
            </div>
        </div>

        <!-- Card 2: Patients -->
        <div class="bg-white border border-slate-100 rounded-2xl p-5 hover:shadow-lg hover:shadow-slate-200/30 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-user-heart-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <i class="ri-arrow-right-up-line"></i> +4.1%
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Admitted Patients</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">84</p>
                <span class="text-[10px] text-slate-400 mt-1 block">12 discharges pending</span>
            </div>
        </div>

        <!-- Card 3: Doctors -->
        <div class="bg-white border border-slate-100 rounded-2xl p-5 hover:shadow-lg hover:shadow-slate-200/30 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-nurse-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full">
                    On Duty
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Active Staff</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">19</p>
                <span class="text-[10px] text-slate-400 mt-1 block">9 orthopaedic specialists</span>
            </div>
        </div>

        <!-- Card 4: ICU / Beds -->
        <div class="bg-white border border-slate-100 rounded-2xl p-5 hover:shadow-lg hover:shadow-slate-200/30 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="ri-hotel-bed-fill text-2xl"></i>
                </div>
                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full">
                    Critical Load
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Bed Capacity</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">88%</p>
                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden">
                    <div class="bg-rose-500 h-1.5 rounded-full" style="width: 88%"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Content Panels -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Panel: Recent Appointments (Takes 2/3 cols) -->
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col overflow-hidden">
            <div class="p-5 border-b border-slate-50 flex items-center justify-between flex-wrap gap-2">
                <div>
                    <h2 class="text-base font-bold text-slate-900 leading-none">Today's Appointment Schedule</h2>
                    <span class="text-[10px] text-slate-400 font-medium block mt-1">Realtime updating via clinical reception desk</span>
                </div>
                <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200/80 rounded-lg p-0.5">
                    <button class="px-2.5 py-1 text-[11px] font-semibold bg-white rounded-md shadow-sm text-slate-800 focus:outline-none">All</button>
                    <button class="px-2.5 py-1 text-[11px] font-semibold text-slate-500 hover:text-slate-800 rounded-md focus:outline-none">Spine</button>
                    <button class="px-2.5 py-1 text-[11px] font-semibold text-slate-500 hover:text-slate-800 rounded-md focus:outline-none">Joints</button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="py-3 px-5">Patient Name</th>
                            <th class="py-3 px-5">Specialist</th>
                            <th class="py-3 px-5">Department</th>
                            <th class="py-3 px-5">Time</th>
                            <th class="py-3 px-5">Status</th>
                            <th class="py-3 px-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-xs">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 shadow-inner">
                                        JD
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-900">John Doe</span>
                                        <span class="text-[10px] text-slate-400">ID: #PT-8390</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 font-medium text-slate-700">Dr. Sarah Jenkins</td>
                            <td class="py-3.5 px-5">
                                <span class="bg-sky-50 text-sky-700 font-semibold px-2 py-0.5 rounded text-[10px]">Spine Surgery</span>
                            </td>
                            <td class="py-3.5 px-5 text-slate-500 font-medium">10:30 AM</td>
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 font-bold px-2 py-0.5 rounded-full text-[10px]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> In Progress
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <button class="p-1 rounded hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-colors">
                                    <i class="ri-more-2-fill text-lg"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 shadow-inner">
                                        AS
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-900">Alice Smith</span>
                                        <span class="text-[10px] text-slate-400">ID: #PT-4923</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 font-medium text-slate-700">Dr. Robert Chen</td>
                            <td class="py-3.5 px-5">
                                <span class="bg-indigo-50 text-indigo-700 font-semibold px-2 py-0.5 rounded text-[10px]">Robotic Knee</span>
                            </td>
                            <td class="py-3.5 px-5 text-slate-500 font-medium">11:15 AM</td>
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1 bg-sky-50 text-sky-700 font-bold px-2 py-0.5 rounded-full text-[10px]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> Scheduled
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <button class="p-1 rounded hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-colors">
                                    <i class="ri-more-2-fill text-lg"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 shadow-inner">
                                        MB
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-900">Marcus Brown</span>
                                        <span class="text-[10px] text-slate-400">ID: #PT-1102</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 font-medium text-slate-700">Dr. Sarah Jenkins</td>
                            <td class="py-3.5 px-5">
                                <span class="bg-sky-50 text-sky-700 font-semibold px-2 py-0.5 rounded text-[10px]">Spine Surgery</span>
                            </td>
                            <td class="py-3.5 px-5 text-slate-500 font-medium">09:00 AM</td>
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full text-[10px]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Completed
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <button class="p-1 rounded hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-colors">
                                    <i class="ri-more-2-fill text-lg"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 shadow-inner">
                                        EH
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-900">Emily Hunter</span>
                                        <span class="text-[10px] text-slate-400">ID: #PT-7734</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 font-medium text-slate-700">Dr. Liam O'Connor</td>
                            <td class="py-3.5 px-5">
                                <span class="bg-rose-50 text-rose-700 font-semibold px-2 py-0.5 rounded text-[10px]">Trauma Emergency</span>
                            </td>
                            <td class="py-3.5 px-5 text-slate-500 font-medium">08:15 AM</td>
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-700 font-bold px-2 py-0.5 rounded-full text-[10px]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Critical
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <button class="p-1 rounded hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-colors">
                                    <i class="ri-more-2-fill text-lg"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination -->
            <div class="p-4 border-t border-slate-50 bg-slate-50/50 flex items-center justify-between text-xs text-slate-500">
                <span>Showing 4 of 24 appointments</span>
                <div class="flex items-center gap-1">
                    <button class="px-2.5 py-1.5 border border-slate-200 bg-white hover:bg-slate-50 rounded-lg font-semibold text-slate-600 disabled:opacity-50" disabled>Previous</button>
                    <button class="px-2.5 py-1.5 border border-slate-200 bg-white hover:bg-slate-50 rounded-lg font-semibold text-slate-600">Next</button>
                </div>
            </div>
        </div>

        <!-- Right Panel: Clinical Stats / Load (Takes 1 col) -->
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 space-y-6 flex flex-col justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900 leading-none">Clinical Unit Load</h2>
                <span class="text-[10px] text-slate-400 font-medium block mt-1">Bed occupancy rates per speciality unit</span>
            </div>

            <div class="space-y-4 my-auto">
                
                <!-- Unit 1 -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-semibold text-slate-700">Robotic Joint Replacement</span>
                        <span class="text-slate-500 font-bold">12/15 Beds</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-sky-500 h-2 rounded-full" style="width: 80%"></div>
                    </div>
                </div>

                <!-- Unit 2 -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-semibold text-slate-700">Endoscopic Spine Surgery</span>
                        <span class="text-slate-500 font-bold">18/20 Beds</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-sky-600 h-2 rounded-full" style="width: 90%"></div>
                    </div>
                </div>

                <!-- Unit 3 -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-semibold text-slate-700">Sports Medicine & Rehab</span>
                        <span class="text-slate-500 font-bold">4/10 Beds</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-indigo-500 h-2 rounded-full" style="width: 40%"></div>
                    </div>
                </div>

                <!-- Unit 4 -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-semibold text-slate-700">Trauma ICU (Level 1)</span>
                        <span class="text-slate-500 font-bold">5/6 Beds</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-rose-500 h-2 rounded-full" style="width: 83%"></div>
                    </div>
                </div>

            </div>

            <div class="pt-4 border-t border-slate-50 text-center">
                <a href="#" class="inline-flex items-center gap-1 text-xs font-semibold text-sky-600 hover:text-sky-700">
                    Manage Department Beds <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>

    </div>
</div>