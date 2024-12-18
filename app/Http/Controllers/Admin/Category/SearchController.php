<?php

namespace App\Http\Controllers\Admin\Category;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\SearchRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): Application|Factory|View
    {
        $data = $request->validated();

        $categories = Category::query()
            ->whereFullText('title', $data['search'])
            ->orderByDesc('created_at')
            ->paginate(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)
            ->withQueryString();

        return view('admin.category.index', compact('categories'));
    }
}
