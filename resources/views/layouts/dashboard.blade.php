@extends('layouts.index')

@section('style')
@if(Auth::user()->hasRole('Influencer'))
<link rel="stylesheet" type="text/css" href="{{ asset('brand_user/assets/css/bootstrap-extend.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('brand_user/assets/css/simple-icon.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('brand_user/assets/css/color.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('brand_user/assets/css/bootstrap-resposive.css') }} ">
@endif
<style>
    div#activeCampaignList-dashboard_paginate {
        display: none;
    }
    .fs-16 {
        font-size: 16px;
    }
</style>
@endsection
@section('content')
@if(Auth::user()->hasRole('Influencer'))
<main class="main">
    <div class="grey-bg container-fluid">
    <section id="minimal-statistics">
        <div class="row">
        @if(Session::has('msg'))
            <div class="col-12 alert alert-success d-flex justify-content-between align-items-center" role="alert">
                <h2>{{ Session::get('msg') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
       <!--  <div class="col-12 alert alert-success" role="alert">
            {!! Session::has('msg') ? Session::get("msg") : '' !!}
        </div> -->
        @if(empty(Auth::user()->stripe_customer_id))
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show fs-16" role="alert">
                    Please connect your bank account with us to get paid. <a href="{{ route('influencer_payment') }}">Click Here</a>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
            </div>
        @endif
        <div class="col-12 mt-3 mb-1">
            @if(Auth::user()->hasRole('Influencer'))
            <h4 class="text-uppercase">{{ Auth()->user()->name}}'s Dashboard</h4>
            @endif
            <p>Statistics on minimal cards.</p>
        </div>
        </div>
        <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
            <div class="card-content">
                <div class="card-body">
                <div class="media d-flex">
                    <div class="align-self-center">
                    <i class="icon-pencil primary font-large-2 float-left"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3>{{ $active_campaign }}</h3>
                    <span>Active Campaign</span>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('Influencer'))
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
            <div class="card-content">
                <div class="card-body">
                <div class="media d-flex">
                    <div class="align-self-center">
                    <i class="icon-speech warning font-large-2 float-left"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3>{{ $total_campaign }}</h3>
                    <span>Total Campaign</span>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endif
        @if(Auth::user()->hasRole('Influencer'))
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
            <div class="card-content">
                <div class="card-body">
                <div class="media d-flex">
                    <div class="align-self-center">
                    <i class="icon-pointer danger font-large-2 float-left"></i>
                    </div>
                    <div class="media-body text-right">
                    <h3>423</h3>
                    <span>Total Earn</span>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endif
    </div>
</section>
</div>
</main>
@endif
@if(Auth::user()->hasRole('Brand'))
<main class="main">
    <div class="content">
         @if(Session::has('msg'))
        <div class="col-12 alert alert-success" role="alert">
            <h2>{{ Session::get('msg') }}</h2>
        </div>
        @endif
        <div class="container-fluid">
            @if(Auth::user()->hasRole('Brand'))
                <h2 class="section-title">Brand Dashboard</h2>
            @endif
            @if(Auth::user()->hasRole('Influencer'))
                <h2 class="section-title">{{ Auth()->user()->name}}'s Dashboard</h2>
            @endif
            <div class="row dashboard-cards">
                <div class="col-xxl-4 col-lg-6">
                    <div class="card-container primary-card">
                        <div class="dashboard-card">
                            <div class="media">
                                <div class="media-img">
                                    <img src="{{asset('assets/images/icon/dashboard-icon-1.svg')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <span>Total campaign</span>
                                    <h2>{{ $total_campaign }}</h2>
                                </div>
                            </div>
                            <div class="come-out">
                                <p>Since last month</p>
                                <a href="{{ route('brand.campaign.index',['#total-campaign'])}}" class="circle-btn"> Click <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6">
                    <div class="card-container blue-chill-card">
                        <div class="dashboard-card">
                            <div class="media">
                                <div class="media-img">
                                    <img src="{{asset('assets/images/icon/dashboard-icon-2.svg')}}" alt="">
                                </div>

                                <div class="media-body">
                                    <span>Active Campaign</span>
                                    <h2>{{ $active_campaign }}</h2>
                                </div>
                            </div>

                            <div class="come-out">
                                <p>Since last month</p>
                                <a href="{{ route('brand.campaign.index',['#active-campaign'])}}" class="circle-btn"> Click <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-12">
                    <div class="card-container blue-card">
                        <div class="dashboard-card ">
                            <div class="media">
                                <div class="media-img">
                                    <img src="{{asset('assets/images/icon/dashboard-icon-3.svg')}}" alt="">
                                </div>

                                <div class="media-body">
                                    <span>Completed Campaign</span>
                                    <h2>{{ $completed_campaign }}</h2>
                                </div>
                            </div>

                            <div class="come-out">
                                <p>Since last month</p>
                                <a href="{{ route('brand.campaign.index',['#completed-campaign'])}}" class="circle-btn"> Click <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-12">
                    <div class="card-container">
                        <div class="dashboard-chart">
                            <div class="chart-heading">
                                <h3 class="heading">Mail Data</h3>
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <button class="active" id="pills-days-tab" data-bs-toggle="pill" data-bs-target="#pills-days" type="button" role="tab" aria-controls="pills-days" aria-selected="true">7 Days</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="" id="pills-months-tab" data-bs-toggle="pill" data-bs-target="#pills-months" type="button" role="tab" aria-controls="pills-months" aria-selected="false">30 Days</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-days" role="tabpanel" aria-labelledby="pills-days-tab">
                                    <div class="custom-chart">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <ul class="funnel-chart">
                                                    <li>Send Rate: 100%</li>
                                                    <li>95%</li>
                                                    <li>68%</li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-3">
                                                <ul class="chart-lable">
                                                    <li>Send Quantity: 41</li>
                                                    <li>Open Quantity: 39</li>
                                                    <li>Reply Quantity: 28</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-months" role="tabpanel" aria-labelledby="pills-months-tab">
                                    <div class="custom-chart">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <ul class="funnel-chart">
                                                    <li>Send Rate: 100%</li>
                                                    <li>95%</li>
                                                    <li>68%</li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-3">
                                                <ul class="chart-lable">
                                                    <li>Send Quantity: 41</li>
                                                    <li>Open Quantity: 39</li>
                                                    <li>Reply Quantity: 28</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                              </div>
                        </div>


                    </div>
                </div>

                <div class="col-xxl-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-container purple-card">
                                <div class="dashboard-card ">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="{{asset('assets/images/icon/dashboard-icon-4.svg')}}" alt="">
                                        </div>

                                        <div class="media-body">
                                            <span>Influencer Hired</span>
                                            <h2>{{ $hired_influencer_count }}</h2>
                                        </div>
                                    </div>

                                    <div class="come-out">
                                        <p>Since last month</p>
                                        <a href="" class="circle-btn"> Click <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-container west-side-card">
                                <div class="dashboard-card ">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="{{asset('assets/images/icon/dashboard-icon-5.svg')}}" alt="">
                                        </div>

                                        <div class="media-body">
                                            <span>Total Spent</span>
                                            <h2>$10985</h2>
                                        </div>
                                    </div>

                                    <div class="come-out">
                                        <p>Since last month</p>
                                        <a href="" class="circle-btn"> Click <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-container">
                        <h3 class="heading">Top 5 Active Campaign</h3>
                        <div class="table-responsive campaign-list-table list-table">
                            <table class=" display w-100" id="activeCampaignList-dashboard">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Total Products</th>
                                        <th>Total Influencers</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               {{--  <tbody>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <img src="./assets/images/icon/table-product.png" alt="product_img">
                                                <p>Product Name</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                Proposal Pushers
                                            </div>
                                        </td>

                                        <td>
                                            <div class="category-class">
                                                Beauty
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2022
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                100000/50511
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                $100000
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <img src="./assets/images/icon/table-product.png" alt="product_img">
                                                <p>Product Name</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                Proposal Pushers
                                            </div>
                                        </td>

                                        <td>
                                            <div class="category-class">
                                                Beauty
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2022
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                100000/50511
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                $100000
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <img src="./assets/images/icon/table-product.png" alt="product_img">
                                                <p>Product Name</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                Proposal Pushers
                                            </div>
                                        </td>

                                        <td>
                                            <div class="category-class">
                                                Beauty
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2022
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                100000/50511
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                $100000
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <img src="./assets/images/icon/table-product.png" alt="product_img">
                                                <p>Product Name</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                Proposal Pushers
                                            </div>
                                        </td>

                                        <td>
                                            <div class="category-class">
                                                Beauty
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2022
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                08/15/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                100000/50511
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                $100000
                                            </div>
                                        </td>
                                    </tr>
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endif
@endsection
@section('script')
<script>
    let get_campaign            = '{{ route("brand.campaign.getCampaigns") }}';
    let get_active_campaign     = '{{ route("brand.campaign.activeCampaignList") }}';
    let get_completed_campaign  = '{{ route("brand.campaign.completedCampaignList") }}';
    let delete_campaign         = '{{ route("brand.campaign.destroy") }}';
</script>
<script src="{{ asset('brand_campaign/js/index.js') }}"></script>
@endsection
