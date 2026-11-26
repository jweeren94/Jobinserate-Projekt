<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

/**
 * @extends Factory<JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'location' => fake()->city(),
            'employment_type' => fake()->randomElement([
                'Fulltime',
                'Parttime',
            ]),
            'expires_at' => fake()->dateTimeBetween('now', '+3 months'),
            'is_published' => true,
            ];
    }
}
