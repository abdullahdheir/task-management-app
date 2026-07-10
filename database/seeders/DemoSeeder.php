<?php

namespace Database\Seeders;

use App\Enums\Department;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or get the main user (a@a.com)
        $mainUser = User::firstOrCreate(
            ['email' => 'a@a.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'job_title' => 'Administrator',
                'department' => Department::MANAGEMENT->value,
                'location' => 'San Francisco, CA',
                'bio' => 'System administrator with full access to all projects and tasks.',
                'timezone' => 'America/Los_Angeles',
                'dark_mode' => false,
                'two_factor_enabled' => false,
                'share_usage_data' => true,
            ]
        );

        // Create demo users using factory
        $demoUsers = User::factory()->count(5)->create();
        $allUsers = collect([$mainUser])->merge($demoUsers);

        // Create teams using factory
        $teams = Team::factory()->count(2)->create([
            'owner_id' => $mainUser->id,
        ]);

        // Add members to teams
        foreach ($teams as $team) {
            foreach ($allUsers as $user) {
                $team->members()->syncWithoutDetaching([
                    $user->id => [
                        'role' => $user->id === $team->owner_id ? 'admin' : 'member',
                        'status' => 'active',
                        'joined_at' => now(),
                    ],
                ]);
            }
        }

        // Create projects using factory
        $projects = Project::factory()->count(4)->create([
            'owner_id' => $mainUser->id,
            'team_id' => $teams->first()->id,
        ]);

        // Add members to projects
        foreach ($projects as $project) {
            foreach ($allUsers as $index => $user) {
                $roles = ['lead', 'member', 'viewer'];
                $jobTitles = ['Lead Designer', 'Senior Developer', 'Product Manager', 'UX Researcher', 'Marketing Lead'];
                $project->members()->syncWithoutDetaching([
                    $user->id => [
                        'role' => $roles[$index % count($roles)],
                        'job_title' => $jobTitles[$index % count($jobTitles)],
                    ],
                ]);
            }
        }

        // Create tasks using factory for each project
        foreach ($projects as $project) {
            Task::factory()->count(rand(5, 8))->create([
                'user_id' => $mainUser->id,
                'assignee_id' => $demoUsers->random()->id,
                'project_id' => $project->id,
            ]);
        }

        // Create standalone tasks using factory
        Task::factory()->count(10)->create([
            'user_id' => $mainUser->id,
            'assignee_id' => $demoUsers->random()->id,
            'project_id' => null,
        ]);

        // Get all tasks for creating comments and attachments
        $allTasks = Task::all();

        // Create comments using factory
        Comment::factory()->count(15)->create([
            'user_id' => $demoUsers->random()->id,
            'commentable_type' => Task::class,
            'commentable_id' => $allTasks->random()->id,
        ]);

        // Create attachments using factory
        TaskAttachment::factory()->count(10)->create([
            'task_id' => $allTasks->random()->id,
            'user_id' => $demoUsers->random()->id,
        ]);

        // Create activities using factory
        Activity::factory()->count(20)->create([
            'user_id' => $demoUsers->random()->id,
            'subject_type' => Task::class,
            'subject_id' => $allTasks->random()->id,
        ]);

        $this->command->info('Demo data seeded successfully!');
        $this->command->info('Users: ' . $allUsers->count());
        $this->command->info('Teams: ' . $teams->count());
        $this->command->info('Projects: ' . $projects->count());
        $this->command->info('Tasks: ' . Task::count());
    }
}
