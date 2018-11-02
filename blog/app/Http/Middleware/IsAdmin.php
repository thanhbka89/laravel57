<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
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
        //if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) {
        if (!Auth::user()->hasRole('superadmin')) {
            abort('401');
        }

        return $next($request);
    }
}
