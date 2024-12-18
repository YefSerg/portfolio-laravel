<?php

namespace Tests\Feature\Services\Admin\User;

use App\Services\Admin\User\PasswordFieldHandler;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordFieldHandlerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testHandlePasswordField(): void
    {
        $data = ['name' => 'user 1', 'password' => 'password'];
        $newData = PasswordFieldHandler::handle($data);
        $this->assertTrue(Hash::check($data['password'], $newData['password']));

        $data['password'] = '';
        $newData = PasswordFieldHandler::handle($data);
        unset($data['password']);
        $this->assertSame($data, $newData);
    }

    public function testChangeToHashFieldPasswordIfExist(): void
    {
        $this->withoutExceptionHandling();

        $data = ['name' => 'user 1', 'password' => 'password'];
        $newData = PasswordFieldHandler::changeToHashFieldPasswordIfExist($data);
        $this->assertTrue(Hash::check($data['password'], $newData['password']));

        unset($data['password']);
        $newData = PasswordFieldHandler::changeToHashFieldPasswordIfExist($data);
        $this->assertSame($data, $newData);
    }
}
