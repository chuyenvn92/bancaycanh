<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class UserMiddleware
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
            return $next($request);
        }
        Session::flash('warning', 'Vui lòng đăng nhập để tiếp tục!');

        return redirect()->route('user.login');
    }
}
