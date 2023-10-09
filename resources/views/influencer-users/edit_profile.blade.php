@extends('layouts.index')
@section('content' )
<main class="body-change">
  	<div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
        	<form id="send-verification" method="post" action="{{ route('verification.send') }}">
        		@csrf
        	</form>
        	<div class="card mb-5 mb-xl-10">
        		<div class="card mb-5 mb-xl-10">
        			<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        				<div class="card-title m-0">
        					<h3 class="fw-bold m-0">Profile Details</h3>
        				</div>
        			</div>
        			<div id="kt_account_settings_profile_details" class="collapse show">
        				<form id="edit_profile" class="form" method="post" action="{{ route('influencer_profile.update') }}">
        					@csrf
        					@method('patch')
        					<div class="card-body border-top p-9">
        						<div class="row mb-6">
        							<label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
        							<div class="col-lg-8">
        								<div class="row">
        									<div class="col-lg-6 fv-row">
        										<input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" />
        									</div>
        								</div>
        							</div>
        						</div>
        						<div class="row mb-6">
        							<label class="col-lg-4 col-form-label fw-semibold fs-6">
        								<span class="required">Email</span>
        							</label>
        							<div class="col-lg-4 fv-row">
        								<input type="email" name="email" id="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{$user->email}}" />
        							</div>
        						</div>
        						<div class="row mb-6">
        							<label class="col-lg-4 col-form-label required fw-semibold fs-6">Contact Phone</label>
        							<div class="col-lg-8">
        								<div class="row">
        									<div class="col-lg-6 fv-row">
        										<input type="number" name="phone_no" id="phone_no" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{$user->phone_no}}" />
        									</div>
        								</div>
        							</div>
        						</div>
        					</div>
        				</div>
        				<div class="card-footer d-flex justify-content-end py-6 px-9">
        					<button type="submit" class="primary-btn" id="
        					kt_account_profile_details_submit">Save Changes</button>
        				</div>
        			</form>
        		</div>
        	</div>
        </div>
    </div>
</div>
</main>
@endsection
@section('script')
<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script>
$(document).ready(function(){
    $("#edit_profile").validate({
        rules: {
            'name': {
                required: true
            },
			'email': {
                required: true,
				email :true
            },
			'phone_no': {
                required: true
            },
        },
        messages: {
            'name': {
                required: "Please enter name"
            },
			'email': {
                required: "Please enter email",
				email: "Please enter valid email"
            },
			'phone_no': {
                required: "Please enter phone number"
            },
        },
    });
});
</script>
@endsection