	<!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                 
                    <!--begin::details View-->

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <!--begin::Sign-in Method-->
                        <div class="card mb-5 mb-xl-10">
                         
                            <!--begin::Basic info-->
									<div class="card mb-5 mb-xl-10">
										<!--begin::Card header-->
										<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
											<!--begin::Card title-->
											<div class="card-title m-0">
												<h3 class="fw-bold m-0">Profile Details</h3>
											</div>
											<!--end::Card title-->
										</div>
										<!--begin::Card header-->
										<!--begin::Content-->
										<div id="kt_account_settings_profile_details" class="collapse show">
											<!--begin::Form-->
											<form id="kt_account_profile_details_form" class="form" method="post" action="{{ route('profile.update') }}">
                                                @csrf
                                                @method('patch')
                                                <!--begin::Card body-->
												<div class="card-body border-top p-9">
													<!--begin::Input group-->
											
													<div class="row mb-6">
														<label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
														<div class="col-lg-8">
															<!--begin::Row-->
															<div class="row">
																<!--begin::Col-->
																<div class="col-lg-6 fv-row">
																	<input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" />
																</div>
																<!--end::Col-->
															
															</div>
															<!--end::Row-->
														</div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
                                                    <div class="row mb-6">
														<!--begin::Label-->
														<label class="col-lg-4 col-form-label fw-semibold fs-6">
															<span class="required">Email</span>
														</label>
														<!--end::Label-->
														<!--begin::Col-->
														<div class="col-lg-4 fv-row">
															<input type="email" name="email" id="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{$user->email}}" />
														</div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->
													<div class="row mb-6">
														<label class="col-lg-4 col-form-label required fw-semibold fs-6">Contact Phone</label>
														<div class="col-lg-8">
															<!--begin::Row-->
															<div class="row">
																<!--begin::Col-->
																<div class="col-lg-6 fv-row">
                                                                    <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{$user->phone_no}}" />
																</div>
																<!--end::Col-->
															
															</div>
															<!--end::Row-->
														</div>
														<!--end::Col-->
												</div>
												</div>
                                            
												</div>
												<!--end::Card body-->
												<!--begin::Actions-->
												<div class="card-footer d-flex justify-content-end py-6 px-9">
													<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
													<button type="submit" class="btn primary-btn" id="kt_account_profile_details_submit">Save Changes</button>
												</div>
												<!--end::Actions-->
											</form>
											<!--end::Form-->
										</div>
										<!--end::Content-->
									</div>
									<!--end::Basic info-->
                        </div>
                        <!--end::Sign-in Method-->
                    <!--end::details View-->
                    
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->