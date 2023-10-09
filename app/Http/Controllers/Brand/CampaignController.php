<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\{Campaigns, InfluencersRecords, Product, User, Country, CampaignProducts, CampaignConnectedInfluencers, ProductImage, BrandDetails, InfluencerDetails, Category ,RatingsAndReviews, PaymentContract};
use App\Traits\StoreProduct;
use Carbon\Carbon;
use App\Jobs\SendInfluencerEmailQueueJob;
use App\Notifications\SendCampaignOffer;
use App\Services\StripePayment;
use Auth;
use Mail;


class CampaignController extends Controller
{
    protected $builder;
    protected $adminStripeCustId;
    public function __construct(){
        $this->builder = new \AshAllenDesign\ShortURL\Classes\Builder();
        $this->adminStripeCustId = 'cus_NklgFB7ED7xUpP';
    }

    public function index() {
        $title = 'Campaigns';
        return view('brand-users.campaign.index', compact('title'));
    }

    public function ratings() {

        $this->data = array(
            'title' => 'Add Ratings',
        );

        $view = view('brand-users.ratings', $this->data)->render();

        $response = array(
            'status'    => true,
            'data'      => array(
                'view'  => $view,
            ),
        );

        return response()->json($response);
    }

    public function ratingsStore( Request $request) {
        // dd($request->all());
        $user = auth()->user();

        if(Auth::user()->hasRole('Brand')) {
            $rating_types = implode (",",$request->rating_type);

            $ratings = RatingsAndReviews::create([
                'influencer_id'     => $request->influencer_id,
                'brand_id'          => $user->id,
                'campaign_id'       => $request->campaign_id,
                'review_en'         => $request->review_en,
                'is_type'           => $request->user_type,
                'star_ratings'      => $request->star_ratings,
                'ratings_by'        => 1,
                'rating_type'       => $rating_types
            ]);
        }

        if($ratings) {
            return response()->json([
                'status'    => true,
                'message'   => 'Ratings has been given!'
            ]);
        }
        else
        {
            return response()->json([
                'status'    => false,
                'message'   => 'Something went wrong while adding ratings.',
            ]);
        }

    }

