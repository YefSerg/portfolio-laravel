<?php

namespace Tests\Feature\Controllers\Admin\Project;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_create_with_view_admin_project_create(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $categories = Category::factory(10)->create();

        $response = $this->actingAs($user)->get(route('admin.project.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.project.create');
        $response->assertViewHas('categories', $categories);
        $response->assertSee('Create project');
        $response->assertSeeInOrder($categories->pluck('title')->toArray());
    }
}
