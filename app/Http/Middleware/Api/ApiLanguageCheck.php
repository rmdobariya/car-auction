<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Support\Facades\App;

class ApiLanguageCheck
{
    public function handle($request, Closure $next)
    {
        App::setLocale('en');
        if (!is_null($request->header('Accept-Language'))) {
            App::setLocale($request->header('Accept-Language'));
        }
        return $next($request);
    }
}
