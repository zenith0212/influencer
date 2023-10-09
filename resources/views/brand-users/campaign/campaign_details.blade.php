@extends('layouts.index')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/newstyle.css')}}"> --}}
@section('style')
<style>
   .status.status-completed {
    color: #E6873C;
   }

   .status.status-active {
      color: #00B67F;
   }
   .status.status-inprogress {
      color: #20c997;
   }

   .modal-body .offer-details{
    margin-bottom: 20px;
    font-size: 16px;
    line-height: 1.5;
   }

   .modal-body .offer-details b{
    width: 20%;
    display: inline-block;
   }

   .modal-body .offer-details.email-content b{
    width: 100%;
   }

   .interested-influencers{
      margin-bottom: 20px;
      font-size: 16px;
      line-height: 1.5;
   }

   .interested-influencers b{
       display: inline-block;
   }
   .badge {
        font-size: 14px;
   }

   .modal.add-ratings-modal .modal-dialog {
    max-width: 480px !important;
    }

    i.fas.fa-star.fa-stack-1x.text-yellow {
        color: coral;
    }
    .custom-select-group{
        margin-top: -30px;
        width: auto;
    }
    .custom-select-group .form-select {
        width: auto;
        margin-left: auto;
        margin-bottom: 30px;
    }
    .reiew-text {
    display: inline-block;
    width: 270px;
    white-space: pre-wrap;
    line-height: 1.4;

    }
