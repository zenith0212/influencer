@extends('layouts.admin.app')

<link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}" />   

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            @if( isset( $breadcrumbs ) )
                @include('layouts.admin.breadcrumbs', ['breadcrumbs' => $breadcrumbs ])
            @endif
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 table-responsive" id="campaignsTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0" >
                                <th class="min-w-125px">Thumbnail</th>
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Brand</th>
                                <th class="min-w-125px">sample required</th>
                                <th class="min-w-125px">status</th>
                                <th class="min-w-125px">total influencers</th>
                                <th class="min-w-125px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')

    <script type="text/javascript">
        var imagePath = "{{ asset('/storage/campaign_images/')}}";
        var view_route = "{{ route('campaigns.show', ['id' => '/']) }}";
        let get_campaign_route = "{{route('campaigns.getCampaigns')}}";
        let defaultImgUrl = "{{asset('assets/media/avatars/default_img.png')}}";

        @if(Session::has('error'))
            toastr.options = {
                closeButton: true,
                progressBar: true,
                opacity: 1,
            }   
            toastr.error("{{ session('error') }}");
        @endif

    </script>

    <script src="{{asset('assets/js/toastr.min.js')}}"></script>  
    <script type="text/javascript" src="{{ asset('assets/js/custom/datatable.js') }}"></script>
    <script src="{{ asset('assets_old_dkp/js/campaigns.js') }}"></script>

@endsection 