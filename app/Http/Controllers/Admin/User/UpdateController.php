<?php

namespace App\Http\Controllers\Admin\User;

use App\Contracts\Actions\Admin\User\UpdateActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user, UpdateActionContract $action): RedirectResponse
    {
        $data = $request->validated();
        $user = $action($user, $data);

        return redirect()->route('admin.user.show', compact('user'));
    }
}
