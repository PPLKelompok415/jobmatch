<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Company;
use App\Models\Job;
use App\Models\Applicant;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ===== SKILLS =====
        $skills = collect([
            'PHP', 'Laravel', 'JavaScript', 'Python', 'React'
        ])->map(fn($name) => Skill::firstOrCreate(['name' => $name]));

        // ===== COMPANIES =====
        $companies = collect([
            ['name' => 'PT Teknologi Hebat', 'email' => 'hr@hebat.com'],
            ['name' => 'CV Digital Inovatif', 'email' => 'hr@inovatif.com'],
            ['name' => 'Startup Canggih', 'email' => 'hr@canggih.com'],
            ['name' => 'Solusi Data', 'email' => 'hr@solusi.com'],
            ['name' => 'PT Kreatifindo', 'email' => 'hr@kreatifindo.com'],
        ])->map(fn($c) =>
            Company::firstOrCreate([
                'name' => $c['name'],
                'email' => $c['email'],
                'password' => bcrypt('password'),
                'address' => 'Jakarta',
                'industry' => 'IT'
            ])
        );

        // ===== JOBS =====
        $jobs = collect([
            ['title' => 'Backend Developer', 'type' => 'Fulltime', 'location' => 'Jakarta', 'gaji_min' => 9000000, 'gaji_max' => 11000000, 'bidang' => 'Backend Developer'],
            ['title' => 'Frontend Developer', 'type' => 'Remote', 'location' => 'Bandung', 'gaji_min' => 7000000, 'gaji_max' => 9500000, 'bidang' => 'Frontend Developer'],
            ['title' => 'Fullstack Engineer', 'type' => 'Fulltime', 'location' => 'Surabaya', 'gaji_min' => 10000000, 'gaji_max' => 13000000, 'bidang' => 'Fullstack'],
            ['title' => 'Data Analyst', 'type' => 'Hybrid', 'location' => 'Jakarta', 'gaji_min' => 8000000, 'gaji_max' => 10500000, 'bidang' => 'Data Analyst'],
            ['title' => 'React Developer', 'type' => 'Fulltime', 'location' => 'Yogyakarta', 'gaji_min' => 8500000, 'gaji_max' => 12000000, 'bidang' => 'Frontend Developer'],
        ])->map(function ($j, $i) use ($companies) {
            return Job::firstOrCreate([
                'company_id' => $companies[$i]->id,
                'title' => $j['title'],
                'type_of_work' => $j['type'],
                'location' => $j['location'],
                'gaji_min' => $j['gaji_min'],
                'gaji_max' => $j['gaji_max'],
                'bidang' => $j['bidang'],
            ]);
        });

        // ===== JOB-SKILL RELATION =====
        $jobs->each(function ($job) use ($skills) {
            $job->skills()->sync($skills->random(rand(2, 4))->pluck('id'));
        });

        // ===== APPLICANTS =====
        $applicants = collect([
            ['John Doe', 'Backend Developer'],
            ['Jane Smith', 'Frontend Developer'],
            ['Ali Akbar', 'Fullstack'],
            ['Dewi Lestari', 'Data Analyst'],
            ['Budi Santoso', 'Frontend Developer'],
        ])->map(function ($a, $i) {
            return Applicant::firstOrCreate([
                'full_name' => $a[0],
                'email' => 'applicant' . ($i + 1) . '@email.com',
                'phone' => '08123' . rand(100000, 999999),
                'gender' => 'Male',
                'date_of_birth' => now()->subYears(rand(22, 30))->toDateString(),
                'address' => 'Indonesia',
                'expected_salary' => rand(8000000, 12000000),
                'salary_min' => rand(7000000, 10000000),
                'salary_max' => rand(11000000, 14000000),
                'desired_position' => $a[1],
            ]);
        });

        // ===== APPLICANT-SKILL RELATION =====
        $applicants->each(function ($applicant) use ($skills) {
            $applicant->skills()->sync($skills->random(rand(2, 4))->pluck('id'));
        });
    }
}
