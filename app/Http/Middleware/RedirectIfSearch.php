<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfSearch
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
//        return $next($request);
        $search = $request->get('search');
        if($search){
            return redirect("/filter?title=$search&phone=$search&email=$search");
        }
        return $next($request);
    }
}
