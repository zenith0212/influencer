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
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="javascript:void(0);" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ auth()->user()->name }}</a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="mailto:{{ auth()->user()->email }}" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                    <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            {{ auth()->user()->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Profile Details</h3>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary align-self-center">Edit Profile</a>
                </div>
                <div class="card-body p-9">
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-muted">Email Address</label>
                        <div class="col-lg-8">
                            <a href="mailto:{{ auth()->user()->email }}" class="fw-bold fs-6 text-gray-800">{{ auth()->user()->email }}</a>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-muted">Contact Number</label>
                        <div class="col-lg-8">
                            <a href="tel:{{ auth()->user()->phone_no }}" class="fw-bold fs-6 text-gray-800">{{ auth()->user()->phone_no ? auth()->user()->phone_no : 'N/A' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
