@extends('layouts.index')
@section('style')
<link rel="stylesheet" href="{{ asset('brand_user/influencer_details/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('brand_user/influencer_details/custom.css') }}">
<style>
    .fa-envelope{
        color:white !important;
    }
    .influencer-details .influencer-analytics .influencer-analytics-details {
        grid-template-columns: repeat(5, 1fr);
    }
</style>
@endsection
@section('content')
<main class="influencer-details">
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
		    <!--begin::Toolbar-->
				<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
					<!--begin::Toolbar container-->
					<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
						<!--begin::Page title-->
						<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
							<!--begin::Title-->
							<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Influencer Details</h1>
							<!--end::Title-->
							<!--begin::Breadcrumb-->
							<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
								<!--begin::Item-->
								<!-- <li class="breadcrumb-item text-muted">
									<a href="{{ route('brand.find_influencer') }}" class="text-muted text-hover-primary">Find Influencer</a>
								</li> -->
								@if(Auth::user()->hasRole('Brand'))
								<li class="breadcrumb-item text-muted">
									<a href="{{ route('brand.find_influencer') }}" class="text-muted text-hover-primary">Back</a>
								</li>
								@endif
								@if(Auth::user()->hasRole('Influencer'))
								<li class="breadcrumb-item text-muted">
									<a href="{{ route('influencer_dashboard') }}" class="text-muted text-hover-primary">Back</a>
								</li>
								@endif
								<!--end::Item-->
							</ul>
							<!--end::Breadcrumb-->
						</div>
						<!--end::Page title-->
					</div>
					<!--end::Toolbar container-->
				</div>
				<!--end::Toolbar-->
			<!--begin::Content wrapper-->
            <div class="container-fluid">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-container">
                                <div class="influencer-details-media">
                                    <div class="media-img">
                                        <img src="{{$data->media_profile}}" class="rounded-circle" alt="image">
                                       <!--  <div class="platform">
                                            <img src="./assets/images/icon/insta.png" alt="">
                                        </div> -->
                                    </div>

                                    <div class="media-body">
                                        <div class="media-left">
                                            <h5 class="username">{{ $data->nickname }} </h5>
                                            <ul class="background">
                                                <li><i class="fa-solid fa-location-dot"></i> {{ $data->country }} </li>
                                                <li><i class="fa-solid fa-language"></i> English </li>
                                                <li><i class="fa-solid fa-arrow-trend-up"></i> Trending</li>
                                            </ul>

                                            <div class="influencer-engagement-main">
                                                <div class="influencer-engagement">
                                                    <p>	Followers</p>
                                                    <h3>{{ intWithStyle($data->follower_count) }}</h3>
                                                </div>
                                                 <div class="influencer-engagement">
                                                    <p>Following</p>
                                                    <h3>{{ intWithStyle($data->following_count) }}</h3>
                                                </div>
                                                 <div class="influencer-engagement">
                                                    <p>	Total Post</p>
                                                    <h3>{{ intWithStyle($data->post_count) }}</h3>
                                                </div>
                                                 <div class="influencer-engagement">
                                                    <p>	Included In Campaign</p>
                                                    <h3>-</h3>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="media-right">
                                            <div class="media-right-content">
                                            @if(Auth::user()->hasRole('Brand'))
                                                @if($data->email != null)
                                                    <button type="button" class="primary-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_select_campaigns"> <i class="fa-solid fa-envelope"></i> Send Email</button>
                                                @endif
                                            @endif
                                            <div class="progress-main">
                                                <span>Engagements Rate</span>
                                                <div class="progress" role="progressbar" aria-label="example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: {{ intWithStyle($data->average_engagement_rate) }}%">{{ intWithStyle($data->average_engagement_rate) }}%</div>
                                                </div>
                                            </div>

                                            <!-- hidden button   -->
                                            <button type="button" class="outline-primary-button d-none"> <i class="fa-solid fa-square-plus"></i> Add to Campaign</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card-container">
                                <div class="influencer-content influencer-analytics">
                                    <h4>Analytics</h4>
                                    <div class="influencer-analytics-details">
                                        <div class="influencer-analytics-content ">
                                            <i class="fa-regular fa-eye views"></i>
                                            <h5>{{ intWithStyle($data->average_play_count) }}</h5>
                                            <span>Total Views</span>
                                        </div>
                                        <div class="influencer-analytics-content ">
                                            <i class="fa-regular fa-heart likes"></i>
                                            <h5>{{ intWithStyle($data->average_like_count) }}</h5>
                                            <span>Total Likes</span>
                                        </div>
                                        <div class="influencer-analytics-content ">
                                            <i class="fa-regular fa-message comments"></i>
                                            <h5>{{ intWithStyle($data->average_comment_count) }}</h5>
                                            <span>Average comments</span>
                                        </div>
                                        <div class="influencer-analytics-content ">
                                            <i class="fa-solid fa-share-nodes shares"></i>
                                            <h5>{{ intWithStyle($data->average_share_count) }}</h5>
                                            <span>Average Share</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card-container">
                                <div class="influencer-content influencer-analytics">
                                    <h4>Analytics</h4>
                                    <div class="influencer-analytics-details">
                                        <div id="chartEngRate"></div>
                                        <div id="chartViewFollowers"></div>
                                        <div id="chartLikeViews"></div>
                                        <div id="chartCommentViews"></div>
                                        <div id="chartShareViews"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card-container">
                                <div class="influencer-content influencer-contact">
                                    <h4>Contact</h4>
                                    <div class="influencer-contact-details">
                                        <div class="">
                                            <p>Name:</p>
                                            <span>{{ $data->nickname }}</span>
                                        </div>
                                        <div class="">
                                            <p>Signature:</p>
                                            <span>{{ isset($data->signature) ? $data->signature : 'N/A'}}</span>
                                        </div>
                                        <div class="">
                                            <p>Email:</p>
                                            <span>{{ isset($data->email) ? $data->email : 'N/A' }}</span>
                                        </div>
                                        <div class="mb-0">
                                            <p>Account Link:</p>
                                            <span>{{ isset($data->account_url) ? $data->account_url : $null }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-container">
                                <div class="influencer-content influencer-price">
                                    <h4>Post Price</h4>
                                    <div class="influencer-price-details">
                                        <div class="">
                                            <p>Est. Post Price:</p>
                                            <span>{{ isset($data->amount_from) ? '$'.intWithStyle($data->amount_from) : 'N/A' }} - {{ isset($data->amount_to) ?'$'.intWithStyle($data->amount_to) : 'N/A' }}</span>
                                        </div>
                                    </div>

                                    <small>We use influencer country, followers number, engagement rate and overall audience quality to estimate post price. Please note that the price range shown may not be endorsed by the Influencer.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="card-container row">
                            <h4>Most Recent Videos</h4>
                                @php
                                    $collection = collect($data['influencerDetails']);
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


                        <!-- hidden section  -->
                        <div class="col-lg-12 d-none">
                            <div class="card-container">
                                <div class="influencer-content influencer-similar">
                                    <h4>Similar accounts</h4>
                                    <div class="influencer-similar-account">
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/images/icon/user-icon.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>@username</p>
                                                <span>2.4 Followers</span>
                                                <a href="">View report</a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/images/icon/user-icon.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>@username</p>
                                                <span>2.4 Followers</span>
                                                <a href="">View report</a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/images/icon/user-icon.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>@username</p>
                                                <span>2.4 Followers</span>
                                                <a href="">View report</a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/images/icon/user-icon.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>@username</p>
                                                <span>2.4 Followers</span>
                                                <a href="">View report</a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/images/icon/user-icon.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>@username</p>
                                                <span>2.4 Followers</span>
                                                <a href="">View report</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- hidden section  -->

                    </div>
                </div>
            </div>

    </div>
</main>
<!-- Model start -->
	<!--begin::Modal - New Address-->
	<div class="modal fade" id="kt_modal_select_campaigns" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Form-->
					<form class="form" id="select_campaign" method="POST">
						@csrf
                        <input type="hidden" name="influencer_id" id="influencer_id" value="{{ $data->id }}" />
						<!--begin::Modal header-->
						<div class="modal-header" id="">
							<!--begin::Modal title-->
							<h2>Select Campaign to invite influencer</h2>
							<!--end::Modal title-->
							<!--begin::Close-->
							<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
								<span class="svg-icon svg-icon-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
										<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Close-->
						</div>
						<!--end::Modal header-->
						<!--begin::Modal body-->
						<div class="modal-body py-10 px-lg-17">
							<!--begin::Scroll-->
							<div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
								<!--begin::Notice-->

								<!--end::Notice-->
								<!--begin::Input group-->
								@if(Auth::user()->hasRole('Brand'))
								<div class="row mb-5">
									<!--begin::Col-->
									<div class="col-md-6 fv-row">
										<!--begin::Label-->
										<label class="required fs-5 fw-semibold mb-2">Select Campaign</label>
										<!--end::Label-->
										<!--begin::Input-->
										<input type="hidden" name="send_email" value="{{ isset($data->email) ? $data->email : 'N/A' }}"/>

										<select class="form-control" id="campaign_name" name="campaign_name">
											<option value="">Select Campaign</option>
											@foreach($brand_data as $key=>$value)
												<option value="{{ $value->id }}">{{ $value->name_en }}</option>
											@endforeach
										</select>
											<!-- <input type="text" class="form-control form-control-solid" placeholder="" name="first-name" /> -->
										<!--end::Input-->
									</div>
									<!--end::Col-->


								</div>
								@endif
								<div class="row mb-5">
									<div class="col-md-6 fv-row">
										<!--begin::Label-->
										<label class="fs-5 fw-semibold mb-2">Influencer Mail :</label>
										<!--end::Label-->
										<!--begin::Input-->


											<input type="email" class="form-control form-control-solid" placeholder="" id="email" name="email" value="{{ isset($data->email) ? $data->email : 'N/A' }}" disabled />


										<!--end::Input-->
									</div>
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Scroll-->
						</div>
						<!--end::Modal body-->
						<!--begin::Modal footer-->
						<div class="modal-footer flex-center">
							<!--begin::Button-->
							<button type="submit" id="camp_submit" class="btn btn-primary">
								<span class="indicator-label">Submit</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
							<!--end::Button-->
						</div>
						<!--end::Modal footer-->
					</form>
					<!--end::Form-->
				</div>
			</div>
		</div>

<!-- Model end -->
@endsection

@section('script')
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/pages/user-profile/general.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-address.js') }}"></script>
<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
$(document).ready(function(){
    $("#select_campaign").validate({
        rules: {
            'campaign_name': {
                required: true
            },
        },
        messages: {
            'campaign_name': {
                required: "Please select campaign"
            },
        },
		submitHandler: function(form) {
			let url = window.CONFIG.ROUTES.sent_invitation;
			$.ajax({
				url: url,
				type: "POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					camp_id : $('#campaign_name').val(),
					email : $('#email').val(),
                    influencer_id : $('#influencer_id').val()
				},
				beforeSend: function() {
					$('.loading').removeClass('d-none')
					$('.loading').show();
				},
				success: function(response) {
					$('.loading').hide();
					alert("ok");
					$('#kt_modal_select_campaigns').hide();
					window.location = window.location.href;
				}
			});
        return false;
    },
    });

    // Engagement rate chart start here
    var engRateRatio = '{{ $data->average_engagement_rate }}';
    var optionsEngRate = {
        series: [engRateRatio],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#249df9'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Engagement Rate'],
    };

    var chartEngRate = new ApexCharts(document.querySelector("#chartEngRate"), optionsEngRate);
    chartEngRate.render();
    // Engagement rate chart end here

    // View/Followers rate chart start here
    var optionsViewFolloweres = {
        series: [50],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#d7a022'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Views/Followers'],
    };

    var chartViewFollowers = new ApexCharts(document.querySelector("#chartViewFollowers"), optionsViewFolloweres);
    chartViewFollowers.render();
    // View/Followers rate chart end here

    // Like/Views rate chart start here
    var optionsLikeViews = {
        series: [55],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#198ce5'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Likes/Views'],
    };

    var chartLikeViews = new ApexCharts(document.querySelector("#chartLikeViews"), optionsLikeViews);
    chartLikeViews.render();
    // Like/Views rate chart end here

    // Comment/Views rate chart start here
    var optionsCommentViews = {
        series: [45],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#d7a022'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Comments/Views'],
    };

    var chartCommentViews = new ApexCharts(document.querySelector("#chartCommentViews"), optionsCommentViews);
    chartCommentViews.render();
    // Comment/Views rate chart end here

    // Share/Views rate chart start here
    var optionsShareViews = {
        series: [35],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#198ce5'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Shares/Views'],
    };

    var chartShareViews = new ApexCharts(document.querySelector("#chartShareViews"), optionsShareViews);
    chartShareViews.render();
    // Share/Views rate chart end here
});

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
