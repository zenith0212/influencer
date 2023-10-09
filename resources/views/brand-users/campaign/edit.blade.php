@extends('layouts.index')
<link rel="stylesheet" href="{{ asset('brand_campaign/vendors/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        .select2-container .select2-dropdown .select2-results ul li >span{
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .select2-container .select2-dropdown .select2-results ul li >span img{
            max-width: 50px;
            border-radius: 100%;
        }

        .select2-container .select2-dropdown .select2-results ul li >span span{
           font-size: 16px;
           color: #0B0B0B;
           line-height: 1.4;
        }

        .select2-container .select2-dropdown .select2-results .select2-results__options .select2-results__option--highlighted.select2-results__option--selectable >span span{
            color: #ffffff;
        }

        .form-group .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__display > span img{
            border-radius: 100%;
        }

        .ui-widget-header {
            background: #3b8790;
        }

        .form-group.custom-selection-group .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            top: 160px;
        }

        .selcted-email ul{
            display: flex;
            padding-left: 30px
        }

        .selcted-email ul li {
            position: relative;
            padding: 18px 20px;
            background: rgba(61, 140, 149, 0.1);
            border-radius: 5px;
            margin-bottom: 0;
            border: 1px solid #aaa;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .selcted-email ul li button{
            right: 0;
            top: 0;
            font-weight: 400;
            font-size: 16px;
            color: #FFFFFF;
            background-color: #FE3912;
            border-radius: 100%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            position: absolute;
        }

        .selcted-email ul li .media {
            align-items: center;
            gap: 10px;
        }

        .selcted-email ul li .media img{
            width: 40px;
            border-radius: 100%;
        }

        .selcted-email ul li .media span{
            font-weight: 400;
            font-size: 16px;
            line-height: 1.4;
            color: rgba(11, 11, 11, 0.7);
            display: inline-block;
        }

        .create-campaign .content form .section-content.section4 .tab-content #pills-home.tab-pane .main-tab-group{
            height: 65vh;
        }

        .refresh-btn{
            margin: auto;
            border: 0;
            display: block;
            background: transparent;
            margin-bottom: 24px;
        }

        .refresh-btn i {
            font-size: 22px;
            color: #f95131;
        }

        .section2.section-content{
            height: 40vh;
        }

        .section2.section-content .primary-btn.rounded-4{
            padding: 19px 20px;
        }
    </style>
