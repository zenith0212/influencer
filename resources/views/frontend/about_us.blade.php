@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
<style>
  .about-banner-section .joined-brands-influencer {
    background-image: url("assets/images/about-us/about-us-banner-shape.png") !important; 
}

.about-banner-section {
  background-image: url("assets/images/about-us/about-us-background.jpg") !important;
}

.about-cta .about-cta-main {
  background-image: url("assets/images/about-us/about-cta.jpg") !important;
}
</style>
@section('content')
 <main>
        <!-- banner section  -->
        <section class="about-banner-section">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-6">
                        <div class="banner-content">
                            <h1 class="banner-title">
                                About Our Company <br>   
                                <span>Topbrandmate </span>
                            </h1>
                            <p>Founded in 2021, our company mainly focus on TikTok marketing.</p>
                            <p>We committed to serving brand advertisers and influencers, using strong technical capabilities to provide users with services such as influencer discovery, influencer depth data analysis and effect monitoring.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-img">
                            <img src="{{asset('assets/images/about-us/about-us-banner.png')}}" alt="">
                        </div>
                    </div>

                  
                    <div class="joined-brands-influencer">
                        <h3>15k+</h3>
                        <h6>Influencers & Brands</h6>
                        <span>Lorem ipsum dolor sit amet consectetur. Turpis scelerisque metus enim ornare quam ac nibh. </span>
                    </div>
                    
                </div>
            </div>
            
        </section>

        <!-- team-grupt photw -->
        <div class="team-group section-top-space white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <img src="{{asset('assets/images/about-us/team-grroup.png')}}" class="rounded" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- influencer-marketing -->
        <section class="long-term-section section-top-space white-bg">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-5 order-1 order-lg-0">
                        <div class="about-content-img">
                            <img src="{{asset('assets/images/about-us/long-term.png')}}" alt="">
                        </div>
                    </div>
        
                    <div class="col-lg-6 order-0 order-lg-1">
                        <div class="about-content">
                            <h3 class="section-heading">Long-Term Friendly Partner
                                of <span>TikTok</span></h3>
                            <p>We have already been a long-term friendly partner of TikTok ads for busniess, and have provided TikTok advertising services for lots of merchants and achieved excellent results.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>  

        <section class="best-brand-section section-top-space white-bg">
            <div class="container">
                <div class="row align-items-center justify-content-between ">
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h3 class="section-heading">Best Marketing Services
                                For <span>Brands.</span></h3>
                            <p>We have already been a long-term friendly partner of TikTok ads for busniess, and have provided TikTok advertising services for lots of merchants and achieved excellent results.</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 ">
                        <div class="about-content-img">
                            <img src="{{asset('assets/images/about-us/best-brand.png')}}" alt="">
                        </div>
                    </div>
        
                    
                </div>
            </div>
        </section>  

        <section class="our-mission-section section-top-space section-bottom-space white-bg">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-5 order-1 order-lg-0">
                        <div class="about-content-img">
                            <img src="{{asset('assets/images/about-us/our-mission.png')}}" alt="">
                        </div>
                    </div>
        
                    <div class="col-lg-6 order-0 order-lg-1">
                        <div class="about-content">
                            <h3 class="section-heading"> Our <span>Mission.</span></h3>
                            <p>We have already been a long-term friendly partner of TikTok ads for busniess, and have provided TikTok advertising services for lots of merchants and achieved excellent results.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>  

        <section class="who-are-section section-top-space section-bottom-space">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 order-1 order-lg-0">
                        <div class="about-content-img">
                            <img src="{{asset('assets/images/about-us/who-we-are.png')}}" alt="">
                        </div>
                    </div>
        
                    <div class="col-lg-5 order-0 order-lg-1">
                        <div class="about-content">
                            <h3 class="section-title">Who are we?</h3>
                            <p>We’re proud of the work we do, and we wouldn’t be successful without the amazing team of people making Topbrandmate what it is today.</p>
                            <p>Our young and dynamic teams work alongside to ensure our platform runs smoothly and are clients are achieving their goals. With more than 18+ nationalities and experts from diverse fields, we strive to make influencer marketing better for everyone. Our unique blend of different personalities, backgrounds, skill sets and talents allows us to push further and shape the future of influencer marketing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        
        <!-- about cta section -->
        <section class="about-cta section-top-space white-bg">
            <div class="container">
                <div class="about-cta-main section-bottom-space section-top-space">
                    <div class="row gy-4 gy-lg-0">
                        <div class="col-lg-3 col-sm-6">
                            <div class="cta-content">
                                <h3>250+</h3>
                                <h5>YEAR OF FOUNDING</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cta-content">
                                <h3>115+</h3>
                                <h5>EMPLOYEES</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cta-content">
                                <h3>30 <span>y/o</span></h3>
                                <h5>AVERAGE AGE</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cta-content">
                                <h3>50 <span>%</span> 50 <span>%</span></h3>
                                <h5>GENDER BREAKDOWN</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- our team section -->
        <section id="team" class="team-area section-top-space section-bottom-space white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title text-center">Our Leadership</h3>
                    </div>
                </div>
                <div class="row team-items">
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <img class="img-fluid" src="{{asset('assets/images/about-us/team-1.png')}}" alt="Thumb">
                                <div class="overlay">
                                    <div class="info">
                                        <h4>Lorem Ipsum</h4>
                                        <span>Project Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <img class="img-fluid" src="{{asset('assets/images/about-us/team-2.png')}}" alt="Thumb">
                                <div class="overlay">
                                    <div class="info">
                                        <h4>Lorem Ipsum</h4>
                                        <span>App Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <img class="img-fluid"  src="{{asset('assets/images/about-us/team-3.png')}}" alt="Thumb">
                                <div class="overlay">
                                    <div class="info">
                                        <h4>Lorem Ipsum</h4>
                                        <span>Web designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="" class="primary-btn">See All </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
