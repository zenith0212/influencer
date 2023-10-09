@extends('layouts.index')

@section('title')
	{{ $title }}
@endsection

@section('style')
	<script src="{{asset('assets/js/toastr.min.js')}}"></script>
@endsection

@section('content')
	<main>
		@if(session()->has('error'))
	       <div class="alert alert-danger"> 
	           {{ session()->get('error') }}
	       </div>
	   @endif
	    <div class="content">
	        <div class="container-fluid">
	            <div class="campaign">
	                <h3>Products</h3>
	            	
	            	<div id="alert-message-wrapper" class="alert-message-wrapper">
	            		<x-auth-validation-errors :errors="$errors" />
	            		<x-auth-session-status :status="session()->get('status')" />
	            	</div>

	                <div class="row align-items-center mb-4">
	                    <div class="col-md-6 col-lg-4 offset-6">
	                        <form action="">
	                            <div class="input-group serch-input">
	                                <input type="search" id="search_product"  class="form-control" placeholder="Search here">
	                                <button class="" type="submit"><i class="fas fa-search"></i></button>
	                            </div>
	                        </form>
	                    </div>
	                    <div class="col-md-6 col-lg-2">
	                        <a href="{{ route('brand.product.create') }}" data-url="{{ route('brand.product.create') }}" class="primary-btn rounded-pill create-brand-btn" id="create-brand-btn"> + Create Product </a>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-12">
	                    	<div class="table-heading">
	                    	    <h4>Total Products (<span id="total-products-count">0</span>)</h4>
	                    	</div>

	                    	<div class="campaign-list-table list-table">
	                    	    <table id="table-product-list" class="display table-product-list">
	                    	    	<thead>
	                    	    	    <tr>
	                    	    	        <th>Image</th>
	                    	    	        <th>Name</th>
	                    	    	        <th>Category</th>
	                    	    	        <th>Price</th>
	                    	    	        <th>Created At</th>
	                    	    	        <th>Actions</th>
	                    	    	    </tr>
	                    	    	</thead>
	                    	    </table>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
    </main>
@endsection

@section('script')
	<script>
		const URL_PRODUCT 			= '{{ route('brand.product.index') }}';
		const URL_PRODUCT_VIEW 		= '{{ route('brand.product.view', '/') }}';
		const URL_PRODUCT_EDIT 		= '{{ route('brand.product.edit', '/') }}';
		const URL_PRODUCT_DELETE 	= '{{ route('brand.product.delete', '/') }}';
		let defaultImgUrl 			= "{{asset('assets/media/avatars/default_img.png')}}";
	</script>
	<script src="{{ asset('assets/js/custom/common.js') }}"></script>
    <script src="{{ asset('vendors/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('brand_user/assets/js/products/index.js') }}"></script>
@endsection
