@extends('layouts.admin.app')

@section('title')
{{ $title }}
@endsection

@section('style')
    <style>
        .modal-body .payment-details{
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.5;
        }

        .modal-body .payment-details b{
            width: 20%;
            display: inline-block;
        }
    </style>
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
            <div class="row gy-5 g-xl-10">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div class="d-flex justify-content-center align-items-center flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">$ {{ $totalReleaseAmount }}</span>
                                <div class="mt-3">
                                    <span class="fw-semibold fs-3 text-gray-400">Total Released Amount</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div class="d-flex justify-content-center align-items-center flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">$ {{ $remainingReleaseAmount }}</span>
                                <div class="mt-3">
                                    <span class="fw-semibold fs-3 text-gray-400">Remaining Release Amount</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-body pt-0">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 align-middle table-row-dashed fs-6 gy-5 table-responsive" id="paymentsTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Campaign</th>
                                <th class="min-w-125px">Influencer</th>
                                <th class="min-w-125px">Price</th>
                                <th class="min-w-125px">Duration</th>
                                <th class="text-end min-w-70px">Status</th>
                                <th class="text-end min-w-70px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
<script type="text/javascript" src="{{ asset('assets/js/custom/datatable.js') }}"></script>
<script>
    $(window).on('load',function(){
        setTimeout(function() {
            $('.page-loader').fadeOut('slow');
        },1000);
    });

    $('#paymentsTable').DataTable({
        "searching": false,
        processing: true,
        serverSide: true,
        filter: true,
        ajax: "{{ route('payments.getPayments') }}",
        columns: [
            {
                data: null,
                class:'text-capitalize text-center',
                mRender: function ( data, type, row ) {
                    return `<div class="d-flex align-items-center"><img  class="me-2" src="${data.thumbnail_image}" height="50" width="50" alt=""><span>${data.campaign_name}</span></div>`
                },
            },
            { data: 'influencer_name',  class: 'text-capitalize text-center' },
            { data: 'price',  class: 'text-capitalize text-center' },
            { data: 'campaign_duration',  class: 'text-capitalize text-center' },
            { data: 'status',  class: 'text-capitalize text-center' },
            {
                data: null,
                className: "dt-center editor-delete text-center",
                orderable: false,
                "mRender" : function ( data, type, row ) {
                    return `<a href="javascript:viewDetails('${data.id}');" class="delete btn btn-release-payment" title="Release Payment">
                                <span class="svg-icon svg-icon-3">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"></path></svg>
                                </span>
                            </a>

                            <a href="${data.pdf_preview}" target="_blank" class="btn btn-release-payment" title="Preview PDF">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/></svg>
                                </span>
                            </a>`;
                }
            },
        ]
    });

    function viewDetails(id) {
        if(id){
            $.ajax({
                url: "{{ route('payments.view_payment') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                },
                success: function ( response ) {
                    if(response.status){
                        var html = `<div class="modal-header">
                                <h1 class="modal-title text-center fs-5" id="exampleModalLabel">Payment Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="payment-details">
                                    <b>Campaign Name: </b>
                                    <span>${response.paymentDetail.campaign_name}</span>
                                </div>
                                <div class="payment-details">
                                    <b>Campaign Date: </b>
                                    <span>${response.paymentDetail.campaign_duration}</span>
                                </div>
                                <div class="payment-details">
                                    <b>Influencers Name: </b>
                                    <span>${response.paymentDetail.influencer_name}</span>
                                </div>
                                <div class="payment-details">
                                    <b>Influencers Fees: </b>
                                    <span>${response.paymentDetail.price}</span>
                                </div>
                                <div class="payment-details">
                                    <b>Status: </b>
                                    <span>${response.paymentDetail.status}</span>
                                </div>
                            </div>
                        `;

                        make_modal('view-payments', html, true)
                    }
                },
                error: function ( response ) {
                    error_notification();
                }
            });
        }else {
            error_notification('Something went wrong.Please try again!');
        }
    }
</script>
@endsection
