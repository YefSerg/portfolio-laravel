<?php

namespace Tests\Feature\Controllers\Admin\Category;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_category_show_with_view_admin_category_show(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.show', $category));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.show');
        $response->assertViewHas('category', $category);
        $response->assertSee('Show category');
        $response->assertSee($category->title);
    }
}
