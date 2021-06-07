<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Test
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
        if(Auth::check('')) {
            if(Auth::User()->role=='User'){
                dd('java developer');
            }elseif (Auth::User()->role=='Admin'){
                dd('PHP developer');
            }

            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
