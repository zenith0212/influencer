@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
<style>
    .why-we-banner-section {
        background-image: url("assets/images/content/why-banner-background.jpg") !important;
    }
</style>
@section('content')

 <main>
        <!-- banner section  -->
        <section class="why-we-banner-section">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-7">
                        <div class="banner-content">
                            <h1 class="banner-title">
                                 Why <br>   
                                <span>Topbrandmate ?</span>
                            </h1>
                            <p>Lorem ipsum dolor sit amet consectetur. Turpis scelerisque metus enim ornare quam ac nibh. Praesent mauris ut suspendisse at sollicitudin ut tellus. Habitant nascetur quis risus commodo eget cras sit.</p>                            
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="banner-img">
                            <img src="{{asset('assets/images/content/why-banner-img.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- influencer-marketing -->

        <section class="what-is-our-platform section-top-space section-bottom-space">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-1 order-lg-0">
                        <div class="service-content-img">
                            <img src="{{asset('assets/images/content/what-is-our-platform.png')}}" alt="">
                        </div>
                    </div>
        
                    <div class="col-lg-6 order-0 order-lg-1">
                        <div class="service-content">
                            <h3 class="section-heading">What is our platform?</h3>
                            <p>We are ALL-IN-ONE influencer marketing platform for merchants or influencers in the world to quickly develop business and accomplish marketing goal. Our platform deeply link 10 million influencer resources around the world and aggregate hundreds of millions of global traffic, providing more opportunities for business growth of merchants as well as influencers.</p>
                            <a href="" class="primary-btn">Join Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>  

        <section class="how-we-do section-top-space section-bottom-space">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="service-content">
                            <h3 class="section-heading">How we do?</h3>
                            <p>We provide full-process influencer marketing support such as influencer searching, statistics analysis, influencer invitation, campaign management, and campaign analysis. Provide rich marketing cases, professional customer service team to answer questions, largely saving time and effort of brand.</p>
                            <a href="" class="primary-btn">Join Us</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-content-img">
                            <img src="{{asset('assets/images/content/how-we-do.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="affiliate-campaigns section bg-white">
            
        </section>

    </main> 
@endsection
