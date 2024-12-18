<?php

namespace Tests\Feature\Controllers\Admin\User;

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
    public function test_response_for_route_admin_user_create_with_view_admin_user_create(): void
    {
        $this->withoutDeprecationHandling();

        $authUser = User::factory()->create(['role' => UserRoles::SUPER_ADMIN]);

        $response = $this->actingAs($authUser)->get(route('admin.user.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.user.create');
    }
}
