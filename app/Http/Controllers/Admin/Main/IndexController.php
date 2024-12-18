<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class IndexController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $entities = [
            'category' => [
                'title' => 'Categories',
                'color' => 'green',
                'count' => Category::all()->count(),
            ],
            'project' => [
                'title' => 'Projects',
                'color' => 'blue',
                'count' => Project::all()->count(),
            ],
            'user' => [
                'title' => 'Users',
                'color' => 'pink',
                'count' => User::all()->count(),
            ],
        ];

        return view('admin.main.index', compact('entities'));
    }
}
