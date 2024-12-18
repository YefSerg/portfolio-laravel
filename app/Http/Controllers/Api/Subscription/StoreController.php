<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subscription\StoreRequest;
use App\Models\Subscription;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): ResponseFactory|Application|Response
    {
        $data = $request->validated();
        Subscription::query()->create($data);

        return response(null, ResponseAlias::HTTP_CREATED);
    }
}
