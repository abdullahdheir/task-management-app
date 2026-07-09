<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actions = [
            'created',
            'updated',
            'completed',
            'commented',
            'uploaded',
            'changed_priority',
            'changed_status',
            'assigned',
            'unassigned',
            'deleted',
        ];

        return [
            'user_id' => User::factory(),
            'subject_type' => Task::class,
            'subject_id' => Task::factory(),
            'action' => fake()->randomElement($actions),
            'meta' => fake()->optional(0.5)->randomElement([
                ['from' => 'low', 'to' => 'high'],
                ['from' => 'todo', 'to' => 'in_progress'],
                ['file' => 'document.pdf'],
                ['comment' => 'Updated requirements'],
            ]),
        ];
    }
}