    public function getCampaigns(Request $request): JsonResponse
    {
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowPerPage = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        // $searchValue        = $search_arr['value']; // Search value
        $searchValue        = $request->get('search_string'); // Search value

        // Total records
        $totalCampaigns             = Campaigns::select('count(*) as allcount')->where('brand_id', Auth::user()->id)->where('is_draft',1)->where('name_en', 'like', '%' .$searchValue . '%')->count();
        $totalCampaignsWithFilter   = Campaigns::select('count(*) as allcount')->where('brand_id', Auth::user()->id)->where('is_draft',1)->where('name_en', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $campaigns = Campaigns::latest()
                    ->with('campaignProducts')
                    ->withCount('campaignProducts')
                    ->withCount('campaignConnectedInfluencer')
                    ->where('brand_id', Auth::user()->id)
                    ->where('is_draft',1)
                    ->where('campaigns.name_en', 'like', "%$searchValue%")
                    ->skip($start)
                    ->take($rowPerPage)
                    ->get();

        $response = array();

        foreach ( $campaigns as $campaign ) {
            $thumbnailImage = !empty($campaign->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$campaign->thumbnail_image : asset('/assets/media/avatars/default_img.png');
            // if($campaign->campaign_is_active){
            //     $status = 'In Progress';
            // } else {
                $status = $campaign->campaign_is_active ? '<div class="status status-active">Active</div>' : ($campaign->application_end_date && $campaign->application_end_date < Carbon::today()->toDateString() ? '<div class="status status-completed">Completed</div>' : 'In Progress');
            // }
            $response[] = array(
                'id'                        => $campaign->id,
                'name_en'                   => $campaign->name_en,
                'amount'                    => $campaign->amount,
                'total_products'            => $campaign->campaign_products_count,
                'total_influencer'          => $campaign->campaign_connected_influencer_count,
                'created_at'                => \Carbon\Carbon::parse($campaign->created_at)->format('jS F Y'),
                'thumbnail_image'           => $thumbnailImage,
                'is_completed'              => !$campaign->campaign_is_active && !empty($campaign->application_end_date) && $campaign->application_end_date < Carbon::today()->toDateString() ?? false,
                'status'                    => $status,
                'edit_url'                  => route('brand.campaign.edit',$campaign->id),
                'detail_url'                => route('brand.campaign.view',$campaign->id)
            );
        }

        $response = array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalCampaigns,
            'iTotalDisplayRecords'  => $totalCampaignsWithFilter,
            'aaData'                => $response,
        );

        return response()->json($response);
    }

    public function activeCampaignList(Request $request): JsonResponse
    {
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowPerPage = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        // $searchValue        = $search_arr['value']; // Search value
        $searchValue        = $request->get('search_string'); // Search value

        // Total records
        $totalCampaigns             = Campaigns::campaignIsActive()->select('count(*) as allcount')->where('brand_id', Auth::user()->id)->where('is_draft',1)->where('name_en', 'like', '%' .$searchValue . '%')->count();
        $totalCampaignsWithFilter   = Campaigns::campaignIsActive()->select('count(*) as allcount')->where('brand_id', Auth::user()->id)->where('is_draft',1)->where('name_en', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $campaigns = Campaigns::latest()
                    ->campaignIsActive()
                    ->withCount('campaignProducts')
                    ->withCount('campaignConnectedInfluencer')
                    ->where('brand_id', Auth::user()->id)
                    ->where('is_draft',1)
                    ->where('campaigns.name_en', 'like', "%$searchValue%")
                    ->skip($start)
                    ->take($rowPerPage)
                    ->get();

        $response = array();

        foreach ( $campaigns as $campaign ) {
            $thumbnailImage = !empty($campaign->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$campaign->thumbnail_image : asset('/assets/media/avatars/default_img.png');
            $response[] = array(
                'id'                        => $campaign->id,
                'name_en'                   => $campaign->name_en,
                'amount'                    => $campaign->amount,
                'total_products'            => $campaign->campaign_products_count,
                'total_influencer'          => $campaign->campaign_connected_influencer_count,
                'created_at'                => \Carbon\Carbon::parse($campaign->created_at)->format('jS F Y'),
                'thumbnail_image'           => $thumbnailImage,
                'edit_url'                  => route('brand.campaign.edit',$campaign->id),
                'detail_url'                => route('brand.campaign.view',$campaign->id)
            );
        }

        $response = array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalCampaigns,
            'iTotalDisplayRecords'  => $totalCampaignsWithFilter,
            'aaData'                => $response,
        );

        return response()->json($response);
    }

    public function completedCampaignList(Request $request): JsonResponse
    {
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowPerPage = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        // $searchValue        = $search_arr['value']; // Search value
        $searchValue        = $request->get('search_string'); // Search value

        // Total records
        $totalCampaigns             = Campaigns::campaignIsCompleted()->select('count(*) as allcount')->where('brand_id', Auth::user()->id)->where('is_draft',1)->where('name_en', 'like', '%' .$searchValue . '%')->count();
        $totalCampaignsWithFilter   = Campaigns::campaignIsCompleted()->select('count(*) as allcount')->where('brand_id', Auth::user()->id)->where('is_draft',1)->where('name_en', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $campaigns = Campaigns::latest()
                    ->campaignIsCompleted()
                    ->withCount('campaignProducts')
                    ->withCount('campaignConnectedInfluencer')
                    ->where('brand_id', Auth::user()->id)
                    ->where('is_draft',1)
                    ->where('campaigns.name_en', 'like', "%$searchValue%")
                    ->skip($start)
                    ->take($rowPerPage)
                    ->get();

        $response = array();

        foreach ( $campaigns as $campaign ) {
            $thumbnailImage = !empty($campaign->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$campaign->thumbnail_image : asset('/assets/media/avatars/default_img.png');
            $response[] = array(
                'id'                        => $campaign->id,
                'name_en'                   => $campaign->name_en,
                'amount'                    => $campaign->amount,
                'total_products'            => $campaign->campaign_products_count,
                'total_influencer'          => $campaign->campaign_connected_influencer_count,
                'created_at'                => \Carbon\Carbon::parse($campaign->created_at)->format('jS F Y'),
                'thumbnail_image'           => $thumbnailImage,
                'edit_url'                  => route('brand.campaign.edit',$campaign->id),
                'detail_url'                => route('brand.campaign.view',$campaign->id)
            );
        }

        $response = array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalCampaigns,
            'iTotalDisplayRecords'  => $totalCampaignsWithFilter,
            'aaData'                => $response,
        );

        return response()->json($response);
    }

    public function create() {
        $title              = 'Create Campaign';
        $allInfluencerUser  = User::select('id', 'name', 'email')->where('role_id', 'Influencer')->get();
        $brandProducts      = Product::with('mainImage')->where('brand_id', Auth::user()->id)->get() ?? [];
        $countries          = Country::get() ?? [];
        $categories         = Category::select(['id', 'name_en'])->latest()->get();
        $defaultImgUrl      = asset('/assets/media/avatars/default_img.png');
        return view('brand-users.campaign.create', compact('title', 'allInfluencerUser', 'brandProducts', 'countries', 'defaultImgUrl', 'categories'));
    }

    public function store(Request $request) : JsonResponse
    {
        $id         = $request->id;
        $step_num   = $request->step_num;
        $is_edit    = false;
        if(empty($id)){
            $campagin           = new Campaigns();
            $campagin->name_en  = $request->name_en ?? "";
            $campagin->brand_id = Auth::user()->id;
            $campagin->amount   = 0;
            $campagin->save();
            $id = $campagin->id;
        } else {
            $is_edit            = true;
            $campagin           = Campaigns::find((int) $id);
            $campagin->name_en  = $request->name_en ?? "";
            if($step_num == 2) {
                if(CampaignProducts::where('campaign_id', $id)->exists())
                    CampaignProducts::where('campaign_id', $id)->delete();

                $linkProducts = $request->link_product ?? [];
                if(!empty($linkProducts) && count($linkProducts) > 0) {
                    $campProdarra = [];
                    foreach ($linkProducts as $value) {
                        $campProdarra[] = [
                            'campaign_id'   => $id,
                            'product_id'    => $value,
                            'created_at'    => Carbon::now()
                        ];
                    }
                    if(!empty($campProdarra))
                        CampaignProducts::insert($campProdarra);
                }else {

                }
            }
            if($step_num == 3) {
                $shortURLObject = $this->builder->destinationUrl($request->traceable_link)->make();
                $shortURL       = $shortURLObject->default_short_url;
                $shortUrlKey    = $shortURLObject->url_key;

                $fanValumes = explode('-', $request->fan_volumes);
                $min_fans   = $fanValumes[0];
                $max_fans   = $fanValumes[1];

                $campagin->min_fans                     = $min_fans;
                $campagin->max_fans                     = $max_fans;
                $campagin->amount                       = $request->amount;
                $campagin->target_region                = $request->target_region;
                $campagin->total_influencers_required   = $request->total_influencers_required;
                $campagin->budget_for_each_influencer   = $request->budget_for_each_influencer;
                $campagin->is_sample_required           = isset($request->is_sample_required) ? $request->is_sample_required : '';
                $campagin->is_video                     = isset($request->is_video) ? $request->is_video : '';
                $campagin->traceable_link               = $request->traceable_link ?? NULL;
                $campagin->destination_url              = $request->traceable_link ?? NULL;
                $campagin->url_key                      = $shortUrlKey;
                $campagin->default_short_url            = $shortURL;
                $campagin->application_start_date       = $request->application_start_date;
                $campagin->application_end_date         = $request->application_end_date;
                $campagin->application_till_date        = $request->application_till_date;
                $campagin->campaign_is_active           = isset($request->campaign_is_active) ? $request->campaign_is_active : '';
                $campagin->terms_and_condition_en       = $request->hidde_tc;
                $campagin->promote                      = $request->promote;

                if ( $request->file() ) {
                    $fileName = time().'_'.$request->file('image')->getClientOriginalName();
                    $filePath = $request->file('image')->storeAs('campaign_images', $fileName, 'public');
                }
                $campagin->thumbnail_image              = $fileName ?? NULL;
            }
            if($step_num == 4) {
                $influencerEmails   = [];
                $influencerArr      = [];
                $scrapInfluencers   = $request->add_influencer ?? [];
                $systemInfluencers  = $request->add_emails ?? [];
                if(!empty($systemInfluencers) && count($systemInfluencers) > 0) {
                    foreach ($systemInfluencers as $systemInfluencer) {
                        $influencerArr[] = [
                            'campaign_id'       => $id,
                            'influencer_id'     => $systemInfluencer,
                            'is_type'           => 1,
                            'invitation_status' => "1",
                            'created_at'        => Carbon::now()
                        ];

                        // Get user email
                        $userEmail = User::whereId($systemInfluencer)->pluck('email','name')->toArray();
                        $influencerEmails[] = $userEmail;
                    }
                }
                if(!empty($scrapInfluencers) && count($scrapInfluencers) > 0) {
                    foreach ($scrapInfluencers as $scrapInfluencer) {
                        $influencerArr[] = [
                            'campaign_id'       => $id,
                            'influencer_id'     => $scrapInfluencer,
                            'is_type'           => 2,
                            'invitation_status' => "1",
                            'created_at'        => Carbon::now()
                        ];

                        // Get scrap user email
                        $userEmail = InfluencersRecords::whereId($scrapInfluencer)->pluck('email', 'nickname')->toArray();
                        if(!empty($userEmail)){
                            $influencerEmails[] = $userEmail;
                        }
                    }
                }
                if(!empty($influencerArr))
                    CampaignConnectedInfluencers::insert($influencerArr);

                $campagin->is_draft = true;

                $brandname = BrandDetails::where('user_id', Auth::user()->id)->pluck('title_en')->first();
                $emailData = [
                    'campaingn_id'  => $id,
                    'campaign_name' => ucfirst($request->name_en),
                    'brand_name'    => $brandname,
                    'start_date'    => \Carbon\Carbon::parse($request->application_start_date)->format('jS F Y'),
                ];
                $this->sendMailToInfluencers($influencerEmails, $emailData);
            }
            $campagin->save();
        }

        $response = [
            'status'        => !empty($id) ? true : false,
            'id'            => !empty($id) ? $id : '',
            'is_edit'       => $is_edit,
            'step_num'      => $step_num,
            'redirect_url'  => route('brand.campaign.index'),
            'message'       => 'Campaign created successfully!'
        ];

        /* Add activity log start - NPP */
        $msg = $request->name_en .' Campaign created by '.auth()->user()->name.' brand!' ;
        $user = Auth::user();
        add_admin_log('created',$msg,$campagin,$user);
        add_activity_logs('created',$msg,auth()->user()->role_id,\Auth::id());
        /* Add activity log end - NPP */
        return response()->json($response);
    }

    public function searchInfluencer(Request $request) {
        $serachKeyword  = $request->search ?? '';
        $searchData     = InfluencersRecords::where('nickname', 'like', '%' . $serachKeyword . '%')->get();
        $response = [
            'status'        => !empty($searchData) && count($searchData) > 0 ? true : false,
            'searchData'    => !empty($searchData) && count($searchData) > 0 ? $searchData : []
        ];
        return response()->json($response);
    }

    public function edit(Request $request, $id) {
        $title              = 'Edit Campaign';
        $campaignsData      = Campaigns::whereId($id)->first();
        $campProdId         = CampaignProducts::where('campaign_id', $id)->pluck('product_id')->toArray();
        $campOldUserId      = CampaignConnectedInfluencers::where(['campaign_id' => $id, 'is_type' => 1])->pluck('influencer_id')->toArray();
        $campScrapUsers     = CampaignConnectedInfluencers::with('influencer_record')->where(['campaign_id' => $id, 'is_type' => 2])->get();
        $allInfluencerUser  = User::select('id', 'name', 'email')->where('role_id', 'Influencer')->get();
        $brandProducts      = Product::with('mainImage')->where('brand_id', Auth::user()->id)->get() ?? [];
        $countries          = Country::get() ?? [];
        $categories         = Category::select(['id', 'name_en'])->latest()->get();
        $defaultImgUrl      = asset('/assets/media/avatars/default_img.png');
        return view('brand-users.campaign.edit', compact('title', 'allInfluencerUser', 'brandProducts', 'countries', 'defaultImgUrl', 'campaignsData', 'campProdId', 'campOldUserId', 'categories', 'campScrapUsers'));
    }

    public function update(Request $request) : JsonResponse
    {
        $id         = (int) $request->id;
        $step_num   = $request->step_num;

        $campagin = Campaigns::find($id);
        if(!empty($campagin)) {
            $campagin->name_en  = $request->name_en ?? "";
            if($step_num == 2) {
                if(CampaignProducts::where('campaign_id', $id)->exists())
                    CampaignProducts::where('campaign_id', $id)->delete();

                $linkProducts = $request->link_product ?? [];
                if(!empty($linkProducts) && count($linkProducts) > 0) {
                    $campProdarra = [];
                    foreach ($linkProducts as $value) {
                        $campProdarra[] = [
                            'campaign_id'   => $id,
                            'product_id'    => $value,
                            'created_at'    => Carbon::now()
                        ];
                    }
                    if(!empty($campProdarra))
                        CampaignProducts::insert($campProdarra);
                }
            }
            if($step_num == 3) {
                $fanValumes = explode('-', $request->fan_volumes);
                $min_fans   = $fanValumes[0];
                $max_fans   = $fanValumes[1];

                $campagin->min_fans                     = $min_fans;
                $campagin->max_fans                     = $max_fans;
                $campagin->amount                       = $request->amount;
                $campagin->target_region                = $request->target_region;
                $campagin->total_influencers_required   = $request->total_influencers_required;
                $campagin->budget_for_each_influencer   = $request->budget_for_each_influencer;
                $campagin->is_sample_required           = isset($request->is_sample_required) ? $request->is_sample_required : '';
                $campagin->is_video                     = isset($request->is_video) ? $request->is_video : '';
                $campagin->traceable_link               = $request->traceable_link ?? NULL;

                $shortURLObject = $this->builder->destinationUrl($request->traceable_link)->make();
                $shortURL       = $shortURLObject->default_short_url;
                $shortUrlKey    = $shortURLObject->url_key;
                // $url = \AshAllenDesign\ShortURL\Models\ShortURL::find($shortURLObject->url_key);

                $campagin->destination_url              = $request->traceable_link ?? NULL;
                $campagin->url_key                      = $shortUrlKey;
                $campagin->default_short_url            = $shortURL;
                $campagin->application_start_date       = $request->application_start_date;
                $campagin->application_end_date         = $request->application_end_date;
                $campagin->application_till_date        = $request->application_till_date;
                $campagin->campaign_is_active           = isset($request->campaign_is_active) ? $request->campaign_is_active : '';
                $campagin->terms_and_condition_en       = $request->hidde_tc;
                $campagin->promote                      = $request->promote;

                if ( $request->file() ) {
                    $fileName = time().'_'.$request->file('image')->getClientOriginalName();
                    $filePath = $request->file('image')->storeAs('campaign_images', $fileName, 'public');
                }
                $campagin->thumbnail_image              = $fileName ?? $campagin->thumbnail_image;
            }
            if($step_num == 4) {
                $influencerArr      = [];
                $scrapInfluencers   = $request->add_influencer ?? [];
                $systemInfluencers  = $request->add_emails ?? [];
                if(!empty($systemInfluencers) && count($systemInfluencers) > 0) {
                    CampaignConnectedInfluencers::where(['campaign_id' => $id, 'is_type' => 1])->delete();
                    foreach ($systemInfluencers as $systemInfluencer) {
                        $influencerArr[] = [
                            'campaign_id'       => $id,
                            'influencer_id'     => $systemInfluencer,
                            'is_type'           => 1,
                            'invitation_status' => "1",
                            'created_at'        => Carbon::now()
                        ];
                    }
                }
                if(!empty($scrapInfluencers) && count($scrapInfluencers) > 0) {
                    foreach ($scrapInfluencers as $scrapInfluencer) {
                        $influencerArr[] = [
                            'campaign_id'       => $id,
                            'influencer_id'     => $scrapInfluencer,
                            'is_type'           => 2,
                            'invitation_status' => "1",
                            'created_at'        => Carbon::now()
                        ];
                    }
                }
                if(!empty($influencerArr))
                    CampaignConnectedInfluencers::insert($influencerArr);
            }
            $campagin->save();
            $response = [
                'status'        => !empty($id) ? true : false,
                'step_num'      => $step_num,
                'redirect_url'  => route('brand.campaign.index'),
                'message'       => 'Campaign updated successfully!'
            ];
        } else {
            $response = [
                'status'        => false,
                'message'       => 'Campaign not found!'
            ];
        }
        return response()->json($response);
    }

    public function destroy(Request $request) {
        $user               = auth()->user();
        $campaign_delete    = Campaigns::find($request->id);

        if ($campaign_delete) {
            $campaign_name = $campaign_delete->name_en;
            if ($campaign_delete->delete()) {
                activity('deleted')
                ->performedOn($campaign_delete)
                ->causedBy($user)
                ->log("Campaign $campaign_name has been deleted by {$user->name}");

                return response()->json([
                    'status'    => true,
                    'message'   => 'Campaign has been deleted.',
                ]);
            }
        }
        return response()->json([
            'status'    => false,
            'message'   => 'Something went wrong, Campaign not found!',
        ]);
    }

    public function view($id) {
        $campaigns = Campaigns::with('brands')->where('id',$id)->first();
        $brandname = BrandDetails::where('user_id', Auth::user()->id)->pluck('title_en')->first();

        if($campaigns != null) {
            $product_details = CampaignProducts::where('campaign_id',$id)->get();
            $prodArr = [];

            if($product_details != null) {
                foreach($product_details as $products) {
                    $products_info = Product::with(['mainImage', 'category', 'brand'])->where('id',$products->product_id)->first();
                    if($products_info != null) {
                        $prodArr[] = [
                        'id'                => $products_info->id,
                        'name_en'           => $products_info->name_en,
                        'price'             => $products_info->price,
                        'delivery_status'   => $products_info->delivery_status,
                        'product_link'      => $products_info->product_link,
                        'thumbnail_image'   => $products_info->mainImage->thumbnail_image,
                        'category'          => $products_info->category->name_en,
                        'brand'             => $products_info->name_en,
                    ];
                    }
                }
            }

            // Get campaign connected influancers
            $connectedInfluencerInfo = CampaignConnectedInfluencers::select('id', 'campaign_id', 'influencer_id', 'is_type', 'status', 'negotiation_price','payment_status','offer_status','invitation_status','contract_status')->with('ratings')->where('campaign_id', $id)->get();
            $ratingsInfo = RatingsAndReviews::where('campaign_id',$id)->get();

            $influencerArr = [];
            if(!empty($connectedInfluencerInfo)) {
                foreach ($connectedInfluencerInfo as $key => $influencer) {
                    $userData = $this->getUserDetails($influencer->influencer_id, $influencer->is_type);
                    $status = $influencer->status == 0 ? '<span class="badge badge-secondary">Default</span>' : ($influencer->status == 1 ? '<span class="badge badge-info">Interested</span>' : ($influencer->status == 2 ? '<span class="badge badge-warning">Invited</span>' : ($influencer->status == 3 ? '<span class="badge badge-success">Accept</span>' : ( $influencer->status == 4 ? '<span class="badge badge-danger">Reject</span>' : ($influencer->status == 5 ? '<span class="badge badge-primary">Offer Sent</span>' : ($influencer->status == 6 ? '<span class="badge badge-success">Offer Accepted</span>' : ($influencer->status == 7 ? '<span class="badge badge-danger">Offer Rejected</span>' : ( $influencer->status == 8 ? '<span class="badge badge-dark">Offer Negotitated</span>' : ( $influencer->status == 9 ? '<span class="badge badge-success">Hired</span>' : ( $influencer->status == 10 ? '<span class="badge badge-warning">Completed By Influencer</span>' : ( $influencer->status == 11 ? '<span class="badge badge-warning">Completed By Brand</span>' : ( $influencer->status == 12 ? '<span class="badge badge-info">Request for Payment</span>' : ( $influencer->status == 13 ? '<span class="badge badge-danger">Reject Payment Request</span>' : ( $influencer->status == 14 ? '<span class="badge badge-info">Resubmit Request Payment</span>' : ( $influencer->status == 15 ? '<span class="badge badge-success">Completed</span>' : '')))))))))))))));
                    if(!empty($userData)){
                        if($influencer->is_type == 1){
                            $influencerArr[] = [
                                'id'                => $influencer->id,
                                'user_id'           => $influencer->influencer_id,
                                'stripe_customer_id'=> $userData->stripe_customer_id,
                                'campaign_id'       => $influencer->campaign_id,
                                'campaign_name'     => $campaigns->name_en,
                                'user_name'         => $userData->name,
                                'user_type'         => 1,
                                'user_email'        => $userData->email,
                                'user_profile'      => $userData->profile ?? asset('/assets/media/avatars/blank.png'),
                                'status'            => $influencer->status,
                                'negotiation_price' => $influencer->negotiation_price,
                                'status_text'       => $status,
                                'each_inf_fees'     => $campaigns->budget_for_each_influencer,
                                'start_date'        => \Carbon\Carbon::parse($campaigns->application_start_date)->format('jS F Y'),
                                'end_date'          => \Carbon\Carbon::parse($campaigns->application_end_date)->format('jS F Y'),
                                'star_ratings'      => @$influencer->ratings->star_ratings,
                                'reviews'           => @$influencer->ratings->review_en,
                                'rating_type'       => @$influencer->ratings->rating_type,
                                'invitation_status' => $influencer->invitation_status,
                                'offer_status'      => $influencer->offer_status,
                                'contract_status'   => $influencer->contract_status,
                                'payment_status'    => $influencer->payment_status,
                            ];
                        } else {
                            $influencerArr[] = [
                                'id'                => $influencer->id,
                                'user_id'           => $influencer->influencer_id,
                                'stripe_customer_id'=> "",
                                'campaign_id'       => $influencer->campaign_id,
                                'campaign_name'     => $campaigns->name_en,
                                'user_type'         => 2,
                                'user_name'         => $userData->nickname,
                                'user_email'        => $userData->email ?? '',
                                'user_profile'      => $userData->media_profile,
                                'status'            => $influencer->status,
                                'negotiation_price' => $influencer->negotiation_price,
                                'status_text'       => $status,
                                'each_inf_fees'     => $campaigns->budget_for_each_influencer,
                                'start_date'        => \Carbon\Carbon::parse($campaigns->application_start_date)->format('jS F Y'),
                                'end_date'          => \Carbon\Carbon::parse($campaigns->application_end_date)->format('jS F Y'),
                                'star_ratings'      => @$influencer->ratings->star_ratings,
                                'reviews'           => @$influencer->ratings->review_en,
                                'rating_type'       => @$influencer->ratings->rating_type,
                                'invitation_status' => $influencer->invitation_status,
                                'offer_status'      => $influencer->offer_status,
                                'contract_status'   => $influencer->contract_status,
                                'payment_status'    => $influencer->payment_status,
                            ];
                        }
                    }
                }
            }

            $this->data = array(
                'title'                 => 'View Campaign Details',
                'id'                    => $id,
                'product_details'       => $product_details,
                'prodArr'               => $prodArr,
                'campaigns'             => $campaigns,
                'role'                  => Auth::user()->role_id,
                'connected_influencers' => $influencerArr,
                'brand_name'            => $brandname,
                'ratingsInfo'           => $ratingsInfo
            );
            return view('brand-users.campaign.campaign_details', $this->data );
        }
        else
            return redirect()->route('campaign_details')->with('error','No data found.');
    }

    public function deleteOldInfluencer(Request $request) {
        $campId = $request->campaign_id;
        $infId  = $request->influencer_id;
        if ($campId && $infId) {
            if (CampaignConnectedInfluencers::where(['campaign_id' => $campId, 'influencer_id' => $infId, 'is_type' => 2])->delete()) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Influencer removed from this campaign!',
                ]);
            }
        }
        return response()->json([
            'status'    => false,
            'message'   => 'Something went wrong, while deleting influencer!',
        ]);
    }

