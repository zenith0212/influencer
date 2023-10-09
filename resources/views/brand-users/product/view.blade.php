@extends('layouts.index')

@section('title')
	{{ $title }}
@endsection

@section('content')
	<main class="product-details-page">
		@if(session()->has('error'))
	       <div class="alert alert-danger"> 
	           {{ session()->get('error') }}
	       </div>
	   @endif
	    <div class="container-fluid">
	        <div class="content">
	        	<a href="{{ route('product_details') }}"><h3>Product Details</h3></a>
	            <div class="product-details">
	                <div class="row justify-content-between">
	                    <div class="col-xl-5">
	                        <div class="product-catalog">
	                        	<div class="swiper mySwiper2">
	                        	    <div class="swiper-wrapper">
	                        	        @if ( $product->mainImage )
		                        	        <div class="swiper-slide">
		                        	            <div class="swiper-zoom-container">
		                        	               <img src="{{ asset("storage/{$product_path}/{$product->id}/{$product->mainImage->image}") }}" alt="{{ $product->name_en }}" />
		                        	           </div>
		                        	       	</div>
	                        	      	@endif
	                        	      	@if ( $product->images )
	                        	      		@foreach ( $product->images as $image )
			                        	        <div class="swiper-slide">
			                        	            <div class="swiper-zoom-container">
														<img src="{{ asset("storage/{$product_path}/{$product->id}/{$image->image}") }}" alt="{{ $product->name_en }}" />
			                        	           </div>
			                        	       	</div>
	                        	      		@endforeach
	                        	      	@endif
	                        	    </div>
	                        	</div>
	                        	<div thumbsSlider="" class="swiper mySwiper">
	                        	    <div class="swiper-wrapper">
	                        	        @if ( $product->mainImage )
		                        	       	<div class="swiper-slide">
		                        	       	    <img src="{{ asset("storage/{$product_path}/{$product->id}/thumbnails/{$product->mainImage->thumbnail_image}") }}" alt="{{ $product->name_en }}" />
		                        	       	</div>
	                        	      	@endif
	                        	        @if ( $product->images )
	                        	      		@foreach ( $product->images as $image )
			                        	        <div class="swiper-slide">
		                        	            	<img src="{{ asset("storage/{$product_path}/{$product->id}/thumbnails/{$image->thumbnail_image}") }}" alt="{{ $product->name_en }}" />
			                        	       	</div>
	                        	      		@endforeach
	                        	      	@endif
	                        	    </div>
	                        	</div>
                        	</div>
                        </div>
                        <div class="col-xl-7">
                            <div class="product-details-content">
                                <div class="product-details-head">
                                    <small>In Stock</small>
                                    <p>Whey Protein for Beginners</p>
                                    <h2>{{ $product->name_en }}</h2>
                                </div>
                                <div class="product-situation"> 
                                 	<span>SKU: {{ $product->keyword_en }}</span>
                                 	<div class="product-situation-inner">
                                        <p>On sale</p>
                                    	<p>Limited</p>
                                 	</div>
                                </div>
                                <h3 class="product-price">
                                    ${{ $product->price }}
                                </h3>
                                <div class="product-category">
                                    <ul class="product-category-list">
                                        <li><p>Category</p> <span>{{ $product->category->name_en }}</span></li> 
                                        <li><p>Sample</p> <span>Available</span></li>
                                    </ul>
                                </div>
                                <div class="product-actions">
                                    {{-- <button class="primary-btn "><span>View request from influencer</span> </button>
                                    <button class="primary-btn mb-0"><span>View requests of influencers for sample  </span></button> --}}
                                {{-- @if(@$product->sampleRequest)
                                    @foreach ( $product->sampleRequest as $sample )
                                    <input type="hidden" class="prpduct_status" value="{{$sample->shipment_status}}">
				                           	@if($sample->shipment_status == 1 ) 
				                           		<button class="primary-btn change-status" type="submit" data-status='2' data-id={{ $sample->id}}><span>Accept Request from influencer</span></button>
				                           		<div class="custom-badge primary-status-text status status-active after-change-status d-none d-inline-block" data-status='2'>Product shipped</div>
				                           	@elseif($sample->shipment_status == 2 ) 
				                           		<div class="custom-badge status status-active d-inline-block" >Product shipped</div>
				                           	@elseif($sample->shipment_status == 3 ) 
				                           		<div class="custom-badge status status-completed d-inline-block" >Product Delivered</div>
				                           	@elseif($sample->shipment_status == 0 ) 
				                           		<div class="custom-badge primary-status-text status status-active after-changed-status-button" >No status available</div>
				                           	@endif
				                    @endforeach
				                @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-description">
                    <div class="row">
                        <div class="col-12">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                            Product Details
                                        </button>
                                    </h2>

                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>{{ $product->description_en }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($campaignArr != null)
                <div class="card-container">
		            <div class="campaign-activity">
		               <ul class="nav nav-pills" id="pills-tab" role="tablist">
		                  <li class="nav-item" role="presentation">
		                     <button class="nav-link active" id="pills-category-tab" data-bs-toggle="pill" data-bs-target="#pills-category" type="button" role="tab" aria-controls="pills-category" aria-selected="true">Connected Campaigns</button>
		                  </li>
		               </ul>
		               <div class="tab-content" id="pills-tabContent">
		                  <div class="tab-pane fade show active pills-category" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab">
		                     <div class="table-responsive">
		                        @if($campaignArr)
		                        <table class="table table-responsive">
		                           <thead>
		                              <tr>
		                                 <th>Title</th>
		                                 <th>Total Products</th>
		                                 <th>Created Date</th>
		                                 <th>Status</th>
		                                 <th>Actions</th>
		                              </tr>
		                           </thead>
		                           <tbody>
		                              @foreach($campaignArr as $campaign)
		                              <tr>
		                                 <td data-label="Product">
		                                    <div class="campaign">
		                                        <img src="{{ $campaign['thumbnail_image'] }}" alt="campaign_img" height="50px;" width="50px;">
		                                        <p>{{ ucfirst($campaign['name_en']) }}</p>
		                                    </div>
		                                </td>
		                                 <td data-label="Category">
		                                        <span>{{$campaign['total_products']}}</span>
		                                </td>
		                                 <td>
		                                    <div>
		                                       <span>{{$campaign['created_at']}}</span>
		                                    </div>
		                                 </td>
		                                  <td>
		                                    <div>
		                                       @if($campaign['campaign_is_active'])
		                                       		<div class="status status-active">Active</div>
		                                       	@elseif($campaign['created_at'] < \Carbon\Carbon::today()->toDateString())
		                                       		<div class="status status-completed">Completed</div>
		                                       	@else
		                                       		In Progress
		                                       	@endif

		                                    </div>
		                                 </td>
		                                 <td>
		                                    <div>
		                                       <a href="{{ route('brand.campaign.view',$campaign['id']) }}" class="primary-btn">View More</a>
		                                    </div>
		                                 </td>
		                              </tr>
		                              @endforeach
		                           </tbody>
		                        </table>
		                        @else
		                        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
		                           <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
		                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		                                 <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
		                                 <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
		                                 <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
		                              </svg>
		                           </span>
		                           <div class="d-flex flex-stack flex-grow-1">
		                              <div class="fw-semibold">
		                                 <h4 class="text-gray-900 fw-bold">No Campaign found !</h4>
		                              </div>
		                           </div>
		                        </div>
		                        @endif
		                     </div>
		                  </div>
		                  <div class="tab-pane fade pills-description" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
		                     <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
		                        <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
		                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		                              <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
		                              <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
		                              <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
		                           </svg>
		                        </span>
		                        <div class="d-flex flex-stack flex-grow-1">
		                           <div class="fw-semibold">
		                              <h4 class="text-gray-900 fw-bold">No product details is connected with this camp!</h4>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		               </div>
		            </div>
		        </div>
		        @endif
            </div>
        </div>
    </main>
@endsection

@section('script')
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script src="{{ asset('brand_user/assets/js/products/index.js') }}"></script>
	<script>
		function status_confirmation(message = 'Are you sure you want to delete this record?', confirmButtonText = "Yes, change!", cancelButtonText = 'No, cancel' ) {
		    return Swal.fire({
		        text: message,
		        icon: "warning",
		        showCancelButton: true,
		        buttonsStyling: true,
		        confirmButtonText: confirmButtonText,
		        cancelButtonText: cancelButtonText,
		        customClass: {
		            confirmButton: "btn fw-bold btn-danger custom-button-css",
		            cancelButton: "btn fw-bold btn-active-light-primary"
		        }
		    });
		}

	
	</script>
@endsection
