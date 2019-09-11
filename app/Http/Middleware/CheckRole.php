<?php

namespace App\Http\Middleware;

use Closure;
// use \App\Http\Middleware\CheckRole as Middleware;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {   
        if (! $request->user()->hasRole($role)) 
        {
            abort(403,'Hubo un error inesperado');
        }

        return $next($request);
    }

}