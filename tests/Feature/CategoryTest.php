<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_categories(): void
    {
        $this->get('/categories')->assertRedirect('/login');
        $this->get('/categories/create')->assertRedirect('/login');
        $this->post('/categories', ['name' => 'Work'])->assertRedirect('/login');
        $this->get('/categories/1/edit')->assertRedirect('/login');
        $this->put('/categories/1', ['name' => 'Work'])->assertRedirect('/login');
        $this->delete('/categories/1')->assertRedirect('/login');
    }

    public function test_user_can_view_own_categories_list(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $userCategory = Category::create([
            'user_id' => $user->id,
            'name' => 'My Work Category',
        ]);

        $otherCategory = Category::create([
            'user_id' => $otherUser->id,
            'name' => 'Other Work Category',
        ]);

        $response = $this->actingAs($user)->get('/categories');

        $response->assertOk();
        $response->assertSee('My Work Category');
        $response->assertDontSee('Other Work Category');
    }

    public function test_user_can_access_create_category_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/categories/create');

        $response->assertOk();
        $response->assertSee('Create Category');
    }

    public function test_user_can_create_category_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'name' => 'Personal Category',
        ]);

        $response->assertRedirect('/categories');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categories', [
            'user_id' => $user->id,
            'name' => 'Personal Category',
        ]);
    }

    public function test_category_creation_validation_rules(): void
    {
        $user = User::factory()->create();

        // Required name validation
        $response = $this->actingAs($user)->post('/categories', [
            'name' => '',
        ]);
        $response->assertSessionHasErrors('name');

        // Max length validation (100 characters)
        $response = $this->actingAs($user)->post('/categories', [
            'name' => str_repeat('a', 101),
        ]);
        $response->assertSessionHasErrors('name');
    }

    public function test_user_can_access_edit_category_page_for_own_category(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'user_id' => $user->id,
            'name' => 'Urgent Tasks',
        ]);

        $response = $this->actingAs($user)->get("/categories/{$category->id}/edit");

        $response->assertOk();
        $response->assertSee('Edit Category');
        $response->assertSee('Urgent Tasks');
    }

    public function test_user_cannot_access_edit_category_page_for_other_users_category(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::create([
            'user_id' => $otherUser->id,
            'name' => 'Secret Category',
        ]);

        $response = $this->actingAs($user)->get("/categories/{$category->id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_can_update_own_category(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'user_id' => $user->id,
            'name' => 'Old Name',
        ]);

        $response = $this->actingAs($user)->put("/categories/{$category->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertRedirect('/categories');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_cannot_update_other_users_category(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::create([
            'user_id' => $otherUser->id,
            'name' => 'Original Name',
        ]);

        $response = $this->actingAs($user)->put("/categories/{$category->id}", [
            'name' => 'Hacked Name',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Original Name',
        ]);
    }

    public function test_user_can_delete_own_category(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'user_id' => $user->id,
            'name' => 'Disposable Category',
        ]);

        $response = $this->actingAs($user)->delete("/categories/{$category->id}");

        $response->assertRedirect('/categories');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_user_cannot_delete_other_users_category(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::create([
            'user_id' => $otherUser->id,
            'name' => 'Protected Category',
        ]);

        $response = $this->actingAs($user)->delete("/categories/{$category->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);
    }
}
