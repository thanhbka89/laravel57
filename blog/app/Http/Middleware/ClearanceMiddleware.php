<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ClearanceMiddleware
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
        if (Auth::user()->hasPermissionTo('product-list')) {
            return $next($request);
        }

        if ($request->is('products/create')) {
            if (!Auth::user()->hasPermissionTo('product-create')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('products/*/edit')) {
            if (!Auth::user()->hasPermissionTo('product-edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('product-delete')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
