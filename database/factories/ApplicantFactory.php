<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApplicantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1, // atau buat dinamis jika perlu
            'name' => $this->faker->name(),
            'full_name' => $this->faker->name(),
            'password' => bcrypt('password'),
            'role' => 'applicant',

            'photo' => 'default.jpg',
            'date_of_birth' => $this->faker->date('Y-m-d', '-22 years'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),

            'cv_file' => 'cv.pdf',
            'portfolio_file' => 'portfolio.pdf',

            'institution' => $this->faker->company(),
            'major' => $this->faker->word(),
            'graduation_year' => $this->faker->year(),

            'work_company' => $this->faker->company(),
            'work_position' => $this->faker->jobTitle(),
            'work_description' => $this->faker->sentence(),

            'soft_skills' => json_encode(['Teamwork', 'Communication']),
            'hard_skills' => json_encode(['Laravel', 'SQL']),
            'certification' => json_encode(['AWS Certified']),

            'desired_position' => $this->faker->randomElement(['Backend Developer', 'Frontend Developer', 'Data Analyst']),
            'type_of_work' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Remote']),
            'location' => $this->faker->randomElement(['Jakarta', 'Bandung', 'Surabaya']),
            'salary_min' => $this->faker->numberBetween(4000000, 7000000),
            'salary_max' => $this->faker->numberBetween(8000000, 12000000),
            'availability_date' => $this->faker->date('Y-m-d', now()->addMonth()),
        ];
    }
}
