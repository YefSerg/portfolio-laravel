<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LogInRequest;
use App\Http\Resources\Api\User\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogInController extends Controller
{
    public function __invoke(LogInRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (Auth::guard('api-user')->attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(new AuthResource($request->user('api-user')), Response::HTTP_CREATED);
        }

        return response()->json(
            ['email' => 'The provided credentials do not match our records.'],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
