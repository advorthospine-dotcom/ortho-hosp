<?php

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('unauthenticated users cannot access services page', function () {
    $this->get('/admin/services')
        ->assertRedirect('/login');
});

test('authenticated admin can render services page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/services')
        ->assertSuccessful()
        ->assertSee('Clinical Services Management');
});

test('admin can create a new service specialty with image upload', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('robot-knee.jpg');

    Livewire::actingAs($user)
        ->test('admin::service.list')
        ->set('title', 'Robotic Hip Surgery')
        ->set('slug', 'robotic-hip-surgery')
        ->set('category', 'joints')
        ->set('category_label', 'Joint Replacements')
        ->set('badge', 'Robotic Care')
        ->set('desc', 'Advanced robotic hip joint replacement procedure.')
        ->set('featuresInput', "Sub-millimeter alignment\nDirect anterior approach")
        ->set('imageFile', $file)
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('close-service-modal');

    $service = Service::where('slug', 'robotic-hip-surgery')->first();
    expect($service)->not->toBeNull();
    expect($service->title)->toBe('Robotic Hip Surgery');
    expect($service->features)->toBe(['Sub-millimeter alignment', 'Direct anterior approach']);
    Storage::disk('public')->assertExists($service->image);
});

test('admin can edit an existing service', function () {
    $user = User::factory()->create();
    $service = Service::create([
        'title' => 'Old Service Name',
        'slug' => 'old-service-name',
        'category' => 'spine',
        'category_label' => 'Spine Care',
        'desc' => 'Old description text.',
        'is_active' => true,
    ]);

    Livewire::actingAs($user)
        ->test('admin::service.list')
        ->call('edit', $service->id)
        ->set('title', 'Updated Service Title')
        ->set('desc', 'Updated description text.')
        ->call('save')
        ->assertHasNoErrors();

    expect($service->fresh()->title)->toBe('Updated Service Title');
    expect($service->fresh()->desc)->toBe('Updated description text.');
});

test('admin can toggle service publication status', function () {
    $user = User::factory()->create();
    $service = Service::create([
        'title' => 'Test Service',
        'slug' => 'test-service',
        'category' => 'trauma',
        'desc' => 'Test description',
        'is_active' => true,
    ]);

    Livewire::actingAs($user)
        ->test('admin::service.list')
        ->call('toggleStatus', $service->id);

    expect($service->fresh()->is_active)->toBeFalse();
});

test('admin can delete a service', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('service-thumb.jpg');
    $path = $file->store('services', 'public');

    $service = Service::create([
        'title' => 'Service to Delete',
        'slug' => 'service-to-delete',
        'category' => 'sports',
        'image' => $path,
        'desc' => 'Delete me description',
        'is_active' => true,
    ]);

    Livewire::actingAs($user)
        ->test('admin::service.list')
        ->call('delete', $service->id)
        ->assertHasNoErrors();

    expect(Service::find($service->id))->toBeNull();
    Storage::disk('public')->assertMissing($path);
});
