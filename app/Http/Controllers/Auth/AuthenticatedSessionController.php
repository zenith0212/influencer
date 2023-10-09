<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $user = auth()->user()->role_id;

        switch ($user) {
            case 'Super Admin':
                return redirect()->intended(RouteServiceProvider::HOME)->with('message', 'You are logged in successfully!');
                break;
            case 'Brand':
                return redirect()->intended(RouteServiceProvider::BRANDHOME);
                break;
            case 'Influencer':
                return redirect()->intended(RouteServiceProvider::INFLUENCERHOME);
                break;

            default:
                abort(403);
                // return redirect()->intended(RouteServiceProvider::HOME);
                break;
        }   
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
