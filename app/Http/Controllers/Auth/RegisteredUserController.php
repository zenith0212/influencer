<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterationRequest;
use App\Models\BrandDetails;
use App\Models\Category;
use App\Models\Country;
use App\Models\InfluencerDetails;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Services\StripePayment;


class RegisteredUserController extends Controller
{
     use Notifiable;
     private $stripe;
     public function __construct()
     {
         $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
         Stripe::setApiKey(config('stripe.api_keys.secret_key'));
     }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $category = Category::all();
        $getcountrylist = Country::all();
        return view('auth.register',compact('category','getcountrylist'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterationRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role_id);
        $user->notify(new WelcomeEmailNotification());

        if($request->role_id == "Brand") {
            
           $validated_data =  $request->validate([
                'country' => 'required',
                'company_scale' => 'required'
            ]);

            $brand = BrandDetails::create([
                'user_id' =>$user->id,
                'title_en' => $request->name,
                'company_name' => $request->name,
                'country' =>  $validated_data['country'],
                'work_email' => $request->work_email,
                'address_en' => $request->address,
                'category_id' => $request->product_category,
                'company_scale' => $validated_data['company_scale'],
            ]);
            if($brand){

                /* Create stripe customer start */
            
                (new StripePayment())->customer($request->name,$request->work_email,$user->id);

               
                /* Create stripe customer end */

                activity('registered')
                ->performedOn($brand)
                ->causedBy($user)
                ->log('New Brand'. ' ' . $request->name . ' ' . 'has been registered ');

                event(new Registered($user,$brand));
            }
        }

        if($request->role_id == "Influencer") {
            
            $request->validate([
                'verification_id' => 'required|mimes:jpg,png,pdf'
            ]);

            $fileModel = new InfluencerDetails;
            if($request->file()) {
                $fileName = time().'_'.$request->verification_id->getClientOriginalName();
                $filePath = $request->file('verification_id')->storeAs('uploads', $fileName, 'public');
            }
            
            $influencer = InfluencerDetails::create([
                'user_id' =>$user->id,
                'verification_id' => time().'_'.$request->verification_id->getClientOriginalName(),
                'social_media_link' => $request->social_media_link,
            ]);

            if($influencer){

                activity('registered')
                ->performedOn($influencer)
                ->causedBy($user)
                ->log('New Brand'. ' ' . $request->name . ' ' . 'has been registered ');
                
                event(new Registered($user,$influencer));

            }

        }
        
        Auth::login($user);
        $testuser= Auth::user()->role_id;
        return redirect(RouteServiceProvider::VERIFYEMAIL)->withInput();
;

    }
}
