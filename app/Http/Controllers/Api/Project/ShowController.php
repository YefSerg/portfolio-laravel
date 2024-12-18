<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\ShowResource;
use App\Models\Project;

class ShowController extends Controller
{
    public function __invoke(Project $project): ShowResource
    {
        return ShowResource::make($project);
    }
}
