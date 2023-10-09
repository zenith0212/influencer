<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfluencersRecords;
use App\Models\Campaigns;
use App\Models\BrandDetails;
use App\Models\Country;
use App\Models\Favourites;


class FindInfluencerController extends Controller
{
    //
    public function index(Request $request)
    {
        // $get_records = InfluencersRecords::orderBy('id', 'asc')->limit('24')->get();
        $get_records = InfluencersRecords::with("influencerDetails")->orderBy('follower_count','desc')->limit(24)->get();
        $total      =   InfluencersRecords::count();
        $getcountrylist = Country::all();
        return view('brand-users.find_influencers',compact('get_records','getcountrylist','total'));
    }

    public function favouriteInfluencers() {
        $title                          = "Favourite Influencers";
        $totalFavourites                = Favourites::select('count(*) as allcount')->where('is_favourite','1')->count();
        return view('brand-users.favourite_influencers',compact('title','totalFavourites'));
    }

    public function favouriteInfluencersList(Request $request) {
        ## Read value
        $draw                   = $request->get('draw');
        $start                  = $request->get("start");
        $rowperpage             = $request->get("length"); // Rows display per page

        $columnIndex_arr        = $request->get('order');
        $columnName_arr         = $request->get('columns');
        $order_arr              = $request->get('order');
        $search_arr             = $request->get('search');
        
        $columnIndex            = $columnIndex_arr[0]['column']; // Column index
        $columnName             = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder        = $order_arr[0]['dir']; // asc or desc
        $searchValue            = $request->get('search_string'); // Search value

        // Total records
        $totalFavourites                = Favourites::select('count(*) as allcount')->where('is_favourite','1')->count();
        
        $totalFavouritesWithFilter      = Favourites::select('count(*) as allcount')->join('influencers_records','influencers_records.id','favourites.influencer_id')->where('influencers_records.nickname' , 'like', '%' .$searchValue . '%')->where('favourites.is_favourite','1')->count();

        // Fetch records
        $get_records = Favourites::orderBy('favourites.id','desc')
                    ->join('influencers_records','influencers_records.id','favourites.influencer_id')
                    ->where('influencers_records.nickname' , 'like', '%' .$searchValue . '%')->where('favourites.is_favourite','1')->get();

        $response = array();

        foreach( $get_records as $favourites ) {
            $response[] = array(
                'id'                => $favourites->id,
                'nickname'          => $favourites->nickname,
                'country'           => $favourites->country,
                'image'             => $favourites->media_profile,
                'follower_count'    => $favourites->follower_count,
                'following_count'   => $favourites->following_count,
                'like_count'        => $favourites->average_like_count
            );
        }

        return response()->json(array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalFavourites,
            'iTotalDisplayRecords'  => $totalFavouritesWithFilter,
            'aaData'                => $response,
         ));
    }

    public function get_influencers(Request $request){
        $searchValue = $request['text'];
        // $name = $request['name'];
        $category = $request['category'];
        $country = $request['country'];
        $min = (int) $request['min'];
        $max = (int) $request['max'];
        $min_rate      = $request->min_rate ? intval($request->min_rate) : '';
        $max_rate       = $request->max_rate > 0 ? intval($request->max_rate) : '';
        $get_records = [];
        
        $data = InfluencersRecords::with("influencerDetails")->orderBy('follower_count','desc')->limit(24);
        // dd($min_rate,$max_rate); 
        if ($searchValue != null) {
            $data->where('nickname', 'like', '%' .$searchValue . '%')->orwhere('unique_id', 'like', '%' .$searchValue . '%')->orwhere('signature', 'like', '%' .$searchValue . '%');
            $count  = InfluencersRecords::where('nickname', 'like', '%' .$searchValue . '%')->orwhere('unique_id', 'like', '%' .$searchValue . '%')->orwhere('signature', 'like', '%' .$searchValue . '%')->count();
            $total  =   intWithStyle($count);
        }
        if($category != null){
            $data->where('category',$category);
            $count  = InfluencersRecords::where('category',$category)->count();
            $total  =   intWithStyle($count);
        }
        if($country != null){
            $data->where('country',$country);
            $count  = InfluencersRecords::where('country',$country)->count();
            $total  =   intWithStyle($count);
        }
        if($min!=null && $max){
            $data->whereBetween('follower_count',[$min,$max]);
            $count  = InfluencersRecords::whereBetween('follower_count',[$min,$max])->count();
            $total  =   intWithStyle($count);
        }
        if($min_rate <= 0 && $max_rate){
            $data->whereBetween('average_engagement_rate',[$min_rate,$max_rate]);
            if($min!=null && $max!=null){
                $count  = InfluencersRecords::whereBetween('average_engagement_rate',[$min_rate,$max_rate])->where('country',$country)->whereBetween('follower_count',[$min,$max])->count();
            }else{
                $count  = InfluencersRecords::whereBetween('average_engagement_rate',[$min_rate,$max_rate])->where('country',$country)->count();
            }
            $total  =   intWithStyle($count);
        }
        if($min_rate > 0 && $max_rate){
            $data->whereBetween('average_engagement_rate',[$min_rate,$max_rate]);
            $count  = InfluencersRecords::whereBetween('average_engagement_rate',[$min_rate,$max_rate])->count();
            $total  =   intWithStyle($count);
        }

        // dd($total);
        // \DB::enableQueryLog(); 
        $data = $data->get();
        // $total      = count($data);
        // dd(\DB::getQueryLog());    
        if(!($data)->isempty()){
            $view = view('brand-users.influencers_filters.get_data', compact('data'))->render();
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Found!',
                    'html' => $view,
                    'total' => $total
                ]);
        } else {
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

    public function get_single_influencers($id){
       
        $data = InfluencersRecords::with("influencerDetails")->find($id);
        // dd($data);
        if ( $data ) {
            $brand_id = BrandDetails::where('user_id',\Auth::id())->first();
            $brand_data = Campaigns::where('brand_id',$brand_id->id)->where("is_draft",1)->get();
            return view('brand-users.get_influencer_details',compact('data','brand_data'));
        } else {
            session()->flash('error', 'Influencer detail not found!...');
            return redirect()->route('brand.find_influencer');
        }
    }

    public function loadData(Request $request)
    {
        $id = $request->id;
        $country    = isset($request->country) ? $request->country : '';
        $min        = isset($request->min) ? $request->min : '';
        $max        = isset($request->max) ? $request->max : '';
        $min_rate      = $request->min_rate ? $request->min_rate : '';
        $max_rate       = $request->max_rate > 0 ? $request->max_rate : '';
        $searchValue    =   $request->searchValue;
        $data = InfluencersRecords::with("influencerDetails")->where("id" ,'>', $id)->orderBy('follower_count','desc')->limit(150);
        $total  =   $request->total;
        
       
        if ($searchValue != null) {
            $data->where('nickname', 'like', '%' .$searchValue . '%')->orwhere('unique_id', 'like', '%' .$searchValue . '%')->orwhere('signature', 'like', '%' .$searchValue . '%');
            $count  = InfluencersRecords::where('nickname', 'like', '%' .$searchValue . '%')->orwhere('unique_id', 'like', '%' .$searchValue . '%')->orwhere('signature', 'like', '%' .$searchValue . '%')->count();
            $total  =   intWithStyle($count);
        }
        // if($category != null){
        //     $data->where('category',$category);
        // }
        if($country != null){
            $data->where('country',$country);
            $count  = InfluencersRecords::where('country',$country)->count();
            $total  =   intWithStyle($count);
        }
        if($min!=null && $max){
            $data->whereBetween('follower_count',[$min,$max]);
            $count  = InfluencersRecords::whereBetween('follower_count',[$min,$max])->count();
            $total  =   intWithStyle($count);
        }
        if($min_rate <= 0 && $max_rate){
            $data->whereBetween('average_engagement_rate',[$min_rate,$max_rate]);
            if($min!=null && $max!=null){
                $count  = InfluencersRecords::whereBetween('average_engagement_rate',[$min_rate,$max_rate])->where('country',$country)->whereBetween('follower_count',[$min,$max])->count();
            }else{
                $count  = InfluencersRecords::whereBetween('average_engagement_rate',[$min_rate,$max_rate])->where('country',$country)->count();
            }
            $total  =   intWithStyle($count);
        }
        if($min_rate > 0 && $max_rate){
            $data->whereBetween('average_engagement_rate',[$min_rate,$max_rate]);
            $count  = InfluencersRecords::whereBetween('average_engagement_rate',[$min_rate,$max_rate])->count();
            $total  =   intWithStyle($count);
        }
        $data = $data->get();
        
       /*  \DB::enableQueryLog(); 
        $all_influencers = InfluencersRecords::where('id','>',$id)
                            ->when(request($country), function ($query) use($country) {
                                $query->where('country',"=",$country);
                            })
                            ->when(request($min,$max), function ($query) use ($min, $max) {
                                $query->whereBetween('follower_count', [$min,$max]);
                            })
                            ->when(request($min_rate,$max_rate), function ($query) use ($min_rate, $max_rate) {
                                $query->whereBetween('average_engagement_rate', [intval($min_rate), intval($max_rate)]);
                            })
                            ->limit(50)
                            ->get();
                        dd($all_influencers);
                        dd(\DB::getQueryLog()); */       
                                     
        if(!$data->isEmpty())
        {
            $cms = '<br/>';
            foreach($data as $key=>$value){
                            $cms .='<div class="card-list">
                                    <div class="row align-items-center gx-8">
                                        <div class="col-xl-4">
                                            <div class="influencer-profile">
                                                <div class="influencer-profile-img">
                                                    <img src="'.$value->media_profile.'" alt="">
                                                </div>
                                                <div class="influencer-details">
                                                    <h4> 
                                                        <a href='.url('brand/find-influencer').'/'.$value->id.'> '. $value->nickname.'</a>  
                                                       
                                                        <a href="#"><i class="fa-regular fa-heart"></i></a>
                                                    </h4>
                                                    <p>'.$value->signature.'</p>
                                                    <div class="influencer-lable">
                                                        <span>beast</span>
                                                        <span>Food</span>
                                                        <span>mrbeast</span>

                                                        <a href=""><i class="fa-solid fa-ellipsis"></i></a>
                                                    </div>
                                                    <ul>
                                                        <li><i class="fa-solid fa-users"></i> '.intWithStyle($value->following_count) .'</li>
                                                        <li><i class="fa-solid fa-user-plus"></i>'.intWithStyle($value->follower_count) .'</li>
                                                        <li><i class="fa-solid fa-file-video"></i>'.intWithStyle($value->average_play_count) .'</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="influencer-engagement-main">
                                                <div class="influencer-engagement">
                                                    <div class="influencer-engagement-list">
                                                        <span>Country</span> <b>'. $value->country .'</b>
                                                    </div>
                                                    <div class="influencer-engagement-list">
                                                        <span>Followers</span> <b>'.intWithStyle($value->follower_count) .'</b>
                                                    </div>
                                                    <div class="influencer-engagement-list">
                                                        <span>Engagement Rate</span> <b>'.intWithStyle($value->average_engagement_rate).'</b>
                                                    </div>
                                                    <div class="influencer-engagement-list">
                                                        <span>Est. Views</span> <b>'.intWithStyle($value->average_play_count) .'</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="row">';
                                            $collection = collect($value['influencerDetails']);
                                            $chunk = $collection->take(2);
                                            if(!$chunk->isEmpty()){
                                                foreach($chunk as $key=>$details){
                                                    $likes   =   intWithStyle($details->like_count);
                                                    $comment    =   intWithStyle($details->comment_count);
                                                    $share  =   intWithStyle($details->share_count);
                                                    $play   =   intWithStyle($details->play_count);
                                    $cms.='<div class="col-6">
                                                <div class="influencer-content-img">
            <a id="playVideo" class="playVideo-'.$details->id.' data-link='.urldecode("'$details->link'").' data-likes="'.intWithStyle($details->like_count) .'" data-comment="'. intWithStyle($details->comment_count).'" data-share = "'.intWithStyle($details->share_count) .'" data-play='.intWithStyle($details->play_count).' onclick="playVideo('.$details->id.','.urldecode("'$details->link'").','.urldecode("'$likes'").','.urldecode("'$comment'") .','.urldecode("'$share'").','.urldecode("'$play'").')">
                
                <img width="200" height="200" src="'. $details->profile .'" class="play_video" />
                </a>
                                            </div>
                                        </div>';
                                                }
                                            }else{
                                                $cms.='<div class="campaign-actions mb-4">
                                                    <span class="badge badge-danger">No data Available</span>
                                                </div>';
                                               }
                                    $cms.='</div>
                                        </div>
                                    </div>
                                </div>';
                                }   
                                $cms.='</div><input type="hidden" id="loader_id"/><div id="influencer_id" class="d-none" value="'.$value->id.'">';                      
            return response()->json(
                [
                   'status' => true,
                   'message' => 'Data Found!',
                   'html' => $cms,
                   'influencer_id' => $value->id,
                   'total'    =>  $total
                ]);
        }
        else{
            return response()->json(
                [
                   'status' => false,
                   'message' => 'No Data Found!',
                ]);
        }
       
    }

    public function getInfluencer($id) {
        // dd();
        $data = InfluencersRecords::find((int)$id);
        if ( $data ) {
            // $brand_id = BrandDetails::where('user_id',\Auth::id())->first();
            // $brand_data = Campaigns::where('brand_id',$brand_id->id)->get();
            // dd($brand_data);
            return view('brand-users.get_influencer_details',compact('data'));
        } else {
            session()->flash('error', 'Influencer detail not found!...');
            return redirect()->route('brand.find_influencer');
            // $get_records = InfluencersRecords::orderBy('id', 'asc')->limit('15')->get();
            // return view('brand-users.find_influencers',compact('get_records'));
        }
    }

    public function addfavourite( Request $request )
    {
        $user = auth()->user();
        $favourite = Favourites::updateOrInsert(['brand_id'=>$request->user_id,'influencer_id'=> $request->influencer_id],[
            'brand_id'                  => $request->user_id,
            'influencer_id'             => $request->influencer_id,
            'is_favourite'              => $request->is_favourite,
            'is_type'                   => $request->is_type,
        ]);

        if ( $favourite ) {
           
            $response = [
                'status'    => true,
                'message'   => 'Influencer added as favourite.'
            ];
        } else {
            $response = [
                'status'    => false,
                'message'   => 'Something went wrong.',
            ];
        }

        return response()->json($response);
    }

    public function destroyfavourite (Request $request)
    {
        $user               = auth()->user();
        $favourite_delete   = Favourites::find($request->id);

        if ( $favourite_delete ) {

            $favourite_delete->is_favourite = $request->is_favourite;

            if ( $favourite_delete->save() ) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Influencer has been removed from favourites.',
                ]);
            }
        }
        
        return response()->json([
            'status'    => false,
            'message'   => 'Something went wrong!',
        ]);

    }
}
