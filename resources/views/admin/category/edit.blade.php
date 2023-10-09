<div class="modal-header">
    <h2 class="fw-bold">{{ __('categories.edit_category') }}</h2>
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
        <form action="{{ route('categories.update', $category->id) }}" method="post" class="edit-categories-form mb-0" id="edit-categories-form" autocomplete="off" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="name_en">{{ __('categories.name') }} </label>
                        <input class="form-control form-control-solid" id="name_en" name="name_en" type="text" placeholder="Category Name" value="{{ $category->name_en }}" />
                        @error('name_en')
                            <p class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="description_en">{{ __('categories.description') }} </label>
                        <input class="form-control form-control-solid" id="description_en" name="description_en" type="text" placeholder="Description" value="{{ $category->description_en }}" />
                        @error('description_en')
                            <p class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7 pe-6 ps-6">
                            <label class="d-block fw-semibold fs-6 mb-5" for="image">{{ __('categories.image') }}</label>
                            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px">
                                    <img class="w-125px h-125px" id="preview-image-before-upload" src="{{ url('storage/app/public/categoriesUploads/'.$category->image) }}" alt="preview image">
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="image" id="image" value="{{ url('/storage/categoriesUploads/'.$category->image) }}" accept=".png, .jpg, .jpeg" />
                                </label>
                            </div>
                            <div class="form-text">{{ __('categories.allowed_type') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center pb-0">
                <button class="btn btn-primary" id="validation-next" type="submit">
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