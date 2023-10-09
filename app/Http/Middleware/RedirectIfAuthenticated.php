<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ( $guards as $guard ) {
            if ( Auth::guard($guard)->check() ) {
                $user = auth()->user()->role_id;
                switch ( $user ) {
                    case User::ROLE_SUPER_ADMIN:
                        return redirect()->intended(RouteServiceProvider::HOME);
                        break;
                    case User::ROLE_BRAND:
                        return redirect()->intended(RouteServiceProvider::BRANDHOME);
                        break;
                    case User::ROLE_INFLUENCER:
                        return redirect()->intended(RouteServiceProvider::INFLUENCERHOME);
                        break;
                    default:
                        abort(403);
                        break;
                }
            }
        }

        return $next($request);
    }
}
