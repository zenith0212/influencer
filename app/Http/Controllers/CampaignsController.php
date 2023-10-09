<?php

namespace App\Http\Controllers;

use App\Models\BrandDetails;
use App\Models\Campaigns;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ratings;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    public function index() {

        $this->data = array(
            'title' => 'Campaigns | ',
            'breadcrumbs' => array(
                'title' => 'Campaigns',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'campaigns.index' => 'Campaigns' ,
                    '',
                    '#' => 'List Campaign',
                ),
            ),
        );
        return view('admin.campaigns.index',$this->data);
    }

    public function getCampaigns(Request $request){

     ## Read value
    $draw                  = $request->get('draw');
    $start                 = $request->get("start");
    $rowperpage            = $request->get("length"); // Rows display per page

    $columnIndex_arr       = $request->get('order');
    $columnName_arr        = $request->get('columns');
    $order_arr             = $request->get('order');
    $search_arr            = $request->get('search');

    $columnIndex           = $columnIndex_arr[0]['column']; // Column index
    $columnName            = $columnName_arr[$columnIndex]['data']; // Column name
    $columnSortOrder       = $order_arr[0]['dir']; // asc or desc
    $searchValue           = $search_arr['value']; // Search value

     // Total records
    $totalRecords           = Campaigns::select('count(*) as allcount')->count();
    $totalRecordswithFilter = Campaigns::select('count(*) as allcount')->where('name_en', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
    $records = Campaigns::orderBy('id','desc')
        ->join('brand_details', 'brand_details.user_id', '=', 'campaigns.brand_id')
        ->where('campaigns.name_en', 'like', '%' .$searchValue . '%')
        ->orWhere('brand_details.title_en', 'like', '%' .$searchValue . '%')
        ->orWhere('campaigns.total_influencers_required', 'like', '%' .$searchValue . '%')
        ->select('campaigns.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();
    $data_arr = array();

    foreach($records as $record){
        $id                         = $record->id;
        $name_en                    = $record->name_en;
        $product_name               = $record->product_id;
        $brand_name                 = $record->brand_id;
        $thumbnail_image            = $record->thumbnail_image;
        $min_fans                   = $record->min_fans;
        $max_price                  = $record->max_price;
        $total_influencers_required = $record->total_influencers_required ?? '-';
        $is_sample_required         = $record->is_sample_required;
        $is_video                   = $record->is_video;
        $application_start_date     = $record->application_start_date;
        $application_end_date       = $record->application_end_date;
        $influencer_is_accept       = $record->influencer_is_accept;
        $campaign_is_active         = $record->campaign_is_active;
        $mail_comment_en            = $record->mail_comment_en;
        $terms_and_condition_en     = $record->terms_and_condition_en;
        $approached_by              = $record->approached_by;

        $product_name   = Product::where('brand_id',$record->brand_id)->get();
        $brand_name     = BrandDetails::where('user_id',$record->brand_id)->first();

        foreach($product_name as $product) {
            $product_category           = Category::select('name_en')->where('id',$product->category_id)->get();
            $brand_name_product_wise    = BrandDetails::select('title_en','id','user_id')->where('user_id',$product->brand_id)->get();
        }

        $data_arr[] = array(
            'id'                            => $id,
            'name_en'                       => $name_en,
            'product_name'                  => $product_name,
            'product_category'              => isset($product_category) ? $product_category : '',
            'brand_name'                    => isset($brand_name->title_en) ? $brand_name->title_en : '',
            'brand_name_product_wise'       => isset($brand_name_product_wise) ? $brand_name_product_wise : '',
            'thumbnail_image'               => $thumbnail_image,
            'min_fans'                      => $min_fans,
            'max_price'                     => $max_price,
            'total_influencers_required'    => $total_influencers_required,
            'is_sample_required'            => $is_sample_required,
            'is_video'                      => $is_video,
            'application_start_date'        => $application_start_date,
            'application_end_date'          => $application_end_date,
            'influencer_is_accept'          => $influencer_is_accept,
            'campaign_is_active'            => $campaign_is_active,
            'mail_comment_en'               => $mail_comment_en,
            'terms_and_condition_en'        => $terms_and_condition_en,
            'approached_by'                 => $approached_by,
        );
     }

     $response = array(
        "draw"                  => intval($draw),
        "iTotalRecords"         => $totalRecords,
        "iTotalDisplayRecords"  => $totalRecordswithFilter,
        "aaData"                => $data_arr
     );

     echo json_encode($response);
     exit;
   }

   public function show(Request $request, $id) {
        
        $campaigns      = Campaigns::where('id',$id)->first();
        $product_path = Product::PRODUCT_UPLOAD_PATH;
        if($campaigns != null) {
            
            $product_name       = Product::where('brand_id',$campaigns->brand_id)->get();
            $singlebrand_name   = BrandDetails::select('title_en','id','user_id')->where('user_id',$campaigns->brand_id)->first();
        
            foreach($product_name as $product) {
                $product_category   = Category::select('name_en')->where('id',$product->category_id)->get();
                $brand_name         = BrandDetails::select('title_en','id','user_id')->where('user_id',$product->brand_id)->get();
            }

            $this->data = array(
                'title'             => 'View Campaign Details',
                'id'                => $id,
                'campaigns'         => $campaigns,
                'product_category'  => isset($product_category) ? $product_category : '',
                'product_name'      => $product_name,
                'brand_name'        => isset($brand_name) ? $brand_name : '',
                'singlebrand_name'  => $singlebrand_name,  
                'product_path'      => $product_path
                );

                $view = view('admin.campaigns.view', $this->data)->render();
                return view('admin.campaigns.view', $this->data);
                
        }

        else {
            return redirect()->route('campaigns.index')->with('error','No data found.');
        }
    }
}
