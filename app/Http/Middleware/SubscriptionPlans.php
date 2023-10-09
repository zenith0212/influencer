<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\BrandDetails;
use Redirect;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionPlans
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user()->role_id;
        // dd(\Auth::id());
        if($user == 'Brand'){
            $data = BrandDetails::where('user_id',\Auth::id())->whereNull('plan_id')->first();
            // dd($data);
            if($data){
               return redirect()->route('brand_plans');
            }
        }
        return $next($request);
    }
}
