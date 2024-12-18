<?php

namespace App\Http\Controllers\Api\ProjectUserLike;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Response;

class ToggleController extends Controller
{
    public function __invoke(Project $project): Response
    {
        $project->likes()->toggle(auth()->id());

        return response()->noContent();
    }
}
