<?php

namespace App\Http\Middleware;

use App\Service\ConstantsService;
use Closure;

class AllowAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->hasRole(ConstantsService::$ROLE_ADMIN)){
            abort(403);
        }
        return $next($request);
    }
}
