<?php

namespace App\Http\Controllers\brand;

use App\Http\Controllers\Controller;
use App\Models\BrandDetails;
use App\Models\Campaigns;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Notifications\CampaignInvitation;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Mail;
use App\Models\CampaignConnectedInfluencers;
use App\Models\InfluencersRecords;
use DB;


class InviteCampaignController extends Controller
{
    //
    public function send_mail(Request $request){
        // dd("here");
       $camp_id = $request['camp_id'];
       if($camp_id){
       $campaigns = Campaigns::where('id',$camp_id)->first();
            if($campaigns != null) {
                $product_name = Product::where('brand_id',$campaigns->brand_id)->get();
                $singlebrand_name = BrandDetails::select('title_en','id')->where('id',$campaigns->brand_id)->first();
                
                foreach($product_name as $product) {
                    $product_category = Category::select('name_en')->where('id',$product->category_id)->get();
                    $brand_name = BrandDetails::select('title_en','id')->where('id',$product->brand_id)->get();
                }
                    $this->data = array(
                        'title' => 'View Campaign Details',
                        'id' => $camp_id,
                        'campaigns' => $campaigns,
                        'product_category' => isset($product_category) ? $product_category : "",
                        'product_name' => $product_name,
                        'brand_name' => isset($brand_name) ? $brand_name : "",
                        'singlebrand_name' => $singlebrand_name,
                        'accept' => 1,
                        'reject' => 0,
                        'influencer_id' => $request['influencer_id']
                    );

                    /* send mail fucntion start */
                    $to_name = "Topbrandmate";
                    $to_email ='npp@narola.email';
                    // $to_email = $request['email'];
                    Mail::send('mail.invitation', $this->data, function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                        ->subject('Campagion Invitation');
                        });
                    /* send mail fucntion end */
                    $user = auth()->user();
                    activity('Send Invitation')
                        ->performedOn($campaigns)
                        ->causedBy($user)
                        ->log('Campaign Invitation has been sent to influencers');

                    event(new Registered($user,$to_email));

                    return response()->json(
                        [
                           'status' => true,
                           'message' => 'Mail sent successfully.',
                        ]);
            }else {
                return redirect()->route('campaign_details');
            }
       }
    }


    public function store_respose(Request $request){
        $id = $request->campaign_id;
        dd($id);
    }

    public function invite_mail($cid,$influencer_id,$status,Request $request){
        // dd($id , $status);
        /* add data in campaigns connected table */
        $campaigns =  Campaigns::where('id',$cid)->first();
        $influencer_id = $influencer_id;
        $is_exist = CampaignConnectedInfluencers::where("campaign_id",$cid)->where('influencer_id',$influencer_id)->get();
        if(count($is_exist)>0){
            /* update status */
            CampaignConnectedInfluencers::where("campaign_id",$cid)->where('influencer_id',$influencer_id)->update(['influencer_is_accept' => $status, ]);
        }else{
            $campaigns = CampaignConnectedInfluencers::create([
                'campaign_id' => $cid,
                'influencer_id' => $influencer_id,
                'is_type' => 2,
                'influencer_is_accept' => $status,
                'status' => 2 //invited status
            ]);
        }
        $inserted_id = CampaignConnectedInfluencers::where("campaign_id",$cid)->where('influencer_id',$influencer_id)->first();
        $id = $inserted_id->id;

        return view('campaign_invitation',compact('campaigns','influencer_id','id'));
    }

    public function save_response(Request $request,$id){
        $id = $request['id'];
        $campaigns =  CampaignConnectedInfluencers::where('id',$id)->first();
        $status = $campaigns->influencer_is_accept;
        if($status == 1){
            $update = CampaignConnectedInfluencers::where('id',$id)->update(['accept_reason_en'=>$request->response]);
        }else{
            $update = CampaignConnectedInfluencers::where('id',$id)->update(['reject_reason_en'=>$request->response]);
        }
        /* send mail response back to the brand users */
        $user_details = User::where('id',\Auth::id())->first();
        $influencer = InfluencersRecords::where('id',$campaigns->influencer_id)->first();
        $camp = Campaigns::where('id',$campaigns->campaign_id)->first();
        $this->data = array(
            'status' => $status,
            'accept_reason' => $campaigns->accept_reason_en,
            'reject_reason' => $campaigns->reject_reason_en,
            'influencer' => $influencer,
            'user' => $user_details,
            'campaign' => $camp
        );
        $to_name = "Topbrandmate";
        $to_email = $user_details->email;

        Mail::send('mail.influencer_response', $this->data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Campaign Invitation Response');
         });
        /* send mail fucntion end */
        $user = auth()->user();
        activity('Campaign Invitation Response')
            ->performedOn($campaigns)
            ->causedBy($user_details)
            ->log('Campaign Invitation response has been sent to brnad');

        event(new Registered($user,$to_email));

        return redirect()->back()->with('message', 'Thank you for your response!');
    }
}
