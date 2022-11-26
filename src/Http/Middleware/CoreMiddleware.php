<?php

namespace LaraIO\Core\Http\Middleware;

use LaraIO\Core\Facades\Core;

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
        $response = $next($request);

        return $response;
    }
}