@endsection
@section('content')
<main class="create-campaign">
    <div class="container-fluid">
        <div class="content">
            <h3 class="campaing-heading">{{ $title }}</h3>

            <!-- step process -->
            <div class="step-1" id="checkout-progress" data-current-step="1">
                <div class="progress-bar-custom">
                    <div class="step step-1 active">
                        <span> <i class="fa fa-check opaque"></i> </span>
                        <div class="fa fa-check opaque none"></div>
                        <div class="step-label"> Step 1</div>
                    </div>
                    <div class="step step-2">
                        <span> <i class="fa fa-check opaque"></i> </span>
                        <div class="fa fa-check opaque none"></div>
                        <div class="step-label"> Step 2</div>
                    </div>
                    <div class="step step-3">
                        <span> <i class="fa fa-check opaque"></i> </span>
                        <div class="fa fa-check opaque none"></div>
                        <div class="step-label"> Step 3</div>
                    </div>
                    <div class="step step-4">
                        <span> <i class="fa fa-check opaque"></i> </span>
                        <div class="fa fa-check opaque none"></div>
                        <div class="step-label"> Step 4</div>
                    </div>
                </div>
            </div>

            <!-- form section -->
            <form action="" class="edit_campaign_form" enctype="multipart/form-data" method="post" autocomplete="off">
                <input type="hidden" id="hidden_id" name="id" value="{{ $campaignsData->id }}">
                <input type="hidden" id="hidden_step_num" name="step_num" value="">
                 <!-- step-1 section  -->
                <section id="section1" class="section1 section-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_en" class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en', $campaignsData->name_en) }}" placeholder="Title">
                                <p class="text-danger d-none mt-2">Title is required</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- step-2 section  -->
                <section id="section2" class="section2 section-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-items-end">
                                <div class="col-lg-9">
                                    <div class="form-group mb-0">
                                        <label for="link_product" class="form-label">Link Product<span class="text-danger">*</span></label>
                                        <select class="form-select js-example-basic-multiple" id="select_products" name="link_product[]" multiple="multiple">
                                        </select>
                                        <p class="text-danger d-none mt-2 error-product">Product is required</p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('brand.product.create') }}" class="primary-btn rounded-4" id="btn_add_product" target="_blank"> + Add New Product</a>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="refresh-btn d-none" id="btn_refresh" data-toggle="tooltip" data-placement="top" title="Click to get all latest products in Dropdown"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="product-section" style="display: none;">
                            <div class="col-12 my-3">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label for="title" class="form-label">Product Photo</label>
                                            <div class="inputfile-box">
                                                <input type="file" name="product_image" id="product_image" class="inputfile form-control" data-multiple-caption="{count} files selected" multiple />
                                                <label for="product_image">
                                                    <figure>
                                                        <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><path d="m44.333 0h-32.667c-3.0931 0.003705-6.0584 1.2341-8.2455 3.4212s-3.4175 5.1524-3.4212 8.2455v32.667c6.5872e-4 3.0576 1.2062 5.9918 3.3553 8.1667 0.02334 0.0257 0.03267 0.0607 0.05834 0.0863 0.02566 0.0257 0.06066 0.035 0.08633 0.0584 2.1749 2.1491 5.1091 3.3546 8.1667 3.3553h32.667c3.0931-0.0037 6.0584-1.2341 8.2455-3.4212s3.4175-5.1524 3.4212-8.2455v-32.667c-0.0037-3.0931-1.2341-6.0584-3.4212-8.2455s-5.1524-3.4175-8.2455-3.4212zm-39.667 11.667c0-1.8566 0.73749-3.637 2.0502-4.9498 1.3128-1.3128 3.0932-2.0502 4.9498-2.0502h32.667c1.8565 0 3.637 0.73749 4.9498 2.0502 1.3127 1.3128 2.0502 3.0932 2.0502 4.9498v24.701l-10.017-10.017c-0.4375-0.4374-1.0309-0.6831-1.6496-0.6831s-1.2121 0.2457-1.6497 0.6831l-11.184 11.184-4.1836-4.1837c-0.4376-0.4374-1.031-0.6831-1.6497-0.6831s-1.2121 0.2457-1.6497 0.6831l-13.984 13.981c-0.45666-0.9338-0.69598-1.9589-0.7-2.9984v-32.667zm39.667 39.667h-32.667c-1.0395-4e-3 -2.0646-0.2433-2.9984-0.7l12.332-12.334 7.6837 7.6837c0.4414 0.4302 1.0333 0.6709 1.6496 0.6709 0.6164 0 1.2083-0.2407 1.6497-0.6709 0.4374-0.4376 0.6832-1.031 0.6832-1.6497s-0.2458-1.2121-0.6832-1.6496l-1.8503-1.8504 9.534-9.534 11.667 11.667v1.3673c0 1.8565-0.7375 3.637-2.0502 4.9498-1.3128 1.3127-3.0933 2.0502-4.9498 2.0502z" fill="#3D8C95"/><path d="m16.333 23.334c1.3845 0 2.7379-0.4106 3.889-1.1797 1.1511-0.7692 2.0484-1.8624 2.5782-3.1415s0.6684-2.6866 0.3983-4.0444c-0.2701-1.3579-0.9368-2.6052-1.9157-3.5842-0.979-0.9789-2.2263-1.6456-3.5842-1.9157-1.3578-0.2701-2.7653-0.13147-4.0444 0.39834-1.2791 0.52977-2.3723 1.4271-3.1415 2.5782-0.76915 1.1511-1.1797 2.5045-1.1797 3.889 0 1.8565 0.73749 3.637 2.0503 4.9497 1.3127 1.3128 3.0932 2.0503 4.9497 2.0503zm0-9.3333c0.4615 0 0.9126 0.1368 1.2963 0.3932 0.3838 0.2564 0.6828 0.6208 0.8594 1.0472 0.1766 0.4263 0.2228 0.8955 0.1328 1.3481s-0.3123 0.8684-0.6386 1.1947-0.7421 0.5486-1.1947 0.6386-0.9218 0.0438-1.3481-0.1328c-0.4264-0.1766-0.7908-0.4757-1.0472-0.8594s-0.3932-0.8348-0.3932-1.2963c0-0.6189 0.2458-1.2123 0.6834-1.6499s1.0311-0.6834 1.6499-0.6834z" fill="#3D8C95"/></svg>
                                                    </figure>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_name" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_keyword" class="form-label">Product Keyword</label>
                                                    <input type="text" class="form-control" id="product_keyword" name="product_keyword" placeholder="SKU083245">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_category" class="form-label">Product Category</label>
                                                    <select class="form-select js-example-basic-single" name="product-category">
                                                        <option selected>Select Product</option>
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_link" class="form-label">Product Link (Website URL)</label>
                                                    <input type="url" class="form-control" id="product_link" name="product_link"  placeholder="https://www.amazon.in/SIFOJON-Finishing...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title" class="form-label">Product Description</label>
                                    <textarea name="product_description" id="product_description"  name="product_description" placeholder="Type here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- step-3 section  -->
                <section id="section3" class="section3 section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="form-label">Is Sample Video Required?<span class="text-danger">*</span></label>
                                <div class="form-check-row">
                                    <div class="form-check">
                                        <input class="form-check-input check-only-one-sample-video" name="is_sample_required" type="checkbox" value="1" id="flexCheckDefault" {{ old('is_sample_required', $campaignsData->is_sample_required) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                             Yes
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input check-only-one-sample-video" name="is_sample_required" type="checkbox" value="0" id="flexCheckChecked" {{ old('is_sample_required', $campaignsData->is_sample_required) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked">
                                              No
                                        </label>
                                      </div>
                                </div>
                                <p class="text-danger d-none mt-2 error-sample-video">Sample video is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fan-volumes" class="form-label">Fan Volumes<span class="text-danger">*</span></label>
                                <select class="form-select js-example-basic-single" id="fan_volumes" name="fan_volumes">
                                    <option value="" selected>Select Fan Valumes</option>
                                    <option value="1000-10000" {{ old('fan_volumes', $campaignsData->min_fans."-".$campaignsData->max_fans) == "1000-10000" ? 'selected' : '' }}>1k-10k</option>
                                    <option value="10000-50000" {{ old('fan_volumes', $campaignsData->min_fans."-".$campaignsData->max_fans) == "10000-50000" ? 'selected' : '' }}>10k-50k</option>
                                    <option value="50000-100000" {{ old('fan_volumes', $campaignsData->min_fans."-".$campaignsData->max_fans) == "50000-100000" ? 'selected' : '' }}>50k-100k</option>
                                    <option value="100000-200000" {{ old('fan_volumes', $campaignsData->min_fans."-".$campaignsData->max_fans) == "100000-200000" ? 'selected' : '' }}>100k-200k</option>
                                    <option value="200000-500000" {{ old('fan_volumes', $campaignsData->min_fans."-".$campaignsData->max_fans) == "200000-500000" ? 'selected' : '' }}>200k-500k</option>
                                    <option value="500000-1000000" {{ old('fan_volumes', $campaignsData->min_fans."-".$campaignsData->max_fans) == "500000-1000000" ? 'selected' : '' }}>500k-1m</option>
                                </select>
                                <p class="text-danger d-none mt-2 error-fan-volume">Fan volume is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="1000" value="{{ old('amount', $campaignsData->amount) }}">
                                <p class="text-danger d-none mt-2">Amount is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_influencers_required" class="form-label">Total Influencer Required<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="total_influencers_required" name="total_influencers_required" placeholder="10" value="{{ old('total_influencers_required', $campaignsData->total_influencers_required) }}">
                                <p class="text-danger d-none mt-2">Total influancer is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="budget_for_each_influencer" class="form-label">Budget for each Influencer<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="budget_for_each_influencer" name="budget_for_each_influencer" placeholder="1000" value="{{ old('budget_for_each_influencer', $campaignsData->budget_for_each_influencer) }}" readonly>
                                <p class="text-danger d-none mt-2">Budget for influancer is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Campaign Thumbnail<span class="text-danger">*</span></label>
                                        <div class="inputfile-box">
                                            <input type="file" name="image" id="image" class="inputfile form-control" accept="image/*"/>
                                            <label for="image">
                                                <figure>
                                                    <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><path d="m44.333 0h-32.667c-3.0931 0.003705-6.0584 1.2341-8.2455 3.4212s-3.4175 5.1524-3.4212 8.2455v32.667c6.5872e-4 3.0576 1.2062 5.9918 3.3553 8.1667 0.02334 0.0257 0.03267 0.0607 0.05834 0.0863 0.02566 0.0257 0.06066 0.035 0.08633 0.0584 2.1749 2.1491 5.1091 3.3546 8.1667 3.3553h32.667c3.0931-0.0037 6.0584-1.2341 8.2455-3.4212s3.4175-5.1524 3.4212-8.2455v-32.667c-0.0037-3.0931-1.2341-6.0584-3.4212-8.2455s-5.1524-3.4175-8.2455-3.4212zm-39.667 11.667c0-1.8566 0.73749-3.637 2.0502-4.9498 1.3128-1.3128 3.0932-2.0502 4.9498-2.0502h32.667c1.8565 0 3.637 0.73749 4.9498 2.0502 1.3127 1.3128 2.0502 3.0932 2.0502 4.9498v24.701l-10.017-10.017c-0.4375-0.4374-1.0309-0.6831-1.6496-0.6831s-1.2121 0.2457-1.6497 0.6831l-11.184 11.184-4.1836-4.1837c-0.4376-0.4374-1.031-0.6831-1.6497-0.6831s-1.2121 0.2457-1.6497 0.6831l-13.984 13.981c-0.45666-0.9338-0.69598-1.9589-0.7-2.9984v-32.667zm39.667 39.667h-32.667c-1.0395-4e-3 -2.0646-0.2433-2.9984-0.7l12.332-12.334 7.6837 7.6837c0.4414 0.4302 1.0333 0.6709 1.6496 0.6709 0.6164 0 1.2083-0.2407 1.6497-0.6709 0.4374-0.4376 0.6832-1.031 0.6832-1.6497s-0.2458-1.2121-0.6832-1.6496l-1.8503-1.8504 9.534-9.534 11.667 11.667v1.3673c0 1.8565-0.7375 3.637-2.0502 4.9498-1.3128 1.3127-3.0933 2.0502-4.9498 2.0502z" fill="#3D8C95"/><path d="m16.333 23.334c1.3845 0 2.7379-0.4106 3.889-1.1797 1.1511-0.7692 2.0484-1.8624 2.5782-3.1415s0.6684-2.6866 0.3983-4.0444c-0.2701-1.3579-0.9368-2.6052-1.9157-3.5842-0.979-0.9789-2.2263-1.6456-3.5842-1.9157-1.3578-0.2701-2.7653-0.13147-4.0444 0.39834-1.2791 0.52977-2.3723 1.4271-3.1415 2.5782-0.76915 1.1511-1.1797 2.5045-1.1797 3.889 0 1.8565 0.73749 3.637 2.0503 4.9497 1.3127 1.3128 3.0932 2.0503 4.9497 2.0503zm0-9.3333c0.4615 0 0.9126 0.1368 1.2963 0.3932 0.3838 0.2564 0.6828 0.6208 0.8594 1.0472 0.1766 0.4263 0.2228 0.8955 0.1328 1.3481s-0.3123 0.8684-0.6386 1.1947-0.7421 0.5486-1.1947 0.6386-0.9218 0.0438-1.3481-0.1328c-0.4264-0.1766-0.7908-0.4757-1.0472-0.8594s-0.3932-0.8348-0.3932-1.2963c0-0.6189 0.2458-1.2123 0.6834-1.6499s1.0311-0.6834 1.6499-0.6834z" fill="#3D8C95"/></svg>
                                                </figure>
                                                <span></span>
                                            </label>
                                        </div>
                                        <p class="text-danger d-none mt-2 error-thumbnail">Thumbnail is required</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <img class="w-100 rounded" id="preview_image" src="{{ !empty($campaignsData->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$campaignsData->thumbnail_image : $defaultImgUrl }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="live-stream" class="form-label">Live stream or Url<span class="text-danger">*</span></label>
                                <div class="form-check-row d-block">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input check-only-one-live-streaming" name="is_video" type="checkbox" value="1" id="normal" {{ old('is_video', $campaignsData->is_video) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="normal">
                                             Normal
                                        </label>
                                      </div>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input check-only-one-live-streaming" name="is_video" type="checkbox" value="2" id="video" {{ old('is_video', $campaignsData->is_video) == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="video">
                                              Video
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input check-only-one-live-streaming" name="is_video" type="checkbox" value="3" id="live_streaming" {{ old('is_video', $campaignsData->is_video) == 3 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="live_streaming">
                                              Live Streaming
                                        </label>
                                      </div>
                                </div>
                                <p class="text-danger d-none mt-2 error-live-stream">Live stream is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="application_till_date" class="form-label">Application Accept or Reject Till Date<span class="text-danger">*</span></label>
                                <input type="text" id="application_till_date" name="application_till_date" value="{{ old('application_till_date', $campaignsData->application_till_date) }}" class="form-control floating-label" placeholder="04/20/2023">
                                <p class="text-danger d-none mt-2">Till date is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="form-label">Target platform</label>
                                <div class="form-check-row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="tikTok-check" checked disabled>
                                        <label class="form-check-label" for="tikTok-check">
                                            <i class="fa-brands fa-tiktok ms-2"></i>  TikTok
                                        </label>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="target_region" class="form-label">Target region<span class="text-danger">*</span></label>
                                <select class="form-select js-example-basic-single" id="target_region" name="target_region">
                                    <option value="" selected>Select Region</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->code }}" {{ old('target_region', $campaignsData->target_region) == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger d-none mt-2 error-target-region">Region is required</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="title" class="form-label">Terms and Conditions<span class="text-danger">*</span></label>
                                <textarea name="terms_and_condition_en" id="terms_and_condition_en" rows="10" cols="10" >{{ $campaignsData->terms_and_condition_en }}</textarea>
                                <input type="hidden" name="hidde_tc" id="hidde_tc" value="{{ $campaignsData->terms_and_condition_en }}">
                                <p class="text-danger d-none mt-2 error-terms-condition">Terms and condition is required</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="promote" class="form-label">Promote</label>
                                <input type="text" class="form-control" id="promote" name="promote" placeholder="Promote" value="{{ old('promote', $campaignsData->promote) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="traceable_link" class="form-label">Traceable Link<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="traceable_link" name="traceable_link" placeholder="https://www.google.com" value="{{ old('traceable_link', $campaignsData->traceable_link) }}">
                                <p class="text-danger d-none mt-2">Enter valid link like: https://www.google.com</p>
                                <p class="text-danger d-none mt-2 error-traceable-link">Traceable link is required</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label  class="form-label">On going Campaign?<span class="text-danger">*</span></label>
                                <div class="form-check-row">
                                    <div class="form-check">
                                        <input class="form-check-input check-only-one-on-going" name="campaign_is_active" type="checkbox" value="1" id="ongoing_yes" {{ old('campaign_is_active', $campaignsData->campaign_is_active) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ongoing_yes">
                                             Yes
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input check-only-one-on-going" name="campaign_is_active" type="checkbox" value="0" id="ongoing_no" {{ old('campaign_is_active', $campaignsData->campaign_is_active) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ongoing_no">
                                              No
                                        </label>
                                      </div>
                                </div>
                                <p class="text-danger d-none mt-2 error-on-going">Fan volume is required</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="application_start_date" class="form-label">Campaign Start Date<span class="text-danger">*</span></label>
                                <input type="text" id="application_start_date" name="application_start_date" value="{{ old('application_start_date', $campaignsData->application_start_date) }}" class="form-control floating-label" placeholder="Start Date">
                                <p class="text-danger d-none mt-2">Start date is required</p>
                            </div>
                        </div>
                        @if($campaignsData->campaign_is_active == 0)
                            <div class="col-lg-4 campaign-end-date-portion">
                                <div class="form-group">
                                    <label for="application_end_date" class="form-label">Campaign End Date<span class="text-danger">*</span></label>
                                    <input type="text" id="application_end_date" name="application_end_date" value="{{ old('application_end_date', $campaignsData->application_end_date) }}" class="form-control floating-label" placeholder="End Date">
                                    <p class="text-danger d-none mt-2">End date is required</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- step-4 section  -->
                <section id="section4" class="section4 section-content">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Invite by Email</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Direct Add</button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="main-tab-group">
                                                <div class="form-group custom-selection-group">
                                                    <label for="add-influencer" class="form-label">Add Influencer</label>
                                                    <select class="form-select" id="add_influencer" name="add_influencer[]" multiple="multiple">
                                                    </select>
                                                </div>

                                                {{-- Custom design for already added scrap users --}}
                                                <div class="selcted-email">
                                                    <ul>
                                                        @if (count($campScrapUsers) > 0)
                                                            @foreach ($campScrapUsers as $campScrapUser)
                                                                @if (!empty($campScrapUser->influencer_record))
                                                                    <li class="li-section-{{ $campScrapUser->id }} me-5">
                                                                        <button type="button" onclick="removeInfluancer({{ $campScrapUser->campaign_id }}, {{ $campScrapUser->influencer_id }}, {{ $campScrapUser->id }})">x</button>
                                                                        <div class="media">
                                                                            <img class="img-flag" src="{{ $campScrapUser->influencer_record->media_profile }}"> <span>{{ $campScrapUser->influencer_record->nickname }}</span>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="col-12">
                                        <div class="main-tab-group">
                                            <div class="form-group">
                                                <label for="add-emails" class="form-label">Add Emails</label>
                                                <select class="form-select js-example-basic-multiple" id="add_emails" name="add_emails[]" multiple="multiple">
                                                    @foreach ($allInfluencerUser as $influencerUser)
                                                        <option {{ in_array($influencerUser->id, $campOldUserId) ? 'selected' : '' }} value="{{ $influencerUser->id }}">{{ $influencerUser->email }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- button  -->
                <div class="button-container">
                    <button type="button" class="steps-btn btn-prev disabled"> <div><i class="fa-solid fa-chevron-left"></i> <i class="fa-solid fa-chevron-left"></i></div> <span>Previous</span></button>
                    <button type="button" class="steps-btn btn-next"> <span>Next</span> <div><i class="fa-solid fa-chevron-right"></i><i class="fa-solid fa-chevron-right"></i></div></button>
                    <button type="button" class="steps-btn btn-submit" style="display:none;"> <span>Save</span> </button>
                </div>
            </form>

        </div>
    </div>

    <footer></footer>
</main>
@endsection

@section('script')
<script>
    let update_route    = "{{ route('brand.campaign.update')}}";
    let api_url         = "{{ route('brand.campaign.search_influencer') }}";
    let min_price       = "{{ $campaignsData->min_price }}";
    let max_price       = "{{ $campaignsData->max_price }}";
    let delete_inf      = "{{ route('brand.campaign.delete_old_influencer')}}";
    let all_products    = "{{ route('brand.campaign.all_products') }}";
    let oldProdIdArr    = {!! json_encode($campProdId) !!};
    let sysUserCount    = "{{ count($campOldUserId) }}";
    let scrapUserCount  = "{{ $campScrapUsers->count() }}";
</script>
<script src="{{ asset('brand_campaign/vendors/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('brand_campaign/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('brand_campaign/js/edit-campaign.js') }}"></script>
@endsection
