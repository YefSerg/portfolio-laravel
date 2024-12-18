<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CreateController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $categories = Category::all();

        return view('admin.project.create', compact('categories'));
    }
}
