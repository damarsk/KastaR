<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)  // Ubah parameter menjadi variadic
    {
        $userLevel = (int) Auth::user()->level;

        if (!in_array($userLevel, array_map('intval', $roles))) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}