<?php

namespace App\Http\Controllers\Admin\Project;

use App\Contracts\Actions\Admin\Project\DestroyActionContract;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{
    public function __invoke(Project $project, DestroyActionContract $action): RedirectResponse
    {
        $action($project);

        return redirect()->route('admin.project.index');
    }
}
