<?php

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('unauthenticated users cannot access gallery page', function () {
    $this->get('/admin/gallery')
        ->assertRedirect('/login');
});

test('authenticated admin can render gallery page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/gallery')
        ->assertSuccessful()
        ->assertSee('Hospital Gallery');
});

test('admin can upload images to gallery', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $file = UploadedFile::fake()->image('surgery-room.jpg');

    Livewire::actingAs($user)
        ->test('admin::gallery')
        ->set('images', [$file])
        ->set('title', 'Surgical Room 1')
        ->call('uploadImages')
        ->assertHasNoErrors()
        ->assertDispatched('close-upload-modal');

    $gallery = Gallery::where('title', 'Surgical Room 1')->first();
    expect($gallery)->not->toBeNull();
    Storage::disk('public')->assertExists($gallery->image_path);
});

test('admin can toggle gallery image publication status', function () {
    $user = User::factory()->create();
    $gallery = Gallery::create([
        'title' => 'Test Item',
        'image_path' => 'gallery/test.jpg',
        'is_active' => true,
    ]);

    Livewire::actingAs($user)
        ->test('admin::gallery')
        ->call('toggleStatus', $gallery->id);

    expect($gallery->fresh()->is_active)->toBeFalse();
});

test('admin can delete gallery image', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('delete-me.jpg');
    $path = $file->store('gallery', 'public');

    $gallery = Gallery::create([
        'title' => 'To Delete',
        'image_path' => $path,
        'is_active' => true,
    ]);

    Livewire::actingAs($user)
        ->test('admin::gallery')
        ->call('delete', $gallery->id)
        ->assertHasNoErrors();

    expect(Gallery::find($gallery->id))->toBeNull();
    Storage::disk('public')->assertMissing($path);
});

test('public users can render gallery page and see active images', function () {
    Gallery::create([
        'title' => 'Advanced Surgery Operating Room',
        'image_path' => 'gallery/surgical-ot.jpg',
        'is_active' => true,
    ]);

    $this->get('/gallery')
        ->assertSuccessful()
        ->assertSee('Hospital Photo Gallery')
        ->assertSee('Advanced Surgery Operating Room');
});

