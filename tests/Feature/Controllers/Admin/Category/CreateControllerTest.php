<?php

namespace Tests\Feature\Controllers\Admin\Category;

use App\Enums\UserRoles;
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
    public function test_response_for_route_admin_category_create_with_view_admin_category_create(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);

        $response = $this->actingAs($user)->get(route('admin.category.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.create');
    }
}
