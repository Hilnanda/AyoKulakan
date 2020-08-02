<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RedirectIfAuthenticated
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
        if(Auth::check()){
            if(auth()->user()->status){
                return $next($request);
            }else{
                return redirect('s/'.$request->route()->uri());
            }
        }else{
            return redirect('s/'.$request->route()->uri());
        }

        return $next($request);

    }
}
