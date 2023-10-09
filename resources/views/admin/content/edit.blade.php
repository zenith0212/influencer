<div class="modal-header">
    <h2 class="fw-bold">{{ __('Edit Content') }}</h2>
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
    <div class="me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
        <form action="{{ route('content.update', $content->id) }}" method="post" class="edit-content-form mb-0" id="edit-content-form" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="title_en">{{ __('Page Title') }} </label>
                        <input class="form-control form-control-solid" id="title_en" name="title_en" type="text" placeholder="Page title" required value="{{ $content->title_en }}" />
                        @error('title_en')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="keyword_en">{{ __('Meta Keyword') }} </label>
                        <input class="form-control form-control-solid" id="keyword_en" name="keyword_en" type="text" placeholder="Meta Keyword" required value="{{ $content->keyword_en }}"/>
                        @error('keyword_en')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="description_en">{{ __('Descritpion') }} </label>
                        <textarea name="description_en" id="description_en" cols="30" rows="10">
                         {!! $content->description_en !!}
                        </textarea>
                        <input type="hidden" id="description" name="description" />
                        @error('description_en')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>
           
            </div>
            <div class="modal-footer flex-center pb-0">
                <button type="reset" value="submit" class="btn btn-light me-3">
                    <span class="indicator-label">{{ __('Reset') }}</span>
                </button>  
                <button type="submit" name="edit_content" class="btn primary-btn edit_content" id="validation-next">
                    <span class="indicator-label">{{ __('Submit') }}</span>
                    <span class="indicator-progress">{{ __('Wait') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('brand_campaign/vendors/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    ClassicEditor
            .create(document.querySelector('#description_en'))
            .then(editor => {
                completeOfferStatusEditor = editor; 
                console.log(completeOfferStatusEditor)
                editor.setData(getCompleteOfferStatusEditor());
            })
            .catch( error => {
                console.error( error );
            });

    function getCompleteOfferStatusEditor(){
        return completeOfferStatusEditor.getData();
    }

    $('.edit_content').on("click",function(){
        console.log("here");
        console.log(getCompleteOfferStatusEditor());
        $('#description').val(getCompleteOfferStatusEditor());
    })
})
</script>