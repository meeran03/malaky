<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasAdminPermission
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
        if(!Auth::check()){
            return redirect('/admin/login');
        }
        if (count(Auth::user()->getAllPermissions())==0) {
            return redirect('/')->with('error' , 'ليس لديك صلاحية الدخول الى الرابط');
        }

        return $next($request);
    }
}
