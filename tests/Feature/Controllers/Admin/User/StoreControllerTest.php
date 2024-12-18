<?php

namespace Tests\Feature\Controllers\Admin\User;

use App\Enums\UserRoles;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $authUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authUser = User::factory()->create(['role' => UserRoles::SUPER_ADMIN]);
    }

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_user_store(): void
    {
        $this->withoutDeprecationHandling();

        $data = [
            'name' => 'Test User',
            'role' => UserRoles::ADMIN->value,
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        $response = $this->actingAs($this->authUser)->post(route('admin.user.store'), $data);

        $response->assertFound();
        $response->assertRedirect(route('admin.user.index'));

        unset($data['password'], $data['password_confirmation']);

        $this->assertDatabaseHas('users', $data);
        $this->assertDatabaseCount('users', 2);
    }

    public function test_validation_for_store_user_fails(): void
    {
        $data = [
            [
                'name' => null,
                'email' => null,
                'password' => Str::random(9),
            ],
            [
                'name' => null,
                'email' => null,
                'password' => null,
                'password_confirmation' => null,
            ],
            [
                'name' => null,
                'email' => Str::random(255).'@example.com',
                'password' => 'password',
                'password_confirmation' => 'password_confirmation',
            ],
            [
                'name' => Str::random(256),
                'email' => Str::random(256),
                'password' => '1111111',
                'password_confirmation' => '1111111',
            ],
        ];

        foreach ($data as $item) {
            $response = $this->actingAs($this->authUser)->post(route('admin.user.store'), $item);

            unset($item['password_confirmation']);

            $keys = array_keys($item);

            $response->assertSessionHasErrors($keys);
            $response->assertRedirect();
            $response->assertInvalid($keys);

            $this->assertDatabaseMissing('users', $item);
        }
    }

    public function test_validation_for_store_user_unique_email_fails(): void
    {
        $data = ['email' => 'email@email.com'];

        $user = User::factory()->create($data);
        $data = User::factory()->make()->toArray();
        $data['email'] = $user->email;

        $response = $this->actingAs($this->authUser)->post(route('admin.user.store'), $data);
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect();
        $response->assertInvalid(['email']);

        $this->assertDatabaseCount('users', 2);
    }
}
