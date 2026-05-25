<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'owner_id' => User::factory(),
            'status' => fake()->randomElement(['pending', 'doing', 'completed']),
            'started_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'completed_at' => fake()->optional(0.3)->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
