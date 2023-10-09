<?php

namespace App\Http\Controllers\Influencers;

use App\Http\Controllers\Controller;
use App\Models\BrandDetails;
use App\Models\InfluencersRecords;
use App\Models\Campaigns;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ratings;
use App\Models\CampaignConnectedInfluencers;
use App\Models\ProductSampleRequests;
use App\Models\CampaignProducts;
use App\Models\InfluencerDetails;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\PaymentContract;
use App\Models\RatingsAndReviews;
use Carbon\Carbon;
use App\Notifications\SendCampaignOffer;
use Auth;
use Illuminate\Http\Request;
use Mail;
use App\Services\StripePayment;



class CampaignsController extends Controller
{
    protected $adminStripeCustId;
    public function __construct(){
        $this->adminStripeCustId = 'cus_NklgFB7ED7xUpP';
    }
    public function campaignDetails(Request $request) {

        $title                      = "Campaign Details";
        $all_campaigns              = Campaigns::orderBy('id','desc')->limit(30)->get();
        $display_campaign_count     = count($all_campaigns);
        $categories                 = Category::all();
        $brands                     = BrandDetails::all();
        $total_campaigns            = Campaigns::count();

        return view('influencer-users.campaign-details',compact('all_campaigns','total_campaigns','categories','brands','display_campaign_count'));
    }


    public function connectedCampaigns() {
        $title                      = "Campaign Details";
        $all_campaigns              = CampaignConnectedInfluencers::with('campaigns')->where('influencer_id',\Auth::user()->id)->get();
        $display_campaign_count     = count($all_campaigns);
        $categories                 = Category::all();
        $brands                     = BrandDetails::all();
        $total_campaigns            = count($all_campaigns);

        return view('influencer-users.connected-campaign-details',compact('all_campaigns','total_campaigns','categories','brands','display_campaign_count'));
    }

