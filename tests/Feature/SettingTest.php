<?php

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

require_once __DIR__.'/../../app/helpers.php';

uses(RefreshDatabase::class);

test('unauthenticated users cannot access settings page', function () {
    $this->get('/admin/settings')
        ->assertRedirect('/login');
});

test('authenticated admin can render settings page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/settings')
        ->assertSuccessful()
        ->assertSee('System Settings');
});

test('admin can update hospital contact information', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test('admin::setting')
        ->set('hospital_name', 'City Ortho Hospital')
        ->set('phone_number', '+1 (555) 111-2222')
        ->set('whatsapp_number', '+1 (555) 333-4444')
        ->set('email', 'info@cityortho.com')
        ->call('saveHospitalInfo')
        ->assertHasNoErrors();

    expect(setting('hospital_name'))->toBe('City Ortho Hospital')
        ->and(setting('phone_number'))->toBe('+1 (555) 111-2222')
        ->and(setting('whatsapp_number'))->toBe('+1 (555) 333-4444')
        ->and(setting('email'))->toBe('info@cityortho.com');
});

test('admin can update social media links', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test('admin::setting')
        ->set('social_instagram', 'https://instagram.com/cityortho')
        ->set('social_facebook', 'https://facebook.com/cityortho')
        ->set('social_x', 'https://x.com/cityortho')
        ->call('saveSocialLinks')
        ->assertHasNoErrors();

    expect(setting('social_instagram'))->toBe('https://instagram.com/cityortho')
        ->and(setting('social_facebook'))->toBe('https://facebook.com/cityortho')
        ->and(setting('social_x'))->toBe('https://x.com/cityortho');
});

test('admin can update hero section details and upload slider images', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $heroImage = UploadedFile::fake()->image('banner1.jpg');

    Livewire::actingAs($user)
        ->test('admin::setting')
        ->set('hero_title', 'Best Spine Center')
        ->set('hero_description', 'Top notch orthopedic care')
        ->set('newHeroImages', [$heroImage])
        ->call('saveHeroSection')
        ->assertHasNoErrors();

    expect(setting('hero_title'))->toBe('Best Spine Center')
        ->and(setting('hero_description'))->toBe('Top notch orthopedic care');

    $sliderImages = setting('hero_slider_images', []);
    expect($sliderImages)->toBeArray()->and(count($sliderImages))->toBe(1);

    Storage::disk('public')->assertExists($sliderImages[0]);
});

test('admin can remove hero slider image', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $fakeFile = UploadedFile::fake()->image('banner2.jpg');
    $storedPath = $fakeFile->store('hero-slider', 'public');

    Setting::set('hero_slider_images', [$storedPath]);

    Livewire::actingAs($user)
        ->test('admin::setting')
        ->call('removeHeroImage', 0)
        ->assertHasNoErrors();

    $sliderImages = setting('hero_slider_images', []);
    expect(count($sliderImages))->toBe(0);
    Storage::disk('public')->assertMissing($storedPath);
});
