<?php

namespace App\Http\Controllers\Admin\User;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EditController extends Controller
{
    public function __invoke(User $user): Application|Factory|View
    {
        $roles = UserRoles::cases();

        return view('admin.user.edit', compact('user', 'roles'));
    }
}
