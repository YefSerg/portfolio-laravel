<?php

namespace App\Http\Controllers\EmailVerification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class NoticeController extends Controller
{
    public function __invoke(): Response
    {
        return response()->noContent();
    }
}
