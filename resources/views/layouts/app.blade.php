<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title ?? 'Advance Orthopaedic & Spine Center | Advanced Orthopaedic & Spine Care' }}</title>
    <meta name="description" content="Advance Orthopaedic & Spine Center - Premier hospital for knee replacement, endoscopic spine surgery, sports medicine, and 24/7 trauma emergency care.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Livewire & Vite Styles -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-sky-600 selection:text-white">

    <!-- PUBLIC HEADER COMPONENT -->
    @include('components.public.header.header')

    <!-- MAIN PAGE CONTENT SLOT -->
    <main>
        {{ $slot }}
    </main>

    <!-- PUBLIC FOOTER COMPONENT -->
    @include('components.public.footer.footer')

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
