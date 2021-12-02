<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
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
        if(!Auth::check()){
            return redirect('auth.login');
        }

        if(Auth::check()){
            return redirect('postList');
        }

        // if (Auth::check() ) {
        //     // The user is logged in...
        //     return redirect('postList');
        // } else 
        // {
        //     return redirect('auth/login');
        // }


    }
}
