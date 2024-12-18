<?php

namespace App\Http\Controllers\Admin\Category;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class IndexController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $categories = Category::query()->paginate(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value);

        return view('admin.category.index', compact('categories'));
    }
}
