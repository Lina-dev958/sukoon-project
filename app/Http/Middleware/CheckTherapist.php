<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role === 'therapist') {
            $therapist = $user->therapist()->first();

            if (!$therapist || $therapist->verification_status !== 'approved') {
                return redirect()->route('pending.notice');
            }
        }

        return $next($request);
    }
}