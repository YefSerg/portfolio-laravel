<?php

namespace App\Contracts\Actions\Admin\Project;

use App\Models\Project;

interface UpdateActionContract
{
    public function __invoke(Project $project, array $data): Project;
}
