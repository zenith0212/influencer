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
                                            <h3>$ {{ $totalReleaseAmount }}</h3>
                                            <h4 class="fw-normal">Total Campaign Earning Amount</h4>
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
                                            <h3>$ {{ $remainingReleaseAmount }}</h3>
                                            <h4 class="fw-normal">Remaining Campaign Amount</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center justify-content-end mb-4">
                    <div class="col-md-4">
                        <form action="">
                          <div class="input-group serch-input">
                                <input type="search" id="search_keyword" class="form-control" placeholder="Search using campaign name">
                                <button class="" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- listing datatable  -->
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-total" role="tabpanel"
                                aria-labelledby="pills-total-campaign">
                                <div>
                                    <div class="campaign-list-table list-table">
                                        <table id="totalEarnings" class="display w-100">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Created Date</th>
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
    var defaultImgUrl = "{{ asset('/assets/media/avatars/default_img.png') }}";
    let $totalEarnings = $('#totalEarnings').DataTable({
        "searching": false,
        "lengthChange": false,
        processing: true,
        serverSide: true,
        filter: false,
        "ajax": {
            "url": "{{ route('get_total_earnings') }}",
            'data': function(data){
                var search_string = $('#search_keyword').val();
                data.search_string = search_string;
            }
        },
        columns: [
            {
                data: null,
                class:'text-center',
                mRender: function ( data, type, row ) {
                    return `<div class="d-flex align-items-center"><img src="${data.thumbnail_image}" height="50" alt="" onerror="this.src='${defaultImgUrl}'"> ${data.campaign_name}</div>`
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

                            <a href="${data.pdf_preview}" class="delet-btn" target="_blank">
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

    $('#search_keyword').bind("keyup change", function(){
        $totalEarnings.ajax.reload();
    });
</script>
@endsection
