@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
@section('content')
  <main class="white-bg"  >
        <!-- banner section  -->
        <section class="contact-banner-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-7">
                        <div class="banner-content">
                            <h1 class="section-title">
                                Reach Out to
                                <span>Us</span>
                            </h1>
                            <p>We are all ready now to connect with customers and deal with all your confusions about the platform. Our mission is to provide business growth for all customers. Feel free to send us a message</p>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="banner-img">
                            <svg width="171" height="150" viewBox="0 0 171 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.25">
                                <path d="M160.017 112.914C176.509 89.7747 173.988 58.073 151.462 37.4227C141.17 27.9877 128.049 22.114 113.875 20.4737C113.787 20.3634 113.695 20.2569 113.598 20.1543C101.267 7.346 83.5527 0 64.996 0C29.683 0 0 26.311 0 60C0 71.8117 3.669 83.1347 10.6387 92.9137L0.902333 123.482C0.602978 124.422 0.588135 125.429 0.85967 126.377C1.1312 127.325 1.67699 128.171 2.42838 128.81C3.17977 129.448 4.10321 129.851 5.08255 129.966C6.06188 130.081 7.05338 129.904 7.93233 129.457L37.5413 114.401C43.622 117.019 50.07 118.737 56.7473 119.519C69.628 133.064 87.4383 140 105.66 140C115.132 140 124.57 138.07 133.113 134.401L162.724 149.457C163.425 149.814 164.201 150 164.989 150C168.363 150 170.782 146.712 169.754 143.482L160.017 112.914ZM39.5593 104.34C38.8685 104.012 38.1116 103.847 37.3469 103.857C36.5822 103.868 35.83 104.053 35.1483 104.4L14.0593 115.123L20.946 93.5013C21.193 92.726 21.247 91.9021 21.1034 91.1012C20.9597 90.3003 20.6227 89.5465 20.1217 88.9053C13.4997 80.4287 9.99933 70.4337 9.99933 60C9.99933 32.43 34.6707 10 64.996 10C77.208 10 88.9643 13.6997 98.5007 20.362C66.3847 23.5913 40.664 48.676 40.664 80C40.664 89.7427 43.1613 99.122 47.8697 107.525C45.0219 106.679 42.2435 105.614 39.5593 104.34ZM135.508 124.4C134.826 124.053 134.074 123.867 133.309 123.857C132.544 123.847 131.787 124.012 131.097 124.34C123.302 128.043 114.506 130 105.66 130C75.3347 130 50.6633 107.57 50.6633 80C50.6633 52.43 75.3347 30 105.66 30C135.985 30 160.657 52.43 160.657 80C160.657 90.4337 157.156 100.429 150.534 108.905C150.033 109.546 149.696 110.3 149.553 111.101C149.409 111.902 149.463 112.726 149.71 113.501L156.596 135.123L135.508 124.4Z" fill="#3D8C95"/>
                                <path d="M85.3281 85C88.0895 85 90.3281 82.7614 90.3281 80C90.3281 77.2386 88.0895 75 85.3281 75C82.5667 75 80.3281 77.2386 80.3281 80C80.3281 82.7614 82.5667 85 85.3281 85Z" fill="#3D8C95"/>
                                <path d="M105.327 85C108.089 85 110.327 82.7614 110.327 80C110.327 77.2386 108.089 75 105.327 75C102.566 75 100.327 77.2386 100.327 80C100.327 82.7614 102.566 85 105.327 85Z" fill="#3D8C95"/>
                                <path d="M125.326 85C128.088 85 130.326 82.7614 130.326 80C130.326 77.2386 128.088 75 125.326 75C122.565 75 120.326 77.2386 120.326 80C120.326 82.7614 122.565 85 125.326 85Z" fill="#3D8C95"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Chat with the team section start from here -->
        <section class="contact-section section-top-space section-bottom-space">
            <div class="container">
                @if(session()->has('success'))
                    <div class="col-12 alert alert-success d-flex justify-content-between align-items-center" role="alert">
                        <h2>{{ session()->get('success') }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="col-12 alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                        <h2>{{ session()->get('error') }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-6 col-xl-6 order-1 order-lg-0">
                        <div class="left-wrapper">
                            <div class="heading_intro">
                                <h3>Chat with the team</h3>
                            </div>
                            <img src="{{asset('assets/images/content/contact-img.png')}}" alt="">
                            <p>We Welcome Comments, Suggestions, and questions</p>
                            <ul>
                                <li><span>Press: </span> <a href="mailto:press@topbrandmate.com">press@topbrandmate.com</a></li>
                                <li><span>Support: </span> <a href="mailto: support@topbrandmate.com">support@topbrandmate.com</a></li>
                            </ul>

                            <p>Learn how Topbrandmate can help you drive sales with influencer marketing. Book time today to learn how.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="form-wrapper">
                            <form action="{{ route('store_request_demo') }}" method="post">
                                @csrf
                                <input type="hidden" name="page_type" value="1">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control input-control" placeholder="First Name" required/>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control input-control" placeholder="Last Name" required/>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Country</label>
                                        <select name="country" class="form-control input-control">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Email Address</label>
                                        <input type="email" name="email" class="form-control input-control" placeholder="Email Address" required/>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control input-control" placeholder="Company Name" />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Phone Number</label>
                                        <input type="number" name="phone_number" class="form-control input-control" placeholder="Phone Number" required/>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Main Business</label>
                                        <input type="text" name="main_bussiness" class="form-control input-control" placeholder="Main Business" />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 pb-lg-4">
                                        <label class="form-label input-label">Product Category</label>
                                        <select name="category_id" class="form-control input-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 pb-lg-4">
                                        <label class="form-label input-label">Company Scale</label>
                                        <input type="text" name="company_scale" class="form-control input-control" placeholder="Company Scale" />
                                        {{-- <select name="company_scale" class="form-control input-control">
                                            <option value="1 - 50">1 - 50</option>
                                            <option value="51 - 200">51 - 200</option>
                                            <option value="201 - 500">201 - 500</option>
                                            <option value="> 500">> 500</option>
                                        </select> --}}
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <button class="primary-btn w-100 justify-content-center">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Chat with the team section end from here -->

        <section class="section-top-space our-location-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-5 order-1 order-lg-0">
                        <div class="location-imgs">
                            <img src="{{asset('assets/images/content/contact-map.png')}}" alt="">
                            <img src="{{asset('assets/images/content/location_2.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="location-content">
                            <div class="location-inner-content">
                                <h3 class="section-heading">Our <span>Locations</span></h3>
                                <p>We are a fully distributed remote bunch but you can also visit at our HQs.</p>
                            </div>

                            <img src="{{asset('assets/images/content/location_1.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
