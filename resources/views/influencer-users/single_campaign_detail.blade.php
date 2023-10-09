@extends('layouts.index')
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

/*    div#campaign-connected-products_filter {
    margin-left: 836px;
}*/

    .campaign-actions-ratings.mb-4 {
    float: right;
}
</style>
{{-- <link rel="stylesheet" href="{{ asset('assets/css/newstyle.css')}}"> --}}
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
                        <h2>{{$campaigns->name_en}} </h2>
                        @if($campaigns->application_end_date != null)
                            @if($campaigns->application_end_date <  \Carbon\Carbon::today()->toDateString())
                                <div class="campaign-actions mb-4">
                                    <span class="badge badge-danger">Application date has been expired</span>
                                </div>
                            @endif
                        @else
                                <div class="campaign-actions mb-4">
                                    <span class="badge badge-info">Ongoing Campaign</span>
                                </div>
                        @endif
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
                     @if($campaigns->is_apply == "")
                            @if($campaigns->is_requested == 1)
                                <div class="campaign-actions mb-4">
                                    <a href="javascript:void(0)" data-url="{{ route('apply-reason.create') }}" class="primary-btn" data-bs-toggle="addmodal" data-bs-target="#myAddModal" id="apply-btn" data-id="{{ $campaigns->id }}" data-identifier="apply"><span>Accept It</span></a>
                                    <a href="javascript:void(0)" data-url="{{ route('apply-reason.create') }}" class="outline-primary-button" data-bs-toggle="addmodal" data-bs-target="#myAddModal" id="apply-btn" data-id="{{ $campaigns->id }}" data-identifier="reject"><span>Reject It</span></a>
                                </div>
                            @endif
                     @elseif($campaigns->is_apply == 1)
                            <div class="campaign-actions mb-4">
                                <button class="primary-btn"> Accepted </button>
                            </div>
                     @elseif($campaigns->is_apply == 2)
                        <div class="campaign-actions mb-4">
                            <button class="primary-btn"> Rejected </button>
                        </div>
                     @endif
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
                     <div class="campaign-actions mb-4" style="display: inline-block;">
                     @if(!empty($connected_influencer_status))
                     {{-- @dd("kjkd"); --}}
                        <!-- Manage invite staus start -->
                        @if($connected_influencer_status->invitation_status == 1 && $connected_influencer_status->offer_status == 0 && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0 )
                            <div class="campaign-actions mb-4">
                                <b>Current Status : </b> &nbsp;
                                        <span class="badge badge-success">Invited By Brand</span> &nbsp;
                                <br/><br/>
                                <a href="javascript:void(0)" data-url="{{ route('apply-reason.create') }}" class="primary-btn" data-bs-toggle="addmodal" data-bs-target="#myAddModal" id="apply-btn" data-id="{{ $campaigns->id }}" data-identifier="direct-apply"><span>Interested</span></a>

                            </div>
                        @elseif($connected_influencer_status->invitation_status == 2 && $connected_influencer_status->offer_status == 0 && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-success">Shown interest</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 0 &&  $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-info">Accepted</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 4 && $connected_influencer_status->offer_status == 0 && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-danger">Rejected</span>
                            </div>
                        @endif
                        <!-- Manage invite staus end -->

                        <!-- Manage offer status start -->
                        @if($connected_influencer_status->invitation_status == 3 && ($connected_influencer_status->offer_status == 1 || $connected_influencer_status->offer_status == 5 ) && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <button type="button" class="primary-btn" id="acceptOfferBtn" data-id="{{ ucfirst(@$campaigns->brands->id) }}" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}"  data-start_date="{{ $campaigns['application_start_date'] }}" data-end_date="{{ $campaigns['application_till_date'] }}" data-price="{{ $connected_influencer_status['negotiation_price'] }}">Accept</button>

                            <button type="button" class="primary-btn" id="rejectOfferBtn" data-id="" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}" data-each_inf_fees="{{ $campaigns['budget_for_each_influencer'] }}">Reject</button>

                            <button type="button" class="primary-btn" id="negociateOfferBtn" data-id="" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}" data-start_date="{{ $campaigns['application_start_date'] }}" data-end_date="{{ $campaigns['application_till_date'] }}" data-price="${{ $connected_influencer_status['negotiation_price'] }}">Negotiate</button>

                            <button type="button" class="primary-btn" id="viewOfferBtn" data-id="" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}" data-start_date="{{ $campaigns['application_start_date'] }}" data-end_date="{{ $campaigns['application_till_date'] }}" data-price="${{ $connected_influencer_status['negotiation_price'] }}">View Offer</button>

                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-info">Offer Accepted</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 3 && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-danger">Offer Rejected</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 4 && $connected_influencer_status->contract_status == 0 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-dark">Offer Negotiated</span>
                            </div>
                        @endif
                        <!-- Manage offer status end -->

                        <!-- Manage contract offter status start -->
                        @if($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 1 && $connected_influencer_status->payment_status == 0 )
                            <div class="campaign-actions mb-4">
                                <b>Current Status : </b> &nbsp;
                                        <span class="badge badge-warning">In Progress</span>
                                <br/><br/>
                                <button type="button" class="primary-btn" id="completeOfferBtn" data-id="" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}" data-each_inf_fees="{{ $campaigns['budget_for_each_influencer'] }}">Complete Campaign</button>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 2 && $connected_influencer_status->payment_status == 0)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-dark">Waiting for brand completion</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 3 && $connected_influencer_status->payment_status == 0)
                            <button type="button" class="primary-btn" id="paymentRequestBtn" data-id="" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}" data-each_inf_fees="{{ $connected_influencer_status['negotiation_price'] }}" data-status="Payment Request">Payment Request</button>
                        @endif
                        <!-- Manage contract offter status end -->

                        <!-- Manage payment offer status start -->
                        @if($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 3 && $connected_influencer_status->payment_status == 1 )
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-primary">Payment request sent</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 3 && $connected_influencer_status->payment_status == 2)

                            <button type="button" class="primary-btn" id="paymentRequestBtn" data-id="" data-connected-influener-id="{{ $connected_influencer_status->id }}" data-name="{{ Auth::user()->name }}" data-brand="{{ ucfirst(@$campaigns->brands->title_en) }}" data-campaign_id="{{ $campaigns->id }}" data-campaign_name="{{ $campaigns->name_en }}" data-email="{{ ucfirst(@$campaigns->brands->work_email) }}" data-each_inf_fees="{{ $connected_influencer_status['negotiation_price'] }}" data-status="Resubmit Payment Request">Resubmit Payment Request</button>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 3 && $connected_influencer_status->payment_status == 3)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-primary">Resubmit payment request sent</span>
                            </div>
                        @elseif($connected_influencer_status->invitation_status == 3 && $connected_influencer_status->offer_status == 2 && $connected_influencer_status->contract_status == 3 && $connected_influencer_status->payment_status == 4)
                            <div class="campaign-actions mb-4">
                                <span class="badge badge-success">Contract Completed</span>
                            </div>
                        @endif

                        <!-- Manage payment offer status end -->
                    @else
                        <a href="javascript:void(0)" data-url="{{ route('apply-reason.create') }}" class="primary-btn" data-bs-toggle="addmodal" data-bs-target="#myAddModal" id="apply-btn" data-id="{{ $campaigns->id }}" data-identifier="direct-apply"><span>Interested</span></a>
                    @endif
                    </div>
                    @if(!empty($connected_influencer_status))
                        @if($connected_influencer_status['payment_status'] == 4 && empty($ratingsInfo))
                               <button type="button" class="primary-btn" id="InfluencerratingBtn" data-id="{{ $connected_influencer_status['id'] }}" data-campaign_id="{{ $connected_influencer_status['campaign_id'] }}" data-brand_id="{{ $campaigns->brands->user_id }}" data-campaign_name="{{ $connected_influencer_status['campaign_name'] }}" data-name="{{ ucfirst($connected_influencer_status['user_name']) }}" data-email="{{ $connected_influencer_status['user_email'] }}" data-negotiation_price="{{ $connected_influencer_status['negotiation_price'] }}" data-user_type="{{ $connected_influencer_status['user_type'] }}" data-url={{ route('campaign-ratings')}}>Ratings</button>
                              @elseif($connected_influencer_status['payment_status'] == 4 && !empty($ratingsInfo))
                                <div class="campaign-actions-ratings mb-4">
                                   @foreach(range(1,5) as $i)
                                       <span class="fa-stack" style="width:1em">
                                           <i class="far fa-star fa-stack-1x text-yellow"></i>
                                           @if($ratingsInfo->star_ratings >0)
                                               @if($ratingsInfo->star_ratings >0.5)
                                                   <i class="fas fa-star fa-stack-1x text-yellow"></i>
                                               @else
                                                   <i class="fas fa-star-half fa-stack-1x text-yellow"></i>
                                               @endif
                                           @endif
                                           @php $ratingsInfo->star_ratings--; @endphp
                                       </span>
                                   @endforeach
                                   <br><span class="reiew-text">{{ucfirst(@$ratingsInfo['rating_type'])}}</span>
                                </div>
                        @endif
                    @endif
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
                     <div class="campaign-list-table list-table">
                        @if(count($prodArr)>0)
                        <table class="table" id="campaign-connected-products">
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
                                       @if(Auth::user()->hasRole('Influencer'))
                                       <a href="{{ route("influencer.campaigns.product_details",[$product['id'],$campaigns['id']])}}" class="primary-btn">View More</a>
                                       @elseif(Auth::user()->hasRole('Brand'))
                                       <a href="{{ route("brand.campaigns.product_details",[$product['id'],$campaigns['id']])}}" class="primary-btn">View More</a>
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
{{-- <script src="{{ asset('assets_old_dkp/js/campaigns.js') }}"></script> --}}
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

    $('#acceptOfferBtn').on('click',function(){
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-price');
        var brandId     = $(this).attr('data-id');
        var startDate   = $(this).attr('data-start_date');
        var endDate     = $(this).attr('data-end_date');
        if(userEmail!=""){

        }else{
            error_notification('Email is not available for this user!');
        }

            var mailContent =  `<b>\{\{ Brand Name \}\}</b>,<br/><br/>
                                We have reviewed your campaign offer letter and we are interested to collaborate with your campaign.<br/><br/>
                                Thanks & Regards.<br/><br/>`;
            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Accept Offer</h1>
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
                                <b>Campaign Price: </b>
                                <span> $${price} </span>
                            </div>
                            <br>
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="acceptOffer-email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn primary-btn" onclick="AcceptOffer(${connectedInfluencer}, '${userEmail}','${campName}','${userName}','${brnadName}','${price}',${brandId})">Accept </button>
                        </div>
                    `;
            make_modal('negociateRequestMail', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#acceptOffer-email-content' ))
            .then(editor => {
                sendEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
    })
    function getSendOfferDataFromTheEditor() {
        return sendEditor.getData();
    }

    $('#rejectOfferBtn').on('click',function(){
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-each_inf_fees');

        var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Reject Offer</h1>
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
                    </div>
                `;
        make_modal('acceptRejectOffer', html, true, null);
    })

    function AcceptOffer(id,email,campName,UserName,brnadName,price,brandId){
        $url = window.CONFIG.ROUTES.accept_offer;
        accept_request('Are you sure you want to accept this offer?').then(function (response) {
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
                        brnadName : brnadName,
                        price : price,
                        brandId : brandId,
                        emailContent : getSendOfferDataFromTheEditor()
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

    $('#negociateOfferBtn').on('click',function(){
        // console.log('here');
        var id          = $(this).attr('data-id');
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var startDate   = $(this).attr('data-start_date');
        var endDate     = $(this).attr('data-end_date');
        var brandName   = $(this).attr('data-brand');
        var price   = $(this).attr('data-price');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');


        var mailContent =  `<b>\{\{ Brand Name \}\}</b>,<br/><br/>
                                We have reviewed your campaign offer letter and we are request you to negotiate with below price.<br/><br/>
                                New Price: <b>\{\{ New Price \}\}</b><br/><br/>
                                We sincerely hope you'll review it and accept it.<br/><br/>`;
            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Send Negotiate Request to Brand</h1>
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
                                <b>Campaign Price: </b>
                                <span> ${price} </span>
                            </div>
                            <div class="interested-influencers">
                                <b>Negociate Offer Price: </b>
                                <span><input type="number" class="form-control mt-2" placeholder="Enter negotiate offer price" name="negociate_price" id="negociate_price"></span>
                            </div>
                            <br>
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="negociate-email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="primary-btn" id="btn_resend" onclick="negociateRequest(${connectedInfluencer}, ${campId}, '${campName}', '${userName}', '${userEmail}', '${brandName}')">Send Negotiate Request</button>
                        </div>
                    `;
            make_modal('negociateRequestMail', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#negociate-email-content' ))
            .then(editor => {
                resendEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
    })

    function getNegociateDataFromTheEditor() {
        return resendEditor.getData();
    }

    function negociateRequest(id,campId,campName,UserName,email,brandName){
        var resendPrice = $('#negociate_price').val();
        if(resendPrice == ""){
            error_notification('Please enter negotiate offer price!');
            return false;
        }
        $url = window.CONFIG.ROUTES.negociate_request;
        negociate_request('Are you sure you want to Negotiate this offer?').then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: $url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        email : email,
                        campName : campName,
                        userName : UserName,
                        brandName : brandName,
                        negociate_price   : $('#negociate_price').val(),
                        email_content   : getNegociateDataFromTheEditor()
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

    function RejectOffer(id,email,campName,UserName,brnadName){
       $('#acceptRejectRequest').hide();
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
                                    <button type="button" class="btn primary-btn" onclick="RejectOfferConfirmation(${id},'${email}','${campName}','${UserName}','${brnadName}')">Reject </button>
                              </div>
                           </form>
                        </div>

                `;
        make_modal('rejectOffer', html, true, null);
    }

    function RejectOfferConfirmation(id,email,campName,UserName,brnadName){
        $url = window.CONFIG.ROUTES.reject_offer
        reject_request('Are you sure you want to reject this offer?').then(function (response) {
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
                        BrandName : brnadName,
                        Reason   : $('#reject_reason').val()
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

    function RejectRequest(id,email,campName,UserName){
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

   $('#completeOfferBtn').on('click',function(){
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-each_inf_fees');
        if(userEmail !=""){
            var mailContent =  `<b>\{\{ Brand Name \}\}</b>,<br/><br/>
                                    We have completed your offer for this <b>\{\{ Campaign Name \}\}</b> Campaign.<br/>You can verify it on this link <b>\{\{ Video Url \}\}</b><br/><br/>
                                    We sincerely hope you'll review it and accept it.<br/><br/>`;

            var html = `<div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Complete Contract</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="interested-influencers">
                                    <b>Video Url: </b>
                                    <span><input type="text" class="form-control mt-2" placeholder="Video url link" name="url" id="url"></span>
                            </div>
                            <div class="offer-details email-content">
                                <b class="mb-4">Email Content <small>( Note: Please don't change the value inside the \{\{ \}\} )</small> </b>
                                <div>
                                    <textarea name="" id="common-email-content" cols="30" rows="10">${mailContent}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn primary-btn" onclick="completeOfferRequest(${connectedInfluencer}, '${userEmail}','${campName}','${userName}','${brnadName}',${price})">Submit </button>
                        </div>
                    `;
            make_modal('commonEmailStatus', html, true, null);

            ClassicEditor
            .create( document.querySelector( '#common-email-content' ))
            .then(editor => {
                completeOfferStatusEditor = editor;
            })
            .catch( error => {
                console.error( error );
            });
        } else {
            error_notification('Email is not available for this user!');
        }
   });

   function completeOfferRequest(id,email,campName,UserName,brnadName,price){
        var video_url = $('#url').val();
        if(video_url == ""){
            error_notification('Please add video url!');
            return false;
        }
        $url = window.CONFIG.ROUTES.complete_offer;
        complete_request('Are you sure you want to complete this offer?').then(function (response) {
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
                        brnadName : brnadName,
                        price : price,
                        emailContent: getCompleteOfferStatusEditor(),
                        videoUrl : video_url
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

   $('#paymentRequestBtn').on('click',function(){
        var campId      = $(this).attr('data-campaign_id');
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var userEmail   = $(this).attr('data-email');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-each_inf_fees');
        var status  =   $(this).attr("data-status");
        if(userEmail != ""){
            var mailContent = "";
            var modalTitle;
            if(status == "Payment Request"){
                mailContent = `<b>\{\{ Brand Name \}\}</b>,<br/><br/>
                                We have completed your contract for this <b>\{\{ Campaign Name \}\}</b> and now we are request you to complete payment of <b>\{\{ Final Price \}\}</b> from your side.</b><br/><br/>
                                <br/>
                                Kind & Regards,\{\{ User Name \}\}
                                Thank you!`;
                modalTitle = "Payment Request";
            }else if(status == "Resubmit Payment Request") {
                mailContent = `<b>\{\{ Brand Name \}\}</b>,<br/><br/>
                                We have reviewd your reject payment request for the campaign <b>\{\{ Campaign Name \}\}</b><br/><br/>Now We have resubmit payment request of <b>\{\{ Final Price \}\}</b>  payment for complete payment process from your side.</p><br/>
                                <br/>
                                Kind & Regards,\{\{ User Name \}\}
                                Thank you!`;
                modalTitle = "Resubmit Payment Request";
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
                           <button type="button" class="btn primary-btn" onclick="paymentRequest(${connectedInfluencer}, '${userEmail}','${campName}','${userName}','${brnadName}','${status}',${price})">Payment Request </button>
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

    function getCompleteOfferStatusEditor(){
        return completeOfferStatusEditor.getData();
    }

   function paymentRequest(id,email,campName,UserName,brnadName,status,price){
        $url = window.CONFIG.ROUTES.payment_request;
        payment_request('Are you sure you want to request for payment process?').then(function (response) {
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
                        brnadName : brnadName,
                        status : status,
                        price : price,
                        emailContent: getCommonStatusEditor()
                    },
                    beforeSend: function() {
                        $('.loading').removeClass('d-none');
                        $('.loading').show();
                    },
                    success: function ( response ) {
                        console.log(response);
                        $('.loading').hide();
                        $('#completeOffer').hide();
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

   $('#viewOfferBtn').on('click',function(){
        var campName    = $(this).attr('data-campaign_name');
        var brnadName   = $(this).attr('data-brand');
        var userName    = $(this).attr('data-name');
        var connectedInfluencer  =  $(this).attr('data-connected-influener-id');
        var price   = $(this).attr('data-price');
        var startDate   = $(this).attr('data-start_date');
        var endDate     = $(this).attr('data-end_date');

        var html = `<div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="exampleModalLabel">View Contract Offer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="offer-details">
                            Hello <b> ${userName},</b>
                        </div>
                        <div class="interested-influencers">
                           <p><b>${brnadName}</b> brand has sent you contract offer for this <b>${campName}</b> campaign.</p><br/>
                           <p>Contract offer details</p>
                           <div class="offer-details">
                                <b>Campaign Name: </b>
                                <span>${campName}</span>
                            </div>
                            <div class="offer-details">
                                <b>Campaign Date: </b>
                                <span> ${startDate} To ${endDate} </span>
                            </div>
                            <div class="offer-details">
                                <b>Campaign Fees: </b>
                                <span> ${price} </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                `;
        make_modal('viewOffer', html, true, null);
   });

   $('#campaign-connected-products').DataTable({
        "searching": true,
        "pageLength": 20,
        "lengthChange": false,
        "orderable": true
    });
function validateForm( $form ) {
    if ( $form.length ) {
        let validateForm = $form.validate({
            rules: {
                apply_reason_en: {
                    required: true
                }
            },
            submitHandler: ( form ) => {
                let url = $form.attr('action');
                $('#loader').show();
                $.ajax({
                    url:  url,
                    type: url.indexOf('/update') === -1 ? 'POST' : 'PUT',
                    dataType: 'json',
                    data: $form.serializeArray(),
                    beforeSend: function() { $('.loading').removeClass('d-none'); $('.loading').show(); },
                    success:function(response){
                         $('.loading').hide();
                        if(response.status) {
                             $('.loading').hide();
                            location.reload(true);
                             data_applied_notification();
                            // $form.parents('.modal').modal('hide');
                        }else{
                        }
                    },
                    error:function(error){
                        $('#loader').hide();
                        validateForm.showErrors(error.responseJSON.errors);
                    }
                });
            },
        });
    }
}

$(document).on('click', '#apply-form-btn',function(e) {
    $('.loading').removeClass('d-none'); $('.loading').show();
});

$(document).on('click', '#apply-btn',function(e) {
        e.preventDefault();
        let apply_reason_url = $(this).attr('data-url');
        let campaign_id = $(this).attr('data-id');
        let identifier = $(this).attr('data-identifier');
        let $this = $(this);
        $this.addClass('pe-none');
        if ( apply_reason_url ) {
            $.ajax({
                url: apply_reason_url,
                type: 'get',
                data: {
                    'apply_reason_url' : apply_reason_url,
                    'campaign_id' : campaign_id,
                    'identifier' : identifier
                },
                dataType: 'json',
                complete: function(response) {
                    let resp = response.responseJSON;
                    if ( resp ) {
                        if ( resp.status ) {
                            make_modal( 'apply-reason-modal', resp.data.view, true );
                            // $('.loading').hide();
                            validateForm( $('.apply-reason-form') );
                        }
                    }
                },
                error: function (response) {
                    error_notification_add();
                }
            }).always(function(){
                $this.removeClass('pe-none');
            });
        }
    });

function data_applied_notification(){
    let data = $('table').attr('name') ? $('table').attr('name') : 'Data';
    return Swal.fire({
        background: '#def5e5',
        iconHtml: '<div class="icon success"><svg width="24" height="24" id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle fill="#fff0" cx="64" cy="64" r="64"></circle></g><g><path fill="#3EBD61" d="M54.3,97.2L24.8,67.7c-0.4-0.4-0.4-1,0-1.4l8.5-8.5c0.4-0.4,1-0.4,1.4,0L55,78.1l38.2-38.2   c0.4-0.4,1-0.4,1.4,0l8.5,8.5c0.4,0.4,0.4,1,0,1.4L55.7,97.2C55.3,97.6,54.7,97.6,54.3,97.2z"></path></g></svg></div>',
        color: '#395144',
        iconColor: '#395144',
        closeButtonColor: '#395144',
        toast: true,
        icon: 'success',
        title: 'Data Applied Successfully!',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        allowOutsideClick: false,
        showCloseButton: true,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        customClass: {
            closeButton: 'success-close',
            container: 'success-container',
            timerProgressBar: 'success-progress',
        }
    });
}

</script>
@endsection
