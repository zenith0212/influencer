<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $user= Auth::user()->role_id;
            switch ($user) {
                case 'Super Admin':
                    return redirect()->intended(RouteServiceProvider::HOME);
                    break;
                case 'Brand':
                   return redirect()->intended(RouteServiceProvider::BRANDHOME);
                    break;
                case 'Influencer':
                   return redirect()->intended(RouteServiceProvider::INFLUENCERHOME);
                    break;
    
                default:
                    # code...
                    return redirect()->intended(RouteServiceProvider::HOME);
                    break;
            }   
            // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $user= Auth::user()->role_id;
        switch ($user) {
            case 'Super Admin':
                return redirect()->intended(RouteServiceProvider::HOME);
                break;
            case 'Brand':
               return redirect()->intended(RouteServiceProvider::BRANDHOME);
                break;
            case 'Influencer':
               return redirect()->intended(RouteServiceProvider::INFLUENCERHOME);
                break;

            default:
                # code...
                return redirect()->intended(RouteServiceProvider::HOME);
                break;
        }   
        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
