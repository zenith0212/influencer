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
                <a href="javascript:void(0)" data-url="{{ route('categories.create')}}" class="btn btn-primary categories-add-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer" id="categories-add-btn"> {{ __('categories.create') }}</a>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body pt-0">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 align-middle table-row-dashed fs-6 gy-5 table-responsive" id="categoriesTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">{{ __('categories.image') }}</th>
                                <th class="min-w-125px">{{ __('categories.name') }}</th>
                                <th class="min-w-125px">{{ __('categories.description') }}</th>
                                <th class="text-end min-w-70px">{{ __('categories.actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
<script>
    $(window).on('load',function(){
        setTimeout(function() {
            $('.page-loader').fadeOut('slow');
        },1000);
    });

    let delete_route = "{{ route('categories.destroy')}}";
    let edit_route = "{{ route('categories.edit', ['id' => '/']) }}";   
    let defaultImgUrl = "{{asset('assets/media/avatars/default_img.png')}}";
    let categoryRoute = "{{route('categories.getCategories')}}"
</script>
<script type="text/javascript" src="{{ asset('assets/js/custom/datatable.js') }}"></script>
<script src="{{ asset('assets_old_dkp/js/categories.js') }}"></script>
@endsection 