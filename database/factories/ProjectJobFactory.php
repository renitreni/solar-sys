<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectJob>
 */
class ProjectJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_name' => fake()->jobTitle(), // JobName VARCHAR(255),
            'service_order_url' => fake()->url(),
            'request_no' => fake()->numberBetween(11111, 99999),
            'job_no' => fake()->numberBetween(11111, 99999),
            'service_order_form' => fake()->word(),
            'job_status' => 'pending',
            'in_review' => '1',
            'estimated_completion' => fake()->dateTime(),
            'estimated_completion_override' => fake()->dateTime(),
            'date_received_formula' => fake()->dateTime(),
            'date_due' => fake()->dateTime(),
            'date_completed' => fake()->dateTime(),
            'date_cancelled' => fake()->dateTime(),
            'date_sent' => fake()->dateTime(), // Sent to Client
            'client_name' => fake()->name(),
            'client_email' => fake()->email(),
            'client_email_override' => fake()->email(),
            'deliverables_email' => fake()->email(),
            'additional_info' => fake()->paragraph(), // Additional Information From Client
        ];
    }
}
