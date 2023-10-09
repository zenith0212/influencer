@extends('layouts.admin.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <style>
        .swiper-media .swiper-wrapper .swiper-slide img{
            max-width:100%;
        }

        .swiper-media .swiper-button{
            width: 32px;
            height: 32px;
            border-radius: 100%;
            background: linear-gradient(93.65deg, #FD4524 0%, #F0684B 100%);
            padding: 6px;
            color: #FFFFFF;
        }
        .swiper-media .swiper-button::after {
            font-size: 20px;
        }

        .swiper-media .swiper-button.swiper-button-prev::after {
            margin-right:3px;
        }

        .swiper-media .swiper-button.swiper-button-next::after {
            margin-right:-3px;
        }
    </style>    
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View Product Details</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{ __('products.home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted"> <a href="{{route('products.index')}}" class="text-muted text-hover-primary">{{ __('products.title') }}</a></li>
            </ul>
        </div>
    </div>
</div>
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Thumbnail</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                            @if ( $products->mainImage )
                            <div class="image-input-wrapper w-150px h-150px" style="background-image: url({{  asset("storage/{$product_path}/{$products->id}/{$products->mainImage->image}")}})"></div> @endif                          
                        </div>
                        <div class="text-muted fs-7">{{ucfirst($products->short_description_en)}}</div>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header flex-nowrap">
                        <div class="card-title w-50">
                            <h2>Availability</h2>
                        </div>
                        <div class="card-toolbar w-50">
                            @if($products->is_available == 1)
                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                            <div class="text-muted fs-7 mb-0 ps-2">Available</div>
                            @else
                            <div class="rounded-circle bg-danger w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                            <div class="text-muted fs-7 mb-0 ps-2">Not available</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-header flex-nowrap">
                        <div class="card-title w-50">
                            <h2>Featured</h2>
                        </div>
                        <div class="card-toolbar w-50">
                            @if($products->is_featured == 1)
                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                            <div class="text-muted fs-7 mb-0 ps-2">Featured</div>
                            @else
                            <div class="rounded-circle bg-danger w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                            <div class="text-muted fs-7 mb-0 ps-2">Not featured</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header products-title">
                                    <div class="card-title">
                                        <h2>{{ ucfirst($products->name_en) }}</h2>
                                    </div>
                                    <div class="card-toolbar ">
                                        <span class="fw-bold me-5">Average Rating:</span>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <div class="text-group"> 
                                            <label class="form-label">Keyword :</label>
                                                <p> {{ ucfirst($products->keyword_en) }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <div class="text-group"> 
                                            <label class="form-label">Category :</label>
                                                <p> {{ ucfirst($products->category->name_en) }} </p>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                       <div class="text-group"> 
                                            <label class="form-label">Brand :</label>
                                                <p> {{ ucfirst($products->brand->title_en) }} </p>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                       <div class="text-group"> 
                                            <label class="form-label">Price :</label>
                                                <p> {{ ucfirst($products->price)}}$ </p>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <div class="text-group"> 
                                            <label class="form-label">Total Sample :</label>
                                                <p> {{ $products->total_sample }} </p>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <div class="text-group"> 
                                            <label class="form-label">Description:</label>
                                                <ul>
                                                    <li>{{ ucfirst($products->description_en) }}</li>
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title" >
                                        <h2>Media</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="fv-row mb-2">
                                        <div class="ms-4">
                                           {{--  @if ( $products->images )
                                                @foreach ( $products->images as $image )
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset("storage/{$product_path}/{$products->id}/thumbnails/{$image->thumbnail_image}") }}" alt="{{ $products->name_en }}" />
                                                    </div>
                                                @endforeach
                                         @endif --}}
                                          <div class="swiper swiper-media">
                                                <div class="swiper-wrapper">
                                                      @if ( $products->images )
                                                            @foreach ( $products->images as $image )
                                                                <div class="swiper-slide">
                                                                    <img src="{{ asset("storage/{$product_path}/{$products->id}/thumbnails/{$image->thumbnail_image}") }}" alt="{{ $products->name_en }}" />
                                                                </div>
                                                            @endforeach
                                                     @endif
                                                </div>

                                                <div class="swiper-button-next swiper-button"></div>
                                                <div class="swiper-button-prev swiper-button"></div>
                                          </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer_js') 
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
      <script>
        var swiper = new Swiper(".swiper-media", {
            slidesPerView: 3,
            spaceBetween: 30,
              navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
              },
        });
  </script>
@endsection 