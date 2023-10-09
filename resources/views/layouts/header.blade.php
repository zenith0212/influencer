<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') Influencer Marketplace</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/media/logos/topfavicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('brand_user/assets/css/common.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('brand_user/assets/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('brand_campaign/vendors/datatable/jquery.dataTables.min.css') }}" />
    {{-- Brand Campaigns CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('brand_user/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('brand_user/assets/css/developing.css') }}">

    @yield('style')
    @include('layouts.window-config')
<body>
    <div class="wrapper">
        <header class="header">
            <nav class="navbar ">
                <div class="container-fluid">
                    <div class="navbar-custom">
                        <div class="navbar-left">
                              <button class="btn d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                                <i class="fa-solid fa-bars"></i>
                              </button>
                        </div>
                        <div class="navbar-right">
                            <ul>
                                <li class="onhover-dropdown notification">
                                @if(Auth::user()->hasRole('Brand'))
                                    <a href="{{ route('brand_activity_log') }}">
                                        <img src="{{ asset('brand_user/assets/images/icon/bell.png') }}" alt="">
                                    </a>
                                @else
                                    <a href="{{ route('influencer_activity_log') }}">
                                        <img src="{{ asset('brand_user/assets/images/icon/bell.png') }}" alt="">
                                    </a>
                                @endif
                                   <!--  <ul class="onhover-dropdown-menu">
                                        <h4>notification</h4>
                                        <li>
                                            <a href="">Lorem ipsum dolor </a>
                                        </li>
                                        <li>
                                            <a href="">Lorem ipsum dolor </a>
                                        </li>
                                        <li>
                                            <a href="">Lorem ipsum dolor </a>
                                        </li>
                                    </ul> -->
                                </li>
                               <!--  <li class="onhover-dropdown notification">
                                    <a href="javascrip:void(0)">
                                        <span>Eng</span> <img src="{{ asset('brand_user//assets/images/flag/eng.png') }}" alt="">
                                    </a>
                                    <ul class="onhover-dropdown-menu">
                                        <li>
                                            <span>Eng</span> <img src="{{ asset('brand_user/assets/images/flag/eng.png') }}" alt="">
                                        </li>
                                        <li>
                                            <span>Eng</span> <img src="{{ asset('brand_user/assets/images/flag/eng.png') }}" alt="">
                                        </li>
                                        <li>
                                            <span>Eng</span> <img src="{{ asset('brand_user/assets/images/flag/eng.png') }}" alt="">
                                        </li>
                                    </ul>
                                </li> -->
                                <li class="onhover-dropdown profile">
                                    @if(Auth::user()->hasRole('Brand'))
                                        <a href="{{ route('brand.profile') }}">
                                        <img src="{{ asset('brand_user/assets/images/icon/user-icon.png') }}" alt="">
                                        <span>{{ auth()->user()->name }} <i class="fas fa-solid fa-chevron-down"></i></span>
                                    </a>
                                    @else
                                        <a href="{{ route('influencer.profile')}}">
                                        <img src="{{ asset('brand_user/assets/images/icon/user-icon.png') }}" alt="">
                                        <span>{{ auth()->user()->name }} <i class="fas fa-solid fa-chevron-down"></i></span>
                                    </a>
                                    @endif

                                    <ul class="onhover-dropdown-menu">
                                        <li>
                                            @if(Auth::user()->hasRole('Brand'))
                                                <a href="{{ route('brand.profile') }}" class="">Profile</a>
                                            @else
                                                <a href="{{ route('influencer.profile')}}" class="">Profile</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="{{ route('billing_details') }}">Billing Detils</a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{!! route('logout') !!}">
                                                @csrf
                                                <a href="{{ route('logout') }}" class="" onclick="event.preventDefault();this.closest('form').submit();">Sign Out</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
