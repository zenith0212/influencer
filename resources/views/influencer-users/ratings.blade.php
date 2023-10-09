<style>

.star-ratings {
    float: left;
   
}

/*.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}*/
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

</style>

<div class="modal-header">
    <h2 class="fw-bold">Add Ratings</h2>
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
        <form action="{{ route('campaign-ratingsStore') }}" method="post" class="add_ratings_form mb-0" id="add_ratings_form" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2 star-ratings" for="star_ratings"> Ratings </label>
                        <input type="hidden" name="userType" value="{{ Request::get('userType') }}">
                        <input type="hidden" name="influencer_id" value="{{ Request::get('id') }}">
                        <input type="hidden" name="campaign_id" value="{{ Request::get('campId') }}">
                        <input type="hidden" name="brand_id" value="{{ Request::get('brand_id') }}">

                        <div class="rate">
                            <input type="radio" id="star5" name="star_ratings" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="star_ratings" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="star_ratings" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="star_ratings" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="star_ratings" value="1" />
                            <label for="star1" title="text">1 star</label>
                          </div>
                        @error('start')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2 float-left pt-12" for="review_en"> Review </label>
                        <textarea id="review_en" class="form-control" name="review_en" placeholder="Your Reviews" required></textarea>
                        @error('review_en')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                          <input type="checkbox" id="quick_reply" name="rating_type[]" value="Quick reply">
                          <label for="quick_reply"> Quick reply</label><br>
                          <input type="checkbox" id="credibility" name="rating_type[]" value="Credibility">
                          <label for="credibility"> Credibility</label><br>
                          <input type="checkbox" id="complint_with_contract" name="rating_type[]" value="Compliant with contract">
                          <label for="complint_with_contract"> Compliant with contract</label><br>
                          <input type="checkbox" id="content_quality" name="rating_type[]" value="Content quality">
                          <label for="content_quality"> Content quality</label><br><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center pb-0">
                <button type="reset" value="submit" class="primary-btn me-3">
                    <span class="indicator-label">Reset</span>
                </button>  
                <button type="submit" name="add_rating" class="primary-btn" id="validation-next">
                    <span class="indicator-label">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{asset('assets_old_dkp/js/campaigns.js')}}"></script>