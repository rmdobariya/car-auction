<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userStatusCheck
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->user() &&
            (string) Auth::guard('web')->user()->status === 'active' &&
            Auth::guard('web')->check()) {
            return $next($request);
        } elseif (Auth::guard('web')->user() &&
            (string) Auth::guard('web')->user()->status === 'inActive') {
            // Return JSON response to signal a reload
            return response()->json(['message' => 'Your account is inactive.please contact to admin']);
        }

        return response()->json(['message' => 'Your account is inactive.please contact to admin']);
    }

}
