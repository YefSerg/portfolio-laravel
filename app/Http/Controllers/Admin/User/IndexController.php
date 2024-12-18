<?php

namespace App\Http\Controllers\Admin\User;

use App\Enums\PageSettings;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class IndexController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $users = User::query()->paginate(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value);

        return view('admin.user.index', compact('users'));
    }
}
