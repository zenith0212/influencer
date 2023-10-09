<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\{Country, Category, RequestDemo, Product, JoinUs};

class FrontCommonController extends Controller
{
    public function index(){

        $this->data = array(
            'title' => 'Common | ',
            'breadcrumbs' => array(
                'title' => 'Common Details',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'front.common' => 'Common Details',
                    '',
                    '#' => 'List Common Details',
                ),
            ),
        );

        return view('admin.front_common',$this->data);
    }

    public function getCommonDetails(Request $request) {
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
        $searchValue            = $search_arr['value']; // Search value

        // Total records
        $totalRequestDemos                = RequestDemo::select('count(*) as allcount')->count();
        $totalRequestDemosWithFilter      = RequestDemo::select('count(*) as allcount')->where('first_name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $data = RequestDemo::latest()
                ->with('category:id,name_en')
                ->where('first_name', 'like', '%' .$searchValue . '%')
                ->skip($start)
                ->take($rowperpage)
                ->get();

        $response = array();

        foreach( $data as $value ) {
            $response[] = array(
                'id'                => $value->id,
                'name'              => $value->first_name." ".$value->last_name,
                'category_name'     => $value->category->name_en,
                'email'             => $value->email,
                'company_name'      => $value->company_name,
                'phone_number'      => $value->phone_number,
                'main_bussiness'    => $value->main_bussiness,
                'company_scale'     => $value->company_scale,
                'page_type'         => $value->page_type == 1 ? 'Contact Us' : 'Request Demo',
            );
        }

        return response()->json(array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalRequestDemos,
            'iTotalDisplayRecords'  => $totalRequestDemosWithFilter,
            'aaData'                => $response,
         ));
    }

    public function joinUsDetails(){
        $this->data = array(
            'title' => 'Join Us | ',
            'breadcrumbs' => array(
                'title' => 'Join Us',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'front.common' => 'Join Us',
                    '',
                    '#' => 'List Join Us',
                ),
            ),
        );

        return view('admin.join_us',$this->data);
    }

    public function getJoinUsDetails(Request $request) {
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
        $searchValue            = $search_arr['value']; // Search value

        // Total records
        $totalJoinUs            = JoinUs::select('count(*) as allcount')->count();
        $totalJoinUsWithFilter  = JoinUs::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $data = JoinUs::latest()
                ->with('product:id,name_en')
                ->where('name', 'like', '%' .$searchValue . '%')
                ->skip($start)
                ->take($rowperpage)
                ->get();

        $response = array();

        foreach( $data as $value ) {
            $response[] = array(
                'id'                    => $value->id,
                'name'                  => $value->name,
                'product_name'          => $value->product->name_en,
                'email'                 => $value->work_email,
                'phone_number'          => $value->phone_no,
                'company_name'          => $value->company_name,
                'company_scale'         => $value->company_scale,
                'how_to_know'           => $value->how_know_topbrandmate,
                'company_introduction'  => $value->company_introduction,
            );
        }

        return response()->json(array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalJoinUs,
            'iTotalDisplayRecords'  => $totalJoinUsWithFilter,
            'aaData'                => $response,
         ));
    }
}
