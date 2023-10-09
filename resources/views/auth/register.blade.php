@include('auth.auth_layout')
   <body id="kt_body" class="app-blank bgi-size-cover bgi-position-center login_main">
   @include('layouts.window-config')
   <div class="d-flex flex-column flex-root h-100" id="kt_app_root">
   <div class="container h-100">
      <div class="row m-0 h-100 position-relative zindex-1 login_row">
         <div class="col-sm-12 col-md-12 col-lg-6  d-flex flex-lg-row-fluid login_left">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 justify-content-start pt-lg-20 mt-lg-20">
               <a href="{{route('welcome')}}">
                  <img src="{{asset('assets/images/logo.png')}}" class="mb-9" alt="">
               </a>
               <h1 class="fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
               <div class="login_inner fs-base text-center fw-semibold">In this kind of post,
                  <a href="javascript:void(0);" class="opacity-75-hover me-1">the blogger</a>introduces a person they’ve interviewed
                  <br />and provides some background information about
                  <a href="javascript:void(0);" class="opacity-75-hover me-1">the interviewee</a>and their
                  <br />work following this is a transcript of the interview.
               </div>
               <img class="theme-light-show mx-auto mw-100 w-150px w-lg-600px mb-10 mb-lg-20 d-none d-xl-inline-block" src="https://themesdesign.in/tydek/layouts/images/home-7.png" alt="" />
            </div>
         </div>
         <div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-center p-12 login_right">
            <div class="d-flex flex-column flex-center w-md-500px">
               <div class="bg-body rounded-4  d-flex flex-center flex-column align-items-stretch  w-md-400px p-10 rounded-4 login_right_inner">
                  <div class="mb-4" :status="session('status')"></div>
                  <div class="text-center mb-10">
                     <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                  </div>
                  <ul class="register_tabs nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                     <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4" id="influencers-tab">Influencer</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5" id="brands-tab">Brand</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="kt_tab_pane_4" role="tabpanel">
                        <form class="form w-100" name="influencer_form" id="influencer_form" method="POST" action="{{ route('register',['#influencerform']) }}"  enctype="multipart/form-data" autocomplete="off">
                           @csrf
                           {{-- @method('POST') --}}
                           <div class="fv-row mb-8">
                              <input type="text" placeholder="Name*" name="name" id="name" class="form-control bg-transparent required" value="{{old('name')}}" required />
                              @error('name')
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                              </p>
                              @enderror
                           </div>
                           <input type="hidden" name="role_id" value="Influencer">
                           <div class="fv-row mb-8">
                              <input type="text" placeholder="Email*" name="email" id="email" class="form-control bg-transparent" value="{{old('email')}}" required />
                              @error('email')
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('email') }}</strong>
                              </p>
                              @enderror
                           </div>
                           <div class="fv-row mb-8">
                              <input type="number" placeholder="Phone No.*" name="phone_no" id="phone_no" class="form-control bg-transparent" value="{{old('phone_no')}}" required />
                              @error('phone_no')
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('phone_no') }}</strong>
                              </p>
                              @enderror
                           </div>
                           <div class="fv-row mb-8">
                              <input type="url" placeholder="Tik-Tok URL*" name="social_media_link" id="social_media_link" class="form-control bg-transparent" value="{{old('social_media_link')}}" required />
                              {{-- @error('social_media_link') --}}
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('social_media_link') }}</strong>
                              </p>
                              {{-- @enderror --}}
                           </div>
                           <div class="fv-row mb-8">
                              <input type="file" placeholder="Verification ID*" name="verification_id" id="verification_id" class="form-control bg-transparent" value="{{ old('verification_id') }}" required />
                              {{-- @error('verification_id') --}}
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('verification_id') }}</strong>
                              </p>
                              {{-- @enderror --}}
                           </div>
                           <div class="fv-row mb-8">
                              <input type="password" placeholder="Password*" name="password" id="password" class="form-control bg-transparent" value="{{old('password')}}" required />
                              @error('password')
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('password') }}</strong>
                              </p>
                              @enderror
                           </div>
                           <div class="fv-row mb-8">
                              <input type="password" placeholder="Password Confirmation*" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" class="form-control bg-transparent" required />
                              @error('password_confirmation')
                              <p class="text-danger mt-2" role="alert">
                                 <strong>{{ $errors->first('password_confirmation') }}</strong>
                              </p>
                              @enderror
                           </div>
                           <div class="d-grid mb-10">
                             <button type="submit" id="influencer_form_btn" class="btn btn-primary">
                             <span class="indicator-label">Sign Up</span>
                             <span class="indicator-progress">Please wait...
                             <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                             </button>
                           </div>
                        </form>
                     </div>
                     <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                        <form method="POST" id="brand_form" action="{{ route('register',['#brandform']) }}" autocomplete="off" name="brand_form">
                        @csrf
                        @method('POST')
                        <div class="fv-row mb-8">
                           <input type="text" placeholder="Name*" name="name" id="name" class="form-control bg-transparent" value="{{old('name')}}"/>
                           @error('name')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <input type="hidden" name="role_id" value="Brand">
                        <div class="fv-row mb-8">
                           <input type="email" placeholder="Email*" name="email" id="email" class="form-control bg-transparent" value="{{old('email')}}" />
                           @error('email')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <input type="number" placeholder="Phone No.*" name="phone_no" id="phone_no" class="form-control bg-transparent" value="{{old('phone_no')}}" />
                           @error('phone_no')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('phone_no') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <select name="country" id="country-select" class="form-control bg-transparent" >
                              <option value="{{old('country')}}">Select country</option> 
                              @foreach($getcountrylist as $countries)
                                 <option value="{{$countries->name}}"> {{ $countries->name }} </option>
                              @endforeach 
                           </select>
                           @error('country')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('country') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <input type="email" placeholder="Work Email*" name="work_email" id="work_email" class="form-control bg-transparent" value="{{old('work_email')}}" />
                           @error('work_email')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('work_email') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <input type="text" placeholder="Company Name*" name="company_name" id="company_name" class="form-control bg-transparent" value="{{old('company_name')}}"/>
                           @error('company_name')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('company_name') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <select name="company_scale" id="company-scale" class="form-control bg-transparent" >
                              <option value="{{old('company_scale')}}">Select Scale</option> 
                                 <option value="< 50"> < 50</option>
                                 <option value="50-100"> 50-100 </option>
                                 <option value="101-150"> 101-150 </option>
                                 <option value="150 >"> 150 > </option>
                           </select>
                           @error('company_scale')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('company_scale') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <input type="text" placeholder="Address*" name="address" id="address" class="form-control bg-transparent" value="{{old('address')}}" />
                           @error('address')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('address') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <input type="password" placeholder="Password*" name="password" id="password" class="form-control bg-transparent" value="{{old('password')}}"  required />
                           @error('password')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="fv-row mb-8">
                           <input type="password" placeholder="Password Confirmation*" name="password_confirmation" id="password_confirmation" class="form-control bg-transparent" value="{{old('password_confirmation')}}"  required />
                           @error('password_confirmation')
                           <p class="text-danger mt-2" role="alert">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                           </p>
                           @enderror
                        </div>
                        <div class="d-grid mb-10">
                     <button type="submit" id="brand_form_btn" class="btn btn-primary">
                     <span class="indicator-label">Sign Up</span>
                     <span class="indicator-progress">Please wait...
                     <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                     </button>
                  </div>
                        </form>
                     </div>
                  </div>
                  
                  <div class="signup_member text-center fw-semibold fs-6">Already a Member?
                     <a href="{{route('login')}}">Sign In</a>
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
                           <a href="javascript:void(0);" class="menu-link d-flex px-5" data-kt-lang="English">
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

