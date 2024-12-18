<?php

namespace Tests\Feature\Controllers\Admin\User;

use App\Enums\UserRoles;
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
    public function test_response_for_route_admin_user_destroy(): void
    {
        $this->withoutDeprecationHandling();

        $authUser = User::factory()->create(['role' => UserRoles::SUPER_ADMIN]);
        $user = User::factory()->create();

        $response = $this->actingAs($authUser)->delete(route('admin.user.destroy', $user));

        $response->assertFound();
        $response->assertRedirect(route('admin.user.index'));

        $this->assertSoftDeleted($user);
    }
}
