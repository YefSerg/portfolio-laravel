<?php

namespace App\Contracts\Actions\Admin\User;
use App\Models\User;

interface UpdateActionContract
{
    public function __invoke(User $user, array $data): User;
}
