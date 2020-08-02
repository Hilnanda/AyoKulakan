<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Auth;

use App\Models\User;

class CheckAuthMiddleware
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
        if(Auth::check()){
            if($request->route()->uri() == 'logout'){
                 return $next($request);
            }else{
                return redirect('/');
            }
        }else{
             return $next($request);
        }

        return $next($request);
    }
}
