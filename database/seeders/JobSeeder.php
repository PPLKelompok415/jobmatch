<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'Tokopedia',
                'location' => 'Bandung',
                'type' => 'Freelance',
                'category' => 'Design',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
