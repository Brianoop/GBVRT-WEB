<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsActivist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->type == 2){
            return $next($request);
        }
   
        return redirect('activist')->with('error',"You don't have activist access.");
    }
}
