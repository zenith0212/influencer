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
            <div class="card mt-5">
                <div class="card-body pt-0">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 align-middle table-row-dashed fs-6 gy-5 table-responsive" id="joinUsTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Product Name</th>
                                <th class="min-w-125px">Email</th>
                                <th class="min-w-125px">Phone Number</th>
                                <th class="min-w-125px">Company</th>
                                <th class="text-end min-w-70px">Company Scale</th>
                                <th class="text-end min-w-70px">How to Know</th>
                                <th class="text-end min-w-70px">Company Intro</th>
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

    $('#joinUsTable').DataTable({
        "searching": true,
        processing: true,
        serverSide: true,
        filter: true,
        ajax: "{{ route('front.join_us_details') }}",
        columns: [
            { data: 'name',  class: 'text-capitalize text-center' },
            { data: 'product_name',  class: 'text-capitalize text-center' },
            { data: 'email',  class: 'text-center' },
            { data: 'phone_number',  class: 'text-capitalize text-center' },
            { data: 'company_name',  class: 'text-capitalize text-center' },
            { data: 'company_scale',  class: 'text-capitalize text-center' },
            { data: 'how_to_know',  class: 'text-capitalize text-center' },
            { data: 'company_introduction',  class: 'text-capitalize text-center' },
            // {
            //     data: null,
            //     className: "dt-center editor-delete text-center",
            //     orderable: false,
            //     "mRender" : function ( data, type, row ) {
            //         return `<a href="javascript:viewDetails('${data.id}');" class="delete btn btn-release-payment" title="Release Payment">
            //                     <span class="svg-icon svg-icon-3">
            //                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"></path></svg>
            //                     </span>
            //                 </a>`;
            //     }
            // },
        ]
    });
</script>
@endsection
