@extends('layouts.index')
<style>


</style>
@section('title')
	{{ $title }}
@endsection

@section('style')
	<style>
		.input-group.serch-input {
    		margin-left: 187px;
		}
		.status.status-requested {
		    background: #efefc9;
		}

		.status.status-pause {
		    background: #cee1b7;
		}
	</style>
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
	                <h3>Sample Products List</h3>
	            	<div id="alert-message-wrapper" class="alert-message-wrapper">
	            		<x-auth-validation-errors :errors="$errors" />
	            		<x-auth-session-status :status="session()->get('status')" />
	            	</div>

	                <div class="row align-items-center mb-4">
	                    <div class="col-md-6 col-lg-4 offset-6">
	                        <form action="">
	                            <div class="input-group serch-input">
	                                <input type="search" id="search_sample_product" class="form-control" placeholder="Search here">
	                                <button class="" type="submit"><i class="fas fa-search"></i></button>
	                            </div>
	                        </form>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-12">
	                    	<div class="table-heading">
	                    	    <h4>Total Sample request (<span id="table-sample-request-count">0</span>)</h4>
	                    	</div>

	                    	<div class="campaign-list-table list-table">
	                    	    <table id="table-sample-request-list" class="display table-sample-request-list">
	                    	    	<thead>
	                    	    	    <tr>
	                    	    	        <th>Image</th>
	                    	    	        <th>Product Name</th>
	                    	    	        <th>Campaign Name</th>
	                    	    	        <th>Influencer Name</th>
	                    	    	        <th>Product status</th>
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
		const URL_PRODUCT_SAMPLE = '{{ route('brand.product.sampleRequest') }}';
		const URL_PRODUCT_VIEW = '{{ route('brand.product.view', '/') }}';
		// const URL_PRODUCT_EDIT = '{{ route('brand.product.edit', '/') }}';
		// const URL_PRODUCT_DELETE = '{{ route('brand.product.delete', '/') }}';
	</script>
	    <script src="{{ asset('vendors/datatable/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('brand_user/assets/js/products/index.js') }}"></script>
@endsection
