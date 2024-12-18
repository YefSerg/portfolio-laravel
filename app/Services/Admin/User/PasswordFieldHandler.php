<?php

namespace App\Services\Admin\User;

use Illuminate\Support\Facades\Hash;

class PasswordFieldHandler
{
    public static function handle(array $data): array
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return self::changeToHashFieldPasswordIfExist($data);
    }

    public static function changeToHashFieldPasswordIfExist(array $data): array
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}
