<?php

namespace App\Contracts\Actions\Admin\Project;

use App\Models\Project;

interface StoreActionContract
{
    public function __invoke(array $data): Project;
}
