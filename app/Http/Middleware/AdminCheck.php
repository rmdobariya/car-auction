<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{

    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->user() &&
            (string)Auth::guard('admin')->user()->status === 'active' &&
            Auth::guard('admin')->check()) {
            \App::setLocale(Auth::guard('admin')->user()->locale);

            $locale = \App::getLocale();
            return $next($request);
        } else if (Auth::guard('admin')->user() &&
            (string)Auth::guard('admin')->user()->status === 'inActive') {
            return redirect()->route('admin.account-deactivate');
        }
        $locale = 'en';

        return redirect()->route('admin.login');

    }
}
