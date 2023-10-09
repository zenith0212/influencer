@extends('layouts.index')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .filter-content.card-container {
        padding-top: 0;
    }
    .filter-content .card-list{
        padding: 20px 0;
        border-bottom: 1px solid rgba(11, 11, 11, 0.1);
    }
    .filter-content .card-list .influencer-profile{
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
    }
    .filter-content .card-list .influencer-profile-img {
        max-width: 100px;
        min-width: 100px;
        height: 100px;
        border-radius: 100%;
        overflow: hidden;
    }
    .filter-content .card-list .influencer-profile-img img{
        max-width: 100%;
    }
    .filter-content .card-list .influencer-details {
        width: 100%;
    }
    .filter-content .card-list .influencer-details h4 {
        font-size: 20px;
        line-height: 1.5;
        color: #0B0B0B;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .filter-content .card-list .influencer-details h4 a{
    	color: #0B0B0B;
    	display: inline-block;
    }

    .filter-content .card-list .influencer-details h4 a i {
    	color: #a1a5b7;
    }

     .filter-content .card-list .influencer-details h4 a i:hover{
    	color: #f55345;
    }


    .filter-content .card-list .influencer-details p {
        margin-bottom: 10px;
    }
    .filter-content .card-list .influencer-details .influencer-lable{
        display: flex;
        gap: 8px;
        margin-bottom: 15px;
        align-items:center;
    }

    .filter-content .card-list .influencer-details .influencer-lable a{
    	color: #a1a5b7;
    	margin-left: auto;
    }

    .filter-content .card-list .influencer-details .influencer-lable span{
      display: inline-block;
    padding: 4px;
    background: #22567526;
    color: #225675;
    font-size: 11px;
    border-radius: 4px;
    white-space: nowrap;
    }

    .filter-content .card-list .influencer-details ul{
        display: flex;
        gap: 15px;
        padding: 0;
        margin: 0;
        flex-wrap: nowrap;
    }

    .filter-content .card-list .influencer-details ul li {
    	font-size: 14px;
    	display: flex;
    	align-items: center;
    }


    .filter-content .card-list .influencer-details ul li i {
    	margin-right: 8px;
    }

    .influencer-engagement-main .influencer-engagement .influencer-engagement-list{
    	display: flex;
	    align-items: center;
	    justify-content: space-between;
	    font-size: 14px;
	    line-height: 1.5;
	   
    }

    .influencer-engagement-main .influencer-engagement .influencer-engagement-list:not(:last-child){
    	 margin-bottom: 15px;
    }

    .influencer-engagement-main .influencer-engagement .influencer-engagement-list ul {
    	display: flex;
    	 align-items: center;
    	     	gap: 5px;
    	margin-bottom: 0;
    }

    .influencer-engagement-main .influencer-engagement .influencer-engagement-list ul li i:hover, .influencer-engagement-main .influencer-engagement .influencer-engagement-list ul li i.active{
    	color: #FF9529;
    }

    .influencer-content-img{
    	text-align:center;
    }

    .total_count_data{
        margin-left :  10px;
        font-size : 17px;
    }

    @media (max-width: 1499px) {
    	.filter-content .card-list .influencer-details ul li{
    		flex-direction: column;
    		text-align: center;
    		justify-content: center;
    		font-size: 12px;

    	}
    	.filter-content .card-list .influencer-details ul li i {
    		margin-right: 0;
    		margin-bottom: 6px;
    	}

    	.filter-content .card-list .influencer-profile-img{
    		max-width: 80px;
    		 min-width: 80px;
   			height: 80px;
    	}	
    }


    @media (max-width: 1199px) {
    	.filter-content .card-list .influencer-profile{
    		margin-bottom: 30px;
    	}
    }

    @media (max-width: 991px) {
    
    

    	.filter-content .card-list .influencer-details h4{
    		font-size: 18px;
    	}
    }

     @media (max-width: 767px) {
     		.filter-content .card-list .influencer-profile{
    		justify-content: center;
    		text-align: center;
    		flex-direction: column;
    	}

    	.filter-content .card-list .influencer-details h4{
    		justify-content: center;
    	}

    	.filter-content .card-list .influencer-details h4 i {
    		position: absolute;
    		top: 10px;
    		right: 10px;
    	}

    	.filter-content .card-list .influencer-details .influencer-lable{
    		justify-content: center;	
    	}

    	.filter-content .card-list .influencer-details ul{
    		justify-content: center;	
    	}

    	.influencer-engagement-main .influencer-engagement .influencer-engagement-list{
    		font-size: 12px	;
    	}

    	.filter-content .card-list .influencer-details .influencer-lable a{
    		margin-left:0;
    	}


     }	

     @media (max-width: 575px) {
     	.influencer-engagement-main .influencer-engagement{
    		padding: 0 15px;
    		margin-bottom: 30px;
    	}
     }

     .favourite-btn{
			outline: none;
			border: none;
			background:transparent;
		}
	i.fas.fa-heart {
    color: black;
}

		.favourite-btn i{
			font-size: 18px !important;

		}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css"> -->
