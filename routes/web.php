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
    Route::livewire('/pages', 'admin::page-mangement.page-mangement')->name('admin.pages.index');

    // Contact Inquiries & OPD Appointments
    Route::livewire('/contacts', 'admin::contactlist.contactlist')->name('admin.contacts.index');

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