$( document ).ready(function() {
   let hash = window.location.hash;
   if (window.location.hash) {
      console.log("window.location.hash : " +  hash);
   } else {
      console.log("no  window.location.hash" );
   }

   if(hash == '#brandform') {
      $('#influencers-tab').removeClass('active');
      $('#kt_tab_pane_4').removeClass('active show');
      $('#brands-tab').addClass('active');
      $('#kt_tab_pane_5').addClass('active show');
   }

   if(hash == '#influencerform') {
   $('#influencers-tab').addClass('active');
   $('#kt_tab_pane_4').addClass('active show');
   $('#brands-tab').removeClass('active');
   $('#kt_tab_pane_5').removeClass('active show');
}
});





$('#brand_form_btn').on('click', function() {
     $("#brand_form").validate({
        rules: {
            'country': {
                required: true
            },
            'work_email': {
                required: true,
                email:true
            },
            'company_name': {
                required: true
            },
            'main_business': {
                required: true
            },
            'product_category': {
                required: true
            },
            'company_scale': {
                required: true
            },
            'name': {
                required: true
            },
             'address': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'phone_no': {
                required: true,
                digits: true,
               
            },
            'password': {
                required: true
            },
            'password_confirmation': {
                required: true,
                // equalTo: "#password"
            }
        },
        messages: {
            'country': {
                required: "Please select country"
            },
            'work_email': {
                required: "Please enter work email",
                email: "Please enter valid email"
            },
            'company_name': {
                required: "Please enter company name"
            },
            'name': {
                required: "Please enter name"
            },
             'address': {
                required: "Please enter address"
            },
            'email': {
                required: "Please enter email",
                email: "Please enter valid email",
            },
            'phone_no': {
                required: "Please enter phone number",
                digits: "Please enter only digits",
               
            },
            'password': {
                required: "Please enter password",
            },
            'company_scale': {
                required: "Please enter company scale",
            },
           'password_confirmation' :{
               required: "Please enter confirm password",
               equalTo: "The password field confirmation does not match."
           } 
        },
        errorPlacement: function(error, element) {
            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                } else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            else if ( element.parent('div').hasClass('custom-checkbox') ) {
                error.appendTo( element.parent().parent().parent().parent() );
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) { // <- pass 'form' argument in
            $("#brand_form_btn").attr("disabled", true);
            form.submit(); 
        }

    });
});

  
$('#influencer_form_btn').on('click', function() {
     $("#influencer_form").validate({
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'verification_id': {
                required: true,
                extension: "jpg,jpeg,png"
            },
            'social_media_link': {
                required: true
            },
            'password': {
                required: true
            },
            'password_confirmation': {
                required: true,
                // equalTo: "#password"
            },
            'phone_no': {
                required: true,
                digits: true,
                
            }
        },
        messages: {
           'password_confirmation' :{
            equalTo: "The password field confirmation does not match."
           } 
        },
        errorPlacement: function(error, element) {
            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                } else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            else if ( element.parent('div').hasClass('custom-checkbox') ) {
                error.appendTo( element.parent().parent().parent().parent() );
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) { // <- pass 'form' argument in
            $("#influencer_form_btn").attr("disabled", true);
            form.submit(); 
        }
    });
}); 

    $('#kt_tab_pane_4').on('click', function(){
        $('#brand_form')[0].reset();
   
    });

    $('#kt_tab_pane_5').on('click', function(){
        $('#influencer_form')[0].reset();
   
    });

 
</script>