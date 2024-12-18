<?php

namespace App\Contracts\Actions\Admin\User;

interface StoreActionContract
{
    public function __invoke(array $data): void;
}
