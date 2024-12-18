<?php

namespace App\Http\Controllers\Admin\Project;

use App\Actions\Admin\Project\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $data = $request->validated();
        $action($data);

        return redirect()->route('admin.project.index');
    }
}
