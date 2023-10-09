@extends('layouts.index')

@section('title')
	{{ $title }}
@endsection

@section('style')
	<style>
	.input-group.serch-input {
    	margin-left: 187px;
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
	                <h3>Favourite Influencers</h3>
	            	
	            	<div id="alert-message-wrapper" class="alert-message-wrapper">
	            		<x-auth-validation-errors :errors="$errors" />
	            		<x-auth-session-status :status="session()->get('status')" />
	            	</div>

	                <div class="row align-items-center mb-4">
	                    <div class="col-md-6 col-lg-4 offset-6">
	                        <form action="">
	                            <div class="input-group serch-input">
	                                <input type="search" id="search_influencer" class="form-control" placeholder="Search here">
	                                <button class="" type="submit"><i class="fas fa-search"></i></button>
	                            </div>
	                        </form>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-12">
	                    	<div class="table-heading">
	                    	    <h4>Total Favourite Influencers (<span id="total-favourite-influencers-count">0</span>)</h4>
	                    	</div>

	                    	<div class="campaign-list-table list-table">
	                    	    <table id="table-favourite-influencers-list" class="display table-favourite-influencers-list">
	                    	    	<thead>
	                    	    	    <tr>
	                    	    	        <th>Image</th>
	                    	    	        <th>Name</th>
	                    	    	        <th>Country</th>
	                    	    	        <th>Followers</th>
	                    	    	        <th>Following</th>
	                    	    	        <th>Average Likes</th>
	                    	    	        <th>Action</th>
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
		const URL_FAVOURITE_INFLUENCER_LIST 	= '{{ route('brand.favouriteInfluencers') }}';
		const URL_INFLUENCER_VIEW 				= '{{ route('brand.influencer_details','/') }}';
		let defaultImgUrl 						= "{{asset('assets/media/avatars/default_img.png')}}";
	</script>
    <script src="{{ asset('vendors/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/favourites.js') }}"></script>
@endsection
