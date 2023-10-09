<div class="filter-content card-container ">
    @foreach($filter_by_followers as $key=>$value)
    <div class="card-list">
        <div class="row align-items-center gx-8">
            <div class="col-xl-4">
                <div class="influencer-profile">
                    <div class="influencer-profile-img">
                        <img src="{{ $value->media_profile }}" alt="">
                    </div>
                    <div class="influencer-details">
                        <h4> 
                            <a href="{{ url('brand/find-influencer') }}/{{ $value->id }}"> {{ $value->nickname }}</a>  
                            @if($value->favourites == null)
                            <button type="button" class="add favourite-btn" id="addfavourites{{$value->id}}" onClick="addToFavourites({{$value->id}}, {{ Auth::user()->id }},'1','2')"> <i class="fa-regular fa-heart"></i> </button>
                            @else
                            <button type="button" class="delete favourite-btn" id="deletefavourites{{$value->id}}" onClick="deleteFromFavourites({{$value->id}},{{ Auth::user()->id }},{{$value->favourites->id}},2)"><i class="fas fa-heart" ></i></button>
                            @endif
                        </h4>
                        <p>{{ $value->signature }}</p>
                        <div class="influencer-lable">
                            <span>beast</span>
                            <span>Food</span>
                            <span>mrbeast</span>

                            <a href=""><i class="fa-solid fa-ellipsis"></i></a>
                        </div>
                        <ul>
                            <li><i class="fa-solid fa-users"></i> {{ intWithStyle($value->following_count) }}</li>
                            <li><i class="fa-solid fa-user-plus"></i>{{ intWithStyle($value->follower_count) }}</li>
                            <li><i class="fa-solid fa-file-video"></i>{{ intWithStyle($value->average_play_count) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="influencer-engagement-main">
                    <div class="influencer-engagement">
                        <div class="influencer-engagement-list">
                            <span>Followers</span> <b>{{ intWithStyle($value->follower_count) }}</b>
                        </div>
                        <div class="influencer-engagement-list">
                            <span>Engagement Rate</span> <b>{{ $value->average_engagement_rate }}</b>
                        </div>
                        <div class="influencer-engagement-list">
                            <span>Est. Views</span> <b>{{ intWithStyle($value->average_play_count) }}</b>
                        </div>
                        {{-- <div class="influencer-engagement-list">
                            <span>Ratings</span> <ul>
                                <li><i class="fa-solid fa-star active"></i></li>
                                <li><i class="fa-solid fa-star active"></i></li>
                                <li><i class="fa-solid fa-star active"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="row">
                    <div class="col-6">
                        <div class="influencer-content-img">
                                <img src="https://dummyimage.com/200x200/000/fff" alt="">	
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="influencer-content-img">
                                <img src="https://dummyimage.com/200x200/000/fff" alt="">	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div id="load_more"></div>
</div>
@if(count($filter_by_followers)>0)
    <div class="d-flex flex-center" id="remove-row">
        <a href="javascript:void(0);" class="btn primary-btn fw-bold px-6" id="kt_social_feeds_more_posts_btn"  data-id="{{ $value->id }}">
            <input type="hidden" id="loader_id" value="{{ $value->id }}"/>
            <span class="indicator-label">Show more</span>
            
            <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </a>
    </div>
@endif