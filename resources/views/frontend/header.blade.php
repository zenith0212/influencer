<head>
   <!--  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta charset="UTF-8">
    @yield('meta_content')
    <title>Influencer Marketplace</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend/images/icon/favicon.png')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/vendors/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/subscription.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}"> --}}

    @yield('style')
    <body>
     <header id="header-container" class="header">
        <nav class="navbar navbar-expand-xxl">
            <div class="container-fluid">
                <div class="nav-main">
                    <a class="navbar-brand p-0 m-0" href="{{route('welcome')}}">
                        <img src="{{asset('assets/frontend/images/logo.png')}}" alt="">
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <form class="d-none d-xxl-flex">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search">
                            <button type="submit"><i class="fas fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Influencer</a>
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Influencer
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul> --}}
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Campaign</a>
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Campaign
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>

                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul> --}}
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('comingsoon')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Livestream
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>

                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('comingsoon')}}">Livestream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('pricing')}}">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('joinus')}}">Join Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contactUs')}}">Contact Us</a>
                            </li>

                        </ul>
                    </div>

                    <div class="dropdown lang-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="lang-dropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/frontend/images/flag/eng.png')}}" alt="">
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="lang-dropdown">
                            <li><a class="dropdown-item" href="#"> <img src="{{asset('assets/frontend/images/flag/eng.png')}}" alt="">
                                    English</a></li>
                            <li><a class="dropdown-item" href="#"> <img src="{{asset('assets/frontend/images/flag/fr.png')}}" alt="">
                                    French</a></li>
                        </ul>
                    </div>

                    <div class="login-btn">
                        <a href="{{route('login')}}" class="primary-btn"><i class="fa-solid fa-user"></i>  <span class="">SignIn</span>   </a>
                    </div>

                </div>
            </div>
        </nav>
    </header>
