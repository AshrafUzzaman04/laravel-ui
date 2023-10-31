<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Languages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has("applocale") && array_key_exists(Session()->get("applocale"), config("lang"))) {
            App::setLocale(Session()->get("applocale"));
        } else {
            App::setLocale(config("app.fallback_locale"));
        }
        return $next($request);
    }
}