    public function allProducts(){
        $prodArr        = [];
        $allProducts    = Product::with('mainImage')->where('brand_id', Auth::user()->id)->latest()->get() ?? [];
        if(!empty($allProducts)){
            foreach ($allProducts as $key => $product) {
                $prodImage = !empty($product->mainImage) ? asset('/storage/products/') .'/'. $product->id .'/thumbnails/'. $product->mainImage->thumbnail_image : asset('/assets/media/avatars/default_img.png');
                $prodArr[] = [
                    'product_id'    => $product->id,
                    'product_name'  => $product->name_en,
                    'product_img'   => $prodImage
                ];
            }
        }
        return response()->json([
            'status'    => count($prodArr) > 0 ?? false,
            'products'  => $prodArr
        ]);
    }

    private function sendMailToInfluencers($influencerEmails, $emailData) {
        if(!empty($influencerEmails)){
            foreach ($influencerEmails as $key => $value) {
                $emailData['user_name'] = $key;
                if(!empty($value)){
                    $emailData['to_email'] = $value;
                    dispatch(new SendInfluencerEmailQueueJob($emailData));
                }
                // $emailData['user_name'] = 'TRV Narola';
                // $emailData['to_email']  = 'trv@narola.email';
                // dispatch(new SendInfluencerEmailQueueJob($emailData))->delay(now()->addMinutes(5));
            }
        }
    }

