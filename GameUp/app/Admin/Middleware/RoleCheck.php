<?php


namespace App\Admin\Middleware;


use App\Data\Utenza;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user() && Auth::user()->ruolo !== Utenza::ROLE_ADMIN) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
