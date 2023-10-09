<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\ProductStoreRequest;
use App\Http\Requests\Brand\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Campaigns;
use App\Models\ProductSampleRequests;
use App\Models\Product;
use App\Traits\StoreProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductController extends Controller
{
    use StoreProduct;

    /**
     * Display the list product view.
     * 
     * @return Illuminate\View\View
     */
    public function index( Request $request ): mixed
    {
        $this->data = array(
            'title' => 'Product | ',
            'breadcrumbs' => array(
                'title' => 'Products',
                'breadcrumb' => array(
                    'admin.dashboard' => 'Home',
                    '',
                    'plans.index' => 'Products',
                    '',
                    '#' => 'List Products',
                ),
            ),
        );

        if ( $request->ajax() ) {
            $products = $this->getProducts( $request );
            return response()->json($products);
        }

        return view('brand-users.product.index', $this->data);
    }

    public function sampleRequest ( Request $request ) {

        $this->data = array(
            'title' => 'Sample Product Request | ',
            'breadcrumbs' => array(
                'title' => 'Products',
                'breadcrumb' => array(
                    '#' => 'List Of Sample Product Requests',
                ),
            ),
        );

        if ( $request->ajax() ) {
            $products = $this->getSampleProducts( $request );
            return response()->json($products);
        }

        return view('brand-users.product.sampleRequest', $this->data);
    }

    public function getSampleProducts( Request $request ): array
    {
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
        $totalProducts = ProductSampleRequests::select('count(*) as allcount')->where('brand_id',\Auth::user()->id)->with('products')->count();

        // $totalProductsWithFilter = ProductSampleRequests::select('count(*) as allcount')->where('brand_id',\Auth::user()->id)->count();

        $totalProductsWithFilter = '';
        // Fetch records
        $totalProductsWithFilter = ProductSampleRequests::select('count(*) as allcount')->join('products','products.id','product_sample_requests.product_id')->where('products.name_en' , 'like', '%' .$searchValue . '%')->where('product_sample_requests.brand_id',\Auth::user()->id)->count();

         $products = ProductSampleRequests::join('products','products.id','product_sample_requests.product_id')->where('products.name_en' , 'like', '%' .$searchValue . '%')->where('product_sample_requests.brand_id',\Auth::user()->id)->get();

        $response = array();

        if($products != null) {
            foreach( $products as $product ) {
                // dd(count($product->products) > 0);
                if(count($product->products) > 0) {
                     $response[] = array(
                        'campaign_id' => $product->campaign_id,
                        'id' => $product->product_id,
                        'image' => $product->products[0]->mainImage ? asset( 'storage/' . Product::PRODUCT_UPLOAD_PATH . "{$product->products[0]->id}/thumbnails/{$product->products[0]->mainImage->thumbnail_image}") : '',
                        'name_en' => $product->products[0]->name_en,
                        'influencer_name' => $product->influencers[0]->name,
                        'campaign_name' => $product->campaigns[0]->name_en,
                        'product_status' => $product->shipment_status,
                    );
                }
            }
        }
        

        return (array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalProducts,
            'iTotalDisplayRecords'  => $totalProductsWithFilter,
            'aaData'                => $response,
         ));
    }


    public function getProducts( Request $request ): array
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowperpage = $request->get('length'); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search_string');
        
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $request->get('search_string'); // Search value

        // Total records
        $totalProducts = Product::select('count(*) as allcount')->where('brand_id',\Auth::user()->id)->count();
        $totalProductsWithFilter = Product::select('count(*) as allcount')->where('brand_id',\Auth::user()->id)->where('name_en', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $products = Product::where('brand_id',\Auth::user()->id)
            ->where('name_en', 'like', '%' .$searchValue . '%')  
            // ->Where('description_en', 'like', '%' .$searchValue . '%')
            ->select('products.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
          // dd(\Auth::user()->id);
        $response = array();

        foreach( $products as $product ) {
            $response[] = array(
                'id' => $product->id,
                'image' => $product->mainImage ? asset( 'storage/' . Product::PRODUCT_UPLOAD_PATH . "{$product->id}/thumbnails/{$product->mainImage->thumbnail_image}") : '',
                'name_en' => $product->name_en,
                'category' => $product->category->name_en,
                'price' => $product->price,
                'created_at' => date('dS F, Y h:ia', strtotime($product->created_at)),
            );
        }

        return array(
            'draw' => intval($draw),
            'iTotalRecords' => $totalProducts,
            'iTotalDisplayRecords' => $totalProductsWithFilter,
            'aaData' => $response,
        );
    }
    
    /**
     * Display the create product view.
     * 
     * @return Illuminate\View\View
     */
    public function create(): View
    {
        $this->data = array(
            'title' => 'Create Product |',
        );

        $categories = Category::select(['id', 'name_en'])->latest()->get();
        $this->data['categories'] = $categories;

        return view('brand-users.product.create', $this->data);
    }

    /**
     * Store product record.
     * 
     * @param  App\Http\Requests\Brand\ProductStoreRequest $request
     * @throws Illuminate\Validation\ValidationException
     * @return Illuminate\Http\RedirectResponse
     */
    public function store( ProductStoreRequest $request ): RedirectResponse
    {
        $product = $this->saveProduct( $request, true );
        if ( $product ) {
            return redirect()->route('brand.product.index')->with('status', 'New product has been created.');
        }

        throw ValidationException::withMessages([
            'name_en' => 'Something went wrong while create a product.',
        ]);
    }

    /**
     * Display the view detail product view.
     * @param  int $id
     * @return Illuminate\View\View
     */
    public function view( $id )
    {
        $product = Product::with('campaigns','sampleRequest')->find($id);
        
        if ( !$product ) {
            return redirect()->route('brand.product.index')->withErrors('Product not found!');
        }

        $campaign_details = ProductSampleRequests::with('products')->where('product_id',$id)->get();

        $campaignArr = [];

        foreach($campaign_details as $campaign) {
            $campaign_info = Campaigns::withCount('campaignProducts')->where('id',$campaign->product_id)->first();
            $thumbnailImage = !empty($campaign->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$campaign->thumbnail_image : asset('/assets/media/avatars/default_img.png');
           
            if($campaign_info != null) {
                $campaignArr[] = [
                    'id'                => $campaign_info->id,
                    'name_en'           => $campaign_info->name_en,
                    'delivery_status'   => $campaign_info->delivery_status,
                    'thumbnail_image'   => $thumbnailImage,
                    'campaign_is_active'=> $campaign_info->campaign_is_active,
                    'total_products'    => $campaign_info->campaign_products_count,
                    'created_at'        => \Carbon\Carbon::parse($campaign_info->created_at)->format('jS F Y'),
                    'brand'             => $campaign_info->name_en,
                ];

            }
        }
        
        $this->data = array(
            'title' => 'View Product Detail | ',
            'product' => $product,
            'product_path' => Product::PRODUCT_UPLOAD_PATH,
            'campaignArr'  => $campaignArr,
        );

        return view('brand-users.product.view', $this->data);
    }

    /**
     * Display the view detail product view.
     * @param  int $id
     * @return Illuminate\View\View
     */
    public function edit( $id )
    {
        $product = Product::find($id);
        if ( !$product ) {
            return redirect()->route('brand.product.index')->withErrors('Product not found!');
        }

        $this->data = array(
            'title' => 'Edit Product | ',
            'product_path' => Product::PRODUCT_UPLOAD_PATH,
        );

        $categories = Category::select(['id', 'name_en'])->latest()->get();
        $this->data['categories'] = $categories;
        $this->data['product'] = $product;

        return view('brand-users.product.edit', $this->data);
    }

    /**
     * @param  App\Http\Requests\Brand\ProductUpdateRequest $request
     * @param  int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function update( ProductUpdateRequest $request, $id )
    {
        $request->mergeIfMissing(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:App\Models\Product,id',
        ], [
            'id.*' => 'Something went wrong, product not found.',
        ]);
        $product = $this->updateProduct( $request, $id, true );

        if ( $product ) {
            return redirect()->route('brand.product.index')->with('status', 'Product has been updated.');
        }

        throw ValidationException::withMessages([
            'name_en' => 'Something went wrong while updating a product.',
        ]);
    }

    /**
     * Delete specific product.
     * 
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy( Request $request, $id ): JsonResponse
    {
        if ( $request->ajax() ) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:App\Models\Product,id',
            ], [
                'id.*' => 'Something went wrong, product not found.',
            ]);

            if ( $validator->fails() ) {
                $view = view('components.auth-validation-errors', [ 'errors' => $validator->errors() ])->render();
                $this->data = array(
                    'status' => false,
                    'message' => $view,
                );
            } else {
                $product = Product::find($id);
                $product->delete();

                $view = view('components.auth-session-status', [ 'status' => 'Product has been deleted.' ])->render();

                $this->data = array(
                    'status' => true,
                    'message' => $view,
                );
            }
        } else {
            $this->data = array(
                'status' => false,
                'message' => 'Something went wrong, invalid request.',
            );
        }
        return response()->json($this->data);
    }

     public function changeStatus(Request $request) {

        $user = auth()->user();
        $shipment_status = ProductSampleRequests::find($request->id);

        $shipment_status->shipment_status = $request->shipment_status;
        $shipment_status->save();

        if ( $shipment_status->save() ) {

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

        return response()->json($response);

     }
}
