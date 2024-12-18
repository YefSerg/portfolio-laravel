<?php

namespace Tests\Feature\Controllers\Admin\User;

use App\Enums\UserRoles;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $authUser;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authUser = User::factory()->create(['role' => UserRoles::SUPER_ADMIN]);
        $this->user = User::factory()->create();
    }

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_user_update(): void
    {
        $this->withoutDeprecationHandling();

        $data = [
            'name' => 'Test User',
            'role' => UserRoles::ADMIN->value,
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->actingAs($this->authUser)->patch(route('admin.user.update', ['user' => $this->user]), $data);
        $response->assertFound();
        $response->assertRedirect(route('admin.user.show', $this->user));

        unset($data['password']);

        $this->assertDatabaseHas('users', $data);
        $this->assertDatabaseCount('users', 2);
    }

    public function test_validation_for_update_user_fails(): void
    {
        $data = [
            [
                'name' => null,
                'email' => null,
                'password' => '111',
            ],
            [
                'name' => null,
                'email' => Str::random(255).'@example.com',
                'password' => 'null',
            ],
            [
                'name' => Str::random(256),
                'email' => Str::random(256),
                'password' => '1111111',
            ],
        ];

        foreach ($data as $item) {
            $response = $this->actingAs($this->authUser)->patch(route('admin.user.update', $this->user), $item);

            $keys = array_keys($item);

            $response->assertSessionHasErrors($keys);
            $response->assertRedirect();
            $response->assertInvalid($keys);

            $this->assertDatabaseMissing('users', $item);
        }
    }

    public function test_validation_for_update_user_unique_email_fails(): void
    {
        $user2 = User::factory()->create();
        $data = User::factory()->make()->toArray();
        $data['email'] = $user2->email;

        $response = $this->actingAs($this->authUser)->patch(route('admin.user.update', $this->user), $data);
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect();
        $response->assertInvalid(['email']);

        $this->assertDatabaseCount('users', 3);
    }
}
