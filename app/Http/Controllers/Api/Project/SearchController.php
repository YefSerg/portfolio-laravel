<?php

namespace App\Http\Controllers\Api\Project;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\SearchRequest;
use App\Http\Resources\Api\Project\MainResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $projects = Project::query()
            ->whereFullText(['title', 'description'], $data['search'])
            ->orderByDesc('created_at')
            ->paginate(PageSettings::API_QUANTITY_ITEMS_PER_PAGE->value)
            ->withQueryString();

        return MainResource::collection($projects);
    }
}
