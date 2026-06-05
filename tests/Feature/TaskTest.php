<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_tasks(): void
    {
        $this->get('/tasks')->assertRedirect('/login');
        $this->get('/tasks/create')->assertRedirect('/login');
        $this->post('/tasks', ['title' => 'Sample Task'])->assertRedirect('/login');
        $this->get('/tasks/1')->assertRedirect('/login');
        $this->get('/tasks/1/edit')->assertRedirect('/login');
        $this->put('/tasks/1', ['title' => 'Updated Task'])->assertRedirect('/login');
        $this->delete('/tasks/1')->assertRedirect('/login');
    }

    public function test_user_can_view_own_tasks_list(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $userTask = Task::create([
            'user_id' => $user->id,
            'title' => 'My Secret Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $otherTask = Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Other User Task',
            'priority' => 'High',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get('/tasks');

        $response->assertOk();
        $response->assertSee('My Secret Task');
        $response->assertDontSee('Other User Task');
    }

    public function test_user_can_access_create_task_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tasks/create');

        $response->assertOk();
        $response->assertSee('Create Task');
    }

    public function test_user_can_create_task_with_valid_data(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'user_id' => $user->id,
            'name' => 'Work',
        ]);

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'New Task',
            'description' => 'Task description here',
            'category_id' => $category->id,
            'priority' => 'Medium',
            'status' => 'Pending',
            'due_date' => '2026-06-10',
        ]);

        $response->assertRedirect('/tasks');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'New Task',
            'description' => 'Task description here',
            'category_id' => $category->id,
            'priority' => 'Medium',
            'status' => 'Pending',
            'due_date' => '2026-06-10',
        ]);
    }

    public function test_task_creation_validation_rules(): void
    {
        $user = User::factory()->create();

        // Title required
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => '',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);
        $response->assertSessionHasErrors('title');

        // Priority validation
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Task 1',
            'priority' => 'SuperHigh',
            'status' => 'Pending',
        ]);
        $response->assertSessionHasErrors('priority');

        // Status validation
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Task 1',
            'priority' => 'Medium',
            'status' => 'Done',
        ]);
        $response->assertSessionHasErrors('status');

        // Due date validation
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Task 1',
            'priority' => 'Medium',
            'status' => 'Pending',
            'due_date' => 'not-a-date',
        ]);
        $response->assertSessionHasErrors('due_date');
    }

    public function test_user_cannot_assign_other_users_category_to_task(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $otherCategory = Category::create([
            'user_id' => $otherUser->id,
            'name' => 'Stolen Category',
        ]);

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Hack Task',
            'category_id' => $otherCategory->id,
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response->assertSessionHasErrors('category_id');
        $this->assertDatabaseMissing('tasks', [
            'title' => 'Hack Task',
        ]);
    }

    public function test_user_can_view_own_task_details(): void
    {
        $user = User::factory()->create();
        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Show Detail Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get("/tasks/{$task->id}");

        $response->assertOk();
        $response->assertSee('Show Detail Task');
        $response->assertSee('Task Details');
    }

    public function test_user_cannot_view_other_users_task_details(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Secret Task Detail',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get("/tasks/{$task->id}");

        $response->assertStatus(403);
    }

    public function test_user_can_access_edit_task_page_for_own_task(): void
    {
        $user = User::factory()->create();
        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Editable Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get("/tasks/{$task->id}/edit");

        $response->assertOk();
        $response->assertSee('Edit Task');
        $response->assertSee('Editable Task');
    }

    public function test_user_cannot_access_edit_task_page_for_other_users_task(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Untouchable Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get("/tasks/{$task->id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_can_update_own_task(): void
    {
        $user = User::factory()->create();
        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Old Task Title',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'New Task Title',
            'priority' => 'High',
            'status' => 'Completed',
        ]);

        $response->assertRedirect('/tasks');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'New Task Title',
            'priority' => 'High',
            'status' => 'Completed',
        ]);
    }

    public function test_user_cannot_update_other_users_task(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Original Task Title',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'Hacked Task Title',
            'priority' => 'High',
            'status' => 'Completed',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Original Task Title',
        ]);
    }

    public function test_user_can_delete_own_task(): void
    {
        $user = User::factory()->create();
        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Disposable Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertRedirect('/tasks');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_user_cannot_delete_other_users_task(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Important Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_guest_cannot_toggle_task_status(): void
    {
        $this->patch('/tasks/1/complete')->assertRedirect('/login');
        $this->patch('/tasks/1/pending')->assertRedirect('/login');
    }

    public function test_user_can_toggle_own_task_status(): void
    {
        $user = User::factory()->create();
        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Sample Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        // Toggle to Complete
        $response = $this->actingAs($user)->patch("/tasks/{$task->id}/complete");
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertSame('Completed', $task->refresh()->status);

        // Toggle back to Pending
        $response = $this->actingAs($user)->patch("/tasks/{$task->id}/pending");
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertSame('Pending', $task->refresh()->status);
    }

    public function test_user_cannot_toggle_other_users_task_status(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Sample Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->patch("/tasks/{$task->id}/complete");
        $response->assertStatus(403);
        $this->assertSame('Pending', $task->refresh()->status);
    }

    public function test_user_can_search_tasks_by_title(): void
    {
        $user = User::factory()->create();

        Task::create([
            'user_id' => $user->id,
            'title' => 'Read Larabook',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Code PHP 8',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get('/tasks?search=Larabook');
        $response->assertOk();
        $response->assertSee('Read Larabook');
        $response->assertDontSee('Code PHP 8');
    }

    public function test_user_can_filter_tasks_by_status(): void
    {
        $user = User::factory()->create();

        Task::create([
            'user_id' => $user->id,
            'title' => 'Pending Task',
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Completed Task',
            'priority' => 'Medium',
            'status' => 'Completed',
        ]);

        $response = $this->actingAs($user)->get('/tasks?status=Completed');
        $response->assertOk();
        $response->assertSee('Completed Task');
        $response->assertDontSee('Pending Task');
    }

    public function test_user_can_filter_tasks_by_priority(): void
    {
        $user = User::factory()->create();

        Task::create([
            'user_id' => $user->id,
            'title' => 'High Priority Task',
            'priority' => 'High',
            'status' => 'Pending',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Low Priority Task',
            'priority' => 'Low',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get('/tasks?priority=High');
        $response->assertOk();
        $response->assertSee('High Priority Task');
        $response->assertDontSee('Low Priority Task');
    }

    public function test_user_can_filter_tasks_by_category(): void
    {
        $user = User::factory()->create();

        $cat1 = Category::create(['user_id' => $user->id, 'name' => 'Work']);
        $cat2 = Category::create(['user_id' => $user->id, 'name' => 'Home']);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Work Task',
            'category_id' => $cat1->id,
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Home Task',
            'category_id' => $cat2->id,
            'priority' => 'Medium',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($user)->get('/tasks?category_id='.$cat1->id);
        $response->assertOk();
        $response->assertSee('Work Task');
        $response->assertDontSee('Home Task');
    }

    public function test_user_can_filter_overdue_tasks(): void
    {
        $user = User::factory()->create();

        // Overdue (Pending & due date < today)
        Task::create([
            'user_id' => $user->id,
            'title' => 'Overdue Task',
            'priority' => 'Medium',
            'status' => 'Pending',
            'due_date' => today()->subDays(1)->toDateString(),
        ]);

        // Pending but not overdue (due date tomorrow)
        Task::create([
            'user_id' => $user->id,
            'title' => 'Tomorrow Task',
            'priority' => 'Medium',
            'status' => 'Pending',
            'due_date' => today()->addDays(1)->toDateString(),
        ]);

        // Completed and past due date (not overdue)
        Task::create([
            'user_id' => $user->id,
            'title' => 'Completed Past Due Task',
            'priority' => 'Medium',
            'status' => 'Completed',
            'due_date' => today()->subDays(1)->toDateString(),
        ]);

        $response = $this->actingAs($user)->get('/tasks?overdue=1');
        $response->assertOk();
        $response->assertSee('Overdue Task');
        $response->assertDontSee('Tomorrow Task');
        $response->assertDontSee('Completed Past Due Task');
    }
}
