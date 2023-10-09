<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StripePayment;
use App\Models\User;
use Mail;
use Stripe\Stripe;
use Stripe\StripeClient;


class SubscriptionRenewal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-renewal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle(): void
    {
        //
        $get_date = StripePayment::where('user_id','!=',0)->where('status','=','succeeded')->get();
       
        foreach($get_date as $key=>$value){
            $today_date = date('Y-m-d');
            $date = date('Y-m-d',strtotime($value->created_at));
            $add_date = date("Y-m-d",strtotime($date . "+1 months"));
            $user = User::where("id",$value->user_id)->first();
     
            if($add_date == $today_date){

                /* Stripe charge api start*/
                $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
                Stripe::setApiKey(config('stripe.api_keys.secret_key'));

                $charge = null;
                try {
                    $charge = $this->stripe->charges->create([
                        'amount' => $value->amount,
                        'currency' => 'usd',
                        'source' => 'tok_mastercard',
                        'description' => 'Automatically Renewal Plan'
                    ]);
                } catch (Exception $e) {
                    $charge['error'] = $e->getMessage();
                }
                if($charge){
                    /* store/update renewal date */
                    StripePayment::where("user_id",$value->user_id)->update(['status'=>'deactive']);
                    /* add details */
                    StripePayment::create([
                        'payment_id' => $charge['id'],
                        'amount' => $charge['amount'],
                        'currency' => $charge['currency'],
                        'customer_id' => $charge['customer'],
                        'status' => $charge['status'],
                        'json_response' => $charge,
                        'user_id' => $value->user_id,
                        'payment_token' => $value->payment_token
                    ]); 
                }
                 /* Stripe charge api end*/


                /* send mail reminder to user for upgrate subscription plan */
                $to_name = "TopBrandMate";
                $to_email = $user->email;
                $this->data = array(
                    'user' => $user,
                    'payment' => $value->amount,
                    'date' => date('d-M-Y',strtotime($add_date))
                );
                Mail::send('mail.subscription_renewal', $this->data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Subscription:Plan Renewal');
                });
            }
        }

         $this->info('Successfully sent plan renewal message to brand.');

    }
}
