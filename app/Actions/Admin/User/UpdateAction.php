<?php

namespace App\Actions\Admin\User;

use App\Contracts\Actions\Admin\User\UpdateActionContract;
use App\Models\User;
use App\Services\Admin\User\PasswordFieldHandler;

class UpdateAction implements UpdateActionContract
{
    public function __invoke(User $user, array $data): User
    {
        $data = PasswordFieldHandler::handle($data);

        $user->update($data);

        return $user;
    }
}
