<?php

namespace Database\Seeders;

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
                'department' => 'Management',
                'location' => 'San Francisco, CA',
                'bio' => 'System administrator with full access to all projects and tasks.',
                'timezone' => 'America/Los_Angeles',
                'dark_mode' => false,
                'two_factor_enabled' => false,
                'share_usage_data' => true,
            ]
        );

        // Create demo users
        $users = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'username' => 'sarahj',
                'job_title' => 'Lead Designer',
                'department' => 'Design',
                'location' => 'San Francisco, CA',
                'bio' => 'Passionate about creating beautiful and functional user experiences.',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'name' => 'Marcus Chen',
                'email' => 'marcus@example.com',
                'username' => 'marcusc',
                'job_title' => 'Senior Developer',
                'department' => 'Engineering',
                'location' => 'New York, NY',
                'bio' => 'Full-stack developer with a focus on clean code and performance.',
                'timezone' => 'America/New_York',
            ],
            [
                'name' => 'Elena Rodriguez',
                'email' => 'elena@example.com',
                'username' => 'elenar',
                'job_title' => 'Product Manager',
                'department' => 'Product',
                'location' => 'Austin, TX',
                'bio' => 'Driving product strategy and ensuring customer success.',
                'timezone' => 'America/Chicago',
            ],
            [
                'name' => 'David Kim',
                'email' => 'david@example.com',
                'username' => 'davidk',
                'job_title' => 'UX Researcher',
                'department' => 'Design',
                'location' => 'Seattle, WA',
                'bio' => 'Understanding user needs through research and testing.',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'name' => 'Jessica Williams',
                'email' => 'jessica@example.com',
                'username' => 'jessicaw',
                'job_title' => 'Marketing Lead',
                'department' => 'Marketing',
                'location' => 'Chicago, IL',
                'bio' => 'Building brand awareness and driving growth.',
                'timezone' => 'America/Chicago',
            ],
        ];

        $createdUsers = collect();
        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, [
                    'password' => Hash::make('password'),
                    'dark_mode' => false,
                    'two_factor_enabled' => false,
                    'share_usage_data' => true,
                ])
            );
            $createdUsers->push($user);
        }

        // Create teams
        $teams = [
            [
                'name' => 'Product Design Team',
                'description' => 'Cross-functional team focused on product design and user experience.',
                'privacy' => 'private',
                'workspace_name' => 'Design Hub',
            ],
            [
                'name' => 'Engineering Squad',
                'description' => 'Agile development team building scalable solutions.',
                'privacy' => 'private',
                'workspace_name' => 'Dev Lab',
            ],
        ];

        $createdTeams = collect();
        foreach ($teams as $teamData) {
            $team = Team::firstOrCreate(
                ['name' => $teamData['name']],
                array_merge($teamData, [
                    'owner_id' => $mainUser->id,
                    'slug' => null,
                ])
            );
            $createdTeams->push($team);
        }

        // Add members to teams
        foreach ($createdTeams as $team) {
            foreach ($createdUsers as $user) {
                $team->members()->syncWithoutDetaching([
                    $user->id => [
                        'role' => $user->id === $team->owner_id ? 'admin' : 'member',
                        'status' => 'active',
                        'joined_at' => now(),
                    ],
                ]);
            }
        }

        // Create projects
        $projects = [
            [
                'name' => 'Website Redesign 2024',
                'description' => 'Complete overhaul of the company website with modern design and improved performance.',
                'color' => '#3525cd',
                'icon' => 'design_services',
                'status' => 'active',
                'budget' => 75000.00,
                'start_date' => now()->subMonths(2),
                'due_date' => now()->addMonths(3),
            ],
            [
                'name' => 'Mobile App Launch',
                'description' => 'Launch our new mobile application with focus on user experience and performance.',
                'color' => '#10b981',
                'icon' => 'rocket_launch',
                'status' => 'active',
                'budget' => 120000.00,
                'start_date' => now()->subMonth(),
                'due_date' => now()->addMonths(4),
            ],
            [
                'name' => 'Q4 Marketing Campaign',
                'description' => 'Comprehensive marketing campaign for Q4 with focus on social media and content marketing.',
                'color' => '#f59e0b',
                'icon' => 'campaign',
                'status' => 'active',
                'budget' => 50000.00,
                'start_date' => now()->subWeeks(2),
                'due_date' => now()->addMonths(2),
            ],
            [
                'name' => 'Customer Portal',
                'description' => 'Build a customer-facing portal for self-service account management and support.',
                'color' => '#8b5cf6',
                'icon' => 'dashboard',
                'status' => 'on_hold',
                'budget' => 90000.00,
                'start_date' => now()->subMonths(3),
                'due_date' => now()->addMonth(),
            ],
        ];

        $createdProjects = collect();
        foreach ($projects as $projectData) {
            $project = Project::firstOrCreate(
                ['name' => $projectData['name']],
                array_merge($projectData, [
                    'owner_id' => $mainUser->id,
                    'team_id' => $createdTeams->first()->id,
                    'slug' => null,
                    'progress' => rand(20, 70),
                ])
            );
            $createdProjects->push($project);
        }

        // Add members to projects
        foreach ($createdProjects as $project) {
            foreach ($createdUsers as $index => $user) {
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

        // Create tasks for each project
        $taskTemplates = [
            'Website Redesign 2024' => [
                ['title' => 'Finalize typography scale', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'Establish primary color palette', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'Logo accessibility audit', 'priority' => 'medium', 'status' => 'in_progress'],
                ['title' => 'Design system documentation', 'priority' => 'medium', 'status' => 'todo'],
                ['title' => 'Mobile responsive design', 'priority' => 'high', 'status' => 'in_progress'],
                ['title' => 'Performance optimization', 'priority' => 'urgent', 'status' => 'todo'],
                ['title' => 'Cross-browser testing', 'priority' => 'medium', 'status' => 'todo'],
                ['title' => 'Content migration', 'priority' => 'low', 'status' => 'todo'],
            ],
            'Mobile App Launch' => [
                ['title' => 'User research interviews', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'Wireframe mobile screens', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'Create component library', 'priority' => 'medium', 'status' => 'in_progress'],
                ['title' => 'Implement dark mode', 'priority' => 'medium', 'status' => 'todo'],
                ['title' => 'Push notification system', 'priority' => 'high', 'status' => 'in_progress'],
                ['title' => 'App store submission', 'priority' => 'urgent', 'status' => 'todo'],
                ['title' => 'Beta testing program', 'priority' => 'medium', 'status' => 'todo'],
            ],
            'Q4 Marketing Campaign' => [
                ['title' => 'Campaign strategy development', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'Social media content calendar', 'priority' => 'high', 'status' => 'in_progress'],
                ['title' => 'Email marketing templates', 'priority' => 'medium', 'status' => 'in_progress'],
                ['title' => 'Influencer partnerships', 'priority' => 'medium', 'status' => 'todo'],
                ['title' => 'Analytics tracking setup', 'priority' => 'high', 'status' => 'todo'],
                ['title' => 'Budget allocation review', 'priority' => 'medium', 'status' => 'done'],
            ],
            'Customer Portal' => [
                ['title' => 'Requirements gathering', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'Database schema design', 'priority' => 'high', 'status' => 'done'],
                ['title' => 'API integration planning', 'priority' => 'medium', 'status' => 'in_progress'],
                ['title' => 'Security audit', 'priority' => 'urgent', 'status' => 'todo'],
                ['title' => 'User authentication flow', 'priority' => 'high', 'status' => 'todo'],
            ],
        ];

        $createdTasks = collect();
        foreach ($createdProjects as $project) {
            $tasks = $taskTemplates[$project->name] ?? [];
            foreach ($tasks as $taskData) {
                $task = Task::firstOrCreate(
                    [
                        'project_id' => $project->id,
                        'title' => $taskData['title'],
                    ],
                    array_merge($taskData, [
                        'user_id' => $mainUser->id,
                        'assignee_id' => $createdUsers->random()->id,
                        'parent_id' => null,
                        'description' => fake()->optional()->paragraph(),
                        'category' => 'work',
                        'is_completed' => $taskData['status'] === 'done',
                        'completed_at' => $taskData['status'] === 'done' ? now()->subDays(rand(1, 30)) : null,
                        'due_date' => fake()->optional(0.7)->dateTimeBetween('now', '+2 weeks'),
                        'due_time' => fake()->optional(0.3)->time(),
                        'sort_order' => rand(0, 100),
                    ])
                );
                $createdTasks->push($task);
            }
        }

        // Create some standalone tasks
        for ($i = 0; $i < 10; $i++) {
            Task::create([
                'user_id' => $mainUser->id,
                'assignee_id' => $createdUsers->random()->id,
                'project_id' => null,
                'parent_id' => null,
                'title' => fake()->randomElement([
                    'Review quarterly goals',
                    'Update personal portfolio',
                    'Schedule dentist appointment',
                    'Plan weekend trip',
                    'Read industry articles',
                    'Organize workspace',
                    'Update resume',
                    'Learn new technology',
                    'Exercise routine',
                    'Budget review',
                ]),
                'description' => fake()->optional()->paragraph(),
                'status' => fake()->randomElement(['todo', 'in_progress', 'review', 'done']),
                'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
                'category' => fake()->randomElement(['work', 'personal', 'health', 'finance', 'other']),
                'is_completed' => fake()->boolean(30),
                'completed_at' => fake()->optional(0.3)->dateTimeBetween('-1 month', 'now'),
                'due_date' => fake()->optional(0.7)->dateTimeBetween('-2 weeks', '+2 weeks'),
                'due_time' => fake()->optional(0.3)->time(),
                'sort_order' => rand(0, 100),
            ]);
        }

        // Create comments for some tasks
        foreach ($createdTasks->take(15) as $task) {
            Comment::create([
                'user_id' => $createdUsers->random()->id,
                'commentable_type' => Task::class,
                'commentable_id' => $task->id,
                'parent_id' => null,
                'body' => fake()->randomElement([
                    "This looks great! Let's move forward with this approach.",
                    "I have a few suggestions for improvement here.",
                    "Can we discuss this in the next team meeting?",
                    "The design needs some refinement before approval.",
                    "Excellent work on this task!",
                    "I've updated the requirements based on feedback.",
                    "Please review the attached document for details.",
                    "This is blocking the next phase of the project.",
                ]),
            ]);
        }

        // Create attachments for some tasks
        foreach ($createdTasks->take(10) as $task) {
            TaskAttachment::create([
                'task_id' => $task->id,
                'user_id' => $createdUsers->random()->id,
                'filename' => fake()->randomElement([
                    'design_mockup.fig',
                    'requirements.pdf',
                    'presentation.pptx',
                    'spreadsheet.xlsx',
                    'image_asset.png',
                ]),
                'path' => 'attachments/' . fake()->uuid() . '/' . fake()->randomElement([
                    'design_mockup.fig',
                    'requirements.pdf',
                    'presentation.pptx',
                ]),
                'mime_type' => fake()->randomElement([
                    'application/pdf',
                    'image/png',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                ]),
                'size' => fake()->numberBetween(1024, 10485760),
            ]);
        }

        // Create activities
        $actions = ['created', 'updated', 'completed', 'commented', 'uploaded', 'changed_priority', 'assigned'];
        foreach ($createdTasks->take(20) as $task) {
            Activity::create([
                'user_id' => $createdUsers->random()->id,
                'subject_type' => Task::class,
                'subject_id' => $task->id,
                'action' => fake()->randomElement($actions),
                'meta' => fake()->optional(0.5)->randomElement([
                    ['from' => 'low', 'to' => 'high'],
                    ['from' => 'todo', 'to' => 'in_progress'],
                    ['file' => 'document.pdf'],
                ]),
            ]);
        }

        $this->command->info('Demo data seeded successfully!');
        $this->command->info('Users: ' . $createdUsers->count());
        $this->command->info('Teams: ' . $createdTeams->count());
        $this->command->info('Projects: ' . $createdProjects->count());
        $this->command->info('Tasks: ' . Task::count());
    }
}
