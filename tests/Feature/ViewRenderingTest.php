<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewRenderingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * Test dashboard view renders without errors
     */
    public function test_dashboard_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.index');
    }

    /**
     * Test tasks index view renders without errors
     */
    public function test_tasks_index_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
    }

    /**
     * Test tasks create view renders without errors
     */
    public function test_tasks_create_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }

    /**
     * Test tasks show view renders without errors
     */
    public function test_tasks_show_view_renders(): void
    {
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('tasks.show', $task));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.show');
    }

    /**
     * Test projects overview view renders without errors
     */
    public function test_projects_overview_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('projects.overview'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.overview');
    }

    /**
     * Test projects show view renders without errors
     */
    public function test_projects_show_view_renders(): void
    {
        $project = Project::factory()->create([
            'owner_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('projects.show', $project));

        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
    }

    /**
     * Test projects create view renders without errors
     */
    public function test_projects_create_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('projects.create'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.create');
    }

    /**
     * Test projects edit view renders without errors
     */
    public function test_projects_edit_view_renders(): void
    {
        $project = Project::factory()->create([
            'owner_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('projects.edit', $project));

        $response->assertStatus(200);
        $response->assertViewIs('projects.edit');
    }

    /**
     * Test calendar view renders without errors
     */
    public function test_calendar_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('calendar.index'));

        $response->assertStatus(200);
        $response->assertViewIs('calendar.index');
    }

    /**
     * Test calendar view with month parameter renders without errors
     */
    public function test_calendar_view_with_month_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('calendar.index', ['month' => '2024-01']));

        $response->assertStatus(200);
        $response->assertViewIs('calendar.index');
    }

    /**
     * Test profile view renders without errors
     */
    public function test_profile_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('profile.show'));

        $response->assertStatus(200);
        $response->assertViewIs('profile.show');
    }

    /**
     * Test settings view renders without errors
     */
    public function test_settings_view_renders(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('settings.index'));

        $response->assertStatus(200);
        $response->assertViewIs('settings.index');
    }

    /**
     * Test project card has proper link
     */
    public function test_project_card_has_proper_link(): void
    {
        $project = Project::factory()->create([
            'owner_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('projects.overview'));

        $response->assertStatus(200);
        $response->assertSee(route('projects.show', $project));
    }

    /**
     * Test calendar navigation links work
     */
    public function test_calendar_navigation_links_work(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('calendar.index'));

        $response->assertStatus(200);
        $response->assertSee(route('calendar.index', ['month' => now()->subMonth()->format('Y-m')]));
        $response->assertSee(route('calendar.index', ['month' => now()->addMonth()->format('Y-m')]));
    }

    /**
     * Test views with data relationships
     */
    public function test_views_with_data_relationships(): void
    {
        // Create a project with tasks
        $project = Project::factory()->create([
            'owner_id' => $this->user->id,
        ]);

        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'project_id' => $project->id,
        ]);

        // Test project show view with tasks
        $response = $this->actingAs($this->user)
            ->get(route('projects.show', $project));

        $response->assertStatus(200);
        $response->assertSee($task->title);
    }
}
