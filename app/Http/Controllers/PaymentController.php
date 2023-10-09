<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripePaymentForm;
use App\Models\BrandDetails;
use App\Models\Plan;;
use App\Models\StripeAccount;
use App\Models\StripePayment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Stripe\Exception\CardException;
use Stripe\OAuth;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Services\StripePayment as StripeService;


class PaymentController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
        Stripe::setApiKey(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        $queryData = [
            'response_type' => 'code',
            'client_id' => config('stripe.client_id'),
            'scope' => 'read_write',
            'redirect_uri' => config('stripe.redirect_uri')
        ];
        
        $plans = Plan::where('status','=','1')->get();
        $connectUri = config('stripe.authorization_uri').'?'.http_build_query($queryData);
        return view('brand-users.subscription_plans', compact('connectUri','plans'));
    }

    public function redirect(Request $request)
    {
        $token = $this->getToken($request->code);
        if(!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return response()->redirectTo('/');
        }
        $connectedAccountId = $token->stripe_user_id;
        $account = $this->getAccount($connectedAccountId);
        if($account){
            /* store account connected response in database */
            StripeAccount::create([
                'account_id' => $account['id'],
                'json_response' => json_encode($account)
            ]);
        }
        if(!empty($account['error'])) {
            $request->session()->flash('danger', $account['error']);
            return response()->redirectTo('/');
        }
        return view('brand-users.account', compact('account'));
    }

    private function getToken($code)
    {
        $token = null;
        try {
            $token = OAuth::token([
                'grant_type' => 'authorization_code',
                'code' => $code
            ]);
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function getAccount($connectedAccountId)
    {
        $account = null;
        try {
            $account = $this->stripe->accounts->retrieve(
                $connectedAccountId,
                []
            );
        } catch (Exception $e) {
            $account['error'] = $e->getMessage();
        }
        return $account;
    }

    public function stripe_payment($id,Request $request){
        $plan_id = $id;
        $plans = Plan::where('id',$plan_id)->first();
        return view('brand-users.account',compact('plan_id','plans'));
    }

    public function payment(Request $request){

        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        // $token = $this->createToken($request);
        $token = (new StripeService())->createToken($request);
        // dd($token);
        if (!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return response()->redirectTo('/');
        }
        if (empty($token['id'])) {
            $request->session()->flash('danger', 'Payment failed.');
            return response()->redirectTo('/');
        }
        $plan_amount = Plan::where('id',$request->plan_id)->first();
        $charge = (new StripeService())->createCharge($token['id'], (int)$plan_amount->amount);
        // $charge = $this->createCharge($token['id'], (int)$plan_amount->amount);
        if($charge){
            /* Add Payment Details in db */
            StripePayment::create([
                'payment_id' => $charge['id'],
                'amount' => $charge['amount'],
                'currency' => $charge['currency'],
                'customer_id' => $charge['customer'],
                'status' => $charge['status'],
                'json_response' => $charge,
                'user_id' => \Auth::id(),
                'payment_token' => $token['id']
            ]); 
            if (!empty($charge) && $charge['status'] == 'succeeded') {
                /* update plan  id in brand table*/
                $update = BrandDetails::where('user_id',\Auth::id())->update(['plan_id'=>$request->plan_id]);
                $request->session()->flash('msg', 'Payment completed.');
                return response()->redirectTo('/brand/dashboard');
                
            } else {
                $request->session()->flash('danger', 'Payment failed.');
            }
        }
        return response()->redirectTo('/');
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {   
        $charge = null;
        try {
            $user = BrandDetails::where("user_id",\Auth::id())->first();
            $charge = $this->stripe->charges->create([
                'amount' => 1000,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}