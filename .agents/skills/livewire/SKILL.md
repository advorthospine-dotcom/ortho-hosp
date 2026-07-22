---
name: livewire
description: "Livewire 4 architecture, directory structure, layout rendering from web.php, header/footer inclusions, co-located Blade+PHP components, Route::livewire registration, Livewire 4 attributes, Alpine.js integration, and Pest v4 testing guidelines."
user-invocable: true
argument-hint: "[component|route|layout|test]"
license: MIT
metadata:
  author: Antigravity
  version: "4.1.0"
  category: framework
---

# Livewire 4 Project Architecture & Conventions

This skill provides comprehensive instructions for building, structuring, rendering, and maintaining **Livewire 4** applications based on modern Laravel 13 + Livewire 4 standards.

---

## 1. Directory & Component Structure

Livewire 4 supports **co-located components** (co-locating PHP class logic and Blade views inside `resources/views/`) alongside traditional `app/Livewire` components.

### Co-Located / View-First Structure (Recommended)

Components are organized inside feature namespaces in `resources/views/<namespace>/<component-name>/`:

```
resources/views/
├── layouts/
│   ├── app.blade.php           # Public layout (default for public pages)
│   ├── admin.blade.php         # Admin dashboard layout
│   └── auth.blade.php          # Authentication layout
├── pages/                      # 'pages::' namespace (public routes)
│   ├── home/
│   │   ├── home.php            # Anonymous Livewire class logic
│   │   └── home.blade.php      # Livewire Blade view
│   ├── about/
│   │   ├── about.php
│   │   └── about.blade.php
│   └── blog/
│       ├── blog.php
│       └── blog.blade.php
├── admin/                      # 'admin::' namespace (dashboard routes)
│   ├── dashboard/
│   │   ├── dashboard.php
│   │   └── dashboard.blade.php
│   ├── blog-list/
│   │   ├── blog-list.php
│   │   └── blog-list.blade.php
│   └── user/
│       ├── user-list.php
│       └── user-list.blade.php
├── auth/                       # 'auth::' namespace (login/register)
│   └── login/
│       ├── login.php
│       └── login.blade.php
└── components/                 # Blade components & global Livewire components
    ├── public/
    │   ├── header/header.blade.php
    │   ├── footer/footer.blade.php
    │   └── quote-modal/
    │       ├── quote-modal.php
    │       └── quote-modal.blade.php
    ├── admin/
    └── toaster.blade.php
```

---

## 2. How Layout Rendering Works (web.php -> Component -> Layout)

Livewire 4 handles layout resolution in 3 connected steps:

### Step 1: Route Registration in `routes/web.php`

Routes map directly to component namespace identifiers via `Route::livewire()`:

```php
use Illuminate\Support\Facades\Route;

// Public routes (uses pages:: namespace)
Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/about', 'pages::about')->name('about');
Route::livewire('/blogs', 'pages::blog')->name('blog');

// Auth routes (uses auth:: namespace)
Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'auth::login')->name('login');
});

// Admin routes (uses admin:: namespace)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::livewire('/', 'admin::dashboard')->name('admin.dashboard');
    Route::livewire('/blogs', 'admin::blog-list')->name('admin.blogs');
});
```

### Step 2: Layout Resolution in the Component Class

The component specifies its wrapping layout using the `#[Layout]` attribute:

```php
// resources/views/pages/home/home.php
new #[Layout('layouts::app')] class extends Component { ... }

// resources/views/admin/blog-list/blog-list.php
new #[Layout('layouts::admin')] class extends Component { ... }

// resources/views/auth/login/login.php
new #[Layout('layouts::auth')] class extends Component { ... }
```

- `'layouts::app'` resolves to `resources/views/layouts/app.blade.php`.
- `'layouts::admin'` resolves to `resources/views/layouts/admin.blade.php`.
- `'layouts::auth'` resolves to `resources/views/layouts/auth.blade.php`.

### Step 3: Layout Structure with Header, Footer, Slots & Global Components

The layout file renders global layout elements (Headers, Footers, Modals, Toasters) and injects the requested Livewire page content into `{{ $slot }}`.

