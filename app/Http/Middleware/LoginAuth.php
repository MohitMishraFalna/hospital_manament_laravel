<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginAuth
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
        // dd($request->session()->get("login"));

        // // If session is set so Dashboard page will apear. otherwise no.
        if($request->session()->has("login"))
            return $next($request);        
        // return response()->view("login");
        
        return redirect(route("login"));
    }
}
