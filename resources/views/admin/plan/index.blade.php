@extends('layouts.admin.app')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            @if( isset( $breadcrumbs ) )
                @include('layouts.admin.breadcrumbs', ['breadcrumbs' => $breadcrumbs ])
            @endif

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="javascript:void(0)" data-url="{{ route('plans.create')}}" class="btn btn-primary plans-add-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer" id="plans-add-btn"> {{ __('plans.create') }}</a>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 table-responsive" id="plansTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0" >
                                <th class="min-w-125px">{{ __('plans.name') }}</th>
                                <th class="min-w-125px">{{ __('plans.description') }}</th>
                                <th class="min-w-125px">{{ __('plans.amount') }}</th>
                                <th class="min-w-125px">{{ __('plans.status') }}</th>
                                <th class="min-w-125px">{{ __('plans.plan_duration') }}</th>
                                <th class="text-end min-w-70px">{{ __('plans.actions') }}</th>
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
        let delete_route = "{{ route('plans.destroy')}}";
        let changeStatus = "{{ route('plans.change-status')}}";
        let edit_route = "{{ route('plans.edit', ['id' => '/']) }}";
        let url_get_plans = '{{ route('plans.getPlans') }}';
    </script>

    <script type="text/javascript" src="{{ asset('assets/js/custom/datatable.js') }}"></script>
    <script src="{{ asset('assets_old_dkp/js/plans.js') }}"></script>
@endsection
