<div class="modal-header">
    <h2 class="fw-bold">{{ __('Create Brand') }}</h2>
    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_customer_close" data-bs-dismiss="modal" aria-label="Close">
    <span class="svg-icon svg-icon-1">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
        </svg>
    </span>
    </button>
</div>
<div class="modal-body py-10 px-lg-17">
    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
        <form action="{{ route('register') }}" method="POST" class="create-brand-form mb-0" id="create-brand-form"  enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="role_id" value="Brand">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="name">{{ __('Brand Title') }} </label>
                        <input class="form-control form-control-solid" name="name" id="name"  type="text" placeholder="Brand Title" />
                       
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="email">{{ __('Email') }} </label>
                        <input class="form-control form-control-solid" name="email" id="email" type="text" placeholder="Email" />
                      
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="password">{{ __('Password') }} </label>
                        <input class="form-control form-control-solid" name="password" id="password" type="password" placeholder="Password"  />
                       
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="phone_no">{{ __('Phone no') }} </label>
                        <input class="form-control form-control-solid" nname="phone_no" id="phone_no"  type="text" placeholder="Address" />
                       
                    </div>

                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="email">{{ __('Country') }} </label>
                        <select name="country" id="country-select" class="form-control bg-transparent" >
                              <option value="{{old('country')}}">Select country</option> 
                              @foreach($getcountrylist as $countries)
                                 <option value="{{$countries->name}}"> {{ $countries->name }} </option>
                              @endforeach 
                        </select>
                     
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="work_email">{{ __('Work Email') }} </label>
                        <input class="form-control form-control-solid" id="work_email" name="work_email" type="text" placeholder="Work Email"  />
                       
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="company_name">{{ __('Company Name') }} </label>
                        <input class="form-control form-control-solid" id="company_name" name="company_name" type="text" placeholder="Company Name"  />
                      
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="address">{{ __('Address') }} </label>
                        <input class="form-control form-control-solid" name="address" id="address" type="text" placeholder="Address"  />
                    
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="work_email">{{ __('Company Scale') }} </label>
                        <select name="company_scale" id="company-scale" class="form-control bg-transparent" >
                              <option value="{{old('company_scale')}}">Select Scale</option> 
                                 <option value="< 50"> < 50</option>
                                 <option value="50-100"> 50-100 </option>
                                 <option value="101-150"> 101-150 </option>
                                 <option value="150 >"> 150 > </option>
                        </select>
                      
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7 pe-6 ps-6">
                            <label class="d-block fw-semibold fs-6 mb-5" for="image">{{ __('Brand Logo') }}</label>
                            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px">
                                    <img class="w-125px h-125px" id="preview-image-before-upload" src="" alt="preview image">
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="image" id="image"  accept=".png, .jpg, .jpeg" />
                                </label>
                            </div>
                            <div class="form-text">{{ __('categories.allowed_type') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center pb-0">
                <button class="btn btn-primary" id="validation-next" type="submit">
                    <span class="indicator-label">{{ __('categories.create') }}</span>
                    <span class="indicator-progress">{{ __('categories.wait') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script type="text/javascript">
      
$(document).ready(function (e) {
    $('#image').change(function(){
    
    let reader = new FileReader();

    reader.onload = (e) => { 
 
      $('#preview-image-before-upload').attr('src', e.target.result); 
    }
 
    reader.readAsDataURL(this.files[0]); 
   
   });
   
});
 
$('#create-brand-form').on('click', function() {
     $("#create-brand-form").validate({
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


</script>