<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class LoginMiddleware
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
        if (Auth::check()) {
            $user = Auth::user();
            if($user->is_admin > 0)
                return $next($request);
            else {
                Session::flash('warning', 'Bạn không được phép truy cập!');
                return redirect()->route('get.login');
            }
        }

        return redirect()->route('get.login');
    }
}
