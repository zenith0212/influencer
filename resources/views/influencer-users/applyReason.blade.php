<style>
    .apply-reason-modal .mw-900px{
            max-width: 420px !important;
    }

    .apply-reason-modal .modal-header .title strong{
        font-size: 18px;
    }

    .apply-reason-modal .form-group input, .form-group textarea{
        outline: none;
    }
</style>
<div class="modal-content">
    <div class="modal-header">
        <div class="title">
            <strong>Add Reason</strong>
        </div>
        <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close">
            <svg fill="#000000" width="20" height="20" version="1.1" id="lni_lni-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
            <path d="M34.5,32L62.2,4.2c0.7-0.7,0.7-1.8,0-2.5c-0.7-0.7-1.8-0.7-2.5,0L32,29.5L4.2,1.8c-0.7-0.7-1.8-0.7-2.5,0
               c-0.7,0.7-0.7,1.8,0,2.5L29.5,32L1.8,59.8c-0.7,0.7-0.7,1.8,0,2.5c0.3,0.3,0.8,0.5,1.2,0.5s0.9-0.2,1.2-0.5L32,34.5l27.7,27.8
               c0.3,0.3,0.8,0.5,1.2,0.5c0.4,0,0.9-0.2,1.2-0.5c0.7-0.7,0.7-1.8,0-2.5L34.5,32z" fill="#fff">
            </path>
            </svg>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ route('apply-reason.store') }}" method="post" class="apply-reason-form" id="apply-reason-form" autocomplete="off">
            @csrf
            <input type="hidden" name="identifier" value="{{ $identifier }}" />
                  @if($identifier == "apply")
                  <div class="form-group ">
                     <input type="hidden" name="apply_reason_id" value="{{$campaign_id}}">
                     <label class="required fs-6 fw-semibold mb-2" for="accept_reason_en">Reason</label>
                        <div class="">
                           <input type="text" placeholder="Add Your Reason" name="accept_reason_en" required />
                        </div>
                  </div>
                  @elseif($identifier == "reject")
                   <div class="form-group ">
                     <input type="hidden" name="apply_reason_id" value="{{$campaign_id}}">
                     <label class="required fs-6 fw-semibold mb-2" for="reject_reason_en">Reason</label>
                        <div class="">
                           <input type="text" placeholder="Add Your Reject Reason" name="reject_reason_en" required />
                        </div>
                        <input type="hidden" name="is_apply" value="0">
                  </div>
                  @else
                  <div class="form-group">
                     <input type="hidden" name="apply_reason_id" value="{{$campaign_id}}">
                     <label class="required fs-6 fw-semibold mb-2" for="apply_reason_en">Reason</label>
                        <div class="">
                           <input type="text" placeholder="Add Your interest Reason" name="apply_reason_en" required />
                        </div>
                  </div>
                  @endif
            <div class="spinner-border text-primary d-none" role="status" id="submit-loader">
              <span class="sr-only">Loading...</span>
            </div>
             <div class="modal-footer justify-content-center">
                 <button type="submit" value="Add" id="validation-next apply-form-btn" class="btn primary-btn mt-4">
                   
                     Add
                 </button>
             </div>
         </div>
        </form>
    </div>
</div>
