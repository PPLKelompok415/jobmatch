<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Company;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'PHP', 'Laravel', 'JavaScript', 'Python', 'SQL',
            'React', 'Node.js', 'CSS', 'HTML', 'Docker'
        ];

        foreach ($skills as $skillName) {
            Skill::firstOrCreate(['name' => $skillName]);
        }

        $allSkillIds = Skill::pluck('id')->toArray();
        $companyIds = Company::pluck('id')->toArray(); // ✅ Aman ambil langsung dari DB

        for ($i = 1; $i <= 10; $i++) {
            $job = Job::create([
                'company_id' => fake()->randomElement($companyIds),
                'title' => fake()->randomElement(['Backend Developer', 'Frontend Developer', 'Data Analyst']),
                'type_of_work' => fake()->randomElement(['Full-Time', 'Part-Time', 'Remote']),
                'location' => fake()->randomElement(['Jakarta', 'Bandung', 'Surabaya']),
                'gaji_min' => fake()->numberBetween(5000000, 9000000),
                'gaji_max' => fake()->numberBetween(10000000, 16000000),
                'bidang' => fake()->randomElement(['IT', 'Finance', 'Design']),
            ]);

            $job->skills()->attach(fake()->randomElements($allSkillIds, rand(3, 5)));
        }
    }
}

