<?php

namespace Tests\Feature\Actions\Admin\User;

use App\Contracts\Actions\Admin\User\UpdateActionContract;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_update_user_action(): void
    {
        $user = User::factory()->create();
        $data = User::factory()->make()->toArray();
        $data['password'] = 'password';

        $action = app(UpdateActionContract::class);
        $action($user, $data);

        unset($data['password'], $data['email_verified_at']);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', $data);
    }
}
