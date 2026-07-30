<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/about', 'pages::about')->name('about');
Route::livewire('/gallery', 'pages::gallery')->name('gallery');
Route::livewire('/blogs', 'pages::blog')->name('blog');
Route::livewire('/blogs/{slug}', 'pages::blog-view')->name('blog.view');
Route::livewire('/services', 'pages::service')->name('services');
Route::livewire('/services/{slug}', 'pages::service-view')->name('services.view');
Route::livewire('/contact', 'pages::contact')->name('contact');

// Auth Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'auth::login')->name('login');
});

// Admin Routes (Authenticated Only)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::livewire('/', 'admin::dashboard')->name('admin.dashboard');

    // Page SEO & Management (Modal CRUD)
    Route::livewire('/pages', 'admin::.page-mangement')->name('admin.pages.index');

    // Contact Inquiries & OPD Appointments
    Route::livewire('/contacts', 'admin::contactlist')->name('admin.contacts.index');

    // Blog Categories (Modal CRUD)
    Route::livewire('/categories', 'admin::blog.categorylist')->name('admin.categories');

    // Blog CRUD (Dedicated pages)
    Route::livewire('/blogs', 'admin::blog.list')->name('admin.blogs.index');
    Route::livewire('/blogs/create', 'admin::blog.add')->name('admin.blogs.create');
    Route::livewire('/blogs/{id}/edit', 'admin::blog.update')->name('admin.blogs.edit');

    // Media Library (Upload & List CRUD)
    Route::livewire('/media', 'admin::blog.blog-image')->name('admin.media.index');

    // Gallery (Upload & Modal CRUD)
    Route::livewire('/gallery', 'admin::gallery')->name('admin.gallery.index');

    // Clinical Services CRUD
    Route::livewire('/services', 'admin::service.list')->name('admin.services.index');

    // Settings (Hospital info, Socials, Hero Slider)
    Route::livewire('/settings', 'admin::setting')->name('admin.settings.index');
});

// Dynamic XML Sitemap Generator for Search Engines
Route::get('/sitemap.xml', function () {
    $baseUrl = url('/');
    $now = now()->toAtomString();

    $staticUrls = [
        ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'],
        ['loc' => $baseUrl . '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => $baseUrl . '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => $baseUrl . '/gallery', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => $baseUrl . '/blogs', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => $baseUrl . '/contact', 'priority' => '0.9', 'changefreq' => 'monthly'],
    ];

    $services = class_exists(\App\Models\Service::class) ? \App\Models\Service::where('is_active', true)->get() : [];
    $blogs = class_exists(\App\Models\Blog::class) ? \App\Models\Blog::where('is_active', true)->get() : [];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($staticUrls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
        $xml .= '<lastmod>' . $now . '</lastmod>';
        $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
        $xml .= '<priority>' . $url['priority'] . '</priority>';
        $xml .= '</url>';
    }

    foreach ($services as $service) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($baseUrl . '/services/' . $service->slug) . '</loc>';
        $xml .= '<lastmod>' . ($service->updated_at ? $service->updated_at->toAtomString() : $now) . '</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';
    }

    foreach ($blogs as $blog) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($baseUrl . '/blogs/' . $blog->slug) . '</loc>';
        $xml .= '<lastmod>' . ($blog->updated_at ? $blog->updated_at->toAtomString() : $now) . '</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.7</priority>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml',
    ]);
})->name('sitemap');
