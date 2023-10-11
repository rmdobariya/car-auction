<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class WebsiteLanguageCheck
{
    public function handle($request, Closure $next)
    {
        App::setLocale('en');
        if ((string)session('locale') === 'ar') {
            App::setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