#### Public Layout Example (`resources/views/layouts/app.blade.php`)

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', setting('meta_title', 'Farm2Factory'))</title>
    <meta name="description" content="@yield('meta_description')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-background text-text antialiased">

    <!-- 1. Included Blade Header Component -->
    <x-public.header.header />

    <!-- 2. Main Page Livewire Component Content injected here -->
    {{ $slot }}

    <!-- 3. Included Blade Footer Component -->
    <x-public.footer.footer />

    <!-- 4. Global Interactivity / Livewire Modal Component -->
    <livewire:public.quote-modal />

    @livewireScripts
</body>
</html>
```

#### Admin Layout Example (`resources/views/layouts/admin.blade.php`)

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-[#FAF9F5]">

        <!-- Sidebar Component -->
        <livewire:admin.sidebar />

        <div class="flex flex-1 flex-col">
            <!-- Header Component -->
            <livewire:admin.header />

            <main class="flex-1 px-6 py-6 lg:px-8">
                <!-- Page Component Content -->
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Global Toast Component -->
    <x-toaster />

    @livewireScripts
</body>
</html>
```

---

## 3. Including Components & Layout Assets Summary

1. **Anonymous Blade Components**:
   - `<x-public.header.header />` -> `resources/views/components/public/header/header.blade.php`
   - `<x-public.footer.footer />` -> `resources/views/components/public/footer/footer.blade.php`
   - `<x-toaster />` -> `resources/views/components/toaster.blade.php`

2. **Nested Livewire Components**:
   - `<livewire:public.quote-modal />` -> `resources/views/components/public/quote-modal/quote-modal.php`
   - `<livewire:admin.sidebar />` -> `resources/views/admin/sidebar/sidebar.php`

3. **Page Content Injection**:
   - Component blade view output is rendered into `{{ $slot }}` inside the layout.

---

## 4. Anonymous Livewire Component Classes

Co-located Livewire components use anonymous classes extending `Livewire\Component`.

```php
<?php

use App\Models\Blog;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] class extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $deleteId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function toggleStatus(int $id): void
    {
        $blog = Blog::findOrFail($id);
        $blog->is_published = ! (bool) $blog->is_published;
        $blog->save();

        $this->dispatch('toast-show', [
            'message' => 'Status updated successfully!',
            'type' => 'success',
        ]);
    }

    #[Computed]
    public function blogs(): LengthAwarePaginator
    {
        return Blog::query()
            ->when($this->search !== '', fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->orderByDesc('id')
            ->paginate(10);
    }
};
```

---

## 5. Livewire 4 Attributes & Utilities

| Attribute / Trait | Description |
| --- | --- |
| `#[Layout('layouts::name')]` | Sets component layout template |
| `#[Title('Page Title')]` | Sets page title |
| `#[Computed]` | Caches getter method results for lifetime of request |
| `#[Validate('required\|email')]` | Field validation rule |
| `#[Url]` | Binds component property to query parameter |
| `#[On('event-name')]` | Listens to client/server dispatched events |
| `use WithPagination;` | Enables server-side pagination |
| `use WithFileUploads;` | Enables file upload handling |

---

## 6. Alpine.js & Micro-Interactivity

Livewire 4 seamlessly integrates with Alpine.js:

```blade
<div x-data="{ open: false }" @keydown.escape.window="open = false">
    <button @click="open = !open">Toggle</button>
    <div x-show="open" x-cloak>
        Dropdown content
    </div>
</div>
```

---

## 7. Testing Livewire 4 Components (Pest v4)

Use Pest tests to verify Livewire actions and rendering:

```php
use Livewire\Livewire;
use App\Models\User;
use App\Models\Blog;

test('admin blog list page renders for authenticated admins', function () {
    $admin = User::factory()->create()->assignRole('super-admin');

    $this->actingAs($admin)
        ->get(route('admin.blogs'))
        ->assertSuccessful()
        ->assertSee('Blog Post Management');
});

test('admin can toggle blog publication status', function () {
    $blog = Blog::factory()->create(['is_published' => false]);

    Livewire::test('admin::blog-list')
        ->call('toggleStatus', $blog->id)
        ->assertHasNoErrors();

    expect(Blog::find($blog->id)->is_published)->toBeTrue();
});
```

---

## 8. Code Style & Formatter

Always format PHP code using Laravel Pint before finalizing changes:

```bash
vendor/bin/pint --dirty --format agent
```
