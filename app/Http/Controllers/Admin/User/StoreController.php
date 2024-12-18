<?php

namespace App\Http\Controllers\Admin\User;

use App\Contracts\Actions\Admin\User\StoreActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, StoreActionContract $action): RedirectResponse
    {
        $data = $request->validated();
        $action($data);

        return redirect()->route('admin.user.index');
    }
}
