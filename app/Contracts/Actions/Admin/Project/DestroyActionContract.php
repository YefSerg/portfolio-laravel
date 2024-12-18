<?php

namespace App\Contracts\Actions\Admin\Project;

use App\Models\Project;

interface DestroyActionContract
{
    public function __invoke(Project $project): void;
}
