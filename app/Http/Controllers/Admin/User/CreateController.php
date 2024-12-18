<?php

namespace App\Http\Controllers\Admin\User;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CreateController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $roles = UserRoles::cases();

        return view('admin.user.create', compact('roles'));
    }
}
