<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

      //  echo "Сработал посредник";
        //if ( 1 == 1 )
        //$next = $request->getPathInfo();
        // return redirect('check')->with('next', ['$next']);

        return $next($request);
    }
}
