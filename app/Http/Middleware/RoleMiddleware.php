<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        if (!in_array($user->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
