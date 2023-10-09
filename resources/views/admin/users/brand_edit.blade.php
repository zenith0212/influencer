<div class="modal-header">
    <h2 class="fw-bold">{{ __('Edit Brand') }}</h2>
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
        <form action="{{ route('brand.update', $brand_details->id) }}" method="post" class="edit-brand-form mb-0" id="edit-brand-form" autocomplete="off" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="title_en">{{ __('Brand Title') }} </label>
                        <input class="form-control form-control-solid" id="title_en" name="title_en" type="text" placeholder="Brand Title" value="{{ $brand_details->title_en }}" />
                        @error('title_en')
                            <p class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="address_en">{{ __('Brand Address') }} </label>
                        <input class="form-control form-control-solid" id="address_en" name="address_en" type="text" placeholder="Address" value="{{ $brand_details->address_en }}" />
                        @error('address')
                            <p class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="work_email">{{ __('Work Email') }} </label>
                        <input class="form-control form-control-solid" id="work_email" name="work_email" type="text" placeholder="Work Email" value="{{ $brand_details->work_email }}" />
                        @error('work_email')
                            <p class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="company_name">{{ __('Company Name') }} </label>
                        <input class="form-control form-control-solid" id="company_name" name="company_name" type="text" placeholder="Company Name" value="{{ $brand_details->company_name }}" />
                        @error('company_name')
                            <p class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7 pe-6 ps-6">
                            <label class="d-block fw-semibold fs-6 mb-5" for="image">{{ __('Brand Logo') }}</label>
                            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px">
                                    
                                    @if($brand_details->logo == null) 
                                    <img class="w-125px h-125px" id="preview-image-before-upload" src="{{ asset('/assets/media/avatars/default_img.png') }}" alt="preview image">
                                    @else
                                    <img class="w-125px h-125px" id="preview-image-before-upload" src="{{ asset('/storage/brandLogo/'.$brand_details->logo) }}" alt="preview image">
                                    @endif
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="image" id="image" value="{{ asset('/storage/brandLogo/'.$brand_details->logo) }}" accept=".png, .jpg, .jpeg" />
                                </label>
                            </div>
                            <div class="form-text">{{ __('categories.allowed_type') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center pb-0">
                <button class="btn primary-btn" id="validation-next" type="submit">
                    <span class="indicator-label">{{ __('categories.update') }}</span>
                    <span class="indicator-progress">{{ __('categories.wait') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </form>
    </div>
</div>

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
 

</script>