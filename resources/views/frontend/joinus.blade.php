@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
@section('content')

 <main>
        <!-- banner section  -->
        <section class="join-banner-section">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-6">
                        <div class="banner-content">
                            <h1 class="banner-title">
                                Topbrandmate are actively recruiting <span>brand</span> and <span>influencer</span> agents
                            </h1>
                            <p>We accompany you to discover more potential in cross border influencer marketing</p>
                            <a href="" class="primary-btn">Join in</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-img">
                            <img src="{{asset('/assets/images/content/join-banner-img.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <section class="topbrandmate-agent-section section-bottom-space section-top-space bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="section-title">Be <span>Topbrandmate’s</span> agent to seize influencer marketing traffic and high profit</h2>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-5">
                        <div class="topbrandmate-agent-img">
                            <img src="{{asset('/assets/images/content/topbrandmate-agent-img.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="topbrandmate-agent-content">
                            <article>
                                <img src="{{asset('/assets/images/icon/agent-icon-1.svg')}}" alt="">
                                <div class="article-body">
                                    <h6>Get multiple income as an agent</h6>
                                    <p>Commission from brands/influencers based on your efforts</p>
                                </div>
                            </article>
                            <article>
                                <img src="{{asset('/assets/images/icon/agent-icon-2.svg')}}" alt="">
                                <div class="article-body">
                                    <h6>Find more profit from video/livestream
                                        e-commerce</h6>
                                    <p>Link influences and brands to create contents in different methods</p>
                                </div>
                            </article>
                            <article>
                                <img src="{{asset('/assets/images/icon/agent-icon-3.svg')}}" alt="">
                                <div class="article-body">
                                    <h6>Seize the opportunity of influencer marketing</h6>
                                    <p>Topbrandmate focus on influencer e-commerce and make great success</p>
                                </div>
                            </article>
                            <a href="" class="primary-btn">Join in</a>
                        </div>
                    </div>
                </div>
            </div>
       </section>

       <section class="application-process-section section-bottom-space section-top-space">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="section-title">Application Process</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="process-steps step-1">
                            <div class="step-img">
                                <img src="{{asset('/assets/images/icon/process-1.svg')}}" alt="">
                            </div>
                            <b>Submit application</b>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="process-steps step-2">
                            <div class="step-img">
                                <img src="{{asset('/assets/images/icon/process-2.svg')}}" alt="">
                            </div>
                            <b>Manual review</b>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="process-steps step-2">
                            <div class="step-img">
                                <img src="{{asset('/assets/images/icon/process-3.svg')}}" alt="">
                            </div>
                            <b>Negotiate plan</b>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="process-steps step-4">
                            <div class="step-img">
                                <img src="{{asset('/assets/images/icon/process-4.svg')}}" alt="">
                            </div>
                            <b>Cooperation</b>
                        </div>
                    </div>
                </div>
            </div>
       </section>

       <section class="agent-form-section section-bottom-space section-top-space bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="heading_intro text-center">
                            <h2>Join us now to be <span>Topbrandmate’s</span> agent</h2>
                        </div>
                        {{-- Success error messages --}}
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
                        <div class="form-wrapper">
                            <form action="{{ route('store_joinus') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Agent product</label>
                                        <select class="form-select input-control" name="product_id">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name_en }}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    <div class="col-lg-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Name</label>
                                        <input type="text" class="form-control input-control" placeholder="Name" name="name" required/>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Work email</label>
                                        <input type="email" class="form-control input-control" placeholder="Work email" name="work_email" required/>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Phone Number</label>
                                        <input type="number" class="form-control input-control" placeholder="Phone Number" name="phone_no" required/>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Company Name</label>
                                        <input type="text" class="form-control input-control" placeholder="Company Name" name="company_name" />
                                    </div>
                                    <div class="col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">Company scale</label>
                                        <input type="text" class="form-control input-control" placeholder="Company scale" name="company_scale" />
                                    </div>
                                    <div class="col-lg-6 col-xl-6 mb-4 pb-lg-3">
                                        <label class="form-label input-label">How you know Topbrandmate</label>
                                        <input type="text" class="form-control input-control" placeholder="How you know Topbrandmate" name="how_know_topbrandmate" />
                                    </div>
                                    <div class="col-lg-12 mb-4 pb-lg-4">
                                        <label class="form-label input-label">Company introduction</label>
                                        <textarea class="form-control input-control" placeholder="Company introduction" name="company_introduction" ></textarea>
                                    </div>

                                    <div class="col-lg-12 col-xl-12 text-center">
                                        <button class="primary-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </section>
    </main>
@endsection
