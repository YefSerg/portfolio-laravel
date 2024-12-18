<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EditController extends Controller
{
    public function __invoke(Project $project): Application|Factory|View
    {
        $categories = Category::all();

        return view('admin.project.edit', compact('project', 'categories'));
    }
}
