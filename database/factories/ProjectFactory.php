<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [        
            'client_id' => Client::inRandomOrder()->first()->id,
            'project_number' => fake()->uuid(),
            'property_type' => fake()->randomElement(['residential', 'commercial']),
            'property_owner_name' => fake()->name(),
            'property_address' => fake()->address(),
            'property_state' => 'New York',
            'property_city' => 'Manhattan',
            'property_area_code' => fake()->randomElement(['212', '646', '332']),
            'wet_stamp_mailing_address' => fake()->address(),
            'wet_stamp_count' => fake()->numberBetween(1, 10),
            'shipping_number' => fake()->creditCardNumber(),
            'priority_level' => fake()->randomElement(['Low', 'Medium', 'High', 'Immediate']),
            'task_price_total' => 0,
            'commercial_job_price' => 0,
            'task_total' => 0,
            'rfi_messages' => fake()->paragraph(8),
        ];
    }
}
