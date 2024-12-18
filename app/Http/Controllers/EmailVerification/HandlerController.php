<?php

namespace App\Http\Controllers\EmailVerification;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Response;

class HandlerController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): Response
    {
        $request->fulfill();

        return response()->noContent();
    }
}
