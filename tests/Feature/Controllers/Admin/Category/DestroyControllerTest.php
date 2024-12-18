<?php

namespace Tests\Feature\Controllers\Admin\Category;

use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_category_destroy(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.category.destroy', $category));

        $response->assertFound();
        $response->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseCount('categories', 0);
        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
