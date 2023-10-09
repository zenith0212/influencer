@extends('layouts.index')
@section('style')
    <style>
        td {
            text-transform: unset;
        }

        .delet-btn .fas.fa-file-pdf{
            font-size: 20px;
        }
    </style>
@endsection
@section('content')
<main>
    <div class="content">
        <div class="container-fluid">
            <div class="campaign">
                <h3>{{ $title }}</h3>

                <div class="row mb-5">
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex justify-content-center">
                                        <div class="media-body text-center">
                                            <h3>$ {{ $totalSpendAmount }}</h3>
                                            <h4 class="fw-normal">Total Spend Amount</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex justify-content-center">
                                        <div class="media-body text-center">
                                            <h3>$ {{ $remainingSpendAmount }}</h3>
                                            <h4 class="fw-normal">Remaining Spend Amount</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-select js-example-basic-single" id="campaign" name="campaign">
                                <option value="">Select Campaign</option>
                                @foreach ($totalCampaigns as $key => $totalCampaign)
                                    <option value="{{ $totalCampaign['id'] }}">{{ $totalCampaign['name_en'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- <div class="row align-items-center justify-content-end mb-4">
                    <div class="col-md-4">
                        <form action="">
                          <div class="input-group serch-input">
                                <input type="search" id="search_keyword" class="form-control" placeholder="Search using campaign name">
                                <button class="" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <!-- listing datatable  -->
                <div class="row" id="spend-details">
                    <div class="col-12">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-total" role="tabpanel"
                                aria-labelledby="pills-total-campaign">
                                <div>
                                    <div class="campaign-list-table list-table">
                                        <table id="totalSpends" class="display w-100">
                                            <thead>
                                                <tr>
                                                    <th>Influencer Name</th>
                                                    <th>Amount</th>
                                                    <th>Campaign Duration</th>
                                                    <th>Status</th>
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
    var defaultImgUrl   = "{{ asset('/assets/media/avatars/default_img.png') }}";

    $(document).ready(function() {
        $('#campaign').select2();
    });
    let $totalSpends    = $('#totalSpends').DataTable({
        "searching": false,
        "lengthChange": false,
        processing: true,
        serverSide: true,
        filter: false,
        "ajax": {
            "url": "{{ route('get_total_spends') }}",
            'data': function(data){
                var campaignId = $('#campaign').val();
                data.campaignId = campaignId;
            }
        },
        columns: [
            {
            data: null,
                class:'text-center',
                mRender: function ( data, type, row ) {
                    return `<div class="d-flex align-items-center"><img src="${data.influencer_image}" height="50" alt="" onerror="this.src='${defaultImgUrl}'"> ${data.influencer_name}</div>`
                },
            },
            {
                data: null,
                class: 'text-center',
                mRender: function ( data, type, row ) {
                    return `<p>$ ${data.amount}</p>`
                },
            },
            {
                data: 'campaign_duration',
            },
            {
                data: 'status',
            },
            {
                data: null,
                className: "dt-center editor-delete",
                orderable: false,
                mRender : function ( data, type, row ) {
                    return `
                        <div class="action-btns justify-content-center">
                            <button type="button" class="view-btn" onclick="redirectUrl('${data.detail}')">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <a href="${data.pdf_stream}" class="delet-btn" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </div>
                    `;
                }
            }
        ],
    });

    function redirectUrl(url) {
        window.location.href = url;
    }

    $('#campaign').on("change", function(){
        $('#spend-details').removeClass('d-none');
        $totalSpends.ajax.reload();
    });
</script>
@endsection
