<?php

namespace Tests\Feature\Controllers\Admin\Main;

use App\Enums\UserRoles;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_index_with_view_admin_main_index(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);

        $response = $this->actingAs($user)->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.main.index');
    }
}
