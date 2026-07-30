<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>419 Session Expired | Advanced Orthopaedic & Spine Center</title>
    
    <!-- Favicon Icons -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col justify-between font-sans antialiased text-slate-800 bg-slate-50 selection:bg-[#114b5f] selection:text-white">

    <!-- Simple Top Header Bar with Brand Logo -->
    <header class="bg-white border-b border-slate-200/80 py-4 px-4 sm:px-8 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center group">
                <img src="{{ asset('logo.webp') }}" 
                     alt="{{ setting('hospital_name', 'Advanced Orthopaedic & Spine Center') }}" 
                     class="h-11 sm:h-13 max-h-14 w-auto object-contain transition-transform group-hover:scale-[1.02]" />
            </a>
            <a href="tel:{{ setting('phone_number', '+919931913551') }}" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-emerald-50 text-[#3b774b] border border-emerald-200 text-xs font-bold shadow-xs">
                <i class="ri-phone-fill text-emerald-600"></i>
                <span>24/7 Helpline: {{ setting('phone_number', '+91 99319 13551') }}</span>
            </a>
        </div>
    </header>

    <!-- Main Content Card -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 my-8">
        <div class="max-w-lg w-full bg-white rounded-3xl border border-slate-200/80 shadow-xl p-8 sm:p-10 text-center space-y-6">
            
            <!-- Graphic / Icon Badge -->
            <div class="relative inline-block">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-teal-50 border-2 border-teal-200 flex items-center justify-center mx-auto shadow-md">
                    <span class="text-4xl sm:text-5xl font-heading font-extrabold text-[#114b5f]">419</span>
                </div>
                <div class="absolute -bottom-2 -right-2 w-9 h-9 rounded-2xl bg-[#114b5f] text-white flex items-center justify-center text-lg shadow-md border-2 border-white">
                    <i class="ri-time-line"></i>
                </div>
            </div>

            <!-- Header & Text -->
            <div class="space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-[#114b5f] bg-teal-50 px-3 py-1 rounded-full border border-teal-200 inline-block">
                    Session Expired
                </span>
                <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 tracking-tight">
                    Page Session Expired
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Your session timed out due to inactivity. Please refresh the page to continue.
                </p>
            </div>

            <!-- Action Buttons Row -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                <button onclick="window.location.reload()" class="w-full sm:w-auto px-5 py-2.5 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold text-xs rounded-xl shadow-md transition-all inline-flex items-center justify-center gap-2 cursor-pointer">
                    <i class="ri-refresh-line text-sm"></i>
                    <span>Refresh Page</span>
                </button>
                <a href="/" class="w-full sm:w-auto px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl border border-slate-200 transition-all inline-flex items-center justify-center gap-2">
                    <i class="ri-home-5-fill text-sm text-[#114b5f]"></i>
                    <span>Back to Home</span>
                </a>
            </div>

        </div>
    </main>

    <!-- Footer Credit -->
    <footer class="py-4 text-center text-xs text-slate-400 border-t border-slate-200/80">
        &copy; {{ date('Y') }} {{ setting('hospital_name', 'Advanced Orthopaedic & Spine Center') }}. All rights reserved.
    </footer>

</body>
</html>
