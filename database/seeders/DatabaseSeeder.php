<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        // DummyDataSeeder::class,
        RolePermissionSeeder::class
    ]);
}

class JobSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jobs')->insert([
            [
                'title' => 'Backend Developer',
                'company' => 'Gojek',
                'location' => 'Jakarta',
                'type' => 'Full-time',
                'category' => 'Engineering',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'Tokopedia',
                'location' => 'Bandung',
                'type' => 'Freelance',
                'category' => 'Design',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambah data lain di sini
        ]);
    }
}

}
