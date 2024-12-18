<?php

namespace App\Http\Controllers\Admin\Project;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\SearchRequest;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): Application|Factory|View
    {
        $data = $request->validated();

        $projects = Project::query()
            ->whereFullText(['title', 'description'], $data['search'])
            ->orderByDesc('created_at')
            ->paginate(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)
            ->withQueryString();

        return view('admin.project.index', compact('projects'));
    }
}
