@extends('layouts.index')
@section('style')
    <style>
        td {
            text-transform: unset;
        }
    </style>
@endsection
@section('content')
<main>
    <div class="content">
        <div class="container-fluid">
            <div class="campaign">
                <h3>Campaign</h3>
                <div class="row align-items-center gy-3 gy-xxl-0 mb-4">
                    <div class="col-xxl-7">
                        <div class="campaign-tab">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-total-campaign" data-bs-toggle="pill" data-bs-target="#pills-total" type="button" role="tab" aria-controls="pills-total" aria-selected="true">
                                         Total Campaign (<span class="total-campaign-count">0</span>)
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active" aria-selected="false" tabindex="-1">  Active Campaign (<span class="total-active-campaign-count">0</span>)</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="false" tabindex="-1"> Completed Campaign (<span class="total-completed-campaign-count">0</span>)</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9 col-xxl-3">
                        <form action="">
                          <div class="input-group serch-input">
                                <input type="search" id="search_keyword" class="form-control" placeholder="Search here">
                                <button class="" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-3 col-xxl-2">
                         <a href="{{ route('brand.campaign.create') }}" class="primary-btn rounded-pill"> + Create Campaign </a>
                    </div>
                </div>

                <!-- tabs and serch input  -->
               {{--  <div class="row align-items-center mb-4">
                    <div class="col-lg-6">
                        <div class="campaign-tab">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-total-campaign" data-bs-toggle="pill" data-bs-target="#pills-total" type="button" role="tab" aria-controls="pills-total" aria-selected="true">
                                        Total Campaign (<span class="total-campaign-count">0</span>)
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active" aria-selected="false">
                                        Active Campaign (<span class="total-active-campaign-count">0</span>)
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="false">
                                        Completed Campaign (<span class="total-completed-campaign-count">0</span>)
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <form action="">
                            <div class="input-group serch-input">
                                <input type="search" id="search_keyword" class="form-control" placeholder="Search here">
                                <button class="" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <a href="{{ route('brand.campaign.create') }}" class="primary-btn rounded-pill"> + Create Campaign </a>
                    </div>
                </div> --}}

                <!-- listing datatable  -->
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-total" role="tabpanel"
                                aria-labelledby="pills-total-campaign">
                                <div>
                                    <div class="table-heading">
                                        <h4>Total Campaign (<span class="total-campaign-count">0</span>)</h4>
                                    </div>
                                    <div class="campaign-list-table list-table">
                                        <table id="totalCampaign" class="display w-100">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Total Products</th>
                                                    <th>Total Influencers</th>
                                                    <th>Created Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab">
                                <div>
                                    <div class="table-heading">
                                        <h4>Active Campaign (<span class="total-active-campaign-count">0</span>)</h4>
                                    </div>
                                    <div class="campaign-list-table list-table">
                                        <table id="activeCampaignList" class="display w-100">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Total Products</th>
                                                    <th>Total Influencers</th>
                                                    <th>Created Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab">
                                <div>
                                    <div class="table-heading">
                                        <h4>Completed Campaign (<span class="total-completed-campaign-count">0</span>)</h4>
                                    </div>
                                    <div class="campaign-list-table list-table">
                                        <table id="completedCampaignList" class="display w-100">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Total Products</th>
                                                    <th>Total Influencers</th>
                                                    <th>Created Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</main>
@endsection

@section('script')
<script>
    let hash = window.location.hash;
    if (window.location.hash) {
      console.log("window.location.hash : " +  hash);
    } else {
    console.log("no  window.location.hash" );
    }

       if(hash == '#active-campaign') {
          $('#pills-total-campaign').removeClass('active show');
          $('#pills-total').removeClass('active show');
          $('#pills-completed-tab').removeClass('active show');
          $('#pills-completed').removeClass('active show');
          $('#pills-active-tab').addClass('active show');
          $('#pills-active').addClass('active show');
       }

        if(hash == '#completed-campaign') {
          $('#pills-total-campaign').removeClass('active show');
          $('#pills-total').removeClass('active show');
          $('#pills-completed-tab').addClass('active show');
          $('#pills-completed').addClass('active show');
          $('#pills-active-tab').removeClass('active show');
          $('#pills-active').removeClass('active show');
       }

    let get_campaign            = '{{ route("brand.campaign.getCampaigns") }}';
    let get_active_campaign     = '{{ route("brand.campaign.activeCampaignList") }}';
    let get_completed_campaign  = '{{ route("brand.campaign.completedCampaignList") }}';
    let delete_campaign         = '{{ route("brand.campaign.destroy") }}';
</script>
<script src="{{ asset('brand_campaign/js/index.js') }}"></script>
@endsection
