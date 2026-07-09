<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teamNames = [
            'Product Design Team',
            'Engineering Squad',
            'Marketing Collective',
            'Customer Success',
            'Operations Hub',
            'Data Science Lab',
            'Creative Studio',
            'Growth Engineering',
        ];

        return [
            'owner_id' => User::factory(),
            'name' => fake()->unique()->randomElement($teamNames),
            'slug' => null, // Will be generated in model
            'description' => fake()->paragraph(),
            'avatar' => null,
            'privacy' => fake()->randomElement(['private', 'public']),
            'workspace_name' => fake()->company(),
        ];
    }
}
