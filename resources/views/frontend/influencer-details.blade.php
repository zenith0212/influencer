@extends('frontend.index')

@section('content')
    <main class="influencer-details">
        <div class="container-fluid">
            <div class="content">
                <div class="card-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="influencer-details-media">
                                <div class="media-img">
                                    <img src="{{asset('assets/media/avatars/default_img.png')}}" class="rounded-circle" alt="" height="100px;" width="100px;">
                                    <div class="platform">
                                        <img src="{{asset('assets/uploads/', $influencer_details->image)}}" alt="">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-left">
                                        <h5 class="username">{{ $data->name}}<span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g data-name="Layer 2"><path fill="#49adf4" d="M21.187 10.007a3.457 3.457 0 0 1-.864-.712 3.378 3.378 0 0 1 .277-1.141c.291-.821.62-1.751.092-2.474s-1.525-.7-2.4-.68a3.422 3.422 0 0 1-1.155-.078 3.369 3.369 0 0 1-.425-1.063c-.248-.845-.531-1.8-1.4-2.086-.838-.27-1.614.324-2.3.846A3.285 3.285 0 0 1 12 3.25a3.285 3.285 0 0 1-1.023-.631C10.293 2.1 9.52 1.5 8.678 1.774c-.867.282-1.15 1.24-1.4 2.085a3.418 3.418 0 0 1-.421 1.061A3.482 3.482 0 0 1 5.7 5c-.878-.024-1.867-.05-2.4.68s-.2 1.653.092 2.473a3.336 3.336 0 0 1 .281 1.141 3.449 3.449 0 0 1-.863.713c-.732.5-1.563 1.069-1.563 1.993s.831 1.491 1.563 1.993a3.449 3.449 0 0 1 .863.712 3.335 3.335 0 0 1-.273 1.142c-.29.82-.618 1.75-.091 2.473s1.521.7 2.4.68a3.426 3.426 0 0 1 1.156.078 3.4 3.4 0 0 1 .424 1.063c.248.845.531 1.8 1.4 2.086a1.424 1.424 0 0 0 .431.068 3.382 3.382 0 0 0 1.868-.914A3.285 3.285 0 0 1 12 20.75a3.285 3.285 0 0 1 1.023.631c.685.523 1.461 1.12 2.3.845.867-.282 1.15-1.24 1.4-2.084a3.388 3.388 0 0 1 .424-1.062A3.425 3.425 0 0 1 18.3 19c.878.021 1.867.05 2.4-.68s.2-1.653-.092-2.474a3.38 3.38 0 0 1-.281-1.139 3.436 3.436 0 0 1 .864-.713c.732-.5 1.563-1.07 1.563-1.994s-.834-1.492-1.567-1.993z" data-original="#49adf4" class=""></path><path fill="#ffffff" d="M11 14.75a.745.745 0 0 1-.53-.22l-2-2a.75.75 0 0 1 1.06-1.06l1.54 1.54 3.48-2.61a.75.75 0 0 1 .9 1.2l-4 3a.751.751 0 0 1-.45.15z" data-original="#ffffff" class=""></path></g></g></svg></span></h5>
                                        <ul class="background">
                                            <li><i class="fa-solid fa-location-dot"></i> {{$influencer_details->country}} </li>    
                                            <li><i class="fa-solid fa-language"></i> {{$influencer_details->social_media_link}} </li>
                                            <li><i class="fa-solid fa-arrow-trend-up"></i> Trending</li>
                                        </ul>
                                       {{--  <div class="influencer-engagement-main">
                                            <div class="influencer-engagement">
                                                <p>	Followers</p>
                                                <h3>560.9M</h3>
                                            </div>
                                             <div class="influencer-engagement">
                                                <p>	Engagements</p>
                                                <h3>2.5M</h3>
                                            </div>
                                             <div class="influencer-engagement">
                                                <p>	Engagement Rate</p>
                                                <h3>1.36%</h3>
                                            </div>
                                             <div class="influencer-engagement">
                                                <p>	Included In Campaign</p>
                                                <h3>10</h3>
                                            </div>
                                          
                                        </div> --}}
                                    </div>
                                    <div class="media-right">
                                        <div class="">
                                            <a href="mailto:{{ $data->email }}">
                                            <button type="button" class="primary-btn"> <i class="fa-solid fa-envelope"></i> Send Email</button></a>
                                            <button type="button" class="outline-primary-button"> <i class="fa-solid fa-square-plus"></i> Add to Campaign</button>
                                        </div>
                                    </div>

                                   
                                   
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-container">
                            <div class="influencer-content influencer-contact">
                                <h4>Contact</h4>
                                <div class="influencer-contact-details">
                                    <div class="">
                                        <p>Name:</p>
                                        <span>{{$data->name}}</span>
                                    </div>
                                    {{-- <div class="">
                                        <p>Last Name:</p>
                                        <span>Ronaldo</span>
                                    </div> --}}
                                    <div class="">
                                        <p>Email(s):</p>
                                        <span><a href="mailto:{{ $data->email }}">{{ $data->email}}</a> </span>
                                    </div>
                                    <div class="mb-0">
                                        <p>Phone(s):</p>
                                        <span>{{$data->phone_no}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-container">
                            <div class="influencer-content influencer-price">
                                <h4>Post Price</h4>
                                <div class="influencer-price-details">
                                    <div class="">
                                        <p>Est. Post Price:</p>
                                        <span>$4200 - $7200</span>
                                    </div>
                                </div>

                                <h4>Story Price</h4>
                                <div class="influencer-price-details">
                                    <div class="">
                                        <p>Est. Story Pricee:</p>
                                        <span>$4200 - $7200</span>
                                    </div>
                                </div>

                                <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card-container">
                            <div class="influencer-content influencer-similar">
                                <h4>Campaigns Connected</h4>
                                <div class="influencer-similar-account">
                                @foreach($campaigns_data as $campaigns)
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="./assets/images/icon/user-icon.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{$campaigns->campaigns->name_en}}</p>
                                            {{-- <p>{{ $brand_name->title_en}}</p> --}}
                                            {{-- <p>{{$brand_name->title_en}}</p> --}}
                                            {{-- <p>{{$campaigns->brands->title_en}}</p> --}}

                                           {{--  @foreach($brand_data as $brand)
                                            <span>{{ $brand->title_en}}</span>
                                            @endforeach --}}
                                            {{-- <a href="">View report</a> --}}
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection