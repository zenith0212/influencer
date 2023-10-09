@extends('frontend.index')

@section('content')
	<main>
		<!-- banner section  -->
		<section class="banner-section">
		   <div class="container">
		      <div class="row ">
		         <div class="col-lg-8">
		            <div class="banner-content">
		               <h1>
		                  Boost Your Sales through
		                  <span>Influencer Marketing</span>
		               </h1>
		               <p>ALL-IN-ONE influencer marketing platform for brands to drive more revenue from influencer
		                  economy
		               </p>
		               <div class="input-group">
		                  <input type="text" class="" placeholder="Work Email">
		                  <button>Get started </button>
		               </div>
		            </div>
		         </div>
		         <div class="col-lg-4 d-none d-lg-block">
		            <div class="banner-right">
		               <!-- <div class="banner-img-2">
		                  <img src="./assets/images/home/banner-girl-img.png" alt="">
		                  </div>
		                  <div class="banner-cover">
		                  <img src="./assets/images/home/banner-cover.png" alt="">
		                  </div>
		                  <div class="banner-card banner-profile">
		                  
		                  <img src="./assets/images/home/banner-profile.png" alt="">
		                  <h3>5324</h3>
		                  <ul class="">
		                      <li>Follower</li>
		                      <li>Subscriber</li>
		                  </ul>
		                  
		                  </div>
		                  <div class="banner-card banner-chart">
		                  
		                  <div class="badge"> ROI </div>
		                  <ul>
		                      <li>
		                          <p>$15k</p>
		                          <span>Sales generated</span>
		                      </li>
		                      <li>
		                          <p>7.2</p>
		                          <span>ROI</span>
		                      </li>
		                  </ul>
		                  <img src="./assets/images/home/banner-chart.png" alt="">
		                  
		                  </div> -->
		               <div class="banner-img">
		                  <img src="{{asset('assets/frontend/images/home/banner-img-2.png')}}" alt="">
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="social-icon social-icon-banner">
		      <div class="icon-box facebook">
		         <img src="{{asset('assets/frontend/images/icon/facebook.png')}}" alt="">
		      </div>
		      <div class="icon-box insta">
		         <img src="{{asset('assets/frontend/images/icon/insta.png')}}" alt="">
		      </div>
		      <div class="icon-box tiktok">
		         <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		      </div>
		      <div class="icon-box twitter">
		         <img src="{{asset('assets/frontend/images/icon/twitter.png')}}" alt="">
		      </div>
		      <div class="icon-box youtube">
		         <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		      </div>
		   </div>
		</section>
		<!-- influencer-marketing -->
		<section class="influencer-marketing section-top-space section-bottom-space">
		   <div class="container">
		      <img src="{{asset('assets/frontend/images/home/Influenc-market-vector.png')}}" class="influencer-market-vector" alt="">
		      <div class="row">
		         <div class="col-lg-7">
		            <div class="influencer-marketing-left">
		               <img src="{{asset('assets/frontend/images/home/Influenc-market.png')}}" alt="">
		            </div>
		         </div>
		         <div class="col-lg-5">
		            <div class="influencer-marketing-right">
		               <h2 class="section-title">What is Influencer Marketing?</h2>
		               <p>Influencer marketing is now the mainstream of online marketing. TikTok influencer
		                  marketing is being accepted and applied by more and more brands. Brands use influencer
		                  marketing to build brand awareness, and sellers from third-party e-commerce platforms
		                  have also begun to use TikTok influencer marketing to attract more audiences. TikTok is
		                  starting to become one of the important means of brand marketing. According to research,
		                  94% of marketers who use influencer marketing consider it an effective practice, and
		                  influencer marketing can generate 11 times more revenue than traditional advertising.
		               </p>
		            </div>
		         </div>
		      </div>
		   </div>
		</section>
		<section class="what-we-do section-top-space section-bottom-space">
		   <img src="{{asset('assets/frontend/images/home/dash-lines.svg')}}" class="dash-lines" alt="">
		   <div class="container">
		      <div class="text-center what-we-do-head">
		         <h2 class="section-title">How We Do?</h2>
		         <p>Lorem ipsum dolor sit amet consectetur. Nunc mauris sed placerat leo viverra leo nullam. Massa eu
		            id volutpat sodales.
		         </p>
		      </div>
		   </div>
		   <div class="influencer-discovery">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Influencer Discovery</h3>
		                  <p>Find the best-fit influencers for your brand. Multiple ways to help you identify and
		                     invite influencer based on the detailed analysis.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-discovery.png')}}" alt="">
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="influencer-management">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-managment.png')}}" alt="">
		               </div>
		            </div>
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Influencer Discovery</h3>
		                  <p>Find the best-fit influencers for your brand. Multiple ways to help you identify and
		                     invite influencer based on the detailed analysis.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="campaign-management">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Campaign Management</h3>
		                  <p>Post your marketing tasks and influencers will apply for it. You can adjust your plan
		                     anytime to find the pointed influencers and communicate with them.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-managment.png')}}" alt="">
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="product-seeding">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-managment.png')}}" alt="">
		               </div>
		            </div>
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Product Seeding</h3>
		                  <p>The platform will track all the products when brands send the sample to influencers.
		                     It can make the marketing realistic and efficient. Influencers can review and rate
		                     the product once received.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="livestream-ecommerce">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Livestream Ecommerce</h3>
		                  <p>A list of influencers that can livestream will be provided for brand to reach their
		                     need. Brands will have a clear view on the livestream data of the influencers.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-managment.png')}}" alt="">
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="reporting-analysis">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-managment.png')}}" alt="">
		               </div>
		            </div>
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Reporting & Analysis</h3>
		                  <p>After cooperation, data reports will be automatically generated for marketing
		                     effects. The data of video or livestream such as views/likes/shares/etc. will appear
		                     in the report.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="payment">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-5">
		               <div class="what-we-do-content">
		                  <h3>Payment</h3>
		                  <p>We simplified the payment process for both brand and influencer. Our platform can
		                     send payments to content creators and track payment history.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		                  <ul class="social-icon">
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/tiktok.png')}}" alt="">
		                        </a>
		                     </li>
		                     <li class="icon-box">
		                        <a href="">
		                        <img src="{{asset('assets/frontend/images/icon/youtube.png')}}" alt="">
		                        </a>
		                     </li>
		                  </ul>
		               </div>
		            </div>
		            <div class="col-lg-6">
		               <div class="what-we-do-img">
		                  <img src="{{asset('assets/frontend/images/home/influencer-managment.png')}}" alt="">
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		</section>
		<section class="cta">
		   <div class="cta-main">
		      <div class="container">
		         <div class="row align-items-center justify-content-between">
		            <div class="col-lg-6">
		               <img src="{{asset('assets/frontend/images/home/cta-img.png')}}" alt="">
		            </div>
		            <div class="col-lg-6">
		               <div class="cta-content">
		                  <h3>Manage all Your Influencers Relationships in One Place.</h3>
		                  <p>Lorem ipsum dolor sit amet consectetur. Eget nibh ornare ut massa mi senectus luctus
		                     dui. Pellentesque dignissim posuere orci nunc.
		                  </p>
		                  <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		   <div class="cta-sub">
		      <div class="container-fluid">
		         <div class="row">
		            <div class="col-md-6">
		               <div class="cta-sub-inner">
		                  <h5>Boost Your Sales</h5>
		                  <p>You need a platform that allows to manage your influencers, campaigns, creator
		                     content anytime to boost your sales.
		                  </p>
		               </div>
		            </div>
		            <div class="col-md-6">
		               <div class="cta-sub-inner">
		                  <h5>Grow Your Business</h5>
		                  <p>Lot of functions with simple operation grow your business and win brand awareness all
		                     over the world.
		                  </p>
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		</section>
		<section class="ready-to-start section-top-space section-bottom-space">
		   <div class="container">
		      <div class="row ">
		         <div class="col-lg-5">
		            <div class="ready-to-start-content">
		               <h2 class="section-title">Ready to Start Influencer Marketing?</h2>
		               <p>Topbrandmate will accompany you to match the most suitable influence with the fastest
		                  efficiency to create the fantastic contents and the biggest profits.
		               </p>
		               <a href="" class="primary-btn">Learn More <i class="fa-solid fa-arrow-right"></i> </a>
		            </div>
		            <div class="ready-to-start-img">
		               <img src="{{asset('assets/frontend/images/home/ready-to-start-img-1.png')}}" alt="">
		            </div>
		         </div>
		         <div class="col-lg-7">
		            <div class="row gx-0">
		               <div class="col-md-6">
		                  <div class="ready-to-start-img mb-4">
		                     <img src="{{asset('assets/frontend/images/home/ready-to-start-img-2.png')}}" alt="">
		                  </div>
		                  <div class="ready-to-start-img">
		                     <img src="{{asset('assets/frontend/images/home/ready-to-start-img-3.png')}}" alt="">
		                  </div>
		               </div>
		               <div class="col-md-6">
		                  <div class="ready-to-start-img mb-4">
		                     <img src="{{asset('assets/frontend/images/home/ready-to-start-img-4.png')}}" alt="">
		                  </div>
		                  <div class="ready-to-start-img">
		                     <img src="{{asset('assets/frontend/images/home/ready-to-start-img-5.png')}}" alt="">
		                  </div>
		               </div>
		            </div>
		         </div>
		      </div>
		   </div>
		</section>
		<section class="project-done section-bottom-space section-top-space">
		   <div class="container">
		      <div class="row">
		         <div class="col-lg-3 position-relative">
		            <div class="project-done-block right-divider">
		               <h2>250+</h2>
		               <span></span>
		               <p>Brands</p>
		            </div>
		         </div>
		         <div class="col-lg-3 position-relative">
		            <div class="project-done-block right-divider">
		               <h2>50k+</h2>
		               <span></span>
		               <p>Products</p>
		            </div>
		         </div>
		         <div class="col-lg-3 position-relative">
		            <div class="project-done-block right-divider">
		               <h2>10k+</h2>
		               <span></span>
		               <p>Influencers</p>
		            </div>
		         </div>
		         <div class="col-lg-3 ">
		            <div class="project-done-block">
		               <h2>4.5</h2>
		               <span></span>
		               <p>Customer Satisfaction</p>
		            </div>
		         </div>
		      </div>
		   </div>
		</section>
		<section class="testimonials section-bottom-space section-top-space">
		   <div class="container">
		      <div class="row">
		         <div class="col-12">
		            <div class="testimonials-head">
		               <h2 class="section-title">Testimonials</h2>
		               <p>What our happy clients say?</p>
		            </div>
		         </div>
		         <div class="col-12">
		            <div class="swiper testimonials-swiper">
		               <div class="swiper-wrapper">
		                  <div class="swiper-slide">
		                     <div class="card">
		                        <div class="card-body">
		                           <img class="card-img-cuso" src="{{asset('assets/frontend/images/home/double-quotes.png')}}"
		                              alt="Title">
		                           <ul>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                           </ul>
		                           <p class="card-text">Lorem ipsum dolor sit amet consectetur. Pellentesque
		                              cras aliquet ridiculus nec dignissim. Cursus lacus varius vel metus.
		                           </p>
		                        </div>
		                        <div class="card-footer">
		                           <img src="{{asset('assets/frontend/images/home/user-icon.png')}}" alt="">
		                           <div>
		                              <p>Beatrice D. Freitas</p>
		                              <span>TikTok Influencer</span>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		                  <div class="swiper-slide">
		                     <div class="card">
		                        <div class="card-body">
		                           <img class="card-img-cuso" src="{{asset('assets/frontend/images/home/double-quotes.png')}}"
		                              alt="Title">
		                           <ul>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                           </ul>
		                           <p class="card-text">Lorem ipsum dolor sit amet consectetur. Pellentesque
		                              cras aliquet ridiculus nec dignissim. Cursus lacus varius vel metus.
		                           </p>
		                        </div>
		                        <div class="card-footer">
		                           <img src="{{asset('assets/frontend/images/home/user-icon.png')}}" alt="">
		                           <div>
		                              <p>Beatrice D. Freitas</p>
		                              <span>TikTok Influencer</span>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		                  <div class="swiper-slide">
		                     <div class="card">
		                        <div class="card-body">
		                           <img class="card-img-cuso" src="{{asset('assets/frontend/images/home/double-quotes.png')}}"
		                              alt="Title">
		                           <ul>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                           </ul>
		                           <p class="card-text">Lorem ipsum dolor sit amet consectetur. Pellentesque
		                              cras aliquet ridiculus nec dignissim. Cursus lacus varius vel metus.
		                           </p>
		                        </div>
		                        <div class="card-footer">
		                           <img src="{{asset('assets/frontend/images/home/user-icon.png')}}" alt="">
		                           <div>
		                              <p>Beatrice D. Freitas</p>
		                              <span>TikTok Influencer</span>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		                  <div class="swiper-slide">
		                     <div class="card">
		                        <div class="card-body">
		                           <img class="card-img-cuso" src="{{asset('assets/frontend/images/home/double-quotes.png')}}"
		                              alt="Title">
		                           <ul>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                           </ul>
		                           <p class="card-text">Lorem ipsum dolor sit amet consectetur. Pellentesque
		                              cras aliquet ridiculus nec dignissim. Cursus lacus varius vel metus.
		                           </p>
		                        </div>
		                        <div class="card-footer">
		                           <img src="{{asset('assets/frontend/images/home/user-icon.png')}}" alt="">
		                           <div>
		                              <p>Beatrice D. Freitas</p>
		                              <span>TikTok Influencer</span>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		                  <div class="swiper-slide">
		                     <div class="card">
		                        <div class="card-body">
		                           <img class="card-img-cuso" src="{{asset('assets/frontend/images/home/double-quotes.png')}}"
		                              alt="Title">
		                           <ul>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li class="active"><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                              <li><i class="fa-solid fa-star"></i></li>
		                           </ul>
		                           <p class="card-text">Lorem ipsum dolor sit amet consectetur. Pellentesque
		                              cras aliquet ridiculus nec dignissim. Cursus lacus varius vel metus.
		                           </p>
		                        </div>
		                        <div class="card-footer">
		                           <img src="{{asset('assets/frontend/images/home/user-icon.png')}}" alt="">
		                           <div>
		                              <p>Beatrice D. Freitas</p>
		                              <span>TikTok Influencer</span>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		               </div>
		            </div>
		            <div id="js-prev1" class="swiper-button-prev"></div>
		            <div id="js-next1" class="swiper-button-next"></div>
		         </div>
		      </div>
		   </div>
		</section>
	</main>
@endsection