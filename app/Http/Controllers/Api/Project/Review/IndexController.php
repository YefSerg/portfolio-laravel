<?php

namespace App\Http\Controllers\Api\Project\Review;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\Review\MainResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(Project $project): AnonymousResourceCollection
    {
        $reviews = $project
            ->reviews()
            ->with(['user'])
            ->orderByDesc('created_at')
            ->paginate(PageSettings::API_QUANTITY_ITEMS_PER_PAGE->value);

        return MainResource::collection($reviews);
    }
}
