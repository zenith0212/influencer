@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
@section('content')
<main class="pricing-main">
   <div class="content">
   <div class="container-fluid">
   <div class="subscription-head">
      <div class="row">
         <div class="col-lg-7 m-auto">
            <h2>Contact Brands and Influencers Together to
               Collaborate and Grow
            </h2>
            <p>Choose a plan to suit your needs </p>
         </div>
      </div>
   </div>
   <div class="pricing-plans">
   <div class="row g-0 justify-content-center">
     @foreach( $plans as $key => $plan )
        @php 
            $features = explode(',',$plan->features_en);
        @endphp
        @if ( $key == 1 )
      <div class="col-xxl-3 col-xl-4">
         <div class="card growth">
            <div class="card-body">
               <div class="card-icon">
                  <img src="{{asset('/assets/images/icon/growth.png')}}" alt="">
               </div>
               <h3>{{$plan->name_en}}</h3>
               <p>{{$plan->description_en}}
               </p>
               <a href="{{route('register')}}" id="lets-chat">Let’s chat</a>
               {{-- <button class="primary-btn">Subscribe Now</button> --}}
               <ul>
                   <b>All Growth features, plus</b>
                    
                    @foreach( $features as $feature )
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <div class="list-text">
                                {{ $feature }} <i class="fa-solid fa-info"></i>
                            </div>
                        </li>
                    @endforeach
                </ul>
               </div>
            </div>
         </div>
         @else

         <div class="col-xxl-3 col-xl-4">
            <div class="card scale">
               <div class="card-header">
                  <h6>Most Popular</h6>
               </div>
               <div class="card-body">
                  <div class="card-icon">
                     <img src="{{asset('/assets/images/icon/scale.png')}}" alt="">
                  </div>
                  <h3>{{ $plan->name_en }}</h3>
                  <p>{{ $plan->description_en}}</p>
                  <a href="{{route('login')}}" id="lets-chat">Let’s chat</a>
                  {{-- <button class="primary-btn">Subscribe Now</button> --}}
                  <ul>
                        @foreach( $features as $feature )
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <div class="list-text">
                                    {{ $feature }} <i class="fa-solid fa-info"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                  </div>
               </div>
            </div>
            @endif
            @endforeach
           
         </div>
      </div>
   </div>
   <footer></footer>
</main>
@endsection
