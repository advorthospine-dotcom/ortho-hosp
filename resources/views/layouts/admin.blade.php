<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin Dashboard | Advance Orthopaedic & Spine Center' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Livewire & Vite Styles -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- TinyMCE Editor -->
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
        window.tinymce.baseURL = "{{ asset('tinymce') }}";
    </script>
</head>
<body class="h-full font-sans antialiased text-slate-800 bg-[#f8fafc] selection:bg-sky-600 selection:text-white"
      x-data="{ sidebarOpen: false }"
      @keydown.escape.window="sidebarOpen = false">

    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar Component -->
        <livewire:admin.sidebar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 md:pl-64">
            <!-- Header Component -->
            <livewire:admin.header />

            <!-- Main Page Content Slot -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto space-y-6">
                    {{ $slot }}
                </div>
            </main>

            <!-- Admin Footer -->
            <footer class="bg-white border-t border-slate-100 py-4 px-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Advance Orthopaedic & Spine Center. All rights reserved.
            </footer>
        </div>
    </div>

    @include('components.toaster')

    @livewireScripts
</body>
</html>
