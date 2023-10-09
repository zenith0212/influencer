<?php
namespace App\Services;
use Stripe\Exception\CardException;
use Stripe\OAuth;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\{BrandDetails, User};


class StripePayment{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
        $this->admin_stripe = new StripeClient(config('stripe.api_keys.admin_secret_key'));
        Stripe::setApiKey(config('stripe.api_keys.secret_key'));
        Stripe::setApiKey(config('stripe.api_keys.admin_secret_key'));
    }

    public function customer($username, $email, $id, $type = ""){
        try{
            $create = $this->stripe->customers->create([
                'name' => $username,
                'email' => $email,
                'balance' => !empty($type) ? 0 : 5000,
                'description' => 'My First Test Customer',
                'source' => 'tok_visa',
            ]);

            if($create && empty($type)){
                BrandDetails::where("user_id",$id)->update(['stripe_customer_id' => $create['id']]);
            }

            if($create && !empty($type)){
                User::whereId($id)->update(['stripe_customer_id' => $create['id']]);
            }

        }catch(Exception $e){
            $create['error'] = $e->getMessage();
        }
    }

    public function createToken($cardData)
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

    public function createCharge($tokenId, $amount)
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

    public function CampaignPayment($customer,$amount){
        $charge = null;
        try{
            $charge = $this->stripe->charges->create([
                "amount" => ($amount * 100),
                "currency" => "usd",
                "customer" => $customer
            ]);
        }catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    public function PaytoAdmin($customer,$amount){
        $pay = null;
        try{
            $pay = $this->admin_stripe->customers->createBalanceTransaction(
                $customer,
                [
                    'amount' => ($amount * 100),
                    'currency' => 'usd'
                ]);
        }catch(Exception $e){
            $pay['error'] = $e->getMessage();
        }
        return $pay;
    }

    // Dedutc amount from the Admin's escrow account
    public function deductFromAdmin($customer,$amount){
        $charge = null;
        try{
            $charge = $this->admin_stripe->charges->create([
                "amount" => ($amount * 100),
                "currency" => "usd",
                "customer" => $customer
            ]);
        }catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    // Credit amount to influencers stripe account
    public function creditAmountToInfluencer($customer,$amount){
        $credit = null;
        try{
            $credit = $this->stripe->customers->createBalanceTransaction(
                        $customer,
                        [
                            'amount' => ($amount * 100),
                            'currency' => 'usd'
                        ]);
        }catch (Exception $e) {
            $credit['error'] = $e->getMessage();
        }
        return $credit;
    }
}

?>
