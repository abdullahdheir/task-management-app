<?php

namespace Database\Factories;

use App\Models\Project;
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
        $taskTitles = [
            'Finalize typography scale',
            'Establish primary color palette',
            'Logo accessibility audit',
            'Design system documentation',
            'User research interviews',
            'Wireframe mobile screens',
            'Create component library',
            'Implement dark mode',
            'Performance optimization',
            'Accessibility audit',
            'Write unit tests',
            'Code review session',
            'Deploy to staging',
            'User acceptance testing',
            'Production deployment',
        ];

        $categories = ['work', 'personal', 'health', 'finance', 'other'];
        $statuses = ['todo', 'in_progress', 'review', 'done'];
        $priorities = ['low', 'medium', 'high', 'urgent'];

        $dueDate = fake()->optional(0.7)->dateTimeBetween('-2 weeks', '+2 weeks');
        $isCompleted = fake()->boolean(30);

        return [
            'user_id' => User::factory(),
            'assignee_id' => fake()->optional(0.5)->randomElement([User::factory(), null]),
            'project_id' => fake()->optional(0.6)->randomElement([Project::factory(), null]),
            'parent_id' => null,
            'title' => fake()->randomElement($taskTitles),
            'description' => fake()->optional(0.5)->paragraph(),
            'status' => $isCompleted ? 'done' : fake()->randomElement($statuses),
            'priority' => fake()->randomElement($priorities),
            'category' => fake()->randomElement($categories),
            'is_completed' => $isCompleted,
            'completed_at' => $isCompleted ? fake()->dateTimeBetween('-1 month', 'now') : null,
            'due_date' => $dueDate ? $dueDate->format('Y-m-d') : null,
            'due_time' => fake()->optional(0.3)->time(),
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }
}
