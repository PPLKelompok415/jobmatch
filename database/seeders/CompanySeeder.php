<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'user_id' => 1,
            'logo' => 'logos/sample-logo.png',
            'company_name' => 'PT. Teknologi Nusantara',
            'company_address' => 'Jl. Merdeka No. 45, Jakarta',
            'website_address' => 'https://www.teknologinusantara.co.id',
            'company_email' => 'hrd@teknologinusantara.co.id',
            'company_phone_number' => '021-5551234',
            'position' => 'Backend Developer',
            'type_of_work' => 'Full-time',
            'location' => 'Jakarta',
            'salary_min' => 7000000,
            'salary_max' => 12000000,
            'deadline' => now()->addDays(30),
            'job_description' => 'Bertanggung jawab atas pengembangan dan pemeliharaan sistem backend berbasis Laravel.'
        ]);

        // Tambahkan data lain jika diperlukan
    }
}
