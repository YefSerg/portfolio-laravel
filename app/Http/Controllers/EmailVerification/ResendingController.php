<?php

namespace App\Http\Controllers\EmailVerification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResendingController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->noContent();
    }
}
