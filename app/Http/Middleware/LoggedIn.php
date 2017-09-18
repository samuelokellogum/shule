<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class LoggedIn
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
        if(Session::get('userid') == null){
            return redirect()->route('startup');
        }
        return $next($request);
    }
}
