<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::check()){
            if(auth()->user()->status == 1010){
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
