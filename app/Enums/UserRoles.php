<?php

namespace App\Enums;

enum UserRoles: int
{
    case USER = 1;
    case ADMIN = 2;
    case SUPER_ADMIN = 3;

    public function getLabel(): string
    {
        return match ($this) {
            UserRoles::USER => 'User',
            UserRoles::ADMIN => 'Admin',
            UserRoles::SUPER_ADMIN => 'Super Admin',
        };
    }
}
