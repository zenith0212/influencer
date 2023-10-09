<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StripePayment;
use App\Models\User;
use Mail;


class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification for upgrade subscription plans.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $get_date = StripePayment::where('user_id','!=',0)->where('status','=','succeeded')->get();
       
        foreach($get_date as $key=>$value){
            $today_date = date('Y-m-d');
            $date = date('Y-m-d',strtotime($value->created_at));
            $add_date = date("Y-m-d",strtotime($date . "+1 months"));
            $subtract_days = date("Y-m-d",strtotime($add_date."-3 days"));
            $user = User::where("id",$value->user_id)->first();
           
            if($subtract_days == $today_date){
                /* send mail reminder to user for upgrate subscription plan */
                $to_name = "TopBrandMate";
                $to_email = $user->email;
                $this->data = array(
                    'user' => $user,
                    'payment' => $value->amount,
                    'date' => date('d-M-Y',strtotime($add_date))
                );
                Mail::send('mail.subscription_reminder', $this->data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Reminder:Update Your Payment');
                });
            }
        }

         $this->info('Successfully sent reminder to brand.');

    }
}
