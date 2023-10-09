<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\BrandDetails;
use App\Models\Campaigns;
use App\Models\Category;
use App\Models\InfluencerDetails;
use App\Models\CampaignConnectedInfluencers;
use App\Models\{Plan, User};
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Validator;
use App\Services\StripePayment as StripeService;
use App\Models\BrandActivityLogs;
use App\Models\InfluencerActivityLogs;

class DashboardController extends Controller
{
    public function index() {

        $brand_count            = BrandDetails::count();
        $influencer_count       = InfluencerDetails::count();
        $plan_count             = Plan::count();
        $category_count         = Category::count();

        return view('admin.dashboard', compact('brand_count','influencer_count','plan_count','category_count'));
    }

    public function profile(Request $request){
        $this->data = array(
            'title' => 'Profile Overview | ',
            'breadcrumbs' => array(
                'title' => 'Profile Overview',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    '',
                    '#' => 'Profile Overview',
                ),
            ),
            'user' => auth()->user(),
        );

        return view('admin.profile', $this->data);
    }

    public function brand_profile(Request $request){
        $user       = Auth::user();
        $brand      = BrandDetails::where("user_id",\Auth::id())->first();

        return view('brand-users.profile',compact('user','brand'));
    }

    public function influencer_profile(Request $request){
        $user                   = Auth::user();
        $influencer_details     = InfluencerDetails::where('user_id',$user->id)->first();

        return view('brand-users.profile',compact('user','influencer_details'));
    }

    public function brand_profile_edit(){
        $user = Auth::user();

        return view('brand-users.edit_profile',compact('user'));
    }

     public function influencer_profile_edit(){
        $user = Auth::user();

        return view('influencer-users.edit_profile',compact('user'));
    }

    public function brand_dashboard(){

        $active_campaign            = Campaigns::where('campaign_is_active','=','1')->where('brand_id', Auth::user()->id)->count();
        $total_campaign             = Campaigns::where('brand_id', Auth::user()->id)->where('is_draft',1)->count();
        $completed_campaign         = Campaigns::campaignIsCompleted()->where('is_draft',1)->where('brand_id', Auth::user()->id)->count();
        $active_campaign_data       = Campaigns::latest()
                                    ->campaignIsActive()
                                    ->withCount('campaignProducts')
                                    ->withCount('campaignConnectedInfluencer')
                                    ->where('is_draft',1)
                                    ->get();
        $hired_influencers          = CampaignConnectedInfluencers::with('campaigns')->where('contract_status','1')->get();

        $hired_influencer_count = '';
        $hired_count = [];
        foreach($hired_influencers as $key=>$value) {
            // dd($value);
            $hired_count[] =  $value->campaigns->brand_id;
        }

        $hired_influencer_count = count($hired_count);
        return view('layouts.dashboard',compact('active_campaign','total_campaign','completed_campaign','hired_influencer_count'));
    }

    public function influencer_dashboard(){

        $active_campaign    = Campaigns::where('campaign_is_active','=','1')->count();
        $total_campaign     = Campaigns::count();

        return view('layouts.dashboard',compact('active_campaign','total_campaign'));
    }

    public function influencerPayment(){
        return view('influencer_payment');
    }

    public function connectInfluencerStripeAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'fullName'      => 'required',
            'cardNumber'    => 'required',
            'month'         => 'required',
            'year'          => 'required',
            'cvv'           => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        $token = (new StripeService())->createToken($request);

        if (!empty($token['error'])) {
            return redirect()->back()->with('danger', $token['error']);
        }
        if (empty($token['id'])) {
            return redirect()->back()->with('danger', 'Something wennt wrong while generating token. Please try again!');
        }

        if (!empty($token['id'])) {
            $connect = (new StripeService())->customer(Auth::user()->name, Auth::user()->email ,Auth::user()->id, $type = 'influencer');
            return redirect()->route('influencer_dashboard')->with('msg', 'Influencer connected successfully!');
        }
        return redirect()->back()->with('danger', 'Something went wrong while connecting influencer!');
    }

    public function brand_plans(){
        $plans      = Plan::where('status','=','1')->get();

        return view('brand-users.subscription_plans',compact('plans'));
    }

    public function activityLog() {
        $activities     = Activity::orderBy('id','desc')->paginate(10);
        return view('layouts.activityLog',compact('activities'));
    }

    public function influencer_update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('influencer.profile')->with('message', 'profile updated successfully.');
    }
    /* NPP Developemt */
    public function ActivityLogs(){
        if(auth()->user()->role_id == "Brand"){
            $activities     = BrandActivityLogs::where('brand_id',\Auth::id())->orderBy('id','desc')->paginate(10);
        }else{
            $activities     = InfluencerActivityLogs::where('influencer_id',\Auth::id())->orderBy('id','desc')->paginate(10);
        }
        return view('layouts.notifications',compact('activities'));
    }
}
