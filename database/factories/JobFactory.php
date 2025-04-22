<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Backend Developer', 'Frontend Developer', 'Data Analyst']),
            'company_id' => 1, // sementara, asumsi ada company_id
            'bidang' => $this->faker->randomElement(['IT', 'Finance', 'Design']),
            'location' => $this->faker->randomElement(['Jakarta', 'Bandung', 'Surabaya']),
            'type_of_work' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Remote']),
            'gaji_min' => $this->faker->numberBetween(5000000, 8000000),
            'gaji_max' => $this->faker->numberBetween(9000000, 15000000),
        ];
    }
}
