@extends('layouts.admin.app')

@section('title')
    {{ $title }}
@endsection

@section('style')
<style>
.tab_line{
    display : inline-block !important
}
</style>
@endsection

@section('content')

<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            @if( isset( $breadcrumbs ) )
                @include('layouts.admin.breadcrumbs', ['breadcrumbs' => $breadcrumbs ])
            @endif
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="" role="tabpanel">
                                <div class="card-body py-4">
									<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
										<div class="table-responsive">
											<table class="table align-middle table-row-dashed fs-6 gy-5 influencers_users_table" id="influencers_users_table">
												<thead>
                                                    <tr role="row" class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th></th>
                                                        <th class="" >Profile</th>
														<th class="" >Name</th>
                                                        <th class="" >Country</th>
                                                        <th class="" >Followers</th>
                                                        <th class="" >Engagement Rate</th>
														<th class="">Actions</th>
                                                    </tr>
												</thead>
											</table>
                                        	<tbody class="text-gray-600 fw-bold">
					                        </tbody>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/custom/jquery-datatable.js') }}"></script>
    <script src="{{ asset('js/users/users.js') }}"></script>
@endsection