<?php

namespace LaraPlatform\Core\Http\Middleware;

use LaraPlatform\Core\Facades\Core;

class CoreMiddleware
{
    /**
     * Handle an incoming HTTP request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle($request, \Closure $next)
    {
        // It does other things here
        Core::checkCurrentLanguage();
        return $next($request);
    }
}
