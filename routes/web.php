<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/blog', 'pages::blog')->name('blog.index');
Route::livewire('/blog/{slug}', 'pages::blog-view')->name('blog.show');

// Auth Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'auth::login')->name('login');
});

// Admin Routes (Authenticated Only)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::livewire('/', 'admin::dashboard')->name('admin.dashboard');
    
    // Blog Categories (Modal CRUD)
    Route::livewire('/categories', 'admin::blog.categorylist')->name('admin.categories');
    
    // Blog CRUD (Dedicated pages)
    Route::livewire('/blogs', 'admin::blog.list')->name('admin.blogs.index');
    Route::livewire('/blogs/create', 'admin::blog.add')->name('admin.blogs.create');
    Route::livewire('/blogs/{id}/edit', 'admin::blog.update')->name('admin.blogs.edit');
    
    // Media Library (Upload & List CRUD)
    Route::livewire('/media', 'admin::blog.blog-image')->name('admin.media.index');
});
