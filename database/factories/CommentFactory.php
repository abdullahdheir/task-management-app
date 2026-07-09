<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentBodies = [
            "This looks great! Let's move forward with this approach.",
            "I have a few suggestions for improvement here.",
            "Can we discuss this in the next team meeting?",
            "The design needs some refinement before approval.",
            "Excellent work on this task!",
            "I've updated the requirements based on feedback.",
            "Please review the attached document for details.",
            "This is blocking the next phase of the project.",
            "Let's schedule a call to go over this.",
            "The timeline might need adjustment.",
        ];

        return [
            'user_id' => User::factory(),
            'commentable_type' => Task::class,
            'commentable_id' => Task::factory(),
            'parent_id' => null,
            'body' => fake()->randomElement($commentBodies),
        ];
    }
}
