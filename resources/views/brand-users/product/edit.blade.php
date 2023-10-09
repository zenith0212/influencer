@extends('layouts.index')

@section('title')
{{ $title }}
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
	.preview-image img{
		height: 190px;
		object-fit: cover;
		border-radius: 20px;
	}

	.form-group .inputfile-box label.product-main-image-label {
		background-color: #FBFAFA;
		border-radius: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 60px 10px;
		margin-bottom: 0;
		text-transform: unset;
		border: 1px solid rgba(61, 140, 149, 0.1);
		cursor: pointer;
	}

	.form-group .inputfile-box label.product-main-image-label svg {
		width: 56px;
		height: 56px;
	}
</style>
@endsection

@section('content')
<main class="create-campaign">
	<div class="container-fluid">
		<div class="content">
			<h3>Edit Product</h3>
			<form enctype="multipart/form-data" action="{{ route('brand.product.update', [ 'id' => $product->id ]) }}" class="form-edit-product" method="post" id="form-edit-product" autocomplete="off">
				@method('PUT')
				@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group mb-0">
									<label for="product_main_image" class="form-label">Product Main Image <span class="text-danger">*</span></label>
									<div class="inputfile-box">
										<input type="file" name="product_main_image" id="product_main_image" class="inputfile form-control" data-multiple-caption="{count} files selected" accept="image/*" />
										<label for="product_main_image" >
											<figure id="product-main-image-default">
												<svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><path d="m44.333 0h-32.667c-3.0931 0.003705-6.0584 1.2341-8.2455 3.4212s-3.4175 5.1524-3.4212 8.2455v32.667c6.5872e-4 3.0576 1.2062 5.9918 3.3553 8.1667 0.02334 0.0257 0.03267 0.0607 0.05834 0.0863 0.02566 0.0257 0.06066 0.035 0.08633 0.0584 2.1749 2.1491 5.1091 3.3546 8.1667 3.3553h32.667c3.0931-0.0037 6.0584-1.2341 8.2455-3.4212s3.4175-5.1524 3.4212-8.2455v-32.667c-0.0037-3.0931-1.2341-6.0584-3.4212-8.2455s-5.1524-3.4175-8.2455-3.4212zm-39.667 11.667c0-1.8566 0.73749-3.637 2.0502-4.9498 1.3128-1.3128 3.0932-2.0502 4.9498-2.0502h32.667c1.8565 0 3.637 0.73749 4.9498 2.0502 1.3127 1.3128 2.0502 3.0932 2.0502 4.9498v24.701l-10.017-10.017c-0.4375-0.4374-1.0309-0.6831-1.6496-0.6831s-1.2121 0.2457-1.6497 0.6831l-11.184 11.184-4.1836-4.1837c-0.4376-0.4374-1.031-0.6831-1.6497-0.6831s-1.2121 0.2457-1.6497 0.6831l-13.984 13.981c-0.45666-0.9338-0.69598-1.9589-0.7-2.9984v-32.667zm39.667 39.667h-32.667c-1.0395-4e-3 -2.0646-0.2433-2.9984-0.7l12.332-12.334 7.6837 7.6837c0.4414 0.4302 1.0333 0.6709 1.6496 0.6709 0.6164 0 1.2083-0.2407 1.6497-0.6709 0.4374-0.4376 0.6832-1.031 0.6832-1.6497s-0.2458-1.2121-0.6832-1.6496l-1.8503-1.8504 9.534-9.534 11.667 11.667v1.3673c0 1.8565-0.7375 3.637-2.0502 4.9498-1.3128 1.3127-3.0933 2.0502-4.9498 2.0502z" fill="#3D8C95"/><path d="m16.333 23.334c1.3845 0 2.7379-0.4106 3.889-1.1797 1.1511-0.7692 2.0484-1.8624 2.5782-3.1415s0.6684-2.6866 0.3983-4.0444c-0.2701-1.3579-0.9368-2.6052-1.9157-3.5842-0.979-0.9789-2.2263-1.6456-3.5842-1.9157-1.3578-0.2701-2.7653-0.13147-4.0444 0.39834-1.2791 0.52977-2.3723 1.4271-3.1415 2.5782-0.76915 1.1511-1.1797 2.5045-1.1797 3.889 0 1.8565 0.73749 3.637 2.0503 4.9497 1.3127 1.3128 3.0932 2.0503 4.9497 2.0503zm0-9.3333c0.4615 0 0.9126 0.1368 1.2963 0.3932 0.3838 0.2564 0.6828 0.6208 0.8594 1.0472 0.1766 0.4263 0.2228 0.8955 0.1328 1.3481s-0.3123 0.8684-0.6386 1.1947-0.7421 0.5486-1.1947 0.6386-0.9218 0.0438-1.3481-0.1328c-0.4264-0.1766-0.7908-0.4757-1.0472-0.8594s-0.3932-0.8348-0.3932-1.2963c0-0.6189 0.2458-1.2123 0.6834-1.6499s1.0311-0.6834 1.6499-0.6834z" fill="#3D8C95"/></svg>
											</figure>
											<span></span>
										</label>
										@error('product_main_image')
										<p class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
										</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-6 mt-11">
								<div class="preview-image">
									@if(!empty($product->mainImage->image))
									<img class="w-100" id="preview-image-before-upload" src="{{ asset("storage/{$product_path}/{$product->id}/{$product->mainImage->image}") }}">
									@else
									<img class="w-100" id="preview-image-before-upload" src="{{ asset('assets/media/avatars/default_img.png') }}">
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="product_images" class="form-label">Product Photos</label>
							<div class="inputfile-box">
								<input type="file" name="product_images[]" id="product_images" class="inputfile form-control" data-multiple-caption="{count} files selected" accept="image/*" multiple />
								<label for="product_images">
									<figure>
										<svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><path d="m44.333 0h-32.667c-3.0931 0.003705-6.0584 1.2341-8.2455 3.4212s-3.4175 5.1524-3.4212 8.2455v32.667c6.5872e-4 3.0576 1.2062 5.9918 3.3553 8.1667 0.02334 0.0257 0.03267 0.0607 0.05834 0.0863 0.02566 0.0257 0.06066 0.035 0.08633 0.0584 2.1749 2.1491 5.1091 3.3546 8.1667 3.3553h32.667c3.0931-0.0037 6.0584-1.2341 8.2455-3.4212s3.4175-5.1524 3.4212-8.2455v-32.667c-0.0037-3.0931-1.2341-6.0584-3.4212-8.2455s-5.1524-3.4175-8.2455-3.4212zm-39.667 11.667c0-1.8566 0.73749-3.637 2.0502-4.9498 1.3128-1.3128 3.0932-2.0502 4.9498-2.0502h32.667c1.8565 0 3.637 0.73749 4.9498 2.0502 1.3127 1.3128 2.0502 3.0932 2.0502 4.9498v24.701l-10.017-10.017c-0.4375-0.4374-1.0309-0.6831-1.6496-0.6831s-1.2121 0.2457-1.6497 0.6831l-11.184 11.184-4.1836-4.1837c-0.4376-0.4374-1.031-0.6831-1.6497-0.6831s-1.2121 0.2457-1.6497 0.6831l-13.984 13.981c-0.45666-0.9338-0.69598-1.9589-0.7-2.9984v-32.667zm39.667 39.667h-32.667c-1.0395-4e-3 -2.0646-0.2433-2.9984-0.7l12.332-12.334 7.6837 7.6837c0.4414 0.4302 1.0333 0.6709 1.6496 0.6709 0.6164 0 1.2083-0.2407 1.6497-0.6709 0.4374-0.4376 0.6832-1.031 0.6832-1.6497s-0.2458-1.2121-0.6832-1.6496l-1.8503-1.8504 9.534-9.534 11.667 11.667v1.3673c0 1.8565-0.7375 3.637-2.0502 4.9498-1.3128 1.3127-3.0933 2.0502-4.9498 2.0502z" fill="#3D8C95"/><path d="m16.333 23.334c1.3845 0 2.7379-0.4106 3.889-1.1797 1.1511-0.7692 2.0484-1.8624 2.5782-3.1415s0.6684-2.6866 0.3983-4.0444c-0.2701-1.3579-0.9368-2.6052-1.9157-3.5842-0.979-0.9789-2.2263-1.6456-3.5842-1.9157-1.3578-0.2701-2.7653-0.13147-4.0444 0.39834-1.2791 0.52977-2.3723 1.4271-3.1415 2.5782-0.76915 1.1511-1.1797 2.5045-1.1797 3.889 0 1.8565 0.73749 3.637 2.0503 4.9497 1.3127 1.3128 3.0932 2.0503 4.9497 2.0503zm0-9.3333c0.4615 0 0.9126 0.1368 1.2963 0.3932 0.3838 0.2564 0.6828 0.6208 0.8594 1.0472 0.1766 0.4263 0.2228 0.8955 0.1328 1.3481s-0.3123 0.8684-0.6386 1.1947-0.7421 0.5486-1.1947 0.6386-0.9218 0.0438-1.3481-0.1328c-0.4264-0.1766-0.7908-0.4757-1.0472-0.8594s-0.3932-0.8348-0.3932-1.2963c0-0.6189 0.2458-1.2123 0.6834-1.6499s1.0311-0.6834 1.6499-0.6834z" fill="#3D8C95"/></svg>
									</figure>
									<span></span>
								</label>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="name_en" id="product_name" placeholder="Product Name" value="{{ old('name_en', $product->name_en) }}"  />
							@error('name_en')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="product_keyword" class="form-label">Product Keyword <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="keyword_en" id="product_keyword" placeholder="SKU083245" value="{{ old('keyword_en', $product->keyword_en) }}"  />
							@error('keyword_en')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="category_id" class="form-label">Product Category <span class="text-danger">*</span></label>
							<select class="form-select js-example-basic-single" name="category_id" id="category_id">
								<option value="">Select Category</option>
								@foreach( $categories as $category )
								<option {{ $category->id != $product->category_id ?: 'selected' }} value="{{ $category->id }}">{{ $category->name_en }}</option>
								@endforeach
							</select>
							@error('category_id')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="product_link" class="form-label">Product Link (Website URL)</label>
							<input type="url" class="form-control" id="product_link" name="product_link"  placeholder="https://www.ticktok.com/influencer-marketplace" value="{{ old('product_link', $product->product_link) }}" />
							@error('product_link')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="price" class="form-label">Price <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="price" name="price" placeholder="120" value="{{ old('price', $product->price) }}"  />
							@error('price')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check-row">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="is_available" name="is_available" {{ old('is_available', $product->is_available) == 1 ? 'checked' : '' }} onclick="$(this).val(this.checked ? 1 : 0)" />
									<label class="form-check-label" for="is_available">Available</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured" {{ old('is_featured', $product->is_featured) == 1 ? 'checked' : '' }} onclick="$(this).val(this.checked ? 1 : 0)" />
									<label class="form-check-label" for="is_featured">Featured</label>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="short_product_description" class="form-label">Product Short Description <span class="text-danger">*</span></label>
							<textarea id="short_product_description" name="short_description_en" placeholder="Short Description...">{{ old('short_description_en', $product->short_description_en) }}</textarea>
							@error('short_description_en')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="product_description" class="form-label">Product Description <span class="text-danger">*</span></label>
							<textarea id="product_description_en" name="description_en" placeholder="Description...">{{ old('description_en', $product->description_en) }}</textarea>
							@error('description_en')
							<p class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
							</p>
							@enderror
						</div>
					</div>


					<div class="col-12">
						<button class="primary-btn" type="submit">
							<span>Update</span>
						</button>

						<a href="{{ route('brand.product.index') }}" class="primary-btn">
							<span>Cancel</span>
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
<script src="{{ asset('brand_user/assets/js/products/index.js') }}"></script>
<script>
	$(document).ready(function (e) {
	    $('#product_main_image').change(function(){
	    
	    let reader = new FileReader();

	    reader.onload = (e) => { 
	 
	      $('#preview-image-before-upload').attr('src', e.target.result); 
	    }
	 
	    reader.readAsDataURL(this.files[0]); 
	   
	   });
	   
	});
 
</script>
@endsection