    private function getUserDetails($userId, $type) {
        $influencerData = $type == 1 ? User::whereId($userId)->first() : InfluencersRecords::whereId($userId)->first();
        return $influencerData;
    }

    public function viewProduct($id) {
        $products = Product::find($id);
        if ( !$products )
            return redirect()->route('brand.product.index')->with('error','No data found.');

        $this->data = [
            'title'         => 'View Product Detail | ',
            'products'      => $products,
            'product_path'  => Product::PRODUCT_UPLOAD_PATH,
        ];

        $view = view('influencer-users.single_product_detail', $this->data)->render();

        return view('influencer-users.single_product_detail', $this->data);
    }

    // Send offer for the campaign
    public function sendOffer(Request $request){
        $id             = $request->id;
        $campId         = $request->campId;
        $campName       = $request->campName;
        $userName       = $request->userName;
        $userEmail      = $request->userEmail;
        $startDate      = $request->startDate;
        $endDate        = $request->endDate;
        $eachInfFees    = $request->eachInfFees;
        $brandName      = $request->brandName;
        $emailContent   = $request->emailContent;
        $userType       = $request->userType;
        $campaignUrl    = route('brand.campaign.view',$campId);
        $response       = [];

        $find           = ['{{ Influencer Name }}', '{{ Brand Name }}', '{{ Campaign Name }}', '{{ Time Frame }}', '{{ Fees }}', '{{ URL }}'];
        $replacement    = [$userName, $brandName, $campName, $startDate." - ".$endDate, "$ ".$eachInfFees, ""];
        $emailContent   = str_replace($find, $replacement, $emailContent);

        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => 'Campaign Offer'];
        $userData       = $userType == 1 ? User::where('email', $userEmail)->first() : InfluencersRecords::where('email', $userEmail)->first();
        $influencer = CampaignConnectedInfluencers::whereId($id)->first();
        // $userData->email = 'trv@narola.email';
        if(!empty($userData)){
            try {
                $userData->notify(new SendCampaignOffer($emailContent));
                CampaignConnectedInfluencers::whereId($id)->update(['offer_status' => '1', 'negotiation_price' => $eachInfFees]);
                $response = [
                    'status'    => true,
                    'message'   => 'Campaign offer sent successfully!'
                ];
                /* Add activity log start - NPP */

                $msg = auth()->user()->name .' brand has sent campaign offer to'.$userName.' influecner for this '.
                $message = auth()->user()->name .' brand has sent campaign offer for this '.$campName. ' campaign.';
                $campName. ' campaign.';
                $user = Auth::user();
                add_admin_log('sent_offer',$msg,$influencer,$user);
                add_activity_logs('sent_offer',$message,"Influencer",$influencer->influencer_id);

                /* Add activity log end - NPP */
            }
            catch(\Exception $e) {
                $response = [
                    'status'    => false,
                    'message'   => $e->getMessage()
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Something went wrong.',
            ];
        }

        return response()->json( $response );
    }

