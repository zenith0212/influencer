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
           <!--  <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="javascript:void(0)" data-url="{{ route('brand.create')}}" class="btn btn-primary brand-add-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_add_brand" id="brand-add-btn"> {{ __('Create Brand') }}</a>
            </div> -->
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card card-xl-stretch mb-xl-8">
                            <div class="tab-content" id="myTabContent">
                            <div class="spinner d-none"></div>
                                <div class="tab-pane fade show active" id="kt_table_widget_7_tab_1_brands" role="tabpanel">
                                <div class="card-body py-4">
									<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
										<div class="table-responsive">
											<table class="table align-middle table-row-dashed fs-6 gy-5 brand_users_table" id="">
												<thead>
                                                    <tr role="row" class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="" >Brnad Logo</th>
														<th class="" >Brand Title</th>
                                                        <!-- <th class="" >Category</th> -->
                                                        <th class=" ">Email</th>
														<th class="" >Address</th>
														<th class="">Actions</th>
                                                    </tr>
												</thead>
											</table>
                                        	<tbody class="text-gray-600 fw-bold">
                                                <td></td>
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
<script>
$(document).on('click', '.brand-add-btn',function(e) {
    e.preventDefault();
    let add_url = $(this).attr('data-url');
    let $this = $(this);
    $this.addClass('pe-none');

    if ( add_url ) {
        $.ajax({
            url: add_url,
            type: 'post',
            dataType: 'json',
            complete: function(response) {
                let resp = response.responseJSON;
                if ( resp ) {
                    if ( resp.status ) {
                        make_modal( 'add-plans-modal', resp.data.view, true );
                        // validateForm( $('.create-brand-form') );
                    } else {
                        error_notification_add( resp.message );
                    }
                }
            },
            error: function (response) {
                error_notification_add();
            }
        }).always(function(){
            $this.removeClass('pe-none');
        });
    }
});
</script>

@endsection
