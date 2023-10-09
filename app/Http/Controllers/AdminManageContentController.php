<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentDetails;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use Illuminate\View\View;

class AdminManageContentController extends Controller
{
    //
    public function index(){
        $this->data = array(
            'title' => 'Content | ',
            'breadcrumbs' => array(
                'title' => 'Meta Content',
                'breadcrumb' => array(
                    'admin.dashboard' => __('Home'),
                    '',
                    'content.index' => __('Content'),
                    '',
                    '#' => 'Manage meta content',
                ),
            ),
        );
        return view('admin.content.list',$this->data);
    }

    public function getContentData(Request $request){
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
         $totalContents                = ContentDetails::select('count(*) as allcount')->count();
         $totalContentWithFilter      = ContentDetails::select('count(*) as allcount')->where('title_en', 'like', '%' .$searchValue . '%')->count();
 
         // Fetch records
         $content = ContentDetails::latest()
             ->select('content_details.*')
             ->skip($start)
             ->take($rowperpage)
             ->get();
 
         $response = array();
 
         foreach( $content as $key=>$data ) {
             $response[] = array(
                 'id'                => $data->id,
                 'title_en'           => $data->title_en,
                 'description_en'    => $data->description_en,
                 'keyword_en'             => $data->keyword_en,
             );
         }
 
         return response()->json(array(
             'draw'                  => intval($draw),
             'iTotalRecords'         => $totalContents,
             'iTotalDisplayRecords'  => $totalContentWithFilter,
             'aaData'                => $response,
          ));
    }

    public function create(): JsonResponse
    {
        $this->data = array(
            'title' => 'Create Content',
        );

        $view = view('admin.content.add', $this->data)->render();

        $response = array(
            'status'    => true,
            'data'      => array(
                'view'  => $view,
            ),
        );

        return response()->json($response);
    }

    public function store( StoreContentRequest $request ): JsonResponse
    {
        $validated_data         = $request->validated();

        $content = ContentDetails::create([
            'title_en'           => $validated_data['title_en'],
            'description_en'    => strip_tags($validated_data['description_en']),
            'keyword_en'             => $validated_data['keyword_en'],
        ]);

        if ( $content ) {
            return response()->json([
                'status'    => true,
                'message'   => 'New meta content has been created!'
            ]);
        }
        
        return response()->json([
            'status'    => false,
            'message'   => 'Something went wrong while create a new meta content details.',
        ]);
    }

    public function edit($id): JsonResponse
    {
        $content = ContentDetails::find($id);

        if ( $content ) {
            $this->data = array(
                'content' => $content,
            );
            $view = view('admin.content.edit', $this->data)->render();

            $response = array(
                'status'    => true,
                'data'      => array(
                    'view'  => $view,
                ),
            );
        } else {
            $response = array(
                'status'    => false,
                'message'   => 'Something went wrong.',
            );
        }

        return response()->json($response);
    }

    public function update(UpdateContentRequest $request, $id): JsonResponse
    {
        $user           = auth()->user();
        $content       = ContentDetails::find($id);

        if ( $content ) {

            $content->title_en          = $request->validated()['title_en'];
            $content->keyword_en          = $request->validated()['keyword_en'];
            $content->description_en   = strip_tags($request['description']);

            if ( $content->save() ) {
                activity('updated')
                    ->performedOn($content)
                    ->causedBy($user)
                    ->log("Content {$content->title_en} has been updated by {$user->name}");

                $response = [
                    'status'    => true,
                    'message'   => 'Content has been updated.'
                ];
            } else {
                $response = [
                    'status'    => false,
                    'message'   => 'Something went wrong while update the content.',
                ];
            }
        } else {
            $response = [
                'status'        => false,
                'message'       => 'Something went wrong, content not found.',
            ];
        }
        return response()->json( $response );
    }

}
