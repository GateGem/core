<?php

namespace GateGem\Core\Http\Middleware;

use GateGem\Core\Facades\Core;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        $request = apply_filters('core_before', $request);
        if (($request instanceof BinaryFileResponse) or
            ($request instanceof JsonResponse) or
            ($request instanceof RedirectResponse) or
            ($request instanceof StreamedResponse) or
            ($request instanceof Response)
        )
            return $request;
        $response = $next($request);
        $response = apply_filters('core_after', $response, $request);
        return $response;
    }
}
