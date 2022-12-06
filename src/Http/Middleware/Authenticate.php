<?php

namespace GateGem\Core\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Gate;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        /** @var \App\User $user */
        $user = $request->user();
        // Like: users.index
        $route = app()->router->getCurrentRoute()->getName();

        // Hasn't permission
         if ( $user && !Gate::check($route, [$user])) {
            return abort(403);
        }
        return parent::handle($request, $next, ...$guards);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('core.login');
        }
    }
}
