<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
    }

    public function test_authenticated_user_can_see_only_their_own_tasks(): void
    {
        $task1 = Task::factory()->create(['owner_id' => $this->user->id]);
        $task2 = Task::factory()->create(['owner_id' => $this->otherUser->id]);

        $response = $this->actingAs($this->user)->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee($task1->title);
        $response->assertDontSee($task2->title);
    }

    public function test_authenticated_user_can_create_task(): void
    {
        $response = $this->actingAs($this->user)
            ->post('/tasks', [
                'title' => 'Test Task',
            ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'owner_id' => $this->user->id,
        ]);
    }

    public function test_task_creation_requires_title(): void
    {
        $response = $this->actingAs($this->user)
            ->post('/tasks', [
                'title' => '',
            ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_authenticated_user_can_update_own_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->put("/tasks/{$task->id}", [
                'title' => 'Updated Title',
            ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_user_cannot_update_other_users_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->otherUser->id]);

        $response = $this->actingAs($this->user)
            ->put("/tasks/{$task->id}", [
                'title' => 'Updated Title',
            ]);

        $response->assertStatus(403);
    }

    public function test_authenticated_user_can_delete_own_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->delete("/tasks/{$task->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_user_cannot_delete_other_users_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->otherUser->id]);

        $response = $this->actingAs($this->user)
            ->delete("/tasks/{$task->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_user_can_toggle_task_status_to_completed(): void
    {
        $task = Task::factory()->create([
            'owner_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user)
            ->patch("/tasks/{$task->id}/toggle-status");

        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'completed',
        ]);
    }

    public function test_user_can_toggle_task_status_to_pending(): void
    {
        $task = Task::factory()->create([
            'owner_id' => $this->user->id,
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $response = $this->actingAs($this->user)
            ->patch("/tasks/{$task->id}/toggle-status");

        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'pending',
        ]);
        $this->assertNull($task->fresh()->completed_at);
    }

    public function test_user_cannot_toggle_other_users_task_status(): void
    {
        $task = Task::factory()->create([
            'owner_id' => $this->otherUser->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user)
            ->patch("/tasks/{$task->id}/toggle-status");

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'pending',
        ]);
    }

    public function test_user_can_view_own_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->get("/tasks/{$task->id}");

        $response->assertStatus(200);
        $response->assertSee($task->title);
    }

    public function test_user_cannot_view_other_users_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->otherUser->id]);

        $response = $this->actingAs($this->user)
            ->get("/tasks/{$task->id}");

        $response->assertStatus(403);
    }

    public function test_user_can_edit_own_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->get("/tasks/{$task->id}/edit");

        $response->assertStatus(200);
    }

    public function test_user_cannot_edit_other_users_task(): void
    {
        $task = Task::factory()->create(['owner_id' => $this->otherUser->id]);

        $response = $this->actingAs($this->user)
            ->get("/tasks/{$task->id}/edit");

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_access_tasks(): void
    {
        $response = $this->get('/tasks');
        $response->assertRedirect('/login');
    }
}
