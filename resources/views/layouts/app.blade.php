<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">

    @php
        $pageSeo = null;
        try {
            $currentRoute = request()->route() ? request()->route()->getName() : 'home';
            $slugMap = [
                'home' => 'home',
                'about' => 'about',
                'services' => 'services',
                'services.view' => 'services',
                'gallery' => 'gallery',
                'blog' => 'blog',
                'blog.view' => 'blog',
                'contact' => 'contact',
            ];
            $pageSlug = $slugMap[$currentRoute] ?? \Illuminate\Support\Str::slug(request()->path() ?: 'home');
            if (class_exists(\App\Models\PageContent::class)) {
                $pageSeo = \App\Models\PageContent::getBySlug($pageSlug);
            }
        } catch (\Throwable $e) {
            $pageSeo = null;
        }

        $defaultTitle = $title ?? ($pageSeo?->meta_title ?: 'Advance Orthopaedic & Spine Center | Super-Specialty Hospital');
        $defaultDesc = $pageSeo?->meta_description ?: 'Advance Orthopaedic & Spine Center - Premier hospital for knee replacement, endoscopic spine surgery, joint care, and 24/7 trauma emergency care.';
        $defaultKeywords = $pageSeo?->meta_keywords ?: 'orthopaedic hospital, spine surgeon, knee replacement, joint care, sports medicine';
        $defaultOgTitle = $pageSeo?->og_title ?: $defaultTitle;
        $defaultOgDesc = $pageSeo?->og_description ?: $defaultDesc;

        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'MedicalClinic',
            'name' => 'Advance Orthopaedic & Spine Center',
            'url' => url('/'),
            'description' => strip_tags($defaultDesc),
            'medicalSpecialty' => [
                'Orthopedic Surgery',
                'Endoscopic Spine Surgery',
                'Joint Replacement',
                'Sports Injury Care',
            ],
        ];
    @endphp

    <!-- Primary Meta & Title Tags -->
    <title>@yield('title', $defaultTitle)</title>
    <meta name="description" content="@yield('meta_description', $defaultDesc)">
    <meta name="keywords" content="@yield('meta_keywords', $defaultKeywords)">
    
    <!-- Dynamic Canonical URL Function -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Sharing Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $defaultOgTitle)">
    <meta property="og:description" content="@yield('og_description', $defaultOgDesc)">
    <meta property="og:site_name" content="Advance Orthopaedic & Spine Center">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('og_title', $defaultOgTitle)">
    <meta name="twitter:description" content="@yield('og_description', $defaultOgDesc)">

    <!-- Custom Page Meta & Head Section Yields -->
    @yield('meta')
    @yield('seo')
    @yield('head')

    <!-- JSON-LD MedicalOrganization Structured Data Schema -->
    <script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

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
<body class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-[#114b5f] selection:text-white">

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
