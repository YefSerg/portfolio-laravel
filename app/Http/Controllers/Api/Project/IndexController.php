<?php

namespace App\Http\Controllers\Api\Project;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\MainResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $projects = Project::query()->paginate(PageSettings::API_QUANTITY_ITEMS_PER_PAGE->value);

        return MainResource::collection($projects);
    }
}
