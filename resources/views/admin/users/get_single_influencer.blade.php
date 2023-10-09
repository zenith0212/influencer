@extends('layouts.admin.app')

@section('content')

<div class="d-flex flex-column flex-column-fluid">
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
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('influencers') }}">Back</a>
					</li>
					<!--end::Item-->
					
					
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<!--end::Actions-->
		</div>
		<!--end::Toolbar container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Layout-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Sidebar-->
				<div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
					<!--begin::Card-->
					<div class="card mb-5 mb-xl-8">
						<!--begin::Card body-->
						<div class="card-body">
							<!--begin::Summary-->
							<!--begin::User Info-->
							<div class="d-flex flex-center flex-column py-5">
								<!--begin::Avatar-->
								<div class="symbol symbol-100px symbol-circle mb-7">
									<img src="{{ $data->media_profile }}" alt="image">
								</div>
								<!--end::Avatar-->
								<!--begin::Name-->
								<a href="javascript:void(0);" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $data->nickname }}</a>
								<!--end::Name-->
								
								<!--begin::Info-->
								<!--begin::Info heading-->
								<div class="fw-bold mb-3">Analytics
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week." data-kt-initialized="1"></i></div>
								<!--end::Info heading-->
								<div class="d-flex flex-wrap flex-center">
									<!--begin::Stats-->
									<div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
										<div class="fs-4 fw-bold text-gray-700">
											<span class="w-75px">{{ intWithStyle($data->follower_count) }}</span>
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
											<span class="svg-icon svg-icon-3 svg-icon-success">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
													<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</div>
										<div class="fw-semibold text-muted">Followers</div>
									</div>
									<!--end::Stats-->
									<!--begin::Stats-->
									<div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
										<div class="fs-4 fw-bold text-gray-700">
											<span class="w-50px">{{ intWithStyle($data->following_count) }}</span>
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
											<span class="svg-icon svg-icon-3 svg-icon-danger">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
													<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</div>
										<div class="fw-semibold text-muted">Following</div>
									</div>
									<!--end::Stats-->
									
								</div>
								<!--end::Info-->
							</div>
							<!--end::User Info-->
							<!--end::Summary-->
							<!--begin::Details toggle-->
							<div class="d-flex flex-stack fs-4 py-3">
								<div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
								<span class="ms-2 rotate-180">
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
									<span class="svg-icon svg-icon-3">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
										</svg>
									</span>
									<!--end::Svg Icon-->
								</span></div>
								
							</div>
							<!--end::Details toggle-->
							<div class="separator"></div>
							<!--begin::Details content-->
							<div id="kt_user_view_details" class="collapse show">
								<div class="pb-5 fs-6">
									<!--begin::Details item-->
									<div class="fw-bold mt-5">Account ID</div>
									<div class="text-gray-600">{{ $data->unique_id }}</div>
									<!--begin::Details item-->
									<!--begin::Details item-->
									<div class="fw-bold mt-5">Email</div>
									<div class="text-gray-600">
									
										<a href="javascript:void(0);" class="text-gray-600 text-hover-primary ">{{ isset($data->email) ? $data->email : 'N/A' }}</a>
									</div>
									<!--begin::Details item-->
									<!--begin::Details item-->
									<div class="fw-bold mt-5">Signature</div>
									
									<div class="text-gray-600">{{ isset($data->signature) ? $data->signature : "null" }}</div>
									<!--begin::Details item-->
									<!--begin::Details item-->
									<div class="fw-bold mt-5">Country</div>
									<div class="text-gray-600">{{ $data->country }}</div>
									<!--begin::Details item-->
									<!--begin::Details item-->
									<div class="fw-bold mt-5">Account URL</div>
									<div class="text-gray-600"><a href='{{ $data->account_url }}' target="_blank">{{ $data->account_url }}</div></a>
									<!--begin::Details item-->
								</div>
							</div>
							<!--end::Details content-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->

					
					
				</div>
				<!--end::Sidebar-->
				<!--begin::Content-->
				<div class="flex-lg-row-fluid ms-lg-15">
					<!--begin:::Tab content-->
					<div class="tab-content" id="myTabContent">
						<!--begin:::Tab pane-->
						<div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
							<!--begin::Card-->
							<div class="card card-flush mb-6 mb-xl-9">
								<!--begin::Card header-->
								<div class="card-header mt-6">
									<!--begin::Card title-->
									<div class="card-title flex-column">
										<h2 class="mb-1">Campaign Schedule</h2>
										<div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div>
									</div>
									<!--end::Card title-->
									<!--begin::Card toolbar-->
									<div class="card-toolbar">
										<button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
										<!--SVG file not found: media/icons/duotune/art/art008.svg-->
										Add Schedule</button>
									</div>
									<!--end::Card toolbar-->
								</div>
								<!--end::Card header-->
								<!--begin::Card body-->
								<div class="card-body p-9 pt-4">
									<!--begin::Dates-->
									<ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2" role="tablist">
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_0" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Su</span>
												<span class="fs-6 fw-bolder">21</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary active" data-bs-toggle="tab" href="#kt_schedule_day_1" aria-selected="true" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Mo</span>
												<span class="fs-6 fw-bolder">22</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_2" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Tu</span>
												<span class="fs-6 fw-bolder">23</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_3" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">We</span>
												<span class="fs-6 fw-bolder">24</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_4" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Th</span>
												<span class="fs-6 fw-bolder">25</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_5" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Fr</span>
												<span class="fs-6 fw-bolder">26</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_6" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Sa</span>
												<span class="fs-6 fw-bolder">27</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_7" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Su</span>
												<span class="fs-6 fw-bolder">28</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_8" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Mo</span>
												<span class="fs-6 fw-bolder">29</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_9" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">Tu</span>
												<span class="fs-6 fw-bolder">30</span>
											</a>
										</li>
										<!--end::Date-->
										<!--begin::Date-->
										<li class="nav-item me-1" role="presentation">
											<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_10" aria-selected="false" tabindex="-1" role="tab">
												<span class="opacity-50 fs-7 fw-semibold">We</span>
												<span class="fs-6 fw-bolder">31</span>
											</a>
										</li>
										<!--end::Date-->
									</ul>
									<!--end::Dates-->
									<!--begin::Tab Content-->
									<div class="tab-content">
										<!--begin::Day-->
										<div id="kt_schedule_day_0" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Kendell Trevor</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">14:30 - 15:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Yannis Gloverson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Mark Randall</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Kendell Trevor</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_1" class="tab-pane fade show active" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Caleb Donaldson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Kendell Trevor</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">14:30 - 15:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Caleb Donaldson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_2" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">9:00 - 10:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review &amp; Testing</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Bob Harris</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Mark Randall</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">13:00 - 14:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Walter White</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_3" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">13:00 - 14:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">David Stevenson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Sean Bean</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">David Stevenson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">13:00 - 14:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Naomi Hayabusa</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_4" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Mark Randall</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Yannis Gloverson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Karina Clarke</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_5" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">9:00 - 10:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Kendell Trevor</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Yannis Gloverson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review &amp; Testing</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Mark Randall</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_6" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">9:00 - 10:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">David Stevenson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Bob Harris</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">10:00 - 11:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Walter White</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Walter White</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">David Stevenson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_7" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Bob Harris</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Sean Bean</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">David Stevenson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">10:00 - 11:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review &amp; Testing</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Terry Robins</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_8" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">9:00 - 10:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Walter White</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">14:30 - 15:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Mark Randall</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Naomi Hayabusa</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Walter White</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">10:00 - 11:00
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Michael Walters</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_9" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">13:00 - 14:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Peter Marcus</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review &amp; Testing</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Bob Harris</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Mark Randall</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">11:00 - 11:45
													<span class="fs-7 text-muted text-uppercase">am</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">David Stevenson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
										<!--begin::Day-->
										<div id="kt_schedule_day_10" class="tab-pane fade show" role="tabpanel">
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">14:30 - 15:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Yannis Gloverson</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">16:30 - 17:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Sean Bean</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">12:00 - 13:00
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Project Review &amp; Testing</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Peter Marcus</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
											<!--begin::Time-->
											<div class="d-flex flex-stack position-relative mt-6">
												<!--begin::Bar-->
												<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
												<!--end::Bar-->
												<!--begin::Info-->
												<div class="fw-semibold ms-5">
													<!--begin::Time-->
													<div class="fs-7 mb-1">14:30 - 15:30
													<span class="fs-7 text-muted text-uppercase">pm</span></div>
													<!--end::Time-->
													<!--begin::Title-->
													<a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
													<!--end::Title-->
													<!--begin::User-->
													<div class="fs-7 text-muted">Lead by
													<a href="#">Walter White</a></div>
													<!--end::User-->
												</div>
												<!--end::Info-->
												<!--begin::Action-->
												<a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
												<!--end::Action-->
											</div>
											<!--end::Time-->
										</div>
										<!--end::Day-->
									</div>
									<!--end::Tab Content-->
								</div>
								<!--end::Card body-->
							</div>
							<!--end::Card-->
							
							<div class="row g-5 g-xl-8">
								<div class="col-xl-3">
									<!--begin::Statistics Widget 5-->
									<a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
											<span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor"></rect>
													<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor"></rect>
													<rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor"></rect>
													<rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor"></rect>
												</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ intWithStyle($data->post_count) }}</div>
											<div class="fw-semibold text-gray-400">Total Post</div>
										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>
								<div class="col-xl-3">
									<!--begin::Statistics Widget 5-->
									<a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
											<span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path>
													<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path>
													<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ intWithStyle($data->average_like_count) }}</div>
											<div class="fw-semibold text-gray-100">Likes Count</div>
										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>
								<div class="col-xl-3">
									<!--begin::Statistics Widget 5-->
									<a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
											<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor"></path>
													<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-white fw-bold fs-2 mb-2 mt-5">{{ intWithStyle($data->average_engagement_rate) }}%</div>
											<div class="fw-semibold text-white">Engement Rate</div>
										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>
								<div class="col-xl-3">
									<!--begin::Statistics Widget 5-->
									<a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
											<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
													<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-white fw-bold fs-2 mb-2 mt-5">{{
												intWithStyle($data->average_play_count) }}</div>
											<div class="fw-semibold text-white">Play Video Count</div>
										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>
							</div>   
						</div>
						<!--end:::Tab pane-->
						
					</div>
					<!--end:::Tab content-->
				</div>
				<!--end::Content-->

				
			</div>

			</div>
			<!--end::Modal - Add schedule-->
		
		
			<!--end::Modals-->
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
</div>
					
@endsection