</style>
@endsection
@section('content')
<main class="campaign-details-main">
   <div class="container-fluid">
      <div class="content">
         <a href="{{ route('campaign_details') }}"><h3>Campaign Details</h3></a>
         <div class="card-container mb-4">
            <div class="row justify-content-between">
               <div class="col-lg-6 col-xxl-5">
                    <div class="campaign-catalog">

                     @if(isset($campaigns->thumbnail_image))
                     <img src="{{ asset('/storage/campaign_images/'.$campaigns->thumbnail_image) }}" alt="">
                     @else
                     <img src="https://dummyimage.com/600x500/000/fff" alt="">
                     @endif
                  </div>
               </div>
               <div class="col-lg-6 col-xxl-6">
                  <div class="campaign-details-content">
                     <div class="d-md-flex justify-content-between align-items-center">
                        <h2>{{$campaigns->name_en}}</h2>
                     </div>
                     <div class="campaign-details">
                        <div class="campaign-details-budget influencers">
                           <h3> {{ $campaigns->total_influencers_required }}</h3>
                           <p>Influencers</p>
                        </div>
                        <div class="campaign-details-budget influencers">
                           <h3> $ {{ $campaigns->budget_for_each_influencer }}</h3>
                           <p>Payable Amount </p>
                        </div>
                        <div class="campaign-details-budget influencers">
                           <h3>{{ date("m/d/Y", strtotime($campaigns->application_start_date)) }} </h3>
                           <p>Starting From</p>
                        </div>
                        <div class="campaign-details-budget influencers">
                           <h3>$ {{ $campaigns->amount }}</h3>
                           <p>Total Amount</p>
                        </div>
                     </div>
                     <div class="campaign-category">
                        <ul class="campaign-category-list">
                           <li>{{ ucfirst($campaigns->target_region) }}</li>
                           <li>{{ ucfirst(@$campaigns->brands->title_en) }}</li>
                           <li>
                                @if($campaigns->campaign_is_active == 1)
                                    <div class="status status-active">Active</div>
                                @elseif($campaigns->application_end_date <  \Carbon\Carbon::today()->toDateString())
                                    <div class="status status-completed">Completed</div>
                                @else
                                    <div class="status status-inprogress">In-progress</div>
                                @endif
                           </li>
                        </ul>
                     </div>
                     <div class="campaign-description">
                        <p>{!! $campaigns->terms_and_condition_en !!}</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-container">
            <div class="campaign-activity">
               <ul class="nav nav-pills" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="pills-category-tab" data-bs-toggle="pill" data-bs-target="#pills-category" type="button" role="tab" aria-controls="pills-category" aria-selected="true">Products</button>
                  </li>
                  <li class="nav-item {{ $role == 'Brand' ? '' : 'd-none' }}" role="presentation">
                     <button class="nav-link" id="pills-features-tab" data-bs-toggle="pill" data-bs-target="#pills-features" type="button" role="tab" aria-controls="pills-features" aria-selected="false">Connected Influencers</button>
                  </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active pills-category" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab">
                    <div class="list-table">
                        @if(count($prodArr)>0)
                        <table id="campaign_connected_products">
                           <thead>
                              <tr>
                                 <th>Product</th>
                                 <th>Category</th>
                                 <th>Price</th>
                                 <th>Status</th>
                                 <th>URL</th>
                                 <th>Sample</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($prodArr as $product)
                              <tr>
                                 <td data-label="Product">
                                    <div class="product">
                                        <img src="{{ !empty($product['thumbnail_image']) ? asset('/storage/products/') .'/'. $product['id'] .'/thumbnails/'. $product['thumbnail_image'] : asset('/assets/media/avatars/default_img.png') }}" alt="product_img" height="50px;" width="50px;">
                                        <p>{{ ucfirst($product['name_en']) }}</p>
                                    </div>
                                </td>
                                 <td data-label="Category">
                                    <div class="category-class">
                                        <span>{{ $product['category'] }}</span> <span>{{ $product['brand'] }}</span>
                                    </div>
                                </td>
                                 <td>
                                    <div>
                                       ${{ $product['price'] }}
                                    </div>
                                 </td>
                                  <td>
                                    <div>
                                        {{ $product['delivery_status'] == 1 ? 'Delivered' : 'Shipped' }}
                                    </div>
                                 </td>
                                  <td>
                                     <div class="category-class">
                                    </div>
                                 </td>
                                  <td>
                                    <div>
                                        {{ $campaigns->is_sample_required == 1 ? 'Yes' : 'No' }}
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <a href="{{ route("brand.campaigns.product_details",[$product['id'],$campaigns['id']])}}" class="primary-btn">View More</a>
                                    </div>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                        @else
                        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                           <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                 <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                                 <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                              </svg>
                           </span>
                           <div class="d-flex flex-stack flex-grow-1">
                              <div class="fw-semibold">
                                 <h4 class="text-gray-900 fw-bold">No product found in this campaign!</h4>
                              </div>
                           </div>
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="tab-pane fade pills-description" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                     <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                        <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                              <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                              <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                           </svg>
                        </span>
                        <div class="d-flex flex-stack flex-grow-1">
                           <div class="fw-semibold">
                              <h4 class="text-gray-900 fw-bold">No product details is connected with this camp!</h4>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade pills-features" id="pills-features" role="tabpanel" aria-labelledby="pills-features-tab">
                    <div class="custom-select-group">
                        <select class="form-select" aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="1">Hired</option>
                        </select>
                    </div>
                    <div class="list-table">
                        @if(@$connected_influencers && count($connected_influencers) > 0)
                            <table class="table" id="connectedInfluencers">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Invitation</th>
                                        <th>Offer</th>
                                        <th>Contract</th>
                                        <th>Payment</th>
                                        <th>Ratings</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($connected_influencers as $influencer)
                                        <tr>
                                            <td data-label="Username">
                                                <div class="product">
                                                    <img src="{{ $influencer['user_profile'] }}" alt="product_img" height="50px;" width="50px;" >
                                                    <p>{{ ucfirst($influencer['user_name']) }}</p>
                                                </div>
                                            </td>
                                            <td data-label="Platform">
                                                <div>
                                                    @if($influencer['invitation_status'] == 0)
                                                        <span class="badge text-bg-secondary">N/A</span>
                                                    @elseif($influencer['invitation_status'] == 1)
                                                        <span class="badge badge-info">Invited</span>
                                                    @elseif($influencer['invitation_status'] == 2)
                                                        <span class="badge badge-success">Interested</span>
                                                    @elseif($influencer['invitation_status'] == 3)
                                                        <span class="badge badge-success">Accepted</span>
                                                    @elseif($influencer['invitation_status'] == 4)
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td data-label="Platform">
                                                <div>
                                                    @if($influencer['offer_status'] == 0)
                                                        <span class="badge text-bg-secondary">N/A</span>
                                                    @elseif($influencer['offer_status'] == 1)
                                                        <span class="badge text-bg-primary">Offer Sent</span>
                                                    @elseif($influencer['offer_status'] == 2)
                                                        <span class="badge text-bg-success">Offer Accepted</span>
                                                    @elseif($influencer['offer_status'] == 3)
                                                        <span class="badge text-bg-danger">Offer Rejected</span>
                                                    @elseif($influencer['offer_status'] == 4)
                                                        <span class="badge text-bg-dark">Offer Negotiated</span>
                                                    @elseif($influencer['offer_status'] == 5)
                                                        <span class="badge text-bg-warning">Offer Resend</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td data-label="Platform">
                                                <div>
                                                    @if($influencer['contract_status'] == 0)
                                                        <span class="badge text-bg-secondary">N/A</span>
                                                    @elseif($influencer['contract_status'] == 1)
                                                        <span class="badge text-bg-success">Hired</span>
                                                    @elseif($influencer['contract_status'] == 2)
                                                        <span class="badge text-bg-warning">Completed By Iinfluecer</span>
                                                    @elseif($influencer['contract_status'] == 3)
                                                        <span class="badge text-bg-info">Completed By Brand</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td data-label="Platform">
                                                <div>
                                                    @if($influencer['payment_status'] == 0)
                                                        <span class="badge text-bg-secondary">N/A</span>
                                                    @elseif($influencer['payment_status'] == 1)
                                                        <span class="badge text-bg-info">Request Payment</span>
                                                    @elseif($influencer['payment_status'] == 2)
                                                        <span class="badge text-bg-danger">Reject Payment Request</span>
                                                    @elseif($influencer['payment_status'] == 3)
                                                        <span class="badge text-bg-warning">Resubmit Payment Request</span>
                                                    @elseif($influencer['payment_status'] == 4)
                                                        <span class="badge text-bg-success">Completed</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td data-label="Platform">
                                              @if($influencer['payment_status'] == 4 && empty($influencer['star_ratings']))
                                               <button type="button" class="primary-btn" id="ratingBtn" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-negotiation_price="{{ $influencer['negotiation_price'] }}" data-user_type="{{ $influencer['user_type'] }}" data-url={{ route('ratings')}}>Ratings</button>
                                              @elseif($influencer['payment_status'] == 4 && !empty($influencer['star_ratings']))
                                                <div class="campaign-actions mb-4">
                                                   @foreach(range(1,5) as $i)
                                                       <span class="fa-stack" style="width:1em">
                                                           <i class="far fa-star fa-stack-1x text-yellow"></i>
                                                           @if($influencer['star_ratings'] >0)
                                                               @if($influencer['star_ratings'] >0.5)
                                                                   <i class="fas fa-star fa-stack-1x text-yellow"></i>
                                                               @else
                                                                   <i class="fas fa-star-half fa-stack-1x text-yellow"></i>
                                                               @endif
                                                           @endif
                                                           @php $influencer['star_ratings']--; @endphp
                                                       </span>
                                                   @endforeach
                                                   <br><span class="reiew-text">{{ucfirst($influencer['rating_type'])}}</span>
                                                </div>
                                            @endif
                                            </td>
                                            <td data-label="Platform">
                                                <div>
                                                    @if($influencer['invitation_status'] == 2 && $influencer['offer_status'] == 0 && $influencer['contract_status'] == 0 && $influencer['payment_status'] == 0)
                                                        <button type="button" class="primary-btn" id="acceptBtn" data-id="{{ $influencer['user_id'] }}" data-connected-influener-id="{{ $influencer['id'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-brand="{{ Auth::user()->name }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-email="{{ $influencer['user_email'] }}" data-each_inf_fees="{{ $influencer['each_inf_fees'] }}" >Accept/Reject</button>
                                                    @elseif($influencer['invitation_status'] == 3 && $influencer['offer_status'] == 0 && $influencer['contract_status'] == 0 && $influencer['payment_status'] == 0)
                                                        <button type="button" class="primary-btn" id="sendBtn" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-start_date="{{ $influencer['start_date'] }}" data-end_date="{{ $influencer['end_date'] }}" data-each_inf_fees="{{ $influencer['each_inf_fees'] }}" data-user_type="{{ $influencer['user_type'] }}">Send Offer</button>
                                                    @elseif($influencer['invitation_status'] == 3 && $influencer['offer_status'] == 4 && $influencer['contract_status'] == 0 && $influencer['payment_status'] == 0)
                                                        <button type="button" class="primary-btn" id="viewOfferBtn" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-start_date="{{ $influencer['start_date'] }}" data-end_date="{{ $influencer['end_date'] }}" data-final_price="{{ $influencer['negotiation_price'] ?? $campaigns->budget_for_each_influencer }}" data-user_type="{{ $influencer['user_type'] }}">View Negotiated Offer</button>
                                                        <button type="button" class="primary-btn" id="resendBtn" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-start_date="{{ $influencer['start_date'] }}" data-end_date="{{ $influencer['end_date'] }}" data-each_inf_fees="{{ $influencer['each_inf_fees'] }}" data-user_type="{{ $influencer['user_type'] }}">Resend Offer</button>
                                                        <button type="button" class="primary-btn" id="resendOfferAcceptBtn" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-user_id="{{ ucfirst($influencer['user_id']) }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-negotiation_price="{{ $influencer['negotiation_price'] ?? $campaigns->budget_for_each_influencer }}" data-user_type="{{ $influencer['user_type'] }}">Accept</button>
                                                    @elseif($influencer['invitation_status'] == 3 && $influencer['offer_status'] == 2 && $influencer['contract_status'] == 2 && $influencer['payment_status'] == 0)
                                                        <button type="button" class="primary-btn" id="commonBtnClick" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-start_date="{{ $influencer['start_date'] }}" data-end_date="{{ $influencer['end_date'] }}" data-final_price="{{ $influencer['negotiation_price'] ?? $campaigns->budget_for_each_influencer }}" data-user_type="{{ $influencer['user_type'] }}" data-status="completed_by_brand">Complete</button>
                                                    @elseif($influencer['invitation_status'] == 3 && $influencer['offer_status'] == 2 && $influencer['contract_status'] == 3 && ($influencer['payment_status'] == 1 || $influencer['payment_status'] == 3))
                                                        <button type="button" class="primary-btn" id="commonBtnClick" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-start_date="{{ $influencer['start_date'] }}" data-end_date="{{ $influencer['end_date'] }}" data-final_price="{{ $influencer['negotiation_price'] ?? $campaigns->budget_for_each_influencer }}" data-user_type="{{ $influencer['user_type'] }}" data-status="reject_payment_request">Reject Payment Request</button>
                                                        <button type="button" class="primary-btn" id="commonBtnClick" data-id="{{ $influencer['id'] }}" data-campaign_id="{{ $influencer['campaign_id'] }}" data-campaign_name="{{ $influencer['campaign_name'] }}" data-name="{{ ucfirst($influencer['user_name']) }}" data-email="{{ $influencer['user_email'] }}" data-start_date="{{ $influencer['start_date'] }}" data-end_date="{{ $influencer['end_date'] }}" data-final_price="{{ $influencer['negotiation_price'] ?? $campaigns->budget_for_each_influencer }}" data-user_type="{{ $influencer['user_type'] }}" data-stripe_customer_id="{{ $influencer['stripe_customer_id'] }}" data-status="paid">Paid</button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                                <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">No influencer is connected with this campaign!</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <footer></footer>
</main>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets_old_dkp/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/jquery-validate.min.js')}}"></script>
<script src="{{ asset('assets_old_dkp/js/ratings.js') }}"></script>
<script src="{{ asset('brand_campaign/vendors/ckeditor/ckeditor.js') }}"></script>

<script>
    let theEditor;
    let resendEditor;
    let resendAcceptEditor;
    let commonEmailStatusEditor;
    var brandName = "{{ @$brand_name }}";
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    $(document).on('click', '#sendBtn', function() {
        var id          = $(this).attr('data-id');
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var startDate   = $(this).attr('data-start_date');
        var endDate     = $(this).attr('data-end_date');
        var eachInfFees = $(this).attr('data-each_inf_fees');
        var userType    = $(this).attr('data-user_type');
        if(userEmail != ""){
            var mailContent =  `<b>\{\{ Influencer Name \}\}</b>,<br/><br/>
                                Congratulations, Please review the offer received from <b>\{\{ Brand Name \}\}</b>.<br/><br/>
                                You have received an offer to work with <b>\{\{ Brand Name \}\}</b> on their campaign <b>\{\{ Campaign Name \}\}</b>.<br/>
                                Please review the short campaign details as attached below.<br/><br/>
                                Campaign Name: <b>\{\{ Campaign Name \}\}</b><br/>
                                Time Frame: <b>\{\{ Time Frame \}\}</b><br/>
                                Fees: <b>\{\{ Fees \}\}</b><br/><br/>
                                Please see the full campaign details using provided URL: <b>\{\{ URL \}\}</b>.<br/><br/>
                                <b>NOTE:</b><br/> If you are member of TopBrandMate then please sign in or sign up with us to view invitation and complete further process.<br/><br/>
                                Once again congratulations!<br/><br/>
                                Thank you!
                            `;
            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Send an Offer to Influencer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="offer-details">
                                <b>Campaign Name: </b>
                                <span>${userName}</span>
                            </div>
                            <div class="offer-details">
                                <b>Campaign Date: </b>
                                <span> ${startDate} - ${endDate} </span>
                            </div>
                            <div class="offer-details">
                                <b>Influencers Fees: </b>
                                <span>$ ${eachInfFees}</span>
                            </div>
                            <br>
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="primary-btn" id="btn_send" onclick="sendOffer(${id}, ${campId}, '${campName}', '${userName}', '${userEmail}', '${startDate}', '${endDate}', '${eachInfFees}', '${brandName}', ${userType})">Send Offer</button>
                        </div>
                    `;
            make_modal('sendEmail', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#email-content' ))
            .then(editor => {
                theEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
        } else {
            error_notification('Email is not available for this user!');
        }
    });

    /* Manage Intertesed Influencer Staus */
    $(document).on('click', '#acceptBtn', function() {
        var id          = $(this).attr('data-id');
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-each_inf_fees');

        var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Accept Or Reject Influencer Request</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="offer-details">
                            Hello <b> ${brnadName},</b>
                        </div>
                        <div class="interested-influencers">
                           <p><b>${userName}</b> has shown interested to join your <b>${campName}</b> campaign.</p>
                        </div>
                        <div class="offer-details">
                           <p>You can check influencer details by clicking on <a type="button" class="btn primary-btn" href="{{ url('brand/guest_influencer_details') }}/${id}" target="_blank">View Profile </a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="rejectRequest(${connectedInfluencer}, '${userEmail}','${campName}','${userName}')">Reject</button>
                        <button type="button" class="btn primary-btn" onclick="acceptRequest(${connectedInfluencer}, '${userEmail}','${campName}','${userName}',${price})">Accept </button>
                    </div>
                `;
        make_modal('acceptRejectRequest', html, true, null);

        ClassicEditor
        .create( document.querySelector( '#email-content' ))
        .then(editor => {
            theEditor = editor;
        })
        .catch( error => {
            console.error( error );
        });
    });

    function getDataFromTheEditor() {
        return theEditor.getData();
    }

    function sendOffer(id, campId, campName, userName, userEmail, startDate, endDate, eachInfFees, brandName, userType) {
        $('#btn_send').html('Sending..').attr('disabled', true);
        $('.loading').show();
        $('.loading').removeClass('d-none');
        if(userEmail != ""){
            $.ajax({
                url: "{{ route('brand.campaign.send_offer') }}",
                type: 'POST',
                dataType: 'json',
                data: { 'id': id, 'campId': campId, 'campName': campName, 'userName': userName, 'userEmail': userEmail, 'startDate': startDate, 'endDate': endDate, 'eachInfFees': eachInfFees, 'brandName': brandName, 'emailContent': getDataFromTheEditor(), 'userType': userType },
                complete: function(response) {
                    $('.loading').hide();
                    let res = response.responseJSON;
                    res.status ? data_insert_notification(res.message) : error_notification_add(res.message);
                    $('.loading').hide();
                    $('#btn_send').html('Send Offer').removeAttr('disabled', true);
                    if(res.status){
                        setInterval(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (response) {
                    $('.loading').hide();
                    $('#btn_send').html('Send Offer').removeAttr('disabled', true);
                    error_notification('Something went wrong!');
                }
            });
        } else {
            $('.loading').hide();
            $('#btn_send').html('Send Offer').removeAttr('disabled', true);
            error_notification('Email is not available for this user!');
        }
    }
    $('#acceptOfferBtn').on('click',function(){
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-each_inf_fees');

        var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Accept Or Reject Influencer Request</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="offer-details">
                            Hello <b> ${userName},</b>
                        </div>
                        <div class="interested-influencers">
                           <p><b>${brnadName}</b> has invited you to join his <b>${campName}</b> campaign.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="RejectOffer(${connectedInfluencer}, '${userEmail}','${campName}','${userName}','${brnadName}')">Reject</button>
                        <button type="button" class="btn primary-btn" onclick="AcceptOffer(${connectedInfluencer}, '${userEmail}','${campName}','${userName}','${brnadName}',${price})">Accept </button>
                    </div>
                `;
        make_modal('acceptRejectOffer', html, true, null);


    })

    function acceptRequest(id,email,campName,UserName,price){
        $url = window.CONFIG.ROUTES.accept_request
        accept_request('Are you sure you want to accept this request?').then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: $url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        email : email,
                        campName : campName,
                        UserName : UserName,
                        Price : price
                    },
                    beforeSend: function() {
                        $('.loading').removeClass('d-none');
                        $('.loading').show();
                     },
                    success: function ( response ) {
                        console.log(response);
                        $('.loading').hide();
                        $('#acceptRejectRequest').hide();
                        if(response.status==true){
                           data_insert_notification(response.message);
                                setInterval(() => {
                                    window.location.href = window.location.href
                                }, 2000);
                        }
                    },
                    error: function ( response ) {
                        error_notification();
                    }
                })
            }
        });
    }

    function rejectRequest(id,email,campName,UserName){
       $('#acceptRejectRequest').hide();
        $url = window.CONFIG.ROUTES.accept_request;
        var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Reject Influencer Request</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="offer-details">
                           <form action="" method="post">
                           @csrf
                              <textarea class="form-control" name="reject_reason" id="reject_reason" placeholder="Reject Reason"></textarea>
                              <div class="modal-footer">
                                    <button type="button" class="btn primary-btn" onclick="RejectConfirmation(${id},'${email}','${campName}','${UserName}')">Reject </button>
                              </div>
                           </form>
                        </div>

                `;
        make_modal('sendEmail', html, true, null);
    }

    function RejectConfirmation(id,email,campName,UserName){
        $url = window.CONFIG.ROUTES.reject_request
        reject_request('Are you sure you want to reject this request?').then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: $url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        email : email,
                        campName : campName,
                        UserName : UserName,
                        Reason   : $('#reject_reason').val()
                    },
                    beforeSend: function() {
                        $('.loading').removeClass('d-none');
                        $('.loading').show();
                    },
                    success: function ( response ) {
                        $('.loading').hide();
                        $('#acceptRejectRequest').hide();
                        if(response.status){
                            data_insert_notification(response.message);
                            setInterval(() => {
                                window.location.href = window.location.href
                            }, 2000);
                        }
                    },
                    error: function ( response ) {
                        error_notification();
                    }
                })
            }
        });
    }

    // Resend offer start here
    $(document).on('click', '#resendBtn', function() {
        var id          = $(this).attr('data-id');
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var startDate   = $(this).attr('data-start_date');
        var endDate     = $(this).attr('data-end_date');
        var eachInfFees = $(this).attr('data-each_inf_fees');
        var userType    = $(this).attr('data-user_type');
        if(userEmail != ""){
            var mailContent =  `<b>\{\{ Influencer Name \}\}</b>,<br/><br/>
                                Following our consideration of your request for a negotiation, the campaign's new price is listed below.<br/><br/>
                                New Price: <b>\{\{ New Price \}\}</b><br/><br/>
                                I sincerely hope you'll review it and accept it.<br/><br/>
                                <b>NOTE:</b><br/> If you are member of TopBrandMate then please sign in or sign up with us to view invitation and complete further process.<br/><br/>
                                Thank you!
                            `;
            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Re-Send an Offer to Influencer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="offer-details">
                                <b>Campaign Name: </b>
                                <span>${campName}</span>
                            </div>
                            <div class="offer-details">
                                <b>Campaign Date: </b>
                                <span> ${startDate} - ${endDate} </span>
                            </div>
                            <div class="offer-details">
                                <b>Resend Offer Price: </b>
                                <span><input type="number" class="form-control mt-2" placeholder="Enter resend offer price" name="resend_price" id="resend_price"></span>
                            </div>
                            <br>
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="resend-email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="primary-btn" id="btn_resend" onclick="resendOffer(${id}, ${campId}, '${campName}', '${userName}', '${userEmail}', ${userType})">Re-Send Offer</button>
                        </div>
                    `;
            make_modal('resendEmail', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#resend-email-content' ))
            .then(editor => {
                resendEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
        } else {
            error_notification('Email is not available for this user!');
        }
    });

    function getResendDataFromTheEditor() {
        return resendEditor.getData();
    }

    function resendOffer(id, campId, campName, userName, userEmail, userType) {
        var resendPrice = $('#resend_price').val();
        if(resendPrice == ""){
            error_notification('Please enter resend offer price!');
            return false;
        }
        $('#btn_resend').html('Sending..').attr('disabled', true);
        $('.loading').show();
        $('.loading').removeClass('d-none');
        if(userEmail != ""){
            $.ajax({
                url: "{{ route('brand.campaign.re_send_offer') }}",
                type: 'POST',
                dataType: 'json',
                data: { 'id': id, 'campId': campId, 'campName': campName, 'userName': userName, 'userEmail': userEmail, 'emailContent': getResendDataFromTheEditor(), 'userType': userType, 'resendPrice': resendPrice  },
                complete: function(response) {
                    $('.loading').hide();
                    let res = response.responseJSON;
                    res.status ? data_insert_notification(res.message) : error_notification_add(res.message);
                    $('#btn_resend').html('Send Offer').removeAttr('disabled', true);
                    if(res.status){
                        setInterval(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (response) {
                    $('.loading').hide();
                    $('#btn_resend').html('Send Offer').removeAttr('disabled', true);
                    error_notification('Something went wrong!');
                }
            });
        } else {
            $('.loading').hide();
            $('#btn_resend').html('Send Offer').removeAttr('disabled', true);
            error_notification('Email is not available for this user!');
        }
    }
    // Resend offer end here

    // Resened offer accpet start here
    $(document).on('click', '#resendOfferAcceptBtn', function() {
        var id                  = $(this).attr('data-id');
        var campId              = $(this).attr('data-campaign_id');
        var campName            = $(this).attr('data-campaign_name');
        var userId              = $(this).attr('data-user_id');
        var userName            = $(this).attr('data-name');
        var userEmail           = $(this).attr('data-email');
        var negotiationPrice    = $(this).attr('data-negotiation_price');
        var userType            = $(this).attr('data-user_type');

        if(userEmail != ""){
            var mailContent =  `<b>\{\{ Influencer Name \}\}</b>,<br/><br/>
                                We have accepted your request for the campaign <b>\{\{ Campaign Name \}\}</b> and below are the final price of it.</b><br/><br/>
                                Final Price: <b>\{\{ Final Price \}\}</b><br/><br/>
                                <b>NOTE:</b><br/> If you are member of TopBrandMate then please sign in or sign up with us to view invitation and complete further process.<br/><br/>
                                Once again congratulations!<br/><br/>
                                Thank you!
                            `;
            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Accept Offer of Influencer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="accept-email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="primary-btn" id="btn_resend" onclick="resendOfferAccept(${id}, ${campId}, '${campName}', ${userId}, '${userName}', '${userEmail}', ${negotiationPrice} ,${userType})">Accept Offer</button>
                        </div>
                    `;
            make_modal('resendEmailAccept', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#accept-email-content' ))
            .then(editor => {
                resendAcceptEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
        } else {
            error_notification('Email is not available for this user!');
        }
    });

    function getResendAcceptDataFromTheEditor() {
        return resendAcceptEditor.getData();
    }

    function resendOfferAccept(id, campId, campName, userId, userName, userEmail, finalPrice, userType) {
        accept_request(`Are you sure you want to accept the price $ ${finalPrice} for this request?`).then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: "{{ route('brand.campaign.re_send_offer_accept') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: { "id": id, "campId" : campId, "campName" : campName, "userId" : userId, "userName" : userName, "userEmail" : userEmail, "finalPrice" : finalPrice, "userType" : userType, 'emailContent': getResendAcceptDataFromTheEditor() },
                    beforeSend: function() {
                        $('.loading').removeClass('d-none');
                        $('.loading').show();
                     },
                    success: function ( response ) {
                        let res = response;
                        $('.loading').hide();
                        res.status ? data_insert_notification(res.message) : error_notification_add(res.message);
                        if(res.status){
                            setInterval(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function ( response ) {
                        $('.loading').hide()
                        error_notification();
                    }
                })
            }
        });
    }
    // Resened offer accpet end here

    // Common button click event after status hired
    $(document).on('click', '#commonBtnClick', function() {
        var id          = $(this).attr('data-id');
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var userType    = $(this).attr('data-user_type');
        var finalPrice  = $(this).attr('data-final_price');
        var status      = $(this).attr('data-status');

        if(userEmail != ""){
            var mailContent = "";
            var modalTitle;
            if(status == "completed_by_brand"){
                mailContent = `<b>\{\{ Influencer Name \}\}</b>,<br/><br/>
                                We have completed the campaign <b>\{\{ Campaign Name \}\}</b> and below are the final price of it.</b><br/><br/>
                                Final Price: <b>\{\{ Final Price \}\}</b><br/><br/>
                                <b>NOTE:</b><br/> If you are member of TopBrandMate then please sign in or sign up with us to view invitation and complete further process.<br/><br/>
                                Once again congratulations!<br/><br/>
                                Thank you!
                            `;
                modalTitle = "Complete by the Brand";
            }else if(status == "reject_payment_request") {
                mailContent = `<b>\{\{ Influencer Name \}\}</b>,<br/><br/>
                                We have rejected your payment request for the campaign <b>\{\{ Campaign Name \}\}</b> and the Price is: <b>\{\{ Final Price \}\}</b><br/><br/>
                                <b>NOTE:</b><br/> If you are member of TopBrandMate then please sign in or sign up with us to view invitation and complete further process.<br/><br/>
                                Thank you!
                            `;
                modalTitle = "Reject payment request";
            }else {
                mailContent = `<b>\{\{ Influencer Name \}\}</b>,<br/><br/>
                                We have paid your payment for the campaign <b>\{\{ Campaign Name \}\}</b> and the Price is: <b>\{\{ Final Price \}\}</b><br/><br/>
                                Thank you for working with us!
                            `;
                modalTitle = "Make payment";
            }
            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">${modalTitle}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="common-email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="primary-btn" id="btn_resend" onclick="commonOfferStatus(${id}, ${campId}, '${campName}', '${userName}', '${userEmail}', ${finalPrice} ,${userType}, '${status}')">Submit</button>
                        </div>
                    `;
            make_modal('commonEmailStatus', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#common-email-content' ))
            .then(editor => {
                commonEmailStatusEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
        } else {
            error_notification('Email is not available for this user!');
        }
    });

    function getCommonStatusEditor() {
        return commonEmailStatusEditor.getData();
    }

    function commonOfferStatus(id, campId, campName, userName, userEmail, finalPrice, userType, status) {
        accept_request(`Are you sure you want to complete this request?`).then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: "{{ route('brand.campaign.manage_common_status') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: { "id": id, "campId" : campId, "campName" : campName, "userName" : userName, "userEmail" : userEmail, "finalPrice" : finalPrice, "userType" : userType, 'emailContent': getCommonStatusEditor(), 'status': status },
                    beforeSend: function() {
                        $('.loading').removeClass('d-none');
                        $('.loading').show();
                     },
                    success: function ( response ) {
                        let res = response;
                        $('.loading').hide();
                        res.status ? data_insert_notification(res.message) : error_notification_add(res.message);
                        if(res.status){
                            setInterval(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function ( response ) {
                        $('.loading').hide()
                        error_notification();
                    }
                })
            }
        });
    }

    $('#campaign_connected_products').DataTable({
        "searching": true,
        "pageLength": 20,
        "lengthChange": false,
        "orderable": true
    });

    $('#viewOfferBtn').on('click',function(){
        var userName    = $(this).attr('data-name');
        var price       = $(this).attr('data-final_price');
        var startDate   = $(this).attr('data-start_date');
        var endDate     = $(this).attr('data-end_date');

        var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Negotiated Offer of Influencer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="offer-details">
                            <b>Influencer Name: </b>
                            <span>${userName}</span>
                        </div>
                        <div class="offer-details">
                            <b>Campaign Date: </b>
                            <span> ${startDate} - ${endDate} </span>
                        </div>
                        <div class="offer-details">
                            <b>Negotiated Price: </b>
                            <span>$ ${price}</span>
                        </div>
                    </div>
                `;
        make_modal('viewResendOfferModal', html, true, null);
   });
</script>
@endsection
