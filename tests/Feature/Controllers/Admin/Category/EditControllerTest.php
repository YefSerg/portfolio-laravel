<?php

namespace Tests\Feature\Controllers\Admin\Category;

use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EditControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_category_edit_with_view_admin_category_edit(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.edit', compact('category')));

        $response->assertOk();
        $response->assertSee($category->title);
        $response->assertViewIs('admin.category.edit');
    }
}
