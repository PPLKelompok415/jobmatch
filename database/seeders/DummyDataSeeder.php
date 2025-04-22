<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Skill;
use App\Models\Applicant;
use App\Models\Job;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat user dummy untuk applicant
        $user = User::firstOrCreate([
            'email' => 'dummy@applicant.test',
        ], [
            'name' => 'Dummy User',
            'password' => bcrypt('password'),
        ]);

        // 2. Tambah daftar skill
        $skills = ['PHP', 'Laravel', 'JavaScript', 'Python', 'SQL', 'React', 'Node.js', 'CSS', 'HTML', 'Docker'];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }

        // 3. Buat 5 applicant dengan user_id
        Applicant::factory(5)->create(['user_id' => $user->id])->each(function ($applicant) {
            $hardSkills = Skill::inRandomOrder()->limit(3)->pluck('id');
            $softSkills = Skill::inRandomOrder()->limit(2)->pluck('id');

            $applicant->hardSkills()->attach($hardSkills);
            $applicant->softSkills()->attach($softSkills);
        });

        // 4. Buat 7 lowongan kerja
        Job::factory(7)->create()->each(function ($job) {
            $skills = Skill::inRandomOrder()->limit(4)->pluck('id');
            $job->skills()->attach($skills);
        });
    }
}
