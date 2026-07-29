<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@orthohosp.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('admin123'),
            ]
        );

        $this->call(BlogSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(GallerySeeder::class);
    }
}
