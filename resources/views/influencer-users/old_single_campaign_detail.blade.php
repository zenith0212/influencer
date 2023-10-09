@extends('layouts.index')
@section('content')
<main class="main">
   <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
         <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
               <li class="breadcrumb-item text-muted">
                  <a href="{{route('campaign_details')}}" class="text-muted text-hover-primary">Home</a>
               </li>
               <li class="breadcrumb-item">
                  <span class="bullet bg-gray-400 w-5px h-2px"></span>
               </li>
               <li class="breadcrumb-item text-muted">
                  <a href="{{route('campaign_details')}}" class="text-muted text-hover-primary">Campaign</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
<div id="kt_app_content_container" class="app-container container-xxl">
   <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/campaigns.html">
      <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
         <div class="card card-flush py-4">
            <div class="card-header">
               <div class="card-title">
                  <h2>{{$campaigns->name_en}}</h2>
               </div>
            </div>
            <div class="card-body text-center pt-0">
               <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                  <div class="image-input-wrapper w-150px h-150px" style="background-image: url({{ asset('/storage/campaign_images/'.$campaigns->thumbnail_image) }})">
                  </div>
               </div>
               <div class="text-muted fs-7">{{ucfirst($campaigns->short_description_en)}}</div>
            </div>
         </div>
         <div class="card card-flush py-4">
            <div class="card-header flex-nowrap">
               <div class="card-title w-50">
                  <h2>Status</h2>
               </div>
               <div class="card-toolbar w-50">
                  @if($campaigns->campaign_is_active == 1)
                  <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                  <div class="text-muted fs-7 mb-0 ps-2">Active</div>
                  @else
                  <div class="rounded-circle bg-danger w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                  <div class="text-muted fs-7 mb-0 ps-2">Not Active</div>
                  @endif
               </div>
            </div>
            <div class="card-header flex-nowrap">
               <div class="card-title w-50">
                  <h2>Sample </h2>
               </div>
               <div class="card-toolbar w-50">
                  @if($campaigns->is_sample_required == 1)
                  <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                  <div class="text-muted fs-7 mb-0 ps-2">Required</div>
                  @else
                  <div class="rounded-circle bg-danger w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                  <div class="text-muted fs-7 mb-0 ps-2">Not Required</div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
         <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
            <li class="nav-item">
               <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Campaign</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Products</a>
            </li>
         </ul>
         <div class="tab-content">
            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
               <div class="d-flex flex-column gap-7 gap-lg-10">
                  <div class="card card-flush py-4">
                     <div class="card-header">
                        <div class="card-title">
                           <h2>{{ ucfirst($singlebrand_name->title_en) }}</h2>
                        </div>
                     </div>
                     <div class="card-body pt-0">
                        {{-- <div class="mb-10 fv-row">
                           <div class="text-group">
                              <label class="form-label">Brand Name :</label>
                              <p> {{ ucfirst($singlebrand_name->title_en) }} </p>
                           </div>
                        </div> --}}
                        <div class="mb-10 fv-row">
                           <div class="text-group">
                              <label class="form-label">Fan Range 
                                 {{-- <img src="{{asset('assets/media/symbols/fan-club.png')}}" alt="" height="25px;" width="25px;">  --}}
                              :</label>
                              <p> {{ $campaigns->min_fans }} - {{ $campaigns->max_fans }}</p>
                           </div>
                        </div>
                        <div class="mb-10 fv-row">
                           <div class="text-group">
                              <label class="form-label">Price Range :</label>
                              <p> ${{ $campaigns->min_price }} - ${{ $campaigns->max_price }}</p>
                           </div>
                        </div>
                        <div class="mb-10 fv-row">
                           <div class="text-group">
                              <label class="form-label">Influencer Required :</label>
                              <p> {{ ucfirst($campaigns->total_influencers_required) }}</p>
                           </div>
                        </div>
                        <div class="mb-10 fv-row">
                           <div class="text-group">
                              <label class="form-label">Streaming Type:</label>
                              <p> @if( $campaigns->is_video == 0) 
                                 <span class="ms-2 badge badge-light-danger fw-semibold"> No Streaming Required</span>
                                 @elseif( $campaigns->is_video == 1)
                                 <span class="ms-2 badge badge-light-info fw-semibold"> Video Streaming </span>
                                 @else
                                 Live streaming
                                 @endif
                              </p>
                           </div>
                        </div>
                        <div class="mb-10 fv-row">
                           <div class="text-group">
                              <label class="form-label">Application Duration:</label>
                              <p> {{ date("m/d/Y", strtotime($campaigns->application_start_date)) }} - {{ date("m/d/Y", strtotime($campaigns->application_end_date)) }} </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
               <div class="d-flex flex-column gap-7 gap-lg-10">
                  @foreach($product_name as $product)
                  <div class="card card-flush">
                     <div class="card mb-6">
                        <div class="card-body p-5 pb-3">
                           <!--begin::Details-->
                           <div class="card-toolbar d-flex align-items-center mb-4 product_status">
                            @if($product->is_available == 1)
                                <div class="rounded-circle bg-info w-10px h-10px" id="kt_ecommerce_add_product_status"></div>
                                <div class="text-muted fs-7 mb-0 ps-2">Available</div>
                                @else
                                <div class="rounded-circle bg-danger w-10px h-10px" id="kt_ecommerce_add_product_status"></div>
                                <div class="text-muted fs-7 mb-0 ps-2">Not available</div>
                            @endif
                           </div>
                           <div class="card-toolbar d-flex align-items-center mb-10 product_status">
                            @if($product->is_featured == 1)
                                <div class="rounded-circle bg-info w-10px h-10px" id="kt_ecommerce_add_product_status"></div>
                                <div class="text-muted fs-7 mb-2 ps-2">Featured</div>
                                @else
                                <div class="rounded-circle bg-danger w-10px h-10px" id="kt_ecommerce_add_product_status"></div>
                                <div class="text-muted fs-7 mb-0 ps-2">Not Featured</div>
                            @endif
                           </div>
                           <div class="d-flex flex-wrap flex-sm-nowrap">
                              <!--begin: Pic-->
                              <div class="me-7 mb-2">
                                 <div class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative">
                                    <img src="{{ asset('/storage/productsUploads/'.$product->thumbnail_image) }}" alt="image" height="50" width="50">
                                 </div>
                              </div>
                              <!--end::Pic-->
                              <!--begin::Info-->
                              <div class="flex-grow-1">
                                 <!--begin::Title-->
                                 <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                       <!--begin::Name-->
                                       <div class="d-flex align-items-center mb-2">
                                          <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"> {{ ucfirst($product->name_en) }}
                                          </a>
                                          <a href="#" class="text-gray-500 text-hover-primary fs-2 fw-semibold me-1">( {{ ucfirst($product->keyword_en) }} )
                                          </a>
                                       </div>
                                       <!--end::Name-->
                                       <!--begin::Info-->
                                       <div class="d-flex flex-wrap fw-semibold fs-6 mb-2 pe-2">
                                        @foreach($product_category as $pc)
                                          <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                             <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                             <span class="svg-icon svg-icon-4 me-1">
                                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 121.78"><title>category</title><path d="M6.91,0H49.79a6.86,6.86,0,0,1,5.34,2.55A6.37,6.37,0,0,1,56.29,4.6a6.61,6.61,0,0,1,.41,2.31V49.6a7,7,0,0,1-2.13,5,7,7,0,0,1-4.78,1.94H6.91A6.73,6.73,0,0,1,4.37,56,6.78,6.78,0,0,1,.58,52.33,6.62,6.62,0,0,1,0,49.6V6.91A7,7,0,0,1,1.71,2.37L2,2.09A7.1,7.1,0,0,1,4.06.63,7,7,0,0,1,6.91,0ZM73.09,65.26H116a6.87,6.87,0,0,1,3,.67,7,7,0,0,1,2.38,1.88,6.77,6.77,0,0,1,1.16,2,6.66,6.66,0,0,1,.41,2.32v42.69a6.82,6.82,0,0,1-.56,2.69,7,7,0,0,1-1.57,2.28,6.83,6.83,0,0,1-2.22,1.43,6.72,6.72,0,0,1-2.56.51H73.09a7,7,0,0,1-2.55-.5,6.85,6.85,0,0,1-2.2-1.41,7.09,7.09,0,0,1-1.59-2.28,6.76,6.76,0,0,1-.57-2.72V72.18a6.67,6.67,0,0,1,.45-2.43,7,7,0,0,1,1.25-2.12l.28-.28a7,7,0,0,1,2.07-1.45,6.83,6.83,0,0,1,2.86-.64ZM116,72.15H73.09l0,0v42.72c3.68,0,42.89,0,42.93,0,0-3.6,0-42.7,0-42.72ZM6.91,65.26H49.79a6.86,6.86,0,0,1,5.34,2.55,6.37,6.37,0,0,1,1.16,2,6.66,6.66,0,0,1,.41,2.32v42.69a6.82,6.82,0,0,1-.56,2.69,6.69,6.69,0,0,1-1.57,2.28,7,7,0,0,1-4.78,1.94H6.91a6.92,6.92,0,0,1-2.54-.5,6.79,6.79,0,0,1-2.21-1.41,6.91,6.91,0,0,1-1.58-2.28A6.61,6.61,0,0,1,0,114.87V72.18a6.89,6.89,0,0,1,.45-2.43,7.05,7.05,0,0,1,1.26-2.12L2,67.35A6.89,6.89,0,0,1,4.06,65.9a6.82,6.82,0,0,1,2.85-.64Zm42.88,6.89H6.91l0,0,0,42.72c3.67,0,42.89,0,42.92,0,0-3.6,0-42.7,0-42.72ZM73.09,0H116a6.87,6.87,0,0,1,3,.67,7,7,0,0,1,2.38,1.88,6.77,6.77,0,0,1,1.16,2.05,6.61,6.61,0,0,1,.41,2.31V49.6a6.83,6.83,0,0,1-.56,2.7,7.09,7.09,0,0,1-1.57,2.28A7,7,0,0,1,118.53,56a6.91,6.91,0,0,1-2.56.51H73.09A6.78,6.78,0,0,1,70.54,56a7,7,0,0,1-2.2-1.4,7.09,7.09,0,0,1-1.59-2.28,6.78,6.78,0,0,1-.57-2.73V6.91a6.66,6.66,0,0,1,.45-2.42,6.91,6.91,0,0,1,1.25-2.12l.28-.28A7.19,7.19,0,0,1,70.23.63,7,7,0,0,1,73.09,0ZM116,6.89H73.09l0,0V49.63c3.68,0,42.89,0,42.93,0,0-3.6,0-42.71,0-42.72Zm-66.18,0H6.91l0,0,0,42.72c3.67,0,42.89,0,42.92,0,0-3.6,0-42.71,0-42.72Z"/></svg>
                                             </span>
                                             <!--end::Svg Icon-->{{ ucfirst($pc->name_en) }}
                                          </a>
                                          @endforeach
                                          @foreach($brand_name as $bn)
                                          <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                             <span class="svg-icon svg-icon-4 me-1">
                                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.35 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>certified</title><path class="cls-1" d="M46.18,0a9.26,9.26,0,0,1,5.61,1.76C54,3.16,56.45,5.91,59.5,7.65c4.28,2.45,12.22-.93,16.29,5.11,2.37,3.52,2.48,6.28,2.66,9a15.8,15.8,0,0,0,3.72,9.63c5,6.6,6,11,3.45,15.57-1.75,3.11-5.44,4.85-6.29,6.82-1.82,4.2.19,7.37-2.3,12.27a13.05,13.05,0,0,1-7.93,6.78c-3,1-6-.43-8.39.58C56.5,75.19,53.39,79.3,50,80.34a13,13,0,0,1-7.73,0c-3.35-1-6.45-5.15-10.66-6.92-2.4-1-5.4.39-8.39-.58a13,13,0,0,1-7.94-6.78c-2.49-4.9-.48-8.07-2.3-12.27-.85-2-4.54-3.71-6.29-6.82C4.16,42.39,5.2,38,10.19,31.4a15.92,15.92,0,0,0,3.72-9.63c.17-2.73.28-5.49,2.66-9,4.06-6,12-2.66,16.29-5.11,3-1.74,5.51-4.49,7.7-5.88A9.29,9.29,0,0,1,46.18,0ZM89,113.07,77.41,111l-5.73,10.25c-4.16,5.15-6.8-3.31-8-6.26L52.57,94c2.57-.89,5.67-3.47,8.85-6.35,6.35.13,12.27-1,16.62-6.51l12.82,24.75L92,108.22c.87,3.09.41,5.13-3,4.85Zm-85.57,0L15,111l5.73,10.25c4.15,5.15,6.79-3.31,8-6.26L39.78,94c-2.57-.89-5.66-3.47-8.85-6.35-6.35.13-12.27-1-16.62-6.51L1.5,105.85.38,108.22c-.87,3.09-.41,5.13,3,4.85Zm36.13-76.8,4.72,4.45,9.49-9.64c.93-.95,1.52-1.71,2.68-.52l3.76,3.84c1.23,1.22,1.17,1.94,0,3.08L46.38,51c-2.45,2.41-2,2.56-4.51.09l-8.68-8.64a1.09,1.09,0,0,1,.1-1.69l4.36-4.52c.66-.68,1.19-.64,1.87,0Zm6.54-19.34A24.16,24.16,0,1,1,21.91,41.09,24.16,24.16,0,0,1,46.06,16.93Z"/></svg>
                                             </span>
                                             <!--end::Svg Icon-->{{ ucfirst($bn->title_en) }}
                                          </a>
                                          @endforeach
                                       </div>
                                       <!--end::Info-->
                                    </div>
                                    <div class="product_right">
                                       <div class="d-flex align-items-center">
                                          <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                          <!--end::Svg Icon-->
                                          <div class="fs-1 fw-bold counted" data-kt-countup="true" data-kt-countup-value="20" data-kt-countup-prefix="$" data-kt-initialized="1" style="
                                             color: #f6526a;
                                             ">{{ $product->price}}$</div>
                                       </div>
                                       <div class="fw-semibold fs-8 text-gray-700 text-end">( {{$product->total_sample }} )</div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Actions-->
                                    <!--end::Actions-->
                                 </div>
                                 <!--end::Title-->
                                 <!--begin::Stats-->
                                 <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center flex-column mt-3">
                                       <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                          <span class="fw-bold fs-6 text-black-400">Product Description</span>
                                       </div>
                                       <div class="mx-3 w-100 mb-3">
                                          <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                             <span class="fw-semibold fs-6 text-gray-600">{{ucfirst($product->description_en) }}</span>
                                          </div>
                                       </div>
                                    </div>
                                    <!--end::Progress-->
                                 </div>
                                 <!--end::Stats-->
                              </div>
                              <!--end::Info-->
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
</div>    
</div>
</main>
@endsection