    /* NPP Developement Start */
    public function acceptInfluencerRequest(Request $request){
        $id                         = $request->id;
        $email                      = $request->email;
        $price                      = $request->price;
        $update                     = CampaignConnectedInfluencers::whereId($id)->update(['invitation_status' => '3','negotiation_price'=>$price]);
        $connectedInfluencerInfo    = CampaignConnectedInfluencers::where("id",$id)->first();

        if ( $update ) {
                /* Send mail notification to influencer for intial accept */
                $brand = User::where("id",\Auth::id())->first();
                $this->data = array(
                    'brandName' => $brand->name,
                    'CampName'  => $request->campName,
                    'UserName'  => $request->UserName
                );
                $to_name = "Topbrandmate";
                $to_email ='npp@narola.email';
                // $to_email = $email;
                Mail::send('mail.accept_request', $this->data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Campagion Invitation Accepted');
                });
                $response = [ 'status' => true, 'message' => 'Request accepted successfully!' ];

        }else{
            $response = [ 'status' => false, 'message' => 'Status not updated! PLease try again.' ];
        }
        return response()->json($response);
    }

    public function rejectInfluencerRequest(Request $request){
        $id                         = $request->id;
        $email                      = $request->email;
        $update                     = CampaignConnectedInfluencers::whereId($id)->update(['invitation_status' => '4']);
        $connectedInfluencerInfo    = CampaignConnectedInfluencers::where("id",$id)->first();
        if ( $update == 1) {
                /* Send mail notification to influencer for intial accept */
                $brand = User::where("id",\Auth::id())->first();
                $this->data = array(
                    'brandName' => $brand->name,
                    'CampName'  => $request->campName,
                    'UserName'  => $request->UserName ,
                    'reason'    => $request->Reason
                );
                $to_name = "Topbrandmate";
                $to_email ='npp@narola.email';
                Mail::send('mail.reject_request', $this->data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Campagion Invitation Rejected');
                });
                /* Add activity log start - NPP */
                $msg = auth()->user()->name .' brand has rejected your request for this'. $request->campName.' campaign.';
                $user = Auth::user();
                add_admin_log('reject_request',$msg,$connectedInfluencerInfo,$user);
                add_activity_logs('reject_request',$msg,"Influencer",$connectedInfluencerInfo->influencer_id);
                /* Add activity log end - NPP */
                $response = [ 'status' => true, 'message' => 'Request rejected successfully!' ];

        }else{
            $response = [ 'status' => false, 'message' => 'Status not updated! PLease try again.' ];
        }
        return response()->json($response);
    }

    function campaignUpdateStatus($id,$columnName,$status){
        $update = CampaignConnectedInfluencers::whereId($id)->update([$columnName => $status]);
        return $update;
    }

    /* NPP Developement End */

    // Resend offer after negotiation
    public function resendOffer(Request $request){
        $id             = $request->id;
        $campId         = $request->campId;
        $campName         = $request->campName;
        $userName       = $request->userName;
        $userEmail      = $request->userEmail;
        $emailContent   = $request->emailContent;
        $userType       = $request->userType;
        $resendPrice    = $request->resendPrice;
        $campaignUrl    = route('brand.campaign.view',$campId);
        $response       = [];

        $find           = ['{{ Influencer Name }}', '{{ New Price }}'];
        $replacement    = [$userName, "$ ".$resendPrice];
        $emailContent   = str_replace($find, $replacement, $emailContent);

        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => 'Campaign Offer'];
        $userData       = $userType == 1 ? User::where('email', $userEmail)->first() : InfluencersRecords::where('email', $userEmail)->first();
        // $userData->email = 'trv@narola.email';
        if(!empty($userData)){
            try {
                $userData->notify(new SendCampaignOffer($emailContent));
                CampaignConnectedInfluencers::whereId($id)->update(['offer_status' => '5', 'negotiation_price' => $resendPrice]);
                $response = [
                    'status'    => true,
                    'message'   => 'Campaign offer re-sent successfully!'
                ];
                /* Add activity log start - NPP */
                $influencer = CampaignConnectedInfluencers::whereId($id)->first();
                $msg = auth()->user()->name .' brand has resent offer to this '.$userName.' influencer for this '.$campName.'campagin.' ;
                $message    =  auth()->user()->name .' brand has resent offer for this campaign '.$campName;
                $user = Auth::user();
                add_admin_log('resent_offer',$msg,$userData,$user);
                add_activity_logs('resent_offer',$message,"Influencer",$influencer->influencer_id);
                /* Add activity log end - NPP */
            }
            catch(\Exception $e) {
                $response = [
                    'status'    => false,
                    'message'   => $e->getMessage()
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Something went wrong.',
            ];
        }

        return response()->json( $response );
    }

    // Accept offer after negotiation
    public function resendOfferAccept(Request $request){
        $id                 = $request->id;
        $campId             = $request->campId;
        $campName           = $request->campName;
        $userId             = $request->userId;
        $userName           = $request->userName;
        $userEmail          = $request->userEmail;
        $emailContent       = $request->emailContent;
        $userType           = $request->userType;
        $finalPrice         = $request->finalPrice;
        $campaignUrl        = route('brand.campaign.view',$campId);
        $response           = [];

        $find           = ['{{ Influencer Name }}', '{{ Campaign Name }}', '{{ Final Price }}'];
        $replacement    = [$userName, $campName, "$ ".$finalPrice];
        $emailContent   = str_replace($find, $replacement, $emailContent);

        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => 'Campaign Offer Accepted'];
        $userData       = $userType == 1 ? User::where('email', $userEmail)->first() : InfluencersRecords::where('email', $userEmail)->first();
        // $userData->email = 'trv@narola.email';
        if(!empty($userData)){
            try {
                /* Stripe charge api */
                try {
                    $stripe_customer_id = BrandDetails::where('user_id',Auth::user()->id)->pluck('stripe_customer_id')->first();
                    if(!empty($stripe_customer_id)){
                        // Deduct balance from the brand's stripe account
                        (new StripePayment())->CampaignPayment($stripe_customer_id,$finalPrice);

                        // Credit balance in Admin's stripe account
                        (new StripePayment())->PaytoAdmin($this->adminStripeCustId,$finalPrice);
                    }
                } catch (\Exception $e) {
                    $response = [ 'status' => false, 'message' => $e->getMessage() ];
                }

                PaymentContract::create([
                    'campaign_connected_influencers_id' => $id,
                    'campaign_id'                       => $campId,
                    'influencer_id'                     => $userId,
                    'brand_id'                          => Auth::user()->id,
                    'amount'                            => $finalPrice,
                    'payment_status'                    => '0',
                    'created_at'                        => Carbon::now()
                ]);

                $userData->notify(new SendCampaignOffer($emailContent));
                CampaignConnectedInfluencers::whereId($id)->update(['offer_status' => '2', 'contract_status' => '1', 'negotiation_price' => $finalPrice]);
                $response = [ 'status' => true, 'message' => 'Offer accepted successfully!' ];
                /* Add activity log start - NPP */
                $influencer = CampaignConnectedInfluencers::whereId($id)->first();
                $msg = auth()->user()->name .' brand has been hired this '.$userName.' influencer.' ;
                $message    =  auth()->user()->name .' brand has been hired you for this campaign '.$campName;
                $user = Auth::user();
                add_admin_log('hired',$msg,$userData,$user);
                add_activity_logs('hired',$message,"Influencer",$influencer->influencer_id);
                /* Add activity log end - NPP */
            }
            catch(\Exception $e) {
                $response = [ 'status' => false, 'message' => $e->getMessage() ];
            }
        } else {
            $response = [ 'status' => false, 'message' => 'User not found!' ];
        }
        return response()->json( $response );
    }

    public function manageCommonStatus(Request $request) {
        $id                 = $request->id;
        $campId             = $request->campId;
        $campName           = $request->campName;
        $userName           = $request->userName;
        $userEmail          = $request->userEmail;
        $finalPrice         = $request->finalPrice;
        $userType           = $request->userType;
        $emailContent       = $request->emailContent;
        $status             = $request->status;
        $campaignUrl        = route('brand.campaign.view',$campId);
        $response           = [];
        $isPaid             = $status == "paid" ? 1 : 0;

        $find           = ['{{ Influencer Name }}', '{{ Campaign Name }}', '{{ Final Price }}'];
        $replacement    = [$userName, $campName, "$ ".$finalPrice];
        $emailContent   = str_replace($find, $replacement, $emailContent);

        $subject        = $status == "completed_by_brand" ? "Campaign Completed by Brand" : ($status == "reject_payment_request" ? "Payment Request Rejected" : ($status == "paid" ? "Payment Paid" : ""));
        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => $subject];
        $userData       = $userType == 1 ? User::where('email', $userEmail)->first() : InfluencersRecords::where('email', $userEmail)->first();
        // $userData->email = 'trv@narola.email';
        if(!empty($userData)) {
            if(!empty($userData->stripe_customer_id)) {
                try {
                    $msg = $status == "completed_by_brand" ? "Offer completed successfully!" : ($status == "reject_payment_request" ? "Payment request rejected successfully!" : ($status == "paid" ? "Payment paid successfully!" : ""));
                    $userData->notify(new SendCampaignOffer($emailContent));
                    $statusValue    = $status == "completed_by_brand" ? "3" : ($status == "reject_payment_request" ? "2" : ($status == "paid" ? "4" : ""));
                    $columnName     = $status == "completed_by_brand" ? "contract_status" : "payment_status";
                    if($status == "paid"){
                        // Deduct amount from the Admin's stripe account
                        (new StripePayment())->deductFromAdmin($this->adminStripeCustId,$finalPrice);

                        // Credit balance in influencer's stripe account
                        (new StripePayment())->creditAmountToInfluencer($userData->stripe_customer_id,$finalPrice);
                    }else{
                        $response = [ 'status' => false, 'message' => 'Stripe customer id is not availabale for this user!' ];
                    }
                    CampaignConnectedInfluencers::whereId($id)->update([$columnName => $statusValue, 'is_paid' => $isPaid]);
                    $response = [ 'status' => true, 'message' => $msg ];
                    $influencer = CampaignConnectedInfluencers::whereId($id)->first();
                    if($statusValue == "3" || $statusValue == "4"){
                        /* Add activity log start - NPP */
                        $msg = $campName.'Campaign has been completed by '.auth()->user()->name.' brand!' ;
                        $message = $campName.'Campaign has been completed by you' ;
                        $user = Auth::user();
                        add_admin_log('campaign completed',$msg,$influencer,$user);
                        add_activity_logs('campaign completed',$message,auth()->user()->role_id,\Auth::id());
                        add_activity_logs('campaign completed',$msg,"Influencer",$influencer->influencer_id);
                        /* Add activity log end - NPP */
                    }else if($statusValue == "2"){
                        /* Add activity log start - NPP */
                        $msg = 'Payment request for this'. $userName .' influencer has been rejected by '.auth()->user()->name.' brand!' ;
                        $message = 'Your payment request for this'.$campName.' Campaign has been rejected by '.auth()->user()->name.' brand!' ;
                        $user = Auth::user();
                        add_admin_log('reject_payment',$msg,$influencer,$user);
                        add_activity_logs('reject_payment',$message,"Influencer",$influencer->influencer_id);
                        /* Add activity log end - NPP */
                    }

                }
                catch(\Exception $e) {
                    $response = [ 'status' => false, 'message' => $e->getMessage() ];
                }
            }else {
                $response = [ 'status' => false, 'message' => 'Please connect your bank account to get paid!' ];
            }
        } else {
            $response = [ 'status' => false, 'message' => 'User not found!' ];
        }
        return response()->json( $response );
    }
}
