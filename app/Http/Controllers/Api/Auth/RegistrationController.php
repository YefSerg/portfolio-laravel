<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Http\Resources\Api\User\AuthResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegistrationController extends Controller
{
    public function __invoke(RegistrationRequest $request): JsonResponse
    {
        $data = $request->safe()->except('role');
        $user = User::create($data);

        event(new Registered($user));
        auth('api-user')->login($user);

        return response()->json(new AuthResource($user), ResponseAlias::HTTP_CREATED);
    }
}
