<?php

namespace App\Http\Middleware\Admin;

use App\Enums\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, int $role): Response
    {
        if ($this->isRole($request, $role) || $this->isSuperAdmin($request)) {
            return $next($request);
        }
        abort(Response::HTTP_FORBIDDEN);
    }

    private function isRole(Request $request, int $role): bool
    {
        return $request->user()->role->value === $role;
    }

    private function isSuperAdmin(Request $request): bool
    {
        return $request->user()->role->value === UserRoles::SUPER_ADMIN->value;
    }
}
