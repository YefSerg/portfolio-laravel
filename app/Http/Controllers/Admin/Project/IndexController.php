<?php

namespace App\Http\Controllers\Admin\Project;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class IndexController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $projects = Project::query()->paginate(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value);

        return view('admin.project.index', compact('projects'));
    }
}
