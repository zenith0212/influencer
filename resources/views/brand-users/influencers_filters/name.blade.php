<div class="tab-content">
    <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel">
        <div class="row g-6 g-xl-9">
                @foreach($filters_by_name as $key=>$value)
                    <div class="col-md-6 col-xxl-4">
                        <div class="card">
                            <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                <div class="symbol symbol-65px symbol-circle mb-5">
                                    <img src="{{ $value->media_profile }}" alt="image">
                                </div>
                            
                                <a href="{{ url('brand/find-influencer') }}/{{ $value->id }}" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $value->nickname}}</a>
                            
                                <div class="fw-semibold text-gray-400 mb-6 text-center">{{ $value->signature }}</div>
                            
                                <div class="d-flex flex-center flex-wrap">
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                        <div class="fs-6 fw-bold text-gray-700">{{ intWithStyle($value->follower_count) }}</div>
                                        <div class="fw-semibold text-gray-400">Followers</div>
                                    </div>
                                
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                        <div class="fs-6 fw-bold text-gray-700">{{ intWithStyle($value->average_like_count) }}</div>
                                        <div class="fw-semibold text-gray-400">Likes</div>
                                    </div>
                                
                                    <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                        <div class="fs-6 fw-bold text-gray-700">{{ $value->average_engagement_rate }}%</div>
                                        <div class="fw-semibold text-gray-400">Engement Rate</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>