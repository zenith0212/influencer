@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
@section('content')
  <main>
      <!-- Book a Demo section start from here -->
      <section class="bookdemo_section">
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
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="bookdemo_leftwrapper">
                            <h1 class="subbanner-title">
                                Book a
                                <span>Demo</span>
                            </h1>
                            <p class="mb-4 pb-md-1">
                                See how Topbrandmate help you promote sales through influencer marketing.Work with the
                                accurate influencers and create unique content for your brand.Drive more sales and earn
                                more admiration from influencer marketing.
                            </p>
                            <div class="demovideo_wrapper">
                                <img src="{{ asset('assets/images/content/demovideo_img.png') }}" class="img-fluid demovideo_bg"
                                    alt="" />
                                <div class="demovideo_lineinner">
                                    <a href="#">
                                        <img src="{{asset('assets/images/icon/youtube.png')}}" class="img-fluid" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="demobrand_list mb-4 mb-lg-0">
                                <h3 class="mb-3 pb-md-1">See Topbrandmate in Action!</h3>
                                <p class="mb-3 pb-md-1">Learn how Topbrandmate can help you drive sales with influencer
                                    marketing. Book time today to learn how to:</p>
                                <ul>
                                    <li>
                                        <p class="mb-3 pb-md-1">Develop long-term relationships with key influencers and
                                           <br class="d-none d-xl-block"> builders.</p>
                                    </li>
                                    <li>
                                        <p class="mb-3 pb-md-1">Understand the full impact of your influencer programs on
                                            business revenue</p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Activate new acquisition channels to drive growth</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="bookdemo_rightwrapper">
                            <form action="{{ route('store_request_demo') }}" method="post">
                                @csrf
                                <input type="hidden" name="page_type" value="2">
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
        <!-- Book a Demo section end from here -->

    </main>
    @endsection
