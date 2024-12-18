<?php

namespace Tests\Feature\Controllers\Admin\User;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\UserRoles;
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
    public function test_response_for_route_admin_user_show_with_view_admin_user_show(): void
    {
        $this->withoutDeprecationHandling();

        $authUser = User::factory()->create(['role' => UserRoles::SUPER_ADMIN]);
        $user = User::factory()->create();

        $response = $this->actingAs($authUser)->get(route('admin.user.show', $user));

        $response->assertStatus(200);
        $response->assertViewIs('admin.user.show');
        $response->assertViewHas('user', $user);
        $response->assertSee('Show user');
        $response->assertSee($user->id);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }
}
