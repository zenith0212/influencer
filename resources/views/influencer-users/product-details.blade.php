@extends('layouts.index')
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
<style>
   .form-control.form-control-solid.search_name{
       padding: 1.175rem 1rem;
   }

   .product-name-title{
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      text-align: center;
      min-height: 48px;
   }

   .card.products-card .card-body {
      padding: 24px 20px !important;
   }

/*   .card.campaigns-card {
      margin-top: 30px;
   }*/

   @media(max-width:767px){
      .card.campaigns-card {
         max-width: 400px;
         margin: auto;
      }
   }

   .tab-content{
      margin-top: 30px;
   }

</style>
@section('content')
<main class="body-change">
   @if(session()->has('error'))
       <div class="alert alert-danger"> 
           {{ session()->get('error') }}
       </div>
   @endif
   <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
      <div class="d-flex flex-column flex-column-fluid">
         <a href="{{ route('product_details') }}"><h1>Product Details</h1></a>
         <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="container-fluid">
               <form id="search_product">
                  <div class="card mb-7">
                     <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                           <div class="position-relative w-100 me-md-4 search_name_css">
                              <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                 </svg>
                              </span>
                              <input type="text" class="form-control form-control-solid ps-10 search_name" name="name" id="name" value="" placeholder="Search Product">
                           </div>
                           <div class="d-flex align-items-center">
                              <button type="submit" id="search" class="primary-btn mt-5 mt-md-0">Search</button>
                           </div>
                        </div>
                        <div class="collapse" id="kt_advanced_search_form">
                           <div class="separator separator-dashed mt-9 mb-6"></div>
                           <div class="row g-8 mb-8">
                              <div class="col-md-6">
                                 <div class="row mb-6">
                                    <div class="col-12">
                                       <label class="fs-6 form-label fw-bold text-dark">Categories</label>
                                       <select name="category" id="category-select" class="form-control bg-transparent category-select2" >
                                          <option value="">Select Category</option> 
                                          @foreach($categories as $category)
                                          <option value="{{$category->id}}"> {{$category->name_en}} </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="fs-6 form-label fw-bold text-dark">Min. Amount</label>
                                       <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                          <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$50" />
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="fs-6 form-label fw-bold text-dark">Max. Amount</label>
                                       <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                          <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$100" />
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="row mb-6">
                                    <div class="col-12">
                                       <label class="fs-6 form-label fw-bold text-dark">Brand</label>
                                       <select name="brand" id="brand-select" class="form-control bg-transparent brand-select2" >
                                          <option value="">Select brand</option> 
                                          @foreach($brands as $brand)
                                          <option value="{{$brand->id}}"> {{$brand->title_en}} </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="fs-6 form-label fw-bold text-dark">MIn. Fans</label>
                                       <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                          <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$100" />
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="fs-6 form-label fw-bold text-dark">Max. Fans</label>
                                       <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                          <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$100" />
                                          <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                             <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                   <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                   <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                             </span>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
               <div class="d-flex flex-wrap flex-stack pb-7 product_total">
                  <div class="d-flex flex-wrap align-items-center my-1">
                     <h3 class="fw-bold me-5 my-1">Total {{ $total_products }} Items Found
                        <span class="text-gray-400 fs-6">by Recent Updates ↓</span>
                     </h3>
                  </div>
               </div>
               <div id="get_list"></div>
               <div class="tab-content mt-0">
                  <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel" >
                     <div class="row g-6 g-xl-9">
                        @foreach($all_products as $products)
                        <div class="col-md-6 col-xxl-4" >
                           <div class="card products-card border-1 h-100">
                              <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                 <div class="symbol symbol-65px symbol-circle mb-5">
                                    @if(!empty($products->mainImage->image))
                                    <img src="{{ asset("storage/{$product_path}/{$products->id}/{$products->mainImage->image}") }}" alt="{{ $products->name_en }}" alt="image">
                                    @else
                                    <img src="{{ asset('/assets/media/avatars/default_img.png')  }}" alt="image">
                                    @endif
                                    @if($products->is_available == 1)
                                    <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                    @else 
                                    <div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                    @endif
                                 </div>
                                 <a href="{{ route('influencer.product_details',$products->id) }}" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0 product-name-title">{{ ucfirst($products->name_en) }} ({{ $products->keyword_en }})</a>
                                 <div class="fw-semibold text-gray-400 mb-6"> {{ucfirst($products->short_description_en)}}  </div>
                                 <div class="d-flex flex-center flex-wrap">
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                       <div class="fs-6 fw-bold text-gray-700">$ {{ $products->price }} </div>
                                       <div class="fw-semibold text-gray-400">Price </div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                       <div class="fs-6 fw-bold text-gray-700">@if($products->is_available) Yes  @else No @endif</div>
                                       <div class="fw-semibold text-gray-400"> Available</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                       <div class="fs-6 fw-bold text-gray-700">{{ $products->keyword_en }}</div>
                                       <div class="fw-semibold text-gray-400"> Keyword</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        <div id="load_more" class="mt-0"></div>
                     </div>
                  </div>
               </div>
               <div class="d-flex flex-center" id="remove-row">
                  @if($display_product_count>0 && $display_product_count!=$total_products) 
                  <div class="d-flex flex-center" id="remove-row">
                     <a href="javascript:void(0);" class="primary-btn fw-bold px-6 mt-5" id="kt_social_feeds_more_posts_btn" >
                        <input type="hidden" id="loader_id" value="{{ $products->id }}"/>
                        <span class="indicator-label">Show more</span>
                        <span class="indicator-progress">Please wait...
                           <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                     </a>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$(document).ready(function() {
   		$('.category-select2').select2();
	});
	$(document).ready(function() {
   		$('.brand-select2').select2();
	});

</script>
<script>
$(document).ready(function(){
   $(document).on('click','#kt_social_feeds_more_posts_btn',function(e){
      e.preventDefault();
       var id = $('#loader_id').val();
       $("#kt_social_feeds_more_posts_btn").html("Loading....");
       $.ajax({
           url : '{{ url("products/loaddata") }}',
           method : "POST",
           data : {id:id, _token:"{{csrf_token()}}",
                  action: "load_more"},
           dataType : "json",
            beforeSend: function() {
               $('.loading').removeClass('d-none');
               $('.loading').show();
            },
            success : function (response)
            {
               $('.loading').hide();
               if(response.status == true)
               {
                  $('#load_more').append(response.output);
                  $("#kt_social_feeds_more_posts_btn").html("Show More");
                  $('#loader_id').val(response.products_id);
               }
               else
               {
                  $('#kt_social_feeds_more_posts_btn').hide();
                  $('#kt_social_feeds_more_posts_btn').html("No Data");
               }
                if(response.products_id == response.max) {
                  $('#kt_social_feeds_more_posts_btn').hide();
                  $('#kt_social_feeds_more_posts_btn').html("No Data");
               }
            },
            error: function() {
               $('.loading').hide();
               $('#kt_social_feeds_more_posts_btn').hide();
               $('#kt_social_feeds_more_posts_btn').html("No Data");
            }
       });
   });  
}); 
</script>
<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script src="{{ asset('assets/js/search-product.js') }}"></script>

<script></script>
@endsection