<?php

namespace App\Http\Controllers\Admin\Project;

use App\Contracts\Actions\Admin\Project\UpdateActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\UpdateRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Project $project, UpdateActionContract $action): RedirectResponse
    {
        $data = $request->validated();
        $project = $action($project, $data);

        return redirect()->route('admin.project.show', ['project' => $project]);
    }
}
