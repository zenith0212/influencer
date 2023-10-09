@include('auth.auth_layout')
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center login_main">
        @include('layouts.window-config')
		<div class="d-flex flex-column flex-root h-100" id="kt_app_root">
			<div class="container h-100">
				<div class="row m-0 h-100 position-relative zindex-1 login_row">
					<div class="col-sm-12 col-md-12 col-lg-6  d-flex flex-lg-row-fluid login_left">
						<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
							<a href="{{route('welcome')}}/">
								<img src="{{asset('assets/images/logo.png')}}" class="mb-9" alt="">
							</a>
							<h1 class="fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
							<div class="login_inner fs-base text-center fw-semibold">In this kind of post,
							<a href="javascript:void(0);" class="opacity-75-hover me-1">the blogger</a>introduces a person they’ve interviewed
							<br />and provides some background information about
							<a href="javascript:void(0);" class="opacity-75-hover me-1">the interviewee</a>and their
							<br />work following this is a transcript of the interview.</div>
							<img class="theme-light-show mx-auto mw-100 w-150px w-lg-600px mb-10 mb-lg-20 d-none d-xl-inline-block" src="https://themesdesign.in/tydek/layouts/images/home-7.png" alt="" />
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-center p-12 login_right">
						<div class="d-flex flex-column flex-center w-md-500px">
							<div class="bg-body rounded-4  d-flex flex-center flex-column align-items-stretch  w-md-400px p-10 rounded-4 login_right_inner">
								<div class="d-flex flex-center flex-column-fluid">
									<div class="mb-4" :status="session('status')"></div>
									<form class="form w-100"  id="login-form"  method="post" action="{!! route('login') !!}">
	                                @csrf
									@method('POST')
										<div class="text-center mb-11">
											<h1 class="text-dark fw-bolder mb-3">Sign In</h1>
										</div>
										<div class="fv-row mb-8">
											<input type="text" placeholder="Email" name="email" id="email" class="form-control bg-transparent" :value="old('email')" required autofocus autocomplete="username"/>
											@error('email')
							                <p class="text-danger mt-2" role="alert">
							                    <strong>{{ $message }}</strong>
							                </p>
							                @enderror
										</div>
										<div class="fv-row mb-3">
											<input type="password" placeholder="Password" name="password" autocomplete="current-password" id="password" :value="__('Password')" class="form-control bg-transparent" />
											@error('password')
							                <p class="text-danger mt-2" role="alert">
							                    <strong>{{ $message }}</strong>
							                </p>
							                @enderror
										</div>
										<div class="forgot_txt d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
	                                    <div></div>
	                                        @if (Route::has('password.request'))
	                                            <a href="{!! route('password.request') !!}">Forgot Password ?</a>
	                                        @endif
										</div>
										<div class="d-grid mb-10">
											<button type="submit" id="" class="btn btn-primary">
												<span class="indicator-label">Sign In</span>
												<span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											</button>
										</div>
										<div class="signup_member text-center fw-semibold fs-6">Not a Member yet?
										<a href="{{route('register')}}">Sign up</a></div>
									</form>
								</div>
								<div class="d-flex flex-stack justify-content-center">
										<button class="btn btn-flex btn-link btn-color-white-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
											<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" />
											<span data-kt-element="current-lang-name" class="me-1 text-dark">English</span>
											<span class="text-dark svg-icon svg-icon-5 svg-icon-muted rotate-180 m-0">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
												</svg>
											</span>
										</button>
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
											<div class="menu-item px-3">
												<a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
													<span class="symbol symbol-20px me-4">
														<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" />
													</span>
													<span data-kt-element="lang-name">English</span>
												</a>
											</div>
											<div class="menu-item px-3">
												<a href="javascript:void(0);" class="menu-link d-flex px-5" data-kt-lang="Spanish">
													<span class="symbol symbol-20px me-4">
														<img data-kt-element="lang-flag" class="rounded-1" src="{{asset('assets/media/flags/spain.svg')}}" alt="" />
													</span>
													<span data-kt-element="lang-name">Spanish</span>
												</a>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('auth.auth_footer')
		<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script>
$(document).ready(function(){
    $("#login-form").validate({
        rules: {
			'email': {
                required: true,
				email :true
            },
			'password': {
                required: true
            },
        },
        messages: {
			'email': {
                required: "Please enter email",
				email: "Please enter valid email"
            },
			'password': {
                required: "Please enter password"
            },
        },
    });
});
</script>