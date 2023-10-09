@extends('layouts.index')
@section('style')

<link rel="stylesheet" type="text/css" href="{{ asset('influencer_user/product_details.css') }}" />
@endsection
@section('content')
<main class="product-details-page">
   <div class="container-fluid">
      <div class="content">
         <a href="{{ route('product_details') }}"><h3>Product Details</h3></a>
         <div class="product-details">
            <div class="row justify-content-between">
               <div class="col-xl-5">
                  <div class="product-catalog">
                     <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                           @if ( $products->mainImage )
                             <div class="swiper-slide">
                                 <div class="swiper-zoom-container">
                                    <img src="{{ asset("storage/{$product_path}/{$products->id}/{$products->mainImage->image}") }}" alt="{{ $products->name_en }}" />
                                </div>
                              </div>
                           @endif

                           @if ( $products->images )
                              @foreach ( $products->images as $image )
                                <div class="swiper-slide">
                                    <div class="swiper-zoom-container">
                              <img src="{{ asset("storage/{$product_path}/{$products->id}/{$image->image}") }}" alt="{{ $products->name_en }}" />
                                   </div>
                                 </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     <div thumbsSlider="" class="swiper mySwiper">
                         <div class="swiper-wrapper">
                             @if ( $products->mainImage )
                                 <div class="swiper-slide">
                                     <img src="{{ asset("storage/{$product_path}/{$products->id}/thumbnails/{$products->mainImage->thumbnail_image}") }}" alt="{{ $products->name_en }}" />
                                 </div>
                              @endif
                             @if ( $products->images )
                                 @foreach ( $products->images as $image )
                                   <div class="swiper-slide">
                                       <img src="{{ asset("storage/{$product_path}/{$products->id}/thumbnails/{$image->thumbnail_image}") }}" alt="{{ $products->name_en }}" />
                                    </div>
                                 @endforeach
                              @endif
                         </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7">
                  <div class="product-details-content">
                     <div class="product-details-head">
                        @if($products->is_available == 1)
                        <small>In Stock</small>
                        @else
                        <small>Not available</small>
                        @endif
                        <p>{{$products->short_description_en}}</p>
                        <h2>{{$products->name_en}}</h2>
                     </div>
                     <div class="product-situation"> 
                       <span>SKU: {{$products->keyword_en}}</span>
                       <div class="product-situation-inner">
                          <p>On sale</p>    
                          <p>Limited</p>
                       </div> 
                  </div>

                     <h3 class="product-price">
                        ${{$products->price}}
                     </h3>
                     <div class="product-category">
                        <ul class="product-category-list">
                           <li>
                              <p>Category</p>
                              <span>{{ ucfirst(@$products->category->name_en) }} </span>
                           </li>
                           <li>
                              <p>Feature</p>
                              @if($products->is_featured == 1) <span>Featured</span>@else  <span>Not Featured</span> @endif
                           </li>
                           <li>
                              <p>Available</p>
                              @if($products->is_available == 1)
                                 <span>Yes</span>
                              @else 
                                 <span>No</span>
                              @endif
                           </li>
                        </ul>
                    </div>
                    <div class="product-actions">
                    @if(Auth::user()->hasRole('Influencer'))
                        @if(count($products->sampleRequest) > 0)
                             @foreach ( $products->sampleRequest as $sample )
                                <input type="hidden" class="prpduct_status" value="{{$sample->shipment_status}}">
                                @if(Auth::user()->hasRole('Influencer'))
                                   @if($sample->shipment_status == 0 )
                                   <button class="primary-btn change-status" type="submit" data-status='0' data-id={{ $sample->id}}><span>Request For Sample</span></button>
                                   <div class="custom-badge primary-status-text status status-active after-changed-status-button d-none" data-status='1'>Waiting for response</div>
                                   @elseif($sample->shipment_status == 2 )
                                   <button class="primary-btn shipped-changed-button" data-status='2' data-id={{ $sample->id}}><span>Mark as Delivered</span></button>
                                   <div class="custom-badge status status-completed after-changed-button d-none"  data-status='3' data-id={{ $sample->id}}>Recieved</div>
                                   @elseif($sample->shipment_status == 3)
                                   <div class="custom-badge status status-completed">Recieved</div>
                                   @else
                                   <div class="custom-badge primary-status-text status status-active">Waiting for response</div>
                                   @endif
                                @else 
                                <button class="primary-btn" type="submit" data-id={{ $sample->id}}><span>Mark as Shipped</span></button>
                                @endif
                            @endforeach
                        @else
                            <input type="hidden" class="prpduct_status" value="0">
                            <input type="hidden" class="campaign_id" value="{{$campaign_id}}">
                            <input type="hidden" class="product_id" value="{{$products->id}}">
                            <input type="hidden" class="brand_id" value="{{$products->brand->user_id}}">
                            @if($campaign_id)
                                <button class="primary-btn change-status" type="submit" data-status='0'><span>Request For Sample</span></button>
                                <div class="custom-badge primary-status-text status status-active after-changed-status-button d-none" data-status='1'>Waiting for response</div>
                            @endif
                        @endif
                    @endif
                    @if(Auth::user()->hasRole('Brand'))
                        @if($products->sampleRequest)
                            @foreach ( $products->sampleRequest as $sample )
                            <input type="hidden" class="prpduct_status" value="{{$sample->shipment_status}}">
                                    @if($sample->shipment_status == 1 ) 
                                        <button class="primary-btn change-status-brand" type="submit" data-status='2' data-id={{ $sample->id}}><span>Accept Request from influencer</span></button>
                                        <div class="custom-badge primary-status-text status status-active after-change-status-brand d-none d-inline-block" data-status='2'>Product shipped</div>
                                    @elseif($sample->shipment_status == 2 ) 
                                        <div class="custom-badge status status-active d-inline-block" >Product shipped</div>
                                    @elseif($sample->shipment_status == 3 ) 
                                        <div class="custom-badge status status-completed d-inline-block" >Product Delivered</div>
                                    @elseif($sample->shipment_status == 0 ) 
                                        <div class="custom-badge primary-status-text status status-active after-changed-status-button" >No status available</div>
                                    @endif
                            @endforeach
                        @endif
                    @endif
                    </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="product-description">
            <div class="row">
               <div class="col-12">
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                     <div class="accordion-item">
                        <h2 class="accordion-header">
                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                           Product Details
                           </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                           <div class="accordion-body">
                              <ul>
                                 {{-- @foreach($products_description as $descriptions)  --}}
                                 <li>{{ $products->description_en }}</li>
                                 {{-- @endforeach --}}
                              </ul>
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
<script>
   var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 3,
    loopedSlides: 5,
    breakpoints: {
      640: {
        loopedSlides: 3,
        spaceBetween: 10,
      },
      768: {
        loopedSlides: 4,
        spaceBetween: 15,
      },
      1024: {
         loopedSlides: 5,
        spaceBetween: 20,
      },
    },
   });
   var swiper2 = new Swiper(".mySwiper2", {
    zoom: true,
    centeredSlides: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
   });

   function status_confirmation(message = 'Are you sure you want to delete this record?', confirmButtonText = "Yes, change!", cancelButtonText = 'No, cancel' ) {
    return Swal.fire({
        text: message,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-danger custom-button-css",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    });
}

   $(".change-status").click(function() {
      var id = $(this).data("id");
      var product_deliver_status = $('.prpduct_status').val();
      var campaign_id = $('.campaign_id').val();
      var product_id = $('.product_id').val();
      var brand_id = $('.brand_id').val();


      if(product_deliver_status == '0') {
         var shipment_status = $('.after-changed-status-button').data("status");
        // alert(shipment_status);
      }
      else if(product_deliver_status == '2') {
         var shipment_status = $('.after-changed-button').data("status");
      }
      else {
      }
      
      var url = "{{ route('delivery.change-status') }}";
      status_confirmation('Are you sure you want to mark status as delivered?').then(function (response) {
           if (response['isConfirmed']) {
                $.ajax({
                    url: url,
                    type: 'Post',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'post',
                        "_token": "{{ csrf_token() }}",
                        "shipment_status": shipment_status,
                        "campaign_id": campaign_id,
                        "product_id": product_id,
                        "shipment_status": shipment_status,
                        "brand_id": brand_id
                    },
                    success: function (data) {
                        console.log(data);
                        if ( data.status ) {
                              status_update_notification( data.message )
                              $('.after-changed-status-button').removeClass('d-none');
                              $('.change-status').hide();
                        } else {
                            error_notification( data.message );
                        }
                    },
                    error: function (data) {
                        error_notification();
                    }
                });
             }
            });

       console.log("It failed");
   });


    $(".shipped-changed-button").click(function() {
      var id = $(this).data("id");
      console.log(id);
      var product_deliver_status = $('.prpduct_status').val();
      
      var url = "{{ route('delivery.change-status') }}";
      status_confirmation('Are you sure you want to mark status as delivered?').then(function (response) {
           if (response['isConfirmed']) {
                $.ajax({
                    url: url,
                    type: 'Post',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'post',
                        "_token": "{{ csrf_token() }}",
                        "shipment_status": 3,
                    },
                    success: function (data) {
                        console.log(data);
                        if ( data.status ) {
                              status_update_notification( data.message )
                              $('.after-changed-button').removeClass('d-none');
                              $('.shipped-changed-button').hide();
                        } else {
                            error_notification( data.message );
                        }
                    },
                    error: function (data) {
                        error_notification();
                    }
                });
             }
            });

       console.log("It failed");
   });

        $(".change-status-brand").click(function() {
          var id = $(this).data("id");
          var product_shipment_status = $('.prpduct_status').val();

          if(product_shipment_status == '1') {
             var shipment_status = $('.after-change-status-brand').data("status");
          }
          else if(product_shipment_status == '2') {
             var shipment_status = $('.after-changed-button').data("status");
          }
          else {
          }
      
      var url = "{{ route('delivery.change-status-brand') }}";
      status_confirmation('Are you sure you want to mark status as delivered?').then(function (response) {
           if (response['isConfirmed']) {
                $.ajax({
                    url: url,
                    type: 'Post',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'post',
                        "_token": "{{ csrf_token() }}",
                        "shipment_status": shipment_status,
                    },
                    success: function (data) {
                        console.log(data);
                        if ( data.status ) {
                              status_update_notification( data.message )
                              $('.after-change-status-brand').removeClass('d-none');
                              $('.change-status-brand').hide();
                        } else {
                            error_notification( data.message );
                        }
                    },
                    error: function (data) {
                        error_notification();
                    }
                });
             }
            });

       console.log("It failed");
   });
</script>
@endsection