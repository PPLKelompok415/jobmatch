<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Skill;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'PHP', 'Laravel', 'JavaScript', 'Python', 'SQL',
            'React', 'Node.js', 'CSS', 'HTML', 'Docker'
        ];

        // Tambahkan skill jika belum ada
        foreach ($skills as $skillName) {
            Skill::firstOrCreate(['name' => $skillName]);
        }

        $allSkillIds = Skill::pluck('id')->toArray();

        // Buat 10 job dummy
        for ($i = 1; $i <= 10; $i++) {
            $job = Job::create([
                'company_id' => rand(1, 5), // pastikan data company ada
                'title' => fake()->randomElement(['Backend Developer', 'Frontend Developer', 'Data Analyst']),
                'type_of_work' => fake()->randomElement(['Full-Time', 'Part-Time', 'Remote']),
                'location' => fake()->randomElement(['Jakarta', 'Bandung', 'Surabaya']),
                'gaji_min' => fake()->numberBetween(5000000, 9000000),
                'gaji_max' => fake()->numberBetween(10000000, 16000000),
                'bidang' => fake()->randomElement(['IT', 'Finance', 'Design']),
            ]);

            // Hubungkan ke skill
            $job->skills()->attach(fake()->randomElements($allSkillIds, rand(3, 5)));
        }
    }
}