    public function loadDataAjax(Request $request)
    {
        $output = '';
        $id = $request->id;
        $all_campaigns = Campaigns::where('id','<',$id)->orderBy('id','desc')->limit(30)->get();
        $display_campaign_count = count($all_campaigns);
        $categories = Category::all();
        $brands = BrandDetails::all();
        $total_campaigns = Campaigns::min('id');


        if(!$all_campaigns->isEmpty())
        {
            $output = '<div class="tab-content">
                           <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel" >
                              <div class="row">';
            foreach($all_campaigns as $value)
            {
                $output .=
                    '<div class="col-md-6 col-xxl-4 mb-5">
                        <div class="card campaigns-card h-100 border-1">
                            <div class="card-body d-flex d-flex align-items-center justify-content-start flex-column">
                                <div class="symbol symbol-65px symbol-circle mb-5">';
                                    if(!empty($value->thumbnail_image)) {
                                        $output.= '<img src="'.url('/storage/campaign_images/').'/'.$value->thumbnail_image.'" alt="image">';
                                    }
                                    else {
                                        $output.= '<img src='.url('/assets/media/avatars/default_img.png').' alt="image" alt="image">';
                                    }
                                     if($value->campaign_is_active == 1){
                                     $output .=  '<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                     }
                                     else {
                                     $output .= '<div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                     }
                                     $output .=  '</div>
                                      <a href="'.url('influencer/campaign-details').'/'.$value->id.'" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0 campaig-name-title">'. $value->name_en.'</a>
                                      <div class="fw-semibold text-gray-400 mb-6"> '. $value->short_description_en.' </div>
                                      <div class="d-flex flex-center flex-wrap">
                                         <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3 text-center">
                                            <div class="fs-6">$ '. $value->amount.'</div>
                                            <div class="fw-semibold text-gray-400">Price Range</div>
                                         </div>
                                         <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3 text-center">
                                            <div class="fs-6">'. getFans($value->min_fans).' - '. getFans($value->max_fans).'</div>
                                            <div class="fw-semibold text-gray-400">Fans Range</div>
                                         </div>
                                         <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3 text-center">';
                                            if( $value->is_video == 0) {
                                          $output .=   '<div class="fs-6">No streaming required</div>';

                                            }
                                            elseif($value->is_video == 1) {

                                          $output .=   '<div class="fs-6">Video Streaming</div>';
                                            }
                                            else {
                                          $output .=   '<div class="fs-6">Live Streaming</div>';
                                            }

                                          $output .=   '<div class="fw-semibold text-gray-400">Streaming Type</div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>';

            }
            $output.='</div><input type="hidden" id="loader_id"/><div id="campaign_id" class="d-none" value="'.$value->id.'">';
            $output .= '</div> </div> </div>';

            return response()->json(
            [
               'status' => true,
               'message' => 'Data Found!',
               'output' => $output,
               'campaign_id' => $value->id,
               'max' => $total_campaigns
            ]);

        }
        else {
            return response()->json(
                [
                    'status' => false,
                    'html' => '<div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">No data found!</h4>
                        </div>
                    </div>
                </div>',
            ]);
        }

    }

    public function get_campaign(Request $request){

        $searchValue = $request['text'];
        $categories = Category::all();

        if($searchValue == null) {
            $get_records = Campaigns::orderBy('id','desc')->with('brands')
               ->get();
        }
        else {
             $get_records = Campaigns::orderBy('id','desc')
           ->join('brand_details', 'brand_details.user_id', '=', 'campaigns.brand_id')
           ->where('campaigns.name_en', 'like', '%' .$searchValue . '%')
           ->orWhere('brand_details.title_en', 'like', '%' .$searchValue . '%')
           ->orWhere('campaigns.min_price', 'like', $searchValue)
           ->orWhere('campaigns.max_price', 'like', $searchValue)
           ->orWhere('campaigns.amount', 'like', $searchValue)
           ->orWhere('campaigns.total_influencers_required', 'like', $searchValue)
           ->select('campaigns.*')->get();
        }
        $total_campaigns_count = count($get_records);

        if(count($get_records)>0){
           $html =  '<div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <h3 class="fw-bold me-5 my-1">' . $total_campaigns_count . ' Items Found
                            <span class="text-gray-400 fs-6">by Recent Updates ↓</span></h3>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel">
                            <div class="row g-6 g-xl-9">';
                                foreach($get_records as $key=>$value) {
                                $html.='<div class="col-md-6 col-xxl-4" >
                                    <div class="card border-1">
                                        <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                            <div class="symbol symbol-65px symbol-circle mb-5">';
                                             if(!empty($value->thumbnail_image)) {
                                                    $html.= '<img src="'.url('/storage/campaign_images/').'/'.$value->thumbnail_image.'" alt="image" alt="image">';
                                                }
                                                else {
                                                    $html.= '<img src='.url('/assets/media/avatars/default_img.png').' alt="image" alt="image">';
                                                }
                                                if($value->campaign_is_active == 1) {
                                                $html.= '<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                                }
                                                else {
                                                    $html.= '<div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                                }
                                            $html.= '</div>
                                            <a href="'.url('influencer/campaign-details').'/'.$value->id.'" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">'. $value->name_en.'</a>

                                            <div class="fw-semibold text-gray-400 mb-6"> '. $value->short_description_en.'</div>

                                            <div class="d-flex flex-center flex-wrap">

                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700"> $'. $value->amount.'</div>
                                                    <div class="fw-semibold text-gray-400">Price Range</div>
                                                </div>
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">'. getFans($value->min_fans).' '. getFans($value->max_fans).'</div>
                                                    <div class="fw-semibold text-gray-400">Fans Range</div>
                                                </div>
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">';
                                                    if( $value->is_video == 0) {

                                                    $html.= '<div class="fs-6 fw-bold text-gray-700">No streaming required</div>';
                                                    }
                                                    else if($value->is_video == 1) {
                                                        $html.= '<div class="fs-6 fw-bold text-gray-700">Video Streaming</div>';
                                                        }
                                                    else {

                                                    $html.= '<div class="fs-6 fw-bold text-gray-700">Live Streaming</div>';
                                                    }

                                                    $html.= '<div class="fw-semibold text-gray-400">Streaming Type</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                            $html.= '</div>
                        </div>';
                    return response()->json(
                        [
                           'status' => true,
                           'message' => 'Data Found!',
                           'html' => $html
                        ]);
            }
            else
            {
                 return response()->json(
                    [
                       'status' => false,
                       'html' => '<div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                       <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                               <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                               <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                           </svg>
                       </span>
                       <div class="d-flex flex-stack flex-grow-1">
                           <div class="fw-semibold">
                               <h4 class="text-gray-900 fw-bold">No data found!</h4>
                           </div>
                       </div>
                   </div>',
                    ]);
            }
    }

     public function get_connected_campaign(Request $request){

        $searchValue = $request['text'];
        $categories = Category::all();
        if($searchValue == null) {
            $get_records = CampaignConnectedInfluencers::with('campaigns')->where('influencer_id',\Auth::user()->id)->get();

        }
        else {
            $get_records = CampaignConnectedInfluencers::orderBy('campaigns.id','desc')
           ->join('campaigns', 'campaigns.id', '=', 'campaign_connected_influencers.campaign_id')
           ->join('brand_details', 'brand_details.user_id', '=', 'campaigns.brand_id')
           ->where('influencer_id',\Auth::user()->id)
           ->where('campaigns.name_en', 'like', '%' .$searchValue . '%')
           ->orWhere('brand_details.title_en', 'like', '%' .$searchValue . '%')
           ->orWhere('campaigns.min_price', 'like', $searchValue)
           ->orWhere('campaigns.max_price', 'like', $searchValue)
           ->orWhere('campaigns.amount', 'like', $searchValue)
           ->orWhere('campaigns.total_influencers_required', 'like', $searchValue)
           ->select('campaigns.*','campaign_connected_influencers.*')->get();
        }
        // dd($get_records);
        $total_campaigns_count = count($get_records);
        if(count($get_records)>0){
           $html =  '<div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <h3 class="fw-bold me-5 my-1">' . $total_campaigns_count . ' Items Found
                            <span class="text-gray-400 fs-6">by Recent Updates ↓</span></h3>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel">
                            <div class="row g-6 g-xl-9">';
                                foreach($get_records as $key=>$value) {
                                    if(!empty($value->campaigns)){
                                        $html.='<div class="col-md-6 col-xxl-4" >
                                            <div class="card border-1">
                                                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                                    <div class="symbol symbol-65px symbol-circle mb-5">';
                                                    if(!empty($value->campaigns->thumbnail_image)) {
                                                            $html.= '<img src="'.url('/storage/campaign_images/').'/'.$value->campaigns->thumbnail_image.'" alt="image" alt="image">';
                                                        }
                                                        else {
                                                            $html.= '<img src='.url('/assets/media/avatars/default_img.png').' alt="image" alt="image">';
                                                        }
                                                        if($value->campaign_is_active == 1) {
                                                        $html.= '<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                                        }
                                                        else {
                                                            $html.= '<div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                                        }
                                                    $html.= '</div>
                                                    <a href="'.url('influencer/campaign-details').'/'.$value->campaigns->id.'" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">'. $value->campaigns->name_en.'</a>

                                                    <div class="fw-semibold text-gray-400 mb-6"> '. $value->campaigns->short_description_en.'</div>

                                                    <div class="d-flex flex-center flex-wrap">

                                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                            <div class="fs-6 fw-bold text-gray-700"> $'. $value->campaigns->amount.'</div>
                                                            <div class="fw-semibold text-gray-400">Price Range</div>
                                                        </div>
                                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                            <div class="fs-6 fw-bold text-gray-700">'. getFans($value->campaigns->min_fans).' '. getFans($value->campaigns->max_fans).'</div>
                                                            <div class="fw-semibold text-gray-400">Fans Range</div>
                                                        </div>
                                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">';
                                                            if( $value->campaigns->is_video == 0) {

                                                            $html.= '<div class="fs-6 fw-bold text-gray-700">No streaming required</div>';
                                                            }
                                                            else if($value->campaigns->is_video == 1) {
                                                                $html.= '<div class="fs-6 fw-bold text-gray-700">Video Streaming</div>';
                                                                }
                                                            else {

                                                            $html.= '<div class="fs-6 fw-bold text-gray-700">Live Streaming</div>';
                                                            }

                                                            $html.= '<div class="fw-semibold text-gray-400">Streaming Type</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                            $html.= '</div>
                        </div>';
                    return response()->json(
                        [
                           'status' => true,
                           'message' => 'Data Found!',
                           'html' => $html
                        ]);
            }
            else
            {
                 return response()->json(
                    [
                       'status' => false,
                       'html' => '<div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                       <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                               <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                               <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                           </svg>
                       </span>
                       <div class="d-flex flex-stack flex-grow-1">
                           <div class="fw-semibold">
                               <h4 class="text-gray-900 fw-bold">No data found!</h4>
                           </div>
                       </div>
                   </div>',
                    ]);
            }
    }

    public function get_single_campaign($id) {
        $campaigns = Campaigns::with('brands','campaignConnectedInfluencer')->where('id',$id)->first();

        if($campaigns != null) {

                $product_details = CampaignProducts::where('campaign_id',$id)->get();
                $prodArr = [];

                $influencerArr = [];
                foreach($product_details as $products) {
                    $products_info = Product::join('campaign_products','products.id','campaign_products.product_id')->where('products.id',$products->product_id)->where('campaign_products.campaign_id',$products->campaign_id)->first();

                    $product_relations = Product::with('mainImage','category','brand')->where('products.id',$products->product_id)->first();

                    $prodArr[] = [
                        'id' => $product_relations->id,
                        'name_en' => $products_info->name_en,
                        'price' => $products_info->price,
                        'delivery_status' => $products_info->delivery_status,
                        'product_link' => $products_info->product_link,
                        'thumbnail_image' => $product_relations->mainImage->thumbnail_image,
                        'category' => $product_relations->category->name_en,
                        'brand' => @$product_relations->brand->title_en,
                    ];
                }

                 $connected_influencer_status = CampaignConnectedInfluencers::select('id', 'campaign_id', 'influencer_id', 'is_type', 'status', 'negotiation_price','payment_status','offer_status','invitation_status','contract_status')->where('campaign_id', $id)->where('influencer_id',\Auth::user()->id)->first();
                $ratingsInfo = RatingsAndReviews::where('campaign_id',$id)->where('influencer_id',\Auth::user()->id)->first();

                $this->data = array(
                    'title'                         => 'View Campaign Details',
                    'id'                            => $id,
                    'product_details'               => $product_details,
                    'prodArr'                       => $prodArr,
                    'campaigns'                     => $campaigns,
                    'role'                          => Auth::user()->role_id,
                    'connected_influencers'         => $influencerArr,
                    'connected_influencer_status'   => $connected_influencer_status,
                    'ratingsInfo'                   => $ratingsInfo
                );
                 return view('influencer-users.single_campaign_detail', $this->data );
            }

       else {
                return redirect()->route('campaign_details')->with('error','No data found.');
            }

    }

    public function productDetails(Request $request) {

        $all_products = Product::with('images','mainImage','brand','category')->orderBy('id','desc')->limit(30)->get();
        $display_product_count = count($all_products);
        $categories = Category::all();
        $brands = BrandDetails::all();
        $total_products = Product::count();
        $product_path = Product::PRODUCT_UPLOAD_PATH;
        return view('influencer-users.product-details',compact('all_products','total_products','categories','brands','display_product_count','product_path'));
    }

    public function loadProductDataAjax(Request $request)
    {
        $output = '';
        $id = $request->id;
        $all_products = Product::where('id','<',$id)->with('images','mainImage')->orderBy('id','desc')->limit(30)->get();
        $categories = Category::all();
        $brands = BrandDetails::all();
        $total_products = Product::min('id');
        $product_path = Product::PRODUCT_UPLOAD_PATH;
        // dd(!$all_products->isEmpty());
        if(!$all_products->isEmpty())
        {
            $output = '<div class="tab-content">
                        <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel" >
                        <div class="row">';
            foreach($all_products as $value)

            {
                $output .=
                    '<div class="col-md-6 col-xxl-4" >
                        <div class="card products-card border-1 h-100">
                            <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                <div class="symbol symbol-65px symbol-circle mb-5">';
                                    if(!empty($value->mainImage->thumbnail_image)) {
                                    $output.=   '<img src="'.url('/storage/products/').'/'.$value->id.'/'.$value->mainImage->image.'" alt="image">';
                                        }
                                        else {
                                    $output.= '<img src="'.url('/assets/media/avatars/default_img.png').' " alt="image">';
                                        }
                                    if($value->is_available == 1){
                                    $output .=  '<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                    }
                                    else {
                                    $output .= '<div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                    }
                                    $output .=  '</div>
                                    <a href="'.url('influencer/product-details').'/'.$value->id.'" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0 product-name-title">'. $value->name_en.' ('. $value->keyword_en.') </a>
                                    <div class="fw-semibold text-gray-400 mb-6"> '. $value->short_description_en.' </div>
                                    <div class="d-flex flex-center flex-wrap">
                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$ '. $value->price.'</div>
                                            <div class="fw-semibold text-gray-400">Price </div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">';
                                        if($value->is_available == 1){
                                        $output .=     '<div class="fs-6 fw-bold text-gray-700"> Yes </div>';
                                        }
                                        else{
                                       $output .= '<div class="fs-6 fw-bold text-gray-700"> No </div>';
                                        }

                                       $output .= '<div class="fw-semibold text-gray-400">Available</div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">'. $value->keyword_en.'</div>
                                            <div class="fw-semibold text-gray-400">Keyword</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   ';
            }

            $output.='</div><input type="hidden" id="loader_id"/><div id="products_id" class="d-none" value="'.$value->id.'">';
            $output .= '</div> </div> </div>';

            return response()->json(
                [
                   'status' => true,
                   'message' => 'Data Found!',
                   'output' => $output,
                   'products_id' => $value->id,
                   'max' => $total_products
                ]);
        }
        else {
            return response()->json(
                [
                    'status' => false,
                    'html' => '<div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">No data found!</h4>
                        </div>
                    </div>
                </div>',
            ]);
        }

    }


    public function get_product(Request $request){
        $searchValue = $request['text'];

        $categories = Category::all();

        if($searchValue == null) {
             $get_records = Product::with('images','mainImage','brand','category')->get();
        }
        else {
            $get_records = Product::orderBy('id','desc')
                    ->join('brand_details', 'brand_details.user_id', '=', 'products.brand_id')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('products.name_en', 'like', '%' .$searchValue . '%')
                    ->orWhere('products.description_en', 'like', '%' .$searchValue . '%')
                    ->orWhere('products.price', 'like',$searchValue)
                    ->orWhere('brand_details.title_en', 'like', '%' .$searchValue . '%')
                    ->orWhere('categories.name_en', 'like', '%' .$searchValue . '%')
                    ->orWhere('products.total_sample', 'like', '%' .$searchValue . '%')
                    ->select('products.*')->with('images','mainImage')->get();
        }

        $total_products_count = count($get_records);

        $product_path = Product::PRODUCT_UPLOAD_PATH;

        if(count($get_records)>0){
           $html =  '<div class="d-flex flex-wrap flex-stack pb-7">
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <h3 class="fw-bold me-5 my-1">' . $total_products_count . ' Items Found
                            <span class="text-gray-400 fs-6">by Recent Updates ↓</span></h3>
                        </div>
                    </div>
                    <div class="tab-content">
                       <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel" >
                          <div class="row g-6 g-xl-9">';
                            foreach($get_records as $products){
                            $html.= '<div class="col-md-6 col-xxl-4" >
                                <div class="card border-1">
                                   <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                      <div class="symbol symbol-65px symbol-circle mb-5">';
                                        if(!empty($products->mainImage->thumbnail_image)) {
                                    $html.=   '<img src="'.url('/storage/products/').'/'.$products->id.'/'.$products->mainImage->image.'" alt="image">';
                                        }
                                        else {
                                    $html.= '<img src="'.url('/assets/media/avatars/default_img.png').' " alt="image">';
                                        }

                                        if($products->is_available == 1)
                                        {

                                        $html.=  '<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                         }
                                         else  {

                                         '<div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>';
                                         }

                                    $html.= '</div>
                                      <a href="'.url('influencer/product-details').'/'.$products->id.'" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0 product-name-title">'. $products->name_en.' ( '.$products->keyword_en.' ) </a>
                                      <div class="fw-semibold text-gray-400 mb-6"> '. $products->short_description_en.'  </div>
                                      <div class="d-flex flex-center flex-wrap">
                                         <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$ '. $products->price.'</div>
                                            <div class="fw-semibold text-gray-400">Price </div>
                                         </div>
                                         <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">';
                                            if($products->is_available) {
                                            $html.= '<div class="fs-6 fw-bold text-gray-700">Yes</div>';
                                            }
                                            else {
                                            $html.=    '<div class="fs-6 fw-bold text-gray-700">No</div>';
                                            }
                                        $html.=  '<div class="fw-semibold text-gray-400"> Sample</div>
                                         </div>
                                         <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                           <div class="fs-6 fw-bold text-gray-700">'. $products->keyword_en.'</div>
                                            <div class="fw-semibold text-gray-400"> Keyword</div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>';
                            }
                        $html.= '</div>
                       </div>
                    </div>';
                    return response()->json(
                        [
                           'status' => true,
                           'message' => 'Data Found!',
                           'html' => $html
                        ]);
            }
            else
            {
                 return response()->json(
                    [
                       'status' => false,
                       'html' => '<div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                       <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                               <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                               <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                           </svg>
                       </span>
                       <div class="d-flex flex-stack flex-grow-1">
                           <div class="fw-semibold">
                               <h4 class="text-gray-900 fw-bold">No data found!</h4>
                           </div>
                       </div>
                   </div>',
                    ]);
            }
    }

    public function get_single_product($id) {

        $products = Product::with('sampleRequest')->find($id);
        // dd($products);
        if($products->sampleRequest->count() == 0) {
            $product_id = ProductSampleRequests::firstOrNew(array('id'=> ProductSampleRequests::max('id')+1));
        }
        if ( !$products ) {
            return redirect()->route('product_details')->with('error','No data found.');
        }

        $this->data = array(
            'title' => 'View Product Detail | ',
            'products' => $products,
            'product_path' => Product::PRODUCT_UPLOAD_PATH,
            'product_id' => $product_id->id ?? '',
            'campaign_id' => $campaign_id ?? '',
        );

        $view = view('influencer-users.single_product_detail', $this->data)->render();

        return view('influencer-users.single_product_detail', $this->data);
    }

    public function get_single_productcampaign($id,$campaign_id) {


        $user_role = \Auth::user()->role_id;

        $products = Product::with(['sampleRequest' =>  function ($query) use($id,$campaign_id) {
                $query->where('product_id','=',$id);
                $query->where('campaign_id','=',$campaign_id);
            }])->with('brand')->find($id);

        if ( !$products && $user_role=='Brand') {
            return redirect()->route('brand.product.index')->with('error','No data found.');
        }

        if(!$products && $user_role=='Influencer'){
            return redirect()->route('product_details')->with('error','No data found.');

        }

        $this->data = array(
            'title' => 'View Product Detail | ',
            'products' => $products,
            'product_path' => Product::PRODUCT_UPLOAD_PATH,
            'campaign_id' => $campaign_id,
        );

        $view = view('influencer-users.single_product_detail', $this->data)->render();

        return view('influencer-users.single_product_detail', $this->data);


        if ( !$products && $user_role=='Brand') {
            return redirect()->route('brand.product.index')->with('error','No data found.');
        }

        if(!$products && $user_role=='Influencer'){
            return redirect()->route('product_details')->with('error','No data found.');

        }
    }

    public function applyReasonCreate(Request $request) {
        $campaigns = Campaigns::where('id',$request->campaign_id)->first();
        $identifier = $request->identifier;

        if ( $request->ajax() ) {
            $this->data = array(
                'title' => 'Add Reason',
                'campaign_id' => $campaigns->id,
                'identifier' => $request->identifier
            );
            $view = view('influencer-users.applyReason', $this->data)->render();

            $this->data = array(
                'status' => true,
                'data' => array(
                    'view' => $view,
                ),
            );
        } else {
            $this->data = array(
                'status' => false,
                'message' => 'Something went wrong. Request method is not allowed',
            );
        }
        return response()->json($this->data);
    }

    public function applyReasonStore(Request $request) {

        $user_id = Auth::user()->id;

        $apply_reason = Campaigns::findOrFail($request->apply_reason_id);

        $brand_id = Campaigns::select('brand_id')->where('id',$request->apply_reason_id)->first();

        $brand_details = BrandDetails::with('user')->where('user_id',$brand_id->brand_id)->first();

        $campaigns = Campaigns::where('id',$request->apply_reason_id)->first();

        $check_connected = CampaignConnectedInfluencers::where('campaign_id',$campaigns->id)->where("influencer_id",\Auth::id())->exists();


        if($request->identifier == "apply" ) {
            $apply_reason->is_apply = 1;
            if($check_connected){
                CampaignConnectedInfluencers::where("campaign_id",$campaigns->id)->where("influencer_id",\Auth::id())->update(['accept_reason_en'=>$request->accept_reason_en,'invitation_status'=>'2']);
            }else{
                CampaignConnectedInfluencers::create([
                    "campaign_id" => $campaigns->id,
                    "influencer_id"=> \Auth::id(),
                    "accept_reason_en" => $request->accept_reason_en,
                    "invitation_status" => '2',
                    "influencer_is_accept" => '1',
                    "is_type" => '1'
                ]);
            }

        }

        if($request->identifier == "reject" ) {
                $apply_reason->is_apply =  2;
                CampaignConnectedInfluencers::where("campaign_id",$campaigns->id)->where("influencer_id",\Auth::id())->update(['reject_reason_en'=>$request->reject_reason_en,'invitation_status'=>'4']);

        }

        if($request->identifier == "direct-apply" ) {
            $apply_reason->apply_reason_en = $request->apply_reason_en;
            $apply_reason->is_apply = 3;
            if($check_connected){
                CampaignConnectedInfluencers::where("campaign_id",$campaigns->id)->where("influencer_id",\Auth::id())->update(['accept_reason_en'=>$request->apply_reason_en,'invitation_status'=>'2']);
            }else{
                CampaignConnectedInfluencers::insert([
                    "campaign_id" => $campaigns->id,
                    "influencer_id"=> \Auth::id(),
                    "accept_reason_en" => $request->apply_reason_en,
                    "is_request" => '1',
                    "invitation_status" => '2',
                    "influencer_is_accept" => '1',
                    "is_type"=> '1',
                ]);
            }
        }

        $apply_reason->save();

        $to_name = $brand_details->user->name;
        // $to_email = 'npp@narola.email';
        $to_email = $brand_details->user->email;

         $this->data = array(
                'title' => 'View Campaign Details',
                'apply_reason_en' => $request->apply_reason_en,
                'campaigns' => $campaigns,
                'brand_details' => $brand_details,
                'identifier' => $request->identifier,
                'accept_reason_en' => $request->accept_reason_en,
                'reject_reason_en' => $request->reject_reason_en,
                'user_id' => $user_id
            );

        if($apply_reason->save()) {
              Mail::send('mail.application', $this->data ,function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject('Campaign Invitation');
                });
        }

        return response()->json(
             [
               'status' => true,
               'message' => 'Applied successfully!'
             ]
        );
     }


    public function changeStatus(Request $request) {
        $user = auth()->user();
        $shipment_status = ProductSampleRequests::find($request->id);

        if($shipment_status == null) {
            $new_sample_request = ProductSampleRequests::create(['id'=> ProductSampleRequests::max('id') + 1,
                                                                            'campaign_id' => $request->campaign_id,
                                                                            'product_id' => $request->product_id,
                                                                            'influencer_id' => Auth::user()->id,
                                                                            'shipment_status' => $request->shipment_status,
                                                                            'brand_id' => $request->brand_id
                                                                        ]);

                if ( $new_sample_request ) {

                    $response = array(
                        'status' => true,
                        'message' => 'Status has been updated.',
                    );

                } else {
                    $response = array(
                        'status' => false,
                        'message' => 'Something went wrong, while update the status',
                    );
                }


        }else {
            $shipment_status->shipment_status = $request->shipment_status;
            $shipment_status->save();

             if ( $shipment_status ) {

                    $response = array(
                        'status' => true,
                        'message' => 'Status has been updated.',
                    );

                } else {
                    $response = array(
                        'status' => false,
                        'message' => 'Something went wrong, while update the status',
                    );
                }
        }


        return response()->json($response);

     }

    private function getUserDetails($userId, $type) {
        if($type == 1){
            $influencerData = User::whereId($userId)->first();
        } else {
            $influencerData = InfluencersRecords::whereId($userId)->first();
        }
        return $influencerData;
    }

    /* NPP Developement Start */

    public function acceptCampaignOffer(Request $request){
        $id = $request->id;
        $email = $request->email;
        $Price = $request->price;
        $connectedInfluencerInfo =  CampaignConnectedInfluencers::where("id",$id)->first();
        $campaignUrl        = route('guest_influencer_details',Auth::user()->id);
        $response           = [];

        $brandName = $request->brnadName;
        $CampName = $request->campName;
        $UserName = $request->UserName;

        $emailContent = $request->emailContent;

        // $to_name = "Topbrandmate";
        // $to_email ='npp@narola.email';
        $find           = ['{{ Brand Name }}'];
        $replacement    = [$brandName];
        $emailContent   = str_replace($find, $replacement, $emailContent);
        $subject        = "Campaign Offer Accepted By Influencer";
        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => $subject];
        $getMail       = BrandDetails::where('work_email', $email)->first();
        $userData       = User::where("id",$getMail->user_id)->first();
        // $userData->email = 'npp@narola.email';
        if(!empty($userData)){
            try {
                $msg = "Offer accepted successfully.";
                $userData->notify(new SendCampaignOffer($emailContent));
                CampaignConnectedInfluencers::whereId($id)->update(['offer_status'=> '2','contract_status'=> '1','negotiation_price' => $request->price]);
                $response = [ 'status' => true, 'message' => $msg ];
                /* Add payment details */
                PaymentContract::create([
                    'campaign_connected_influencers_id' => $id,
                    'campaign_id'                       => $connectedInfluencerInfo->campaign_id,
                    'influencer_id'                     => Auth::user()->id,
                    'brand_id'                          => $request->brandId,
                    'amount'                            => $request->price,
                    'payment_status'                    => '1',
                    'created_at'                        => Carbon::now()
                ]);
                /* Stripe charge api */
                $brand_details = BrandDetails::whereId($request->brandId)->first();
                $customer_id = $brand_details->stripe_customer_id;
                (new StripePayment())->CampaignPayment($customer_id,$request->price);
                // add credit balance in admin's stripe account
                (new StripePayment())->PaytoAdmin($this->adminStripeCustId,$request->price);
                 /* Add activity log start - NPP */
                 $msg = $CampName .' campaign offer accepted by '.auth()->user()->name.' influencer!' ;
                 $user = Auth::user();
                 add_admin_log('offer_accepted',$msg,$userData,$user);
                 add_activity_logs('offer_accepted',$msg,"Brand",$brand_details->user_id);
                 /* Add activity log end - NPP */
            }
            catch(\Exception $e) {
                $response = [ 'status' => false, 'message' => $e->getMessage() ];
            }
        } else {
            $response = [ 'status' => false, 'message' => 'User not found!' ];
        }
        return response()->json($response);
    }

    function rejectCampaignOffer(Request $request){
        $id = $request->id;
        $email = $request->email;
        $update = CampaignConnectedInfluencers::where("id",$id)->update(['offer_status'=> '3','reject_reason_en'=>$request->Reason]);
        $connectedInfluencerInfo =  CampaignConnectedInfluencers::where("id",$id)->first();
        $getMail       = BrandDetails::where('work_email', $email)->first();
        $userData       = User::where("id",$getMail->user_id)->first();

        if ( $update ) {
                /* Send mail notification to influencer for intial accept */
                $this->data = array(
                    'brandName' => $request->BrandName,
                    'CampName' => $request->campName,
                    'UserName' => $request->UserName,
                    'reason' => $request->Reason
                );
                $to_name = "Topbrandmate";
                // $to_email ='npp@narola.email';
                $to_email = $userData->email;
                Mail::send('mail.reject_offer', $this->data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Campaign Offer Rejected');
                });
                 /* Add activity log start - NPP */
                 $msg = $request->campName .' campaign offer rejected by '.auth()->user()->name.' influencer!' ;
                 $user = Auth::user();
                 add_admin_log('offer_rejected',$msg,$userData,$user);
                 add_activity_logs('offer_rejected',$msg,"Brand");
                 /* Add activity log end - NPP */
                $response = [
                    'status' => true,
                    'message' => 'Campaign offer rejected successfully.'
                ];
        }else{
            $response = [
                'status' => false,
                'message' => 'Something went wrong.'
            ];
        }
        return response()->json($response);
    }

    function negociate_request(Request $request){
        // dd($request);
        $id = $request->id;
        $email = $request->email;
        $Price = $request->negociate_price;
        $campaignUrl        = route('guest_influencer_details',Auth::user()->id);
        $response           = [];
        $update = CampaignConnectedInfluencers::where("id",$id)->update(['negotiation_price' => $Price,'offer_status'=> '4']);
        $connectedInfluencerInfo =  CampaignConnectedInfluencers::where("id",$id)->first();
                /* Send mail notification to influencer for intial accept */

                    $brandName = $request->brandName;
                    $CampName = $request->campName;
                    $UserName = $request->UserName;

                    $emailContent = $request->email_content;
                    $subject        = "Campaign Negotiate Request By Influencer";
                    $find           = ['{{ Brand Name }}', '{{ New Price }}'];
                    $replacement    = [$brandName, "$ ".$Price];
                    $emailContent   = str_replace($find, $replacement, $emailContent);
                    $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => $subject];
                    $getMail        = BrandDetails::where('work_email', $email)->first();
                    $userData       = User::where("id",$getMail->user_id)->first();
                    // $userData->email = 'npp@narola.email';
                    // dd($userData);
                    if(!empty($userData)){
                        try {
                            $msg = "Negotiation request sent successfully.";
                            $userData->notify(new SendCampaignOffer($emailContent));
                            $statusValue    = "4";
                            $columnName     = "offer_status";
                            CampaignConnectedInfluencers::whereId($id)->update([$columnName => $statusValue,'negotiation_price' => $Price]);
                            $response = [ 'status' => true, 'message' => $msg ];
                            /* Add activity log start - NPP */
                            $message = $UserName.' Influencer has been sent negotiate offer request for this '. $CampName. ' campagin';
                            $user = Auth::user();
                            add_admin_log('negotiate_request',$message,$userData,$user);
                            add_activity_logs('negotiate_request',$message,"Brand",$userData->user_id);
                            /* Add activity log end - NPP */
                        }
                        catch(\Exception $e) {
                            $response = [ 'status' => false, 'message' => $e->getMessage() ];
                        }
                    } 
                    else {
                        $response = [ 'status' => false, 'message' => 'User not found!' ];
                    }
                    return response()->json($response);
        
    }

    function completeOffer(Request $request){
        $id = $request->id;
        $email = $request->email;
        $Price = $request->price;
        $connectedInfluencerInfo =  CampaignConnectedInfluencers::where("id",$id)->first();
        $campaignUrl        = route('guest_influencer_details',Auth::user()->id);
        $response           = [];
        $videoUrl   =   $request->videoUrl;

        $brandName = $request->brnadName;
        $CampName = $request->campName;
        $UserName = $request->UserName;

        $emailContent = $request->emailContent;

        $to_name = "Topbrandmate";
        // $to_email ='npp@narola.email';
        $find           = ['{{ Brand Name }}', '{{ Campaign Name }}','{{ Video Url }}'];
        $replacement    = [$brandName, "$ ".$CampName,$videoUrl];
        $emailContent   = str_replace($find, $replacement, $emailContent);
        $subject        = "Campaign Completed Request By Influencer";
        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => $subject];
        $getMail        = BrandDetails::where('work_email', $email)->first();
        $userData       = User::where("id",$getMail->user_id)->first();
        // $userData->email = 'npp@narola.email';
        if(!empty($userData)){
            try {
                $msg = "Campaign offer completed successfully.";
                $userData->notify(new SendCampaignOffer($emailContent));
                $statusValue    = "2";
                $columnName     = "contract_status";
                CampaignConnectedInfluencers::whereId($id)->update([$columnName => $statusValue,'video_url' => $videoUrl]);
                $response = [ 'status' => true, 'message' => $msg ];
                /* Add activity log start - NPP */
                $msg = $CampName .' campaign request has been completed by '.auth()->user()->name.' influencer!' ;
                $user = Auth::user();
                add_admin_log('completed',$msg,$userData,$user);
                add_activity_logs('completed',$msg,"Brand",$userData->user_id);
                /* Add activity log end - NPP */
            }
            catch(\Exception $e) {
                $response = [ 'status' => false, 'message' => $e->getMessage() ];
            }
        } else {
            $response = [ 'status' => false, 'message' => 'User not found!' ];
        }
        return response()->json($response);
    }
    function paymentRequest(Request $request){
        $id                 = $request->id;
        $campName           = $request->campName;
        $userName           = $request->userName;
        $brandName           = $request->brnadName;
        $userEmail          = $request->email;
        $finalPrice         = $request->price;
        $emailContent       = $request->emailContent;
        $status             = $request->status;
        $campaignUrl        = route('guest_influencer_details',Auth::user()->id);
        $response           = [];

        $find           = ['{{ Brand Name }}', '{{ Campaign Name }}', '{{ Final Price }}','{{ User Name }}'];
        $replacement    = [$brandName, $campName, "$ ".$finalPrice,$userName];
        $emailContent   = str_replace($find, $replacement, $emailContent);

        $subject        = $status == "Payment Request" ? "Campaign Payment Request By Influencer" : "Resubmit Payment Request By Influencer";
        $emailContent   = ['emailContent' => $emailContent, 'url' => $campaignUrl, 'subject' => $subject];

        $getMail       = BrandDetails::where('work_email', $userEmail)->first();
        $userData       = User::where("id",$getMail->user_id)->first();
        // $userData->email = 'npp@narola.email';
        if(!empty($userData)){
            try {
                $msg = "Payment request sent successfully!";
                $userData->notify(new SendCampaignOffer($emailContent));
                $statusValue    = $status == "Payment Request" ? "1" : "3";
                $columnName     = "payment_status";
                CampaignConnectedInfluencers::whereId($id)->update([$columnName => $statusValue]);
                $response = [ 'status' => true, 'message' => $msg ];
                /* Add activity log start - NPP */
                $msg = auth()->user()->name .' influencer has been requested for payment for this '.$campName.' campaign.' ;
                $user = Auth::user();
                add_admin_log('payment_request',$msg,$userData,$user);
                add_activity_logs('payment_request',$msg,"Brand",$userData->user_id);
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

    /* NPP Development End */

     public function ratings() {

        $this->data = array(
            'title' => 'Add Ratings',
        );

        $view = view('influencer-users.ratings', $this->data)->render();

        $response = array(
            'status'    => true,
            'data'      => array(
                'view'  => $view,
            ),
        );

        return response()->json($response);
    }

    public function ratingsStore( Request $request) {
        $user = auth()->user();

        if(Auth::user()->hasRole('Influencer')) {
            $rating_types = implode (",",$request->rating_type);

            $ratings = RatingsAndReviews::create([
                'influencer_id'     => $user->id,
                'brand_id'          => $request->brand_id,
                'campaign_id'       => $request->campaign_id,
                'review_en'         => $request->review_en,
                'is_type'           => $request->user_type,
                'star_ratings'      => $request->star_ratings,
                'ratings_by'        => 2,
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

}

