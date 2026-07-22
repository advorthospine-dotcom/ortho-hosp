<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::livewire('/', 'pages::home')->name('home');

// Auth Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'auth::login')->name('login');
});

// Admin Routes (Authenticated Only)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::livewire('/', 'admin::dashboard')->name('admin.dashboard');
    
    // Blog Categories (Modal CRUD)
    Route::livewire('/categories', 'admin::blog-categories.index')->name('admin.categories');
    
    // Blog CRUD (Dedicated pages)
    Route::livewire('/blogs', 'admin::blogs.index')->name('admin.blogs.index');
    Route::livewire('/blogs/create', 'admin::blogs.create')->name('admin.blogs.create');
    Route::livewire('/blogs/{id}/edit', 'admin::blogs.edit')->name('admin.blogs.edit');
    
    // Media Library (Upload & List CRUD)
    Route::livewire('/media', 'admin::media.index')->name('admin.media.index');
});
