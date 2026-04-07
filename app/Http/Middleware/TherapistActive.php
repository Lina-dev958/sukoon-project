<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistActive
{
    public function handle(Request $request, Closure $next)
    {
        // ❌ أضيفي هذا السطر للحماية
        if (!Auth::check()) {
            return $next($request);
        }
    
        $user = Auth::user();
    
        // ✅ تأكد إنه therapist فقط
        if ($user->role === 'therapist') {
    
            // إذا ما عنده status أو مش active
            if ($user->status !== 'active') {
                return redirect()->route('pending.notice');
            }
        }
    
        return $next($request);
    }
}