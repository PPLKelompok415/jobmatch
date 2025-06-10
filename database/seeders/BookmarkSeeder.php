<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bookmark;
use App\Models\User;
use App\Models\Job;

class BookmarkSeeder extends Seeder
{
    public function run()
    {
        // Ambil beberapa user dan job yang sudah ada
        $users = User::all();
        $jobs = Job::all();

        if ($users->isEmpty() || $jobs->isEmpty()) {
            $this->command->info('No users or jobs found, skipping bookmark seeding.');
            return;
        }

        // Contoh buat 10 bookmark random
        foreach (range(1, 10) as $index) {
            $user = $users->random();
            $job = $jobs->random();

            // Cek apakah bookmark sudah ada supaya tidak duplikat
            $exists = Bookmark::where('user_id', $user->id)
                              ->where('job_id', $job->id)
                              ->exists();

            if (!$exists) {
                Bookmark::create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                ]);
            }
        }
    }
}
