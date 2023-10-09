@extends('layouts.index')
@section('content')
<main class="body-change">
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
			<div class="d-flex flex-column flex-column-fluid">
				<div id="kt_app_content" class="app-content flex-column-fluid">
					<!--begin::Content container-->
					<div id="kt_app_content_container" class="app-container container-xxl">
						<div class="card mb-5 mb-xxl-8">
										<div class="card-body pt-9 pb-0">
											<!--begin::Details-->
											<div class="d-flex flex-wrap flex-sm-nowrap">
												<!--begin: Pic-->
												<div class="me-7 mb-4">
													<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
														<img src="{{$data->media_profile}}" alt="image">
													</div>
												</div>
												<!--end::Pic-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<!--begin::Title-->
													<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
														<!--begin::User-->
														<div class="d-flex flex-column">
															<!--begin::Name-->
															<div class="d-flex align-items-center mb-2">
																<a href="{{ isset($data->account_url) ? $data->account_url : $null }}" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $data->nickname }}</a>
																<a href="#">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
																	<span class="svg-icon svg-icon-1 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																			<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor"></path>
																			<path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</a>
															</div>
															<!--end::Name-->
															<!--begin::Info-->
															<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
																
																<a href="javascript:void(0);" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
																<!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
																<span class="svg-icon svg-icon-4 me-1">
																	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor"></path>
																		<path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
																	</svg>
																</span>
																<!--end::Svg Icon-->{{ $data->country }}</a>
																@php
																	$email = json_decode($data->email); 
																		foreach($email as $email_data){}
																	$null ="N/A";                                                               
																@endphp
																<a href="mailto:{{ $email_data->value }}" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
																<!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
																<span class="svg-icon svg-icon-4 me-1">
																	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
																		<path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
																	</svg>
																</span>
																
																<!--end::Svg Icon-->{{ isset($email_data->value) ? $email_data->value : $null }}</a>
															</div>
															<!--end::Info-->

																<!--begin::Info-->
																<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
																
																
																<div class="d-flex align-items-center text-gray-400 mb-2">
																<!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
																<!--end::Svg Icon-->{{ isset($data->signature) ? $data->signature : ''}}</div>
															</div>
															<!--end::Info-->
														</div>
														<!--end::User-->
														<!--begin::Actions-->
														@if(Auth::user()->hasRole('Brand'))
														@if(isset($email_data->value))
															<div class="d-flex my-4">
																<a href="javascript:void(0);" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal" data-bs-target="#kt_modal_select_campaigns">Send Email</a>
															</div>
														@endif
														@endif
														<!--end::Actions-->
													</div>
													<!--end::Title-->
													<!--begin::Stats-->
													<div class="d-flex flex-wrap flex-stack">
														<!--begin::Wrapper-->
														<div class="d-flex flex-column flex-grow-1 pe-8">
															<!--begin::Stats-->
															<div class="d-flex flex-wrap">
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
																		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
																		<span class="svg-icon svg-icon-2">
																			<svg class="svg-icon" viewBox="0 0 20 20"><path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path></svg>
																		</span>
																		<!--end::Svg Icon-->
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1"> {{ intWithStyle($data->follower_count) }}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Followers</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
																		<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
																		<span class="svg-icon svg-icon-2">
																			<svg class="svg-icon" viewBox="0 0 20 20"><path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path></svg>
																		</span>
																		<!--end::Svg Icon-->
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ intWithStyle($data->following_count) }}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Following</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
																		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
																		<span class="svg-icon svg-icon-2">
																			<svg class="svg-icon" viewBox="0 0 20 20"><path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61"></path></svg>
																		</span>
																		<!--end::Svg Icon-->
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1">{{ intWithStyle($data->average_like_count) }}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Likes</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::Wrapper-->
														<!--begin::Progress-->
														<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
															<div class="d-flex justify-content-between w-100 mt-auto mb-2">
																<span class="fw-semibold fs-6 text-gray-400">Enagement Rate</span>
																<span class="fw-bold fs-6">{{ intWithStyle($data->average_engagement_rate) }}%</span>
															</div>
															<div class="h-5px mx-3 w-100 bg-light mb-3">
																<div class="bg-success rounded h-5px" role="progressbar" style="width: {{ intWithStyle($data->average_engagement_rate) }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<!--end::Progress-->
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Info-->
											</div>
											<!--end::Details-->
										</div>
									</div>
						</div>
						<div class="row g-5 g-xl-10" style="margin-left: 12px;">
									<!--begin::Col-->
									<div class="col-sm-6 col-xl-2 mb-xl-10">
										<!--begin::Card widget 2-->
										<div class="card">
											<!--begin::Body-->
											<div class="card-body d-flex justify-content-between align-items-start flex-column">
												<!--begin::Icon-->
												<div class="m-0">
													<img src="{{ asset('assets/media/svg/brand-logos/view.png') }}" class="w-35px" alt="">
												</div>
												<!--end::Icon-->
												<!--begin::Section-->
												<div class="d-flex flex-column my-7">
													<!--begin::Number-->
													<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ intWithStyle($data->average_play_count) }}</span>
													<!--end::Number-->
													<!--begin::Follower-->
													<div class="m-0">
														<span class="fw-semibold fs-6 text-gray-400">Total Views</span>
													</div>
													<!--end::Follower-->
												</div>
												<!--end::Section-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card widget 2-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-sm-6 col-xl-2 mb-xl-10">
										<!--begin::Card widget 2-->
										<div class="card">
											<!--begin::Body-->
											<div class="card-body d-flex justify-content-between align-items-start flex-column">
												<!--begin::Icon-->
												<div class="m-0">
													<img src="{{ asset('assets/media/svg/brand-logos/share.png') }}" class="w-35px" alt="">
												</div>
												<!--end::Icon-->
												<!--begin::Section-->
												<div class="d-flex flex-column my-7">
													<!--begin::Number-->
													<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ intWithStyle($data->average_share_count) }}</span>
													<!--end::Number-->
													<!--begin::Follower-->
													<div class="m-0">
														<span class="fw-semibold fs-6 text-gray-400">Average Share</span>
													</div>
													<!--end::Follower-->
												</div>
												<!--end::Section-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card widget 2-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-sm-6 col-xl-2 mb-xl-10">
										<!--begin::Card widget 2-->
										<div class="card">
											<!--begin::Body-->
											<div class="card-body d-flex justify-content-between align-items-start flex-column">
												<!--begin::Icon-->
												<div class="m-0">
													<img src="{{ asset('assets/media/svg/brand-logos/like.png') }}" class="w-35px" alt="">
												</div>
												<!--end::Icon-->
												<!--begin::Section-->
												<div class="d-flex flex-column my-7">
													<!--begin::Number-->
													<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ intWithStyle($data->post_count) }}</span>
													<!--end::Number-->
													<!--begin::Follower-->
													<div class="m-0">
														<span class="fw-semibold fs-6 text-gray-400">Total Post</span>
													</div>
													<!--end::Follower-->
												</div>
												<!--end::Section-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card widget 2-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-sm-6 col-xl-2 mb-xl-10">
										<!--begin::Card widget 2-->
										<div class="card">
											<!--begin::Body-->
											<div class="card-body d-flex justify-content-between align-items-start flex-column">
												<!--begin::Icon-->
												<div class="m-0">
													<img src="{{ asset('assets/media/svg/brand-logos/chat.png') }}" class="w-35px" alt="">
												</div>
												<!--end::Icon-->
												<!--begin::Section-->
												<div class="d-flex flex-column my-7">
													<!--begin::Number-->
													<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ intWithStyle($data->average_comment_count)}}</span>
													<!--end::Number-->
													<!--begin::Follower-->
													<div class="m-0">
														<span class="fw-semibold fs-6 text-gray-400">Average comments</span>
													</div>
													<!--end::Follower-->
												</div>
												<!--end::Section-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card widget 2-->
									</div>
									<!--end::Col-->

									<div class="col-xl-4 mb-5 mb-xl-10">
										<!--begin::Card widget 1-->
										<div class="card card-flush border-0 h-lg-100" data-bs-theme="light" style="background-color: #7239EA;EA; */">
											<!--begin::Header-->
											<div class="card-header pt-2">
												<!--begin::Title-->
												<h3 class="card-title">
													<span class="text-white fs-3 fw-bold me-2">Post Price</span>
													
												</h3>
												<!--end::Title-->
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body d-flex justify-content-between flex-column pt-1 px-0 pb-0">
												<!--begin::Wrapper-->
												<div class="d-flex flex-wrap px-9 mb-5">
													<!--begin::Stat-->
													<div class="rounded min-w-125px py-3 px-4 my-1 me-6" style="border: 1px dashed rgba(255, 255, 255, 0.2)">
														<!--begin::Number-->
														<div class="d-flex align-items-center">
															<div class="text-white fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4368" data-kt-countup-prefix="$" data-kt-initialized="1">${{ intWithStyle($data->amount_from) }}</div>
														</div>
														<!--end::Number-->
														<!--begin::Label-->
														<div class="fw-semibold fs-6 text-white opacity-50">From</div>
														<!--end::Label-->
													</div>
													<!--end::Stat-->
													<!--begin::Stat-->
													<div class="rounded min-w-125px py-3 px-4 my-1" style="border: 1px dashed rgba(255, 255, 255, 0.2)">
														<!--begin::Number-->
														<div class="d-flex align-items-center">
															<div class="text-white fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="120,000" data-kt-initialized="1">${{ intWithStyle($data->amount_to) }}</div>
														</div>
														<!--end::Number-->
														<!--begin::Label-->
														<div class="fw-semibold fs-6 text-white opacity-50">To</div>
														<!--end::Label-->
													</div>
													<!--end::Stat-->
												</div>
												<!--end::Wrapper-->
												<!--begin::Chart-->
												<div id=""><div id="" class="" style="width: 344px;height: 105px;color: white;padding-left: 20px;"><div class="" style="">We use influencer country, followers number, engagement rate and overall audience quality to estimate post price. Please note that the price range shown may not be endorsed by the Influencer.</div></div></div>
												<!--end::Chart-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card widget 1-->
									</div>
								</div>
						</div>
			</div>
		<!--end::Content-->
	</div>
</main>
<!-- Model start -->
	<!--begin::Modal - New Address-->
	<div class="modal fade" id="kt_modal_select_campaigns" tabindex="-1" aria-hidden="true">
	<div class="loading d-none">Loading&#8230;</div>
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Form-->
					<form class="form" id="select_campaign" method="POST">
						@csrf
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
										<input type="hidden" name="send_email" value="{{ isset($email_data->value) ? $email_data->value : $null }}"/>
										<select class="form-control" id="campaign_name" name="campaign_name">
											<option value="">Select Camp</option>
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
										<!-- <input type="hidden" name="send_email" value="{{ isset($email_data->value) ? $email_data->value : $null }}"/> -->
										
											<input type="email" class="form-control form-control-solid" placeholder="" id="email" name="email" value="{{ isset($email_data->value) ? $email_data->value : $null }}" disabled />
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
					email : $('#email').val()
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
});
</script>
@endsection