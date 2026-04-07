<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            if (str_contains($request->path(), 'admin')) {
                return redirect()->route('admin.login');
            }

            if (str_contains($request->path(), 'therapist')) {
                return redirect()->route('therapist.login');
            }

            return redirect()->route('patient.login');
        }
        if (Auth::user()->role !== $role) {
            abort(403, "ليس لديك صلاحية الدخول لهذه الصفحة");
        }

        return $next($request);
    }
}