<style>
	.select2-container .select2-selection--single{
		height: 45px !important;
	}
</style>
@endsection
@section('content')
<main class="body-change">
    <div class="content">
        <div class="container-fluid">
					<!--begin::Toolbar-->
					<div class="app-toolbar py-3 py-lg-6">
						<!--begin::Toolbar container-->
						<div id="kt_app_toolbar_container" class="d-flex flex-stack">
							<!--begin::Page title-->
							<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
								<!--begin::Title-->
								<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Find Influencers</h1>
								<!--end::Title-->
								<!--begin::Breadcrumb-->
								<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
									<!--begin::Item-->
									<li class="breadcrumb-item text-muted">
										<div class="text-muted">Find influencers who match with your campaign needs by demographic, geographic, and psychographic criteria.</div>
									</li>
									<!--end::Item-->

								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title-->
						</div>
						<!--end::Toolbar container-->
					</div>
					<!--end::Toolbar-->
					<!--begin::Content-->
					<div  class="app-content flex-column-fluid">
						<!--begin::Content container-->
						<div id="kt_app_content_container" class="">
                            <p class="total_count_data" id="total_count_data" data-id="{{ intWithStyle($total) }}">{{ intWithStyle($total) }} Records found.</p>
							<!--begin::Form-->
							<form id="search_influencers" method="" autocomplete="off">
								<!--begin::Card-->
								<div class="card mb-7">
									<!--begin::Card body-->
									<div class="card-body">
										<!--begin::Compact form-->
										<div class="d-flex align-items-center flex-wrap">
											<!--begin::Input group-->
											<div class="position-relative w-100">
												<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
												<span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
													</svg>
												</span>
												<!--end::Svg Icon-->
												<input type="text" class="form-control form-control-solid ps-10 search_name" name="search_name" id="search_name" value="" placeholder="Search Influencer">
											</div>
											<!--end::Input group-->
											<!--begin:Action-->
											<div class="d-flex align-items-center justify-content-between w-100 mt-4">
                                                <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse" href="#kt_advanced_search_form">Filters</a>

												<button type="submit" class="btn primary-btn" id="search">Show Influencer</button>

												
											</div>
											<!--end:Action-->
										</div>
										<!--end::Compact form-->
										<!--begin::Advance form-->
										<div class="collapse" id="kt_advanced_search_form">
                                            <!--begin::Separator-->
                                            <div class="separator separator-dashed mt-9 mb-6"></div>
                                            <!--end::Separator-->
                                            <!--begin::Row-->
                                            <div class="row g-8 mb-8">
                                                <!--begin::Col-->
												<!--  <div class="col-xxl-3">
														<label class="fs-6 form-label fw-bold text-dark">Name</label>
														<input type="text" class="form-control form-control form-control-solid" name="name" id="name" placeholder="search by name"/>
													</div> -->
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-xxl-3">
                                                    <label class="fs-6 form-label fw-bold text-dark">Category</label>
                                                    <input type="text" class="form-control form-control form-control-solid" name="category" id="category" placeholder="search by category"/>
                                                </div>
                                                <!--end::Col-->
                                                <div class="col-lg-4">
                                                    <label class="fs-6 form-label fw-bold text-dark">Country</label>
                                                    <!--begin::Select-->
                                                    <select class="form-select js-example-basic-single" data-control="select2" data-placeholder="Select Country" data-hide-search="true" id="country">
                                                        <option value=""></option>
                                                        @foreach($getcountrylist as $key=>$value)
                                                            <option value="{{$value->code}}">{{$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--end::Select-->
                                                </div>
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="row g-8">
                                                <!--begin::Col-->
                                                <div class="col-xxl-7">
                                                    <!--begin::Row-->
                                                    <div class="row g-8">
                                                        <!--begin::Col-->
                                                        <div class="col-lg-6">
                                                            <label class="fs-6 form-label fw-bold text-dark">Min. Followers</label>
                                                            <!--begin::Dialer-->
                                                            <input type="number" class="form-control form-control form-control-solid" name="min" id="min" placeholder="minimum followers"/>
                                                            <!--end::Dialer-->
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-6">
                                                            <label class="fs-6 form-label fw-bold text-dark">Max. Followers</label>
                                                            <!--begin::Dialer-->
                                                            <input type="number" class="form-control form-control form-control-solid" name="max" id="max" placeholder="maximum followers"/>
                                                            <!--end::Dialer-->
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Row-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-xxl-5">
                                                    <!--begin::Row-->
                                                    <div class="row g-8">
                                                        <!--begin::Col-->


                                                        <div class="col-lg-6">
                                                            <label class="fs-6 form-label fw-bold text-dark">Engement Rate</label>
                                                            <div id="kt_slider_basic"></div>

                                                            <div class="pt-5">
                                                                <div class="fw-semibold mb-2">Min: <span id="kt_slider_basic_min"></span></div>
                                                                <div class="fw-semibold mb-2">Max: <span id="kt_slider_basic_max"></span></div>
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <!-- <div class="col-lg-6">
                                                            <label class="fs-6 form-label fw-bold text-dark">Status</label>
                                                            <div class="form-check form-switch form-check-custom form-check-solid mt-1">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexSwitchChecked" checked="checked" />
                                                                <label class="form-check-label" for="flexSwitchChecked">Active</label>
                                                            </div>
                                                        </div> -->

                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Row-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
										</div>
										<!--end::Advance form-->

												
										
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->
							</form>
							<!--end::Form-->
                            <div id="get_list"></div>
                            <div class="filter-content card-container ">
                                @foreach($get_records as $key=>$value)
                                <div class="card-list">
                                    <div class="row align-items-center gx-8">
                                        <div class="col-xl-4">
                                            <div class="influencer-profile">
                                                <div class="influencer-profile-img">
                                                    <img src="{{ $value->media_profile }}" alt="">
                                                </div>
                                                <div class="influencer-details">
                                                    <h4> 
                                                    	<a href="{{ url('brand/find-influencer') }}/{{ $value->id }}"> {{ $value->nickname }}</a>  
                                                    	@if($value->favourites == null)
														<button type="button" class="add favourite-btn" id="addfavourites{{$value->id}}" onClick="addToFavourites({{$value->id}}, {{ Auth::user()->id }},'1','2')"> <i class="fa-regular fa-heart"></i> </button>
														@else
														<button type="button" class="delete favourite-btn" id="deletefavourites{{$value->id}}" onClick="deleteFromFavourites({{$value->id}},{{ Auth::user()->id }},{{$value->favourites->id}},2)"><i class="fas fa-heart" ></i></button>
														@endif
                                                    </h4>
                                                    <p>{{ $value->signature }}</p>
                                                    <div class="influencer-lable">
                                                        <span>beast</span>
                                                        <span>Food</span>
                                                        <span>mrbeast</span>

                                                        <a href=""><i class="fa-solid fa-ellipsis"></i></a>
                                                    </div>
                                                    <ul>
                                                        <li><i class="fa-solid fa-users"></i> {{ intWithStyle($value->following_count) }}</li>
                                                        <li><i class="fa-solid fa-user-plus"></i>{{ intWithStyle($value->follower_count) }}</li>
                                                        <li><i class="fa-solid fa-file-video"></i>{{ intWithStyle($value->average_play_count) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="influencer-engagement-main">
                                                <div class="influencer-engagement">
                                                    <div class="influencer-engagement-list">
                                                        <span>Country</span> <b> {{ $value->country }}</b>
                                                    </div>
                                                    <div class="influencer-engagement-list">
                                                        <span>Followers</span> <b>{{ intWithStyle($value->follower_count) }}</b>
                                                    </div>
                                                    <div class="influencer-engagement-list">
                                                        <span>Engagement Rate</span> <b>{{ $value->average_engagement_rate }}</b>
                                                    </div>
                                                    <div class="influencer-engagement-list">
                                                        <span>Est. Views</span> <b>{{ intWithStyle($value->average_play_count) }}</b>
                                                    </div>
													{{-- <div class="influencer-engagement-list">
                                                        <span>Ratings</span> <ul>
                                                        	<li><i class="fa-solid fa-star active"></i></li>
                                                        	<li><i class="fa-solid fa-star active"></i></li>
                                                        	<li><i class="fa-solid fa-star active"></i></li>
                                                        	<li><i class="fa-solid fa-star"></i></li>
                                                        	<li><i class="fa-solid fa-star"></i></li>
                                                        </ul>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="row">
                                                @php
                                                    $collection = collect($value['influencerDetails']);
                                                    $chunk = $collection->take(2);
                                                @endphp
                                                @if(!$chunk->isEmpty())
                                                    @foreach($chunk as $key=>$details)
                                                        <div class="col-6">
                                                            <div class="influencer-content-img">
                                                                <!-- <img src="https://dummyimage.com/200x200/000/fff" alt="">	 -->
                                                                @if(isset($details->profile))
                                                                    <a id="playVideo-{{ $details->id }}" class="playVideo" data-id="{{ $details->id }}" data-link="{{ $details->link }}" data-likes="{{ intWithStyle($details->like_count) }}" data-comment="{{ intWithStyle($details->comment_count) }}" data-share = "{{ intWithStyle($details->share_count) }}" data-play="{{ intWithStyle($details->play_count) }}"  onclick="playVideo({{ $details->id }},'{{ $details->link }}','{{ intWithStyle($details->like_count) }}','{{ intWithStyle($details->comment_count) }}','{{ intWithStyle($details->share_count) }}','{{ intWithStyle($details->play_count) }}')">

                                                                        <img width="200" height="200"
                                                                         src="{{ $details->profile }}" alt="" class="play_video"/>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="campaign-actions mb-4">
                                                        <span class="badge badge-danger">No data Available</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
								@endforeach
								<div id="load_more"></div>
                           </div>
							@if(count($get_records)>0)
								<div class="d-flex flex-center" id="remove-row">
									<a href="javascript:void(0);" class="btn primary-btn fw-bold px-6" id="kt_social_feeds_more_posts_btn"  data-id="{{ $value->id }}">
										<input type="hidden" id="loader_id" value="{{ $value->id }}"/>
										<span class="indicator-label">Show more</span>

										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</a>
								</div>
							@endif
                    </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script src="{{ asset('brand_user/assets/js/search-influencers.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/search/horizontal.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

$(document).ready(function(){
    

   $('.js-example-basic-single').select2();
   $(document).on('click','#kt_social_feeds_more_posts_btn',function(e){
	   e.preventDefault();
	   let id = $('#loader_id').val();
       $("#kt_social_feeds_more_posts_btn").html("Loading....");
	   let url =  window.CONFIG.ROUTES.load_influencer
       $.ajax({
           url :  url,
           method : "POST",
           data : {	
				 id:id, 
				_token:"{{csrf_token()}}",
				country: $('#country').val(),
				min: $('#min').val(),
				max: $('#max').val(),
				min_rate : $('#kt_slider_basic_min').text(),
				max_rate : $('#kt_slider_basic_max').text(),
                searchValue : $('#search_name').val(),
                total : $('#total_count_data').attr("data-id")
			},
           dataType : "json",
		   beforeSend: function() {
                $('.loading').removeClass('d-none');
                $('.loading').show();
            },
           success : function (response)
           {
			  $('.loading').hide();
              console.log(response)
              if(response.status == true)
              {
				$('#load_more').append(response.html);
                if(response.total){
                    $('#total_count_data').html(response.total + ' Records found.');
                }else{
                    // $('#total_count_data').html('No Records found.');
                }
				$("#kt_social_feeds_more_posts_btn").html("Show More");
				$('#loader_id').val(response.influencer_id);
                    if(response.influencer_id == response.max) {
                        $('#kt_social_feeds_more_posts_btn').hide();
                    }
              }
              else
              { 
                 $('#kt_social_feeds_more_posts_btn').hide();
                 $('#kt_social_feeds_more_posts_btn').html("No Data");
              }
           }
       });
   });

   /* filter menu start */
    var slider = document.querySelector("#kt_slider_basic");
	var valueMin = document.querySelector("#kt_slider_basic_min");
	var valueMax = document.querySelector("#kt_slider_basic_max");

	noUiSlider.create(slider, {
		start: [0, 0],
		connect: true,
		range: {
			"min": 0,
			"max": 50
		}
	});

	slider.noUiSlider.on("update", function (values, handle) {
		if (handle) {
			valueMax.innerHTML = values[handle];
		} else {
			valueMin.innerHTML = values[handle];
		}
	});

	/*=====================
	05. initalize select2 juery
	==========================*/

	'use strict';

	( function ( document, window, index )
	{
		var inputs = document.querySelectorAll( '.inputfile' );
		Array.prototype.forEach.call( inputs, function( input )
		{
			var label	 = input.nextElementSibling,
				labelVal = label.innerHTML;

			input.addEventListener( 'change', function( e ){
				var fileName = '';
				if( this.files && this.files.length > 1 )
					fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
				else
					fileName = e.target.value.split( '\\' ).pop();

				if( fileName )
					label.querySelector( 'span' ).innerHTML = fileName;
				else
					label.innerHTML = labelVal;
			});

			// Firefox bug fix
			input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
			input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
		});
	}( document, window, 0 ));

});

function addToFavourites(influencerid, userid, is_favourite, is_type) {
    var user_id = userid;
    var influencer_id = influencerid;
    var is_favourite = '1';
    var is_type = is_type ;

    accept_request(`Are you sure you want to mark this influencer as favourite?`).then(function (response) {
  	if (response['isConfirmed']) {
	    $.ajax({
	        type: 'post',
	        url: "{{route('addtofavourite')}}",
	        data: {
	            'user_id': user_id,
	            'influencer_id': influencer_id,
	            'is_favourite' : is_favourite,
	            'is_type' : is_type
	        },
	        success: function (response) {
	        	if(response.status) {
		            $('.add').hide();
		            $('.delete').show();
		            data_insert_notification(response.message)
		            setInterval(() => {
		                window.location.href = window.location.href
		            }, 1500);
	        	}
	        	else {
	        		error_notification( response.message );
	        	}
	        },
	        error: function (XMLHttpRequest) {
	            // handle error
	        }
	    });

	    $('#addfavourites' + influencer_id).show();
	    $('#deletefavourite' + influencer_id).hide();
	}
});
}


function deleteFromFavourites(influencer_id,user_id,id,is_favourite) {
	var influencer_id = influencer_id;
	var user_id = user_id;
    var id = id;
    var is_favourite = '2'
	delete_confirmation('Are you sure you want to remove this influencer from favourites?','Yes, confirm').then(function (response) {
	if (response['isConfirmed']) {
	    $.ajax({
	        type: 'delete',
	        url: "{{route('deletefromfavourite','id')}}",
	        data: {
	        	'influencer_id': influencer_id,
	        	'user_id' : user_id,
	            'id': id,
	            'is_favourite': is_favourite
	        },
	        success: function (response) {
             	if ( response.status ) {
             		$('.add').show();
		            $('.delete').hide();
		            delete_notification( response.message );
		            setInterval(() => {
		                window.location.href = window.location.href
		            }, 1000);
                   
                } else {
                   error_notification( response.message );
                }
	        },
	        error: function (XMLHttpRequest) {
	            // handle error
	        }
	    });
	}
});
	$('#addfavourites' + influencer_id).show();
    $('#deletefavourite' + influencer_id).hide();
}
    
function mark_favourite(message = 'Are you sure you want to mark this influencer as favourite?', confirmButtonText = "Yes,Favourite it!", cancelButtonText = 'No, cancel' ) {
    return Swal.fire({
        text: message,
        icon: "info",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-danger custom-button-css",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    });
}
/* open video on modal popup start */
function playVideo(id,link,likes,commment,share,play){
    var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Recent Videos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="interested-influencers">
                        
                           <div>
                           <iframe width="420" height="315" src="${link}?autoplay=1&embedded=true" target="_parent">
                           </iframe>
                           </div>
                           <div class="interested-influencers">
                                <b>Total likes: </b>
                                <span>${likes}</span>
                            </div>
                            <div class="interested-influencers">
                                <b>Total Comments: </b>
                                <span> ${commment}</span>
                            </div>
                            <div class="interested-influencers">
                                <b>Total Views: </b>
                                <span> ${play} </span>
                            </div>
                            <div class="interested-influencers">
                                <b>Total Share: </b>
                                <span> ${share} </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>`;
        make_modal('PlayVideo', html, true, null);
}
/* open video on modal popup end */
</script>
@endsection
