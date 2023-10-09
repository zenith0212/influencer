<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InfluencersRecords;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use App\Models\BrandDetails;
use App\Models\InfluencerDetails;
use App\Models\InfluencerScrapDetails;
use App\Models\CampaignConnectedInfluencers;
use App\Models\CampaignProducts;
use App\Models\Campaigns;
use DB;
use App\Models\Country;
use App\Models\{ContentDetails, Category, RequestDemo, Product, JoinUs};

class UserController extends Controller
{
    //
    public function index(){

        $this->data = array(
            'title' => 'Brands | ',
            'breadcrumbs' => array(
                'title' => 'Brands',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'brand_users' => 'Brands',
                    '',
                    '#' => 'List Brand',
                ),
            ),
        );

        return view('admin.users.userlist',$this->data);
    }

    public function guestSubscription(){
        $plans = Plan::where('status','=','1')->get();
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.guest_subscription_plan',compact('plans','content'));
    }

    public function influencer_users(){

        $this->data = array(
            'title' => 'Influencers | ',
            'breadcrumbs' => array(
                'title' => 'Influencers',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'influencers' => 'Influencers',
                    '',
                    '#' => 'List Influencer',
                ),
            ),
        );

        return view('admin.users.influencers', $this->data);
    }

    public function getBrands(Request $request){
          ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = User::select('count(*) as allcount')->where('users.role_id','=','Brand')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->where('users.role_id','=','Brand')->count();

        // Fetch records
        $records = User::leftjoin('brand_details','brand_details.user_id',"=","users.id")
                    // ->leftjoin('categories','categories.id','=','brand_details.product_category')
                    // ->orderBy($columnName,$columnSortOrder)
                    ->where('users.role_id','=','Brand')
                    ->where('users.name', 'like', '%' .$searchValue . '%')
                    ->where('users.email', 'like', '%' .$searchValue . '%')
                    ->orwhere('brand_details.address_en', 'like', '%' .$searchValue . '%')
                    ->orwhere('brand_details.title_en', 'like', '%' .$searchValue . '%')
                    ->select('brand_details.logo','users.email','users.profile','brand_details.address_en','users.id','brand_details.title_en')
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();

        $data_arr = array();

        foreach($records as $record){
            $name = $record->name;
            $email = $record->email;
            // $date = date("Y-m-d",strtotime($record->created_at));
            $address = $record->address_en;
            $category = $record->name_en;
            $profile = $record->logo;
            $brand_title = $record->title_en;
            $id = $record->id;

            $data_arr[] = array(
                'id' => $id,
                'logo' => $profile,
                "name" => $name,
                "email" => $email,
                "address" => $address,
                "title" => $brand_title,
                // "category" => $category,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function getInfluencers(Request $request){
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

      // Total records
      $totalRecords = InfluencersRecords::select('count(*) as allcount')->count();
      $totalRecordswithFilter = InfluencersRecords::select('count(*) as allcount')
      ->where('nickname', 'like', '%' .$searchValue . '%')
      ->orwhere('unique_id', 'like', '%' .$searchValue . '%')
      ->orwhere('signature', 'like', '%' .$searchValue . '%')
      ->orwhere('follower_count', 'like', '%' .$searchValue . '%')
      ->count();

      // Fetch records
      $records = InfluencersRecords::orderBy('id','desc')
                ->where('nickname', 'like', '%' .$searchValue . '%')
                ->orwhere('unique_id', 'like', '%' .$searchValue . '%')
                ->orwhere('country', 'like', '%' .$searchValue . '%')
                ->orwhere('follower_count', 'like', '%' .$searchValue . '%')
                ->orwhere('average_engagement_rate', 'like', '%' .$searchValue . '%')
                ->select('influencers_records.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

      $data_arr = array();

      foreach($records as $record){
          $id = $record->id;
          $name = $record->nickname;
          $profile = $record->media_profile;
          $country = $record->country;
          $followers = $record->follower_count;
          $views = $record->average_play_count;
          $likes = $record->average_like_count;
          $engement = $record->average_engagement_rate;
          $email = $record->email;


          $data_arr[] = array(
              "id" => $id,
              "media_profile" => $profile,
              "email" => isset($email) ? $email : 'N/A',
              "name" => $name,
              "country" => $country,
              "followers" => intWithStyle($followers),
              "views" => intWithStyle($views),
              "likes" => intWithStyle($likes),
              "engement" => $engement.'%',
          );

      }

      $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr
      );

      echo json_encode($response);
      exit;
    }

    public function getByIdinfluencer($id){
        $data = InfluencersRecords::where('id',$id)->first();
        return view('admin.users.get_single_influencer',compact('data'));
    }

    public function requestDemo() {
        $content        = ContentDetails::where("title_en","Common")->get();
        $categories     = Category::select('id','name_en')->get();
        $countries      = Country::all();
        return view('frontend.requestDemo',compact('content', 'categories', 'countries'));
    }

    public function aboutUs() {
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.about_us',compact('content'));
    }

    public function contactUs() {
        $content        = ContentDetails::where("title_en","Common")->get();
        $categories     = Category::select('id','name_en')->get();
        $countries      = Country::all();
        return view('frontend.contact_us',compact('content', 'categories', 'countries'));
    }

    public function whatIsTopBrandMate () {
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.whatIsTopBrandMate ',compact('content'));
    }

    public function whyTopBrandMate () {
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.whyTopBrandMate ',compact('content'));
    }

    public function termsOfService () {
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.termsOfService ',compact('content'));
    }

    public function privacy () {
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.privacy ',compact('content'));
    }

    public function comingsoon () {
        $content = ContentDetails::where("title_en","Common")->get();
        return view('frontend.comingsoon ',compact('content'));
    }

    public function joinus () {
        $content    = ContentDetails::where("title_en","Common")->get();
        $products   = Product::select('id', 'name_en')->get();
        return view('frontend.joinus ',compact('content', 'products'));
    }

    public function InfluencerDetails($id) {

        $data = User::find((int)$id);

        $influencer_details = InfluencerDetails::where('user_id',$id)->first();

        $campaigns_data = CampaignConnectedInfluencers::with(['campaigns'])->where('influencer_id',$influencer_details->id)->get();


        if ( $data ) {
            return view('frontend.influencer-details', compact('data','influencer_details','campaigns_data'));
        } else {
            session()->flash('error', 'Influencer detail not found!...');
            return redirect()->route('welcome');
        }


    }

    public function destroy(Request $request): JsonResponse
    {
        $user = auth()->user();
        $delete = InfluencersRecords::findOrFail($request->id);
        InfluencerScrapDetails::where("influencer_record_id",$request->id)->delete();

        if ( $delete ) {
            if ( $delete->delete() ) {
                activity('deleted')
                    ->performedOn($delete)
                    ->causedBy($user)
                    ->log("Influencer has been deleted by {$user->name}");

                return response()->json([
                    'status' => true,
                    'message' => 'Influencer has been deleted!',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! Influencer not found!',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong! Influencer not found!',
        ]);
    }

    public function delete_brand(Request $request): JsonResponse
    {
        $user = auth()->user();
        $delete = User::findOrFail($request->id);
        $delete_brand = BrandDetails::where("user_id",$request->id)->delete();

        if ( $delete ) {
            if ( $delete->delete() ) {
                activity('deleted')
                    ->performedOn($delete)
                    ->causedBy($user)
                    ->log("Brand has been deleted by {$user->name}");

                return response()->json([
                    'status' => true,
                    'message' => 'Brand has been deleted!',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! Brand not found!',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong! Brand not found!',
        ]);
    }

    public function create_brand(): JsonResponse
    {
        $getcountrylist = Country::all();
        $this->data = array(
            'title' => 'Create New Brand',
            'getcountrylist' => $getcountrylist
        );

        $view = view('admin.users.create_brand', $this->data)->render();
        $response = array(
            'status' => true,
            'data' => array(
                'view' => $view,
            ),
        );

        return response()->json($response);
    }

    public function add_brand(Request $request){
        dd("here");
    }

    public function edit_brand($id): JsonResponse
    {
        $user = User::find($id);
        $brand =  BrandDetails::where("user_id",$id)->first();
        // dd($brand);
        if ( $user ) {
            $this->data = array(
                'user' => $user,
                'brand_details' => $brand
            );
            $view = view('admin.users.brand_edit', $this->data)->render();

            $response = array(
                'status' => true,
                'data' => array(
                    'view' => $view,
                ),
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Something went wrong.',
            );
        }

        return response()->json($response);
    }

    public function update_brand(Request $request, $id): JsonResponse
    {
        $user = auth()->user();
        $brand = BrandDetails::where("id",$id)->first();
        if ( $brand ) {
            if ( $request->file() ) {
                $fileName = time().'_'.$request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('brandLogo', $fileName, 'public');
                $brand->logo = $fileName;
            }

            $update = BrandDetails::where("id",$id)->update([
                'title_en' => $request->title_en,
                'address_en' => $request->address_en,
                'work_email' => $request->work_email,
                'company_name' => $request->company_name
            ]);

            if ( $brand->save() ) {
                activity('updated')
                    ->performedOn($brand)
                    ->causedBy($user)
                    ->log("Brnad {$brand->title_en} has been updated by {$user->name}");

                $response = [
                    'status' => true,
                    'message' => 'Brand details has been updated.'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Something went wrong while update the brand details.',
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Something went wrong, brand details not found.',
            ];
        }
        return response()->json( $response );
    }

    public function registered_users(){

        $this->data = array(
            'title' => 'Influencers | ',
            'breadcrumbs' => array(
                'title' => 'Influencers',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'influencers' => 'Influencers',
                    '',
                    '#' => 'List Influencer',
                ),
            ),
        );

        return view('admin.users.registered_influencers', $this->data);
    }


    public function get_register_users(Request $request){
            ## Read value
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowperpage = $request->get("length"); // Rows display per page

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index
            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
            $searchValue = $search_arr['value']; // Search value

            // Total records
            $totalRecords = User::select('count(*) as allcount')->where('users.role_id','=','Influencer')->count();
            $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->where('users.role_id','=','Influencer')->count();

            // Fetch records
            $records = User::leftjoin('influencer_details','influencer_details.user_id',"=","users.id")
                        // ->leftjoin('categories','categories.id','=','brand_details.product_category')
                        // ->orderBy($columnName,$columnSortOrder)
                        ->where('users.role_id','=','Influencer')
                        ->where('users.name', 'like', '%' .$searchValue . '%')
                        ->where('users.email', 'like', '%' .$searchValue . '%')
                        ->select('influencer_details.media_profile_url','users.email','users.profile','users.name','influencer_details.social_media_link','users.id','influencer_details.nickname_en')
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
            $data_arr = array();

            foreach($records as $record){
                $name = $record->name;
                $email = $record->email;
                // $date = date("Y-m-d",strtotime($record->created_at));
                $profile = $record->media_profile_url;
                $nickname = $record->nickname_en;
                $id = $record->id;
                $link = $record->social_media_link;

                $data_arr[] = array(
                    'id' => $id,
                    'logo' => $profile,
                    "name" => $name,
                    "email" => $email,
                    "link" => $link,
                    "nickname" => $nickname,
                    // "category" => $category,
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );

            echo json_encode($response);
            exit;
    }

    public function storeRequestDemo(Request $request){
        $requestData = $request->all();
        unset($requestData['_token']);
        $requestData['created_at'] = \Carbon\Carbon::now();
        $msg = $requestData['page_type'] == 1 ? 'Contacted successfully!' : 'Requested for demo successfully!';
        $result = RequestDemo::insert($requestData);
        if($result){
            return redirect()->back()->with('success', $msg);
        } else {
            return redirect()->back()->with('error', 'Something went wrong while requesting for demo!');
        }
    }

    public function storeJoinUs(Request $request){
        $requestData = $request->all();
        unset($requestData['_token']);
        $requestData['created_at'] = \Carbon\Carbon::now();
        $result = JoinUs::insert($requestData);
        if($result){
            return redirect()->back()->with('success', 'Joined successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong while requesting for demo!');
        }
    }
}
