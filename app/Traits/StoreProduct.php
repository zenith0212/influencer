<?php 

namespace App\Traits;

use App\Http\Requests\Brand\ProductStoreRequest;
use App\Http\Requests\Brand\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait StoreProduct
{
    /**
     * Store new product and their upload images.
     * 
     * @param  App\Http\Requests\Brand\ProductStoreRequest $request
     * @param  boolean $hasImages
     * @return App\Models\Product|boolean
     */
	public function saveProduct( ProductStoreRequest $request, $hasImages = false ): mixed
    {

        DB::beginTransaction();
    	try {
    		$validated = $request->validated();
    		$product = Product::create([
    		    'name_en' => $validated['name_en'],
    		    'keyword_en' => $validated['keyword_en'],
    		    'category_id' => $validated['category_id'],
    		    'brand_id' => auth()->id(),
    		    'description_en' => $validated['description_en'],
                'product_link' => $validated['product_link'],
    		    'short_description_en' => $validated['short_description_en'],
    		    'price' => $validated['price'],
    		    'is_available' => isset($validated['is_available']) ? '1' : '0',
    		    'is_featured' => isset($validated['is_featured']) ? '1': '0',
    		]);


            if ( $product ) {
        		if ( $hasImages ) {
                    $product_paths = $this->createProductImageDirectory( $product->id );
        			$this->uploadProductImages( $request, $product->id, $product_paths );
        		}
            }

    		DB::commit();
    		return $product;
    	} catch (Exception $e) {
    		DB::rollback();
    	}

        return false;
    }

    public function updateProduct( ProductUpdateRequest $request, $id, $hasImages = false )
    {
        DB::beginTransaction();
        try {
            $product = Product::where([
                'id' => $id,
            ])->update(\Illuminate\Support\Arr::except($request->validated(), 'product_main_image'));

            if ( $product ) {
                if ( $hasImages ) {
                    $product_paths = $this->createProductImageDirectory( $id );
                    $this->uploadProductImages( $request, $id, $product_paths );
                }
                DB::commit();
                return $product;
            }            
        } catch (Exception $e) {
            DB::rollback();
        }
        return false;
    }

    /**
     * Create product directory.
     * 
     * @param  int $product_id
     * @return array
     */
    private function createProductImageDirectory( $product_id ): array
    {
        $product_path = Product::PRODUCT_UPLOAD_PATH;
        if ( !File::exists(storage_path($product_path)) ) {
            File::makeDirectory(storage_path($product_path));
        }

        $product_folder_path = Product::PRODUCT_UPLOAD_PATH . "{$product_id}/";
        if ( !File::exists(storage_path($product_folder_path)) ) {
            File::makeDirectory(storage_path($product_folder_path));
        }

        $product_thumbnail_path = $product_folder_path . 'thumbnails/';
        if ( !File::exists(storage_path($product_thumbnail_path)) ) {
            File::makeDirectory(storage_path($product_thumbnail_path));
        }

        return [
            'product_folder_path' => $product_folder_path,
            'product_thumbnail_path' => $product_thumbnail_path,
        ];
    }

    /**
     * Upload Product main and other images.
     * 
     * @param  App\Http\Requests\Brand\ProductStoreRequest|App\Http\Requests\Brand\ProductUpdateRequest $request
     * @param  int $product_id
     * @param  array $paths
     * @param  boolean $is_update_request
     * @return void
     */
    public function uploadProductImages( $request, $product_id, $paths, $is_update_request = false ): void
    {
    	# Upload Main Product Image
        $validated = $request->validated();
        if ( isset($validated['product_main_image']) && $validated['product_main_image'] !== null ) {

            $extension = $validated['product_main_image']->getClientOriginalExtension();
            $product_main_image_name = time() . "_MAIN_{$product_id}.$extension";
            $product_main_thumbnail_image_name = time() . "_THUMBNAIL_{$product_id}.$extension";;

            // Original Image
            $validated['product_main_image']->storeAs($paths['product_folder_path'], $product_main_image_name, 'public');

            // Thumbnail Image
            $validated['product_main_image']->storeAs($paths['product_thumbnail_path'], $product_main_thumbnail_image_name, 'public');
            
            $true = ProductImage::updateOrCreate([
                'product_id' => $product_id,
                'image' => $product_main_image_name,
                'thumbnail_image' => $product_main_thumbnail_image_name,
                'is_main_image' => true,
            ]);

            // dd($true->save());
        }

        # Upload Product Images
        if ( isset($request->product_images) && $request->product_images !== null ) {
            // created product image directory
            foreach ( $request->product_images as $k => $product_image ) {
                ++$k;
                $extension = $product_image->getClientOriginalExtension();

                $product_image_name = time() . "_PRODUCT_{$k}_{$product_id}.$extension";
                $product_image_thumbnail_name = time() . "_PRODUCT_{$k}_THUMBNAIL_{$product_id}.$extension";

                // Original Image
                $product_image->storeAs($paths['product_folder_path'], $product_image_name, 'public');

                // Thumbnail Image
                $product_image->storeAs($paths['product_thumbnail_path'], $product_image_thumbnail_name, 'public');
                
                ProductImage::create([
                    'product_id' => $product_id,
                    'image' => $product_image_name,
                    'thumbnail_image' => $product_image_thumbnail_name,
                    'is_main_image' => false,
                ]);
            }
        }
    }

    /**
     * Create image thumbnails.
     * 
     * @param  string $path
     * @param  int $width
     * @param  int $height
     * @return void
     */
    public function createThumbnail($path, $width, $height): void
    {
        $image = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($path);
    }
}