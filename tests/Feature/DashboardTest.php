<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_user_can_view_dashboard_with_correct_statistics(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'user_id' => $user->id,
            'name' => 'Work',
        ]);

        // Create 2 completed tasks
        Task::create([
            'user_id' => $user->id,
            'title' => 'Completed Task 1',
            'status' => 'Completed',
            'priority' => 'Medium',
        ]);
        Task::create([
            'user_id' => $user->id,
            'title' => 'Completed Task 2',
            'status' => 'Completed',
            'priority' => 'Medium',
        ]);

        // Create 1 pending task (not overdue)
        Task::create([
            'user_id' => $user->id,
            'title' => 'Pending Task',
            'status' => 'Pending',
            'priority' => 'Medium',
            'due_date' => today()->addDays(5)->toDateString(),
        ]);

        // Create 1 overdue task (pending and due date < today)
        Task::create([
            'user_id' => $user->id,
            'title' => 'Overdue Task',
            'status' => 'Pending',
            'priority' => 'High',
            'due_date' => today()->subDays(2)->toDateString(),
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Welcome back, '.$user->name);
        $response->assertSee('50% Complete');
        $response->assertSee('Completed Task 1');
        $response->assertSee('Completed Task 2');
        $response->assertSee('Pending Task');
        $response->assertSee('Overdue Task');
    }

    public function test_dashboard_does_not_display_other_users_tasks(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Task::create([
            'user_id' => $user->id,
            'title' => 'My Task',
            'status' => 'Pending',
            'priority' => 'Medium',
        ]);

        Task::create([
            'user_id' => $otherUser->id,
            'title' => 'Other User Task',
            'status' => 'Pending',
            'priority' => 'Medium',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('My Task');
        $response->assertDontSee('Other User Task');
    }
}
