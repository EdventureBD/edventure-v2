<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class IsAdmin
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
        $i = 0;
        
        if ((auth()->user()->is_admin == 1) && (auth()->user()->user_type == 1)) {
            foreach (auth()->user()->unreadNotifications as $notification) {
                $i++;
                View::share('notiCount', $i);
                View::share('notifications', $notification);
            }
            return $next($request);
        }
        return redirect('error');
    }
}
