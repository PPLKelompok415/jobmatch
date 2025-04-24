<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // ⬅️ INI WAJIB
use App\Models\Company;
use App\Models\User; // kalau kamu juga butuh bu

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Buat user dummy terlebih dahulu
        $user = User::factory()->create(['id' => 1]);

        for ($i = 1; $i <= 5; $i++) {
            Company::create([
                'user_id' => $user->id, // terjamin ada
                'logo' => 'logo.png',
                'company_name' => "Company $i",
                'company_address' => fake()->address(),
                'website_address' => "https://company$i.test",
                'company_email' => "info@company$i.test",
                'company_phone_number' => fake()->phoneNumber(),
                'position' => fake()->jobTitle(),
                'type_of_work' => fake()->randomElement(['Full-Time', 'Part-Time', 'Remote']),
                'location' => fake()->randomElement(['Jakarta', 'Bandung', 'Surabaya']),
                'salary_min' => fake()->numberBetween(5000000, 9000000),
                'salary_max' => fake()->numberBetween(10000000, 16000000),
                'deadline' => fake()->dateTimeBetween('now', '+3 months'),
                'job_description' => fake()->paragraph(),
            ]);
        }
    }
}
