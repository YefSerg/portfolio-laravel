<?php

namespace Tests\Feature\Actions\Admin\User;

use App\Contracts\Actions\Admin\User\StoreActionContract;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_store_user_action(): void
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 'password';

        $action = app(StoreActionContract::class);
        $action($data);

        unset($data['password'], $data['email_verified_at']);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', $data);
    }
}
