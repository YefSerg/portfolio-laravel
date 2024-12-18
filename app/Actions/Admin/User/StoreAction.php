<?php

namespace App\Actions\Admin\User;

use App\Contracts\Actions\Admin\User\StoreActionContract;
use App\Models\User;
use App\Services\Admin\User\PasswordFieldHandler;

class StoreAction implements StoreActionContract
{
    public function __invoke(array $data): void
    {
        $data = PasswordFieldHandler::changeToHashFieldPasswordIfExist($data);
        User::create($data);
    }
}
