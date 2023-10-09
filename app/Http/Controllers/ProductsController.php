<?php

namespace App\Http\Controllers;

use App\Models\BrandDetails;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ratings;
use App\Models\ProductImage;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function index() {

        $this->data = array(
            'title' => 'Products | ',
            'breadcrumbs' => array(
                'title' => 'Products',
                'breadcrumb' => array(
                    'admin.dashboard' => __('products.home'),
                    '',
                    'products.index' => __('products.title'),
                    '',
                    '#' => 'List Product',
                ),
            ),
        );

        return view('admin.products.index', $this->data);

    }

    public function getProducts(Request $request){

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
     $totalRecords              = Product::select('count(*) as allcount')->count();
     $totalRecordswithFilter    = Product::select('count(*) as allcount')->where('name_en', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
     $records = Product::orderBy('id','desc')
        ->join('brand_details', 'brand_details.user_id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where('products.name_en', 'like', '%' .$searchValue . '%')
        ->orWhere('products.description_en', 'like', '%' .$searchValue . '%')
        ->orWhere('products.price', 'like', '%' .$searchValue . '%')
        ->orWhere('brand_details.title_en', 'like', '%' .$searchValue . '%')
        ->orWhere('categories.name_en', 'like', '%' .$searchValue . '%')
        ->orWhere('products.total_sample', 'like', '%' .$searchValue . '%')
        ->select('products.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();
     
     $data_arr = array();
    
     foreach($records as $record){
        $id                 = $record->id;
        $name_en            = $record->name_en;
        $description_en     = $record->description_en;
        $total_sample       = $record->total_sample;
        $is_available       = $record->is_available;
        $is_featured        = $record->is_featured;
        $thumbnail_image    = $record->thumbnail_image;
        $product_category   = $record->category_id;
        $product_brand      = $record->brand_id;
        $price              = $record->price;
        $status             = $record->status;

        $product_category   = Category::select('name_en')->where('id',$product_category)->first();

        $product_brand      = BrandDetails::select('title_en')->where('user_id',$product_brand)->first();
        $product            = Product::with('mainImage')->where('id',$id)->first();
        $product_path       = Product::PRODUCT_UPLOAD_PATH;

        $data_arr[] = array(
          "id"                      => $id,
          "name_en"                 => $name_en,
          "description_en"          => $description_en,
          "total_sample"            => $total_sample,
          "is_available"            => $is_available,
          "is_featured"             => $is_featured,
          "product_category"        => $product_category->name_en,
          "product_brand"           => $product_brand->title_en,
          "thumbnail_image"         => @$product->mainImage->image ?  asset("storage/{$product_path}/{$id}/{$product->mainImage->image}") : '',
          "price"                   => $price,
          "status"                  => $status,
        );
     }
     
     $response = array(
        "draw"                      => intval($draw),
        "iTotalRecords"             => $totalRecords,
        "iTotalDisplayRecords"      => $totalRecordswithFilter,
        "aaData"                    => $data_arr
     );

     echo json_encode($response);
     exit;
   }


   public function show(Request $request, $id) {

        $products = Product::find($id);
        if ( !$products ) {
            return redirect()->route('products.index')->with('error','No data found.'); 
        }

        $this->data = array(
            'title'         => 'View Product Detail | ',
            'products'      => $products,
            'product_path'  => Product::PRODUCT_UPLOAD_PATH,
        );

        $view = view('admin.products.view', $this->data)->render();
            
        return view('admin.products.view', $this->data);
   }

}
