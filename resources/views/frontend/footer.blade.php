  <footer class="footer">
        <!-- news latter  -->
        <div class="news-latter">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="news-latter-content">
                            <img src="{{asset('assets/frontend/images/home/news-latter-shape.png')}}" alt="">
                            <h3>Find & hire influencers for your brand.</h3>
                            <p>You are just few clicks away to get your perfect influencers for your brands. We offer
                                you the best price for your influencer need.</p>
                            <div class="input-group">
                                <input type="text" class="" placeholder="Work Email">
                                <button>Get started </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="join-with-us section-bottom-space section-top-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 text-center m-auto">
                        <h2 class="section-title">Join Millions of
                            Creative Influencers with Topbrandmate</h2>
                        <a href="" class="primary-btn">Join Us</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="main-footer section-top-space">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-contact">
                            <a href="index.html" class="d-flex align-items-center logo">
                                <img src="{{asset('assets/frontend/images/logo.png')}}" alt="logo_img">
                            </a>
                            <p>
                                We committed to serving brand advertisers and influencers, using strong technical
                                capabilities to provide users with services such as influencer discovery, influencer
                                depth data analysis and effect...
                            </p>
                            <a href="" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="footer-links">
                            <h5>Platform</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="#" class="">Find
                                        Influencers</a></li>
                                <li class="nav-item"><a href="#" class="">Campaign
                                        Management</a></li>
                                <li class="nav-item"><a href="{{route('comingsoon')}}" class="">Livestream</a>
                                </li>
                                <li class="nav-item"><a href="{{route('comingsoon')}}" class="">Measure ROI</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="footer-links">
                            <h5>Company</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="{{ route('aboutUs') }}" class="">About Us</a></li>
                                <li class="nav-item"><a href="{{route('whatIsTopBrandMate')}}" class="">What’s
                                        Topbrandmate</a></li>
                                <li class="nav-item"><a href="{{ route('whyTopBrandMate')}}" class="">Why
                                        Topbrandmate</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <div class="footer-links">
                            <h5>Contact</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="{{route('contactUs')}}" class="">Contact Us</a>
                                </li>
                                <li class="nav-item"><a href="{{ route('requestDemo') }}" class="">Request Demo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="copyright">
                    <p>© 2023 Topbrandmate, All rights reserved</p>
                    <ul class="list-unstyled">
                        <li class=""><a class="" href="{{ route('termsOfService')}}">
                                Terms of Service
                            </a></li>
                        <li class="ms-4 ps-4 border-start"><a class="" href="{{ route('privacy') }}">Privacy</a></li>

                    </ul>

                    <ul class="social-icon ">
                        <li>
                             <a href="" class="icon-box"><img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt=""></a>
                        </li>
                        <li>
                             <a href="" class="icon-box"><img src="{{asset('assets/frontend/images/icon/insta.png')}}" alt=""></a>
                        </li>
                        <li>
                             <a href="" class="icon-box"><img src="{{asset('assets/frontend/images/icon/facebook.png')}}" alt=""></a>
                        </li>
                        <li>
                             <a href="" class="icon-box"><img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt=""></a>
                        </li>
                        <li>
                             <a href="" class="icon-box"><img src="{{asset('assets/frontend/images/icon/twitter.png')}}" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('assets/frontend/vendors/jquery/jquery-3.6.4.min.js')}}"></script>
    <script src="{{asset('assets/frontend/vendors/bootstrap/bootstrap.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="{{asset('assets/frontend/js/script.js')}}"></script>
</body>
</html>
