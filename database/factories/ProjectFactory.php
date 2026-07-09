<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projectNames = [
            'Website Redesign',
            'Mobile App Launch',
            'Brand Identity Overhaul',
            'Q4 Marketing Campaign',
            'Product Documentation',
            'Customer Portal',
            'API Integration',
            'E-commerce Platform',
            'Internal Dashboard',
            'Data Migration Project',
        ];

        $descriptions = [
            'A complete overhaul of the visual identity system including typography, color palette, and digital assets.',
            'Launch our new mobile application with focus on user experience and performance optimization.',
            'Comprehensive marketing campaign for Q4 with focus on social media and content marketing.',
            'Build a customer-facing portal for self-service account management and support.',
            'Integrate third-party APIs to enhance platform capabilities and data synchronization.',
            'Develop a full-featured e-commerce platform with payment processing and inventory management.',
            'Create an internal dashboard for real-time analytics and team collaboration.',
            'Migrate legacy data to new infrastructure with zero downtime and data integrity validation.',
        ];

        $colors = ['#3525cd', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899'];
        $icons = ['folder_managed', 'rocket_launch', 'design_services', 'campaign', 'description', 'api', 'shopping_cart', 'dashboard'];

        $startDate = fake()->dateTimeBetween('-3 months', 'now');
        $dueDate = fake()->dateTimeBetween($startDate, '+6 months');

        return [
            'owner_id' => User::factory(),
            'team_id' => null,
            'name' => fake()->unique()->randomElement($projectNames),
            'slug' => null, // Will be generated in model
            'description' => fake()->randomElement($descriptions),
            'color' => fake()->randomElement($colors),
            'icon' => fake()->randomElement($icons),
            'status' => fake()->randomElement(['active', 'on_hold', 'completed', 'archived']),
            'progress' => fake()->numberBetween(0, 100),
            'budget' => fake()->randomElement([null, fake()->numberBetween(5000, 100000)]),
            'start_date' => $startDate,
            'due_date' => $dueDate,
        ];
    }
}
