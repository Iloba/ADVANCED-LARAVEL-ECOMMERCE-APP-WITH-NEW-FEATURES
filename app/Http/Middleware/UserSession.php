<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSession
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
        //Redirect User Back to home page if already logged in
        if($request->path() == 'loginCustomer' && $request->session()->has('customer')){
            return redirect()->route('all_products')->with('status', 'You are already Logged in');
        }

        return $next($request);
    }
}
