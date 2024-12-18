<?php

namespace Tests\Feature\Controllers\Admin\User;

use App\Enums\UserRoles;
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
    public function test_response_for_route_admin_user_edit_with_view_admin_user_edit(): void
    {
        $this->withoutDeprecationHandling();

        $authUser = User::factory()->create(['role' => UserRoles::SUPER_ADMIN]);
        $user = User::factory()->create();

        $response = $this->actingAs($authUser)->get(route('admin.user.edit', compact('user')));

        $response->assertOk();
        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertViewIs('admin.user.edit');
    }
}
